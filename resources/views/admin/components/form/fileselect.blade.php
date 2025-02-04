@php $hashcode = hash('sha512', 'webolizma.' . date('d.m.y')) @endphp
<div class="form-group media-single">
    <label>{{ $label ?? '' }}</label>
    <div id="{{ $name }}" class="media-preview bg-light overflow-hidden rounded {{ old($name . '.desktop.path') || ($model->{$name}->desktop->path ?? false) ? 'chosen' : '' }}" style="height: {{ $height ?? 220 }}px" data-desktop="{{ $media[0] ?? 'Desktop Image' }}" data-mobile="{{ $media[1] ?? 'Mobile Image' }}">
        <div class="mobile {{ old($name . '.mobile.path') || ($model->{$name}->mobile->path ?? false) ? '' : 'd-none' }}">
            <input type="hidden" name="{{ $name }}[mobile][path]" value="{{ old($name . '.mobile.path') ?? $model->{$name}->mobile->path ?? '' }}">
            <input type="hidden" name="{{ $name }}[mobile][image]" value="{{ old($name . '.mobile.image') ?? $model->{$name}->mobile->image ?? '' }}">
            <input type="hidden" name="{{ $name }}[mobile][title]" value="{{ old($name . '.mobile.title') ?? $model->{$name}->mobile->title ?? '' }}">
            <input type="hidden" name="{{ $name }}[mobile][alt]" value="{{ old($name . '.mobile.alt') ?? $model->{$name}->mobile->alt ?? '' }}">
            <img src="{{ old($name . '.mobile.image') ?? isset($model) ? $model->{$name}->mobile->image ?? asset('admin/img/none.png') : asset('admin/img/none.png') }}">
        </div>
        <div class="desktop">
            <input type="hidden" name="{{ $name }}[desktop][path]" value="{{ old($name . '.desktop.path') ?? $model->{$name}->desktop->path ?? '' }}">
            <input type="hidden" name="{{ $name }}[desktop][image]" value="{{ old($name . '.desktop.image') ?? $model->{$name}->desktop->image ?? '' }}">
            <input type="hidden" name="{{ $name }}[desktop][title]" value="{{ old($name . '.desktop.title') ?? $model->{$name}->desktop->title ?? '' }}">
            <input type="hidden" name="{{ $name }}[desktop][alt]" value="{{ old($name . '.desktop.alt') ?? $model->{$name}->desktop->alt ?? '' }}">
            <img src="{{ old($name . '.desktop.image') ?? isset($model) ? $model->{$name}->desktop->image ?? asset('admin/img/none.png') : asset('admin/img/none.png') }}">
        </div>
        <div class="d-flex align-items-center justify-content-center w-100 h-100 position-absolute" style="top: 0; right: 0;">
            <div class="overlay rounded-pill shadow p-3 pl-4 pr-4">
                <a href="javascript:;" id="{{ $name }}-file" class="fa-stack text-success" data-fancybox data-type="iframe" data-src="/assets/admin/filemanager/dialog.php?field_id={{ $name }}-file&akey={{ $hashcode }}">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-cloud-upload-alt fa-stack-1x fa-inverse"></i>
                </a>
                <a href="javascript:;" id="{{ $name }}-link" class="fa-stack text-primary">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-link fa-stack-1x fa-inverse"></i>
                </a>
                <a href="javascript:;" class="fa-stack update">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-highlighter fa-stack-1x fa-inverse"></i>
                </a>
                <a href="javascript:;" class="fa-stack delete">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="d-none @error($name . '.desktop.path') form-control is-invalid @enderror"></div>
@error($name . '.desktop.path')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

@pushonce('style_files:fancybox')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
@endpushonce

@pushonce('script_files:fancybox')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
@endpushonce

@pushonce('style_files:media')
    <link rel="stylesheet" href="{{ asset('admin/css/media.css') }}">
@endpushonce

@pushonce('script_files:media')
    <script src="{{ asset('admin/js/media.js') }}"></script>
@endpushonce

@push('script_codes')
    <script>
        $(document).ready(function () {
            $("#{{ $name }}-link").click(function () {
                let el = $("#{{ $name }}").children(".desktop");
                media_link(el, el.parent());
            });
        });
    </script>
@endpush
