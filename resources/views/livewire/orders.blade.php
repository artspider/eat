<div>
  {{ Breadcrumbs::render('orders') }}

  <div class="bg-white rounded-md shadow-md p-4 ">
    <x-utils.subtitle class="mb-4">Lista de ordenes</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    <div class="md:flex w-full">
      <div class="w-full md:w-1/3 relative">
        <x-utils.text-input wire:model="search" type="text" label="" :required="true" placeholder="Número de orden"
          class="mb-4 rounded-md" />
        <div class="absolute top-0 right-12 cursor-pointer">
          <x-icons.search class=" " />
        </div>
      </div>
      <div class="w-full md:w-1/3 ">
        <x-utils.button wire:click="clear" class="h-10 md:ml-4 shadow-md w-full md:w-1/3 mb-6 md:mb-0 justify-center"
          color="eat-olive">Limpiar</x-utils.button>
      </div>
      <div class=" w-full flex justify-end  md:w-1/3">
        <div data-tippy-content="Ordenar" data-placement="left" onclick="Livewire.emit('openModal', 'order-create')"
          class="tooltip_order rounded-lg shadow-md text-eat-olive-500 hover:text-eat-olive-800 bg-eat-green-500 hover:bg-eat-green-300 w-10 h-10 pl-2 pt-2 cursor-pointer">
          <x-icons.bell class=" " />
        </div>
      </div>
    </div>

    <div class="flex items-center mb-2">
      <p class="mr-4">Fecha de la orden:</p>

      @if ($anyDay)
      <input wire:model="searchDate" type="date" class="ml-2 mr-4" disabled>
      @else
      <input wire:model="searchDate" type="date" class="ml-2 mr-4">
      @endif
      <input type="checkbox" name="" id="" wire:model="anyDay">
      <label class="ml-2 mr-4" for=""> Cualquier día </label>

    </div>
    @if ($orders && $orders->count())
    @php
    $headers = array("ID", "Hora", "Cliente", "Mesa", "Total", "Status", "Acciones") ;
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
        @forelse ($orders as $order)
        <tr
          class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              ID:
            </span>
            <div class="ml-4 text-sm font-montserrat">
              <div class="">{{$order->id}}</div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              Hora:
            </span>
            <div class="ml-4 text-sm font-montserrat">
              <div class="">{{$order->created_at->format('H:i')}}</div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span
              class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Cliente</span>
            <p class="text-sm font-montserrat text-center">{{$order->customer->name}}</p>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Mesa</span>
            <p class="text-sm font-montserrat text-center">{{$order->table}}</p>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Total</span>
            <p class="text-sm font-montserrat text-center">${{$order->total}}MXN</p>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span
              class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
            <p class="text-sm font-montserrat text-center">{{$order->status->first()->status}}</p>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span
              class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acciones</span>
            <div data-tippy-content="EditarOrden" data-placement="left"
              onclick='Livewire.emit("openModal", "order-edit",  {{ json_encode(["order" => $order]) }})'
              class="tooltip_order text-eat-olive-400 cursor-pointer">
              <x-icons.edit class="" />

              <!-- Inside existing Livewire component -->


            </div>
          </td>
        </tr>
        @empty

        @endforelse

      </tbody>
    </table>

    @else
    <x-icons.no-recipes />
    <x-utils.text class="text-center mb-6">¡Todas las ordenes estan completadas!</x-utils.text>
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
		'.tooltip_order', {
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