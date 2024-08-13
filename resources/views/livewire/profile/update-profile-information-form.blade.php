<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre es demasiado extenso.',
            'email.required' => 'El correo electronico es obligatorio.',
            'email.string' => 'El correo electronico debe ser una cadena de texto.',
            'email.lowercase' => 'El correo electronico debe estar en minúsculas.',
            'email.email' => 'El correo electronico no es valido.',
            'email.max' => 'El correo electronico es demasiado extenso.',
            'email.unique' => 'El correo electronico ya se encuentra registrado.',
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);

        Session::flash('status', 'profile-updated');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('posts.index', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Información de Perfil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Actualice la información de perfil y la dirección de correo electrónico de su cuenta.
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div class="mb-5">
            <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre: </label>

            <input type="text" wire:model="name" id="name" placeholder="Tu Nombre" value="{{ old('name') }}"
                class="border p-3 w-full rounded-lg outline-none @error('name') border-red-500 @enderror">

            @error('name')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email: </label>

            <input type="email" wire:model="email" id="email" placeholder="Tu Email" value="{{ old('email') }}"
                class="border p-3 w-full rounded-lg outline-none  @error('email') border-red-500 @enderror">

            @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
            @enderror

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Tu correo no ha sido verificado.

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Reenviar correo de verificación
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Se ha enviado un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex  flex-col gap-4">
            <input type="submit" value="Guardar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer px-4 py-2 text-white rounded">

            @if (session('status') === 'profile-updated')
                <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase"
                >Guardado.</p>
            @endif
        </div>
    </form>
</section>
