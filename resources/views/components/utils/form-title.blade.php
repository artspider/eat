@props([
'color' => 'text-eat-olive-700',
'bg' => 'bg-eat-white-500'
])

<div {{ 
    $attributes->merge(['class' => $color .' text-2xl ' . $bg . ' font-montserrat uppercase tracking-tight'])}}>
    <p class="py-4 pl-4">{{$slot}}</p>
</div>