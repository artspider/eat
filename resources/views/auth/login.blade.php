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

<!--                 <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div> 

                </div> a-->--}}


                <form class="xl:bg-eat-white-500 xl:rounded-3xl xl:px-20 xl:py-20 2xl:py-36" method="POST"
                    action="{{ route('login') }}">
                    @csrf
                    <h1 class="hidden xl:block text-center xl:pb-7 2xl:pt-8 xl:text-4xl font-bold text-eat-fuccia-500 ">
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
                                    class="ml-2 text-sm text-eat-white-500 xl:text-eat-fuccia-500 xl:text-lg">{{ __('Recordar cuenta') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex-col items-center justify-center mt-10 w-full">
                <x-utils.button-login color=eat-white textcolor=eat-fuccia class="w-full text-center justify-center xl:bg-eat-fuccia-500 xl:py-4 px-7 xl:text-eat-white-500 xl:text-xl xl:hover:bg-eat-fuccia-300">
                    {{ __('Login') }}
                </x-utils.button-login>
                <div class="text-center text-eat-white-700 text-xs mt-2 xl:text-lg xl:text-eat-pink-500">
                    <p >¿Tienes problemas para iniciar sesion?</p>
                    <p>Ponte en contacto con el Admin</p>
                </div>
                
            </div>
                </form>
    </x-jet-authentication-card>
</x-guest-layout>