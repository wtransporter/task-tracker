@props([
    'type' => 'danger',
    'for' => ''
])

@if ($errors->any())
    <span {{ $attributes->merge(['class' => 'mt-1 text-xs text-'.$type]) }}>
        <small>
            <em>
                @if ($for == '')
                    {{ $errors->first() }}
                @else
                    {{ $errors->first($for) }}
                @endif
            </em>
        </small>
    </span>
@endif