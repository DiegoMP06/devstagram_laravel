<div>
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-7/12 my-6">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Login de Usuarios">
        </div>
    
        <div class="md:w-1/3 bg-white p-6 rounded-lg shadow-xl">
            <form wire:submit="login">
                @if (session('status'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ session('status') }}</p>
                @endif
    
                <div class="mb-5">
                    <label for="form.email" class="mb-2 block uppercase text-gray-500 font-bold">Email: </label>
    
                    <input type="email" wire:model="form.email" id="form.email" placeholder="Tu Email" value="{{ old('email') }}"
                        class="border p-3 w-full rounded-lg outline-none  @error('form.email') border-red-500 @enderror">
    
                    @error('form.email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-5">
                    <label for="form.password" class="mb-2 block uppercase text-gray-500 font-bold">Password: </label>
    
                    <input type="password" wire:model="form.password" id="form.password" placeholder="Tu Password"
                        class="border p-3 w-full rounded-lg outline-none  @error('form.password') border-red-500 @enderror">
    
                    @error('form.password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-5">
                    <input type="checkbox" wire:model="form.remember" id="form.remember" />
                    <label for="form.remember" class="text-gray-500 font-bold text-sm">Mantener Mi Sesion Abierta</label>
                </div>
    
                <input type="submit" value="Iniciar Sesion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer px-4 py-2 text-white rounded">
            </form>
        </div>
    </div>
    
    <x-auth-navigation />
</div>


