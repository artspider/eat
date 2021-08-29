<x-layouts.master>
  {{ Breadcrumbs::render('dishes') }}

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Lista de platillos</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">
    @if ($dishes && $dishes->count())
    <div class="flex flex-wrap items-center">
      @foreach ($dishes as $dish)
      <div class=" bg-eat-white-500 rounded-lg shadow-lg w-3/12 mr-4 relative">
        <a href="{{route('admin-dishes-edit', [$dish->slug])}}">
          <img src=" {{asset('storage/' . $dish->dishImages()->first()->image) }} " alt=""
            class="w-full h-60 max-h-60 bg-cover bg-center ">
        </a>
        <div class="dish--info p-3">
          <p class="text-eat-olive-500 mb-2">{{$dish->name}}</p>
          <div class="flex items-center mr-1">
            @for ($i = 0; $i < $dish->rating; $i++)
              <x-icons.star height="h-4" width="w-4" class="text-yellow-400"></x-icons.star>
              @endfor
          </div>
          @if ($dish->inStock)
          <div class=" text-right w-3 h-3 rounded-full bg-green-600 mt-2"></div>
          @else
          <div class="ml-auto w-3 h-3 rounded-full bg-red-600 mt-2"></div>
          @endif
        </div>
        <livewire:admin.dish-destroy :dish="$dish">
      </div>
      @endforeach
    </div>
    @else
    <x-icons.not-found />
    <x-utils.text class="text-center mb-6">¡Al parecer no hay platillos! Puedes agregar haciendo clic en el botón
      AGREGAR que esta abajo</x-utils.text>

    @endif
    <hr class=" border-eat-olive-50 mb-6 ">
    <div class="flex justify-end mt-4">
      <x-utils.button id="createProduct" color="eat-olive" class="p-4" onclick="location.href='/admin/dishes/create'">
        Agregar
      </x-utils.button>
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
  })
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
</x-layouts.master>