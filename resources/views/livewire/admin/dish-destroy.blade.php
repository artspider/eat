{{-- <div wire:click="destroy" class="absolute top-2 right-2 rounded-lg w-8 h-8 z-10  shadow-md"> --}}

<a href="#" onclick="confirmAction('deleteDish', {{ $dish }});" data-title='Elimina el platillo' data-placement="top"
  class="absolute top-2 right-2 rounded-lg w-8 h-8 z-10  shadow-md tooltip_recipe bg-eat-green-500 hover:bg-eat-green-300 text-eat-fuccia-500 hover:text-eat-fuccia-800 underline pt-1 pl-1">
  <x-icons.remove />
</a>

{{-- </div> --}}