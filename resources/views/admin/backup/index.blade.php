<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <x-message class="m-3" />
                        <x-error class="m-3" />
                        <div class="card-header">
                            {{ __('Database backup') }}
                        </div>
                        <div class="card-body">
                            <div class="py-2 d-flex">
                                <form action="{{ route('backups.store') }}" method="POST">
                                    @csrf
                                    <button href="{{ route('backups.store') }}" class="btn btn-sm btn-info text-white"> {{ __('Backup All') }}</button>
                                </form>
                                <form action="{{ route('backups.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="onlySql" value="true">
                                    <button href="{{ route('backups.store') }}" class="btn btn-sm btn-info text-white ml-2"> {{ __('Only Sql') }}</button>
                                </form>
                            </div>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>File name</th>
                                        <th>Date created</th>
                                        <th>File size</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td><strong>{{ $loop->iteration }}</strong></td>
                                            <td>
                                                <a href="#">
                                                    {{ $file['file_name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $file['file_created'] }}</td>
                                            <td>{{ $file['file_size'] }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="w-4 mr-2">
                                                        <a href="" class="text-info">
                                                            <svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path fill="currentColor" d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>