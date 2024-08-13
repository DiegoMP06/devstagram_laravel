<?php

namespace App\Livewire\Components;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class LogoutButton extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(route('login', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.components.logout-button');
    }
}
