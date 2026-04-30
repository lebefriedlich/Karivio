<?php

namespace App\Livewire\Pages;

use App\Models\EmailLog;
use App\Jobs\SendGmailJob;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Riwayat Email')]
class EmailList extends Component
{
    use WithPagination;

    public function retry($id)
    {
        $log = EmailLog::where('user_id', Auth::id())->findOrFail($id);
        
        $log->update([
            'status' => 'pending',
            'error_message' => null
        ]);

        SendGmailJob::dispatch($log);

        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Diproses!',
            'message' => 'Email sedang dikirim ulang.'
        ]);
    }

    public function cancel($id)
    {
        $log = EmailLog::where('user_id', Auth::id())->findOrFail($id);
        
        if ($log->status === 'pending') {
            $log->update(['status' => 'failed', 'error_message' => 'Dibatalkan oleh pengguna']);
            $this->dispatch('toast', [
                'type' => 'info',
                'title' => 'Dibatalkan',
                'message' => 'Pengiriman email telah dibatalkan.'
            ]);
        }
    }

    public function render()
    {
        $emailLogs = EmailLog::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('livewire.pages.email-list', [
            'emailLogs' => $emailLogs
        ]);
    }
}
