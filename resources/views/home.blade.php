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
                            @foreach ($projects as $project)
                                <div class="col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-header h6 p-2 m-0">
                                            <a href="{{ route('projects.tasks.index', $project) }}">
                                                {{ $project->title }}
                                            </a>
                                        </div>
                                        <div class="card-body p-2">
                                            {!! \Str::limit($project->content, 50) !!}
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-success mr-1">Task</span>
                                            <small>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $project->created_at)->format('m.d.Y') }}</small>
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