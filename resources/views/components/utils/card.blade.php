@props([
    'withoutbody' => false,
    'bodyClass' => null,
])

<div {{ $attributes->merge(['class' => 'card border-0', 'style' => '']) }}>

    @if ($withoutbody == true)
        {{ $slot }}
    @else
        <div class="card-body {{ $bodyClass }}">
            {{ $slot }}
        </div>
    @endif
</div>
