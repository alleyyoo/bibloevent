@extends('admin.layouts.content')

@section('admin.layouts.content.section')
    <form method="post" action="{{ route('admin.page.update', [ 'id' => request('id') ]) }}">
        @csrf
        <input type="hidden" name="category_id" value="{{ $page->category_id }}">
        <input type="hidden" name="is_visible" value="on">
        <div class="d-flex justify-content-between align-items-center shadow mb-5 p-2">
            <div class="breadcrumb bg-transparent m-0">
                @foreach($category->breadcrumbs() as $link => $title)
                    <a href="{{ $link }}" class="breadcrumb-item">{{ $title }}</a>
                @endforeach
            </div>
            <div class="d-flex align-items-center">
                <div class="border-right mr-3 pr-3">
                    @component('admin.components.form.switchbox', [
                        'name' => 'is_active',
                        'label' => 'Aktif',
                        'model' => $page
                    ])@endcomponent
                </div>
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @component('admin.components.form.textinput', [
                    'name' => 'title',
                    'label' => 'Başlık',
                    'model' => $page,
                    'attribute' => 'autofocus'
                ])@endcomponent

            </div>
        </div>
    </form>
@endsection

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
                    icon: 'error',
                    title: '{{ session('status') }}'
                })
            @endif
        })
    </script>
@endpush
