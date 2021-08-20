<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-sm-10">
                <div class="card">
                    <x-message class="m-3" />
                        <div class="card-header"><strong>User</strong> <small>Notifications</small></div>
                        <div class="card-body">
                            @foreach ($notifications as $notification)
                            <span class="d-flex justify-content-between alert alert-success">
                                {{ '[' . $notification->created_at->diffForHumans() . '] ' . $notification->data['title'] }}
                                <a href="#" class="text-info">Mark as read</a>
                            </span>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-info">Mark all as read</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>