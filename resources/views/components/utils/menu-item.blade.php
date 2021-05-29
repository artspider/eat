<div {{$attributes->merge(['class' => 'pl-7 pb-4 text-eat-olive-700 hover:text-eat-pink-500'])}}>
  <a class="text-eat-olive-700 hover:text-eat-fuccia-700 flex items-center focus:outline-none duration-150 ease-in-out"
    href="{{ route($routeInMenu) }}">
    <span class="mr-3"> {{ $image }} </span>
    {{ $slot }}
  </a>
</div>