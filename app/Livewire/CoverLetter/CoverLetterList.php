<?php

namespace App\Livewire\CoverLetter;

use App\Models\CoverLetter;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Daftar Cover Letter')]
class CoverLetterList extends Component
{
    protected $listeners = ['doDeleteCoverLetter' => 'delete'];

    public function confirmDelete($id)
    {
        $cl = CoverLetter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $this->dispatch('confirm', [
            'onConfirm' => 'doDeleteCoverLetter',
            'id' => $id,
            'title' => 'Hapus Cover Letter?',
            'message' => 'Cover Letter untuk ' . $cl->company_name . ' akan dihapus permanen.'
        ]);
    }

    public function delete($id)
    {
        $cl = CoverLetter::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cl->delete();
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Dihapus!',
            'message' => 'Cover Letter berhasil dihapus.'
        ]);
    }

    public function render()
    {
        $coverLetters = CoverLetter::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('livewire.cover-letter.list', [
            'coverLetters' => $coverLetters
        ]);
    }
}
