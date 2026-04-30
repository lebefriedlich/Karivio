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

    public function mount($id = null)
    {
        $this->date = date('Y-m-d');

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
        } else {
            $this->updateContent();
        }
    }

    public function updated($propertyName)
    {
        $fields = ['full_name', 'company_name', 'applied_position'];
        if (in_array($propertyName, $fields)) {
            $this->updateContent();
        }
    }

    public function updateContent()
    {
        $template = $this->getDefaultTemplate();

        $replacements = [
            '{{ Nama Lengkap }}' => $this->full_name ?: '{{ Nama Lengkap }}',
            '{{ Nama Perusahaan }}' => $this->company_name ?: '{{ Nama Perusahaan }}',
            '{{ Posisi }}' => $this->applied_position ?: '{{ Posisi }}',
        ];

        $this->content = str_replace(array_keys($replacements), array_values($replacements), $template);
    }

    public function getDefaultTemplate()
    {
        return "Dengan hormat,

Dengan ini saya mengajukan lamaran untuk posisi {{ Posisi }} di {{ Nama Perusahaan }}. Saya merupakan mahasiswa tingkat akhir Teknik Informatika dengan pengalaman sebagai Backend Developer dalam pengembangan sistem berbasis web. Saya memiliki kompetensi dalam pengembangan dan pemeliharaan layanan backend, API integration, serta performance optimization menggunakan PHP, JavaScript, dan Go dengan framework Laravel, Express.js, dan Fastify.

Saya memiliki pengalaman profesional sebagai Backend Developer yang mencakup pengembangan dan penyempurnaan fitur backend sesuai kebutuhan bisnis, serta memastikan stabilitas, security, dan performance sistem tetap optimal. Dalam peran tersebut, saya terbiasa melakukan debugging, testing, dan deployment pada environment production, serta melakukan monitoring dan troubleshooting untuk menjaga kualitas layanan sistem. Saya juga terlibat dalam pengembangan fitur baru, peningkatan kualitas kode, serta memastikan setiap implementasi berjalan sesuai dengan standar pengembangan yang baik.

Selain itu saya juga aktif berorganisasi di bidang teknologi, dengan pengalaman sebagai leader komunitas serta terlibat sebagai speaker dan developer dalam berbagai kegiatan edukasi. Saya terlibat dalam perencanaan dan pelaksanaan program kerja, penyusunan materi teknis, serta penyampaian materi kepada peserta dalam berbagai kegiatan pengembangan kompetensi. Keterlibatan ini membantu mengembangkan kemampuan leadership, komunikasi, serta teamwork, sekaligus memperluas pemahaman saya terhadap penerapan teknologi secara praktis.

Saya juga memiliki pengalaman sebagai asisten praktikum pada mata kuliah Web Programming dan Object-Oriented Programming, dengan peran dalam membimbing mahasiswa serta membantu penyelesaian permasalahan teknis secara terstruktur. Pengalaman ini memperkuat kemampuan analisis, ketelitian, serta kemampuan dalam menjelaskan konsep teknis secara jelas dan sistematis.

Saya memiliki motivasi tinggi untuk terus mengembangkan kemampuan serta memberikan kontribusi yang optimal bagi {{ Nama Perusahaan }}. Saya meyakini bahwa kombinasi antara kemampuan teknis, pengalaman, serta keaktifan dalam organisasi teknologi dapat memberikan nilai tambah bagi perusahaan.

Sebagai bahan pertimbangan, bersama surat ini saya lampirkan CV. Besar harapan saya untuk dapat diberikan kesempatan mengikuti tahapan seleksi selanjutnya. Atas perhatian Bapak/Ibu, saya ucapkan terima kasih.

Hormat saya,

{{ Nama Lengkap }}";
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
