@props([
'color' => 'eat-white',
'is_disabled' => 'enabled',
'textcolor' => 'eat-white-500',
'tracking' => 'wider',
'rounded' => 'full',
'textwidth' => 'base'
])
<button {{$is_disabled}}
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-' . $color . '-500 border border-transparent rounded-' . $rounded . ' font-semibold text-' . $textwidth . ' text-'. $textcolor . '-500 uppercase tracking-' . $tracking . ' hover:bg-' . $color . '-300 active:bg-' . $color . '-700 focus:outline-none focus:border-' . $color . '-700 focus:ring ring-' . $color . '-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>