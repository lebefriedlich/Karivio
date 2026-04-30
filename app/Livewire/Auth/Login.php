<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Masuk')]
class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = true;

    public function login(): void
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', 'Email atau password tidak valid.');

            return;
        }

        session()->regenerate();

        $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
