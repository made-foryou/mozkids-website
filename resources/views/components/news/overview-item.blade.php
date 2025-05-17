<a 
    {{ $attributes->merge(['class' => 'block bg-white shadow-sm rounded-lg overflow-hidden group cursor-pointer transition ease-in-out duration-245 hover:shadow-md']) }}
    href="{{ Made\Cms\Facades\Cms::url($post) }}"
>
    <figure>
        {{ $post->getFirstMedia('featured_image') }}
    </figure>
    <div
        class="py-8 px-6
               lg:py-13 lg:px-12"
    >
        <span class="block uppercase text-primary-500 font-sans text-sm">
            {{ $post->date->translatedFormat('d F Y') }}
        </span>
        <span class="block mt-2 text-black font-sans tracking-wide text-lg lg:text-xl">
            {{ $post->name }}
        </span>
        <p
            class="block mt-6"
        >
            {{ $post->introduction ?? '' }}
        </p>
        <span 
            class="block text-primary-500 font-sans group-hover:underline"
        >
            Lees verder...
        </span>
    </div>
</a>
