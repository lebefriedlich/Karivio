<?php

namespace App\Services;

use App\Models\Cv;
use App\Models\CoverLetter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentStorageService
{
    public static function saveCvPdf(Cv $cv)
    {
        try {
            \Illuminate\Support\Facades\Log::info('Saving CV PDF for user ' . $cv->user_id);
            $pdf = Pdf::loadView('pdf.cv-template', ['cv' => $cv]);
            $filename = 'CV_' . str_replace(' ', '_', $cv->full_name) . '_' . $cv->id . '.pdf';
            $path = 'users/' . $cv->user_id . '/cvs/' . $filename;
            
            Storage::disk('public')->put($path, $pdf->output());
            \Illuminate\Support\Facades\Log::info('CV PDF saved to: ' . $path);
            
            return $path;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error saving CV PDF: ' . $e->getMessage());
            throw $e;
        }
    }

    public static function saveCoverLetterPdf(CoverLetter $cl)
    {
        try {
            \Illuminate\Support\Facades\Log::info('Saving Cover Letter PDF for user ' . $cl->user_id);
            $processedBody = $cl->getProcessedContent();
            $pdf = Pdf::loadView('pdf.cover-letter-template', [
                'coverLetter' => $cl,
                'body' => $processedBody
            ]);
            
            $filename = 'Cover_Letter_' . str_replace(' ', '_', $cl->company_name) . '_' . $cl->id . '.pdf';
            $path = 'users/' . $cl->user_id . '/cover_letters/' . $filename;
            
            Storage::disk('public')->put($path, $pdf->output());
            \Illuminate\Support\Facades\Log::info('Cover Letter PDF saved to: ' . $path);
            
            return $path;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error saving Cover Letter PDF: ' . $e->getMessage());
            throw $e;
        }
    }

    public static function deleteCvFiles(Cv $cv)
    {
        try {
            $directory = 'users/' . $cv->user_id . '/cvs/';
            $files = Storage::disk('public')->files($directory);
            $deletedCount = 0;

            foreach ($files as $file) {
                // Check if file ends with _{id}.pdf
                if (str_ends_with($file, '_' . $cv->id . '.pdf')) {
                    Storage::disk('public')->delete($file);
                    $deletedCount++;
                }
            }
            
            \Illuminate\Support\Facades\Log::info("Deleted $deletedCount CV files for CV ID: " . $cv->id);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error deleting CV files: ' . $e->getMessage());
        }
    }

    public static function deleteCoverLetterFiles(CoverLetter $cl)
    {
        try {
            $directory = 'users/' . $cl->user_id . '/cover_letters/';
            $files = Storage::disk('public')->files($directory);
            $deletedCount = 0;

            foreach ($files as $file) {
                // Check if file ends with _{id}.pdf
                if (str_ends_with($file, '_' . $cl->id . '.pdf')) {
                    Storage::disk('public')->delete($file);
                    $deletedCount++;
                }
            }
            
            \Illuminate\Support\Facades\Log::info("Deleted $deletedCount Cover Letter files for CL ID: " . $cl->id);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error deleting Cover Letter files: ' . $e->getMessage());
        }
    }
}
