<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" />
                        <x-error class="m-3" />
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Owner</th>
                                        <th>Date created</th>
                                        <th>Title</th>
                                        <th>Done/Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td><strong>{{ $project->id }}</strong></td>
                                            <td>{{ $project->user->name }}</td>
                                            <td>{{ $project->created_at }}</td>
                                            <td>{{ $project->title }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $project->completed_tasks_count . '/' . $project->tasks_count }}
                                                </span>
                                            </td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="w-4 mr-2">
                                                        <a href="{{ route('projects.edit', $project) }}" class="text-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="w-4 mr-2">
                                                        <form id="deleteForm{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a onclick="event.preventDefault();
                                                            var id = {{ $project->id }}
                                                            document.getElementById('deleteForm'+id).submit();" href="{{ route('projects.destroy', $project) }}" class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>