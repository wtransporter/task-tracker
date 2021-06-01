<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Owner</th>
                                        <th>Date created</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $project->user->name }}</td>
                                            <td>{{ $project->created_at }}</td>
                                            <td>{{ $project->title }}</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-info btn-sm" type="button">{{ __('Edit') }}</a>
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