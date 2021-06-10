@props([
    'type' => 'success',
    'key' => 'message'
])

@if (session($key))
    <div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
        {{ session($key) }}
    </div>
@endif