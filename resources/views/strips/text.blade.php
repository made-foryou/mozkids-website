<section
    class="relative
           w-full
           py-12
           lg:py-18"
>
    <x-container class="max-w-5xl prose">
        <h1>{{ $title }}</h1>

        {!! str($content)->sanitizeHtml() !!}
    </x-container>
</section>
