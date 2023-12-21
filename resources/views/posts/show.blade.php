@extends('layout.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->titulo }}">

            <livewire:like-post :post="$post" />

            <div>
                <a href="{{ route('post.index', $post->user->username) }}" class="font-bold">{{ $post->user->username }}</a>

                <p class="texte-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>

                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('post.destroy', $post) }}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Eliminar Publicacion"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold my-4 cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega Un Nuevo Comentario: </p>

                    @if (session('mensaje'))
                        <p class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-bold">{{ session('mensaje') }}
                        </p>
                    @endif

                    <form action="{{ route('comentarios.store', ['user' => $user, 'post' => $post]) }}" method="post">
                        @csrf

                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un Comentario:
                            </label>

                            <textarea name="comentario" id="comentario" placeholder="Agrega un Comentario"
                                class="border p-3 w-full rounded-lg outline-none @error('comentario') border-red-500 @enderror">{{ old('comentario') }}</textarea>

                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer p-3 text-white rounded-lg">
                    </form>
                @endauth

                <div class="my-10 max-h-96 overflow-y-auto">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('post.index', $comentario->user->username) }}"
                                    class="font-bold">{{ $comentario->user->username }}</a>

                                <p class="py-1 pl-1">{{ $comentario->comentario }}</p>

                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aun</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
