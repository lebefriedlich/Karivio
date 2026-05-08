<?php

namespace App\Livewire\CoverLetter;

use App\Models\CoverLetter;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Pratinjau Cover Letter')]
class CoverLetterPreview extends Component
{
    public $coverLetter;
    public $processedContent;
    public $pdfUrl;
    public $hasPdf = false;

    public function mount($id)
    {
        $this->coverLetter = CoverLetter::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->processedContent = $this->coverLetter->getProcessedContent();

        $filename = 'Cover_Letter_' . str_replace(' ', '_', $this->coverLetter->company_name) . '_' . $this->coverLetter->id . '.pdf';
        $path = 'users/' . $this->coverLetter->user_id . '/cover_letters/' . $filename;
        
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            $this->hasPdf = true;
            $this->pdfUrl = asset('storage/users/' . $this->coverLetter->user_id . '/cover_letters/' . $filename) . '#toolbar=0&navpanes=0';
        }
    }

    private function processTemplate($content)
    {
        $placeholders = [
            '{{ Nama Lengkap }}' => $this->coverLetter->full_name,
            '{{ Full Name }}' => $this->coverLetter->full_name,
            '{{ Telepon }}' => $this->coverLetter->phone,
            '{{ Phone }}' => $this->coverLetter->phone,
            '{{ Email }}' => $this->coverLetter->email,
            '{{ Kota }}' => $this->coverLetter->city,
            '{{ City }}' => $this->coverLetter->city,
            '{{ Tanggal }}' => $this->formatDate($this->coverLetter->date),
            '{{ Date }}' => $this->formatDate($this->coverLetter->date),
            '{{ Nama Perusahaan }}' => $this->coverLetter->company_name,
            '{{ Company Name }}' => $this->coverLetter->company_name,
            '{{ Alamat Perusahaan }}' => $this->coverLetter->company_address,
            '{{ Company Address }}' => $this->coverLetter->company_address,
            '{{ Posisi }}' => $this->coverLetter->applied_position,
            '{{ Position }}' => $this->coverLetter->applied_position,
        ];

        return str_replace(array_keys($placeholders), array_values($placeholders), $content);
    }

    private function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
    }

    public function render()
    {
        return view('livewire.cover-letter.preview');
    }

    public function exportPdf()
    {
        $this->dispatch('toast', [
            'type' => 'info',
            'title' => 'Sedang Memproses...',
            'message' => 'PDF Anda sedang disiapkan untuk diunduh.'
        ]);
        return redirect()->route('cover-letter.export-pdf', $this->coverLetter->id);
    }
}
