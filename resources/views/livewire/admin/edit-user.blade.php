<div class="bg-white w-full lg:w-1/3 rounded-md drop-shadow-lg">
    <div class="flex justify-between items-center bg-eat-fuccia-500 ">
        <x-utils.form-title color="text-eat-white-500" bg="bg-eat-fuccia-500">
            modifica usuario
        </x-utils.form-title>
        <x-icons.close height="h-8" width="w-8" class="pr-6 text-eat-white-500 cursor-pointer"
            onclick="editUserDialog.close();" />
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

        <div class="mt-4 flex items-center">
            <input wire:model="resetPassword" type="checkbox"
                class="mr-2 appearance-none shadow-md checked:bg-eat-fuccia-600 checked:border-transparent border border-eat-pink-50 focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent ">
            <x-utils.text>
                Restablecer contraseña
            </x-utils.text>
        </div>

        @if ($resetPassword)
        <div class="relative mt-4">
            <input id="txtPassword" wire:model="password"
                class="  rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
                placeholder="Contraseña" type="password">
            @error('password') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span>
            @enderror
            <x-icons.password height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
        </div>

        <div class="relative mt-4">
            <input id="txtPasswordVer" wire:model="password_confirmation"
                class="rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 "
                placeholder="Confirmar contraseña" type="password">
            <x-icons.password height="h-4" width="w-4" class="text-eat-olive-700 absolute w-5 top-3 left-3" />
        </div>
        @else
        <div class="relative mt-4">
            <input disabled id="txtPassword" wire:model="password"
                class="disabled:opacity-50  rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 mb-2"
                placeholder="Contraseña" type="password">
            @error('password') <span class="text-eat-fuccia-500 text-xs font-montserrat">{{ $message }}</span>
            @enderror
            <x-icons.password height="h-4" width="w-4" class="text-gray-300 absolute w-5 top-3 left-3" />
        </div>

        <div class="relative mt-4">
            <input disabled id="txtPasswordVer" wire:model="password_confirmation"
                class="disabled:opacity-50 rounded-lg shadow-lg pl-11 border border-transparent focus:bg-eat-white-500 focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-700 "
                placeholder="Confirmar contraseña" type="password">
            <x-icons.password height="h-4" width="w-4" class="text-gray-300 absolute w-5 top-3 left-3" />
        </div>
        @endif





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

        <div class=" text-eat-olive-500 cursor-pointer mt-4">
            <label class="flex items-center cursor-pointer" for="photo">
                <x-icons.avatar class="pr-3 " />
                <p class="mr-4">Sube foto del usuario: </p>
                @if ($photo)

                <img class=" rounded-full w-10 h-10 " src="{{ $photo->temporaryUrl() }}">
                @endif
            </label>
            <input class="hidden" wire:model="photo" type="file" name="photo" id="photo">
        </div>



    </div>
    <div class="mt-2 mb-6 mx-6 flex justify-end">
        <x-utils.button wire:click="editUser()" color="eat-fuccia">
            Modificar
        </x-utils.button>
    </div>
</div>