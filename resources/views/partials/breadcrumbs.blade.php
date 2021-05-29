@unless ($breadcrumbs->isEmpty())
<nav class=" mx-auto font-montserrat tracking-tight">
    <ol class="py-4 rounded flex flex-wrap text-sm text-eat-olive-500">
        @foreach ($breadcrumbs as $breadcrumb)

        @if ($breadcrumb->url && !$loop->last)
        <li>
            <a href="{{ $breadcrumb->url }}"
                class="text-eat-fuccia-500 hover:text-eat-fuccia-900 hover:underline focus:text-eat-fuccia-900 focus:underline">
                {{ $breadcrumb->title }}
            </a>
        </li>
        @else
        <li>
            {{ $breadcrumb->title }}
        </li>
        @endif

        @unless($loop->last)
        <li class="text-gray-500 px-2">
            /
        </li>
        @endif

        @endforeach
    </ol>
</nav>
@endunless