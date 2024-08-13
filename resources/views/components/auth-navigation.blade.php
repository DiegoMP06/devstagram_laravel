<nav class="flex flex-col md:flex-row justify-evenly items-center gap-4 my-10">
    <a href="{{ route('register') }}" class="underline text-center text-gray-600 hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-600">
        ¿No tienes una cuenta? Crea Una
    </a>

    <a href="{{ route('password.request') }}" class="underline text-center text-gray-600 hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-600">
        ¿Olvidaste tu contraseña de cuenta? Reestablecela
    </a>

    <a href="{{ route('login') }}" class="underline text-center text-gray-600 hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-600">
        ¿Ya tenes una cuenta? Inicia Sesión
    </a>
</nav>