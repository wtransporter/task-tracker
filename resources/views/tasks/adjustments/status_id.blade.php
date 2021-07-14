    Status changed from 
    <strong>{{ $statuses->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $statuses->firstWhere('id', $after->$key)->name }}</strong>