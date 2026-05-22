<?php

namespace App\Livewire\Cv;

use App\Models\Cv;
use App\Services\DocumentStorageService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('List CV')]
class CvList extends Component
{
    use \Livewire\WithPagination;

    protected $listeners = ['doDeleteCv' => 'deleteCv'];

    public function mount($cvId = null)
    {
    }

    public function confirmDelete($id)
    {
        $cv = Cv::find($id);
        if ($cv && $cv->user_id === auth()->id()) {
            $this->dispatch('confirm', [
                'onConfirm' => 'doDeleteCv',
                'id' => $id,
                'title' => __('Hapus CV?'),
                'message' => __('CV :name akan dihapus permanen.', ['name' => $cv->full_name])
            ]);
        }
    }

    public function deleteCv($id = null)
    {
        // Handle array payload from Livewire.dispatch
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }

        if (!$id) return;

        $cv = Cv::find($id);
        if ($cv && $cv->user_id === auth()->id()) {
            DocumentStorageService::deleteCvFiles($cv);
            $cv->delete();
            $this->dispatch('toast', [
                'type' => 'success',
                'title' => __('Dihapus!'),
                'message' => __('CV berhasil dihapus secara permanen.')
            ]);
        }
    }

    public function render()
    {
        return view('livewire.cv.cv-list', [
            'cvs' => Cv::where('user_id', auth()->id())->latest()->paginate(9)
        ]);
    }
}
