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

    public function mount($cvId)
    {
        $this->cv = Cv::findOrFail($cvId);

        if ($this->cv->user_id !== auth()->id()) {
            abort(403);
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
