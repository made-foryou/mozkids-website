<section
    class="relative
           w-full
           py-8
           lg:py-12"
>
    <x-container class="max-w-5xl prose">
        <h1>{{ $title }}</h1>

        {!! str($content)->sanitizeHtml() !!}
    </x-container>
</section>
