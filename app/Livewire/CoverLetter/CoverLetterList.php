<?php

namespace App\Livewire\CoverLetter;

use App\Models\CoverLetter;
use App\Services\DocumentStorageService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('List Cover Letter')]
class CoverLetterList extends Component
{
    protected $listeners = ['doDeleteCoverLetter' => 'delete'];

    public $showTemplateModal = false;
    public $templateContent = '';

    public function openTemplateModal()
    {
        $this->templateContent = Auth::user()->cover_letter_template ?? '';
        $this->showTemplateModal = true;
    }

    public function saveTemplate()
    {
        Auth::user()->update([
            'cover_letter_template' => $this->templateContent
        ]);

        $this->showTemplateModal = false;
        
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => __('Berhasil!'),
            'message' => __('Template Cover Letter telah disimpan.')
        ]);
    }

    public function mount($id = null)
    {
        // Handle potential route params
    }

    public function confirmDelete($id)
    {
        $cl = CoverLetter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $this->dispatch('confirm', [
            'onConfirm' => 'doDeleteCoverLetter',
            'id' => $id,
            'title' => __('Hapus Cover Letter?'),
            'message' => __('Cover Letter untuk :company akan dihapus permanen.', ['company' => $cl->company_name])
        ]);
    }

    public function delete($id = null)
    {
        // Handle array payload from Livewire.dispatch
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }

        if (!$id) return;

        $cl = CoverLetter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        DocumentStorageService::deleteCoverLetterFiles($cl);
        $cl->delete();
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => __('Dihapus!'),
            'message' => __('Cover Letter berhasil dihapus.')
        ]);
    }

    use \Livewire\WithPagination;

    public function render()
    {
        $coverLetters = CoverLetter::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->paginate(9);

        return view('livewire.cover-letter.list', [
            'coverLetters' => $coverLetters
        ]);
    }
}
