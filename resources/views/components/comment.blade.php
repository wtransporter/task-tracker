@props(['task'])

<div class="card">
    <div class="card-header">
        <form
            action="{{ route('tasks.comments.store', $task) }}" method="POST">
            @csrf
            <div class="card-header">{{ __('Note') }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <textarea class="form-control" name="description" rows="5"
                                    type="text">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-sm">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm table-striped">
            <tbody>
                @forelse ($task->adjustments as $adjustment)
                <tr>
                    <td class="p-0 w-12" style="vertical-align: middle;">
                        <div class="c-avatar d-flex align-items-center p-1">
                            <img class="c-avatar-img" src=" {{ asset('assets/img/avatars/6.jpg') }}" alt="user@email.com">
                        </div>
                    </td>
                    <td class="p-0 py-2" style="vertical-align: middle;">
                        <div>
                            @if (isset($adjustment->pivot->description))
                                {{ $adjustment->pivot->description }}
                            @else
                                <?php
                                    $before = json_decode($adjustment->pivot->before);
                                    $after = json_decode($adjustment->pivot->after);
                                ?>
                                @foreach ($before as $key => $value)
                                    @if(View::exists('tasks.adjustments.' . $key))
                                        {{ $adjustment->name }}
                                        @include('tasks.adjustments.' . $key) <br>
                                    @else
                                        {{ $adjustment->name }}
                                        @include('tasks.adjustments.default') <br>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="p-0" style="vertical-align: middle;">
                        <small>
                            {{ $adjustment->pivot->created_at->format('d.m.Y H:i:s') }}
                        </small>
                    </td>
                    <td class="p-0" style="vertical-align: middle;">
                        <span class="badge badge-success">
                            {{ $adjustment->name }}
                        </span>
                    </td>
                </tr>
                @empty
                    <tr>
                        <div class="alert alert-danger">
                            No changes yet
                        </div>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>