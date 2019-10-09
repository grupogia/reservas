<div class="modal fade" id="assignRateModal" tabindex="-1" role="dialog" aria-labelledby="assignRateModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRateModalTitle">Asignar Tarifa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('assign.rate', [ 'suite' => $suite->id ]) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="type">Tipo de tarifa</label>
                        <input class="form-control" type="text" name="type" id="">
                    </div>

                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input class="form-control" type="text" name="price" id="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Asignar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>