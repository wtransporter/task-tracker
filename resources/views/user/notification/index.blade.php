<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-sm-10">
                @if (count($notifications) > 0)
                    <div class="card">
                        <x-message class="m-3" />
                        <div class="card-header"><strong>User</strong> <small>Notifications</small></div>
                        <div class="card-body">
                            @foreach ($notifications as $notification)
                            <span class="d-flex justify-content-between alert alert-success">
                                {{ '[' . $notification->created_at->diffForHumans() . '] ' . $notification->data['title'] }}
                                <form id="notification-post-{{ $notification->id }}" action="{{ route('notifications.store', $notification->id) }}" method="POST" hidden>
                                    @csrf
                                </form>
                                <a x-data={} @click.prevent="document.querySelector('#notification-post-{{$notification->id}}').submit()" href="#" class="text-info">Mark as read</a>
                            </span>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form id="notifications-read" action="{{ route('notifications.read') }}" method="POST" hidden>
                                @csrf
                            </form>
                            <a x-data={} @click.prevent="document.querySelector('#notifications-read').submit()" href="#" class="text-info">Mark as read</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        You dont have unread notifications.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin>