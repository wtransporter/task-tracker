<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="col-sm-6">
                <div class="card">
                    <x-message class="m-3" />
                    <form action="{{ route('user.update', [$user]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="card-header"><strong>User</strong> <small>Profile</small></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="name"
                                    type="text" placeholder="Enter your name"
                                    value="{{ $user->name }}">
                                    <x-input-error for="name" />
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control" id="email" type="email" 
                                    name="email" placeholder="mail@test.com"
                                    value="{{ $user->email }}">
                                <x-input-error for="email" />
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" name="password"
                                        type="password" placeholder="Enter password">
                                    <x-input-error for="password" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="password">Password Confirm</label>
                                    <input class="form-control" id="password" name="password_confirmation"
                                        type="password" placeholder="Confirm your password">
                                        <x-input-error for="password" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>