<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" />
                        <x-error class="m-3"/>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>{{ __('Manage Project') }}</span>
                            <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-info btn-sm text-white">
                                {{ __('Tasks') }}
                            </a>
                        </div>
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
                                <div class="form-group">
                                    <label for="categories">{{ __('Categories') }}</label>
                                    <select class="form-control" name="categories[]" id="category" size="5" multiple="">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (in_array($category->name, $selectedCategories))
                                                    selected
                                                @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-info" type="submit"> {{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('Assigned users') }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('invitations.store', $project) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-9 col-form-label">
                                        @foreach ($allUsers as $user)
                                        <div class="form-check checkbox">
                                            <input class="form-check-input" name="users[{{ $user->id }}]" 
                                                id="check{{ $user->id }}" type="checkbox" 
                                                value="{{ $user->id }}"
                                                @if($project->members->find($user->id))
                                                    checked
                                                @endif>
                                            <label class="form-check-label" for="check{{ $user->id }}">{{ $user->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="btn btn-info btn-sm" >{{ __('Add / remove') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>