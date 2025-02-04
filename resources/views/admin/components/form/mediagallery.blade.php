@php $hashcode = hash('sha512', 'webolizma.' . date('d.m.y')) @endphp
<div class="form-group media-gallery">
    <label>{{ $label ?? '' }}</label>
    <div class="media-add form-control h-auto @error($name) is-invalid @enderror">
        <div class="d-flex align-items-center justify-content-center w-100 h-100 position-absolute" style="top: 0; left: 0;">
            <a href="javascript:;" id="{{ $name }}-file" class="btn" data-fancybox data-type="iframe" data-src="/assets/admin/filemanager/dialog.php?field_id={{ $name }}-file&akey={{ $hashcode }}">
                <span class="fa-stack text-success">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-cloud-upload-alt fa-stack-1x fa-inverse"></i>
                </span>
                <small>Select or Install</small>
            </a>
            <a href="javascript:;" id="{{ $name }}-link" class="btn">
                <span class="fa-stack text-primary">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-link fa-stack-1x fa-inverse"></i>
                </span>
                <small>Add from URL</small>
            </a>
        </div>
    </div>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <ul id="{{ $name }}" class="list-unstyled"></ul>
</div>

@pushonce('style_files:fancybox')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
@endpushonce

@pushonce('script_files:fancybox')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
@endpushonce

@pushonce('script_files:sortable')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
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

            gallery_select("{{ $name }}", @json(old($value ?? $name) ?? $model->{$value ?? $name} ?? []));

            $("#{{ $name }}").sortable({
                animation: 150,
                handle: ".sort",
                draggable: ".item",
                onSort: function (e) {
                    $(e.target).children("li.item").each(function () {
                        let index = $(this).index();
                        $(this).find(":hidden[name^={{ $name }}]").each(function () {
                            $(this).attr("name", $(this).attr("name").replace(/\d+/, index));
                        });
                    });
                },
                onStart: function (e) {
                    $("#{{ $name }}").find("a").addClass("d-none");
                },
                onEnd: function (e) {
                    $("#{{ $name }}").find("a").removeClass("d-none");
                }
            });

            $("#{{ $name }}-link").click(function () {
                let length = $("#{{ $name }}").children("li").length;
                let html = $("<li/>").html(gallery_item_html);
                html.find(".desktop :hidden:eq(0)").attr("name", "{{ $name }}[" + length + "][desktop][path]");
                html.find(".desktop :hidden:eq(1)").attr("name", "{{ $name }}[" + length + "][desktop][image]");
                html.find(".desktop :hidden:eq(2)").attr("name", "{{ $name }}[" + length + "][desktop][title]");
                html.find(".desktop :hidden:eq(3)").attr("name", "{{ $name }}[" + length + "][desktop][alt]");
                html.find(".desktop :hidden:eq(4)").attr("name", "{{ $name }}[" + length + "][desktop][id]");
                html.find(".mobile :hidden:eq(0)").attr("name", "{{ $name }}[" + length + "][mobile][path]");
                html.find(".mobile :hidden:eq(1)").attr("name", "{{ $name }}[" + length + "][mobile][image]");
                html.find(".mobile :hidden:eq(2)").attr("name", "{{ $name }}[" + length + "][mobile][title]");
                html.find(".mobile :hidden:eq(3)").attr("name", "{{ $name }}[" + length + "][mobile][alt]");
                html.find(".mobile :hidden:eq(4)").attr("name", "{{ $name }}[" + length + "][mobile][id]");
                $("#{{ $name }}").append(html);
                let el = html.find(".desktop");
                media_link(el, el.parent());
            });

        });
    </script>
@endpush
