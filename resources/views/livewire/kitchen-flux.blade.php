<div>

  @forelse ($orders as $order)
  <div class="mt-2 border border-eat-green-500 p-4 flex items-center">
    <h2 class="text-lg text-eat-fuccia-500 font-raleway font-bold mr-2">Se envió una orden del Chef:</h2>
    <p class="text-semibold tracking-wide text-eat-olive-500 mr-2">Favor de hacer un {{$order->recipe->name}}</p>
    <div wire:click="AcceptOrder({{$order}})"
      class=" rounded-full w-10 h-10 bg-eat-green-600 text-center text-eat-olive-500 hover:text-eat-olive-300 pt-2 cursor-pointer hover:bg-eat-green-300">
      <span>ok</span>
    </div>
  </div>
  @empty

  @endforelse

  <div class=" border border-eat-green-500  p-4">
    <h2 class="text-lg text-eat-fuccia-500 font-raleway font-bold mr-2">Ordenes recibidas, indique el siguiente paso:
    </h2>
    @forelse ($recibidas as $recibida)
    <div class="mt-2 flex items-center">
      <p class="text-semibold tracking-wide text-eat-olive-500 mr-2 w-2/5">{{$recibida->recipe->name}}
        <span>{{$recibida->created_at->diffForHumans()}}</span></p>
      <div wire:click="Cocinar({{$recibida}})"
        class="px-2 py-1 mr-2 rounded-lg bg-eat-green-600 text-center txt-xs text-eat-olive-500 hover:text-eat-olive-300 pt-2 cursor-pointer hover:bg-eat-green-300">
        <span>Cocinar</span>
      </div>
      <div wire:click="SinStock({{$recibida}})"
        class="px-2 py-1 mr-2 rounded-lg  bg-eat-fuccia-600 text-center text-eat-white-500 hover:text-eat-white-800 pt-2 cursor-pointer hover:bg-eat-fuccia-300">
        <span>Sin stock</span>
      </div>
      <div wire:click="Cancelar({{$recibida}})"
        class="px-2 py-1 mr-2 rounded-lg bg-red-600 text-center text-eat-white-500 hover:text-eat-white-800 pt-2 cursor-pointer hover:bg-red-400">
        <span>Cancelar</span>
      </div>
    </div>
    @empty

    @endforelse
  </div>

  <div class=" border border-eat-green-500  p-4 mt-4">
    <h2 class="text-lg text-eat-fuccia-500 font-raleway font-bold mr-2">En preparación:
    </h2>
    @forelse ($cocinando as $item)
    <div class="mt-2 flex items-center">
      <p class="text-semibold tracking-wide text-eat-olive-500 mr-2 w-2/5">{{$item->recipe->name}}
        <span>{{$item->created_at->diffForHumans()}}</span>
      </p>
      <div wire:click="EnviarAlChef({{$item}})"
        class="px-2 py-1 mr-2 rounded-lg bg-eat-green-600 text-center txt-xs text-eat-olive-500 hover:text-eat-olive-300 pt-2 cursor-pointer hover:bg-eat-green-300">
        <span>Enviar al Chef</span>
      </div>
    </div>
    @empty

    @endforelse
  </div>

</div>