<?php

namespace App\Livewire\Pages;

use App\Models\Cv;
use App\Models\CoverLetter;
use App\Models\EmailLog;
use App\Jobs\SendGmailJob;
use App\Services\GmailService;
use App\Services\DocumentStorageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Tulis Lamaran')]
class SendEmail extends Component
{
    use WithFileUploads;

    public $to = '';
    public $subject = '';
    public $body = '';
    
    // Placeholder fields
    public $name = '';
    public $position = '';
    public $company_name = '';
    public $scheduled_at = ''; // New field for scheduling

    // Attachments
    public $allSystemFiles = [];
    public $selectedSystemFileIds = [];
    public $externalFiles = [];

    // History
    public $emailLogs = [];

    public function mount($type = null, $id = null)
    {
        $user = Auth::user();
        $this->name = $user->name;

        $this->loadSystemFiles();

        // Pre-select if coming from a specific file
        if ($type && $id && !in_array($type, ['compose', 'new'])) {
            $this->selectedSystemFileIds[] = $type . '_' . $id;
            
            if ($type === 'cv') {
                $cv = Cv::find($id);
                if ($cv) $this->position = '';
            } else if ($type === 'cl') {
                $cl = CoverLetter::find($id);
                if ($cl) {
                    $this->company_name = $cl->company_name;
                    $this->position = $cl->applied_position;
                }
            }
        }

        $this->updateBody();
    }

    public function loadSystemFiles()
    {
        $user = Auth::user();
        $cvs = Cv::where('user_id', $user->id)->latest()->get()->map(function($cv) {
            return [
                'id' => 'cv_' . $cv->id,
                'real_id' => $cv->id,
                'type' => 'cv',
                'name' => 'CV - ' . $cv->full_name,
                'path' => 'public/users/' . Auth::id() . '/cvs/CV_' . str_replace(' ', '_', $cv->full_name) . '_' . $cv->id . '.pdf'
            ];
        });

        $cls = CoverLetter::where('user_id', $user->id)->latest()->get()->map(function($cl) {
            return [
                'id' => 'cl_' . $cl->id,
                'real_id' => $cl->id,
                'type' => 'cl',
                'name' => 'CL - ' . $cl->company_name,
                'path' => 'public/users/' . Auth::id() . '/cover_letters/Cover_Letter_' . str_replace(' ', '_', $cl->company_name) . '_' . $cl->id . '.pdf'
            ];
        });

        $this->allSystemFiles = $cvs->concat($cls)->toArray();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['name', 'position', 'company_name'])) {
            $this->updateBody();
        }
    }

    public function updateBody()
    {
        $template = "Kepada\nBapak/ Ibu HRD\n{{Nama Perusahaan}}\n \nDengan Hormat,\n\nPerkenalkan, saya {{Nama}} ingin mengajukan lamaran untuk posisi {{Nama Posisi}} di {{Nama Perusahaan}}. Saya tertarik dengan peran ini karena saya percaya bahwa pengalaman dan keterampilan saya relevan dengan {{Nama Posisi}}.\nSaya telah melampirkan dokumen saya untuk referensi lebih lanjut. Saya berharap dapat memiliki kesempatan untuk berdiskusi lebih lanjut tentang bagaimana saya dapat berkontribusi pada tim Bapak/Ibu.\nTerima kasih atas perhatian Bapak/Ibu. \n\nHormat saya,\n\n{{Nama}}";

        $this->body = str_replace(
            ['{{Nama}}', '{{Nama Posisi}}', '{{Nama Perusahaan}}'],
            [$this->name ?: '{{ Nama }}', $this->position ?: '{{ Nama Posisi }}', $this->company_name ?: '{{ Nama Perusahaan }}'],
            $template
        );
    }

    public function send()
    {
        $this->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        try {
            $attachments = [];

            // Add selected system files
            foreach ($this->allSystemFiles as $file) {
                if (in_array($file['id'], $this->selectedSystemFileIds)) {
                    if (!Storage::exists($file['path'])) {
                        if ($file['type'] === 'cv') {
                            $doc = Cv::find($file['real_id']);
                            DocumentStorageService::saveCvPdf($doc);
                        } else {
                            $doc = CoverLetter::find($file['real_id']);
                            DocumentStorageService::saveCoverLetterPdf($doc);
                        }
                    }
                    $attachments[] = [
                        'path' => $file['path'],
                        'name' => ($file['type'] === 'cv' ? 'CV - ' : 'Cover Letter - ') . $this->name . '.pdf'
                    ];
                }
            }

            // Add external uploaded files
            foreach ($this->externalFiles as $file) {
                $path = $file->store('public/temp_attachments');
                $attachments[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName()
                ];
            }

            // Create Log
            $log = EmailLog::create([
                'user_id' => Auth::id(),
                'to' => $this->to,
                'subject' => $this->subject,
                'body' => nl2br($this->body),
                'attachments' => $attachments,
                'status' => 'pending',
                'scheduled_at' => $this->scheduled_at ? \Carbon\Carbon::parse($this->scheduled_at) : null,
            ]);

            // Dispatch Job
            if ($this->scheduled_at) {
                $delay = \Carbon\Carbon::parse($this->scheduled_at);
                if ($delay->isPast()) {
                    SendGmailJob::dispatch($log);
                } else {
                    SendGmailJob::dispatch($log)->delay($delay);
                }
            } else {
                SendGmailJob::dispatch($log);
            }

            $isScheduled = !empty($this->scheduled_at) && \Carbon\Carbon::parse($this->scheduled_at)->isFuture();
            $this->externalFiles = [];
            $this->to = '';
            $this->scheduled_at = '';
            
            session()->flash('success', $isScheduled ? 'Email berhasil dijadwalkan!' : 'Email sedang dikirim!');
            
            return redirect()->route('email.list');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memproses email: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.send-email');
    }
}
