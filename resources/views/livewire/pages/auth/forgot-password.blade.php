<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app-layout', ['title' => '¿Olvidaste tu contraseña?'])] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.string' => 'El email debe ser una cadena de texto.',
            'email.email' => 'El email no es valido.',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>
<div>
    <div class="mx-auto max-w-2xl bg-white p-6 rounded-lg shadow-xl">
        <div class="mb-4 text-gray-700">
            ¿Olvidaste tu contraseña? Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.
        </div>

        @if (session('status'))
            <div class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="sendPasswordResetLink">
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email: </label>
                <input type="email" wire:model="email" id="email" placeholder="Tu Email" value="{{ old('email') }}"
                    class="border p-3 w-full rounded-lg outline-none  @error('email') border-red-500 @enderror">

                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
                @enderror
            </div>

            <input type="submit" value="Enlace para restablecer contraseña de correo electrónico"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer p-3 text-white rounded">
        </form>
    </div>
    
    <x-auth-navigation />
</div>