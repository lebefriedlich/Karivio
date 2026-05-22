<?php

namespace App\Livewire\CoverLetter;

use App\Models\CoverLetter;
use App\Services\DocumentStorageService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Form Cover Letter')]
class CoverLetterForm extends Component
{
    public $coverLetter = null;
    public $coverLetterId = null;

    // Form fields
    public $full_name = '';
    public $phone = '';
    public $email = '';
    public $city = '';
    public $date = '';
    public $company_name = '';
    public $company_address = '';
    public $applied_position = '';
    public $content = '';
    public $language = 'id';
    public $baseTemplate = '';

    public function mount($id = null)
    {
        $this->date = date('Y-m-d');
        $this->baseTemplate = Auth::user()->cover_letter_template ?? '';

        if ($id) {
            $this->coverLetterId = $id;
            $this->coverLetter = CoverLetter::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $this->full_name = $this->coverLetter->full_name;
            $this->phone = $this->coverLetter->phone;
            $this->email = $this->coverLetter->email;
            $this->city = $this->coverLetter->city;
            $this->date = $this->coverLetter->date;
            $this->company_name = $this->coverLetter->company_name;
            $this->company_address = $this->coverLetter->company_address;
            $this->applied_position = $this->coverLetter->applied_position;
            $this->content = $this->coverLetter->content;
            $this->language = $this->coverLetter->language ?? 'id';
        } else {
            $user = Auth::user();
            if ($user) {
                $this->full_name = $user->name ?? '';
                $this->email = $user->email ?? '';
                $this->phone = $user->phone_number ?? '';
                $this->city = $user->city ?? '';
            }
            
            $this->content = $this->baseTemplate;
            $this->syncContent();
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['applied_position', 'company_name', 'full_name', 'city', 'date', 'phone', 'email', 'company_address'])) {
            $this->syncContent();
        }
    }

    public function syncContent()
    {
        \Illuminate\Support\Facades\Log::info('Syncing content', [
            'baseTemplate' => $this->baseTemplate,
            'posisi' => $this->applied_position,
            'perusahaan' => $this->company_name
        ]);
        // Only sync if we have a base template and we are in "Create" mode or the content is still identical to processed template
        if (empty($this->baseTemplate))
            return;

        // If editing existing, we only sync if content matches processed template (meaning it hasn't been manually diverged yet)
        // But the user said "terganti otomatis", so maybe always sync if not edited manually?
        // To keep it simple and follow "terganti otomatis":
        $placeholders = [
            // Company Name
            '{{ Nama Perusahaan }}' => $this->company_name,
            '{{ Company Name }}' => $this->company_name,
            '{{ nama perusahaan / company name }}' => $this->company_name,
            
            // Position
            '{{ Posisi }}' => $this->applied_position,
            '{{ Position }}' => $this->applied_position,
            '{{ posisi / position }}' => $this->applied_position,
            '{{ Posisi yang Dilamar }}' => $this->applied_position,
            '{{ Position Applied }}' => $this->applied_position,
        ];

        // Process replacements
        $processed = $this->baseTemplate;
        foreach ($placeholders as $key => $value) {
            // Support both with and without spaces inside braces
            $keyNoSpace = str_replace(['{{ ', ' }}'], ['{{', '}}'], $key);
            $processed = str_ireplace([$key, $keyNoSpace], $value ?: $key, $processed);
        }

        $this->content = $processed;
    }

    public function updateContent()
    {
        $this->content = $this->getDefaultTemplate();
    }

    public function getDefaultTemplate()
    {
        return "";
    }

    public function save()
    {
        $validated = $this->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'date' => 'required|date',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'applied_position' => 'required|string|max:255',
            'content' => 'required|string',
            'language' => 'required|in:id,en',
        ]);

        if ($this->coverLetterId) {
            $this->coverLetter->update($validated);
            DocumentStorageService::saveCoverLetterPdf($this->coverLetter);
            session()->flash('success', 'Cover Letter berhasil diperbarui!');
            $this->dispatch('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Cover Letter telah diperbarui.'
            ]);
        } else {
            $cv = CoverLetter::create([
                ...$validated,
                'user_id' => Auth::id(),
            ]);
            $this->coverLetterId = $cv->id;
            DocumentStorageService::saveCoverLetterPdf($cv);
            session()->flash('success', 'Cover Letter berhasil dibuat!');
            return redirect()->route('cover-letter.preview', $cv->id);
        }
    }

    public function render()
    {
        return view('livewire.cover-letter.form');
    }

    public function exportPdf()
    {
        if ($this->coverLetterId) {
            $this->dispatch('toast', [
                'type' => 'info',
                'title' => 'Sedang Memproses...',
                'message' => 'PDF Anda sedang disiapkan untuk diunduh.'
            ]);
            return redirect()->route('cover-letter.export-pdf', $this->coverLetterId);
        }
    }
}
