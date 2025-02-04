@extends('admin.layouts.content')

@section('admin.layouts.content.section')
    <div class="d-flex justify-content-between align-items-center shadow mb-5 p-2">
        <div class="breadcrumb bg-transparent m-0">
            <a href="{{ route('admin.users') }}" class="breadcrumb-item">{{ __('Users') }}</a>
        </div>
        <a href="{{ route('admin.user.create') }}" class="userCreateModalButton btn btn-success">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <table id="list" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="30"></th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Is Active') }}</th>
            <th width="70">Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
            <tr>
                <td class="text-center">
                    <div class="fa-stack index empty">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-bars fa-stack-1x fa-inverse"></i>
                        <span>{{ $key + 1 }}</span>
                    </div>
                </td>
                <td>{{ $user->name }}</td>
                <td>
                    <div class="d-none">{{ $user->is_active ? 'true' : 'false' }}</div>
                    <label class="switcher">
                        <input type="checkbox" data-action="{{ route('admin.user.active', [ 'id' => $user->id ]) }}" {{ $user->is_active ? 'checked' : '' }}>
                        <div class="switcher__indicator"></div>
                    </label>
                </td>
                <td>
                    <a href="{{ route('admin.user.update', [ 'id' => $user->id ]) }}" class="userUpdateModalButton update">
                        <i class="fas fa-highlighter"></i>
                    </a>
                    <a href="{{ route('admin.user.delete', [ 'id' => $user->id ]) }}" class="delete">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
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
                columnDefs:  [{
                    targets: [ 3 ],
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
                    title: "Are you sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.value) {
                        $.post(input.attr("href"), { _token: "{{ csrf_token() }}" }).done(function () {
                            location.reload();
                        });
                    }
                })
                return false;
            });
            $(".switcher :checkbox").change(function () {
                let input = $(this), checked = input.prop("checked");
                $.post(input.data("action"), { _token: "{{ csrf_token() }}", value: checked })
                    .fail(function (response) {
                        input.prop("checked", !checked);
                        if (response.status === 403) {
                            Swal.fire({
                                title : "Incorrect operation!",
                                text: "You are not authorized to perform this action!",
                                type: "error"
                            });
                        }
                    });
            });
        });
    </script>
@endpush
