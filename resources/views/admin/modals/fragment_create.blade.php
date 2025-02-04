<div class="modal fade" id="fragmentCreateModal" tabindex="-1" role="dialog" aria-labelledby="fragmentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form class="modal-content" id="fragmentCreateModalForm"  action="{{ route('admin.fragment.create') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="fragmentCreateModalLabel">Yeni Kayıt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="p-4">

                    <div class="form-group row">
                        <label for="modal-code" class="col-md-4 col-form-label text-md-right">Key</label>
                        <div class="col-md-6">
                            <input id="modal-key" type="text" class="form-control" name="key" required autocomplete="title" autofocus value="">
                        </div>
                    </div>

                    @foreach($languages as $key => $x)

                    <div class="form-group row">
                        <label for="modal-{{$key}}" class="col-md-4 col-form-label text-md-right">{{$x}}</label>
                        <div class="col-md-6">
                            <input id="modal-{{$key}}" type="text" class="form-control" name="{{$key}}" required autocomplete="name" value="">
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>

            <div class="modal-footer">
                {{--<input id="" type="submit" class="form-control" name="">--}}
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>

        </form>
    </div>
</div>
