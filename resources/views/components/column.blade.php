<div class="divide-y divide-white">
@foreach ($items as $item) 

@if ($item['type'] === 'text') 
    <x-columns.text 
        :count="count($items)" 
        :first="$loop->first" 
        :last="$loop->last" 
        :left="$isLeft()" 
        :subtitle="$item['subtitle']" 
        :content="$item['content']" 
        :buttons="$item['buttons']" 
    />
@endif

@if ($item['type'] === 'image')
    @php
        $image = $live ? asset("storage/{$item['image']}") : asset('storage/' . array_pop($item['image']));
    @endphp     
    
    <x-columns.image 
        :image="$image" 
        :alt="$item['alt']" 
    />
@endif

@if ($item['type'] === 'agenda')
    <x-columns.agenda />
@endif

@if ($item['type'] === 'news')
    <x-columns.news />
@endif

@if ($item['type'] === 'newsletter')
    <x-columns.newsletter />
@endif

@if ($item['type'] === 'donation-form')
    <x-columns.donation-form />
@endif


@endforeach
</div>