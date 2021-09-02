<div {{$attributes->merge(['class' => 'mt-10 w-11/12 md:w-2/5 shadow-md'])}}>
    <div class="rounded-lg">
        <img class="w-full h-64 object-cover rounded-t-lg " src="{{$srcImage}}" alt="">
    </div><!-- arriba -->
    <div >
        <div class="py-6 px-8  bg-white text-left font-rubik h-80 md:h-80 lg:h-60 flex flex-col justify-between">
            <div>    
        <h1 class="text-gray-700 font-bold text-2xl mb-3  hover:text-gray-900 hover:cursor-pointer">{{$nameDish}}
            </h1>
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
