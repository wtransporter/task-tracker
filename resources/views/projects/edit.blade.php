<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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
                            <form action="{{ route('projects.update', $project) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input class="form-control" id="title" type="text" name="title" value="{{ $project->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="content">{{ __('Content') }}</label>
                                    <textarea class="form-control" id="content" rows="3" name="content">{{ $project->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="note">{{ __('Note') }}</label>
                                    <textarea class="form-control" id="note" rows="3" name="note">{{ $project->note }}</textarea>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-info" type="submit"> {{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>