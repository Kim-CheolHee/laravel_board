@props([
    'items' => [],
])

<section {{ $attributes->merge(['class' => 'help-text mt-2']) }}>
    <ul class="m-0 list-unstyled">
        @forelse ($items as $item)
            <li class="text-secondary small tw-flex tw-items-start">
                <i class="material-icons inherit tw-mt-1 tw-mr-1">info</i>
                <span>{!! $item !!}</span>
            </li>
        @empty
        @endforelse
    </ul>
</section>
