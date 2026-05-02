<?php

namespace App\Livewire\Cv;

use App\Models\Cv;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Pratinjau CV')]
class CvPreview extends Component
{
    public $cv;
    public $pdfUrl;
    public $hasPdf = false;

    public function mount($cvId)
    {
        $this->cv = Cv::findOrFail($cvId);

        if ($this->cv->user_id !== auth()->id()) {
            abort(403);
        }

        $filename = 'CV_' . str_replace(' ', '_', $this->cv->full_name) . '_' . $this->cv->id . '.pdf';
        $path = 'users/' . $this->cv->user_id . '/cvs/' . $filename;
        
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            $this->hasPdf = true;
            $this->pdfUrl = asset('storage/users/' . $this->cv->user_id . '/cvs/' . $filename) . '#toolbar=0&navpanes=0';
        }
    }

    public function exportPdf()
    {
        $this->dispatch('toast', [
            'type' => 'info',
            'title' => 'Sedang Memproses...',
            'message' => 'PDF Anda sedang disiapkan untuk diunduh.'
        ]);
        return redirect()->route('cv.export-pdf', $this->cv->id);
    }

    public function render()
    {
        return view('livewire.cv.cv-preview');
    }
}
