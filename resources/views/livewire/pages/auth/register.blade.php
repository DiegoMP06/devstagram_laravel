<div>
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-7/12 my-6">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen Registro de Usuarios">
        </div>
    
        <div class="md:w-1/3 bg-white p-6 rounded-lg shadow-xl">
            <form wire:submit="register">
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre: </label>
    
                    <input type="text" wire:model="name" id="name" placeholder="Tu Nombre" value="{{ old('name') }}"
                        class="border p-3 w-full rounded-lg outline-none @error('name') border-red-500 @enderror">
    
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario: </label>
    
                    <input type="text" wire:model="username" id="username" placeholder="Tu Nombre de Usuario"
                        value="{{ old('username') }}"
                        class="border p-3 w-full rounded-lg outline-none @error('username') border-red-500 @enderror">
    
                    @error('username')
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
                </div>
    
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password: </label>
    
                    <input type="password" wire:model="password" id="password" placeholder="Tu Password"
                        class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror">
                </div>
    
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir
                        Password: </label>
    
                    <input type="password" wire:model="password_confirmation" id="password_confirmation"
                        placeholder="Repetir Password"
                        class="border p-3 w-full rounded-lg outline-none  @error('password') border-red-500 @enderror">
    
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}</p>
                    @enderror
                </div>
    
                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer px-4 py-2 text-white rounded">
            </form>
        </div>
    </div>

    <x-auth-navigation />
</div>