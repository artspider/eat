<div>

    {{ Breadcrumbs::render('suppliers') }}
    <div class="bg-white rounded-md shadow-md p-10 ">
        <x-utils.subtitle class="mb-4">Lista de provedores</x-utils.subtitle>
        <hr class=" border-eat-olive-50 mb-6 ">
        @if ($suppliers && $suppliers->count())
        @php
        $headers = array("Nombre", "Direccion", "Teléfono", "Website", "Acciones");
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
                @forelse ($suppliers as $supplier)
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
                            Proveedor
                        </span>
                        <div class="flex items-center justify-center md:justify-start">
                            <div class="ml-4 text-sm font-montserrat">
                                <div class="">{{$supplier->company_name}}</div>
                            </div>
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static  flex items-center justify-center md:h-auto">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Dirección</span>
                        <div class=" flex-row mt-6 md:mt-0 text-center">
                            <div class=" flex-shrink-0">
                                <p class="text-sm font-montserrat ">{{$supplier->address}}, {{$supplier->suburb}}</p>
                            </div>
                            <div class="text-sm font-montserrat">
                                <p class="text-sm font-montserrat ">{{$supplier->city}}, {{$supplier->state}}</p>
                            </div>
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Teléfono</span>
                        <p class="text-sm font-montserrat text-center">{{$supplier->phone}}</p>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Website</span>
                        <a href="http://{{$supplier->website}}" target="_blank">
                            <p class="text-sm font-montserrat text-center">{{$supplier->website}}</p>
                        </a>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acciones</span>
                        <div class="flex justify-center">
                            <a href="{{ route('admin-suppliers-edit', [$supplier->company_name]) }}" id="editProduct"
                                data-title='Edita los datos del proveedor' data-placement="left"
                                class="tooltip_supplier mr-3 text-eat-green-400 hover:text-eat-green-600 underline">
                                <x-icons.edit />
                            </a>
                            <a href="#" onclick="confirmAction('deleteSupplier', {{ $supplier }});"
                                data-title='Elimina el proveedor' data-placement="top"
                                class="tooltip_supplier text-eat-fuccia-500 hover:text-eat-fuccia-600 underline pl-2">
                                <x-icons.remove />
                            </a>
                        </div>
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $suppliers->links() }}
        </div>
        @else
        <x-icons.not-found />
        <x-utils.text class="text-center mb-6">¡Al parecer no hay proveedores! Puedes agregar haciendo clic en el botón
            AGREGAR que esta abajo</x-utils.text>
        <hr class=" border-eat-olive-50 mb-6 ">
        @endif
        <div class="flex justify-end mt-4">
            <x-utils.button id="createSupplier" color="eat-olive" onclick="location.href='/admin/suppliers/create'">
                Agregar
            </x-utils.button>
        </div>
    </div>
</div>
@push('modals')
<script>
Livewire.on('redirect', message => {
    fireMessageAndRedirect(message, '/admin/suppliers');
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
    '.tooltip_supplier', {
        content: (reference) => reference.getAttribute('data-title'),
        onMount(instance) {
            instance.popperInstance.setOptions({
                placement: instance.reference.getAttribute('data-placement')
            });
        },
        theme: 'tomato',
    },
);
</script>
@endpush