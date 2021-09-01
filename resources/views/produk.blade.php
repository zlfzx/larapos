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
                    <table class="table table-striped display nowrap text-center" id="tbProduk">
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
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Foto --}}
    <div class="modal fade" id="modalFotoProduk">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Foto Produk</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="tbFoto">
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

            tableFoto = $('#tbFoto').DataTable({
                destroy: true
            })

            modalFotoProduk.modal('show')
        })

        // Edit produk
        const modalEditProduk = $('#modalEditProduk')
        tableProduk.on('click', '.btn-edit-produk', function () {
            const data = $(this).data()
        })


        // Hapus Produk
        tableProduk.on('click', '.btn-hapus-produk', function () {
            const data= $(this).data()
        })

    </script>
@endsection
