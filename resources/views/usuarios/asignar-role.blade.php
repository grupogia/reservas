<div class="modal fade" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="rolesModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesModalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('assign.role.user', [ 'user' => $user->id ]) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="">Slug</label>
                        <input class="form-control" type="text" name="slug" id="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Asignar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>