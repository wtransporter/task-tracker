<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" />
                        <x-error class="m-3" />
                        <form
                            action="{{ route('priorities.store') }}" method="POST">
                            @csrf
                            <div class="card-header">{{ __('Create Priority') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input value="{{ old('name') }}" class="form-control" name="name"
                                                   type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-info" type="submit"> {{ __('Create Priority') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" />
                        <x-error class="m-3" />
                        <div class="card-body">
                            <div>
                                <table class="table table-responsive-sm table-striped">
                                    <tbody>
                                        <th class="w-20">ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    @forelse ($priorities as $priority)
                                        <tr>    
                                            <td>
                                                <strong class="mr-2">#{{ $priority->id }}</strong>
                                            </td>
                                            <td>
                                                {{ $priority->name }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="w-4 mr-2">
                                                        <a href="{{ route('priorities.edit', $priority) }}" class="text-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="w-4 mr-2">
                                                        <form id="deleteForm{{ $priority->id }}" action="{{ route('priorities.destroy', $priority->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a onclick="event.preventDefault();
                                                            var id = {{ $priority->id }}
                                                            document.getElementById('deleteForm'+id).submit();" href="{{ route('priorities.destroy', $priority) }}" class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-danger">
                                            {{ __('No priorities yet') }}
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>