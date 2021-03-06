<div>
  {{ Breadcrumbs::render('products-create') }}

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Agregar nuevo producto</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    <form wire:submit.prevent="save">
      <div class="block lg:grid grid-cols-2 gap-4">
        <div class=" col-span-1 ">
          <x-utils.text-input wire:model="name" type="text" label="Nombre del producto" :required="true"
            placeholder="Ingresa el nombre del nuevo producto" class="" />

          <div class="mt-6">
            <div x-data="{open: false}">
              <label for="unit" class="block text-sm font-medium leading-5 text-eat-olive-700">Categoria</label>
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
            {{-- <label for="category" class="block text-sm font-medium leading-5 text-eat-olive-700">Categoria</label>
                  <div class="mt-1 relative rounded-md shadow-md">
                    <select name="category" id="category" wire:model="category_id"
                            class="form-input block w-full pr-10 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5" >
                      <option hidden selected>Selecciona una categoria</option>
                      @forelse ($categories as $category)
                      <option class="select-option text-sm text-eat-olive-900  checked:bg-eat-olive-50 font-medium font-montserrat" value="{{$category->id}}">{{$category->name}}
            </option>
            @empty
            @endforelse
            </select>
            @error('category')
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                  d="M16.143 2l5.857 5.858v8.284l-5.857 5.858h-8.286l-5.857-5.858v-8.284l5.857-5.858h8.286zm.828-2h-9.942l-7.029 7.029v9.941l7.029 7.03h9.941l7.03-7.029v-9.942l-7.029-7.029zm-6.471 6h3l-1 8h-1l-1-8zm1.5 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
              </svg>
            </div>
            @enderror
          </div> --}}
        </div>

        <div class="mt-6 md:flex items-center">
          <div class="w-full md:w-1/3 md:mr-4">
            <x-utils.text-input wire:model="content" type="text" label="Cantidad de producto" :required="true"
              placeholder="Cantidad" class="" />
          </div>
          <div class="w-full mt-6 md:mt-0 md:w-2/3">
            <label for="unit" class="block text-sm font-medium leading-5 text-eat-olive-700">Unidad de medida</label>
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

            {{-- < div class="mt-1 relative rounded-md shadow-md">
                      <select name="unit" id="unit" wire:model="unit_id"
                        class="form-input block w-full pr-10 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5" >
                        <option hidden selected>Selecciona una unidad</option>
                        @forelse ($units as $unit)
                          <option class="text-sm text-eat-olive-900 font-medium font-montserrat" value="{{$unit->id}}">{{$unit->unit}}
            </option>
            @empty
            @endforelse
            </select>
            @error('unit')
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                  d="M16.143 2l5.857 5.858v8.284l-5.857 5.858h-8.286l-5.857-5.858v-8.284l5.857-5.858h8.286zm.828-2h-9.942l-7.029 7.029v9.941l7.029 7.03h9.941l7.03-7.029v-9.942l-7.029-7.029zm-6.471 6h3l-1 8h-1l-1-8zm1.5 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
              </svg>
            </div>
            @enderror
          </div> --}}
        </div>

      </div>

      <div class="mt-6 md:flex items-center">
        <div class="w-full md:w-1/2 md:mr-4">
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
        <div class="mt-6 md:mt-0 w-full md:w-2/5">
          <x-utils.text-input wire:model="stock" type="text" label="Cantidad en stock" :required="true"
            placeholder="Cantidad" class="" />
        </div>
      </div>

      <x-utils.text-input wire:model="presentation" type="text" label="Presentaci??n" :required="true"
        placeholder="Presentaci??n, por ejemplo: Lata, botella, granel" class="mt-6" />

      <div class="mt-6 md:flex items-center">
        <div class="w-full md:w-1/3 md:mr-2">
          <x-utils.text-input wire:model="brand" type="text" label="Marca" :required="true"
            placeholder="Gamesa, Bimbo, etc." class="" />
        </div>
        <div class="w-full mt-6 md:mt-0 md:w-2/3">
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
        <textarea placeholder="Descripci??n o detalles adicionales, por ejemplo: fecha de caducidad, n??mero de serie"
          class="shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                            border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent"
          name="" id="" cols="30" rows="5" wire:model="other"></textarea>
      </div>

  </div>

  <div class=" col-span-1 ">
    <div class=" text-eat-olive-500 cursor-pointer mt-4 px-4">
      <label class="flex items-center cursor-pointer mt-8 mb-4" for="photo">
        <x-icons.avatar class="pr-3 " />
        <p class="mr-4">Subir im??gen </p>
        <div wire:loading wire:target="photo">
          <x-utils.loading />
        </div>
      </label>
      <div class="flex justify-center p-4">
        @if ($photo)
        <img class=" w-auto h-64 " src="{{ $photo->temporaryUrl() }}">
        @else
        <x-icons.upload-image width="w-52" height="h-52" />
        @endif
      </div>
      <input class="hidden" wire:model="photo" type="file" name="photo" id="photo">
      @error('photo')
      <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
      @enderror
    </div>


    <div class="mt-6 px-4 flex justify-end">
      <x-utils.button color="eat-olive" type="submit">Guardar</x-utils.button>
    </div>
  </div>
</div>
</form>
</div>
</div>
@push('modals')
<script>
  Livewire.on('success', message => {
    StayOrLeave(message,'??Deseas agregar otro?','/admin/products');
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