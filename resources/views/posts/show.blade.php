<x-app-layout title="{{ $post->title }}">
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/uploads') . '/' . $post->image }}" alt="Imagen del Post {{ $post->title }}">

            <livewire:components.like-post :post="$post" />

            <div>
                <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold">{{ $post->user->username }}</a>

                <p class="texte-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>

                <p class="mt-5">{{ $post->description }}</p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', [auth()->user(), $post]) }}" method="post">
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

                    @if (session('message'))
                        <p class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-bold">{{ session('message') }}
                        </p>
                    @endif

                    <form action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="post">
                        @csrf

                        <div class="mb-5">
                            <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">Añade un Comentario:
                            </label>

                            <textarea name="comment" id="comment" placeholder="Agrega un Comentario"
                                class="border p-3 w-full rounded-lg outline-none @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>

                            @error('comment')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full hover:cursor-pointer p-3 text-white rounded-lg">
                    </form>
                @endauth

                <div class="my-10 max-h-96 overflow-y-auto">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comment->user->username) }}"
                                    class="font-bold">{{ $comment->user->username }}</a>

                                <p class="py-1 pl-1">{{ $comment->comment }}</p>

                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aun</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>