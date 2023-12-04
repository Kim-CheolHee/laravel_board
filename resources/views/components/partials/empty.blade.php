@props(['text' => ''])

<section class="empty--wrapper">
    <div class="p-5 text-center w-100 h-100 tw-flex flex-column tw-justify-center empty-state">
        <div class="mb-5 text-secondary">
            {{ $text }}
        </div>
        <div>
            {{ $slot }}
        </div>
    </div>
</section>
