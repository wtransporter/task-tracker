<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    @forelse ($activities as $date => $item)
                    <div class="card">
                        <div class="card-header">
                                {{ $date }}
                            </div>
                            <div class="card-body">
                                @foreach ($item as $activity)
                                    <div class="d-flex justify-content-between w-120">
                                        <h6>
                                            <span class="text-danger">{{ $activity->user->name }}</span> {{ str_replace('_', ' ', $activity->type)  }} "{{ $activity->subject->title }}"
                                        </h6>
                                        <span>{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                    @empty
                        {{ __('No activities yet') }}
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin>