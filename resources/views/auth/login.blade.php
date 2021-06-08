<x-guest-layout>
    <x-jet-authentication-card>

       
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

           {{--  @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div> --}}

                <form class="xl:bg-eat-white-500 xl:rounded-3xl xl:px-20 xl:py-20 2xl:py-36" method="POST"
                    action="{{ route('login') }}">
                    @csrf
                    <h1 class="hidden xl:block text-center xl:pb-7 xl:text-4xl font-bold text-eat-fuccia-500 ">
                        Bienvenido a eat</h1>
                    <div class="">

                        <div>
                            <x-utils.label-login color="eat-pink" fontsize="sm" fontweight="bold" class="md:text-xl"
                                for="email" value="{{ __('Email') }}" />
                            <x-utils.input-login id="email" autocomplete="off"
                                class="inline-block mt-1 w-full md:text-xl xl:text-eat-fuccia-500 xl:font-bold xl:tracking-wide placeholder-eat-white-500 placeholder-opacity-50 xl:placeholder-eat-pink-500 xl:placeholder-opacity-40"
                                placeholder="ej: email@email.com" type="email" name="email" :value="old('email')"
                                required />
                        </div>

                        <div class="mt-4">
                            <x-utils.label-login color="eat-pink" fontsize="sm" fontweight="bold" class="md:text-xl"
                                for="password" value="{{ __('Password') }}" />
                            <x-utils.input-login id="password"
                                class="block mt-1 w-full md:text-xl placeholder-eat-white-500 xl:text-eat-fuccia-500 xl:font-bold xl:tracking-wide placeholder-opacity-50 xl:placeholder-eat-pink-500 xl:placeholder-opacity-40"
                                placeholder="ej: contraseña123" type="password" name="password" required
                                autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center text-eat-white-500">
                                <x-jet-checkbox class="xl:w-6 xl:h-6" id="remember_me" name="remember" />
                                <span
                                    class="ml-2 text-sm text-gray-600 xl:text-eat-fuccia-500 xl:text-lg">{{ __('Recordar cuenta') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif

                        <x-jet-button class="ml-4">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </form>
    </x-jet-authentication-card>
</x-guest-layout>