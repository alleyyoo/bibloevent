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
                    'label' => 'İsim Soyisim',
                    'model' => $page,
                    'attribute' => 'autofocus'
                ])@endcomponent
                @component('admin.components.form.textinput', [
                    'name' => 'job',
                    'label' => 'Title',
                    'model' => $page,
                    'attribute' => 'autofocus'
                ])@endcomponent
            </div>
            <div class="col-4">
                <div class="border-left pl-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="media-tab" data-toggle="tab" href="#media-tab-content"
                               role="tab" aria-controls="media-tab-content" aria-selected="true">
                                <span class="font-weight-bold font-italic">Medya</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="media-tab-content" role="tabpanel"
                             aria-labelledby="media-tab">
                            @component('admin.components.form.fileselect', [
                                'name' => 'media',
                                'model' => $page,
                            ])@endcomponent
                        </div>
                    </div>
                </div>
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
