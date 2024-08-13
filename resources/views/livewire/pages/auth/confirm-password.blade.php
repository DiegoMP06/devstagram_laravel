<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app-layout', ['title'=> 'Confirmar Contraseña'])] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ], [
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => 'LA CONTRASEÑA PROPORCIONADA ES INCORRECTA',
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('posts.index', ['user' => Auth::user()], absolute: false), navigate: true);
    }
}; ?>

<div class="mx-auto max-w-2xl bg-white p-6 rounded-lg shadow-xl">
    <div class="mb-4 text-gray-700">
        Esta es un área segura de la aplicación. Confirme su contraseña antes de continuar.
    </div>

    <form wire:submit="confirmPassword">
        <div class="mb-5">
            <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password: </label>

            <input type="password" wire:model="password" id="password"
                placeholder="Repetir Password"
                class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror">

            @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" value="restablecer contraseña"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer p-3 text-white rounded">
    </form>
</div>
