    Priority changed from 
    <strong>{{ $priorities->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $priorities->firstWhere('id', $after->$key)->name }}</strong>