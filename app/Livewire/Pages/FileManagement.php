<?php

namespace App\Livewire\Pages;

use App\Models\Cv;
use App\Models\CoverLetter;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('File Saya')]
class FileManagement extends Component
{
    use \Livewire\WithPagination;

    public function render()
    {
        $userId = Auth::id();

        // Get CVs
        $cvs = Cv::where('user_id', $userId)
            ->latest()
            ->get()
            ->map(function ($cv) {
                return [
                    'id' => $cv->id,
                    'type' => 'CV',
                    'title' => $cv->full_name,
                    'subtitle' => $cv->email,
                    'date' => $cv->updated_at,
                    'route_preview' => route('cv.preview', $cv->id),
                    'route_edit' => route('cv.form', $cv->id),
                    'route_export' => route('cv.export-pdf', $cv->id),
                    'icon' => 'ri-file-user-line',
                    'color' => 'indigo',
                    'language' => $cv->language ?? 'id'
                ];
            });

        // Get Cover Letters
        $coverLetters = CoverLetter::where('user_id', $userId)
            ->latest()
            ->get()
            ->map(function ($cl) {
                return [
                    'id' => $cl->id,
                    'type' => 'Cover Letter',
                    'title' => $cl->company_name,
                    'subtitle' => $cl->applied_position,
                    'date' => $cl->updated_at,
                    'route_preview' => route('cover-letter.preview', $cl->id),
                    'route_edit' => route('cover-letter.form', $cl->id),
                    'route_export' => route('cover-letter.export-pdf', $cl->id),
                    'icon' => 'ri-mail-send-line',
                    'color' => 'indigo'
                ];
            });

        // Merge and sort
        $allFiles = $cvs->concat($coverLetters)->sortByDesc('date');

        // Manual Pagination
        $page = $this->getPage();
        $perPage = 9;
        
        $files = new \Illuminate\Pagination\LengthAwarePaginator(
            $allFiles->forPage($page, $perPage),
            $allFiles->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Support\Facades\Request::url(), 'query' => \Illuminate\Support\Facades\Request::query()]
        );

        return view('livewire.pages.file-management', [
            'files' => $files
        ]);
    }

    public function export($type, $id)
    {
        $this->dispatch('toast', [
            'type' => 'info',
            'title' => __('Sedang Memproses...'),
            'message' => __('PDF Anda sedang disiapkan untuk diunduh.')
        ]);

        if ($type === 'CV') {
            return redirect()->route('cv.export-pdf', $id);
        } else {
            return redirect()->route('cover-letter.export-pdf', $id);
        }
    }
}
