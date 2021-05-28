@props([
'disabled' => false,
'color' => 'eat-white',
'is_disabled' => 'enabled',
'bordercolor' => 'eat-pink',
])
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent border-0 border-b-2 border-' .$bordercolor .'-500  focus:border-' .$bordercolor . '-500 ring-transparent focus:ring-transparent text-' .$color . '-500 transform focus:translate-y-2 transition  duration-300 ease-in-out']) !!}>