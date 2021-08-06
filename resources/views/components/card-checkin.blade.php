<div class="mb-8">
    <x-utils.subsubtitle class="text-center mb-2">Bienvenido {{$username}}</x-utils.subsubtitle>
    <div class="rounded-3xl flex flex-col items-center w-full justify-center">
        <img class="rounded-3xl h-96 w-64 object-cover " src="{{$imgsrc}}" alt="">
        {{$slot}}
        <x-utils.button-login
            class="mt-4 mx-auto bg-eat-green-500 justify-center block hover:bg-eat-fuccia-500 hover:text-white">Validar
            entrada
        </x-utils.button-login>



        <div class="text-eat-green-500 flex w-44 justify-around">
            <!-- Si llego a buena hora -->
            <svg class="fill-current w-12 h-auto mt-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
            </svg>

            <div class="text-eat-fuccia-500">
                <!-- Si llego tarde -->
                <svg class="fill-current w-12 h-auto mt-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                </svg>
            </div>
        </div>



        @if (true)
        @php
        $mytime=Carbon\Carbon::now();
        $mytime = $mytime->format('d-m-Y H:i:s');
        echo $mytime;


        @endphp
        @endif


    </div>
</div>