<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app-layout', ['title'=> 'Verificar Email'])] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(route('login', absolute: false), navigate: true);
    }
}; ?>

<div class="mx-auto max-w-2xl bg-white p-6 rounded-lg shadow-xl">
    <div class="mb-4 text-gray-700">
        ¡Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar por correo electrónico? Si no recibió el correo electrónico, con gusto le enviaremos otro.
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">
            Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4">
        <button 
            type="button" 
            wire:click="sendVerification" 
            class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold inline-block px-4 py-2 text-white rounded"
        >
            Reenviar correo de verificación
        </button>

        <button wire:click="logout" type="button" class="underline text-sm text-gray-600 hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-600">
            Cerrar Sesión
        </button>
    </div>
</div>
