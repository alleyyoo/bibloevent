<div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-labelledby="userCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <form class="modal-content" id="userCreateModalForm" action="{{ route('admin.user.create') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="userCreateModalLabel">Yeni Kullanıcı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="p-4">

                    <div class="form-group row">
                        <label for="modal-name" class="col-md-4 col-form-label text-md-right">Adınız ve Soyadınız</label>
                        <div class="col-md-6">
                            <input id="modal-name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="modal-email" class="col-md-4 col-form-label text-md-right">E-Posta Adresiniz</label>
                        <div class="col-md-6">
                            <input id="modal-email" type="email" class="form-control" name="email" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="modal-password" class="col-md-4 col-form-label text-md-right">Şifre</label>
                        <div class="col-md-6">
                            <input id="modal-password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="modal-password-confirm" class="col-md-4 col-form-label text-md-right">Şifre Onayı</label>
                        <div class="col-md-6">
                            <input id="modal-password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>

        </form>
    </div>
</div>
