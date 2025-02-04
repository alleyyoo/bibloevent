<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <form class="modal-content" id="settingsModalForm" action="{{ route('admin.setting.update') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Ayarlar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="p-4">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="modal-title">Site Başlığı</label>
                                <input type="text" name="title" id="modal-title" class="form-control" value="{{ config('setting.title') }}">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="modal-title">Description</label>
                                        <textarea name="description" id="modal-description" class="form-control" style="height: 287px">{{ config('setting.description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="modal-title">Keywords</label>
                                        <textarea name="keywords" id="modal-keywords" class="form-control" style="height: 287px">{{ config('setting.keywords') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="modal-address">Adres</label>
                                <input type="text" name="address" id="modal-address" class="form-control" value="{{ config('setting.address') }}">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="modal-email">E-Posta Adresi</label>
                                        <input type="text" name="email" id="modal-email" class="form-control" value="{{ config('setting.email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="modal-phone">Telefon</label>
                                        <input type="text" name="phone" id="modal-phone" class="form-control" value="{{ config('setting.phone') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="modal-fax">Faks</label>
                                        <input type="text" name="fax" id="modal-fax" class="form-control" value="{{ config('setting.fax') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="modal-email">İletişim E-Posta Adresi</label>
                                        <input type="text" name="contactEmail" id="modal-contactEmail" class="form-control" value="{{ config('setting.contactEmail') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="modal-facebook">Facebook</label>
                                <input id="modal-facebook" class="form-control mb-3" type="text" name="facebook" value="{{ config('setting.facebook') }}">
                            </div>
                            <div class="form-group">
                                <label for="modal-twitter">Twitter</label>
                                <input id="modal-twitter" class="form-control mb-3" type="text" name="twitter" value="{{ config('setting.twitter') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="modal-instagram">Instagram</label>
                                <input id="modal-instagram" class="form-control mb-3" type="text" name="instagram" value="{{ config('setting.instagram') }}">
                            </div>
                            <div class="form-group">
                                <label for="modal-youtube">Youtube</label>
                                <input id="modal-youtube" class="form-control mb-3" type="text" name="youtube" value="{{ config('setting.youtube') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="modal-linkedin">Linkedin</label>
                                <input id="modal-linkedin" class="form-control mb-3" type="text" name="linkedin" value="{{ config('setting.linkedin') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="modal-map">Google Map</label>
                                <input id="modal-map" class="form-control mb-3" type="text" name="map" value="{{ config('setting.map') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="modal-maintance">Bakım Modu</label>
                                <input id="modal-maintance" class="form-control mb-3" type="text" name="maintance" value="{{ config('setting.maintance') }}">
                            </div>
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
