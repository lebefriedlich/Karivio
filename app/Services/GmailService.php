<?php

namespace App\Services;

use App\Models\User;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GmailService
{
    public function sendEmail(User $user, $to, $subject, $body, $attachments = [])
    {
        try {
            $token = $user->getValidGoogleToken();
            if (!$token) {
                throw new \Exception('Sesi Google Anda telah berakhir. Silakan login kembali dengan Google.');
            }

            $client = new Client();
            $client->setAccessToken($token);
            $service = new Gmail($client);

            $boundary = uniqid();
            
            // Format MIME message
            $rawMessage = "To: $to\r\n";
            $rawMessage .= "Subject: $subject\r\n";
            $rawMessage .= "MIME-Version: 1.0\r\n";
            $rawMessage .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n\r\n";
            
            // Body section
            $rawMessage .= "--$boundary\r\n";
            $rawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
            $rawMessage .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $rawMessage .= base64_encode($body) . "\r\n\r\n";

            // Attachment section
            if ($attachments && is_array($attachments)) {
                foreach ($attachments as $attachment) {
                    $attachmentPath = $attachment['path'] ?? null;
                    if ($attachmentPath && Storage::disk('public')->exists($attachmentPath)) {
                        $filename = $attachment['name'] ?? basename($attachmentPath);
                        $absolutePath = Storage::disk('public')->path($attachmentPath);
                        $fileContent = file_get_contents($absolutePath);
                        $mimeType = 'application/pdf';
                        
                        $rawMessage .= "--$boundary\r\n";
                        $rawMessage .= "Content-Type: $mimeType; name=\"$filename\"\r\n";
                        $rawMessage .= "Content-Description: $filename\r\n";
                        $rawMessage .= "Content-Disposition: attachment; filename=\"$filename\"; size=" . strlen($fileContent) . ";\r\n";
                        $rawMessage .= "Content-Transfer-Encoding: base64\r\n\r\n";
                        $rawMessage .= base64_encode($fileContent) . "\r\n\r\n";
                    }
                }
            }

            $rawMessage .= "--$boundary--";

            $message = new Message();
            $message->setRaw(strtr(base64_encode($rawMessage), ['+' => '-', '/' => '_']));

            $service->users_messages->send('me', $message);
            
            return true;
        } catch (\Exception $e) {
            Log::error('Gmail Send Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
