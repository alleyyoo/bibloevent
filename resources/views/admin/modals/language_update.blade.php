<div class="modal fade" id="languageUpdateModal" tabindex="-1" role="dialog" aria-labelledby="languageUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form class="modal-content" id="languageUpdateModalForm" action="{{ route('admin.language.update', [ 'id' => $language->id ]) }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="languageUpdateModalLabel">Dil Güncelleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="p-4">

                    <div class="form-group row">
                        <label for="modal-code" class="col-md-4 col-form-label text-md-right">Kod</label>
                        <div class="col-md-6">
                            <input id="modal-code" type="text" class="form-control" name="code" value="{{ $language->code }}" required autocomplete="code" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="modal-name" class="col-md-4 col-form-label text-md-right">Adı</label>
                        <div class="col-md-6">
                            <input id="modal-name" type="text" class="form-control" name="name" value="{{ $language->name }}" required autocomplete="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            @component('admin.components.form.switchbox', [
                                'name' => 'is_active',
                                'label' => 'Aktif',
                                'model' => $language
                            ])@endcomponent
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            @component('admin.components.form.switchbox', [
                                'name' => 'is_default',
                                'label' => 'Varsayılan',
                                'model' => $language
                            ])@endcomponent
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
