@extends('admin.layouts.content')

@section('admin.layouts.content.section')
    <div class="d-flex justify-content-between align-items-center shadow mb-5 p-2">
        <div class="breadcrumb bg-transparent m-0">
            <a href="{{ route('admin.fragments') }}" class="breadcrumb-item">Dil Sabitleri</a>
        </div>
        <a href="{{ route('admin.fragment.create') }}" class="fragmentCreateModalButton btn btn-success">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <table id="list" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="30"></th>
            <th>Key</th>
            @foreach($languages as $language)
                <th>{{$language}}</th>
            @endforeach
            <th width="70">İşlem</th>
        </tr>
        </thead>
        <tbody>

        @foreach($fragments as $key => $language)
            <?php

            $item = $language->getTranslationsArray();

            ?>
            <tr>
                <td class="text-center">
                    <div class="fa-stack index empty">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-bars fa-stack-1x fa-inverse"></i>
                        <span>{{ $key + 1 }}</span>
                    </div>
                </td>
                <form action="{{route('admin.fragment.update')}}" method="POST">

                    @csrf

                    <td><input type="text" class="form-control" name="key" required autocomplete="code" autofocus
                               value="{{ $language->key }}"></td>

                    @foreach($languages as $key => $x)
                        <td>
                            <input type="text" class="form-control" name="{{$key}}" required autocomplete="code"
                                   autofocus value="{{ $item[$key]['value'] ?? '' }}">
                        </td>
                    @endforeach



                    <td>
                        <input type="text" hidden class="form-control" name="id" required autocomplete="code" autofocus
                               value="{{$language->id}}">
                        <input type="submit" class="form-control" name="update" required autocomplete="code" autofocus
                               value="güncelle">


                        {{--<a href="{{ route('admin.fragments.update', [ 'id' => $key ]) }}" class="languageUpdateModalButton update">
                            <i class="fas fa-highlighter"></i>
                        </a>--}}
                        {{--<a href="{{ route('admin.fragments.delete', [ 'id' => $key ]) }}" class="delete">
                            <i class="fas fa-trash"></i>
                        </a>--}}
                    </td>
                </form>
                <form action="{{route('admin.fragment.delete')}}" method="POST">
                    @csrf
                    <input type="text" hidden class="form-control" name="id" required autocomplete="code" autofocus
                           value="{{$language->id}}">
                    <td>
                    <input type="submit" class="form-control" name="delete" required autocomplete="code" autofocus
                           value="delete">
                    </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('style_files')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@push('script_files')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('script_codes')
    <script>
        $(document).ready(function () {
            $('#list').DataTable({
                columnDefs: [{
                    targets: [3],
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
            $(".delete").click(function () {
                let input = $(this);
                Swal.fire({
                    title: "Emin misiniz?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Evet, sil!",
                    cancelButtonText: "Hayır, devam et"
                }).then((result) => {
                    if (result.value) {
                        $.post(input.attr("href"), {_token: "{{ csrf_token() }}"}).done(function () {
                            location.reload();
                        });
                    }
                })
                return false;
            });
            $(".switcher :checkbox").change(function () {
                let input = $(this), checked = input.prop("checked");
                $.post(input.data("action"), {_token: "{{ csrf_token() }}", value: checked})
                    .done(function () {
                        if (input.data("type") === "default") {
                            location.reload();
                        }
                    })
                    .fail(function (response) {
                        input.prop("checked", !checked);
                        if (response.status === 403) {
                            Swal.fire({
                                title: "Hatalı işlem!",
                                text: response.responseJSON.message || "Bu işlemi yapmaya yetkiniz yok",
                                type: "error"
                            });
                        }
                    });
            });
        });
    </script>
@endpush
