@props(['task'])

<div class="card">
    <div class="card-body">
        <table class="table table-responsive-sm table-striped">
            <tbody>
                @forelse ($task->adjustments as $adjustment)
                <tr>
                    <td class="p-0 w-14" style="vertical-align: middle;">
                        <div class="c-avatar d-flex align-items-center p-1">
                            <img class="c-avatar-img" src="{{ $adjustment->avatar ? asset('storage') .'/'. $adjustment->avatar : asset('img/no-image.png') }}" alt="Avatar">
                        </div>
                    </td>
                    <td class="p-0 py-2" style="vertical-align: middle;">
                        <div>
                            <?php
                                $before = json_decode($adjustment->pivot->before);
                                $after = json_decode($adjustment->pivot->after);
                            ?>
                            Updated by
                            <span class="badge badge-success">
                                {{ $adjustment->name }}
                            </span>
                            {{ $adjustment->pivot->updated_at->diffForHumans() }}<br>
                            <hr class="mr-2 mt-2">
                            @if (!is_null($before))
                                <ul>
                                @foreach ($before as $key => $value)
                                    <li>
                                    @if(View::exists('tasks.adjustments.' . $key))
                                        @include('tasks.adjustments.' . $key) <br>
                                    @else
                                        @include('tasks.adjustments.default') <br>
                                    @endif
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                            @if (isset($adjustment->pivot->description))
                                {{ $adjustment->pivot->description }}<br>
                            @endif
                        </div>
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