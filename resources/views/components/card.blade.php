@props(['body'])
<div {{ $attributes->merge(['class' => 'card shadow-sm border-0']) }}>
    <div {{ $body->attributes->class(['card-body']) }}>
        {{$body}}
    </div>
</div>
