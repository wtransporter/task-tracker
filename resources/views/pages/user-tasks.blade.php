<x-admin>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <x-error />
                    <div class="card">
                        <div class="card-header">{{ __('My Tasks') }}</div>
                        <x-message />
                        <div class="card-body">
                            @livewire('tasks-table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>