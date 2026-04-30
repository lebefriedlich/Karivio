<?php

namespace App\Jobs;

use App\Models\EmailLog;
use App\Models\User;
use App\Services\GmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendGmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailLog;

    /**
     * Create a new job instance.
     */
    public function __construct(EmailLog $emailLog)
    {
        $this->emailLog = $emailLog;
    }

    /**
     * Execute the job.
     */
    public function handle(GmailService $gmailService): void
    {
        $log = $this->emailLog;
        
        // Cek jika status bukan pending lagi (misal dibatalkan)
        if ($log->status !== 'pending') {
            return;
        }

        $user = $log->user;

        try {
            $gmailService->sendEmail(
                $user,
                $log->to,
                $log->subject,
                $log->body,
                $log->attachments
            );

            $log->update(['status' => 'sent']);
        } catch (\Exception $e) {
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);
            
            Log::error('Job Gmail Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
