<div class="w-full bg-eat-fuccia-500 h-full">
  @if ($errors->any())
  <script>
    Toast.fire({
            icon: 'error',
            title: 'Ocurrio un error, revise sus datos'
          });
  </script>
  @endif

  <div class="flex items-center  p-2">
    <img src="img/tenedor.png" width="36" height="36" alt="">
    <h2 class="text-2xl text-eat-white-500 font-bold font-montserrat ml-4">Orden # {{$selectedOrder->id}}</h2>
  </div>

  <div class="grid grid-cols-5 gap-4 bg-eat-white-50 p-2 h-96">
    <div x-data="{ open: @entangle('addAddressInput') }" class="max-h-96 overflow-y-scroll pt-1 px-2 col-span-3">

      <div class=" border border-solid border-eat-green-200 p-4 mt-2 ">
        <p class="text-sm font-semibold font-montserrat text-gray-500 ">Agregar platillo</p>
        <!-- Menú selection -->
        <div class="flex items-center mt-2 text-eat-olive-400 text-sm font-montserrat ">
          <p class="mr-8 font-semibold">Del menu: </p>
          <div class="flex items-center mr-4">
            <label class="inline-flex items-center">
              <input wire:model="selectedMenu" type="radio" class="form-radio" name="radio" value="0" checked>
              <span class="ml-2">Desayuno</span>
            </label>
          </div>
          <div class="flex items-center mr-4">
            <label class="inline-flex items-center">
              <input wire:model="selectedMenu" type="radio" class="form-radio" name="radio" value="1">
              <span class="ml-2">Comida</span>
            </label>
          </div>
          <div class="flex items-center mr-4">
            <label class="inline-flex items-center">
              <input wire:model="selectedMenu" type="radio" class="form-radio" name="radio" value="2">
              <span class="ml-2">Bebidas</span>
            </label>
          </div>
        </div>
        <!-- -->

        @if ($section)
        <div class=" mt-4 mb-4">
          <select wire:model="selectedSection" class=" w-full rounded-md shadow-md form-input block text-eat-olive-900 font-montserrat placeholder-eat-olive-50
            bg-eat-white-500 font-bold
            border
            border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
            sm:leading-5">
            {{-- <option value="">== SECCIÓN ==</option> --}}
            @foreach ($section as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
            @endforeach
          </select>
        </div>
        @endif

        <!-- Input Dish Selection -->
        <div class="flex items-center mt-4">
          <div class="w-full mr-1 ">
            <div x-data="{open: false}">
              <div class="relative">
                <div x-on:click="open=true"
                  class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                  <input class="w-full h-10 bg-eat-white-500 text-eat-olive-500 font-montserrat font-bold border 
                    border-transparent focus:outline-none 
                      focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                    type="text" placeholder="Agrega platillo..." wire:model="queryDish" autocomplete="false">
                  <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 font-semibold" />
                </div>

                <div x-show="open" x-on:click.away="open=false">
                  <div class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                    <ul>
                      @if ($dishes)
                      @forelse ($dishes as $dish)
                      @if ($dish->id == $dish_id)
                      <li wire:click="SelectDish({{$dish}})" href="#"
                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                        {{$dish->name}}</li>
                      @else
                      <li x-on:click="open=false" wire:click="SelectDish({{$dish}})" href="#"
                        class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                        {{$dish->name}}</li>
                      @endif
                      @empty
                      <li href="#"
                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                        No hay coincidencias
                      </li>
                      @endforelse
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <x-icons.add wire:click="addDishToOrder" class="mr-2 cursor-pointer text-eat-olive-300"></x-icons.add>
          </div>
        </div>
        @if ($addDish)
        <p class="text-xs text-eat-fuccia-500 font-montserrat font-light tracking-tight mt-1 ">No existe
          Platillo...</p>
        @endif
        <!-- End Input Dish Selection -->
      </div>
    </div>
  </div>
</div>