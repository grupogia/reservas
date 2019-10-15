<div id="modalSuite" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva habitación</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <div class="modal-body">
                <form id="formAddSuite" action="{{ route('suites.store') }}" method="post">
                    @csrf
            
                    <div class="form-group">
                        <label for="number">Numero de habitación</label>
                        <input class="form-control @error('number') is-invalid @enderror" type="text" name="number" value="{{ old('number') }}">
            
                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="title">Tipo de Suite</label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
            
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="bed_type">Tipo de cama</label>
                        <input class="form-control @error('bed_type') is-invalid @enderror" type="text" name="bed_type" value="{{ old('bed_type') }}">
            
                        @error('bed_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="bed_number">Numero de camas</label>
                        <input class="form-control @error('bed_number') is-invalid @enderror" type="text" name="bed_number" value="{{ old('bed_number') }}">
            
                        @error('bed_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="row col-12">
                        <button class="btn btn-primary col-5 col-md-3" type="submit">Send</button>
                        <button class="btn btn-secondary col-5 col-md-3 ml-2" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>