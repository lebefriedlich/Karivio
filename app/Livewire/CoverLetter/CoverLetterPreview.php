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

    public function mount($id)
    {
        $this->coverLetter = CoverLetter::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->processedContent = $this->processTemplate($this->coverLetter->content);
    }

    private function processTemplate($content)
    {
        $placeholders = [
            '{{ Nama Lengkap }}' => $this->coverLetter->full_name,
            '{{ Telepon }}' => $this->coverLetter->phone,
            '{{ Email }}' => $this->coverLetter->email,
            '{{ Kota }}' => $this->coverLetter->city,
            '{{ Tanggal }}' => $this->formatDate($this->coverLetter->date),
            '{{ Nama Perusahaan }}' => $this->coverLetter->company_name,
            '{{ Alamat Perusahaan }}' => $this->coverLetter->company_address,
            '{{ Posisi }}' => $this->coverLetter->applied_position,
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
