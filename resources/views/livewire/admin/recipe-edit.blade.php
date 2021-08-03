<div>
	@if ($errors->any())
	<script>
		Toast.fire({
            icon: 'error',
            title: 'Ocurrio un error, revise sus datos'
          });
	</script>
	@endif

	<div class="bg-white rounded-md shadow-md p-10 ">
		<x-utils.subtitle class="mb-4">Modificar receta</x-utils.subtitle>
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
							<x-icons.list class="text-base mr-1" /> Ingredientes
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
			<form wire:submit.prevent="edit">
				<div x-show="tab===0" class="block lg:grid grid-cols-1 gap-4 place-items-center">
					<div class="col-span-1 w-2/3 my-8">
						<x-utils.text-input wire:model="name" type="text" label="Nombre de la receta" :required="true"
							placeholder="Nombra a este platillo" class="w-full mb-8 md:mt-0" />

						<div class="w-full mb-8">
							<div x-data="{open: false}">
								<label for="recipe_category"
									class="block text-sm font-medium leading-5 text-eat-olive-700">Categoria</label>
								<div class="relative">
									<div x-on:click="open=true"
										class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
										<x-utils.text class="ml-4">{{$recipeCategoryName}}</x-utils.text>
										<x-icons.chevron class="mr-4 text-eat-olive-500 " />
									</div>

									<div x-show="open" x-on:click.away="open=false">
										<div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
											<ul>
												@foreach ($recipe_categories as $recipe_category)
												@if ($recipe_category->id == $recipe_category_id)
												<li wire:click="SelectCategory({{$recipe_category->id}})" href="#"
													class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
													{{$recipe_category->name}}</li>
												@else
												<li x-on:click="open=false" wire:click="SelectCategory({{$recipe_category->id}})" href="#"
													class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
													{{$recipe_category->name}}</li>
												@endif

												@endforeach
											</ul>
										</div>
									</div>

								</div>
							</div>
							@error('category')
							<p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
							@enderror
						</div>

						<div class="mb-8">
							<textarea
								placeholder="Indique de que platillo se trata, puede colocar algo de historia o datos, con que acompañarlo y en que momento del día se sirve mejor"
								class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
															border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent"
								name="" id="" cols="30" rows="5" wire:model="description"></textarea>
						</div>

						<div class="flex items-center mb-8">
							<div class="flex items-center relative w-1/3">
								<x-utils.text-input wire:model="prepTime" type="number" label="Tiempo de preparación" :required="true"
									placeholder="00" class="w-full mr-2" />
								<p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
							</div>

							<div class="flex items-center relative w-1/3">
								<x-utils.text-input wire:model="cookTime" type="number" label="Tiempo de cocción" :required="true"
									placeholder="00" class="w-full mr-2" />
								<p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
							</div>

							<div class="flex items-center relative w-1/3">
								<x-utils.text-input wire:model="totalTime" type="text" label="Total (automático)" disabled=true
									placeholder="00" class="w-full mr-2" />
								<p class="absolute top-8 right-5 text-eat-olive-600 text-sm">Minutos</p>
							</div>
						</div>

						<div class="flex items-center mb-8">
							<div class="flex items-center relative w-2/5">
								<x-utils.text-input wire:model="recipeYield" type="number" label="Rinde para" :required="true"
									placeholder="0" class="w-full mr-2" />
								<p class=" absolute top-8 left-16 text-eat-olive-600 text-sm">Persona(s)</p>
							</div>

							<div class="w-full md:w-1/2 md:mr-4">
								<div x-data="{open: false}">
									<label for="recipeSuitableForDiet"
										class="block text-sm font-medium leading-5 text-eat-olive-700">Dieta</label>
									<div class="relative">
										<div x-on:click="open=true"
											class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
											<x-utils.text class="ml-4">{{$recipeSuitableForDietName}}</x-utils.text>
											<x-icons.chevron class="mr-4 text-eat-olive-500 " />
										</div>

										<div x-show="open" x-on:click.away="open=false">
											<div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
												<ul>
													@foreach ($dietType as $diet)
													@if ($diet == $recipeSuitableForDietName)
													<li wire:click="SelectDiet('{{$diet}}')" href="#"
														class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
														{{$diet}}</li>
													@else
													<li x-on:click="open=false" wire:click="SelectDiet('{{$diet}}')" href="#"
														class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
														{{$diet}}</li>
													@endif
													@endforeach
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="flex items-center mb-8 ">
							<div class="relative w-1/2 mr-1">
								<x-utils.text-input wire:model="price" type="text" label="Precio público" :required="true"
									placeholder="0" pl="pl-8" class="w-full mr-2" />
								<p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
								<p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
							</div>

							<div class="relative w-1/2 mr-1">
								<x-utils.text-input wire:model="cost" type="text" label="Costo" :required="true" placeholder="0"
									pl="pl-8" class="w-full mr-2" />
								<p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
								<p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
							</div>
						</div>

						<div x-data="{stock: @entangle('inStock')}" class="flex items-center justify-evenly">
							<span>Existe en stock?</span>
							<p x-on:click="stock=!stock"
								:class="stock ? 'bg-eat-green-600 text-eat-olive-500' : 'bg-eat-fuccia-600 text-eat-white-50'"
								class="w-1/2 py-2 text-center cursor-pointer">Stock</p>
						</div>

					</div>
				</div>

				<div x-show="tab===1" class="block lg:grid grid-cols-1 gap-4 place-items-center">
					<div class="col-span-1 w-2/3 my-8">
						<label for="qty" class="block text-sm font-medium leading-5 text-eat-olive-700">Ingredientes</label>
						<div class="flex items-center">
							<input wire:model="ingredientQty" type="number" name="qty" min="1" max="999" value="1" id="qty"
								placeholder="1"
								class="form-input block w-1/5 pr-2 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 mr-1">

							<div class="w-full md:w-1/3 md:mr-1">
								<div x-data="{open: false}">
									<div class="relative">
										<div x-on:click="open=true"
											class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
											<x-utils.text class="ml-4">{{$unitName}}</x-utils.text>
											<x-icons.chevron class="mr-4 text-eat-olive-500 " />
										</div>

										<div x-show="open" x-on:click.away="open=false">
											<div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
												<ul>
													@foreach ($units as $unit)
													@if ($unit->id == $unit_id)
													<li wire:click="SelectUnit({{$unit}})" href="#"
														class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
														{{$unit->unit}}</li>
													@else
													<li x-on:click="open=false" wire:click="SelectUnit({{$unit}})" href="#"
														class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
														{{$unit->unit}}</li>
													@endif
													@endforeach
												</ul>
												{{$units}}
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="w-full md:w-2/5 mr-1 ">
								<div x-data="{open: false}">
									<div class="relative">
										<div x-on:click="open=true"
											class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

											{{-- <x-utils.text class="ml-4">{{$productName}}</x-utils.text> --}}
											<input
												class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
												type="text" name="" id="" placeholder="Producto..." wire:model="queryProduct">
											<x-icons.chevron class="absolute top-2 right-4 text-eat-olive-500 " />
										</div>

										<div x-show="open" x-on:click.away="open=false">
											<div class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
												<ul>
													@foreach ($products as $product)
													@if ($product->id == $product_id)
													<li wire:click="SelectProduct({{$product}})" href="#"
														class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
														{{$product->name}}</li>
													@else
													<li x-on:click="open=false" wire:click="SelectProduct({{$product}})" href="#"
														class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
														{{$product->name}}</li>
													@endif
													@endforeach
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>

							<x-icons.add wire:click.debounce.150ms="addIngredient()" class="text-eat-olive-500 cursor-pointer" />
						</div>
						@if ($ingredientList)
						<ul class="mt-8 ">
							@foreach ($ingredientList as $key => $ingredient)
							<div class="flex items-center mt-4">
								<div class="flex items-center w-3/5">
									<p
										class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
										{{$key + 1}} </p>
									<li class=" text-eat-olive-500 font-montserrat text-sm"> {{$ingredient['qty']}}
										{{$ingredient['unit']}}
										{{$ingredient['product']}}
									</li>
								</div>
								<div wire:click="deleteIngredient({{ $key }})" class="text-eat-fuccia-500 w-6 cursor-pointer">
									<x-icons.remove />
								</div>
							</div>
							@endforeach
						</ul>
						@else
						<div class="mt-4">
							<x-icons.not-found w='24' h='24' />
							<x-utils.text class="text-center">Sin ingredientes</x-utils.text>
						</div>
						@endif
					</div>
				</div>

				<div x-show="tab===2" class="block lg:grid grid-cols-1 gap-4 place-items-center">
					<div class="col-span-1 w-2/3 my-8">
						<div class="">
							<label for="nutritionInfo" class="block text-sm font-medium leading-5 text-eat-olive-700">Información
								nutricional</label>

							<div class="flex items-center">
								<div class="w-full md:w-1/2 mr-1 ">
									<div x-data="{open: false}">
										<div class="relative">
											<div x-on:click="open=true"
												class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
												<x-utils.text class="ml-4">{{$nutritionItemName}}</x-utils.text>
												<x-icons.chevron class="mr-4 text-eat-olive-500 " />
											</div>

											<div x-show="open" x-on:click.away="open=false">
												<div class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
													<ul>
														@foreach ($nutritionInfo as $key => $nutritionItem)
														@if ($nutritionItem == $nutritionItemName)
														<li wire:click="SelectNutritionItem('{{$nutritionItem}}', {{$key}})" href="#"
															class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
															{{$nutritionItem}}</li>
														@else
														<li x-on:click="open=false" wire:click="SelectNutritionItem('{{$nutritionItem}}', {{$key}})"
															href="#"
															class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
															{{$nutritionItem}}</li>
														@endif
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="flex items-center relative w-1/3">
									<x-utils.text-input wire:model="nutritionQty" type="number" label="" :required="false" placeholder="0"
										class="w-full mr-2" />
									<p class=" absolute top-3 left-14 text-eat-olive-600 text-sm">{{$nutritionUnitName}}</p>
								</div>
								<x-icons.add wire:click.debounce.150ms="addNutritionItem()" class="text-eat-olive-500 cursor-pointer" />
							</div>

						</div>
						@if ($nutritionList)
						<ul class="mt-8">
							@foreach ($nutritionList as $key => $nutritionItem)
							<div class="flex items-center mt-4">
								<div class="flex items-center w-3/5">
									<p
										class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
										{{$loop->index + 1}} </p>
									<li class="text-eat-olive-500 font-montserrat text-sm"> {{$key}} {{$nutritionItem}} </li>
								</div>

								<div wire:click="deleteNutritionItem( ' hola')" class="text-eat-fuccia-500 w-6 cursor-pointer">
									<x-icons.remove />
								</div>
							</div>

							@endforeach
						</ul>
						@else
						<div class="mt-4">
							<x-icons.not-found w='24' h='24' />
							<x-utils.text class="text-center">Sin información nutrimental</x-utils.text>
						</div>
						@endif
					</div>
				</div>

				<div x-show="tab===3" class="block lg:grid grid-cols-1 gap-4 place-items-center">
					<div class="col-span-1 w-2/3 my-8">
						<div class=" text-eat-olive-500 mt-4 px-4">
							<label class="flex items-center cursor-pointer mt-8 mb-4" for="photos">
								<x-icons.avatar class="pr-3 " />
								<p class="mr-4">Subir imágen(es) </p>
							</label>
							<div class="flex justify-center p-4">

								@if ($photos)
								@foreach ($photos as $key => $photo)
								<img class=" w-full  h-64 " src="{{ $photo->temporaryUrl() }}">
								@endforeach
								@else
								@if ($photo_paths)
								@foreach ($photo_paths as $key => $photo_path)

								<img class=" w-full  h-64 " src="{{asset('storage/' . $photo_path) }}">
								@endforeach
								@else
								<x-icons.upload-image width="w-40" height="h-40" />
								@endif
								@endif

								{{-- @forelse ($photos as $key => $photo)
												<img class=" w-auto h-16 mr-1" src="{{ $photo->temporaryUrl() }}">
								@empty
								<img class=" w-full  h-64 " src="{{asset('storage/' . $photo_path) }}">
								@endforelse --}}


							</div>
							<input class="hidden" wire:model="photos" type="file" name="photos" id="photos" multiple>
							@error('photos')
							<p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
							@enderror
						</div>

					</div>
				</div>

				<hr class=" border-eat-olive-50 mb-6 ">
				<div class="mt-6 flex justify-end">
					<x-utils.button color="eat-olive" type="submit">Modificar</x-utils.button>
				</div>
			</form>
		</div>
	</div>
</div>
@push('modals')
<script>
	Livewire.on('success', message => {
    fireMessageAndRedirect(message,'/admin/recipes');
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