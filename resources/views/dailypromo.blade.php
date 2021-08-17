<x-layouts.master title="Welcome Page">
    <div class="bg-white rounded-md shadow-md p-10 ">
        <x-utils.subtitle class="mb-4 text-center md:text-left">Editar paquete de comidas</x-utils.subtitle>
        <hr class=" border-eat-olive-50 mb-6 ">

        <div x-data="{tab:0}">
            <nav>
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a :class="tab === 0 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="tab=0"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                            <x-icons.date class="text-base mr-1" /> Lunes
                        </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a :class="tab === 1 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="tab=1"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                            <x-icons.date class="text-base mr-1" /> Martes
                        </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a :class="tab === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="tab=2"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                            <x-icons.date class="text-base mr-1" /> Miercoles
                        </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a :class="tab === 3 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="tab=3"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                            <x-icons.date class="text-base mr-1" /> Jueves
                        </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a :class="tab === 4 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                            x-on:click="tab=4"
                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                            <x-icons.date class="text-base mr-1" /> Viernes
                        </a>
                    </li>
                </ul>
            </nav>

            <form wire:submit.prevent="save">
                <div x-show="tab===0" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-2 gap-4 place-items-center">
                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">
                        <label for="qty"
                            class="block text-center mb-4 text-md font-medium leading-5 text-eat-olive-700">Bebida para
                            toda
                            el Lunes</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Bebida..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Café</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Agua de del día</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Smothies</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina bebida -->

                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">

                        <label for="qty"
                            class="block mb-4 text-md font-medium leading-5 text-eat-olive-700">Platillo</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Platillo..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Torta del chef</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Huevos rancheros fit</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Chilaquiles de pollito</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina platillo -->
                </div><!-- Lunes -->
                <div x-show="tab===1" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-2 gap-4 place-items-center">
                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">
                        <label for="qty"
                            class="block text-center mb-4 text-md font-medium leading-5 text-eat-olive-700">Bebida para
                            toda
                            el Lunes</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Bebida..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Café</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Agua de del día</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Smothies</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina bebida -->

                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">

                        <label for="qty"
                            class="block mb-4 text-md font-medium leading-5 text-eat-olive-700">Platillo</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Platillo..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Torta del chef</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Huevos rancheros fit</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Chilaquiles de pollito</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina platillo -->
                </div><!-- Martes -->
                <div x-show="tab===2" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-2 gap-4 place-items-center">
                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">
                        <label for="qty"
                            class="block text-center mb-4 text-md font-medium leading-5 text-eat-olive-700">Bebida para
                            toda
                            el Lunes</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Bebida..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Café</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Agua de del día</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Smothies</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina bebida -->

                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">

                        <label for="qty"
                            class="block mb-4 text-md font-medium leading-5 text-eat-olive-700">Platillo</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Platillo..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Torta del chef</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Huevos rancheros fit</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Chilaquiles de pollito</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina platillo -->
                </div><!-- Miercoles -->
                <div x-show="tab===3" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-2 gap-4 place-items-center">
                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">
                        <label for="qty"
                            class="block text-center mb-4 text-md font-medium leading-5 text-eat-olive-700">Bebida para
                            toda
                            el Lunes</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Bebida..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Café</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Agua de del día</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Smothies</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina bebida -->

                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">

                        <label for="qty"
                            class="block mb-4 text-md font-medium leading-5 text-eat-olive-700">Platillo</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Platillo..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Torta del chef</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Huevos rancheros fit</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Chilaquiles de pollito</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina platillo -->
                </div><!-- Jueves -->
                <div x-show="tab===4" class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-2 gap-4 place-items-center">
                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">
                        <label for="qty"
                            class="block text-center mb-4 text-md font-medium leading-5 text-eat-olive-700">Bebida para
                            toda
                            el Lunes</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Bebida..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Café</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Agua de del día</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Smothies</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina bebida -->

                    <div class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8 flex flex-col items-center">

                        <label for="qty"
                            class="block mb-4 text-md font-medium leading-5 text-eat-olive-700">Platillo</label>

                        <div class="flex flex-col sm:flex-row sm:justify-between w-full mx-auto justify-center">
                            <div class="w-full md:w-full mr-1 xl:flex-grow">
                                <div x-data="{open: false}">
                                    <div class="relative">
                                        <div x-on:click="open=true"
                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                            {{-- <x-utils.text class="ml-4">Test</x-utils.text> --}}
                                            <input
                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                type="text" name="" id="" placeholder="Platillo..."
                                                wire:model="queryProduct">
                                            <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                                        </div>

                                        <div x-show="open" x-on:click.away="open=false">
                                            <div
                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                <ul>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Torta del chef</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Huevos rancheros fit</li>
                                                    <li {{--wire:click="SelectProduct({{$product}})"--}} href="#"
                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                        Chilaquiles de pollito</li>
                                                    {{--@else
                                                        <li x-on:click="open=false"
                                                            wire:click="SelectProduct({{$product}})" href="#"
                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500
                                                    font-light font-montserrat text-left px-4 py-2
                                                    hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                    {{$product->name}}</li>
                                                    @endif
                                                    @endforeach--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Termina platillo -->
                    <div class="w-full col-span-2">
                        <hr class=" border-eat-olive-50 mb-6 ">
                        <div class="mt-6 flex justify-end">
                            <x-utils.button class="w-full md:w-44 justify-center" color="eat-olive" type="submit">
                                Guardar
                                paquete
                            </x-utils.button>
                        </div>
                    </div>
                </div><!-- Viernes -->



            </form>

        </div>
    </div>
</x-layouts.master>