<?php

namespace App\Livewire\Components;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class MenuMobile extends Component
{
    public bool $active = false;

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(route('login', absolute: false), navigate: true);
    }


    public function toggle()
    {
        $this->active = !$this->active;
    }

    public function render()
    {
        return view('livewire.components.menu-mobile');
    }
}
