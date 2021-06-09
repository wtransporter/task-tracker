<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if (session('message'))
                            <div class="alert alert-success m-3">{{ session('message') }}</div>
                        @endif
                        @if ($errors->any())
                            <ul class="alert alert-danger m-3">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                            </ul>
                        @endif
                        <div class="card-body">
                            <div>
                                <table class="table table-responsive-sm table-striped">
                                    <tbody>
                                        <th class="w-20">ID</th>
                                        <th>Name</th>
                                        <th>Color</th>
                                        <th>Action</th>
                                    @forelse ($tasktypes as $type)
                                        <tr>    
                                            <td>
                                                <strong class="mr-2">#{{ $type->id }}</strong>
                                            </td>
                                            <td>
                                                {{ $type->name }}
                                            </td>
                                            <td>
                                                {{ $type->color }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="w-4 mr-2">
                                                        <a href="{{ route('tasktypes.edit', $type) }}" class="text-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="w-4 mr-2">
                                                        <form id="deleteForm{{ $type->id }}" action="{{ route('tasktypes.destroy', $type->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a onclick="event.preventDefault();
                                                            var id = {{ $type->id }}
                                                            document.getElementById('deleteForm'+id).submit();" href="{{ route('tasktypes.destroy', $type) }}" class="text-danger">
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
                                            {{ __('No types yet') }}
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{-- {{ $tasks->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>