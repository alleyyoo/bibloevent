@isset($model)
    @if($model->$name)
        @foreach($model->$name as $k => $v)
            <label>{{ $label }}</label>
            <div class="row dataset">
                <div class="col">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][key]" value="{{ $v->key }}" placeholder="Key">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][value]" value="{{ $v->value }}" placeholder="Value">
                </div>
                <a href="javascript:;"><i class="fas fa-minus-circle"></i></a>
            </div>
        @endforeach
    @endif
@endisset

<label>{{ $label }}</label>
<div class="row" data-name="{{ $name }}">
    <div class="col">
        <input type="text" class="form-control" id="{{ $name }}_key" placeholder="Key">
    </div>
    <div class="col">
        <input type="text" class="form-control" id="{{ $name }}_value" placeholder="Value">
    </div>
</div>

@pushonce('script_files:dataset')
<script src="{{ asset('admin/js/dataset.js') }}"></script>
@endpushonce

@push('script_codes')
    <script>
        $(function () {

            $("#{{ $name }}_key").keydown(dataset_keydown);
            $("#{{ $name }}_value").keydown(dataset_keydown);

        });
    </script>
@endpush
