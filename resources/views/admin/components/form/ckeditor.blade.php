<div class="form-group">
    <label for="{{ $name }}">{{ $label ?? '' }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}">
        {{ $value ?? (old($name) ?? $model->{$name} ?? '') }}
    </textarea>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@pushonce('script_files:ckeditor')
    <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
@endpushonce

@php $hashcode = hash('sha512', 'webolizma.' . date('d.m.y')) @endphp

@push('script_codes')
    <script>
        $(document).ready(function () {
            CKEDITOR.replace("{{ $name }}", {
                versionCheck: false,
                filebrowserBrowseUrl: "/assets/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ $hashcode }}",
                filebrowserUploadUrl: "/assets/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ $hashcode }}",
                filebrowserImageBrowseUrl: "/assets/admin/filemanager/dialog.php?type=1&editor=ckeditor&akey={{ $hashcode }}",
                height: "{{ $heigth ?? 242 }}",
                extraAllowedContent: "div(*)",
                entities_latin: false,
                entities: false,
                toolbar: [
                    { items: [ 'Maximize', 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Image', 'Table', 'HorizontalRule', 'PageBreak', 'Link', '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'RemoveFormat' ] },
                    '/',
                    { items: [ 'Format', 'FontSize', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'TextColor', 'BGColor' ] }
                ]
            });
        });
    </script>
@endpush
