<div>
    <table class="table table-responsive-sm table-striped">
        <tbody>
            <th>ID</th>
            <th>Type</th>
            <th>Title</th>
            <th>Mark as done</th>
        @forelse ($tasks as $task)
            <tr>    
                <td>
                    <strong class="mr-2">#{{ $task->id }}</strong>
                </td>
                <td>
                    <span class="badge badge-{{ $task->tasktype->color ?? 'info' }} badge-pill">
                        {{ $task->tasktype->name }}
                    </span>
                </td>
                <td>
                    <div class="d-flex justify-content-between align-items-center">
                        @if (!is_null($task->finished_at))
                        <del class="text-success">
                        @endif
                            {{ $task->title }}
                        @if (!is_null($task->finished_at))
                        </del>
                        <span class="small mr-4">{{ __('Finished: ') }} {{ date(('d.m.Y H:i'), strtotime($task->finished_at)) }}</span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="d-flex">
                        <div class="w-4 mr-2">
                            @if (is_null($task->finished_at))
                            <a wire:click.prevent="toggleStatus({{ $task }})" href="#" class="text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="var(--ci-primary-color, currentColor)" d="M256.6,496A239.364,239.364,0,0,0,425.856,87.379,239.364,239.364,0,0,0,87.344,425.892,237.8,237.8,0,0,0,256.6,496Zm0-446.729c114.341,0,207.365,93.023,207.365,207.364S370.941,464,256.6,464,49.236,370.977,49.236,256.635,142.259,49.271,256.6,49.271Z" class="ci-primary"/>
                                </svg>
                            </a>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="text-success" aria-disabled="">
                                    <path fill="var(--ci-primary-color, currentColor)" d="M426.072,86.928A238.75,238.75,0,0,0,88.428,424.572,238.75,238.75,0,0,0,426.072,86.928ZM257.25,462.5c-114,0-206.75-92.748-206.75-206.75S143.248,49,257.25,49,464,141.748,464,255.75,371.252,462.5,257.25,462.5Z" class="ci-primary"/>
                                    <polygon fill="var(--ci-primary-color, currentColor)" points="221.27 305.808 147.857 232.396 125.23 255.023 221.27 351.063 388.77 183.564 366.142 160.937 221.27 305.808" class="ci-primary"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr class="text-danger">
                {{ __('No tasks yet') }}
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $tasks->links() }}
</div>
