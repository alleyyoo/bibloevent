<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="passwordModalForm" action="{{ route('admin.password.update') }}">

            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Şifre Değiştirme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

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

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>

        </form>
    </div>
</div>
