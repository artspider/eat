<div class="mt-10 w-11/12 md:w-2/5 lg:w-full mx-auto" x-data="{ open: false, texto: ['Ver descripción', 'Ocultar descripción'] }">
    <div class="bg-white flex items-center justify-center h-16 rounded-t-lg">
        <h6 class="text-2xl text-eat-fuccia-500">{{$dayOfWeek}}</h6>
    </div>
    <div class="relative">
        <img class="w-full h-64 object-cover" src="{{$srcImage}}" alt="">
        <h1 class="text-gray-700 font-bold text-2xl mb-3 absolute top-4 bg-white p-2 rounded-r-lg hover:text-gray-900 hover:cursor-pointer">{{$nameDish}}
            </h1>
            <h6 x-on:click="open = !open" class="text-md py-2 px-4 cursor-pointer bg-eat-green-500 text-gray-800 font-bold rounded-b-lg shadow-md hover:shadow-lg transition duration-300" x-text="open ? texto[1]:texto[0]">Ver descripción</h6>
            
    </div><!-- arriba -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"

        @click.away=" open = false">
        <div class="-mt-2  py-6 px-6 bg-white text-left rounded-b-lg font-rubik h-72 md:h-80 lg:h-72 flex flex-col justify-between">
            <div>    

            <h6 class="text-gray-700 tracking-wide">{{$slot}}</h6>
            </div>
            <div class="flex items-center justify-between mt-6">
                <h6 class="font-semibold">Precio normal:</h6>
                <span
                    class="text-md py-2 px-4 bg-yellow-400 text-gray-800 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300">${{$priceDish}}</span>
            </div>
        </div>
        <!--abajo -->
    </div>
</div>
