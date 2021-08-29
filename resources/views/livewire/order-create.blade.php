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
    <h2 class="text-2xl text-eat-white-500 font-bold font-montserrat ml-4">Orden #</h2>
  </div>

  <div class="grid grid-cols-5 gap-4 bg-eat-white-50 p-2 h-96">
    <div x-data="{ open: @entangle('addAddressInput') }" class="max-h-96 overflow-y-scroll pt-1 px-2 col-span-3">
      <!-- Input Customer -->
      <div class="flex items-center">
        <div class="w-full mr-1 ">
          <div x-data="{open: false}">
            <div class="relative">
              <div x-on:click="open=true"
                class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                <input class="w-full h-10 bg-eat-white-500 text-eat-olive-500 font-montserrat font-bold border 
                      border-transparent focus:outline-none 
                        focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                  type="text" placeholder="Cliente..." wire:model="queryCustomer" autocomplete="false">
                <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 font-semibold" />
              </div>
              @error('customer_id')
              <div class="text-sm font-montserrat font-light text-eat-fuccia-500">{{ $message }}</div>
              @enderror

              <div x-show="open" x-on:click.away="open=false">
                <div class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                  <ul>
                    @foreach ($customers as $customer)
                    @if ($customer->id == $customer_id)
                    <li wire:click="SelectCustomer({{$customer}})" href="#"
                      class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                      {{$customer->name}}</li>
                    @else
                    <li x-on:click="open=false" wire:click="SelectCustomer({{$customer}})" href="#"
                      class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                      {{$customer->name}}</li>
                    @endif
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          @if ($addCustomer)
          <x-icons.add wire:click="editCustomer" class="mr-2 cursor-pointer"></x-icons.add>
          @endif
        </div>
      </div>
      @if ($addCustomer)
      <p class="text-xs text-eat-fuccia-500 font-montserrat font-light tracking-tight mt-1 ">Cliente no
        existe.
        + para
        agregar</p>
      @endif
      @error('queryCustomer')
      <div class="text-sm font-montserrat font-light text-eat-fuccia-500">{{ $message }}</div>
      @enderror
      <div x-show="open">
        <x-utils.text-input wire:model="street" class="mt-2" type="text" required="true"
          placeholder="Calle y Número..." />
        <div class="flex items-center mt-2">
          <x-utils.text-input wire:model="suburb" class="" type="text" required="true" placeholder="Colonia..." />
          <x-utils.text-input wire:model="phone" class="ml-1" type="text" required="true" placeholder="Telefono..." />
        </div>
        <div class="flex items-center justify-end mt-2">
          <x-utils.button wire:click="CancelSaveCustomer" class="h-10 mr-2 px-2" color="eat-fuccia">Cancelar
          </x-utils.button>
          <x-utils.button wire:click="SaveCustomer" class="h-10" color="eat-olive">guardar</x-utils.button>
        </div>
      </div>
      <!-- End Input Customer -->

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

      <!-- Quien entrega -->
      <div class="relative mb-4">
        <x-utils.text-input wire:model="delivery_guy" type="text" label="" :required="false" placeholder="" pl="pl-24"
          class="w-full mt-2 md:mt-4" />
        <p class="absolute top-2 left-3 text-gray-500 text-sm font-montserrat font-bold">Repartidor:</p>
      </div>
      <!-- End Quien entrega -->

      <!-- A donde se entrega -->
      <select wire:model="selectedtable" class=" w-full rounded-md shadow-md form-input block text-eat-olive-900 font-montserrat placeholder-eat-olive-50
      bg-eat-white-500 font-bold
      border
      border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
      sm:leading-5">
        <option value="">== Mesa ==</option>
        @foreach ($mesa as $key => $item)
        <option value="{{$key}}">{{$item}}</option>
        @endforeach
      </select>
      <!-- End A donde se entrega -->

      <!-- Nota adicional -->
      <div class="mt-4 mb-2">
        <textarea placeholder="Notas adicionales para el chef, mesero, o repartidor"
          class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                      border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent" name="" id="" cols="30" rows="5" wire:model="note"></textarea>
        @error('note')
        <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
        @enderror
      </div>
      <!-- End Nota adicional -->
    </div>

    <div class="mt-2 col-span-2 ">
      <div class="font-montserrat bg-eat-green-600 text-eat-olive-500 text-xs rounded-sm p-2">
        <p class=" ">Cliente: <span class="font-semibold tracking-tight">{{$queryCustomer}}</span></p>
        @if($ordercustomer)
        <p class=" ">Dirección: <span class="font-semibold tracking-tight">{{$ordercustomer->street}}</span>
          @endif
        </p>
      </div>

      <div class="flex items-center mt-2">
        <p class="w-1/5">Cant.</p>
        <p class="w-1/2">Platillo</p>
        <p class="w-1/5">Precio</p>
      </div>
      <hr class=" border-eat-olive-50 mb-4 ">
      <div class=" max-h-44 overflow-y-scroll">
        @forelse ($dishList as $key => $dish)
        <div class="flex items-center pl-1">
          <div class="w-1/5 pr-1 py-1">
            <div class=" relative rounded-md shadow-md">
              <input min="1" wire:model="dishList.{{$key}}.qty" wire:keydown="changeQty" type="number"
                value="{{$dish['qty']}}" class="form-input block w-full  text-eat-olive-900 font-montserrat placeholder-eat-olive-50
            border
            border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
            sm:leading-5" autocomplete="off">
            </div>
          </div>
          <p class="w-1/2">{{$dish['name']}}</p>
          <p class="w-1/5">${{$prices[$key]}}</p>
          <a href="#" onclick="confirmAction('deleteDish', {{ $key }});" data-title='Elimina el platillo'
            data-placement="top" class="tooltip_recipe text-eat-fuccia-500 hover:text-eat-fuccia-600 underline pl-2">
            <x-icons.remove />
          </a>

        </div>
        @empty

        @endforelse
      </div>
      <hr class=" border-eat-olive-50 ">
      <div class="flex items-center justify-end">
        <p class="w-1/5"></p>
        <p class="w-1/5">Total</p>
        <p class="w-1/2 bg-eat-green-100 text-left">${{$total}}MXN</p>
      </div>

      <button wire:click="ordenar" type="submit"
        class=" w-full h-8 text-center font-montserrat mt-4 bg-eat-olive-500 border border-transparent rounded-md font-semibold text-xs text-eat-white-500 uppercase tracking-wider hover:bg-eat-olive-400 active:bg-eat-olive-700 focus:outline-none focus:border-eat-olive-700 focus:ring ring-eat-olive-300 disabled:opacity-25 transition ease-in-out duration-150'">Ordenar</button>

    </div>
  </div>

</div>