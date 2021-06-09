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
                            <div class="alert alert-danger m-3">{{ $errors->first() }}</div>
                        @endif
                        <form
                            action="{{ route('tasktypes.store') }}" method="POST">
                            @csrf
                            <div class="card-header">{{ __('Create Type') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input value="{{ old('name') }}" class="form-control" name="name"
                                                   type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="color">{{ __('Color') }}</label>
                                            <input id="task-textarea" type="text" class="form-control" name="color" value="{{ old('color') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-info" type="submit"> {{ __('Create Type') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>