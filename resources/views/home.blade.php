@extends('layout.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts">
        <x-slot:mensaje>
            No Hay Posts, Sigue a Alguien Para Poder Motrar Sus Posts.
        </x-slot:mensaje>
    </x-listar-post>
@endsection