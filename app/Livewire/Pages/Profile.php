<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name;
    public $email;
    public $phone_number;
    public $city;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->city = $user->city;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'city' => $this->city,
        ]);

        $this->dispatch('toast', [
            'type' => 'success',
            'title' => __('Berhasil!'),
            'message' => __('Profil berhasil diperbarui.'),
        ]);
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
