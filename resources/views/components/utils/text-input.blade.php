@props([
'type' => "text",
'label' => "",
'required' => false,
'placeholder' => "",
'pr' => "pr-10",
'pl' => "pl-4",
'disabled' => false,
])

<div class="{{$attributes->get('class')}}">
    <label for="{{$attributes->whereStartsWith('wire:model')->first()}}"
        class="block text-sm font-medium leading-5 text-eat-olive-700">{{$label}}</label>
    <div class=" relative rounded-md shadow-md">
        <input {{$attributes->whereStartsWith('wire:model')}}
            name={{$attributes->whereStartsWith('wire:model')->first()}}
            id="{{$attributes->whereStartsWith('wire:model')->first()}}" type="{{$type}}" @if($required) required @endif
            @if ($disabled) disabled @endif @error($attributes->whereStartsWith('wire:model')->first())
        class="form-input block w-full {{$pl}} {{$pr}} border-eat-fuccia-300 text-eat-fuccia-900
        placeholder-eat-fuccia-300 focus:border-eat-fuccia-100 focus:shadow-outline-red sm:text-sm sm:leading-5
        bg-eat-white-500 font-bold"
        @else
        class="form-input block w-full {{$pl}} {{$pr}} text-eat-olive-900 font-montserrat placeholder-eat-olive-50
        bg-eat-white-500 font-bold
        border
        border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
        sm:leading-5"
        @endif
        placeholder="{{$placeholder}}"
        @error($attributes->whereStartsWith('wire:model')->first())
        aria-invalid="true"
        aria-describedby=""
        @enderror
        autocomplete="off"

        >

        @error($attributes->whereStartsWith('wire:model')->first())
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M16.143 2l5.857 5.858v8.284l-5.857 5.858h-8.286l-5.857-5.858v-8.284l5.857-5.858h8.286zm.828-2h-9.942l-7.029 7.029v9.941l7.029 7.03h9.941l7.03-7.029v-9.942l-7.029-7.029zm-6.471 6h3l-1 8h-1l-1-8zm1.5 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
            </svg>
        </div>
        @enderror
    </div>
    @error($attributes->whereStartsWith('wire:model')->first())
    <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
    @enderror

</div>