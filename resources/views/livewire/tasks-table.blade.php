<div class="fadeIn">
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
<table class="table table-responsive-sm table-striped">
    <tbody>
            <th>
                <a wire:click.prevent="orderById" href="#">ID</a>
            </th>
            <th>Type</th>
            <th>Title</th>
            <th>Assigned to</th>
            <th>Is active</th>
            <th>Actions</th>
        @forelse ($tasks as $task)
            <tr>
                <td><strong>#{{ $task->id }}</strong></td>
                <td>
                    <div class="mr-2 align-items-center badge badge-{{ $task->tasktype->color ?? 'info' }} badge-pill">{{ $task->tasktype->name }}</div>
                </td>
                <td>{{ $task->title }}</td>
                <td>
                    @livewire('assign-task-to-user', ['task' => $task], key($task->id))
                </td>
                <td>
                    @if (!is_null($task->finished_at))
                        <span class="badge badge-success">Finished</span>
                    @else
                        <span class="badge badge-danger">Active</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex">
                        <div class="w-4 mr-2">
                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-4 mr-2">
                            <form id="deleteTask{{$task->id}}" action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a onclick="event.preventDefault();
                                var id = {{ $task->id }}
                                document.getElementById('deleteTask'+id).submit();" href="{{ route('projects.tasks.destroy', [$project, $task]) }}" class="text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
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
