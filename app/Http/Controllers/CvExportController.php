<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class CvExportController extends Controller
{
    public function exportPdf(Cv $cv): Response
    {
        $pdf = Pdf::loadView('pdf.cv-template', ['cv' => $cv]);
        return $pdf->download('CV - ' . $cv->full_name . '.pdf');
    }

    public function exportCoverLetterPdf(\App\Models\CoverLetter $cl): Response
    {
        $processedBody = $cl->getProcessedContent();
        $pdf = Pdf::loadView('pdf.cover-letter-template', [
            'coverLetter' => $cl,
            'body' => $processedBody
        ]);
        return $pdf->download('Cover Letter - ' . $cl->full_name . '.pdf');
    }
}
