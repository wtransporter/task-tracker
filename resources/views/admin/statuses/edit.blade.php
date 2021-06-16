<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" />
                        <x-error class="m-3" />
                        <form
                            action="{{ route('statuses.update', [$status]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">{{ __('Update Status') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input value="{{ $status->name }}" class="form-control" name="name"
                                                   type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="color">{{ __('Color') }}</label>
                                            <input id="task-textarea" type="text" class="form-control" name="color" value="{{ $status->color }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-info" type="submit"> {{ __('Update Status') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>