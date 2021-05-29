@props(['value'])

<label {{ $attributes->merge(['class' => ' block font-semibold text-sm text-eat-pink-300']) }}>
    {{ $value ?? $slot }}
</label>
