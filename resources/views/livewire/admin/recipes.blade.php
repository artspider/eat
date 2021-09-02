<div>
  {{ Breadcrumbs::render('recipes') }}

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Lista de recetas</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    @if ($recipes && $recipes->count())
    @php
    $headers = array("Nombre", "Categoria", "Precio", "Estatus", "Acciones");
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
        @foreach ($recipes as $recipe)
        <tr
          class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-montserrat uppercase">
              Nombre
            </span>
            <div class="flex items-center justify-center md:justify-start">
              <div class=" flex-shrink-0 h-10 ">
                <img class="h-10 w-10 rounded-full"
                  src=" {{asset('storage/' . $recipe->recipeImages()->first()->image) }}" alt="">
              </div>
              <div class="ml-4 text-sm font-montserrat">
                <div class="">{{$recipe->name}}</div>
              </div>
            </div>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
              Categoria
            </span>
            <span class="font-montserrat text-sm text-center">
              <p class="text-sm font-montserrat">{{$recipe->recipeCategory->name}}</p>
            </span>
          </td>

          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
              Precio
            </span>
            <span class="font-montserrat text-sm text-center">
              <p class="text-sm font-montserrat">${{$recipe->price}} MXN</p>
            </span>
          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b lg:table-cell relative lg:static h-24 flex items-center justify-center md:h-auto">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
              Status
            </span>
            @if ($recipe->inStock == 1)
            <span class="font-montserrat text-sm text-center">
              <p class="text-sm font-montserrat bg-eat-green-500 text-eat-olive-600">in Stock</p>
            </span>
            @else
            <span class="font-montserrat text-sm text-center">
              <p class="text-sm font-montserrat bg-eat-fuccia-500 text-eat-white-600">out Stock</p>
            </span>
            @endif

          </td>
          <td
            class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
            <span
              class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acciones</span>
            <div class="flex justify-center">
              <a href="{{ route('admin-recipes-edit', [$recipe->slug]) }}" id="editRecipe"
                data-title='Edita los datos de la receta' data-placement="left"
                class="tooltip_recipe mr-3 text-eat-green-400 hover:text-eat-green-600 underline">
                <x-icons.edit />
              </a>
              <a href="#" onclick="confirmAction('deleteRecipe', {{ $recipe }});" data-title='Elimina la receta'
                data-placement="top"
                class="tooltip_recipe text-eat-fuccia-500 hover:text-eat-fuccia-600 underline pl-2">
                <x-icons.remove />
              </a>
            </div>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$recipes->links()}}
    @else
    <x-icons.no-recipes />
    <x-utils.text class="text-center mb-6 ">¡Al parecer no hay recetas! Puedes agregar haciendo clic en el botón AGREGAR
      que esta abajo</x-utils.text>
    <hr class=" border-eat-olive-50 mb-6 ">
    @endif

    <div class="flex justify-end mt-4">
      <x-utils.button class="p-4" id="createRecipe" color="eat-olive" onclick="location.href='/admin/recipes/create'">
        Agregar
      </x-utils.button>
    </div>
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