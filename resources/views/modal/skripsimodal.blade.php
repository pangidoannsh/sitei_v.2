<!-- Modal -->
@foreach($skripsis as $skripsi)
<div class="modal fade" id="exampleModal-{{ $skripsi->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Komentar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/dosen/addingskripsi/{{ $skripsi->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="barang text-bolf">Komentar  :</label>
            <textarea type="text" class="form-control form-control-lg" name="komentar"> </textarea>
            <label for="barang text-bolf">Skala     :</label>
            <select class="custom-select" name="keterangan">
              <option value="Sangat Baik">Sangat Baik</option>
              <option value="Baik">Baik</option>
              <option value="Diterima">Diterima</option>
              <option value="Cukup Diterima">Cukup Diterima</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button class="btn btn-success" type="submit">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach