<x-guest-layout>
    <div class="w-full px-8 md:px-32 lg:px-24">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Su cuenta ha sido bloqueada? No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un mail para desbloquear su cuenta.') }}
        </div>
        <form method="POST" action="{{ route('unlock.send') }}" class="bg-white rounded-md shadow-2xl p-5">
            @csrf
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                <input id="email" class=" pl-2 w-full outline-none border-none" type="email" name="email"
                    :value="old('email')" required placeholder="Correo Electronico" autofocus required
                    autocomplete="username" />
            </div>
            <button type="submit"
                class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2">Enviar
                Correo</button>

        </form>
    </div>
</x-guest-layout>
