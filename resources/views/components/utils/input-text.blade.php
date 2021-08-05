@props([
'type' => "text",
'model' => "",
'label' => "",
'required' => false,
'placeholder' => "",
'pl' => "pl-4",
'disabled' => false,
])

<div class="{{$attributes->get('class')}}">
  <label for="{{$model}}" class="block text-sm font-medium leading-5 text-eat-olive-700">{{$label}}</label>
  <div class="mt-1 relative rounded-md shadow-md">
    <input name="{{$model}}" id="{{$model}}" type="{{$type}}" @if ($required) required @endif @if ($disabled) disabled
      @endif @error($model) class="form-input block w-full {{$pl}} pr-10 border-eat-fuccia-300 text-eat-fuccia-900 placeholder-eat-fuccia-300
    focus:border-eat-fuccia-100 focus:shadow-outline-red sm:text-sm sm:leading-5" @else class="form-input block w-full {{$pl}} pr-10 text-eat-olive-900 font-montserrat placeholder-eat-olive-50 border
    border-transparent focus:outline-none focus:ring-2 focus:ring-eat-olive-600 focus:border-transparent sm:text-sm
    sm:leading-5" @endif placeholder="{{$placeholder}}" @error($model) aria-invalid="true" aria-describedby=""
      @enderror>

    @error($model)
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
      <svg class="h-5 w-5 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path
          d="M16.143 2l5.857 5.858v8.284l-5.857 5.858h-8.286l-5.857-5.858v-8.284l5.857-5.858h8.286zm.828-2h-9.942l-7.029 7.029v9.941l7.029 7.03h9.941l7.03-7.029v-9.942l-7.029-7.029zm-6.471 6h3l-1 8h-1l-1-8zm1.5 12.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
      </svg>
    </div>
    @enderror
  </div>
  @error($model)
  <p class="mt-2 text-sm text-red-600" id="">{{$message}}</p>
  @enderror

</div>