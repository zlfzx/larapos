@extends('layouts.app')
@section('title', 'Kategori')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Kategori</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center display nowrap w-100" id="tbKategori">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>#</th>
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
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="addNama" placeholder="Masukkan nama kategori">
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
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="editNama" placeholder="Masukkan nama kategori">
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
        const table = $('#tbKategori').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('kategori.datatable') }}",
            type: "POST"
          },
          columns: [
            {data: 'index', name: 'id'},
            {data: 'nama'},
            {data: 'opsi', name: 'id'}
          ]
        })

        // Tambah Kategori
        const modalTambah = $('#modalTambah')
        const formTambah = document.getElementById('formTambah')
        formTambah.addEventListener('submit', function (e) {
          e.preventDefault()
          const form = new FormData(this)

          $.post({
            url: "{{ route('kategori.store') }}",
            data: form,
            processData: false,
            contentType: false
          }).then(function (res) {
            Swal.fire('Berhasil', 'Kategori berhasil ditambahkan', 'success')
            modalTambah.modal('hide')
            table.draw()
          }).catch(function (err) {
            Swal.fire('Gagal', err.statusText, 'error')
          })

          formTambah.reset()
        })

        // Edit Kategori
        const modalEdit = $('#modalEdit')
        table.on('click', '.btn-edit', function () {
          const data = $(this).data()
          $('#editId').val(data.id)
          $('#editNama').val(data.nama)
          modalEdit.modal('show')
        })

        $('#formEdit').on('submit', function (e) {
          e.preventDefault()
          const id = $('#editId').val()
          let form = new FormData(this)
          form.append('_method', 'PUT')

          $.ajax({
            url: "{{ route('kategori.index') }}/" + id,
            type: "POST",
            processData: false,
            contentType: false,
            data: form
          }).then(function (res) {
            Swal.fire('Berhasil', 'Kategori berhasil diperbarui', 'success')
            table.draw()
            modalEdit.modal('hide')
          }).catch(function (err) {
            Swal.fire('Gagal', err.statusText, 'error')
          })
        })

        // Hapus Kategori
        table.on('click', '.btn-hapus', function () {
          const data = $(this).data()
          Swal.fire({
            title: "Hapus Kategori",
            text: "Anda yakin ingin menghapus kategori tersebut?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
          }).then(result => {
            if (result.isConfirmed) {
              $.ajax({
                url: "{{ route('kategori.index') }}/" + data.id,
                type: "DELETE"
              }).then(function (res) {
                Swal.fire('Berhasil', 'Kategori berhasil dihapus', 'success')
                table.draw()
              }).catch(function (err) {
                Swal.fire('Gagal', err.statusText, 'error')
              })
            }
          })
        })
    </script>
@endsection
