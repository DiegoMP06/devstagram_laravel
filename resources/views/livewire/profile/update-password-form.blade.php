<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ], [
                'current_password.required' => 'La contraseña actual es obligatoria.',
                'current_password.string' => 'La contraseña actual debe ser una cadena de texto.',
                'current_password.current_password' => 'La contraseña actual es incorrecta.',
                'password.required' => 'La nueva contraseña es obligatoria.',
                'password.string' => 'La nueva contraseña debe ser una cadena de texto.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');

        session()->flash('status', 'password-updated');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Actualizar Contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div class="mb-5">
            <label for="current_password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual: </label>

            <input type="password" wire:model="current_password" id="current_password" placeholder="Tu Password"
                class="border p-3 w-full rounded-lg outline-none  @error('current_password') border-red-500 @enderror">

            @error('current_password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password: </label>

            <input type="password" wire:model="password" id="password" placeholder="Tu Password"
                class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror">

            @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir
                Password: </label>

            <input type="password" wire:model="password_confirmation" id="password_confirmation"
                placeholder="Repetir Password"
                class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror">

            @error('password_confirmation')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 flex-col">
            <input type="submit" value="Guardar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer px-4 py-2 text-white rounded">

            @if (session('status') === 'password-updated')
                <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase"
                >Guardado.</p>
            @endif
        </div>
    </form>
</section>
