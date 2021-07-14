    Assignee changed from
    <strong>{{ $allUsers->firstWhere('id', $value)->name ?? 'Undefined' }}</strong> to <strong>{{ $allUsers->firstWhere('id', $after->$key)->name }}</strong>