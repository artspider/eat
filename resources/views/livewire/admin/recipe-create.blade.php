<div>
    {{ Breadcrumbs::render('recipes-create') }}

    <x-utils.subtitle class="mb-4">Agregar nueva receta</x-utils.subtitle>
    <hr class=" border-eat-olive-50 mb-6 ">

    {{-- <div x-data="{tab:0}"> --}}
    <div x-data="{ tab: @entangle('tabSelection') }">
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
                        wire:click=selectIngredient() class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg 
                          rounded leading-normal cursor-pointer">
                        <x-icons.list class="text-base mr-1" /> Ingredientes
                    </a>
                </li>
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a :class="tab === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                        wire:click=selectInfo()
                        class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                        <x-icons.info class="text-base mr-1" /> Info. Nutrimental
                    </a>
                </li>
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a :class="tab === 3 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                        wire:click=selectImages()
                        class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                        <x-icons.photo class="text-base mr-1" /> Imágenes
                    </a>
                </li>
            </ul>
        </nav>
        <form wire:submit.prevent="save">
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
                                            <li x-on:click="open=false"
                                                wire:click="SelectCategory({{$recipe_category->id}})" href="#"
                                                class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                {{$recipe_category->name}}</li>
                                            @endif

                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @error('recipe_category_id')
                        <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <textarea
                            placeholder="Indique de que platillo se trata, puede colocar algo de historia o datos, con que acompañarlo y en que momento del día se sirve mejor"
                            class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                            border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent"
                            name="" id="" cols="30" rows="5" wire:model="description"></textarea>
                        @error('description')
                        <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mb-8">
                        <div class="flex items-center relative w-1/3">
                            <x-utils.text-input wire:model="prepTime" type="number" label="Tiempo de preparación"
                                :required="true" placeholder="00" class="w-full mr-2" />
                            <p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
                        </div>

                        <div class="flex items-center relative w-1/3">
                            <x-utils.text-input wire:model="cookTime" type="number" label="Tiempo de cocción"
                                :required="true" placeholder="00" class="w-full mr-2" />
                            <p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
                        </div>

                        <div class="flex items-center relative w-1/3">
                            <x-utils.text-input wire:model="totalTime" type="text" label="Total (automático)"
                                disabled=true placeholder="00" class="w-full mr-2" />
                            <p class="absolute top-8 right-5 text-eat-olive-600 text-sm">Minutos</p>
                        </div>
                    </div>

                    <div class="flex items-center mb-8">
                        <div class="flex items-center relative w-2/5">
                            <x-utils.text-input wire:model="recipeYield" type="number" label="Rinde para"
                                :required="true" placeholder="0" class="w-full mr-2" />
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
                                                <li x-on:click="open=false" wire:click="SelectDiet('{{$diet}}')"
                                                    href="#"
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
                            <x-utils.text-input wire:model="price" type="text" label="Precio público" :required="false"
                                placeholder="0" pl="pl-8" class="w-full mr-2" />
                            <p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
                            <p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
                        </div>

                        <div class="relative w-1/2 mr-1">
                            <x-utils.text-input wire:model="cost" type="text" label="Costo" :required="false"
                                placeholder="0" pl="pl-8" class="w-full mr-2" disabled />
                            <p class=" absolute top-9 left-4 text-eat-olive-600 text-sm">$</p>
                            <p class=" absolute top-9 right-16 text-eat-olive-600 text-sm">MXN</p>
                        </div>
                    </div>

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
                                            <li x-on:click="open=false"
                                                wire:click="SelectCategory({{$recipe_category->id}})" href="#"
                                                class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                {{$recipe_category->name}}</li>
                                            @endif

                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @error('recipe_category_id')
                        <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <textarea
                            placeholder="Indique de que platillo se trata, puede colocar algo de historia o datos, con que acompañarlo y en que momento del día se sirve mejor"
                            class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                            border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent"
                            name="" id="" cols="30" rows="5" wire:model="description"></textarea>
                        @error('description')
                        <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                        @enderror
                    </div>

                    <<<<<<< HEAD <div class="flex items-center mb-8">
                        <div class="flex items-center relative w-1/3">
                            <x-utils.text-input wire:model="prepTime" type="number" label="Tiempo de preparación"
                                :required="true" placeholder="00" class="w-full mr-2" />
                            <p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
                        </div>

                        <div class="flex items-center relative w-1/3">
                            <x-utils.text-input wire:model="cookTime" type="number" label="Tiempo de cocción"
                                :required="true" placeholder="00" class="w-full mr-2" />
                            <p class="absolute top-8 left-16 text-eat-olive-600 text-sm">Minutos</p>
                        </div>

                        <div class="flex items-center relative w-1/3">
                            <x-utils.text-input wire:model="totalTime" type="text" label="Total (automático)"
                                disabled=true placeholder="00" class="w-full mr-2" />
                            <p class="absolute top-8 right-5 text-eat-olive-600 text-sm">Minutos</p>
                        </div>
                </div>
                =======
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
<ul class="mt-8">
    @foreach ($ingredientList as $key => $ingredient)
    <div class="flex items-center mt-4">
        <p
            class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
            {{$key + 1}} </p>
        <li class=" text-eat-olive-500 font-montserrat text-sm"> {{$ingredient['qty']}} {{$ingredient['unit']}}
            {{$ingredient['product']}} </li>
        <p class="text-eat-olive-500 font-montserrat text-sm ml-2"> ${{round($ingredient['cost'],2)}}</p>
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
        >>>>>>> dishes

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
                                    =======
                                    <div x-data="{tab:0}">
                                        <<<<<<< HEAD <nav>
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
                                                        <x-icons.info class="text-base mr-1" /> Info.
                                                        Nutrimental
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
                                            <form wire:submit.prevent="save">
                                                <div x-show="tab===0"
                                                    class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                    <div class="col-span-1 2xl:w-2/3 my-8">
                                                        <x-utils.text-input wire:model="name" type="text"
                                                            label="Nombre de la receta" :required="true"
                                                            placeholder="Nombra a este platillo"
                                                            class="w-full mb-8 md:mt-0" />

                                                        <div class="w-full mb-8">
                                                            <div x-data="{open: false}">
                                                                <label for="recipe_category"
                                                                    class="block text-sm font-medium leading-5 text-eat-olive-700">Categoria</label>
                                                                <div class="relative">
                                                                    <div x-on:click="open=true"
                                                                        class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                        <x-utils.text class="ml-4">
                                                                            {{$recipeCategoryName}}
                                                                        </x-utils.text>
                                                                        <x-icons.chevron
                                                                            class="mr-4 text-eat-olive-500 " />
                                                                    </div>

                                                                    <div x-show="open" x-on:click.away="open=false">
                                                                        <div
                                                                            class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                            <ul>
                                                                                @foreach ($recipe_categories
                                                                                as $recipe_category)
                                                                                @if ($recipe_category->id ==
                                                                                $recipe_category_id)
                                                                                <li wire:click="SelectCategory({{$recipe_category->id}})"
                                                                                    href="#"
                                                                                    class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                    {{$recipe_category->name}}
                                                                                </li>
                                                                                @else
                                                                                <li x-on:click="open=false"
                                                                                    wire:click="SelectCategory({{$recipe_category->id}})"
                                                                                    href="#"
                                                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                    {{$recipe_category->name}}
                                                                                </li>
                                                                                @endif

                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            @error('category')
                                                            <p class="mt-2 text-sm text-red-600" id="">
                                                                {{$message}}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-8">
                                                            <textarea
                                                                placeholder="Indique de que platillo se trata, puede colocar algo de historia o datos, con que acompañarlo y en que momento del día se sirve mejor"
                                                                class="resize-none shadow-lg w-full text-sm font-light text-eat-olive-900 font-montserrat placeholder-eat-olive-50
                            border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent"
                                                                name="" id="" cols="30" rows="5"
                                                                wire:model="description"></textarea>
                                                        </div>

                                                        <div class="flex flex-col md:flex-row items-center mb-8">
                                                            <div
                                                                class="mb-2 md:mb-0 flex items-center relative w-full md:w-1/3">
                                                                <x-utils.text-input wire:model="prepTime" type="number"
                                                                    label="Tiempo de preparación" :required="true"
                                                                    placeholder="00" class="w-full mr-2" />
                                                                <p
                                                                    class="absolute top-8 left-16 text-eat-olive-600 text-sm">
                                                                    Minutos</p>
                                                            </div>

                                                            <div
                                                                class="mb-2 md:mb-0 flex items-center relative w-full md:w-1/3">
                                                                <x-utils.text-input wire:model="cookTime" type="number"
                                                                    label="Tiempo de cocción" :required="true"
                                                                    placeholder="00" class="w-full mr-2" />
                                                                <p
                                                                    class="absolute top-8 left-16 text-eat-olive-600 text-sm">
                                                                    Minutos</p>
                                                            </div>
                                                            =======
                                                            <nav>
                                                                <ul
                                                                    class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                                                                    <li
                                                                        class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                                                        <a :class="tab === 0 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                                                            x-on:click="tab=0"
                                                                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                                                            <x-icons.config class="text-base mr-1" />
                                                                            Generales
                                                                        </a>
                                                                    </li>
                                                                    <li
                                                                        class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                                                        <a :class="tab === 1 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                                                            x-on:click="tab=1"
                                                                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                                                            <x-icons.list class="text-base mr-1" />
                                                                            Ingredientes
                                                                        </a>
                                                                    </li>
                                                                    <li
                                                                        class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                                                        <a :class="tab === 2 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                                                            x-on:click="tab=2"
                                                                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                                                            <x-icons.info class="text-base mr-1" />
                                                                            Info. Nutrimental
                                                                        </a>
                                                                    </li>
                                                                    <li
                                                                        class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                                                        <a :class="tab === 3 ? 'bg-eat-fuccia-500 text-eat-white-100' : 'bg-eat-white-100 text-eat-fuccia-500'"
                                                                            x-on:click="tab=3"
                                                                            class="flex items-center justify-center text-xs font-bold uppercase px-5 py-3 shadow-lg rounded leading-normal cursor-pointer">
                                                                            <x-icons.photo class="text-base mr-1" />
                                                                            Imágenes
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                            <form wire:submit.prevent="save">
                                                                <div x-show="tab===0"
                                                                    class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                                    <div class="col-span-1 2xl:w-2/3 my-8">
                                                                        <x-utils.text-input wire:model="name"
                                                                            type="text" label="Nombre de la receta"
                                                                            :required="true"
                                                                            placeholder="Nombra a este platillo"
                                                                            class="w-full mb-8 md:mt-0" />

                                                                        <div class="w-full mb-8">
                                                                            <div x-data="{open: false}">
                                                                                <label for="recipe_category"
                                                                                    class="block text-sm font-medium leading-5 text-eat-olive-700">Categoria</label>
                                                                                <div class="relative">
                                                                                    <div x-on:click="open=true"
                                                                                        class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                                        <x-utils.text class="ml-4">
                                                                                            {{$recipeCategoryName}}
                                                                                        </x-utils.text>
                                                                                        <x-icons.chevron
                                                                                            class="mr-4 text-eat-olive-500 " />
                                                                                    </div>

                                                                                    <div x-show="open"
                                                                                        x-on:click.away="open=false">
                                                                                        <div
                                                                                            class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                                            <ul>
                                                                                                @foreach
                                                                                                ($recipe_categories
                                                                                                as
                                                                                                $recipe_category)
                                                                                                @if
                                                                                                ($recipe_category->id
                                                                                                ==
                                                                                                $recipe_category_id)
                                                                                                <li wire:click="SelectCategory({{$recipe_category->id}})"
                                                                                                    href="#"
                                                                                                    class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                    {{$recipe_category->name}}
                                                                                                </li>
                                                                                                >>>>>>>
                                                                                                20724f972a40321dcb3e6d671426eba0eb83e6a1
                                                                                                @else
                                                                                                <li x-on:click="open=false"
                                                                                                    wire:click="SelectDiet('{{$diet}}')"
                                                                                                    href="#"
                                                                                                    class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                    {{$diet}}
                                                                                                </li>
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <<<<<<< HEAD <div class="flex items-center mb-8 ">
                                                                        <div class="relative w-1/2 mr-1">
                                                                            <x-utils.text-input wire:model="price"
                                                                                type="text" label="Precio público"
                                                                                :required="false" placeholder="0"
                                                                                pl="pl-8" class="w-full mr-2" />
                                                                            <p
                                                                                class=" absolute top-9 left-4 text-eat-olive-600 text-sm">
                                                                                $</p>
                                                                            <p
                                                                                class=" absolute top-9 right-16 text-eat-olive-600 text-sm">
                                                                                MXN</p>
                                                                        </div>

                                                                        <div class="relative w-1/2 mr-1">
                                                                            <x-utils.text-input wire:model="cost"
                                                                                type="text" label="Costo"
                                                                                :required="false" placeholder="0"
                                                                                pl="pl-8" class="w-full mr-2"
                                                                                disabled />
                                                                            <p
                                                                                class=" absolute top-9 left-4 text-eat-olive-600 text-sm">
                                                                                $</p>
                                                                            <p
                                                                                class=" absolute top-9 right-16 text-eat-olive-600 text-sm">
                                                                                MXN</p>
                                                                        </div>
                                                                </div>

                                                                <div x-data="{stock: false}"
                                                                    class="flex items-center justify-evenly">
                                                                    <span>Existe en stock?</span>
                                                                    <p x-on:click="stock=!stock"
                                                                        wire:click="changeStock()"
                                                                        :class="stock ? 'bg-eat-green-600 text-eat-olive-500' : 'bg-eat-fuccia-600 text-eat-white-50'"
                                                                        class="w-1/2 py-2 text-center cursor-pointer">
                                                                        Stock</p>
                                                                </div>

                                                        </div>
                                                    </div>

                                                    <div x-show="tab===1"
                                                        class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                        <div class="col-span-1 w-2/3 my-8">
                                                            <label for="qty"
                                                                class="block text-sm font-medium leading-5 text-eat-olive-700">Ingredientes</label>
                                                            <div class="flex items-center">
                                                                <input wire:model="ingredientQty" type="number"
                                                                    name="qty" min="1" max="999" value="1" id="qty"
                                                                    placeholder="1"
                                                                    class="form-input block w-1/5 pr-2 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 mr-1">

                                                                <div class="w-full md:w-1/3 md:mr-1">
                                                                    <div x-data="{open: false}">
                                                                        <div class="relative">
                                                                            <div x-on:click="open=true"
                                                                                class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                                <x-utils.text class="ml-4">
                                                                                    {{$unitName}}
                                                                                </x-utils.text>
                                                                                <x-icons.chevron
                                                                                    class="mr-4 text-eat-olive-500 " />
                                                                            </div>

                                                                            <div x-show="open"
                                                                                x-on:click.away="open=false">
                                                                                <div
                                                                                    class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                                    <ul>
                                                                                        @foreach ($units as
                                                                                        $unit)
                                                                                        @if ($unit->id ==
                                                                                        $unit_id)
                                                                                        <li wire:click="SelectUnit({{$unit}})"
                                                                                            href="#"
                                                                                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                            {{$unit->unit}}
                                                                                        </li>
                                                                                        @else
                                                                                        <li x-on:click="open=false"
                                                                                            wire:click="SelectUnit({{$unit}})"
                                                                                            href="#"
                                                                                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                            {{$unit->unit}}
                                                                                        </li>
                                                                                        @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                    =======
                                                                                    <div
                                                                                        class="flex flex-col md:flex-row items-center mb-8">
                                                                                        <div
                                                                                            class="mb-2 md:mb-0 flex items-center relative w-full md:w-1/3">
                                                                                            <x-utils.text-input
                                                                                                wire:model="prepTime"
                                                                                                type="number"
                                                                                                label="Tiempo de preparación"
                                                                                                :required="true"
                                                                                                placeholder="00"
                                                                                                class="w-full mr-2" />
                                                                                            <p
                                                                                                class="absolute top-8 left-16 text-eat-olive-600 text-sm">
                                                                                                Minutos</p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="mb-2 md:mb-0 flex items-center relative w-full md:w-1/3">
                                                                                            <x-utils.text-input
                                                                                                wire:model="cookTime"
                                                                                                type="number"
                                                                                                label="Tiempo de cocción"
                                                                                                :required="true"
                                                                                                placeholder="00"
                                                                                                class="w-full mr-2" />
                                                                                            <p
                                                                                                class="absolute top-8 left-16 text-eat-olive-600 text-sm">
                                                                                                Minutos</p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="flex items-center relative w-full md:w-1/3">
                                                                                            <x-utils.text-input
                                                                                                wire:model="totalTime"
                                                                                                type="text"
                                                                                                label="Total (automático)"
                                                                                                disabled=true
                                                                                                placeholder="00"
                                                                                                class="w-full mr-2" />
                                                                                            <p
                                                                                                class="absolute top-8 right-5 text-eat-olive-600 text-sm">
                                                                                                Minutos</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    >>>>>>>
                                                                                    09b30a725f890e9d50e6400fc655df9884825486

                                                                                    <div
                                                                                        class="flex items-center relative w-full md:w-1/3">
                                                                                        <x-utils.text-input
                                                                                            wire:model="totalTime"
                                                                                            type="text"
                                                                                            label="Total (automático)"
                                                                                            disabled=true
                                                                                            placeholder="00"
                                                                                            class="w-full mr-2" />
                                                                                        <p
                                                                                            class="absolute top-8 right-5 text-eat-olive-600 text-sm">
                                                                                            Minutos</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="flex flex-col md:flex-row items-center mb-8">
                                                                                    <div
                                                                                        class="mb-3 md:mb-0 flex items-center relative w-full md:w-2/5">
                                                                                        <x-utils.text-input
                                                                                            wire:model="recipeYield"
                                                                                            type="number"
                                                                                            label="Rinde para"
                                                                                            :required="true"
                                                                                            placeholder="0"
                                                                                            class="w-full md:mr-2" />
                                                                                        <p
                                                                                            class=" absolute top-8 left-16 text-eat-olive-600 text-sm">
                                                                                            Persona(s)</p>
                                                                                    </div>

                                                                                    <div class="w-full ">
                                                                                        <div x-data="{open: false}">
                                                                                            <label
                                                                                                for="recipeSuitableForDiet"
                                                                                                class="block text-sm font-medium leading-5 text-eat-olive-700">Dieta</label>
                                                                                            <div class="relative">
                                                                                                <div x-on:click="open=true"
                                                                                                    class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                                                    <x-utils.text
                                                                                                        class="ml-4">
                                                                                                        {{$recipeSuitableForDietName}}
                                                                                                    </x-utils.text>
                                                                                                    <x-icons.chevron
                                                                                                        class="mr-4 text-eat-olive-500 " />
                                                                                                </div>

                                                                                                <div x-show="open"
                                                                                                    x-on:click.away="open=false">
                                                                                                    <div
                                                                                                        class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                                                        <ul>
                                                                                                            @foreach
                                                                                                            ($dietType
                                                                                                            as
                                                                                                            $diet)
                                                                                                            @if
                                                                                                            ($diet
                                                                                                            ==
                                                                                                            $recipeSuitableForDietName)
                                                                                                            <li wire:click="SelectDiet('{{$diet}}')"
                                                                                                                href="#"
                                                                                                                class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                                {{$diet}}
                                                                                                            </li>
                                                                                                            @else
                                                                                                            <li x-on:click="open=false"
                                                                                                                wire:click="SelectDiet('{{$diet}}')"
                                                                                                                href="#"
                                                                                                                class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                                {{$diet}}
                                                                                                            </li>
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <<<<<<< HEAD <div
                                                                                    class="md:flex items-center mb-8 ">
                                                                                    <div
                                                                                        class="relative w-full md:w-1/2 mr-1 mb-3 md:mb-0">
                                                                                        <x-utils.text-input
                                                                                            wire:model="price"
                                                                                            type="text"
                                                                                            label="Precio público"
                                                                                            :required="true"
                                                                                            placeholder="0" pl="pl-8"
                                                                                            class="w-full mr-2" />
                                                                                        <p
                                                                                            class=" absolute top-9 left-4 text-eat-olive-600 text-sm">
                                                                                            $</p>
                                                                                        <p
                                                                                            class=" absolute top-9 right-16 text-eat-olive-600 text-sm">
                                                                                            MXN</p>
                                                                                    </div>

                                                                                    <div
                                                                                        class="relative w-full md:w-1/2 mr-1">
                                                                                        <x-utils.text-input
                                                                                            wire:model="cost"
                                                                                            type="text" label="Costo"
                                                                                            :required="true"
                                                                                            placeholder="0" pl="pl-8"
                                                                                            class="w-full mr-2" />
                                                                                        <p
                                                                                            class=" absolute top-9 left-4 text-eat-olive-600 text-sm">
                                                                                            $</p>
                                                                                        <p
                                                                                            class=" absolute top-9 right-16 text-eat-olive-600 text-sm">
                                                                                            MXN</p>
                                                                                    </div>
                                                                            </div>

                                                                            <div x-data="{stock: false}"
                                                                                class="flex items-center justify-evenly">
                                                                                <span>Existe en
                                                                                    stock?</span>
                                                                                <p x-on:click="stock=!stock"
                                                                                    wire:click="changeStock()"
                                                                                    :class="stock ? 'bg-eat-green-600 text-eat-olive-500' : 'bg-eat-fuccia-600 text-eat-white-50'"
                                                                                    class="w-1/2 py-2 text-center cursor-pointer">
                                                                                    Stock</p>
                                                                                =======
                                                                                >>>>>>>
                                                                                20724f972a40321dcb3e6d671426eba0eb83e6a1
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <<<<<<< HEAD <div class="w-full md:w-2/5 mr-1 ">
                                                                <div x-data="{open: false}">
                                                                    <div class="relative">
                                                                        <div x-on:click="open=true"
                                                                            class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                                                            {{-- <x-utils.text class="ml-4">{{$productName}}
                                                                            </x-utils.text> --}}
                                                                            <input
                                                                                class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                                                type="text" name="" id=""
                                                                                placeholder="Producto..."
                                                                                wire:model="queryProduct">
                                                                            <x-icons.chevron
                                                                                class="absolute top-2 right-4 text-eat-olive-500 " />
                                                                        </div>
                                                                        =======
                                                                        <div class="md:flex items-center mb-8 ">
                                                                            <div
                                                                                class="relative w-full md:w-1/2 mr-1 mb-3 md:mb-0">
                                                                                <x-utils.text-input wire:model="price"
                                                                                    type="text" label="Precio público"
                                                                                    :required="true" placeholder="0"
                                                                                    pl="pl-8" class="w-full mr-2" />
                                                                                <p
                                                                                    class=" absolute top-9 left-4 text-eat-olive-600 text-sm">
                                                                                    $</p>
                                                                                <p
                                                                                    class=" absolute top-9 right-16 text-eat-olive-600 text-sm">
                                                                                    MXN</p>
                                                                            </div>

                                                                            <div class="relative w-full md:w-1/2 mr-1">
                                                                                <x-utils.text-input wire:model="cost"
                                                                                    type="text" label="Costo"
                                                                                    :required="true" placeholder="0"
                                                                                    pl="pl-8" class="w-full mr-2" />
                                                                                <p
                                                                                    class=" absolute top-9 left-4 text-eat-olive-600 text-sm">
                                                                                    $</p>
                                                                                <p
                                                                                    class=" absolute top-9 right-16 text-eat-olive-600 text-sm">
                                                                                    MXN</p>
                                                                            </div>
                                                                        </div>
                                                                        >>>>>>>
                                                                        20724f972a40321dcb3e6d671426eba0eb83e6a1

                                                                        <div x-show="open" x-on:click.away="open=false">
                                                                            <div
                                                                                class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                                                <ul>
                                                                                    @foreach ($products as
                                                                                    $product)
                                                                                    @if ($product->id ==
                                                                                    $product_id)
                                                                                    <li wire:click="SelectProduct({{$product}})"
                                                                                        href="#"
                                                                                        class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                        {{$product->name}}
                                                                                    </li>
                                                                                    @else
                                                                                    <li x-on:click="open=false"
                                                                                        wire:click="SelectProduct({{$product}})"
                                                                                        href="#"
                                                                                        class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                        {{$product->name}}
                                                                                    </li>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                        <x-icons.add wire:click.debounce.150ms="addIngredient()"
                                                            class="text-eat-olive-500 cursor-pointer" />
                                                    </div>
                                                    @if ($ingredientList)
                                                    <ul class="mt-8">
                                                        @foreach ($ingredientList as $key => $ingredient)
                                                        <div class="flex items-center mt-4">
                                                            <p
                                                                class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
                                                                {{$key + 1}} </p>
                                                            <li class=" text-eat-olive-500 font-montserrat text-sm">
                                                                {{$ingredient['qty']}}
                                                                {{$ingredient['unit']}}
                                                                {{$ingredient['product']}} </li>
                                                        </div>
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                    <div class="mt-4">
                                                        <x-icons.not-found w='24' h='24' />
                                                        <x-utils.text class="text-center">Sin ingredientes
                                                        </x-utils.text>
                                                    </div>
                                                    @endif
                                                </div>
                                    </div>

                                    <<<<<<< HEAD <div x-show="tab===2"
                                        class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                        <div class="col-span-1 w-2/3 my-8">

                                            <p class="block text-sm font-medium leading-5 text-eat-olive-700 mb-2">
                                                Información
                                                nutricional (todas en gramos, excepto Calorías)</p>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Tam_porcion"
                                                        wire:model="tam_porcion"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                    border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Tamaño</span>
                                                </label>
                                                <x-utils.text-input wire:model="servingSize" type="text" label=""
                                                    :required="false" placeholder="Tamaño de la porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Calorias" wire:model="calorias"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span
                                                        class="ml-2 text-eat-olive-500 font-montserrat">Calorias</span>
                                                </label>
                                                <x-utils.text-input wire:model="calories" type="text" label=""
                                                    :required="false" placeholder="Calorias por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Carbohidratos"
                                                        wire:model="carbohidratos"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span
                                                        class="ml-2 text-eat-olive-500 font-montserrat">Carbohidratos</span>
                                                </label>
                                                <x-utils.text-input wire:model="carbohydrateContent" type="text"
                                                    label="" :required="false" placeholder="Carbohidratos por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Colesterol"
                                                        wire:model="colesterol"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span
                                                        class="ml-2 text-eat-olive-500 font-montserrat">Colesterol</span>
                                                </label>
                                                <x-utils.text-input wire:model="cholesterolContent" type="text" label=""
                                                    :required="false" placeholder="Colesterol por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Grasas" wire:model="Grasas"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Grasas</span>
                                                </label>
                                                <x-utils.text-input wire:model="fatContent" type="text" label=""
                                                    :required="false" placeholder="Grasas por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Grasas Saturadas"
                                                        wire:model="grasas_saturadas"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Grasas
                                                        Saturadas</span>
                                                </label>
                                                <x-utils.text-input wire:model="saturatedFatContent" type="text"
                                                    label="" :required="false"
                                                    placeholder="Grasas Saturadas por porción" class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Grasas Trans"
                                                        wire:model="grasas_trans"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Grasas
                                                        Trans</span>
                                                </label>
                                                <x-utils.text-input wire:model="transFatContent" type="text" label=""
                                                    :required="false" placeholder="Grasas Trans por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Grasas No Saturadas"
                                                        wire:model="grasas_no_saturadas"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Grasas
                                                        No Saturadas</span>
                                                </label>
                                                <x-utils.text-input wire:model="unsaturatedFatContent" type="text"
                                                    label="" :required="false"
                                                    placeholder="Grasas No Saturadas por porción" class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Fibra" wire:model="fibra"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Fibra</span>
                                                </label>
                                                <x-utils.text-input wire:model="fiberContent" type="text" label=""
                                                    :required="false" placeholder="Fibra por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Proteína" wire:model="proteina"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span
                                                        class="ml-2 text-eat-olive-500 font-montserrat">Proteína</span>
                                                </label>
                                                <x-utils.text-input wire:model="proteinContent" type="text" label=""
                                                    :required="false" placeholder="Proteína por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Sodio" wire:model="sodio"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Sodio</span>
                                                </label>
                                                <x-utils.text-input wire:model="sodiumContent" type="text" label=""
                                                    :required="false" placeholder="Sodio por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                            <div class="flex items-center mb-2">
                                                <label for="" class="w-3/12 flex items-center">
                                                    <input type="checkbox" id="" value="Azúcar" wire:model="azucar"
                                                        class="form-input bg-eat-green-500 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
                  border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent">
                                                    <span class="ml-2 text-eat-olive-500 font-montserrat">Azúcar</span>
                                                </label>
                                                <x-utils.text-input wire:model="sugarContent" type="text" label=""
                                                    :required="false" placeholder="Azúcar por porción"
                                                    class="w-2/3 mt-0" />
                                            </div>

                                        </div>
                            </div>

                            <div x-show="tab===3" class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                <div class="col-span-1 w-2/3 my-8">
                                    <div class=" text-eat-olive-500 mt-4 px-4">
                                        <label class="flex items-center cursor-pointer mt-8 mb-4" for="photos">
                                            <x-icons.avatar class="pr-3 " />
                                            <p class="mr-4">Subir imágen(es) </p>
                                            <div wire:loading wire:target="photos">
                                                <x-utils.loading />
                                                =======
                                                <div x-show="tab===1"
                                                    class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                    <div
                                                        class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8">
                                                        <label for="qty"
                                                            class="block text-sm font-medium leading-5 text-eat-olive-700">Ingredientes</label>
                                                        <div class="flex items-center justify-between">
                                                            <input wire:model="ingredientQty" type="number" name="qty"
                                                                min="1" max="999" value="1" id="qty" placeholder="1"
                                                                class="form-input block w-9 sm:w-1/5 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 pl-2 pr-0 mr-1">


                                                            <!-- Empieza -->
                                                            <div
                                                                class="flex flex-col sm:flex-row sm:justify-between w-9/12 sm:w-full">
                                                                <div class="w-full mb-2 md:w-1/2 md:mr-1 xl:w-1/3">
                                                                    <div x-data="{open: false}">
                                                                        <div class="relative">
                                                                            <div x-on:click="open=true"
                                                                                class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                                <x-utils.text class="ml-4">
                                                                                    {{$unitName}}
                                                                                </x-utils.text>
                                                                                <x-icons.chevron
                                                                                    class="mr-4 text-eat-olive-500 " />
                                                                            </div>

                                                                            <div x-show="open"
                                                                                x-on:click.away="open=false">
                                                                                <div
                                                                                    class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                                    <ul>
                                                                                        @foreach ($units as
                                                                                        $unit)
                                                                                        @if ($unit->id ==
                                                                                        $unit_id)
                                                                                        <li wire:click="SelectUnit({{$unit}})"
                                                                                            href="#"
                                                                                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                            {{$unit->unit}}
                                                                                        </li>
                                                                                        @else
                                                                                        <li x-on:click="open=false"
                                                                                            wire:click="SelectUnit({{$unit}})"
                                                                                            href="#"
                                                                                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                            {{$unit->unit}}
                                                                                        </li>
                                                                                        @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            >>>>>>>
                                                                            09b30a725f890e9d50e6400fc655df9884825486
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div x-show="tab===1"
                                                                    class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                                    <div
                                                                        class="col-span-1 w-full mx-auto md:w-5/6 lg:4/5 xl:w-2/3 my-8">
                                                                        <label for="qty"
                                                                            class="block text-sm font-medium leading-5 text-eat-olive-700">Ingredientes</label>
                                                                        <div class="flex items-center justify-between">
                                                                            <input wire:model="ingredientQty"
                                                                                type="number" name="qty" min="1"
                                                                                max="999" value="1" id="qty"
                                                                                placeholder="1"
                                                                                class="form-input block w-9 sm:w-1/5 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border border-transparent  focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm sm:leading-5 pl-2 pr-0 mr-1">


                                                                            <!-- Empieza -->
                                                                            <div
                                                                                class="flex flex-col sm:flex-row sm:justify-between w-9/12 sm:w-full">
                                                                                <div
                                                                                    class="w-full mb-2 md:w-1/2 md:mr-1 xl:w-1/3">
                                                                                    <div x-data="{open: false}">
                                                                                        <div class="relative">
                                                                                            <div x-on:click="open=true"
                                                                                                class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                                                <x-utils.text
                                                                                                    class="ml-4">
                                                                                                    {{$unitName}}
                                                                                                </x-utils.text>
                                                                                                <x-icons.chevron
                                                                                                    class="mr-4 text-eat-olive-500 " />
                                                                                            </div>

                                                                                            <div x-show="open"
                                                                                                x-on:click.away="open=false">
                                                                                                <div
                                                                                                    class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                                                    <ul>
                                                                                                        @foreach
                                                                                                        ($units
                                                                                                        as
                                                                                                        $unit)
                                                                                                        @if
                                                                                                        ($unit->id
                                                                                                        ==
                                                                                                        $unit_id)
                                                                                                        <li wire:click="SelectUnit({{$unit}})"
                                                                                                            href="#"
                                                                                                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                            {{$unit->unit}}
                                                                                                        </li>
                                                                                                        @else
                                                                                                        <li x-on:click="open=false"
                                                                                                            wire:click="SelectUnit({{$unit}})"
                                                                                                            href="#"
                                                                                                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                            {{$unit->unit}}
                                                                                                        </li>
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="w-full md:w-1/2 mr-1 xl:flex-grow">
                                                                                    <div x-data="{open: false}">
                                                                                        <div class="relative">
                                                                                            <div x-on:click="open=true"
                                                                                                class="w-full h-10 bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">

                                                                                                {{-- <x-utils.text class="ml-4">{{$productName}}
                                                                                                </x-utils.text>
                                                                                                --}}
                                                                                                <input
                                                                                                    class="w-full h-10 bg-eat-white-500 border border-transparent focus:outline-none focus:border-transparent focus:ring-2 focus:ring-eat-olive-600  sm:text-sm sm:leading-5"
                                                                                                    type="text" name=""
                                                                                                    id=""
                                                                                                    placeholder="Producto..."
                                                                                                    wire:model="queryProduct">
                                                                                                <x-icons.chevron
                                                                                                    class="absolute top-2 right-4 text-eat-olive-500 " />
                                                                                            </div>

                                                                                            <div x-show="open"
                                                                                                x-on:click.away="open=false">
                                                                                                <div
                                                                                                    class="overflow-y-auto max-h-48 z-10 absolute top-11 w-full bg-eat-green-100 mr-10 rounded">
                                                                                                    <ul>
                                                                                                        @foreach
                                                                                                        ($products
                                                                                                        as
                                                                                                        $product)
                                                                                                        @if
                                                                                                        ($product->id
                                                                                                        ==
                                                                                                        $product_id)
                                                                                                        <li wire:click="SelectProduct({{$product}})"
                                                                                                            href="#"
                                                                                                            class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                            {{$product->name}}
                                                                                                        </li>
                                                                                                        @else
                                                                                                        <li x-on:click="open=false"
                                                                                                            wire:click="SelectProduct({{$product}})"
                                                                                                            href="#"
                                                                                                            class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                            {{$product->name}}
                                                                                                        </li>
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Termina -->
                                                                            <x-icons.add
                                                                                wire:click.debounce.150ms="addIngredient()"
                                                                                class="ml-3 text-eat-olive-500 cursor-pointer" />
                                                                        </div>
                                                                        @if ($ingredientList)
                                                                        <ul class="mt-8">
                                                                            @foreach ($ingredientList as
                                                                            $key => $ingredient)
                                                                            <div class="flex items-center mt-4">
                                                                                <p
                                                                                    class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
                                                                                    {{$key + 1}} </p>
                                                                                <li
                                                                                    class=" text-eat-olive-500 font-montserrat text-sm">
                                                                                    {{$ingredient['qty']}}
                                                                                    {{$ingredient['unit']}}
                                                                                    {{$ingredient['product']}}
                                                                                </li>
                                                                            </div>
                                                                            @endforeach
                                                                        </ul>
                                                                        @else
                                                                        <div class="mt-4">
                                                                            <x-icons.not-found w='24' h='24' />
                                                                            <x-utils.text class="text-center">Sin
                                                                                ingredientes</x-utils.text>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div x-show="tab===2"
                                                                    class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                                    <div class="col-span-1 md:w-2/3 my-8 mx-auto">
                                                                        <div class="mt-6">
                                                                            <label for="nutritionInfo"
                                                                                class="block text-sm font-medium leading-5 text-eat-olive-700">Información
                                                                                nutricional</label>

                                                                            <div
                                                                                class="flex items-center mx-auto justify-center">
                                                                                <div
                                                                                    class="flex flex-col items-center mr-4 sm:mr-0 sm:w-full sm:flex-row">
                                                                                    <div
                                                                                        class="w-full md:w-1/2 mr-1 order-2 sm:order-1">
                                                                                        <div x-data="{open: false}">
                                                                                            <div class="relative">
                                                                                                <div x-on:click="open=true"
                                                                                                    class="w-full h-10 bg bg-eat-white-500 rounded-md shadow-lg flex items-center justify-between">
                                                                                                    <x-utils.text
                                                                                                        class="ml-4">
                                                                                                        {{$nutritionItemName}}
                                                                                                    </x-utils.text>
                                                                                                    <x-icons.chevron
                                                                                                        class="mr-4 text-eat-olive-500 " />
                                                                                                </div>

                                                                                                <div x-show="open"
                                                                                                    x-on:click.away="open=false">
                                                                                                    <div
                                                                                                        class=" z-10 absolute top-10 w-full bg-eat-green-100 mr-10 rounded">
                                                                                                        <ul>
                                                                                                            @foreach
                                                                                                            ($nutritionInfo
                                                                                                            as
                                                                                                            $key
                                                                                                            =>
                                                                                                            $nutritionItem)
                                                                                                            @if
                                                                                                            ($nutritionItem
                                                                                                            ==
                                                                                                            $nutritionItemName)
                                                                                                            <li wire:click="SelectNutritionItem('{{$nutritionItem}}', {{$key}})"
                                                                                                                href="#"
                                                                                                                class="block cursor-pointer w-full text-sm bg-eat-olive-500 text-eat-white-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                                {{$nutritionItem}}
                                                                                                            </li>
                                                                                                            @else
                                                                                                            <li x-on:click="open=false"
                                                                                                                wire:click="SelectNutritionItem('{{$nutritionItem}}', {{$key}})"
                                                                                                                href="#"
                                                                                                                class="block cursor-pointer w-full text-sm text-eat-olive-500 font-light font-montserrat text-left px-4 py-2 hover:bg-eat-olive-100 hover:text-eat-white-100">
                                                                                                                {{$nutritionItem}}
                                                                                                            </li>
                                                                                                            @endif
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div
                                                                                        class="flex items-center relative w-full order-1 md:w-1/3  sm:order-1">
                                                                                        <x-utils.text-input
                                                                                            wire:model="nutritionQty"
                                                                                            type="number" label=""
                                                                                            :required="false"
                                                                                            placeholder="0"
                                                                                            class="w-full md:mr-2" />
                                                                                        <p
                                                                                            class=" absolute top-3 left-14 text-eat-olive-600 text-sm">
                                                                                            {{$nutritionUnitName}}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <x-icons.add
                                                                                    wire:click.debounce.150ms="addNutritionItem()"
                                                                                    class="text-eat-olive-500 cursor-pointer" />

                                                                            </div>

                                                                        </div>
                                                                        @if ($nutritionList)
                                                                        <ul class="mt-8">
                                                                            @foreach ($nutritionList as $key
                                                                            => $nutritionItem)
                                                                            <div class="flex items-center mt-4">
                                                                                <p
                                                                                    class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
                                                                                    {{$loop->index + 1}}
                                                                                </p>
                                                                                <li
                                                                                    class="text-eat-olive-500 font-montserrat text-sm">
                                                                                    {{$key}}
                                                                                    {{$nutritionItem}}
                                                                                </li>
                                                                            </div>
                                                                            @endforeach
                                                                        </ul>
                                                                        @else
                                                                        <div class="mt-4">
                                                                            <x-icons.not-found w='24' h='24' />
                                                                            <x-utils.text class="text-center">Sin
                                                                                información nutrimental
                                                                            </x-utils.text>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                    <<<<<<< HEAD </div> <div x-show="tab===3"
                                                                        class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                                        <div class="col-span-1 w-2/3 my-8 mx-auto">
                                                                            <div class=" text-eat-olive-500 mt-4 px-4">
                                                                                <label
                                                                                    class="flex items-center cursor-pointer mt-8 mb-4"
                                                                                    for="photos">
                                                                                    <x-icons.avatar class="pr-3 " />
                                                                                    <p class="mr-4">
                                                                                        Subir imágen(es)
                                                                                    </p>
                                                                                </label>
                                                                                <div class="flex justify-center p-4">

                                                                                    @forelse ($photos as
                                                                                    $key => $photo)
                                                                                    <img class=" w-auto h-16 mr-1"
                                                                                        src="{{ $photo->temporaryUrl() }}">
                                                                                    @empty
                                                                                    <x-icons.upload-image width="w-40"
                                                                                        height="h-40" />
                                                                                    @endforelse


                                                                                </div>
                                                                                <input class="hidden"
                                                                                    wire:model="photos" type="file"
                                                                                    name="photos" id="photos" multiple>
                                                                                @error('photos')
                                                                                <p class="mt-2 text-sm text-red-600"
                                                                                    id="">{{$message}}
                                                                                </p>
                                                                                @enderror
                                                                            </div>

                                                                        </div>
                                                                </div>


                                                                <hr class=" border-eat-olive-50 mb-6 ">
                                                                <div class="mt-6 flex justify-end">
                                                                    <x-utils.button color="eat-olive" type="submit">
                                                                        Guardar
                                                                    </x-utils.button>
                                                                </div>
                                                                </form>
                                                                =======
                                                                <x-icons.add
                                                                    wire:click.debounce.150ms="addNutritionItem()"
                                                                    class="text-eat-olive-500 cursor-pointer" />

                                                            </div>

                                                        </div>
                                                        @if ($nutritionList)
                                                        <ul class="mt-8">
                                                            @foreach ($nutritionList as $key => $nutritionItem)
                                                            <div class="flex items-center mt-4">
                                                                <p
                                                                    class="w-10 h-10 rounded-full pt-2 text-center mr-4 bg-eat-fuccia-500 text-eat-white-500 text-sm font-montserrat">
                                                                    {{$loop->index + 1}} </p>
                                                                <li class="text-eat-olive-500 font-montserrat text-sm">
                                                                    {{$key}} {{$nutritionItem}} </li>
                                                            </div>
                                                            @endforeach
                                                        </ul>
                                                        @else
                                                        <div class="mt-4">
                                                            <x-icons.not-found w='24' h='24' />
                                                            <x-utils.text class="text-center">Sin información
                                                                nutrimental</x-utils.text>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div x-show="tab===3"
                                                    class="block lg:grid grid-cols-1 gap-4 place-items-center">
                                                    <div class="col-span-1 w-2/3 my-8 mx-auto">
                                                        <div class=" text-eat-olive-500 mt-4 px-4">
                                                            <label class="flex items-center cursor-pointer mt-8 mb-4"
                                                                for="photos">
                                                                <x-icons.avatar class="pr-3 " />
                                                                <p class="mr-4">Subir imágen(es) </p>
                                                                <<<<<<< HEAD </label> <div
                                                                    class="flex justify-center p-4">
                                                                    =======
                                                                    <div wire:loading wire:target="photos">
                                                                        <x-utils.loading />
                                                                    </div>

                                                            </label>
                                                            <div class="flex justify-center p-4">
                                                                >>>>>>> dishes

                                                                @forelse ($photos as $key => $photo)
                                                                <img class=" w-auto h-16 mr-1"
                                                                    src="{{ $photo->temporaryUrl() }}">
                                                                @empty
                                                                <x-icons.upload-image width="w-40" height="h-40" />
                                                                @endforelse


                                                            </div>
                                                            <input class="hidden" wire:model="photos" type="file"
                                                                name="photos" id="photos" multiple>
                                                            @error('photos')
                                                            <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                                                            @enderror
                                                            >>>>>>> 20724f972a40321dcb3e6d671426eba0eb83e6a1
                                                        </div>

                                        </label>
                                        <div class="flex justify-center p-4">

                                            @forelse ($photos as $key => $photo)
                                            <img class=" w-auto h-16 mr-1" src="{{ $photo->temporaryUrl() }}">
                                            @empty
                                            <x-icons.upload-image width="w-40" height="h-40" />
                                            @endforelse


                                        </div>
                                        <input class="hidden" wire:model="photos" type="file" name="photos" id="photos"
                                            multiple>
                                        @error('photos')
                                        <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                            <hr class=" border-eat-olive-50 mb-6 ">
                            <div class="mt-6 flex justify-end">
                                <x-utils.button color="eat-olive" type="submit">Guardar</x-utils.button>
                                >>>>>>> 09b30a725f890e9d50e6400fc655df9884825486
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @push('modals')
                <script>
                    << << << < HEAD
Livewire.on('success', message => {
    StayOrLeave(message, '¿Deseas agregar otro?', '/admin/recipes');
});

Livewire.on('error', message => {
            ===
            === =
            Livewire.on('success', message => {
                StayOrLeave(message, '¿Deseas agregar otro?', '/admin/recipes');
            });

            Livewire.on('error', message => {
                >>>
                >>> > 09 b30a725f890e9d50e6400fc655df9884825486
                thimsg = message;
                Toast.fire({
                    icon: 'error',
                    title: thimsg
                });
            })
                </script>
                @endpush