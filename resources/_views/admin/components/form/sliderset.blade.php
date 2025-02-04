@isset($model->$name)
    @if($model->$name)
        @foreach($model->$name as $k => $v)
            <label>{{ $label ?? '' }}</label>
            <div class="row dataset">
                <div class="col">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][title]" value="{{ $v->title }}" placeholder="Title">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][desc]" value="{{ $v->desc }}" placeholder="Short Desc">
                </div>
                <a href="javascript:;"><i class="fas fa-minus-circle"></i></a>
                <div class="col-12">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][btitle]" value="{{ $v->btitle }}" placeholder="Button Title" style="margin-top: 15px">
                </div>
                <div class="col-12">
                    <input type="text" class="form-control" name="{{ $name }}[{{ $k }}][link]" value="{{ $v->link }}" placeholder="Button Link" style="margin-top: 15px">
                </div>
            </div>
        @endforeach
    @endif
@endisset

<label>{{ $label ?? '' }}</label>
<div class="row" data-name="{{ $name }}">
    <div class="col">
        <input type="text" class="form-control" id="{{ $name }}_title" placeholder="Title">
    </div>
    <div class="col">
        <input type="text" class="form-control" id="{{ $name }}_desc" placeholder="Short Desc">
    </div>
    <div class="col-12">
        <input type="text" class="form-control" id="{{ $name }}_btitle" placeholder="Button Title" style="margin-top: 15px">
    </div>
    <div class="col-12">
        <input type="text" class="form-control" id="{{ $name }}_link" placeholder="Button Link" style="margin-top: 15px">
    </div>
</div>

@pushonce('script_files:dataset')
<script src="{{ asset('admin/js/datasetSlider.js') }}"></script>
@endpushonce

@push('script_codes')
    <script>
        $(function () {

            $("#{{ $name }}_title").keydown(dataset_keydown);
            $("#{{ $name }}_desc").keydown(dataset_keydown);
            $("#{{ $name }}_link").keydown(dataset_keydown);
            $("#{{ $name }}_btitle").keydown(dataset_keydown);
        });
    </script>
@endpush
