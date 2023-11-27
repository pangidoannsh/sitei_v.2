  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('stokbaru') }}" method="POST">
          @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="barang text-bolf">Kode Barang :</label>
                <input type="text" class="form-control" id="kodebarang" name="kode_barang">
                <label for="barang text-bolf">Nama Barang :</label>
                <input type="text" class="form-control" id="namabarang" name="nama_barang">
                <label for="barang text-bolf">Jumlah Barang :</label>
                <input type="text" class="form-control" id="jumlahbarang" name="jumlah">
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