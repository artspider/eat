<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        @isset($title) {{ $title }} - @endisset {{ config('app.name', 'EAT Rstaurante') }}
    </title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/notifications.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body class="bg-white font-rubik relative">
    <!-- header/navigation -->
    <div x-data="{ isOpen: false }" class="bg-eat-white-1000">
        <div class="mx-auto max-w-screen-xl flex justify-between p-4 lg:py-4 ">
            <div class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" class="w-40 h-auto" alt="logo" />
            </div>

            <!-- left header section -->
            <div class="flex items-center justify-between">
                <button @click="isOpen = !isOpen" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-black lg:hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="hidden lg:inline-block text-black lg:sticky">
                    <a href="#home" class="text-base mr-10 hover:text-eat-fuccia-500 transition-all">Inicio</a>
                    <a href="#menu" class="text-base mr-10 hover:text-eat-fuccia-500 transition-all">Menu</a>
                    <a href="#promos" class="text-base mr-10 hover:text-eat-fuccia-500 transition-all">Paquetes /
                        Ofertas</a>
                    <a href="#about" class="text-base mr-10 hover:text-eat-fuccia-500 transition-all">Acerca</a>
                    <a href="#services" class="text-base mr-10 hover:text-eat-fuccia-500 transition-all">Servicios</a>
                    <a href="/login" class="text-base mr-10 hover:text-eat-fuccia-500 transition-all">Iniciar Sesión</a>
                    <a href="https://wa.me/527331559771" target="_blank" class="">
                        <div
                            class="inline-block text-lg mr-10 bg-eat-fuccia-500 py-3 px-5 w- rounded-full text-white shadow-lg font-bold transform transition translate hover:scale-105">
                            Contactanos
                        </div>
                    </a>
                </div>

                <!-- mobile navbar -->
                <div class="mobile-navbar z-50">
                    <!-- navbar wrapper -->
                    <div x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-y-50"
                        x-transition:enter-end="opacity-100 transform scale-y-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-end="opacity-0 transform scale-y-50"
                        class="fixed left-0 w-full h-auto p-5 bg-eat-fuccia-700 shadow-xl top-28" x-show="isOpen"
                        @click.away=" isOpen = false" @scroll.away=" isOpen = false">
                        <div class="flex flex-col items-center space-y-6 text-white">
                            <a href="#home" class="text-sm hover:bg-white hover:text-black">Inicio</a>
                            <a href="#menu" class="text-sm">Menu</a>
                            <a href="#promos" class="text-sm">Paquetes / Ofertas</a>
                            <a href="#about" class="text-sm">Acerca</a>
                            <a href="#services" class="text-sm">Servicios</a>
                            <a href="/login" class="text-sm">Iniciar Sesión</a>
                            <a href="https://wa.me/527331559771" class="text-sm">Contactanos</a>
                        </div>
                    </div>
                </div>
                <!-- end mobile navbar -->
            </div>
            <!-- right header section -->
        </div>
    </div><!-- Barra nav -->

    <section id="home" class="w-11/12 md:max-w-screen-xl mx-auto h-auto xl:flex xl:items-center">
        <section class="flex flex-col mt-12 md:flex-row lg:mt-24 md:items-center xl:mt-0">
            <div id="container"
                class="w-full md:w-1/2 md:h-1/2 px-3 md:order-2 lg:h-5/12 lg:w-5/12 2xl:w-1/2 2xl:h-1/2 mx-auto lg:p-14 animate__animated animate__slideInRight">
                <div id="inner">
                    <img class="w-full" src="https://i.postimg.cc/vZsz7Dx0/Icono3-rosa.png" alt="" />
                </div>

            </div>
            <div class="text-center mt-8 md:w-1/2 lg:self-start lg:w-1/2 2xl:mt-16 animate__animated animate__slideInLeft">
                <h3 class="text-eat-fuccia-500 font-medium text-xl md:text-left lg:text-2xl">Restaurante</h3>
                <h1 class="font-bold text-5xl leading-tight mt-4 md:text-left lg:text-6xl lg:mt-6 text-black">Disfruta
                    La Comida
                    Mas Saludable</h1>
                <h5
                    class="text-black mt-5 block md:text-left w-5/6 mx-auto md:mx-0 lg:w-10/12 lg:text-justify 2xl:text-lg">
                    En <span>eat</span> amamos preparar la comida mas saludable, del lado de grandes expertos en
                    nutricion y comida, ven y disfruta el sabor sin perder la figura.
                    <span class="block">Nos enfocamos en el sabor, calidad y presentación para brindar una experiencia
                        inolvidable.</span>
                </h5>
                <div class="flex justify-between w-2/3 lg:w-56 mx-auto mt-10 mb-5 md:mx-0">
                    <a href="https://www.facebook.com/doeat.sabroso" target="_blank"
                        class="p-3 rounded-full shadow-md hover:bg-eat-white-1000">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/doeat.sabroso/" target="_blank"
                        class="p-3 rounded-full shadow-md hover:bg-eat-white-1000">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/527331559771" target="_blank" class="p-3 rounded-full shadow-md hover:bg-eat-white-1000">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </a>
                </div>
                <!-- Social Media -->
            </div><!-- Left side -->
        </section>


    </section>
    <!-- Home -->

    <section id="menu" class="w-11/12 md:max-w-screen-xl mx-auto h-auto mt-32">
        <h2 class="text-center w-full text-eat-fuccia-500 text-lg font-medium">Menú</h2>
        <h4 class="text-center w-full text-4xl font-bold mt-9 lg:text-5xl">Platillos Mas Vendidos</h4>
        <h6 class="text-center mt-9 md:w-96 md:mx-auto lg:w-3/4 xl:w-3/5">A lo largo de 1 año en <span
                class="text-eat-fuccia-500 font-bold">eat</span> hemos
            estado vendiendo los mejores platillos saludables para nuestros clientes, y este es el top de comidas de
            nuestros clientes:</h6>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="shadow-xl my-12 animate__animated animate__fadeInUp wow" data-wow-delay=".2s">
                <div>
                    <img class="h-96 w-full object-cover rounded-lg " src="https://i.postimg.cc/3rkkJQr9/4.jpg" alt="">
                </div>
                <div class="py-6 px-8">
                    <h4 class="text-3xl font-bold mt-5">Pizza</h4>
                    <h5 class="w-11/12 mt-5">Disfruta de nuestra pizza con los mejores ingredientes para tu salud!</h5>
                    <div class="flex justify-between items-center mt-6">
                        <h6 class="text-eat-fuccia-500 font-bold text-lg">$5.00</h6>
                        <a class="cursor-pointer">
                            <h6
                                class="text-eat-fuccia-500 p-3 bg-eat-white-1000 hover:shadow-md hover:bg-eat-fuccia-500 hover:text-eat-white-500  rounded-full">
                                Comprar
                            </h6>
                        </a>
                    </div>
                </div>
            </div><!-- Termina card -->

            <div class="shadow-xl my-12 animate__animated animate__fadeInUp wow" data-wow-delay=".2s">
                <div>
                    <img class="h-96 w-full object-cover rounded-lg" src="https://i.postimg.cc/bwhrTGxF/7.jpg" alt="">
                </div>
                <div class="py-6 px-8">
                    <h4 class="text-3xl font-bold mt-5">Pizza</h4>
                    <h5 class="w-11/12 mt-5">Disfruta de nuestra pizza con los mejores ingredientes para tu salud!</h5>
                    <div class="flex justify-between items-center mt-6">
                        <h6 class="text-eat-fuccia-500 font-bold text-lg">$5.00</h6>
                        <a class="cursor-pointer">
                            <h6
                                class="text-eat-fuccia-500 p-3 bg-eat-white-1000 hover:shadow-md hover:bg-eat-fuccia-500 hover:text-eat-white-500  rounded-full">
                                Comprar
                            </h6>
                        </a>
                    </div>
                </div>
            </div><!-- Termina card -->

            <div class="shadow-xl my-12 animate__animated animate__fadeInUp wow" data-wow-delay=".2s">
                <div>
                    <img class="h-96 w-full object-cover rounded-lg" src="https://i.postimg.cc/KvL4B7MM/5.jpg" alt="">
                </div>
                <div class="py-6 px-8">
                    <h4 class="text-3xl font-bold mt-5">Pizza</h4>
                    <h5 class="w-11/12 mt-5">Disfruta de nuestra pizza con los mejores ingredientes para tu salud!</h5>
                    <div class="flex justify-between mt-6 items-center">
                        <h6 class="text-eat-fuccia-500 font-bold text-lg">$5.00</h6>
                        <a class="cursor-pointer">
                            <h6
                                class="text-eat-fuccia-500 p-3 bg-eat-white-1000 hover:shadow-md hover:bg-eat-fuccia-500 hover:text-eat-white-500  rounded-full">
                                Comprar
                            </h6>
                        </a>
                    </div>
                </div>
            </div><!-- Termina card -->


        </div>
    </section><!-- Popular Dishes -->

    <div class="bg-bg1 bg-right-top bg-fixed bg-cover bg-no-repeat object-top w-full h-screen md:shadow-lg shadow-2xl ">
        <section
            class="w-11/12 md:max-w-screen-xl mx-auto h-full mt-32 lg:flex lg:justify-between lg:items-center 2xl:max-w-screen-2xl">
            <img class=" w-96 h-auto mx-auto md:w-4/5 animate__animated animate__slideInLeft wow" data-wow-delay=".2s"
                src="https://i.postimg.cc/Hx65gJKW/vasos-Cuadro-Sombra.png" alt="">
            <div class="animate__animated animate__slideInRight wow" data-wow-delay=".2s">
                <h3 class="text-5xl md:text-7xl font-semibold leading-snug tracking-widest text-center text-black">
                    CONOCE NUESTRO <span class="text-7xl sm:text-9xl text-eat-fuccia-500 inline-block mt-5">MENÚ!</span>
                </h3>
                <div>
                    <img class="object-cover w-full h-3 shadow-md" src="https://i.postimg.cc/sDmpPNKG/stamp.png" alt="">
                </div>
            </div>
        </section>
    </div>

    <section class="w-11/12 md:max-w-screen-xl mx-auto h-auto  bg-eat-white-1000 sm:p-16 shadow-2xl">
        <h4 class="text-center w-full text-4xl font-bold pt-9 lg:text-5xl mb-10">Selecciona Un Menú</h4>
        <h6 class="text-center w-4/5 mx-auto mb-4">Recuerda que puedes elegir cualquier platillo en cualquier hora</h6>

        <!-- Empieza nav para menu -->
        <div class="block pb-20" x-data="{menu:0, submenu:0}">
            <nav>
                <!-- Primer menú  "Selecciona un Menú-->
                <ul class="sm:flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px sm:mr-2 last:mr-0 flex-auto text-center">
                        <a :class="menu === 0 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="menu=0, submenu=0"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                            <svg class="fill-current mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M3.358 11.014c.499-1.244.018-2.555 1.064-2.735.33-.058 1.53.005 2.075-.076.837-.123 1.326-.433 1.835-1.018.753-.91.923-1.56 1.948-.948.981.618 1.76 1.151 2.992.844 1.365-.341 2.027-1.77 2.685-.684.918 1.593 1.029 1.882 3.5 2.17 1.169.161 1.221 1.399 1.37 2.655.128.834.776 1.841 1.249 2.544-2.273-3.355-5.832-5.67-9.935-5.749-4.152-.022-7.828 2.176-10.094 5.399.016-.022.998-1.623 1.311-2.402m19.923 4.912l.004.008c.424-.651.72-1.362.686-2.152-.042-.932-.466-1.484-.929-2.259-.289-.505-.224-.614-.312-1.261-.061-.462-.143-.925-.293-1.368-.756-2.218-2.373-2.266-3.511-2.383-.552-.068-.691-.196-.842-.416-.402-.598-.414-.928-.973-1.438-.476-.432-1.102-.657-1.722-.657-.896 0-1.425.415-2.129.898-.456.303-.709.392-1.337.017-.808-.497-1.311-.915-2.313-.915-1.257 0-1.894.686-2.6 1.632-.374.507-.451.609-1.25.621-1 .002-2.841-.247-3.732 1.582-.305.625-.333 1.191-.423 1.878-.097.734-.153.737-.478 1.213-.609.906-1.125 1.941-1.113 3.037.008.679.22 1.332.676 1.912.311-.787-.658 1.427-.658 2.625 0 .941.502 1.457 1.734 1.512.45.007 18.707.018 20.392 0 1.177-.046 1.842-.77 1.842-1.647 0-.592-.489-1.902-.719-2.439" />
                            </svg> Desayunos / Almuerzos

                        </a>
                    </li><!-- Desayunos/Almuerzos -->
                    <li class="-mb-px sm:mr-2 last:mr-0 flex-auto text-center">
                        <a :class="menu === 1 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="menu=1, submenu=4"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                            <svg class="fill-current mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M5.624 3.896c-.917-1.419-.036-3.774 2.084-3.895 1.001-.034 5.603.891 9.132 3.588 1.07.818 2.036 1.767 2.881 2.816 2.685 3.332 4.279 8.261 4.279 9.677 0 1.669-2.009 2.887-3.653 2.185l-20.347 5.733 5.624-20.104zm-2.737 17.212l16.145-4.547c-1.975-6.675-4.971-9.905-11.62-11.627l-4.525 16.174zm3.616-5.11c.83 0 1.502.674 1.502 1.501 0 .829-.672 1.501-1.502 1.501-.829 0-1.5-.672-1.5-1.501 0-.827.671-1.501 1.5-1.501m4.194-.972c.798.276 1.22 1.147.945 1.945-.276.798-1.148 1.22-1.945.945 0 0-.47-.166-.32-.599.149-.432.62-.268.62-.268.319.11.668-.059.778-.377.11-.32-.059-.668-.378-.78 0 0-.481-.127-.319-.594.147-.424.619-.272.619-.272m-3.04-12.094c7.157 1.773 11.111 5.485 13.315 13.068.211.726 1.276.356 1.111-.25-2.22-8.142-6.831-12.522-14.128-13.938-.641-.125-.941.961-.298 1.12m6.352 9.067c1.104 0 2 .897 2 2.001 0 1.105-.896 2-2 2-1.105 0-2.002-.895-2.002-2 0-1.104.897-2.001 2.002-2.001m-5.837 2.99c-.814-.192-1.32-1.009-1.128-1.822.193-.814 1.01-1.319 1.823-1.127 0 0 .48.116.377.558-.105.442-.584.327-.584.327-.327-.077-.653.125-.729.451-.078.325.124.652.449.729 0 0 .487.078.375.554-.103.433-.583.33-.583.33m1.834-7.581c1.104 0 2.001.897 2.001 2 0 1.104-.897 2-2.001 2-1.105 0-2.001-.896-2.001-2 0-1.103.896-2 2.001-2" />
                            </svg> Comidas
                        </a>
                    </li><!-- Comidas -->
                    <li class="-mb-px sm:mr-2 last:mr-0 flex-auto text-center">
                        <a :class="menu === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="menu=2, submenu=8"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-md md:shadow-lg rounded leading-normal cursor-pointer">
                            <svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12.874 6.999c4.737-4.27-.979-4.044.116-6.999-3.781 3.817 1.41 3.902-.116 6.999zm-2.78.001c3.154-2.825-.664-3.102.087-5.099-2.642 2.787.95 2.859-.087 5.099zm8.906 2.618c-.869 0-1.961-.696-1.961-1.618h-10.039c0 .921-1.13 1.618-2 1.618v1.382h14v-1.382zm-13 2.382l2.021 12h7.959l2.02-12h-12z" />
                            </svg> Bebidas
                        </a>
                    </li><!-- Bebidas -->
                </ul>
            </nav>

            <form>
                <div x-show="menu===0" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-1 gap-4 place-items-center">
                    <h4 class="text-center w-full text-3xl font-semibold 2xl:mt-9 lg:text-5xl 2xl:mb-10">Selecciona Una
                        Subcategoría</h4>
                    <nav class="w-full">
                        <ul class="sm:flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center w-full sm:w-auto">
                                <a :class="submenu === 0 ? 'bg-eat-fuccia-500 text-white' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=0"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                                    Huevos

                                </a>
                            </li><!-- Huevos -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 1 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=1"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                                    Dulces
                                </a>
                            </li><!-- Dulces -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=2"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                                    Quesadillas
                                </a>
                            </li><!-- Quesadillas -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 3 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=3"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-md  md:shadow-lg rounded leading-normal cursor-pointer">
                                    Almuerzos fuertes
                                </a>
                            </li><!-- Almuerzos fuertes -->
                        </ul>
                    </nav>
                </div><!-- Desayunos/Almuerzos -->
                <div x-show="menu===1" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-1 gap-4 place-items-center">
                    <h4 class="text-center w-full text-3xl font-semibold 2xl:mt-9 lg:text-5xl 2xl:mb-10">Selecciona Una
                        Subcategoría</h4>
                    <nav class="w-full">
                        <ul class="sm:flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center w-full sm:w-auto">
                                <a :class="submenu === 4 ? 'bg-eat-fuccia-500 text-white' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=4"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                                    Ensaladas

                                </a>
                            </li><!-- Ensaladas -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 5 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=5"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                                    Tortas
                                </a>
                            </li><!-- Tortas -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 6 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=6"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 md:shadow-lg rounded leading-normal cursor-pointer">
                                    Pizzas
                                </a>
                            </li><!-- Pizzas -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 7 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=7"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-md md:shadow-lg rounded leading-normal cursor-pointer">
                                    Comidas fuertes
                                </a>
                            </li><!-- Comidas fuertes -->
                        </ul>
                    </nav>
                </div><!-- Comidas -->
                <div x-show="menu===2" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-1 gap-4 place-items-center">
                    <h4 class="text-center w-full text-3xl font-semibold mt-9 lg:text-5xl mb-10">Selecciona Una
                        Subcategoría</h4>
                    <nav class="w-full">
                        <ul class="sm:flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center w-full sm:w-auto">
                                <a :class="submenu === 8 ? 'bg-eat-fuccia-500 text-white' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=8"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                    Smoothies

                                </a>
                            </li><!-- Smoothies -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 9 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=9"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                    Jugos
                                </a>
                            </li><!-- Jugos -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 10 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=10"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                    Drinks
                                </a>
                            </li><!-- Drinks -->
                            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a :class="submenu === 11 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                    x-on:click="submenu=11"
                                    class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-md md:shadow-lg rounded leading-normal cursor-pointer">
                                    Bebidas Basicas
                                </a>
                            </li><!-- Bebidas Basicas -->
                        </ul>
                    </nav>
                </div><!-- Bebidas -->
            </form><!-- Diferentes subcategorias-->

            <div class="w-full mx-auto h-auto  flex items-center justify-center text-white">
                <div class="text-black">
                    <div x-show="submenu===0">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Huevitos al
                            gusto.</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Rancheros fit" priceDish="59">2 huevos estrellados en
                                tortillas asaditas con nopal bañados en salsa casera. Con frijoles y ensalada de la
                                casa. </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Con verduras" priceDish="55">2 huevos revueltos con
                                verduras de tu elección. Haz tu combinación: pimientos, champiñones, brócoli, nopales.
                                Con frijoles y ensalada de la casa </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Omelette" priceDish="59">2 huevos rellenos de quesito
                                panela y verduras a tu gusto en una tortilla asadita con frijoles
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Huevos -->
                    <div x-show="submenu===1">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Mezclas de
                            avena.</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Crepa Proteica" priceDish="75">3 crepas con quesito
                                cottage, fresas rebanadas y trocitos de nuez.</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Crepa dulce" priceDish="59">3 crepas bañadas en yogurt sin
                                azúcar, mermelada de la casa y trocitos de fruta</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Hot cakes / Waffles" priceDish="60">3 piezas de avena con
                                frutita fresca, miel y mermelada de la casa.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Energy bowl" priceDish="59">Avena hervida con canela y
                                agua, acompañada de fresas, platano, crema de frutos y chocolatito Turín.
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Dulces -->
                    <div x-show="submenu===2">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Quesadillas
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Rancheros fit" priceDish="59">2 huevos estrellados en
                                tortillas asaditas con nopal bañados en salsa casera. Con frijoles y ensalada de la
                                casa. </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Con verduras" priceDish="55">2 huevos revueltos con
                                verduras de tu elección. Haz tu combinación: pimientos, champiñones, brócoli, nopales.
                                Con frijoles y ensalada de la casa </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Omelette" priceDish="59">2 huevos rellenos de quesito
                                panela y verduras a tu gusto en una tortilla asadita con frijoles
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Quesadillas -->
                    <div x-show="submenu===3">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Almuerzos
                            fuertes.</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Rancheros fit" priceDish="59">2 huevos estrellados en
                                tortillas asaditas con nopal bañados en salsa casera. Con frijoles y ensalada de la
                                casa. </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Con verduras" priceDish="55">2 huevos revueltos con
                                verduras de tu elección. Haz tu combinación: pimientos, champiñones, brócoli, nopales.
                                Con frijoles y ensalada de la casa </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Omelette" priceDish="59">2 huevos rellenos de quesito
                                panela y verduras a tu gusto en una tortilla asadita con frijoles
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Almuerzos fuertes -->
                </div><!-- Desayunos almuerzos -->

                <div class="text-black">
                    <div x-show="submenu===4">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Deli Salads
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Del chef" priceDish="99">Mix de lechugas, quesito panela,
                                nuez, manzana picada y aderezo de yogurt y citricos </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Verde" priceDish="99">Mix de lechugas, pimiento verde y
                                calabacitas salteados, kiwi, manzana verde, semillas de girasol y aderezo de espinacas
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Cítrica" priceDish="99">Mix de lechugas, pimientos,
                                fresas, gajos de naranja, jitomate y semillas de girasol con aderezo de yogurt y
                                citricos
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Básica" priceDish="89">Mix de lechugas, zanahoria, pepino,
                                germinado, fresas y almendra fileteada con aderezo de yogurt y chipotle.
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Ensaladas -->
                    <div x-show="submenu===5">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Tortas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Del Chef" priceDish="89">Arrachera de res, quesito oaxaca,
                                friojles, guacamole, mix de lechugas con salsa de habanero</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Granjera" priceDish="69">Ommelette de huevo relleno de
                                quesito panela, mix de lechigas, guacamole y dip de espinacas.</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="De la nutri" priceDish="75">Pechuga de pollo asada,
                                quesito panela con pimiento, calabacitas, guacamole y dip de chipotle
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="La sabrosa" priceDish="85">Pechuga de pollo asada,
                                arrachera de res, quesito oaxaca con guacamole, mix de lechugas y dip de chipotle
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Tortas -->
                    <div x-show="submenu===6">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Pizzas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Del Chef" priceDish="89">Arrachera de res, quesito oaxaca,
                                friojles, guacamole, mix de lechugas con salsa de habanero</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Granjera" priceDish="69">Ommelette de huevo relleno de
                                quesito panela, mix de lechigas, guacamole y dip de espinacas.</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="De la nutri" priceDish="75">Pechuga de pollo asada,
                                quesito panela con pimiento, calabacitas, guacamole y dip de chipotle
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="La sabrosa" priceDish="85">Pechuga de pollo asada,
                                arrachera de res, quesito oaxaca con guacamole, mix de lechugas y dip de chipotle
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Pizzas -->
                    <div x-show="submenu===7">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Comidas
                            fuertes</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Del chef" priceDish="99">Mix de lechugas, quesito panela,
                                nuez, manzana picada y aderezo de yogurt y citricos </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Verde" priceDish="99">Mix de lechugas, pimiento verde y
                                calabacitas salteados, kiwi, manzana verde, semillas de girasol y aderezo de espinacas
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Cítrica" priceDish="99">Mix de lechugas, pimientos,
                                fresas, gajos de naranja, jitomate y semillas de girasol con aderezo de yogurt y
                                citricos
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Básica" priceDish="89">Mix de lechugas, zanahoria, pepino,
                                germinado, fresas y almendra fileteada con aderezo de yogurt y chipotle.
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Comidas fuertes -->
                </div><!-- Comidas -->

                <div class="text-black">
                    <div x-show="submenu===8">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Smoothies.
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="De la nutri" priceDish="49">Leche light, linaza, papaya y
                                fresas. Endulzado con miel</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Popeye" priceDish="35">Leche light, espinacas, plátano y
                                hielo. Endulzado con miel</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="El punch" priceDish="49">Leche light, hielo, cacao,
                                plátano, café y canela. Endulzado con miel
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="El pre" priceDish="49">Leche, plátano, avena, amaranto y
                                café. Endulzado con miel
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Tentación" priceDish="49">Frutos rojos, leche light y
                                hielo. Endulzado con miel
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="El post" priceDish="55">Leche, queso cottage, nuez y
                                almendras. Endulzado con miel
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Smoothies -->
                    <div x-show="submenu===9">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Jugos.</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Fresa canela" priceDish="35">Limón, canela y fresas
                                congeladas. Limón, canela y fresas congeladas.</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Prohibido" priceDish="35">Frutos rojos y hierbabuena.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Dulzón" priceDish="25">Sandía y romero.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Sabrosón" priceDish="29">Mango, limón y hierbabuena.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Mojito" priceDish="49">Hierbuena, limon y pepino.
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Drinks -->
                    <div x-show="submenu===10">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Drinks.</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="Fresa canela" priceDish="35">Limón, canela y fresas
                                congeladas. Limón, canela y fresas congeladas.</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Prohibido" priceDish="35">Frutos rojos y hierbabuena.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Dulzón" priceDish="25">Sandía y romero.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Sabrosón" priceDish="29">Mango, limón y hierbabuena.
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Mojito" priceDish="49">Hierbuena, limon y pepino.
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Drinks -->
                    <div x-show="submenu===11">
                        <h3 class="text-eat-green-500 font-extrabold text-3xl text-center my-4 md:text-4xl">Smoothies.
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <x-utils.item-food-menu nameDish="De la nutri" priceDish="49">Leche light, linaza, papaya y
                                fresas. Endulzado con miel</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Popeye" priceDish="35">Leche light, espinacas, plátano y
                                hielo. Endulzado con miel</x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="El punch" priceDish="49">Leche light, hielo, cacao,
                                plátano, café y canela. Endulzado con miel
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="El pre" priceDish="49">Leche, plátano, avena, amaranto y
                                café. Endulzado con miel
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="Tentación" priceDish="49">Frutos rojos, leche light y
                                hielo. Endulzado con miel
                            </x-utils.item-food-menu>
                            <x-utils.item-food-menu nameDish="El post" priceDish="55">Leche, queso cottage, nuez y
                                almendras. Endulzado con miel
                            </x-utils.item-food-menu>
                        </div>
                    </div><!-- Basicos -->
                </div>
            </div><!-- Platillos categoria "cat" -->

        </div>
        <!-- Termina nav para menu -->
    </section><!-- All menu -->


    <section id="promos" class="w-11/12 md:max-w-screen-xl mx-auto h-auto bg-eat-fuccia-500 text-center pb-28">
        <h3 class="w-full text-4xl font-bold pt-9 lg:text-5xl mb-10 text-white">Promociones <span
                class="block md:inline-block">y</span>
            Paquetes</h3>

        <div>
            <h4 class="text-eat-green-500 font-extrabold text-2xl text-center my-4 md:text-4xl">La promo del día</h4>

            <div class="flex flex-col justify-center md:flex-row md:justify-around items-center">
                <x-utils.dailypromo-item class="animate__animated animate__slideInLeft wow" data-wow-delay=".2s"
                    nameDish="Meat balls" priceDish="99" srcImage="https://i.postimg.cc/KvL4B7MM/5.jpg">Bolitas de carne
                    molida de res o pollo rellenas de
                    quesito oaxaca con pasta bañadas en salda pomodoro con queso rallado</x-utils.dailypromo-item>
                <div class="text-8xl text-white">+</div>
                <x-utils.dailypromo-item class="animate__animated animate__slideInRight wow" data-wow-delay=".2s"
                    nameDish="Smoothie Tentación" priceDish="49"
                    srcImage="https://images.unsplash.com/photo-1570696516188-ade861b84a49?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
                    Frutos rojos, leche light y hielo. Endulzado con miel</x-utils.dailypromo-item>


                {{--<x-utils.dailypromo-item2 nameDish="Meat balls" priceDish="99" srcImage="https://i.postimg.cc/KvL4B7MM/5.jpg">Bolitas de carne molida de res o pollo rellenas de quesito oaxaca con pasta bañadas en salda pomodoro con queso rallado</x-utils.dailypromo-item2>
                <div class="text-8xl text-white">+</div>
                <x-utils.dailypromo-item2 nameDish="Smoothie Tentación" priceDish="49" srcImage="https://i.postimg.cc/K8xypQvw/vaso-Fresa.png">Frutos rojos, leche light y hielo. Endulzado con miel</x-utils.dailypromo-item2>--}}
            </div>
            <div class="w-full flex flex-col items-end">
                <div
                    class="flex justify-between items-center sm:justify-center w-4/5 lg:w-full lg:pr-8 mx-auto mt-5 lg:justify-end">
                    <h6 class="text-2xl  text-white md:mr-5 2xl:text-3xl">Precio normal</h6>
                    <h6
                        class="text-md w-auto inline-block py-2 px-4 md:mt-0 bg-eat-olive-500 2xl:text-xl text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 line-through">
                        $630</h6>
                </div>

                <div
                    class="flex justify-between items-center sm:justify-center w-4/5 lg:w-full lg:pr-8 mx-auto mt-5 lg:justify-end">
                    <h6 class="text-2xl font-bold text-white md:mr-5 2xl:text-3xl">Precio oferta</h6>
                    <h6
                        class="text-md w-auto inline-block py-2 px-4 md:mt-0 bg-white 2xl:text-xl text-black font-extrabold rounded-lg shadow-md hover:shadow-lg transition duration-300 ">
                        $500</h6>
                </div>
            </div>
            <img class="object-cover w-4/5 lg:w-4/6 rounded-3xl h-2 shadow-md mx-auto md:w-96 mt-5"
                src="https://i.postimg.cc/sDmpPNKG/stamp.png" alt="">

        </div><!-- Promocion diaria -->

        <div class="mt-16">
            <h4 class="text-eat-green-500 font-extrabold text-2xl text-center my-4 md:text-4xl 2xl:text-5xl">DELI
                ALMUERZO SEMANAL</h4>
            <H6 class="text-white text-xl">**Incluye cafecito de Atoyac**</H6>
            <div class="lg:grid md:grid-cols-5 gap-4 px-4">
                <x-utils.weekpromo-item dayOfWeek="Lunes" nameDish="Meat balls" priceDish="99"
                    srcImage="https://i.postimg.cc/KvL4B7MM/5.jpg">Bolitas de carne molida de res o pollo rellenas de
                    quesito oaxaca con pasta bañadas en salda pomodoro con queso rallado</x-utils.weekpromo-item>
                <!-- Lunes -->
                <x-utils.weekpromo-item dayOfWeek="Martes" nameDish="Rancheros fit" priceDish="59"
                    srcImage="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
                    2 huevos estrellados en tortillas asaditas con nopal bañados en salsa casera. Con frijoles y
                    ensalada de la casa.</x-utils.weekpromo-item><!-- Martes -->
                <x-utils.weekpromo-item dayOfWeek="Miercoles" nameDish="Del chef" priceDish="99"
                    srcImage="https://images.unsplash.com/photo-1475090169767-40ed8d18f67d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1189&q=80">
                    2 huevos revueltos con verduras de tu elección. Haz tu combinación: pimientos, champiñones, brócoli,
                    nopales. Con frijoles y ensalada de la casa</x-utils.weekpromo-item><!-- Miercoles -->
                <x-utils.weekpromo-item dayOfWeek="Jueves" nameDish="Meat balls" priceDish="99"
                    srcImage="https://images.unsplash.com/photo-1458642849426-cfb724f15ef7?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
                    Bolitas de carne molida de res o pollo rellenas de quesito oaxaca con pasta bañadas en salda
                    pomodoro con queso rallado</x-utils.weekpromo-item><!-- Jueves -->
                <x-utils.weekpromo-item dayOfWeek="Viernes" nameDish="Meat balls" priceDish="99"
                    srcImage="https://images.unsplash.com/photo-1555243896-c709bfa0b564?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80">
                    Bolitas de carne molida de res o pollo rellenas de quesito oaxaca con pasta bañadas en salda
                    pomodoro con queso rallado</x-utils.weekpromo-item><!-- Viernes -->

            </div>
            <div class="w-full flex flex-col items-end">
                <div
                    class="flex justify-between items-center sm:justify-center w-4/5 lg:w-full lg:pr-5 mx-auto mt-5 lg:justify-end">
                    <h6 class="text-2xl  text-white md:mr-5 2xl:text-3xl">Precio normal</h6>
                    <h6
                        class="text-md w-auto inline-block py-2 px-4 md:mt-0 bg-eat-olive-500 2xl:text-xl text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 line-through">
                        $630</h6>
                </div>

                <div
                    class="flex justify-between items-center sm:justify-center w-4/5 lg:w-full lg:pr-5 mx-auto mt-5 lg:justify-end">
                    <h6 class="text-2xl font-bold text-white md:mr-5 2xl:text-3xl">Precio oferta</h6>
                    <h6
                        class="text-md w-auto inline-block py-2 px-4 md:mt-0 bg-white 2xl:text-xl text-black font-extrabold rounded-lg shadow-md hover:shadow-lg transition duration-300 ">
                        $500</h6>
                </div>
            </div>
            <img class="object-cover w-4/5 lg:w-4/6 rounded-3xl h-2 shadow-md mx-auto md:w-96 mt-5"
                src="https://i.postimg.cc/sDmpPNKG/stamp.png" alt="">
        </div><!-- Paquete semanal almuerzo -->

        <div class="mt-16">
            <h4 class="text-eat-green-500 font-extrabold text-2xl text-center my-4 md:text-4xl 2xl:text-5xl">DELI
                COMIDA SEMANAL</h4>
            <H6 class="text-white text-xl">**Incluye agua del día**</H6>
            <div class="lg:grid md:grid-cols-5 gap-4 px-4">
                <x-utils.weekpromo-item dayOfWeek="Lunes" nameDish="Meat balls" priceDish="99"
                    srcImage="https://images.unsplash.com/photo-1475090169767-40ed8d18f67d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1189&q=80">
                    Bolitas de carne molida de res o pollo rellenas de quesito oaxaca con pasta bañadas en salda
                    pomodoro con queso rallado</x-utils.weekpromo-item><!-- Lunes -->
                <x-utils.weekpromo-item dayOfWeek="Martes" nameDish="Rancheros fit" priceDish="59"
                    srcImage="https://images.unsplash.com/photo-1555243896-c709bfa0b564?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80">
                    2 huevos estrellados en tortillas asaditas con nopal bañados en salsa casera. Con frijoles y
                    ensalada de la casa.</x-utils.weekpromo-item><!-- Martes -->
                <x-utils.weekpromo-item dayOfWeek="Miercoles" nameDish="Del chef" priceDish="99"
                    srcImage="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
                    2 huevos revueltos con verduras de tu elección. Haz tu combinación: pimientos, champiñones, brócoli,
                    nopales. Con frijoles y ensalada de la casa</x-utils.weekpromo-item><!-- Miercoles -->
                <x-utils.weekpromo-item dayOfWeek="Jueves" nameDish="Meat balls" priceDish="99"
                    srcImage="https://images.unsplash.com/photo-1458642849426-cfb724f15ef7?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
                    Bolitas de carne molida de res o pollo rellenas de quesito oaxaca con pasta bañadas en salda
                    pomodoro con queso rallado</x-utils.weekpromo-item><!-- Jueves -->
                <x-utils.weekpromo-item dayOfWeek="Viernes" nameDish="Meat balls" priceDish="99"
                    srcImage="https://i.postimg.cc/KvL4B7MM/5.jpg">Bolitas de carne molida de res o pollo rellenas de
                    quesito oaxaca con pasta bañadas en salda pomodoro con queso rallado</x-utils.weekpromo-item>
                <!-- Viernes -->
            </div>
            <div class="w-full flex flex-col items-end">
                <div
                    class="flex justify-between items-center sm:justify-center w-4/5 lg:w-full lg:pr-5 mx-auto mt-5 lg:justify-end">
                    <h6 class="text-2xl  text-white md:mr-5 2xl:text-3xl">Precio normal</h6>
                    <h6
                        class="text-md w-auto inline-block py-2 px-4 md:mt-0 bg-eat-olive-500 2xl:text-xl text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 line-through">
                        $630</h6>
                </div>

                <div
                    class="flex justify-between items-center sm:justify-center w-4/5 lg:w-full lg:pr-5 mx-auto mt-5 lg:justify-end">
                    <h6 class="text-2xl font-bold text-white md:mr-5 2xl:text-3xl">Precio oferta</h6>
                    <h6
                        class="text-md w-auto inline-block py-2 px-4 md:mt-0 bg-white 2xl:text-xl text-black font-extrabold rounded-lg shadow-md hover:shadow-lg transition duration-300 ">
                        $500</h6>
                </div>
            </div>
            <img class="object-cover w-4/5 lg:w-4/6 rounded-3xl h-2 shadow-md mx-auto md:w-96 mt-5"
                src="https://i.postimg.cc/sDmpPNKG/stamp.png" alt="">
        </div><!-- Paquete semanal comida -->
    </section><!-- Promos -->

    <section id="about" class="w-11/12 md:max-w-screen-xl mx-auto h-auto">
        <div class="h-auto flex flex-col justify-center lg:flex-row lg:items-center lg:relative lg:top-5">
            <div class="lg:w-1/2 lg:mt-20">
                <h2
                    class="lg:absolute top-0 text-center w-full text-eat-fuccia-500 text-xl md:text-2xl font-medium my-5 ">
                    Acerca de eat</h2>
                <img class="w-full shadow-md lg:shadow-xl"
                    src="https://images.unsplash.com/photo-1569617084133-26942bb441f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                    alt="">
            </div>
            <div class="mt-5 text-center md:mt-14 lg:w-2/5 lg:text-justify lg:mx-auto">
                <h6 class="text-gray-800 md:text-xl">En nuestro restaurante contamos con muchos especialistas del area,
                    desde una nutriologa muy talentosa y reconocida <a class="font-bold underline"
                        href="https://www.instagram.com/alexiakurinutriologa/" target="_blank">Alexia Kuri</a>, contamos
                    con 2 chefs quienes son los encargados de preparar todos los platillos, y apoyando a nuestro lindo
                    iguala contamos con padres de familia y estudiantes bien capacitados para brindarte la mejor
                    atención y los mejores platillos.</h6>
            </div>
        </div>
    </section><!-- About us -->

    <section id="services" class="w-11/12 md:max-w-screen-xl mx-auto h-auto mt-12 pb-12">
        <h2 class="text-center w-full text-eat-fuccia-500 text-xl md:text-2xl font-medium my-5 ">Nuestros Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 place-content-center place-items-center ">

            <div class="lg:w-96 animate__animated animate__slideInLeft wow" data-wow-delay=".2s">
                <h6 class="text-4xl font-bold text-center my-4 order-2">SERVICIO A DOMICILIO</h6>
                <div class="bg-eat-fuccia-500 ">
                    <img class="py-10 h-96 mx-auto" src="https://i.postimg.cc/kMFFzd83/eatbagpink.png"
                        alt="delivery image">
                </div>
            </div><!-- Izq -->
            <div class="mt-10 md:mt-0 lg:w-96 animate__animated animate__slideInRight wow">
                <h6 class="text-4xl font-bold text-center my-4">COME EN NUESTRO RESTAURANTE</h6>
                <div>
                    <img class="h-96 w-full object-cover" src="https://i.postimg.cc/63SSP2m0/restaurant.jpg"
                        alt="delivery image">
                </div>
            </div><!-- Der -->
        </div>
    </section><!-- Services -->

    <div class="bg-eat-white-1000 py-12 px-4">
        <div class="focus:outline-none mx-auto container flex flex-col items-center justify-center">
            <div tabindex="0" aria-label="prodify logo" role="img">
                <img class="w-36" src="{{ asset('img/logo_fuccia.png') }}" alt="">
            </div><!-- Logo -->
            <div class="text-black flex flex-col md:items-center pt-3">
                <h1 tabindex="0" class="focus:outline-none text-2xl font-black text-eat-fuccia-500">Horario</h1>
                <h6 class="mt-3">Lunes-Sabado 9:00am a 5:00pm</h6>
                <div class="my-6 text-base text-color ">
                    <ul class="md:flex items-center">
                        <li class="md:mr-6 cursor-pointer pt-4 lg:py-0"><a href=""
                                class="focus:outline-none focus:underline hover:text-gray-500">Inicio </a></li>
                        <li class="md:mr-6 cursor-pointer pt-4 lg:py-0"><a href=""
                                class="focus:outline-none focus:underline hover:text-gray-500">Menú </a></li>
                        <li class="md:mr-6 cursor-pointer pt-4 lg:py-0"><a href=""
                                class="focus:outline-none focus:underline hover:text-gray-500">Paquetes / Ofertas </a>
                        </li>
                        <li class="md:mr-6 cursor-pointer pt-4 lg:py-0"><a href=""
                                class="focus:outline-none focus:underline hover:text-gray-500">Acerca</a></li>
                        <li class="cursor-pointer pt-4 lg:py-0"><a href=""
                                class="focus:outline-none focus:underline hover:text-gray-500">Servicios</a></li>
                    </ul>
                </div>
            </div>
            <div class="w-9/12 h-0.5 bg-gray-100 rounded-full"></div>
            <div class="flex justify-between items-center">
                <div class="flex justify-between w-full lg:w-56 mx-auto mt-10 mb-5 md:mx-0">
                    <a href="https://www.facebook.com/doeat.sabroso" target="_blank"
                        class="p-3 rounded-full shadow-md hover:bg-eat-white-1000 mr-5 md:mr-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/doeat.sabroso/" target="_blank"
                        class="p-3 rounded-full shadow-md hover:bg-eat-white-1000 mr-5 md:mr-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/527331559771" target="_blank" _blank"
                        class="p-3 rounded-full shadow-md hover:bg-eat-white-1000">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div><!-- Footer -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
    var container = document.getElementById('container');
    var inner = document.getElementById('inner');

    var onMouseEnterHandler = function(event) {
        update(event);
    };
    var onMouseLeaveHandler = function() {
        inner.style = "";
    };
    var onMouseMoveHandler = function(event) {
        if (isTimeToUpdate()) {
            update(event);
        }
    };

    container.onmouseenter = onMouseEnterHandler;
    container.onmouseleave = onMouseLeaveHandler;
    container.onmousemove = onMouseMoveHandler;

    var counter = 0;
    var updateRate = 10;
    var isTimeToUpdate = function() {
        return counter++ % updateRate === 0;
    };

    var container = document.getElementById('container');
    var inner = document.getElementById('inner');

    var mouse = {
        _x: 0,
        _y: 0,
        x: 0,
        y: 0,
        updatePosition: function(event) {
            var e = event || window.event;
            this.x = e.clientX - this._x;
            this.y = (e.clientY - this._y) * -1;
        },
        setOrigin: function(e) {
            this._x = e.offsetLeft + Math.floor(e.offsetWidth / 2);
            this._y = e.offsetTop + Math.floor(e.offsetHeight / 2);
        },
        show: function() {
            return '(' + this.x + ', ' + this.y + ')';
        }
    }
    mouse.setOrigin(container);

    var update = function(event) {
        mouse.updatePosition(event);
        updateTransformStyle(
            (mouse.y / inner.offsetHeight / 2).toFixed(2),
            (mouse.x / inner.offsetWidth / 2).toFixed(2)
        );
    };

    var updateTransformStyle = function(x, y) {
        var style = "rotateX(" + x + "deg) rotateY(" + y + "deg)";
        inner.style.transform = style;
        inner.style.webkitTransform = style;
        inner.style.mozTransform = style;
        inner.style.msTransform = style;
        inner.style.oTransform = style;
    };

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
    </script>
</body>

</html>