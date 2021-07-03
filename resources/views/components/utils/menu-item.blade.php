
<div {{$attributes->merge(['class' => 'pb-4 text-white hover:text-eat-fuccia-500'])}}>
  <a class="block px-4 py-2 hover:bg-white rounded-md"
    href="{{ route($routeInMenu) }}">
    <div class="flex items-center">
      <span class="mr-3"> {{$image}} </span>
      {{ $slot }}
    </div>
  </a>
</div>