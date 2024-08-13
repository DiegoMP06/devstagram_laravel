<div class="md:hidden">
    <button type="button" class="p-1" wire:click="toggle">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
    </button>
    
    @if ($active)
        <nav class="flex fixed flex-row-reverse inset-0">
            <div class="bg-white w-72 px-4 py-6 flex flex-col shadow-lg gap-2">
                @auth
                    <a href="{{ route('posts.create', auth()->user()) }}"
                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded-sm uppercase font-bold cursor-pointer justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
    
                        Crear
                    </a>
    
                    <a href="{{ route('posts.index', auth()->user()) }}" class="font-bold text-gray-600 text-sm px-4 py-2 text-center">
                        Hola:
    
                        <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>
    
                    <input type="button" wire:click='logout' value="Cerrar Sesion"
                                class="font-bold uppercase text-gray-600 text-sm cursor-pointer px-4 py-2 hover:bg-gray-100 transition-colors">
                @endauth
    
                @guest
                    <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 px-4 py-2 text-center">Iniciar Sesion</a>
    
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 px-4 py-2 text-center">Crear Cuenta</a>
                @endguest
            </div>

            <div class="flex-1 bg-white/20" wire:click="toggle" />
        </nav>
    @endif
</div>