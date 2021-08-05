<x-layouts.master>
  {{ Breadcrumbs::render('dishes-create') }}

  @if ($errors->any())
  <script>
    Toast.fire({
            icon: 'error',
            title: 'Ocurrio un error, revise sus datos'
          });
  </script>
  @endif

  <div class="bg-white rounded-md shadow-md p-10 ">
    <x-utils.subtitle class="mb-4">Agregar nuevo platillo al menú</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    <div x-data="{tab:0}">
      <nav>
        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 0 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              x-on:click="tab=0"
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.config class="text-base mr-1" /> Generales
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 1 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              x-on:click="tab=1"
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.list class="text-base mr-1" /> Componentes
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              x-on:click="tab=2"
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.info class="text-base mr-1" /> Info. Nutrimental
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a :class="tab === 3 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
              x-on:click="tab=3"
              class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
              <x-icons.photo class="text-base mr-1" /> Imágenes
            </a>
          </li>
        </ul>
      </nav>

      <form action="create" method="POST">
        @csrf
        <div x-show="tab===0" class="block lg:grid grid-cols-1 gap-4 place-items-center">
          <div class="col-span-1 w-2/3 my-8">
            <x-utils.input-text model="name" type="text" label="Nombre del platillo" :required="true"
              placeholder="Nombra a este platillo" class="w-full mb-8 md:mt-0" />

            <div class="mb-8">
              <textarea placeholder="Describa el platillo que se esta agregando al menú"
                class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                          border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent" name="description" id="description" cols="30"
                rows="5"></textarea>
            </div>

            <div class="flex items-center mb-8">
              <div class="flex items-center relative w-1/3">
                <x-utils.input-text model="prepTime" type="number" label="Tiempo en el que se sirve" :required="true"
                  placeholder="00" class="w-full mr-2" />
                <p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
              </div>

              <div class="flex items-center relative w-2/5">
                <x-utils.input-text model="recipeYield" type="number" label="Rinde para" :required="true"
                  placeholder="0" class="w-full mr-2" />
                <p class=" absolute top-8 left-16 text-eat-olive-600 text-sm">Persona(s)</p>
              </div>
            </div>

            <div class="flex items-center mb-8 ">
              <div class="relative w-1/2 mr-1">
                <x-utils.input-text model="price" type="text" label="Precio público" :required="true" placeholder="0"
                  pl="pl-8" class="w-full mr-2" />
                <p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
                <p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
              </div>

              <div class="relative w-1/2 mr-1">
                <x-utils.input-text model="cost" type="text" label="Costo" :required="true" placeholder="0" pl="pl-8"
                  class="w-full mr-2" />
                <p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
                <p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
              </div>
            </div>

            <div x-data="{stock: false}" class="flex items-center justify-evenly">
              <span>Existe en stock?</span>
              <label class="w-1/2 py-2 ">
                <input type="checkbox" name="stock" id="stock" value="stock" class="hidden">
                <p x-on:click="stock=!stock"
                  :class="stock ? 'bg-eat-green-600 text-eat-olive-500' : 'bg-eat-fuccia-600 text-eat-white-50'"
                  class="text-center cursor-pointer">Stock</p>
              </label>
            </div>
          </div>
        </div>

        <div x-show="tab===1" class="block lg:grid grid-cols-1 gap-4 place-items-center">
          <div class="col-span-1 w-2/3 my-8">
            <p class="block text-sm font-medium leading-5 text-eat-olive-700">Ingredientes</p>
            <div class="flex items-center">
              <input name="ingredientQty" type="number" name="qty" min="1" max="999" value="1" id="qty" placeholder="1"
                class="form-input block w-1/5 pr-2 text-eat-olive-900 font-montserrat 
                      placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 
                      focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 mr-1">
            </div>
          </div>
        </div>

        <hr class=" border-eat-olive-50 mb-6 ">
        <div class="mt-6 flex justify-end">
          <x-utils.button color="eat-olive" type="submit">Guardar</x-utils.button>
        </div>

      </form>
    </div>
  </div>
</x-layouts.master>