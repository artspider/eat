<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

<body
	class="bg-eat-white-500 h-screen antialiased leading-none scrollbar scrollbar-thin scrollbar-thumb-eat-fuccia-500 scrollbar-track-eat-olive-50">
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
				"name" => "providers",
				"route" => "admin-providers",
				"text" => "Provedores",
				"image" => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M7 16.462l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm15-11.497l-6.5 3.468v-7.215l6.5-3.345v7.092zm-7.5-3.771v7.216l-6.458-3.445v-7.133l6.458 3.362zm-3.408-5.589l6.526 3.398-2.596 1.336-6.451-3.359 2.521-1.375zm10.381 1.415l-2.766 1.423-6.558-3.415 2.872-1.566 6.452 3.558z"/>
									</svg>'
			],
			[
				"name" => "products",
				"route" => "admin-products",
				"text" => "Productos",
				"image" => '<svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
											<path d="M3.114 11c-.066-.316-.104-.64-.112-.972-.062-2.402 1.452-4.495 3.595-5.262.307-2.606 2.574-4.766 5.403-4.766 2.199 0 4.258 1.336 5.082 3.504l2.918-2.918 1.413 1.413-5.94 5.94.001.001-.474.474-1.414-1.414 1.899-1.899c-.219-1.688-1.597-3.101-3.51-3.101-1.731 0-3.183 1.27-3.47 2.819 1.31.291 3.01 1.426 3.021 3.707-.982-2.06-3.533-2.36-4.846-1.604-1.252.721-1.682 1.839-1.679 3.056.001.357.06.7.167 1.022h13.648c.135-.396.2-.824.18-1.268-.041-.944-.402-1.705-.927-2.267l1.38-1.38c.965.988 1.551 2.337 1.551 3.804 0 .381-.039.753-.114 1.111h1.12c.007 3.956-2.216 7.735-7.069 9.206.086.568.96 1.558 1.531 1.794h.538c.611.015.991.413 1 1 .01.524-.439 1.002-1.006 1h-10c-.567.002-1.004-.476-.994-1 .009-.587.389-.985 1-1h.538c.571-.236 1.445-1.226 1.531-1.794-4.853-1.471-7.063-5.25-7.069-9.206h1.108zm16.688 2h-15.592l.002.008c.97 3.448 3.626 5.019 7 5.675.077.799-.014 2.497-.942 3.317h3.472c-.928-.82-1.019-2.518-.942-3.317 3.374-.656 6.03-2.227 7-5.675l.002-.008z"/>
										</svg>'
			]
		];
		
	@endphp
	@dd($navlinks);
	<div x-data="{ open: true }" x-cloak class="flex ">

		<!-- Menu Lateral -->
		<div class="hidden lg:block w-1/5 bg-eat-white-50 shadow-lg h-screen sticky top-0 " x-show="open"
			x-transition:enter="transition ease-out duration-300"
			x-transition:enter-start="opacity-0 transform scale-90"
			x-transition:enter-end="opacity-100 transform scale-100"
			x-transition:leave="transition ease-in duration-300"
			x-transition:leave-start="opacity-100 transform scale-100"
			x-transition:leave-end="opacity-0 transform scale-90">
			<div class="h-20 bg-eat-fuccia-500 mb-4">
				<img class="h-20 w-44 mx-auto" src=" {{url('/img/logo_fuccia.png')}} " alt="">
			</div>
			<div class="menu-container">
				@foreach ($navlinks as $link)
					<x-utils.menu-item :routeInMenu="$link['route']" >
						<x-slot name="image">
							{!! $link['image'] !!}
						</x-slot>						
						<x-utils.text-menu>{{$link['text']}}</x-utils.text-menu>
					</x-utils.menu-item>						
				@endforeach
				{{-- <x-utils.menu-item routeInMenu="dashboard">
					<x-slot name="image">
						<x-icons.home />
					</x-slot>
					<x-utils.text-menu>Dashboard</x-utils.text-menu>
				</x-utils.menu-item>
				<x-utils.menu-item routeInMenu="admin-users">
					<x-slot name="image">
						<x-icons.users />
					</x-slot>
					<x-utils.text-menu>Usuarios</x-utils.text-menu>
				</x-utils.menu-item> --}}

				<div class=" pl-7 pb-4 text-eat-olive-700 hover:text-eat-pink-500">
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<x-auth.logout />
					</form>
				</div>


			</div>
		</div>

		<div class="" x-bind:class="{ 'w-4/5 ml-auto ': open, 'w-full ml-0': !open }">
			<header class="w-full h-20 bg-eat-green-500 flex justify-between items-center">
				<div class="hamburger w-1/2 ml-8 ">
					<x-icons.menu />
				</div>
				<div class=" hidden md:w-2/5 xl:w-1/3 lg:flex justify-between items-center mr-8">
					<div class=" w-1/2 relative ">
						<input
							class="rounded-lg shadow-lg pl-10 border border-transparent focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-500 "
							type="text">
						<x-icons.search />
					</div>
					<x-icons.messages class="text-eat-olive-50" />
					<x-icons.notifications />
					<div class=" ">
						<img class=" rounded-full w-12 h-12 bg-cover " src="https://i.pravatar.cc/40" alt="">
					</div>
				</div>
			</header>

			<main class="mx-6 mt-6">
				{{$slot}}
			</main>
		</div>
	</div>


	{{-- <script src="{{ mix('js/alpine-functions.js') }}"></script> --}}
	@livewireScripts
	@stack('modals')
</body>

</html>