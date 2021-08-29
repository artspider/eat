<div class="w-full bg-eat-fuccia-500 h-full">
  {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
  @if ($errors->any())
  <script>
    Toast.fire({
      icon: 'error',
      title: 'Ocurrio un error, revise sus datos'
    });
  </script>
  @endif

  <div class="flex items-center  p-2">
    <img src="img/tenedor.png" width="36" height="36" alt="">
    <h2 class="text-2xl text-eat-white-500 font-bold font-montserrat ml-4">Orden # {{$order->id}}</h2>
  </div>
  <div class="grid grid-cols-6 gap-4 bg-eat-white-50 p-2 h-96">
    <div class="max-h-96  pt-1 px-2 col-span-3">
      <!-- Datos del cliente -->
      <div class="font-montserrat bg-eat-green-600 text-eat-olive-500 text-xs rounded-sm p-2">
        <p class=" ">Cliente: <span class="font-semibold tracking-tight">{{$order->customer->name}}</span></p>
        <p class=" ">Dirección: <span class="font-semibold tracking-tight">{{$order->customer->street}},
            {{$order->customer->suburb}}</span>
        </p>
        <p>Telefono: <span class="font-semibold tracking-tight">{{$order->customer->phone}}</span></p>
        <p>Mesa: <span class="font-semibold tracking-tight">{{$order->table}}</span></p>
      </div>
      <!-- End Datos del cliente ->>
      
      <!-- Detalle de la cuenta -->
      <div class="flex items-center mt-2">
        <p class=" w-1/6">Cant</p>
        <p class="w-1/2">Platillo</p>
        <p class="w-1/6">Precio</p>
        <p class=" w-1/6 ">Total</p>
      </div>
      <hr class=" border-eat-olive-50 mb-4 ">
      <div class=" max-h-44 overflow-y-scroll">
        @forelse ($order->dishes as $key => $dish)
        <div class="flex items-center pl-1">
          <p class=" w-1/6 ">
            {{$dish->pivot->qty}}
          </p>
          <p class="w-1/2">{{$dish->name}}</p>
          <p class="w-1/6">${{$dish->price}}</p>
          <p class="w-1/6">${{$dish->pivot->total}}</p>
        </div>
        @empty
        @endforelse
      </div>
      <hr class=" border-eat-olive-50 my-2 ">
      <div class="flex justify-end ">
        <p class="font-semibold font-montserrat border border-eat-fuccia-50 p-2 mr-8 tracking-wider">Total: <span>$
            {{$total}} MXN</span></p>
      </div>
      <!-- End Detalle de la cuenta -->
    </div>

    <div class="col-span-3">
      <div class=" mt-2 mb-4">
        <select wire:model="payMethodSelected" class=" w-full rounded-md shadow-md form-input block text-eat-olive-900 font-montserrat placeholder-eat-olive-50
          bg-eat-white-500 font-bold
            border
            border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
            sm:leading-5">
          <option value="">== MÉTODO DE PAGO ==</option>
          @foreach ($paymethods as $key => $paymethod)
          <option value="{{$key}}">{{$paymethod->type}}</option>
          @endforeach
        </select>
      </div>
      <div class="flex items-center">
        <p class="mr-2">Se recibe: <span class="font-semibold font-montserrat text-sm tracking-wider">$
            {{ round($moneyReceived,2) }} MXN</span></p>
      </div>
      <div class="flex w-full mt-2">
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="quarter" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$.5 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="one" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $1 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="two" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $2 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="five" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $5 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="ten" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$10 MXN</p>
        </div>
      </div>

      <div class="flex w-full mt-2 mb-2">
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="twenty" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$20 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="fifty" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$50 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="onehundred" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$100MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="twohundred" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$200 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="fivehundred" type="number" class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$500 MXN</p>
        </div>
      </div>
      <hr class=" border-eat-olive-50 mb-2 ">
      <div class="flex items-center">
        <p class="mr-2">Cambio: <span class="font-semibold font-montserrat text-sm tracking-wider">$
            {{ round($change,2) }} MXN</span></p>
        <p class="mr-2">Recolectado: <span class="font-semibold font-montserrat text-sm tracking-wider">$
            {{ round($changeColected,2) }} MXN</span></p>
      </div>

      <div class="flex w-full mt-2">
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.0" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$.5 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.1" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $1 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.2" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $2 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.3" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $5 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.4" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$10 MXN</p>
        </div>
      </div>

      <div class="flex w-full mt-2">
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.5" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$20 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.6" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $50 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.7" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $100 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input min="0" value="0" wire:model="billcoinschange.8" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide"> $200 MXN</p>
        </div>
        <div class="text-sm font-semibold font-montserrat text-eat-olive-500 w-1/5">
          <input required min="0" value="0" wire:model="billcoinschange.9" type="number"
            class="w-14 p-1  font-montserrat text-sm">
          <p class="text-xs tracking-wide">$500 MXN</p>
        </div>
      </div>

      <x-utils.button wire:click="register" class="w-full mt-2 p-2">Registrar</x-utils.button>
    </div>
  </div>
</div>