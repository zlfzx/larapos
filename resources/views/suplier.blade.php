@extends('layouts.app')
@section('title', 'Suplier')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Suplier</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped display nowrap text-center w-100" id="tbSuplier">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kecamatam</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Suplier</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="addNama" placeholder="Masukkan nama suplier">
                        </div>
                        <div class="form-group">
                            <label for="addTelepon">Telepon</label>
                            <input type="number" name="telepon" id="addTelepon" class="form-control" placeholder="Masukkan no. telp">
                        </div>
                        <div class="form-group">
                            <label for="addProvinsi">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" id="addProvinsi" placeholder="Masukkan Provinsi">
                        </div>
                        <div class="form-group">
                            <label for="addKota">Kota</label>
                            <input type="text" name="kota" class="form-control" id="addKota" placeholder="Masukkan kota">
                        </div>
                        <div class="form-group">
                            <label for="addKecamatan">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" id="addKecamatan" placeholder="Masukkan Kecamatan">
                        </div>
                        <div class="form-group">
                            <label for="addkelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" id="addKelurahan" placeholder="Masukkan kelurahan">
                        </div>
                        <div class="form-group">
                            <label for="addAlamat">Alamat</label>
                            <textarea name="alamat" id="addAlamat" cols="10" rows="3" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Suplier</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="editNama" placeholder="Masukkan nama suplier">
                        </div>
                        <div class="form-group">
                            <label for="editTelepon">Telepon</label>
                            <input type="number" name="telepon" id="editTelepon" class="form-control" placeholder="Masukkan no. telp">
                        </div>
                        <div class="form-group">
                            <label for="editProvinsi">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" id="editProvinsi" placeholder="Masukkan Provinsi">
                        </div>
                        <div class="form-group">
                            <label for="editKota">Kota</label>
                            <input type="text" name="kota" class="form-control" id="editKota" placeholder="Masukkan kota">
                        </div>
                        <div class="form-group">
                            <label for="editKecamatan">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" id="editKecamatan" placeholder="Masukkan Kecamatan">
                        </div>
                        <div class="form-group">
                            <label for="editKelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" id="editKelurahan" placeholder="Masukkan kelurahan">
                        </div>
                        <div class="form-group">
                            <label for="editAlamat">Alamat</label>
                            <textarea name="alamat" id="editAlamat" cols="10" rows="3" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const table = $('#tbSuplier').DataTable({
          processing: true,
          serverSide: true,
          scrollX: true,
          ajax: {
            url: "{{ route('suplier.datatable') }}",
            type: "POST"
          },
          columns: [
            {data: 'index', name: 'id'},
            {data: 'nama'},
            {data: 'telepon'},
            {data: 'provinsi'},
            {data: 'kota'},
            {data: 'kecamatan'},
            {data: 'alamat'},
            {data: 'opsi'}
          ]
        })

        // Tambah Suplier
        const modalTambah = $('#modalTambah')
        const formTambah = document.getElementById('formTambah')
        formTambah.addEventListener('submit', function (e) {
          e.preventDefault()
          const form = new FormData(this)

          $.post({
            url: "{{ route('suplier.store') }}",
            data: form,
            processData: false,
            contentType: false,
            beforeSend: function () {
              $('.text-error').remove()
            }
          }).then(function (res) {
            Swal.fire('Berhasil', 'Suplier berhasil ditambahkan', 'Success')
            table.draw()
            formTambah.reset()
            modalTambah.modal('hide')
          }).catch(function (err) {
            const res = err.responseJSON
            const errors = res.errors

            for (let name of Object.keys(errors)) {
              const items = errors[name]
              items.map(function (error) {
                const html = `<small class="text-danger text-error">${error}</small><br class="text-error">`
                $('#formTambah .form-control[name="'+name+'"]').after(html)
              })
            }
          })
        })

        // Edit Suplier
        const modalEdit = $('#modalEdit')
        const formEdit = document.getElementById('formEdit')
        table.on('click', '.btn-edit', function () {
          const data = $(this).data()
          const suplier = data.item

          setValue('editId', suplier.id)
          setValue('editNama', suplier.nama)
          setValue('editTelepon', suplier.telepon)
          setValue('editProvinsi', suplier.provinsi)
          setValue('editKota', suplier.kota)
          setValue('editKecamatan', suplier.kecamatan)
          setValue('editKelurahan', suplier.kelurahan)
          setValue('editAlamat', suplier.alamat)

          modalEdit.modal('show')
        })
        formEdit.addEventListener('submit', function (e) {
          e.preventDefault()
          const form = new FormData(this)
          const id = document.getElementById('editId').value

          form.append('_method', 'PUT')
          $.post({
            url: "{{ route('suplier.index') }}/" + id,
            data: form,
            processData: false,
            contentType: false
          }).then(function (res) {
            table.draw()
            Swal.fire('Berhasil', 'Suplier berhasil diperbarui', 'success')
          }).catch(function (err) {
            Swal.fire('Gagal', err.statusText, 'error')
          })
        })

        // Hapus Suplier
        table.on('click', '.btn-hapus', function () {
          const data = $(this).data()
          Swal.fire({
            title: 'Hapus Suplier',
            text: 'Anda yakin ingin menghapus Suplier tersebut?',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
          }).then(hapus => {
            if (hapus.isConfirmed) {
              $.ajax({
                url: "{{ route('suplier.index') }}/" + data.id,
                type: "DELETE"
              }).then(function (res) {
                table.draw()
                Swal.fire('Berhasil', 'Suplier berhasil dihapus', 'success')
              }).catch(function (err) {
                Swal.fire('Gagal', err.statusText, 'error')
              })
            }
          })
        })
    </script>
@endsection
