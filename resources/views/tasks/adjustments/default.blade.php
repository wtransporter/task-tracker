    @php 
        $name = explode('_', $key);
        echo ucfirst($name[0]) . ' changed from';
    @endphp
    <strong>{{ $value ?? 'Undefined' }}</strong> to <strong>{{ $after->$key }}</strong>