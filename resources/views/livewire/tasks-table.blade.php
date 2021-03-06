<div class="fadeIn table-responsive-xl">
    <x-message key="task-message" />
    <div class="row">
        <div class="col-lg-12 mb-4 d-flex justify-content-between">
            <div class="d-flex">
                <button wire:click="toggleActive" class="btn btn-info btn-sm mr-2">
                    {{ $active ? 'All' : 'Active' }} tasks
                </button>
                <div class="w-64 d-flex justify-content-between">
                    <div class="input-group-append">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            Filter<span class="caret"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" style="margin: 0px;">
                            @foreach ($allTasktypes as $item)
                                <div class="form-check checkbox ml-2">
                                        <input wire:model.defer="tasktypes" class="form-check-input" name="tasktypes[{{ $item->id }}]" 
                                        id="check{{ $item->id }}" type="checkbox" 
                                        value="{{ $item->id }}">
                                    <label class="form-check-label" for="check{{ $item->id }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                            <a wire:click.prevent="applyFilter" href="#" class="text-info ml-2 mt-2">Apply</a>
                            <a wire:click.prevent="clear" href="" class="text-info ml-2 mt-2">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-64 d-flex justify-content-between">
                <input wire:model.debounce.600ms="search" class="form-control form-control-sm" id="search" type="text" placeholder="search">
                <button wire:click="clearSearch" class="ml-2 btn btn-square btn-sm btn-light">Clear</button>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <tbody>
                <th class="w-20">
                    <div class="d-flex">
                        <a wire:click.prevent="sortBy('id')" href="#">ID</a>
                        <x-sort-icon field="id" :sortField="$sortField" :sort="$sort"/>
                    </div>
                </th>
                <th class="w-20">Type</th>
                <th>
                    <div class="d-flex">
                        <a wire:click.prevent="sortBy('title')" href="#">Title</a>
                        <x-sort-icon field="title" :sortField="$sortField" :sort="$sort"/>
                    </div>
                </th>
                <th>Started at</th>
                <th>Finished at</th>
                <th class="w-64">Assigned to</th>
                <th class="w-30">Due date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            @forelse ($tasks as $task)
                <tr>
                    <td><strong>#{{ $task->id }}</strong></td>
                    <td>
                        <div class="mr-2 align-items-center badge badge-{{ $task->tasktype->color ?? 'info' }} badge-pill">{{ $task->tasktype->name }}</div>
                    </td>
                    <td>
                        <div class="d-flex flex-column justify-content-between ">
                            <a href="{{ route('projects.tasks.show', [$project ?: $task->project, $task]) }}">
                                @if (!is_null($task->finished_at))
                                <del class="text-success">
                                @endif
                                    {{ $task->title }}
                                @if (!is_null($task->finished_at))
                                </del>
                                @endif
                            </a>
                            <small class="text-danger italic">
                                {{ $project ? $project->title : $task->project->title }}
                            </small>
                        </div>
                    </td>
                    <td>
                        <span class="small mr-4">
                            {{ $task->started_at ?? '' }}
                        </span>
                    </td>
                    <td>
                        <span class="small mr-4">
                            {{ $task->finished_at ? $task->finished_at->format('d.m.Y H:i') : '' }}
                        </span>
                    </td>
                    <td>
                        {!! $task->user->name ?? '<span class="badge badge-warning">Unassigned</span>' !!}
                    </td>
                    <td>
                        <small>
                            {{ $task->due_date ? $task->due_date->format('d.m.Y') : '' }}
                        </small>
                    </td>
                    <td>
                        @if (!is_null($task->priority_id))
                            <span class="text-secondary' }}">{{ $task->priority->name }}</span>
                        @else
                            <span class="text-primary">{{ __('Not set') }}</span>
                        @endif
                    </td>
                    <td>
                        @if (!is_null($task->status_id))
                            <span class="text-{{ $task->status->color ?? 'primary' }}">{{ $task->status->name }}</span>
                        @else
                            <span class="text-primary">{{ __('Not set') }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            @can('update', $task)
                            <div class="w-4 mr-2">
                                <a href="{{ route('projects.tasks.edit', [$project ?? $task->project, $task]) }}" class="text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                            @endcan
                            @can('delete', $task)
                            <div class="w-4 mr-2">
                                <form id="deleteTask{{$task->id}}" action="{{ route('projects.tasks.destroy', [$project ?? $task->project, $task]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a onclick="event.preventDefault();
                                    var id = {{ $task->id }}
                                    document.getElementById('deleteTask'+id).submit();" href="{{ route('projects.tasks.destroy', [$project ?? $task->project, $task]) }}" class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                            @endcan
                            <div class="d-flex">
                                <div class="w-4 mr-2">
                                    @if (is_null($task->finished_at))
                                    <a wire:click.prevent="toggleStatus({{ $task->id }})" href="#" class="text-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="var(--ci-primary-color, currentColor)" d="M256.6,496A239.364,239.364,0,0,0,425.856,87.379,239.364,239.364,0,0,0,87.344,425.892,237.8,237.8,0,0,0,256.6,496Zm0-446.729c114.341,0,207.365,93.023,207.365,207.364S370.941,464,256.6,464,49.236,370.977,49.236,256.635,142.259,49.271,256.6,49.271Z" class="ci-primary"/>
                                        </svg>
                                    </a>
                                    @else
                                    <a wire:click.prevent="toggleStatus({{ $task->id }})" href="#" class="text-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="text-success" aria-disabled="">
                                            <path fill="var(--ci-primary-color, currentColor)" d="M426.072,86.928A238.75,238.75,0,0,0,88.428,424.572,238.75,238.75,0,0,0,426.072,86.928ZM257.25,462.5c-114,0-206.75-92.748-206.75-206.75S143.248,49,257.25,49,464,141.748,464,255.75,371.252,462.5,257.25,462.5Z" class="ci-primary"/>
                                            <polygon fill="var(--ci-primary-color, currentColor)" points="221.27 305.808 147.857 232.396 125.23 255.023 221.27 351.063 388.77 183.564 366.142 160.937 221.27 305.808" class="ci-primary"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    {{ __('No tasks yet') }}
                </tr>
            @endforelse
        </tbody>
    </table>
{{ $tasks->links() }}
</div>
