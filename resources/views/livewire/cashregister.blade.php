<div x-data="{ showModal: @entangle('showModal') }">
  {{ Breadcrumbs::render('cashregister') }}
  <div class="bg-white rounded-md shadow-md p-4 ">
    <x-utils.subtitle class="mb-4">Caja registradora</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">
    @if ($orders && $orders->count())
    @php
    $headers = array("No. Orden", "Mesa", "Cliente", "Total", "Acciones");
    @endphp
    <div class="flex items-center mb-2">
      <div class="flex items-center">
        <span class="text-sm font-semibold font-montserrat tracking-tight mr-2">Ver todos</span>
        <input type="checkbox" wire:model="seeAll"
          class=" h-4 w-4 text-eat-fuccia-600 focus:outline-none focus:ring-0 border-eat-fuccia-100 focus:border-eat-fuccia-100 ring-offset-0 focus:shadow-none">
      </div>
    </div>
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
              Orden:
            </span>
            <div class="flex items-center justify-center md:justify-start">
              <div class="ml-4 text-sm font-montserrat">
                <div class="">{{$order->id}}</div>
              </div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              Mesa:
            </span>
            <div class="flex items-center justify-center md:justify-start">
              <div class="ml-4 text-sm font-montserrat">
                <div class="">{{$order->table}}</div>
              </div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              Cliente:
            </span>
            <div class="flex items-center justify-center md:justify-start">
              <div class="ml-4 text-sm font-montserrat">
                <div class="">{{$order->customer->name}}</div>
              </div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              Total:
            </span>
            <div class="flex items-center justify-center md:justify-start">
              <div class="ml-4 text-sm font-montserrat">
                <div class="">${{$order->total}}MXN</div>
              </div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
            <span
              class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acciones</span>
            <div class="flex justify-center">
              <div wire:click="openModal({{$order}})" id="payOrder" data-title='Pagar orden' data-placement="left"
                class="tooltip_prduct rounded-lg shadow-md text-eat-olive-500 hover:text-eat-olive-800 bg-eat-green-500
              hover:bg-eat-green-300 w-10 h-10 pl-2 pt-2 cursor-pointer">
                <x-icons.cash />
              </div>

            </div>

          </td>
        </tr>
        @empty

        @endforelse
      </tbody>
    </table>
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
      {{ $orders->links() }}
    </div>

    <!-- Modal Background -->
    <div x-show="showModal"
      class="absolute  text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0"
      x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <!-- Modal -->
      <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-11/12 mx-10"
        @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
        x-transition:enter-start="opacity-0 scale-90 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease duration-100 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-1">

        @if ($order)
        <livewire:pay-order :order="$order" />
        @endif



      </div>
    </div>
    @else
    <x-icons.joy />
    <x-utils.text class="text-center mb-6">¡Todo pagado...!</x-utils.text>
    <hr class=" border-eat-olive-50 mb-6 ">
    @endif
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