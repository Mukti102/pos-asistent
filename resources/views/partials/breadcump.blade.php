@if (isset($breadcrumbs) && count($breadcrumbs))
<nav class="flex mb-5 w-max px-3.5 py-1 border border-neutral-200/60 rounded-md">
    <ol
        class="inline-flex items-center space-x-1 text-xs text-neutral-500
               [&_.active-breadcrumb]:text-neutral-700
               [&_.active-breadcrumb]:font-medium">

        @foreach ($breadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if (!$loop->last)
                    <a href="{{ $breadcrumb['url'] ?? '#' }}"
                       class="inline-flex items-center py-1 hover:text-neutral-900">
                        {{ $breadcrumb['label'] }}
                    </a>
                @else
                    <span class="active-breadcrumb py-1 cursor-default">
                        {{ $breadcrumb['label'] }}
                    </span>
                @endif
            </li>

            @if (!$loop->last)
                <svg class="w-4 h-4 mx-1 text-gray-400/70"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M10 8l4 4-4 4" stroke="currentColor"
                          stroke-width="2" fill="none"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            @endif
        @endforeach

    </ol>
</nav>
@endif
