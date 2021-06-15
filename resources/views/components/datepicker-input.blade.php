@props([
    'id',
    'field'
])

<input {{ $attributes }}
    type="text" class="form-control datetime" id="{{ $id }}"
    data-toggle="datetime" data-target="#{{ $id }}"
    >

@push('scripts')
<script>
    $(function () {
        $('#{{ $id }}').datetimepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            locale: 'en',
            sideBySide: true,
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
            }
        });
    });

    document.addEventListener('livewire:load', function () {
        
        $('#{{ $id }}').on('dp.change', function (e) {
    
            @this.set('{{ $field }}', e.target.value);
        });
    });
</script>
@endpush