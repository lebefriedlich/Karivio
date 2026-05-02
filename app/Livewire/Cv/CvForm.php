<?php

namespace App\Livewire\Cv;

use App\Models\Cv;
use App\Services\DocumentStorageService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Form CV')]
class CvForm extends Component
{
    public $cv = null;

    // Personal Information
    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $location = '';
    public $professional_summary = '';
    public $linkedin_url = '';
    public $portfolio_url = '';

    // Pengalaman Profesional
    public $work_experiences = [];
    public $current_work = [
        'company' => '',
        'position' => '',
        'start_date' => '',
        'end_date' => '',
        'is_current' => false,
        'description' => '',
    ];

    // Skill
    public $hard_skills = [];
    public $current_hard_skill = [
        'category' => '',
        'skills' => '',
    ];
    public $soft_skills = [];
    public $current_soft_skill = '';

    // Education
    public $education = [];
    public $current_education = [
        'institution' => '',
        'start_date' => '',
        'end_date' => '',
        'is_current' => false,
        'major' => '',
        'score' => '',
    ];

    // Organization Experiences
    public $organization_experiences = [];
    public $current_org = [
        'organization' => '',
        'role' => '',
        'start_date' => '',
        'end_date' => '',
        'is_current' => false,
        'description' => '',
    ];

    // Languages
    public $languages = [];
    public $current_language = [
        'language' => '',
        'proficiency' => 'Menengah',
    ];

    // Assistance Experiences
    public $assistance_experiences = [];
    public $current_assistance = [
        'role' => '',
        'location' => '',
        'start_date' => '',
        'end_date' => '',
        'is_current' => false,
        'description' => '',
    ];

    public $cvId = null;

    public function mount($cvId = null)
    {
        $this->cv = null;

        if ($cvId) {
            $this->cvId = $cvId;
            $cv = Cv::where('id', $cvId)
                ->where('user_id', Auth::id())
                ->first();

            if (!$cv) {
                abort(403);
            }

            if ($cv) {
                $this->cv = $cv;
                $this->full_name = $cv->full_name;
                $this->email = $cv->email;
                $this->phone = $cv->phone;
                $this->location = $cv->location;
                $this->professional_summary = $cv->professional_summary;
                $this->linkedin_url = $cv->linkedin_url;
                $this->portfolio_url = $cv->portfolio_url;
                $this->work_experiences = $cv->work_experiences ?? [];
                
                // Normalisasi Hard Skills (handle data lama string vs data baru object)
                $rawHardSkills = $cv->technical_skills ?? [];
                $this->hard_skills = collect($rawHardSkills)->map(function($item) {
                    return is_array($item) ? $item : ['category' => 'Skill', 'skills' => $item];
                })->toArray();

                $this->soft_skills = $cv->soft_skills ?? [];
                $this->education = $cv->education ?? [];
                $this->organization_experiences = $cv->organization_experiences ?? [];
                $this->languages = $cv->languages ?? [];
                $this->assistance_experiences = $cv->assistance_experiences ?? [];
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'current_work.is_current' && $this->current_work['is_current']) {
            $this->current_work['end_date'] = '';
        }
        if ($propertyName === 'current_education.is_current' && $this->current_education['is_current']) {
            $this->current_education['end_date'] = '';
        }
        if ($propertyName === 'current_org.is_current' && $this->current_org['is_current']) {
            $this->current_org['end_date'] = '';
        }
        if ($propertyName === 'current_assistance.is_current' && $this->current_assistance['is_current']) {
            $this->current_assistance['end_date'] = '';
        }
    }

    public function addWorkExperience()
    {
        if ($this->current_work['company'] && $this->current_work['position']) {
            $this->work_experiences[] = $this->current_work;
            $this->current_work = [
                'company' => '',
                'position' => '',
                'start_date' => '',
                'end_date' => '',
                'is_current' => false,
                'description' => '',
            ];
        }
    }

    public function removeWorkExperience($index)
    {
        unset($this->work_experiences[$index]);
        $this->work_experiences = array_values($this->work_experiences);
    }

    public function editWorkExperience($index)
    {
        $this->current_work = $this->work_experiences[$index];
        $this->removeWorkExperience($index);
    }

    public function addHardSkill()
    {
        if ($this->current_hard_skill['category'] && $this->current_hard_skill['skills']) {
            $this->hard_skills[] = $this->current_hard_skill;
            $this->current_hard_skill = [
                'category' => '',
                'skills' => '',
            ];
        }
    }

    public function removeHardSkill($index)
    {
        unset($this->hard_skills[$index]);
        $this->hard_skills = array_values($this->hard_skills);
    }

    public function editHardSkill($index)
    {
        $this->current_hard_skill = $this->hard_skills[$index];
        $this->removeHardSkill($index);
    }

    public function addSoftSkill()
    {
        if ($this->current_soft_skill) {
            $this->soft_skills[] = $this->current_soft_skill;
            $this->current_soft_skill = '';
        }
    }

    public function removeSoftSkill($index)
    {
        unset($this->soft_skills[$index]);
        $this->soft_skills = array_values($this->soft_skills);
    }

    public function addEducation()
    {
        if ($this->current_education['institution'] && $this->current_education['major']) {
            $this->education[] = $this->current_education;
            $this->current_education = [
                'institution' => '',
                'start_date' => '',
                'end_date' => '',
                'is_current' => false,
                'major' => '',
                'score' => '',
            ];
        }
    }

    public function removeEducation($index)
    {
        unset($this->education[$index]);
        $this->education = array_values($this->education);
    }

    public function editEducation($index)
    {
        $this->current_education = $this->education[$index];
        $this->removeEducation($index);
    }

    public function addOrganization()
    {
        if ($this->current_org['organization'] && $this->current_org['role']) {
            $this->organization_experiences[] = $this->current_org;
            $this->current_org = [
                'organization' => '',
                'role' => '',
                'start_date' => '',
                'end_date' => '',
                'is_current' => false,
                'description' => '',
            ];
        }
    }

    public function removeOrganization($index)
    {
        unset($this->organization_experiences[$index]);
        $this->organization_experiences = array_values($this->organization_experiences);
    }

    public function editOrganization($index)
    {
        $this->current_org = $this->organization_experiences[$index];
        $this->removeOrganization($index);
    }

    public function addLanguage()
    {
        if ($this->current_language['language']) {
            $this->languages[] = $this->current_language;
            $this->current_language = [
                'language' => '',
                'proficiency' => 'Menengah',
            ];
        }
    }

    public function removeLanguage($index)
    {
        unset($this->languages[$index]);
        $this->languages = array_values($this->languages);
    }

    public function editLanguage($index)
    {
        $this->current_language = $this->languages[$index];
        $this->removeLanguage($index);
    }

    public function addAssistance()
    {
        if ($this->current_assistance['role'] && $this->current_assistance['location']) {
            $this->assistance_experiences[] = $this->current_assistance;
            $this->current_assistance = [
                'role' => '',
                'location' => '',
                'start_date' => '',
                'end_date' => '',
                'is_current' => false,
                'description' => '',
            ];
        }
    }

    public function removeAssistance($index)
    {
        unset($this->assistance_experiences[$index]);
        $this->assistance_experiences = array_values($this->assistance_experiences);
    }

    public function editAssistance($index)
    {
        $this->current_assistance = $this->assistance_experiences[$index];
        $this->removeAssistance($index);
    }

    public function saveCv()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
            return redirect()->route('login');
        }

        $this->work_experiences = $this->sortByDate($this->work_experiences);
        $this->education = $this->sortByDate($this->education);
        $this->organization_experiences = $this->sortByDate($this->organization_experiences);
        $this->assistance_experiences = $this->sortByDate($this->assistance_experiences);

        $validated = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
            'professional_summary' => $this->professional_summary,
            'linkedin_url' => $this->linkedin_url,
            'portfolio_url' => $this->portfolio_url,
            'work_experiences' => $this->work_experiences,
            'technical_skills' => $this->hard_skills,
            'soft_skills' => $this->soft_skills,
            'education' => $this->education,
            'organization_experiences' => $this->organization_experiences,
            'languages' => $this->languages,
            'assistance_experiences' => $this->assistance_experiences,
        ];

        if ($this->cvId) {
            $cv = Cv::where('id', $this->cvId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $cv->update($validated);
            $this->cv = $cv->fresh();
            DocumentStorageService::saveCvPdf($cv);
            $this->dispatch('cv-saved', id: $cv->id);
        } else {
            $cv = Cv::create([
                ...$validated,
                'user_id' => Auth::id(),
            ]);
            $this->cvId = $cv->id;
            $this->cv = $cv;
            DocumentStorageService::saveCvPdf($cv);
            $this->dispatch('cv-saved', id: $cv->id);
        }

        session()->flash('success', 'CV berhasil disimpan!');
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'message' => 'Data CV Anda telah diperbarui.'
        ]);
    }

    public function exportPdf()
    {
        if (!$this->cvId) {
            $this->dispatch('toast', [
                'type' => 'error',
                'title' => 'Gagal!',
                'message' => 'Silakan simpan CV terlebih dahulu sebelum export!'
            ]);
            return;
        }

        $this->saveCv();
        $this->dispatch('toast', [
            'type' => 'info',
            'title' => 'Sedang Memproses...',
            'message' => 'PDF Anda sedang disiapkan untuk diunduh.'
        ]);
        return redirect()->route('cv.export-pdf', $this->cvId);
    }

    private function sortByDate($array)
    {
        return collect($array)->sort(function($a, $b) {
            // "Present" (is_current) always at the top
            $aCurrent = $a['is_current'] ?? false;
            $bCurrent = $b['is_current'] ?? false;

            if ($aCurrent && !$bCurrent) return -1;
            if (!$aCurrent && $bCurrent) return 1;

            // Otherwise sort by start_date descending
            return ($b['start_date'] ?? '') <=> ($a['start_date'] ?? '');
        })->values()->toArray();
    }

    public function render()
    {
        return view('livewire.cv.cv-form');
    }
}
