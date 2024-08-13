@extends('layouts.app')

@section('title')
    Crea Una Nueva Publicacion
@endsection

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>

            @error('image')
                <p class="bg-red-500 text-white uppercase my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store', auth()->user()) }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Titulo: </label>

                    <input type="text" name="title" id="title" placeholder="Titulo de la Publicacion"
                        value="{{ old('title') }}"
                        class="border p-3 w-full rounded-lg outline-none @error('title') border-red-500 @enderror">

                    @error('title')
                        <p class="bg-red-500 text-white uppercase my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion: </label>

                    <textarea name="description" id="description" placeholder="Descripcion de la Publicacion"
                        class="border p-3 w-full rounded-lg outline-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="bg-red-500 text-white uppercase my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="image" id="image" value="{{ old('image') }}">
                </div>

                <input type="submit" value="Crear Publicacion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer px-2 py-2 text-white rounded">
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush