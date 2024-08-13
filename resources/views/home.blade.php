<x-app-layout title="Pagina Principal">
    <x-posts-list :posts="$posts">
        <x-slot:mensaje>
            No Hay Posts, Sigue a Alguien Para Poder Motrar Sus Posts.
        </x-slot:mensaje>
    </x-posts-list>
</x-app-layout>