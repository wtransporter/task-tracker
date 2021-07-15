<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12 my-2">
                    <a class="btn btn-info btn-sm text-white"
                        href="{{ route('projects.tasks.index', $project) }}">
                        {{ __('Back') }}
                    </a>
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" key="task-message" />
                        @if ($errors->storetask->any())
                            <div class="alert alert-danger p-2 m-2">
                                <ul class=" m-0">
                                    @foreach ($errors->storetask->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-header d-flex justify-content-between">
                            <span>
                                <strong>{{ ($task->tasktype->name ?? __('Undefined')) . ' #' . $task->id }}</strong> | {{ $project->title }}
                            </span>
                            @can('update', $task)
                            <div>
                                <a href="{{ route('projects.tasks.edit', [$project ?? $task->project, $task]) }}" class="btn btn-outline-info btn-sm">
                                    {{ __('Edit') }}
                                </a>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            
                            <div class="row flex-column align-items-start col-sm-12 col-lg-8 mb-4">
                                <span class="badge badge-pill badge-{{ $task->tasktype->color ?? 'info' }} px-3 py-2">{{ $task->tasktype->name ?? __('Undefined') }}</span>
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h5 class="my-2">{{ $task->title }}</h5><span class="text-info">{{ $task->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mb-3">
                                    {!! $task->description !!}
                                </p>
                            </div>
                            <div class="d-flex flex-column flex-md-row">
                                <div class="row col-sm-12 col-md-6 col-lg-4">
                                    <table class="table table-responsive-sm table-sm table-no-border">
                                        <tbody>
                                            <tr>
                                                <td class="w-20">
                                                    <strong>{{ __('Started at') }}:</strong>
                                                </td>
                                                <td class="w-64" style="vertical-align: middle;">
                                                    {{ $task->started_at ? $task->started_at->format('d-m-Y H:i:s') : 'Undefined' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-20">
                                                    <strong>{{ __('Due date') }}:</strong>
                                                </td>
                                                <td class="w-64" style="vertical-align: middle;">
                                                    {{ $task->due_date ? $task->due_date->format('d-m-Y H:i:s') : 'Undefined' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-20">
                                                    <strong>{{ __('Created date') }}:</strong>
                                                </td>
                                                <td class="w-64" style="vertical-align: middle;">
                                                    {{ $task->created_at ? $task->created_at->format('d-m-Y H:i:s') : 'Undefined' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row col-sm-12 col-md-6 col-lg-4">
                                    <table class="table table-responsive-sm table-sm table-no-border">
                                        <tbody>
                                            <tr>
                                                <td class="w-20">
                                                    <strong>{{ __('Priority') }}</strong>
                                                </td>
                                                <td class="w-64" style="vertical-align: middle;">
                                                    {{ $task->priority->name ?? __('Undefined') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-20">
                                                    <strong>{{ __('Assigned to') }}</strong>
                                                </td>
                                                <td class="w-64" style="vertical-align: middle;">
                                                    {{ $task->user->name ?? __('Unassigned') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-20">
                                                    <strong>{{ __('Status') }}</strong>
                                                </td>
                                                <td class="w-64" style="vertical-align: middle;">
                                                    <span class="badge badge-warning">
                                                        {{ $task->status->name ?? __('Undefined') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <x-comment :task="$task"/>
                </div>
            </div>
        </div>
    </div>
</x-admin>