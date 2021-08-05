<x-layouts.master>
  {{ Breadcrumbs::render('dishes') }}

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Lista de platillos</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">
    @if ($dishes && $dishes->count())
    @else
    <x-icons.not-found />
    <x-utils.text class="text-center mb-6">¡Al parecer no hay platillos! Puedes agregar haciendo clic en el botón
      AGREGAR que esta abajo</x-utils.text>
    <hr class=" border-eat-olive-50 mb-6 ">
    @endif
    <div class="flex justify-end mt-4">
      <x-utils.button id="createProduct" color="eat-olive" onclick="location.href='/admin/dishes/create'">
        Agregar
      </x-utils.button>
    </div>
  </div>
</x-layouts.master>