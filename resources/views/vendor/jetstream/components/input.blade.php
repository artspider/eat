@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent border-0 border-b-2 border-eat-pink-500 focus:border-eat-pink-500 ring-transparent focus:ring-transparent text-eat-white-500']) !!}>




