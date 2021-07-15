    @php 
        $name = explode('_', $key);
        echo ucfirst($name[0]) . ' changed from';
    @endphp
    <strong>{{ strip_tags($value) ?? 'Undefined' }}</strong> to {!! strip_tags($after->$key) !!}