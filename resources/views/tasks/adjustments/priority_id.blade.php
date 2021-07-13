    changed 
    @php 
        $name = explode('_', $key);
        echo $name[0];
    @endphp from <strong>{{ $priorities->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $priorities->firstWhere('id', $after->$key)->name }}</strong>