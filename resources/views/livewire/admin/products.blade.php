<div>
  {{ Breadcrumbs::render('products') }}

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Lista de productos</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    <div class="md:flex w-full">
      <div class="w-full md:w-1/3 relative">
        <x-utils.text-input wire:model="search" type="text" label="" :required="true" placeholder="Buscar item"
          class="mb-4 rounded-md" />
        <div class="absolute top-0 right-12 cursor-pointer">
          <x-icons.search class=" " />
        </div>
      </div>
      <div class="w-full md:w-1/3 ">
        <x-utils.button wire:click="clear" class="h-10 md:ml-4 shadow-md w-full md:w-1/3 mb-6 md:mb-0 justify-center"
          color="eat-olive">Limpiar</x-utils.button>
      </div>

    </div>

    @if ($products && $products->count())
    @php
    $headers = array("Nombre", "Proveedor", "Stock", "precio", "Acciones");
    @endphp
    <x-utils.datatable :headers=$headers :products="$products" />
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
      {{ $products->links() }}
    </div>
    @else
    <x-icons.not-found />
    <x-utils.text class="text-center mb-6">¡Al parecer no hay productos! Puedes agregar haciendo clic en el botón
      AGREGAR que esta abajo</x-utils.text>
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