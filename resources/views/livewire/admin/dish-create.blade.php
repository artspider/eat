<div>
  {{ Breadcrumbs::render('dishes-create') }}

  @if ($errors->any())
  <script>
    Toast.fire({
            icon: 'error',
            title: 'Ocurrio un error, revise sus datos'
          });
  </script>
  @endif

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Agregar nuevo platillo al menú</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    <div x-data="{ tab: @entangle('tabSelection') }">
      <nav>
        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 0 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              x-on:click="tab=0"
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.config class="text-base mr-1" /> Generales
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 1 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              wire:click=selectIngredient()
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.list class="text-base mr-1" /> Componentes
            </a>
          </li>

          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              wire:click=selectImages()
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.photo class="text-base mr-1" /> Imágenes
            </a>
          </li>
        </ul>
      </nav>

      <form wire:submit.prevent="save">
        @csrf
        <div x-show="tab===0" class="block lg:grid grid-cols-1 gap-4 place-items-center">
          <div class="col-span-1 w-2/3 my-8">
            <x-utils.text-input wire:model="name" type="text" label="Nombre del platillo" :required="true"
              placeholder="Nombra a este platillo" class="w-full mb-8 md:mt-0" />

            <div class="mb-8">
              <textarea wire:model="description" placeholder="Describa el platillo que se esta agregando al menú"
                class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                          border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent" name="description" id="description" cols="30" rows="5"></textarea>
            </div>

            <div class="mb-8">
              <label for="menu" class="block text-sm font-medium leading-5 text-eat-olive-700">Del Menú</label>
              <select wire:model="selectedMenu" class=" w-full rounded-md shadow-md form-input block text-eat-olive-900 font-montserrat placeholder-eat-olive-50
              bg-eat-white-500 font-bold
              border
              border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
              sm:leading-5">
                <option value="">== MENÚ ==</option>
                @foreach ($menus as $key => $menu)
                <option value="{{$key}}">{{$menu}}</option>
                @endforeach
              </select>
            </div>

            @if ($section)
            <div class="mb-8">
              <label for="menu" class="block text-sm font-medium leading-5 text-eat-olive-700">Sección</label>
              <select wire:model="selectedSection" class=" w-full rounded-md shadow-md form-input block text-eat-olive-900 font-montserrat placeholder-eat-olive-50
              bg-eat-white-500 font-bold
              border
              border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
              sm:leading-5">
                <option value="">== SECCIÓN ==</option>
                @foreach ($section as $key => $item)
                <option value="{{$key}}">{{$item}}</option>
                @endforeach
              </select>
            </div>
            @endif



            <div class="flex items-center mb-8">
              <div class="flex items-center relative w-1/3">
                <x-utils.text-input wire:model="servTime" type="number" label="Tiempo en el que se sirve"
                  :required="true" placeholder="00" class="w-full mr-2" />
                <p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
              </div>

              <div class="flex items-center relative w-2/5">
                <x-utils.text-input wire:model="dishYield" type="number" label="Rinde para" :required="true"
                  placeholder="0" class="w-full mr-2" />
                <p class=" absolute top-8 left-16 text-eat-olive-600 text-sm">Persona(s)</p>
              </div>
            </div>

            <div class="flex items-center mb-8 ">
              <div class="relative w-1/2 mr-1">
                <x-utils.text-input wire:model="price" type="text" label="Precio público" :required="true"
                  placeholder="0" pl="pl-8" class="w-full mr-2" />
                <p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
                <p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
              </div>

              <div class="relative w-1/2 mr-1">
                <x-utils.text-input wire:model="cost" type="text" label="Costo" :required="true" placeholder="0"
                  pl="pl-8" class="w-full mr-2" />
                <p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
                <p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
              </div>
            </div>

            <div x-data="{stock: false}" class="flex items-center justify-evenly">
              <span>Existe en stock?</span>
              <p x-on:click="stock=!stock" wire:click="changeStock()"
                :class="stock ? 'bg-eat-green-600 text-eat-olive-500' : 'bg-eat-fuccia-600 text-eat-white-50'"
                class="w-1/2 py-2 text-center cursor-pointer">Stock</p>
            </div>
          </div>
        </div>

        <div x-show="tab===1" class="block lg:grid grid-cols-1 gap-4 place-items-center">
          <div class="col-span-1 w-2/3 my-8">
            <p class="block text-sm font-medium leading-5 text-eat-olive-700">Ingredientes</p>
            <div class="flex items-center">
              <input wire:model="ingredientQty" name="ingredientQty" type="number" min="1" max="999" value="1"
                id="ingredientQty" placeholder="cantidad" class="form-input block w-1/5 pr-2 text-eat-olive-900 font-montserrat 
                      placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 
                      focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 mr-1">

              <div class="w-full md:w-1/3 md:mr-1">
                <div x-data="{open: false}">
                  <div class="relative">
                    <div x-on:click="open=true"
                      class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                      <x-utils.text class="ml-4">{{$unitName}}</x-utils.text>
                      <x-icons.chevron class="mr-4 text-eat-olive-500 " />
                    </div>

                    <div x-show="open" x-on:click.away="open=false">
                      <div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                        <ul>
                          @foreach ($units as $unit)
                          @if ($unit->id == $unit_id)
                          <li wire:click="SelectUnit({{$unit}})" href="#"
                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$unit->unit}}</li>
                          @else
                          <li x-on:click="open=false" wire:click="SelectUnit({{$unit}})" href="#"
                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$unit->unit}}</li>
                          @endif
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="w-full md:w-2/5 mr-1 ">
                <div x-data="{open: false}">
                  <div class="relative">
                    <div x-on:click="open=true"
                      class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                      {{-- <x-utils.text class="ml-4">{{$productName}}</x-utils.text> --}}
                      <input class="w-full h-10 bg-eat-white-500 text-eat-olive-500 font-montserrat font-bold border 
                      border-transparent focus:outline-none 
                        focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                        type="text" name="" id="" placeholder="Producto..." wire:model="queryProduct">
                      <x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
                    </div>

                    <div x-show="open" x-on:click.away="open=false">
                      <div class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                        <ul>
                          @foreach ($products as $product)
                          @if ($product->id == $product_id)
                          <li wire:click="SelectProduct({{$product}})" href="#"
                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$product->name}}</li>
                          @else
                          <li x-on:click="open=false" wire:click="SelectProduct({{$product}})" href="#"
                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$product->name}}</li>
                          @endif
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <x-icons.add wire:click.debounce.150ms="addIngredient()" class="text-eat-olive-500 cursor-pointer" />
            </div>
            @if ($ingredientList)
            <ul class="mt-8">
              @foreach ($ingredientList as $key => $ingredient)
              <div class="flex items-center mt-4">
                <div class="flex items-center w-3/5">
                  <p
                    class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
                    {{$key + 1}} </p>
                  <li class=" text-eat-olive-500 font-montserrat text-sm"> {{$ingredient['qty']}}
                    {{$ingredient['unit']}}(s)
                    de
                    {{$ingredient['product']}}
                    ${{round($ingredient['total'],2)}}
                  </li>
                </div>
                <div wire:click="deleteIngredient({{ $key }})" class="text-eat-fuccia-500 w-6 cursor-pointer">
                  <x-icons.remove />
                </div>
              </div>
              @endforeach
            </ul>
            @else
            <div class="mt-4">
              <x-icons.not-found w='24' h='24' />
              <x-utils.text class="text-center">Sin ingredientes</x-utils.text>
            </div>
            @endif
          </div>

          <div class="col-span-1 w-2/3 my-6">
            <p class="block text-sm font-medium leading-5 text-eat-olive-700">Receta(s)</p>
            <div class="flex items-center">
              <input wire:model="recipeQty" name="recipeQty" type="number" min="1" max="999" value="1" id="recipeQty"
                placeholder="cantidad" class="form-input block w-1/5 pr-2 text-eat-olive-900 font-montserrat 
                      placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 
                      focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 mr-1">



              <div class="w-full md:w-1/3 md:mr-1">
                <div x-data="{open: false}">
                  <div class="relative">
                    <div x-on:click="open=true"
                      class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                      <x-utils.text class="ml-4">{{$unitRecipeName }}</x-utils.text>
                      <x-icons.chevron class="mr-4 text-eat-olive-500 " />
                    </div>

                    <div x-show="open" x-on:click.away="open=false">
                      <div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                        <ul>
                          @foreach ($units as $unit)
                          @if ($unit->id == $recipeUnit_id)
                          <li wire:click="SelectRecipeUnit({{$unit}})" href="#"
                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$unit->unit}}</li>
                          @else
                          <li x-on:click="open=false" wire:click="SelectRecipeUnit({{$unit}})" href="#"
                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$unit->unit}}</li>
                          @endif
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="w-full md:w-2/5 mr-1 ">
                <div x-data="{open: false}">
                  <div class="relative">
                    <div x-on:click="open=true"
                      class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                      {{-- <x-utils.text class="ml-4">{{$productName}}</x-utils.text> --}}
                      <input
                        class="w-full h-10 bg-eat-white-500 text-eat-olive-500 font-montserrat font-bold border 
                              border-transparent focus:outline-none 
                                focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                        type="text" name="queryRecipe" id="queryRecipe" placeholder="Producto..."
                        wire:model="queryRecipe">
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
              </div>

              <x-icons.add wire:click.debounce.150ms="addRecipe()" class="text-eat-olive-500 cursor-pointer" />
            </div>

            @if ($recipeList)
            <ul class="mt-8">
              @foreach ($recipeList as $key => $recipe)

              <div class="flex items-center mt-4">
                <div class="flex items-center w-3/5">
                  <p
                    class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
                    {{$key + 1}} </p>
                  <li class=" text-eat-olive-500 font-montserrat text-sm">
                    {{$recipe['qty']}}
                    {{$recipe['unit']}}(s)
                    de
                    {{$recipe['recipe']}}
                    ${{round($recipe['total'],2)}}
                  </li>
                </div>
                <div wire:click="deleteRecipe({{ $key }})" class="text-eat-fuccia-500 w-6 cursor-pointer">
                  <x-icons.remove />
                </div>
              </div>
              @endforeach
            </ul>
            @else
            <div class="mt-4">
              <x-icons.not-found w='24' h='24' />
              <x-utils.text class="text-center">Sin recetas</x-utils.text>
            </div>
            @endif
          </div>
        </div>

        <div x-show="tab===2" class="block lg:grid grid-cols-1 gap-4 place-items-center">
          <div class="col-span-1 w-2/3 my-8">
            <div class=" text-eat-olive-500 mt-4 px-4">
              <label class="flex items-center cursor-pointer mt-8 mb-4" for="photos">
                <x-icons.avatar class="pr-3 " />
                <p class="mr-4">Subir imágen(es) </p>
                <div wire:loading wire:target="photos">
                  <x-utils.loading />
                </div>
              </label>

              <div class="flex flex-wrap justify-center p-4">

                @forelse ($photos as $key => $photo)
                <img class=" w-1/4 h-20 mr-1 mt-2" src="{{ $photo->temporaryUrl() }}">
                @empty
                <x-icons.upload-image width="w-40" height="h-40" />
                @endforelse


              </div>
              <input class="hidden" wire:model="photos" type="file" name="photos" id="photos" multiple>


              @error('photos')
              <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
              @enderror
            </div>

          </div>
        </div>

        <hr class=" border-eat-olive-50 mb-6 ">
        <div class="mt-6 flex justify-end">
          <x-utils.button color="eat-olive" type="submit">Guardar</x-utils.button>
        </div>

      </form>
    </div>
  </div>
</div>
@push('modals')
<script>
  Livewire.on('success', message => {
    StayOrLeave(message,'¿Deseas agregar otro?','/admin/recipes');
  });

  Livewire.on('error', message => {
    thimsg = message;
    Toast.fire({
      icon: 'error',
      title: thimsg
    });
  })

</script>
@endpush