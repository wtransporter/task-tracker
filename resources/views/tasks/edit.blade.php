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
                        <x-message key="task-message" />
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
                            action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">{{ __('Update Task') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }}</label>
                                            <input value="{{ $task->title }}" class="form-control" name="title"
                                                   type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">{{ __('Description') }}</label>
                                            <textarea class="form-control" name="description" rows="5" id="task-textarea">{{ $task->description }}</textarea>
                                        </div>
                                        <div class="form-group col-6 col-md-5 col-lg-4 col-xl-3 px-0">
                                            <label for="tasktype_id">{{ __('Type') }}</label>
                                            <select class="form-control" name="tasktype_id" id="tasktype_id">
                                                <option value="">
                                                    -- Select Type --
                                                </option>
                                                @foreach($taskTypes as $taskType)
                                                    <option value="{{ $taskType->id }}"
                                                        @if ($taskType->id == $task->tasktype_id)
                                                            selected
                                                        @endif>
                                                        {{ $taskType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6 col-md-5 col-lg-4 col-xl-3 px-0">
                                            <label for="started_at">{{ __('Started at') }}</label>
                                            <input value="{{ $task->started_at ? $task->started_at->format('d-m-Y H:i:s') : '' }}" class="form-control datetime" name="started_at" id="started_at">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-info" type="submit"> {{ __('Update Task') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>