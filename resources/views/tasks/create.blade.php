<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-info btn-sm text-white  my-2" 
                        href="{{ route('projects.edit', $project) }}">
                        {{ __('Back to project') }}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i> {{ __('List of Tasks') }}</div>
                        <div class="card-body">
                            <div class="col-lg-10 col-xl-12 p-0 m-0">
                                @livewire('tasks-table', ['project' => $project])
                            </div>
                        </div>
                    </div>
                    @can('create', \App\Models\Task::class)
                    <div class="card">
                        @if ($errors->storetask->any())
                            <div class="alert alert-danger p-2 m-2">
                                <ul class=" m-0">
                                    @foreach ($errors->storetask->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form
                            action="{{ route('projects.tasks.store', [$project]) }}" method="POST">
                            @csrf
                            <div class="card-header">{{ __('New Task') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }}</label>
                                            <input value="{{ old('title') }}" class="form-control" name="title"
                                                   type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">{{ __('Description') }}</label>
                                            <textarea class="form-control" name="description" rows="5" id="task-textarea">{{ old('description') }}</textarea>
                                        </div>
                                        <div class="d-flex flex-column flex-lg-row justify-content-between">
                                            <div class="p-0 form-group col-6 col-md-5 col-lg-4 col-xl-3">
                                                <label for="tasktype_id">{{ __('Type') }}</label>
                                                <select class="form-control" name="tasktype_id" id="tasktype_id">
                                                    <option value="">
                                                        -- Select Type --
                                                    </option>
                                                    @foreach($taskTypes as $taskType)
                                                        <option value="{{ $taskType->id }}">
                                                            {{ $taskType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="p-0 form-group col-6 col-md-5 col-lg-4 col-xl-3">
                                                <label for="user_id">{{ __('Assign to') }}</label>
                                                <select class="form-control" name="user_id" id="user_id">
                                                    <option value="">-- Assign User --</option>
                                                    @foreach ($project->members as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6 col-md-5 col-lg-3 col-xl-3 px-0">
                                                <label for="started_at">{{ __('Started at') }}</label>
                                                <input class="form-control datetime" name="started_at" id="started_at">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-info" type="submit"> {{ __('Save Task') }}</button>
                            </div>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-admin>