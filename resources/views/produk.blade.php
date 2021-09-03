@extends('layouts.app')
@section('title', 'Produk')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambahProduk"><i class="fas fa-plus"></i> Tambah Produk</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped display nowrap w-100 text-center" id="tbProduk">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Produk --}}
    <div class="modal fade" id="modalTambahProduk">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahProduk">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="addNama" placeholder="Masukkan nama produk">
                        </div>
                        <div class="form-group">
                            <label for="addKategori">Kategori</label>
                            <select name="kategori_id" id="addKategori" class="form-control select-kategori"></select>
                        </div>
                        <div class="form-group">
                            <label for="addStok">Stok</label>
                            <input type="number" name="stok" min="0" id="addStok" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="addSatuan">Satuan</label>
                            <select name="satuan_id" id="addSatuan" class="form-control select-satuan"></select>
                        </div>
                        <div class="form-group">
                            <label for="addHargaBeli">Harga Beli</label>
                            <input type="number" name="harga_beli" min="0" id="addHargaBeli" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="addHargaJual">Harga Jual</label>
                            <input type="number" name="harga_jual" min="0" id="addHargaJual" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Foto --}}
    <div class="modal fade" id="modalFotoProduk">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Foto Produk</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-sm btn-success" id="btnTambahFoto" data-toggle="modal" data-target="#modalTambahFoto"><i class="fas fa-plus"></i> Tambah</button>
                    <hr>
                    <table class="table table-striped display nowrap w-100" id="tbFoto">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Foto --}}
    <div class="modal fade" id="modalTambahFoto">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Foto</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahFoto">
                    <input type="hidden" name="produk_id" id="addFotoProdukId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addFoto">Foto</label>
                            <input type="file" name="foto" id="addFoto" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="addDeskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" id="addDeskripsi" cols="30" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Produk --}}
    <div class="modal fade" id="modalEditProduk">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Produk</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formEditProduk">
                    <input type="hidden" id="editProdukId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="editNama" placeholder="Masukkan nama produk">
                        </div>
                        <div class="form-group">
                            <label for="editKategori">Kategori</label>
                            <select name="kategori_id" id="editKategori" class="form-control select-kategori"></select>
                        </div>
                        <div class="form-group">
                            <label for="editStok">Stok</label>
                            <input type="number" name="stok" min="0" id="editStok" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editSatuan">Satuan</label>
                            <select name="satuan_id" id="editSatuan" class="form-control select-satuan"></select>
                        </div>
                        <div class="form-group">
                            <label for="editHargaBeli">Harga Beli</label>
                            <input type="number" name="harga_beli" min="0" id="editHargaBeli" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editHargaJual">Harga Jual</label>
                            <input type="number" name="harga_jual" min="0" id="editHargaJual" class="form-control">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const selectKategori = $('.select-kategori').select2({
            theme: 'bootstrap4',
            placeholder: "Pilih Kategori",
            ajax: {
                url: "{{ route('kategori.select2') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term
                    }
                }
            }
        })

        const selectSatuan = $('.select-satuan').select2({
            theme: 'bootstrap4',
            placeholder: "Pilih Satuan",
            ajax: {
                url: "{{ route('satuan.select2') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term
                    }
                }
            }
        })

        const tableProduk = $('#tbProduk').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('produk.datatable') }}"
            },
            columns: [
                {data: 'index', name: 'id'},
                {data: 'foto', name: 'id'},
                {data: 'nama', name: 'nama'},
                {data: 'kategori.nama', name: 'kategori.nama'},
                {data: 'stok', name: 'stok'},
                {data: 'satuan.kode', name: 'satuan.kode'},
                {data: 'harga_beli', name: 'harga_beli'},
                {data: 'harga_jual', name: 'harga_jual'},
                {data: 'opsi', name: 'id'}
            ]
        })

        // Tambah Produk
        const formTambahProduk = document.getElementById('formTambahProduk')
        formTambahProduk.addEventListener('submit', function (e) {
            e.preventDefault()
            const form = new FormData(this)

            $.post({
                url: "{{ route('produk.store') }}",
                data: form,
                processData: false,
                contentType: false
            }).then(function (res) {
                Swal.fire('Berhasil', 'Produk berhasil ditambahkan', 'success')
                formTambahProduk.reset()
                tableProduk.draw()
            }).catch(err => errResponse('formTambahProduk', err))
        })

        // Foto Produk
        const modalFotoProduk = $('#modalFotoProduk')
        let tableFoto = null
        tableProduk.on('click', '.btn-foto-produk', function () {
            const data = $(this).data()

            $('#addFotoProdukId').val(data.id)

            tableFoto = $('#tbFoto').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('produk_foto.datatable') }}",
                    data: {
                        produk_id: data.id
                    }
                },
                columns: [
                    {data: 'index', name: 'id', className: 'text-center'},
                    {
                        data: 'foto', name: 'file', render: function (data) {
                            return `<img src="${data}" class="img-fluid">`
                        }
                    },
                    {data: 'deskripsi', name: 'deskripsi'},
                    {data: 'opsi', name: 'id', className: 'text-center'},
                ]
            })

            modalFotoProduk.modal('show')
        })

        // Tambah foto produk
        const formTambahFoto = document.getElementById('formTambahFoto')
        const modalTambahFoto = $('#modalTambahFoto')
        formTambahFoto.addEventListener('submit', function (e) {
            e.preventDefault()
            const form = new FormData(this)

            $.post({
                url: "{{ route('produk_foto.store') }}",
                processData: false,
                contentType: false,
                data: form
            }).then(function (res) {
                formTambahFoto.reset()
                tableFoto.draw()
                modalTambahFoto.modal('hide')
            }).catch(err => errResponse('formTambahFoto', err))
        })

        // Hapus foto produk
        $(document).on('click', '.btn-hapus-foto', function () {
            const data = $(this).data()

            Swal.fire({
                title: 'Hapus Foto',
                text: "Anda yakin ingin menghapus foto produk tersebut?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(hapus => {
                if (hapus.isConfirmed) {
                    $.ajax({
                        url: "/produk-foto/" + data.id,
                        type: 'DELETE'
                    }).then(function (res) {
                        Swal.fire('Berhasil', 'Foto produk berhasil dihapus', 'success')
                        tableFoto.draw()
                    })
                }
            })
        })

        // Edit produk
        const modalEditProduk = $('#modalEditProduk')
        tableProduk.on('click', '.btn-edit-produk', function () {
            const data = $(this).data()

            modalEditProduk.modal('show')
        })


        // Hapus Produk
        tableProduk.on('click', '.btn-hapus-produk', function () {
            const data= $(this).data()

            Swal.fire({
                title: 'Hapus',
                text: 'Anda yakin ingin mengahpus Produk tersebut',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ya'
            }).then(function (hapus) {
                if (hapus.isConfirmed) {
                    $.ajax({
                        url: "{{ route('produk.index') }}/" + data.id,
                        type: "DELETE",
                        success: function (res) {
                            tableProduk.draw()
                            Swal.fire('Berhasil', 'Produk berhasil dihapus', 'success')
                        }
                    })
                }
            })
        })

    </script>
@endsection
