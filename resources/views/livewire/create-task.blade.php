<div class="card">
    <form action="">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input wire:model="title" class="form-control" name="title"
                            type="text">
                        <x-input-error for="title" />
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea wire:model="description" class="form-control" name="description" rows="5" id="task-textarea"></textarea>
                        <x-input-error for="description" />
                    </div>
                    <div class="d-flex flex-column flex-lg-row justify-content-between">
                        <div class="p-0 form-group col-6 col-md-5 col-lg-4 col-xl-3">
                            <label for="tasktypeId">{{ __('Type') }}</label>
                            <select wire:model="tasktypeId" class="form-control" name="tasktypeId" id="tasktypeId">
                                <option value="">
                                    -- Select Type --
                                </option>
                                @foreach($taskTypes as $taskType)
                                    <option value="{{ $taskType->id }}">
                                        {{ $taskType->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="tasktypeId" />
                        </div>
                        <div class="p-0 form-group col-6 col-md-5 col-lg-4 col-xl-3">
                            <label for="userId">{{ __('Assign to') }}</label>
                            <select wire:model="userId" class="form-control" name="userId" id="userId">
                                <option value="">-- Assign User --</option>
                                @foreach ($project->members as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="userId" />
                        </div>
                        <div class="form-group col-6 col-md-5 col-lg-3 col-xl-3 px-0">
                            <label for="startedAt">{{ __('Started at') }}</label>
                            <div wire:ignore>
                                <x-datepicker-input wire:model.defer="startedAt" 
                                    id="startedAt"
                                    field="startedAt"/>
                            </div>
                            <x-input-error for="startedAt" />
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-lg-row justify-content-between">
                        <x-status-dropdown class="p-0 col-6 col-md-5 col-lg-4 col-xl-3" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <button wire:click.prevent="store" class="btn btn-sm btn-info" type="submit"> {{ __('Save Task') }}</button>
            <a wire:click="resetAll" class="btn btn-secondary" data-dismiss="modal">Close</a>
        </div>
    </form>
</div>