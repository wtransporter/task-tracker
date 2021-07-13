    changed 
    @php 
        $name = explode('_', $key);
        echo $name[0];
    @endphp
    from <strong>{{ $value ?? 'Undefined' }}</strong> to <strong>{{ $after->$key }}</strong>