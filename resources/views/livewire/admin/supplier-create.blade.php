<div>
    {{ Breadcrumbs::render('suppliers-create') }}

    <div class="bg-white rounded-md shadow-md p-10 ">
        <x-utils.subtitle class="mb-4">Agregar nuevo proveedor</x-utils.subtitle>
        <hr class=" border-eat-olive-50 mb-6 ">

        <form wire:submit.prevent="save">
          <div class="block lg:grid grid-cols-2 gap-4">
            <div class=" col-span-1 ">
              <x-utils.text-input
                    wire:model="company_name"
                    type="text"
                    label="Nombre del proveedor"                  
                    :required="true"
                    placeholder="Ingresa el nombre del nuevo proveedor"
                    class="mb-6"
              />
              <div class="flex items-center mb-6">
                <x-utils.text-input
                  wire:model="contact_title"
                  type="text"
                  label="Titulo"                  
                  :required="false"
                  placeholder="Sr."
                  class="w-1/5 mr-4"
                />
                <x-utils.text-input
                  wire:model="contact_name"
                  type="text"
                  label="Nombre del contacto"                  
                  :required="false"
                  placeholder="Ingresa el nombre del contacto"
                  class="w-4/5"
                />
              </div>
              <div class="flex items-center">
                <x-utils.text-input
                  wire:model="address"
                  type="text"
                  label="Calle y número"
                  :required="false"
                  placeholder="Calle y número"
                  class="w-3/5 mr-4"
                />
                <x-utils.text-input
                  wire:model="suburb"
                  type="text"
                  label="Colonia"
                  :required="true"
                  placeholder="Colonia"
                  class="w-2/5 "
                />
              </div>
                
            </div>
            <div class="col-span-1">
              <div class="flex items-center mb-6">
                <x-utils.text-input
                  wire:model="city"
                  type="text"
                  label="Ciudad"
                  :required="true"
                  placeholder="Ciudad"
                  class="w-3/5 mr-4"
                />
                <x-utils.text-input
                  wire:model="state"
                  type="text"
                  label="Estado"
                  :required="true"
                  placeholder="Estado"
                  class="w-2/5 "
                />
              </div>
              <div class="flex items-center mb-6">
                <x-utils.text-input
                  wire:model="zip"
                  type="text"
                  label="Código Postal"
                  
                  placeholder="C.P. a 5 dígitos"
                  class=" w-2/5 mr-4 "
                />
                <x-utils.text-input
                  wire:model="phone"
                  type="text"
                  label="Teléfono"
                  :required="false"
                  placeholder="Teléfono a 10 dígitos"
                  class=" w-3/5 "
                />
              </div>
              <x-utils.text-input
                  wire:model="website"
                  type="text"
                  label="Sitio Web"
                  :required="false"
                  placeholder="Sitio web"
                  class=" "
                />
              <div class="mt-6 flex justify-end">
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
    StayOrLeave(message,'¿Deseas agregar otro?','/admin/suppliers');
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
