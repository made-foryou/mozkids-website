@if ($columns === 3)
<div {{ $attributes->merge(['class' => 'flex flex-col gap-4']) }}>
@else
<div {{ $attributes->merge(['class' => 'flex flex-col gap-8 divide-y divide-white']) }}>
@endif

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
        :columns="$columns"
    />
@endif

@if ($item['type'] === 'image')
    @php
        $image = $live ? asset("storage/{$item['image']}") : asset('storage/' . array_pop($item['image']));
    @endphp     
    
    <x-columns.image 
        :image="$image" 
        :alt="$item['alt']"
        :columns="$columns"
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

@if ($item['type'] === 'contact')
    <x-columns.contact :item="$item" />
@endif

@if ($item['type'] === 'bank')
    <x-columns.bank :item="$item" />
@endif

@if ($item['type'] === 'contact-form')
    <x-columns.contact-form :item="$item" />
@endif

@endforeach
</div>
