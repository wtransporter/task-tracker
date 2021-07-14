    Task type changed from 
    <strong>{{ $taskTypes->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $taskTypes->firstWhere('id', $after->$key)->name }}</strong>