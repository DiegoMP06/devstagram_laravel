<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    #[Layout('layouts.app-layout', [
        'title' => 'Inicia Sesión en DevStagram',
    ])]
    
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(route('posts.index', ['user' => Auth::user()], false), true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
