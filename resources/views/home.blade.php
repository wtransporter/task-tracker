<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">{{ __('Projects') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                            @foreach ($tasks as $task)
                                <div class="col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-header h6 p-2 m-0">
                                            <a href="{{ route('projects.tasks.show', [$task->project, $task]) }}">
                                                #{{$task->id }}
                                            </a>
                                            <span class="badge badge-{{ $task->tasktype->color }} float-right">
                                                {{ $task->tasktype->name }}
                                            </span>
                                            <div class="row col-lg-12">
                                                <a href="{{ route('projects.tasks.index', $task->project) }}">
                                                    <small class="text-dark">
                                                        {{ $task->project->title }}
                                                    </small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            {!! \Str::limit($task->title, 50) !!}
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between p-2">
                                            <div>
                                                <span class="badge badge-{{ $task->finished_at ? 'success' : 'danger' }} mr-1">
                                                    {{ $task->finished_at ? 'Finished' : 'Active' }}
                                                </span>
                                                <small>{{ $task->finished_at ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->finished_at)->format('m.d.Y H:i:s') : '' }}</small>
                                            </div>
                                            <small>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->created_at)->format('m.d.Y H:i:s') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>