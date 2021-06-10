@props(['type' => 'danger'])

@if ($errors->any())
    <ul {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
    @foreach ($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
    @endforeach
    </ul>
@endif