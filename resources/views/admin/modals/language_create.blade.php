<div class="modal fade" id="languageCreateModal" tabindex="-1" role="dialog" aria-labelledby="languageCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form class="modal-content" id="languageCreateModalForm" action="{{ route('admin.language.create') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="languageCreateModalLabel">Yeni Dil Ekleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="p-4">

                    <div class="form-group row">
                        <label for="modal-code" class="col-md-4 col-form-label text-md-right">Kod</label>
                        <div class="col-md-6">
                            <input id="modal-code" type="text" class="form-control" name="code" required autocomplete="code" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="modal-name" class="col-md-4 col-form-label text-md-right">Adı</label>
                        <div class="col-md-6">
                            <input id="modal-name" type="text" class="form-control" name="name" required autocomplete="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            @component('admin.components.form.switchbox', [
                                'name' => 'is_active',
                                'label' => 'Aktif',
                                'attribute' => 'checked'
                            ])@endcomponent
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            @component('admin.components.form.switchbox', [
                                'name' => 'is_default',
                                'label' => 'Varsayılan'
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
