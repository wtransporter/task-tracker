<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <x-error />
                    <div class="card">
                        <div class="card-header">{{ __('Projects') }}</div>
                        <div class="card-body">
                            <x-message />
                            <div class="row">
                                @forelse ($projects as $project)
                                <div class="col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-header h6 p-2 m-0">
                                            <a href="">
                                                #{{$project->id }}
                                            </a>
                                            <span class="badge badge-info float-right">
                                                {{ $project->completed_tasks_count . '/' .$project->tasks_count }}
                                            </span>
                                            <div class="row col-lg-12">
                                                <a href="{{ route('projects.tasks.index', $project) }}">
                                                    <small class="text-dark">
                                                        {{ $project->title }}
                                                    </small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            {!! \Str::limit($project->content, 50) !!}
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between p-2">
                                            <small>{{ __('Created at:') }} {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $project->created_at)->format('m.d.Y H:i:s') }}</small>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="alert alert-info w-full mx-3 m-0">
                                        {{ __('You are not a member of any project yet.') }}
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>