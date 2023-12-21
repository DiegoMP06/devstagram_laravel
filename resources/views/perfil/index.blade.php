@extends('layout.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow-lg p-6">
            <form action="{{ route('perfil.store') }}" method="post" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario: </label>

                    <input type="text" name="username" id="username" placeholder="Tu Nombre de Usuario" value="{{ auth()->user()->username }}"
                        class="border p-3 w-full rounded-lg outline-none  @error('username') border-red-500 @enderror">

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de Perfil: </label>

                    <input type="file" name="imagen" id="imagen" accept=".jpg, .jpeg, .png"
                        class="border-none p-3 w-full outline-none">
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email: </label>

                    <input type="email" name="email" id="email" placeholder="Tu Email" value="{{ auth()->user()->email }}"
                        class="border p-3 w-full rounded-lg outline-none  @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_actual" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual: </label>

                    <input type="password" name="password_actual" id="password_actual" placeholder="Tu Password Actual"
                        class="border p-3 w-full rounded-lg outline-none  @error('password_actual') border-red-500 @enderror">

                    @if(session('password'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('password') }}</p>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="password_nuevo" class="mb-2 block uppercase text-gray-500 font-bold">Password Nuevo: </label>

                    <input type="password" name="password_nuevo" id="password_nuevo" placeholder="Tu Password Nuevo"
                        class="border p-3 w-full rounded-lg outline-none  @error('password_nuevo') border-red-500 @enderror">

                    @error('password_nuevo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection