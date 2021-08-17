<div class="bg-white w-full lg:w-1/3 rounded-md drop-shadow-lg">
  <div class="flex justify-between items-center bg-eat-fuccia-500 ">
    <x-utils.form-title color="text-eat-white-500" bg="bg-eat-fuccia-500">
      nuevo usuario
    </x-utils.form-title>
    <x-icons.close height="h-8" width="w-8" class="pr-6 text-eat-white-500 cursor-pointer"
      onclick="userDialog.close();" />
  </div>
  <div class="p-6 overflow-auto h-96 2xl:h-auto">
    <div class="relative ">
      <input wire:model="name"
        class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
        placeholder="Nombre completo del nuevo usuario" type="text">
      @error('name') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span> @enderror
      <x-icons.user class="text-eat-olive-700 absolute w-5 top-3 left-3" />
    </div>
    <div class="relative mt-4">
      <input wire:model="email"
        class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
        placeholder="Correo electrónico" type="text">
      @error('email') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span> @enderror
      <x-icons.messages height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
    </div>

    <div class="relative mt-4">
      <input wire:model="password"
        class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
        placeholder="Contraseña" type="password">
      @error('password') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span> @enderror
      <x-icons.password height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
    </div>

    <div class="relative mt-4">
      <input wire:model="password_confirmation"
        class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 "
        placeholder="Confirmar contraseña" type="password">
      <x-icons.password height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
    </div>

    <div class="relative mt-4">
      <input wire:model="phone"
        class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
        placeholder="Teléfono" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
      @error('phone') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span> @enderror
      <x-icons.phone height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
    </div>

    <div class="relative mt-4">
      <input wire:model="address"
        class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
        placeholder="Calle y número, colonia" type="text">
      @error('address') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span> @enderror
      <x-icons.address height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
    </div>

    <div class="flex items-center mt-4">
      <p class="text-eat-olive-700 font-montserrat text-sm mr-4">Otorga un rol:</p>

      <select wire:model="role"
        class="rounded-lg shadow-lg border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent bg-eat-white-700"
        name="" id="">
        <option value="manager">Manager</option>
        <option value="chef">Chef</option>
        <option value="waiter" selected>Mesero</option>
        <option value="kitchen assistant" selected>Asistente de cocina</option>
      </select>
      @error('role') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span> @enderror

    </div>

    <div x-data="{ files: null }">
      <div class="tooltip_usr mt-4 text-eat-olive-500 cursor-pointer" data-title='Elimina el usuario'
        data-placement="top">
        <label class="flex items-center cursor-pointer" for="attachment">
          <x-icons.avatar class="pr-3 " />
          <p class="mr-2">Sube foto del usuario: </p>
          <template x-if="files !== null">
            <div class="flex flex-col items-center  mr-2">
              <template x-for="(_,index) in Array.from({ length: files.length })">
                <div class="flex  ">
                  <span class="text-eat-olive-200 text-sm font-montserrat" x-text="files[index].name"></span>
                  <span class="text-eat-green-700 text-sm font-montserrat ml-2"
                    x-text="Math.round(files[index].size/1024)">
                  </span>
                  <p class="text-xs self-end text-eat-green-700 ">kb</p>
                </div>
              </template>
            </div>
          </template>
        </label>
        <input wire:model="photo" x-on:change="files = $event.target.files; console.log($event.target.files)"
          class=" hidden " type="file" name="" id="attachment">
      </div>
    </div>


  </div>
  <div class="mt-2 mb-6 mx-6 flex justify-end">
    <x-utils.button wire:click="save" color="eat-fuccia">
      Crear
    </x-utils.button>
  </div>
</div>