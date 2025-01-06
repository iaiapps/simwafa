<form method="POST" action="{{ route('year.store') }}">
    <div class="modal fade" id="createyear" tabindex="1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tahun Ajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="year" class="form-label">Tahun</label>
                        <input id="year" type="text" class="form-control" name="year"
                            value="{{ old('year') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Keterangan</label>
                        <select name="description" id="description" class="form-select">
                            <option disabled>--- pilih semester ---</option>
                            <option>Semester Ganjil</option>
                            <option>Semester Genap</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>
