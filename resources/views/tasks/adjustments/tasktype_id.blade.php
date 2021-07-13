    changed 
    @php 
        $name = explode('_', $key);
        echo $name[0];
    @endphp
    from <strong>{{ $taskTypes->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $taskTypes->firstWhere('id', $after->$key)->name }}</strong>