@extends('admin.layouts.content')

@section('admin.layouts.content.section')
    <div class="d-flex justify-content-between align-items-center shadow mb-5 p-2">
        <div class="breadcrumb bg-transparent m-0">
            @foreach($category->breadcrumbs() as $link => $title)
                <a href="{{ $link }}" class="breadcrumb-item">{{ $title }}</a>
            @endforeach
        </div>

        <a href="{{ route('admin.page.create', [ 'category_id' => $category->id ?? '' ]) }}" id="createButton" class="btn btn-success">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <table id="list" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="30"></th>
            <th width="50"></th>
            <th>Başlık</th>
            <th width="60">Durum</th>
            <th width="70">İşlem</th>
        </tr>
        </thead>

        <tbody>
        @foreach($pages as $key => $page)
            <tr class="item" data-id="{{ $page->id }}">
                <td class="text-center sort">
                    <div class="fa-stack index empty">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-bars fa-stack-1x fa-inverse"></i>
                        <span>{{ $key + 1 }}</span>
                    </div>
                </td>
                <td>
                    @isset($page->media->desktop->path)
                        <a href="{{ $page->media->desktop->path }}" data-fancybox>
                            <img src="{{ $page->previewImage($page->media->desktop->image) }}" class="rounded"
                                 style="width: 60px; height: 50px; object-fit: cover">
                        </a>
                    @else
                        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDQ4IDQ4IiBoZWlnaHQ9IjQ4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA0OCA0OCIgd2lkdGg9IjQ4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGNsaXAtcnVsZT0iZXZlbm9kZCIgZD0iTTQzLDQxSDVjLTIuMjA5LDAtNC0xLjc5MS00LTRWMTFjMC0yLjIwOSwxLjc5MS00LDQtNGgzOGMyLjIwOSwwLDQsMS43OTEsNCw0djI2ICBDNDcsMzkuMjA5LDQ1LjIwOSw0MSw0Myw0MXogTTQ1LDExYzAtMS4xMDQtMC44OTYtMi0yLTJINWMtMS4xMDQsMC0yLDAuODk2LTIsMnYyNmMwLDEuMTA0LDAuODk2LDIsMiwyaDM4YzEuMTA0LDAsMi0wLjg5NiwyLTJWMTF6ICAgTTQxLjMzNCwzNC43MTVMMzUsMjguMzgxTDMxLjM4MSwzMmwzLjMzNCwzLjMzNGMwLjM4MSwwLjM4MSwwLjM4MSwwLjk5OSwwLDEuMzgxYy0wLjM4MiwwLjM4MS0xLDAuMzgxLTEuMzgxLDBMMTksMjIuMzgxICBMNi42NjYsMzQuNzE1Yy0wLjM4MSwwLjM4MS0wLjk5OSwwLjM4MS0xLjM4MSwwYy0wLjM4MS0wLjM4Mi0wLjM4MS0xLDAtMS4zODFMMTguMTksMjAuNDI5YzAuMDMyLTAuMDQ4LDAuMDUzLTAuMTAxLDAuMDk1LTAuMTQ0ICBjMC4xOTctMC4xOTcsMC40NTctMC4yODcsMC43MTUtMC4yODFjMC4yNTgtMC4wMDYsMC41MTgsMC4wODQsMC43MTUsMC4yODFjMC4wNDIsMC4wNDMsMC4wNjIsMC4wOTYsMC4wOTUsMC4xNDRMMzAsMzAuNjE5ICBsNC4xOS00LjE5YzAuMDMzLTAuMDQ3LDAuMDUzLTAuMTAxLDAuMDk1LTAuMTQ0YzAuMTk3LTAuMTk2LDAuNDU3LTAuMjg3LDAuNzE1LTAuMjgxYzAuMjU4LTAuMDA2LDAuNTE4LDAuMDg1LDAuNzE1LDAuMjgxICBjMC4wNDIsMC4wNDMsMC4wNjIsMC4wOTcsMC4wOTUsMC4xNDRsNi45MDUsNi45MDVjMC4zODEsMC4zODEsMC4zODEsMC45OTksMCwxLjM4MUM0Mi4zMzMsMzUuMDk2LDQxLjcxNSwzNS4wOTYsNDEuMzM0LDM0LjcxNXogICBNMjksMTljLTIuMjA5LDAtNC0xLjc5MS00LTRzMS43OTEtNCw0LTRzNCwxLjc5MSw0LDRTMzEuMjA5LDE5LDI5LDE5eiBNMjksMTNjLTEuMTA0LDAtMiwwLjg5Ni0yLDJzMC44OTYsMiwyLDJzMi0wLjg5NiwyLTIgIFMzMC4xMDQsMTMsMjksMTN6IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4="
                             style="width: 60px; height: 50px; object-fit: contain; opacity: .3">
                    @endisset
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="ml-1">
                            <div class="">{{ $page->title }}</div>
                            @if($page->slug != null)
                                <small>{{ url($page->slug) }}</small><br>
                            @endif
                            @foreach($page->languages() as $code => $name)
                                <span class="mr-2 flag-icon flag-icon-{{ $code == 'en' ? 'gb' : $code }}"
                                      title="Türkçe"></span>
                            @endforeach
                        </div>
                        <a href="{{ route('admin.pages', [ 'category_id' => $page->id ]) }}"
                           class="fa-stack index {{ $page->childs()->count() ? '' : 'empty' }}">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-level-down-alt fa-stack-1x fa-inverse"></i>
                            <span>{{ $page->childs()->count() }}</span>
                        </a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="d-none">{{ $page->is_active ? 'true' : 'false' }}</div>
                    <label class="switcher">
                        <input type="checkbox"
                               data-action="{{ route('admin.page.active', [ 'id' => $page->id ]) }}" {{ $page->is_active ? 'checked' : '' }}>
                        <div class="switcher__indicator"></div>
                    </label>
                </td>
                <td>
                    <a href="{{ route('admin.page.update', [ 'id' => $page->id ]) }}" class="update">
                        <i class="fas fa-highlighter"></i>
                    </a>
                    <a href="{{ route('admin.page.delete', [ 'id' => $page->id ]) }}" class="delete">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@pushonce('style_files:fancybox')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
@endpushonce

@pushonce('script_files:fancybox')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
@endpushonce

@push('style_files')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.min.css">
@endpush

@push('script_files')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
@endpush

@push('script_codes')
    <script>
        $(document).ready(function () {
            @if (session('status'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timeOut: 1000,
                    fadeOut: 1000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('status') }}'
                })
            @endif
            $('#list').DataTable({
                columnDefs: [{
                    targets: [1, 4],
                    orderable: false
                }],
                "language": {
                    "emptyTable": "Gösterilecek ver yok.",
                    "processing": "Veriler yükleniyor",
                    "sDecimal": ".",
                    "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                    "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Sayfada _MENU_ kayıt göster",
                    "sLoadingRecords": "Yükleniyor...",
                    "sSearch": "Ara:",
                    "sZeroRecords": "Eşleşen kayıt bulunamadı",
                    "oPaginate": {
                        "sFirst": "İlk",
                        "sLast": "Son",
                        "sNext": "Sonraki",
                        "sPrevious": "Önceki"
                    },
                    "oAria": {
                        "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                        "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                    },
                    "select": {
                        "rows": {
                            "_": "%d kayıt seçildi",
                            "0": "",
                            "1": "1 kayıt seçildi"
                        }
                    }
                }
            });
            $("#list tbody").sortable({
                animation: 150,
                handle: ".sort",
                dataIdAttr: 'data-id',
                store: {
                    set: function (sortable) {
                        $.post("{{ route('admin.page.sort', [ 'category_id' => request('category_id') ?? '' ]) }}", {
                            _token: "{{ csrf_token() }}",
                            value: sortable.toArray()
                        });
                    }
                }
            });
            $(document).on("click", ".delete", function () {
                let input = $(this);
                Swal.fire({
                    title: 'Emin misiniz',
                    text: "Veriyi silmek istediğinizden emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(input.attr("href"), {_token: "{{ csrf_token() }}"}).done(function () {
                            location.reload();
                        });
                    }
                })
                return false;
            });
            $(document).on("change", ".switcher :checkbox", function () {
                let input = $(this), checked = input.prop("checked");
                $.post(input.data("action"), {_token: "{{ csrf_token() }}", value: checked}).done(function () {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timeOut: 1000,
                        fadeOut: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Durum başarıyla değiştirildi.'
                    })
                }).fail(function (response) {
                    input.prop("checked", !checked);
                    if (response.status === 403) {
                        Swal.fire({
                            title: "Yanlış işlem!",
                            text: "Bu eylemi gerçekleştirme yetkiniz yok!",
                            type: "error"
                        });
                    }
                });
            });
        });
    </script>
@endpush
