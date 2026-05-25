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

    public function render()
    {
        return view('livewire.auth.login');
    }
}
