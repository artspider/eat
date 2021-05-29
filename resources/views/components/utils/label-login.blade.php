
@props([
'color' => 'eat-pink',
'fontsize' => 'base',
'fontweight' => 'semibold',
'value'
])

<label {{ $attributes->merge(['class' => ' block font-' . $fontweight . ' text-' . $fontsize .' text-'. $color .'-300']) }}>
    {{ $value ?? $slot }}
</label>
