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
				<x-utils.menu-item routeInMenu="dashboard">
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
				</x-utils.menu-item>

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