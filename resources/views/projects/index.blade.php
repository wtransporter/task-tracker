<x-admin>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> {{ __('Projects list') }}</div>
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Date created</th>
                            <th>Title</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->user->name }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td>{{ $project->title }}</td>
                                <td><span class="badge badge-success">Active</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-admin>