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
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header h5">{{ $project->title }}</div>
                        <div class="card-body">
                            {{ $project->content }}
                        </div>
                    </div>
                </div>
            </div> --}}
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

                        <form
                            action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">{{ __('Update Task') . ' #' . $task->id }} | {{ $project->title }}</div>
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
                                            
                                                <textarea class="form-control my-editor" 
                                                    name="description" 
                                                    rows="5" 
                                                    id="task-textarea"
                                                    @cannot('edit_task_description')
                                                        readonly
                                                    @endcannot
                                                    >{{ $task->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <x-status-dropdown taskStatusId="{{$task->status_id}}" class="p-0 col-sm-12 col-md-6 col-lg-10 col-xl-6" />
                                        <div class="form-group col-sm-12 col-md-6 col-lg-10 col-xl-6 px-0">
                                            <label for="due_date">{{ __('Due date') }}</label>
                                            <input value="{{ $task->due_date ? $task->due_date->format('d-m-Y H:i:s') : '' }}" class="form-control date" name="due_date" id="due_date">
                                        </div>
                                        <div class="p-0 form-group col-sm-12 col-md-6 col-lg-10 col-xl-6">
                                            <label for="priority_id">{{ __('Priority') }}</label>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                <option value="">-- Select --</option>
                                                @foreach ($priorities as $priority)
                                                    <option value="{{ $priority->id }}"
                                                        @if($task->priority_id == $priority->id)
                                                            selected
                                                        @endif>
                                                        {{ $priority->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-10 col-xl-6 px-0">
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
                                        <div class="p-0 form-group col-sm-12 col-md-6 col-lg-10 col-xl-6">
                                            <label for="user_id">{{ __('Assign to') }}</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                <option value="">-- Assign User --</option>
                                                @foreach ($project->members as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if($task->user_id == $user->id)
                                                            selected
                                                        @endif>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-10 col-xl-6 px-0">
                                            <label for="started_at">{{ __('Started at') }}</label>
                                            <input value="{{ $task->started_at ? $task->started_at->format('d-m-Y H:i:s') : '' }}" class="form-control datetime" name="started_at" id="started_at">
                                        </div>
                                    </div>
                                    <div x-data="{ show: false }" class="col-sm-12 col-lg-12">
                                        <div class="card-header">
                                            <a @click.prevent="show = !show" href="#" class="btn btn-info text-sm btn-sm">
                                                {{ __('Add Note') }}
                                            </a>
                                        </div>
                                        <div x-show="show" class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control my-editor" name="note" rows="5"
                                                                type="text">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-info" type="submit"> {{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if ($task->adjustments->count() > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <x-comment :task="$task"/>
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    No changes yet
                </div>
            @endif
        </div>
    </div>
</x-admin>