<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta http-equiv="ScreenOrientation" content="autoRotate:disabled" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>
            @isset($title)
            {{ $title }} -
            @endisset
            {{ config('app.name', 'EAT Rstaurante') }}
        </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
        @livewireStyles


        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/notifications.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    </head>

    <body class="antialiased min-h-screen lg:flex" x-data="{open: false}">
            @php
                $navlinks = [
                    [
                        "name" => "dashboard",
                        "route" => "dashboard",
                        "text" => "Dasboard",  
                        "image" => '<svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                    </svg>'
                    ],
                    [
                        "name" => "users",
                        "route" => "admin-users",
                        "text" => "Usuarios",
                        "image" => '<svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M17.997 18h-11.995l-.002-.623c0-1.259.1-1.986 1.588-2.33 1.684-.389 3.344-.736 2.545-2.209-2.366-4.363-.674-6.838 1.866-6.838 2.491 0 4.226 2.383 1.866 6.839-.775 1.464.826 1.812 2.545 2.209 1.49.344 1.589 1.072 1.589 2.333l-.002.619zm4.811-2.214c-1.29-.298-2.49-.559-1.909-1.657 1.769-3.342.469-5.129-1.4-5.129-1.265 0-2.248.817-2.248 2.324 0 3.903 2.268 1.77 2.246 6.676h4.501l.002-.463c0-.946-.074-1.493-1.192-1.751zm-22.806 2.214h4.501c-.021-4.906 2.246-2.772 2.246-6.676 0-1.507-.983-2.324-2.248-2.324-1.869 0-3.169 1.787-1.399 5.129.581 1.099-.619 1.359-1.909 1.657-1.119.258-1.193.805-1.193 1.751l.002.463z" />
                                            </svg>'
                    ],
                    [
                        "name" => "suppliers",
                        "route" => "admin-suppliers",
                        "text" => "Provedores",
                        "image" => '<svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M7 16.462l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm15-11.497l-6.5 3.468v-7.215l6.5-3.345v7.092zm-7.5-3.771v7.216l-6.458-3.445v-7.133l6.458 3.362zm-3.408-5.589l6.526 3.398-2.596 1.336-6.451-3.359 2.521-1.375zm10.381 1.415l-2.766 1.423-6.558-3.415 2.872-1.566 6.452 3.558z"/>
                                            </svg>'
                    ],
                    [
                        "name" => "products",
                        "route" => "admin-products",
                        "text" => "Productos",
                        "image" => '<svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                                    <path d="M3.114 11c-.066-.316-.104-.64-.112-.972-.062-2.402 1.452-4.495 3.595-5.262.307-2.606 2.574-4.766 5.403-4.766 2.199 0 4.258 1.336 5.082 3.504l2.918-2.918 1.413 1.413-5.94 5.94.001.001-.474.474-1.414-1.414 1.899-1.899c-.219-1.688-1.597-3.101-3.51-3.101-1.731 0-3.183 1.27-3.47 2.819 1.31.291 3.01 1.426 3.021 3.707-.982-2.06-3.533-2.36-4.846-1.604-1.252.721-1.682 1.839-1.679 3.056.001.357.06.7.167 1.022h13.648c.135-.396.2-.824.18-1.268-.041-.944-.402-1.705-.927-2.267l1.38-1.38c.965.988 1.551 2.337 1.551 3.804 0 .381-.039.753-.114 1.111h1.12c.007 3.956-2.216 7.735-7.069 9.206.086.568.96 1.558 1.531 1.794h.538c.611.015.991.413 1 1 .01.524-.439 1.002-1.006 1h-10c-.567.002-1.004-.476-.994-1 .009-.587.389-.985 1-1h.538c.571-.236 1.445-1.226 1.531-1.794-4.853-1.471-7.063-5.25-7.069-9.206h1.108zm16.688 2h-15.592l.002.008c.97 3.448 3.626 5.019 7 5.675.077.799-.014 2.497-.942 3.317h3.472c-.928-.82-1.019-2.518-.942-3.317 3.374-.656 6.03-2.227 7-5.675l.002-.008z"/>
                                                </svg>'
                    ],
                                            [
                    "name" => "menus",
                    "route" => "admin-menus",
                    "text" => "Menus",
                    "image" => '<svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M7.008 22.914c-4.134-1.896-7.008-6.072-7.008-10.914 0-6.623 5.377-12 12-12s12 5.377 12 12c0 4.439-2.415 8.318-6.002 10.394.002-5.398.004-12.809-.002-13.685-.003-.412-.3-.709-.673-.709-1.297 0-3.215 5.17-3.883 11 1.079-.003 2.056 0 2.056 0v4.482c-1.107.337-2.28.518-3.496.518-.852 0-1.683-.089-2.484-.258v-6.096c0-.585.36-.765 1.151-1.391.594-.47 1.016-1.212.935-1.963-.231-2.121-.793-6.292-.793-6.292h-.458v5h-.835l-.166-5h-.469l-.201 5h-.836l-.144-5h-.506l-.186 5h-.836v-5h-.5s-.509 4.198-.718 6.312c-.074.741.326 1.469.907 1.935.787.63 1.147.819 1.147 1.395v5.272z"/></svg>'
                    ]
                ];
                
            @endphp
        <nav class="absolute inset-0 transform lg:transform-none lg:opacity-100 duration-200 lg:relative z-10 w-full md:w-80 bg-eat-fuccia-500 text-white h-screen p-3" :class="{'translate-x-0 ease-in opacity-100':open === true, '-translate-x-full ease-out opacity-0': open === false}">
            <div class="flex justify-between">
                <div class="flex justify-center w-full">
                    <img src="{{url('/img/logo_fuccia.png')}}" class="h-20" alt="">
                </div>
                <button class="p-2 focus:outline-none focus:bg-indigo-800 hover:bg-indigo-800 rounded-md lg:hidden" @click="open = false">
                    <x-icons.close></x-icons.close>
                </button>
            </div>
            <ul class="mt-8">
                <!-- <li>
                    <a href="#" class="block px-4 py-2 hover:bg-indigo-800 rounded-md">Home</a>
                    <a href="#" class="block px-4 py-2 hover:bg-indigo-800 rounded-md">About</a>
                    <a href="#" class="block px-4 py-2 hover:bg-indigo-800 rounded-md">Products</a>
                    <a href="#" class="block px-4 py-2 hover:bg-indigo-800 rounded-md">Pricing</a>
                </li> -->

                @foreach ($navlinks as $link)
					<x-utils.menu-item :routeInMenu="$link['route']" class="text-white!important hover:text-white">
						<x-slot name="image">
							{!! $link['image'] !!}
						</x-slot>						
						<x-utils.text-menu>{{$link['text']}}</x-utils.text-menu>
					</x-utils.menu-item>						
				@endforeach

                <div class="pb-4 text-white hover:text-eat-pink-500">
					<div class="block px-4 py-2 hover:bg-white rounded-md">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-auth.logout />
                        </form>
                    </div>
				</div>
            </ul>
        </nav>
        <div class="relative z-0 lg:flex-grow">
            <header class="flex bg-eat-green-500 text-white items-center px-3 text-2xl sm:text-3xl font-bold p-4 justify-end">
                <button class="p-2 focus:outline-none focus:bg-eat-green-500 hover:bg-eat-green-600 rounded-md lg:hidden" @click="open = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>


				<div class=" hidden lg:flex justify-between items-center mr-8">
					<div class="mr-8 relative ">
						<input class="rounded-lg shadow-lg pl-10 border border-transparent focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent -full bg-eat-white-500" type="text">
						<x-icons.search />
					</div>
					<x-icons.messages class="text-eat-olive-50 mr-5" />
					<x-icons.notifications/>
					<div class="mx-5">
						<img class=" rounded-full w-12 h-12 bg-cover " src="https://i.pravatar.cc/40" alt="">
					</div>
				</div>

                
            </header>
            <main class="mx-6 mt-6">
				{{$slot}}
			</main>
        </div>


        {{-- <script src="{{ mix('js/alpine-functions.js') }}"></script> --}}
        @livewireScripts
        @stack('modals')
    </body>
</html>