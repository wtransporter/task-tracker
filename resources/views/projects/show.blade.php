<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header h5">{{ $project->title }}</div>
                        <div class="card-body">
                            {{ $project->content }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                            <ul class="alert alert-danger m-3">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                            </ul>
                        @endif
                        <div class="card-body">
                            <ul class="list-group">
                                <div class="col-md-10 col-xl-6 p-0">
                                @forelse ($project->tasks as $task)
                                    @livewire('user-tasks-table', ['task' => $task])
                                @empty
                                    <strong class="text-danger">
                                        {{ __('No tasks yet') }}
                                    </strong>
                                @endforelse
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>