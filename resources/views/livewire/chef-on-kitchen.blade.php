<div>
  <div class="mt-2">
    <div class="border border-eat-green-500 rounded-md shadow-lg p-4 mb-4">
      <h2 class="text-lg text-eat-olive-500 font-semibold font-raleway"> Solicita un platillo a la cocina</h2>
      <div class="flex items-center">
        <div class="w-full md:w-2/5 mr-1 ">
          <div x-data="{open: false}">
            <div class="relative">
              <div x-on:click="open=true"
                class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                {{-- <x-utils.text class="ml-4">{{$productName}}</x-utils.text> --}}
                <input class="w-full h-10 bg-eat-white-500 text-eat-olive-500 font-montserrat font-bold border 
                        border-transparent focus:outline-none 
                          focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                  type="text" name="" id="" placeholder="Receta..." wire:model="queryRecipe">
                <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
              </div>

              <div x-show="open" x-on:click.away="open=false">
                <div class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                  <ul>
                    @foreach ($recipes as $recipe)
                    @if ($recipe->id == $recipe_id)
                    <li wire:click="SelectRecipe({{$recipe}})" href="#"
                      class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                      {{$recipe->name}}</li>
                    @else
                    <li x-on:click="open=false" wire:click="SelectRecipe({{$recipe}})" href="#"
                      class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                      {{$recipe->name}}</li>
                    @endif
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div><!-- 1 -->

        <div class="flex flex-col">
          <div>
            {{$qty}} Gramos
          </div><!-- 2 -->
          {{-- <x-icons.add class="text-eat-olive-500 cursor-pointer ml-2" /> --}}
          <div wire:click.debounce.150ms="addRecipe()" class="text-center flex flex-col items-center bg-eat-green-500 text-eat-olive-500 rounded-md p-2 cursor-pointer
                        hover:bg-eat-green-300 hover:text-eat-olive-300 ml-4">
            <x-icons.bell class="mt-1" />
            <p class="text-xs">Ordenar</p>
          </div><!-- 3 -->
        </div>
      </div>
    </div>

  </div>

  <div class="border border-eat-green-500 rounded-md shadow-lg p-4 mb-4">
    <h2 class="text-lg text-eat-olive-500 font-semibold font-raleway">La cocina te ha terminado tu orden</h2>
    @forelse ($recipesInKitchen as $inKitchen)
    {{-- Lo que hay en la cocina --}}
    <div class="mt-2 flex items-center">
      <p class="text-semibold tracking-wide text-eat-olive-500 mr-2 w-2/5">{{$inKitchen->recipe->name}}
        <span>{{$inKitchen->updated_at->diffForHumans()}}</span>
      </p>
      <div wire:click="Recibir({{$inKitchen}})"
        class="px-2 py-1 mr-2 rounded-lg bg-eat-green-600 text-center txt-xs text-eat-olive-500 hover:text-eat-olive-300 pt-2 cursor-pointer hover:bg-eat-green-300">
        <span>Listo para usar en el menú</span>
      </div>
    </div>
    @empty
  </div>
  <x-icons.undraw-chef />
  @endforelse

  <div class="border border-eat-green-500 rounded-md shadow-lg p-4 mb-4">
    <h2 class="text-lg text-eat-olive-500 font-semibold font-raleway">Estos es lo que tienes en la cocina</h2>
    @php
    $headers = array("Platillo", "Cantidad total", "Cantidad Restante");
    @endphp
    <table class="border-collapse w-full">
      <thead>
        <tr>
          @foreach ($headers as $header)
          <th
            class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
            {{$header}}
          </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse ($recipesUsing as $item)
        <tr
          class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              Platillo
            </span>
            <div class="flex items-center justify-center md:justify-start">
              <div class=" flex-shrink-0 h-10 ">
                <img class="h-10 w-10 rounded-full"
                  src=" {{asset('storage/' . $item->recipe->recipeImages->first()->image) }}" alt="">
              </div>
              <div class="ml-4 text-sm font-montserrat">
                <div class="">{{$item->recipe->name}}</div>
              </div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Cant.
              Total</span>
            <p class="text-sm font-montserrat text-center">{{$item->qty}} Gramos</p>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Cant.
              Restante</span>
            <p class="text-sm font-montserrat text-center">{{$item->qtyleft}} Gramos</p>
          </td>
        </tr>
        @empty

        @endforelse
      </tbody>
    </table>
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
      {{ $recipesUsing->links() }}
    </div>

  </div>


</div>