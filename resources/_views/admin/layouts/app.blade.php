<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i,900,900i&display=swap&subset=latin-ext">
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <title>{{ config('title') }} | we.pannel</title>
    @auth
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    @endauth
    @guest
        <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">
    @endguest
    @stack('style_files')
    @stack('style_codes')
</head>
<body>
@yield('admin.layouts.app.section')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@auth
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endauth
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src="{{ asset('admin/js/modal.js') }}"></script>
@stack('script_files')
@auth
    @php $hashcode = hash('sha512', 'webolizma.' . date('d.m.y')) @endphp

    <div id="media-dialog" class="d-none">
        <div class="row mt-3">
            <div class="col media-box">
                <div class="media-preview mb-3" style="height: 200px;">
                    <input type="hidden" id="dialog-desktop-path">
                    <input type="hidden" id="dialog-desktop-image">
                    <img class="rounded">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100 position-absolute" style="top: 0; right: 0;">
                        <a href="javascript:;" id="dialog-desktop-file" class="fa-stack text-success" data-fancybox data-type="iframe" data-src="/assets/admin/filemanager/dialog.php?field_id=dialog-desktop-file&akey={{ $hashcode }}">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-cloud-upload-alt fa-stack-1x fa-inverse"></i>
                        </a>
                        <a href="javascript:;" class="media-link fa-stack text-primary">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-link fa-stack-1x fa-inverse"></i>
                        </a>
                        <a href="javascript:;" class="fa-stack delete">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" id="dialog-desktop-title" class="form-control" placeholder="Desktop Image Title">
                </div>
                <div class="form-group">
                    <input type="text" id="dialog-desktop-alt" class="form-control" placeholder="Desktop Image Alt">
                </div>
            </div>
            <div class="col media-box">
                <div class="media-preview mb-3" style="height: 200px">
                    <input type="hidden" id="dialog-mobile-path">
                    <input type="hidden" id="dialog-mobile-image">
                    <img class="rounded">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100 position-absolute" style="top: 0; right: 0;">
                        <a href="javascript:;" id="dialog-mobile-file" class="fa-stack text-success" data-fancybox data-type="iframe" data-src="/assets/admin/filemanager/dialog.php?field_id=dialog-mobile-file&akey={{ $hashcode }}">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-cloud-upload-alt fa-stack-1x fa-inverse"></i>
                        </a>
                        <a href="javascript:;" class="media-link fa-stack text-primary">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-link fa-stack-1x fa-inverse"></i>
                        </a>
                        <a href="javascript:;" class="fa-stack delete">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" id="dialog-mobile-title" class="form-control" placeholder="Mobile Image Title">
                </div>
                <div class="form-group">
                    <input type="text" id="dialog-mobile-alt" class="form-control" placeholder="Mobile Image Alt">
                </div>
            </div>
        </div>
    </div>
    <div id="gallery-item" class="d-none">
        <div class="media-preview chosen">
            <div class="desktop">
                <input type="hidden">
                <input type="hidden">
                <input type="hidden">
                <input type="hidden">
                <input type="hidden">
                <img class="rounded">
            </div>
            <div class="mobile">
                <input type="hidden">
                <input type="hidden">
                <input type="hidden">
                <input type="hidden">
                <input type="hidden">
            </div>
            <div class="d-flex align-items-center justify-content-center w-100 h-100 position-absolute" style="top: 0;">
                <a href="javascript:;" class="fa-stack update">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-highlighter fa-stack-1x fa-inverse"></i>
                </a>
                <a href="javascript:;" class="fa-stack sort">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-sort fa-stack-1x fa-inverse"></i>
                </a>
                <a href="javascript:;" class="fa-stack delete">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                </a>
            </div>
        </div>
    </div>
    <script>
        let csrf_token = "{{ csrf_token() }}";
        let url_image = "{{ route('admin.url.image') }}";
        let none_image = "{{ asset('admin/img/none.png') }}";
        let load_image = "{{ asset('admin/img/load.gif') }}";
        let media_dialog_html = $("#media-dialog").html();
        let gallery_item_html = $("#gallery-item").html();
        $("#media-dialog").remove();
        $("#gallery-item").remove();
    </script>
@endauth
@stack('script_codes')
</body>
</html>
