    changed 
    @php 
        $name = explode('_', $key);
        echo $name[0];
    @endphp
    
    from <strong>{{ $statuses->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $statuses->firstWhere('id', $after->$key)->name }}</strong>