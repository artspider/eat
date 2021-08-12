<div>
  {{ Breadcrumbs::render('orders') }}

  <div class="bg-white rounded-md shadow-md p-4 ">
    <x-utils.subtitle class="mb-4">Lista de ordenes</x-utils.subtitle>
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
      <div class="w-full flex justify-end  md:w-1/3">
        <div onclick="Livewire.emit('openModal', 'order-create')"
          class="rounded-lg shadow-md text-eat-olive-500 hover:text-eat-olive-800 bg-eat-green-500 hover:bg-eat-green-300 w-10 h-10 pl-2 pt-2 cursor-pointer">
          <x-icons.bell class=" " />
        </div>
      </div>
    </div>
    @if ($orders && $orders->count())
    @php
    $headers = array("Hora", "Cliente", "Dirección", "Total", "Status");
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
    </table>

    @else
    <x-icons.no-recipes />
    <x-utils.text class="text-center mb-6">¡Al parecer no hay ordenes aún!</x-utils.text>
    <hr class=" border-eat-olive-50 mb-6 ">
    @endif


  </div>
</div>

@push('modals')
<script>
  Livewire.on('redirect', message => {
    fireMessageAndRedirect(message,'/admin/recipes');
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
Livewire.on('error', message => {
  thimsg = message;
			Toast.fire({
					icon: 'error',
					title: thimsg
			}); 
});
</script>
<script>
  tippy(
		'.tooltip_recipe', {
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