@props(['project'])

<div class="row">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        {{ $slot }}
        @can('create', \App\Models\Task::class)
            <button class="btn btn-secondary mb-1 btn-sm" type="button" data-toggle="modal" data-target="#newTaskModal">
                {{ __('Create Task') }}
            </button>
            <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('Create Task') }}</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">

                        @livewire('create-task', ['project' => $project])

                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</div>