@isset($model)
    @if($model->$name)
        @foreach($model->$name as $k => $v)
            <div class="row dataset">
                <div class="col">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][column]" value="{{ $v->column }}" placeholder="Column Name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][input]" value="{{ $v->input }}" placeholder="Input">
                </div>
                <a href="javascript:;"><i class="fas fa-minus-circle"></i></a>
            </div>
        @endforeach
    @endif
@endisset

<div class="row" data-name="{{ $name }}">
    <div class="col">
        <input type="text" class="form-control" id="{{ $name }}_column" placeholder="Column Name">
    </div>
    <div class="col">
        <input type="text" class="form-control" id="{{ $name }}_input" placeholder="Input">
    </div>
</div>

@pushonce('script_files:dataset')
<script src="{{ asset('admin/js/tableset.js') }}"></script>
@endpushonce

@push('script_codes')
    <script>
        $(function () {

            $("#{{ $name }}_column").keydown(dataset_keydown);
            $("#{{ $name }}_input").keydown(dataset_keydown);

        });
    </script>
@endpush
