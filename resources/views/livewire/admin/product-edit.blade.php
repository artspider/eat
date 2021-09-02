<div>
  {{ Breadcrumbs::render('products-edit', $slug) }}

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Modifica producto</x-utils.title>
      <hr class=" border-eat-olive-50 mb-6 ">

      <form wire:submit.prevent="edit">
        <div class="block lg:grid grid-cols-2 gap-4">
          <div class=" col-span-1 ">
            <x-utils.text-input wire:model="name" type="text" label="Nombre del producto" :required="true"
              placeholder="Ingresa el nombre del nuevo producto" class="" />
            <div class="mt-6">
              <div x-data="{open: false}">
                <label for="categoria" class="block text-sm font-medium leading-5 text-eat-olive-700">Categoria</label>
                <div class="relative">
                  <div x-on:click="open=true"
                    class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                    <x-utils.text class="ml-4">{{$categoryName}}</x-utils.text>
                    <x-icons.chevron class="mr-4 text-eat-olive-500 " />
                  </div>

                  <div x-show="open" x-on:click.away="open=false">
                    <div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                      <ul>
                        @foreach ($categories as $category)
                        @if ($category->id == $category_id)
                        <li wire:click="SelectCategory({{$category}})" href="#"
                          class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                          {{$category->name}}</li>
                        @else
                        <li x-on:click="open=false" wire:click="SelectCategory({{$category->id}})" href="#"
                          class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                          {{$category->name}}</li>
                        @endif
                        @endforeach
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
              @error('category')
              <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
              @enderror
            </div>

            <div class="mt-6 flex items-center">
              <div class="w-1/3 mr-4">
                <x-utils.text-input wire:model="content" type="text" label="Cantidad de producto" :required="true"
                  placeholder="Cantidad" class="" />
              </div>
              <div class="w-2/3">
                <label for="unit" class="block text-sm font-medium leading-5 text-eat-olive-700">Unidad de
                  medida</label>
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
                          <li x-on:click="open=false" wire:click="SelectUnit({{$unit->id}})" href="#"
                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$unit->unit}}</li>
                          @endif

                          @endforeach
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
                @error('unit')
                <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                @enderror

              </div>

            </div>

            <div class="mt-6 flex items-center">
              <div class="w-1/2 mr-4">
                <div class="relative ">
                  <x-utils.text-input wire:model="price" type="text" label="Precio" :required="true"
                    placeholder="incluya centavos" pl="pl-8" />
                  @error('price')
                  <div class="absolute top-9 left-4 text-eat-olive-900 font-medium font-montserrat">$</div>
                  <div class="absolute top-9 right-10 text-eat-olive-900 font-medium font-montserrat">MXN</div>
                  @else
                  <div class="absolute top-9 left-4 text-eat-olive-900 font-medium font-montserrat">$</div>
                  <div class="absolute top-9 right-4 text-eat-olive-900 font-medium font-montserrat">MXN</div>
                  @endif
                </div>
              </div>
              <div class=" w-2/5">
                <x-utils.text-input wire:model="stock" type="text" label="Cantidad en stock" :required="true"
                  placeholder="Cantidad" class="" />
              </div>
            </div>

            <x-utils.text-input wire:model="presentation" type="text" label="Presentación" :required="true"
              placeholder="Presentación, por ejemplo: Lata, botella, granel" class="mt-6" />

            <div class="mt-6 flex items-center">
              <div class="w-1/3 mr-2">
                <x-utils.text-input wire:model="brand" type="text" label="Marca" :required="true"
                  placeholder="Gamesa, Bimbo, etc." class="" />
              </div>
              <div class="w-2/3">
                <label for="" class="block text-sm font-medium leading-5 text-eat-olive-700">Proveedor</label>
                <div x-data="{open: false}">
                  <div class="relative">
                    <div x-on:click="open=true"
                      class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                      <x-utils.text class="ml-4">{{$supplierName}}</x-utils.text>
                      <x-icons.chevron class="mr-4 text-eat-olive-500 " />
                    </div>

                    <div x-show="open" x-on:click.away="open=false">
                      <div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                        <ul>
                          @foreach ($suppliers as $supplier)
                          @if ($supplier->id == $supplier_id)
                          <li wire:click="SelectSupplier({{$supplier}})" href="#"
                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$supplier->company_name}}</li>
                          @else
                          <li x-on:click="open=false" wire:click="SelectSupplier({{$supplier->id}})" href="#"
                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                            {{$supplier->company_name}}</li>
                          @endif
                          @endforeach
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
                @error('supplier')
                <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                @enderror

              </div>
            </div>

            <div class="mt-6">
              <textarea
                placeholder="Descripción o detalles adicionales, por ejemplo: fecha de caducidad, número de serie"
                class="shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
              border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent"
                name="" id="" cols="30" rows="5" wire:model="other">
            </textarea>
            </div>

          </div>

          <div class=" col-span-1 ">
            <div class=" text-eat-olive-500 cursor-pointer mt-4 px-4">
              <label class="flex items-center cursor-pointer mb-4" for="photo">
                <x-icons.avatar class="pr-3 " />
                <p class="mr-4">Subir imágen </p>
              </label>
              <div class="flex justify-center bg-eat-green-500 p-4">
                @if ($photo)
                <img class=" w-full  h-64 " src="{{ $photo->temporaryUrl() }}">
                @else
                <img class=" w-full  h-64 " src="{{asset('storage/' . $photo_path) }}">
                @endif
              </div>
              <input class="hidden" wire:model="photo" type="file" name="photo" id="photo">
              @error('photo')
              <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
              @enderror
            </div>

            <div class="mt-6 px-4 flex justify-end">
              <x-utils.button class="p-4" color="eat-olive" type="submit">Modificar</x-utils.button>
            </div>
          </div>
        </div>
      </form>
  </div>
</div>
@push('modals')
<script>
  Livewire.on('success', message => {
    fireMessageAndRedirect(message,'/admin/products');
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