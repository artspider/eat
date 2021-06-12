<div>
    {{ Breadcrumbs::render('products') }}
    
    <div class="bg-white rounded-md shadow-md p-10 ">
        <x-utils.subtitle class="mb-4">Lista de productos</x-utils.subtitle>
        <hr class=" border-eat-olive-50 mb-6 ">
        @if ($products)
        <table class="border-collapse w-full">
          <thead>
            <tr>
              <th
                class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
                Nombre</th>
              <th
                class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
                Proveedor</th>
              <th
                class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
                Stock</th>
              <th
                class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
                Precio</th>
              <th
                class="p-3 text-xs font-light font-montserrat  uppercase bg-eat-olive-500 text-eat-white-500 border border-eat-white-200 hidden lg:table-cell">
                Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $product)
            <tr
              class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
              <td
                class="w-full lg:w-auto p-3 text-gray-800 border border-b block lg:table-cell relative lg:static">
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
                  Nombre
                </span>
                <div class="flex items-center">
                  <div class=" flex-shrink-0 h-10 ">
                    <img class="h-10 w-10 rounded-full" src=" {{asset('storage/' . $product->photo) }}" alt="">
                  </div>
                  <div class="ml-4 text-sm font-montserrat">
                    <div class="">{{$product->name}} - {{$product->brand}}</div>
                  </div>
                </div>  
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800  border border-b text-center block lg:table-cell relative lg:static">
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Rol</span>
                <p class="text-sm font-montserrat">{{$product->supplier->company_name}}</p>  
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Dirección</span>
                <span class="font-montserrat text-sm">
                  @php
                    $tot_stock = $product->stock * $product->content;
                  @endphp
                  <p class="text-sm font-montserrat">{{$tot_stock}} {{$product->unit->unit}}</p> 
                 
                </span>
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Teléfono</span>
                <span class="">
                  @php
                    if($product->unit->unit == 'Gramo'){
                      $price = round($product->price / $product->content, 3);
                    }else{
                      $price = $product->price; 
                    }
                  @endphp
                  <p class="text-sm font-montserrat">${{$price}}/{{$product->unit->unit}} MXN</p>
                  
                  
                </span>
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acciones</span>
                <div class="flex justify-center">
                  <a href="{{ route('admin-products-edit', [$product->slug]) }}" id="editProduct"
                    data-title='Edita los datos del producto' data-placement="left"
                    class="tooltip_prduct text-eat-green-400 hover:text-eat-green-600 underline">
                    <x-icons.edit />
                  </a>
                  <a href="#" onclick="confirmAction('deleteProduct', {{ $product }});"
                    data-title='Elimina el producto' data-placement="top"
                    class="tooltip_prduct text-eat-fuccia-500 hover:text-eat-fuccia-600 underline pl-2">
                    <x-icons.remove />
                  </a>
                </div>
  
              </td>
            </tr>  
            @empty
            @endforelse
          </tbody>
        </table>
        @else
        <x-icons.not-found />
        <x-utils.text class="text-center mb-6">¡Al parecer no hay productos! Puedes agregar haciendo clic en el botón AGREGAR que esta abajo</x-utils.text>
        <hr class=" border-eat-olive-50 mb-6 ">
        @endif        
        <div class="flex justify-end mt-4">
          <x-utils.button id="createProduct" color="eat-olive" onclick="location.href='/admin/products/create'">
            Agregar
          </x-utils.button>            
        </div>
    </div>
</div>
@push('modals')
<script>
  Livewire.on('redirect', message => {
    fireMessageAndRedirect(message,'/admin/users');
  });
</script>
<script>  
Livewire.on('success', message => {
  thimsg = message;
			Toast.fire({
					icon: 'success',
					title: thimsg
			}); 
});
</script>
<script>
	tippy(
		'.tooltip_prduct', {
    content:(reference)=>reference.getAttribute('data-title'),
    onMount(instance) {
        instance.popperInstance.setOptions({
        placement :instance.reference.getAttribute('data-placement')
        });
    },
		theme: 'tomato',	
},
);
</script>
@endpush
