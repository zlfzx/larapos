@extends('layouts.app')
@section('title', 'Produk')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
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
                            <th>Markup</th>
                            <th>Harga Jual</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
                            <select name="kategori_id" id="addKategori" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="addStok">Stok</label>
                            <input type="number" name="stok" id="addStok" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="addSatuan">Satuan</label>
                            <select name="satuan_id" id="addSatuan" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="addHargaBeli">Harga Beli</label>
                            <input type="number" name="harga_beli" id="addHargaBeli" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="addMarkup">Markup</label>
                            <input type="number" name="markup" class="form-control" id="addMarkup">
                        </div>
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="addMarkupPersen">
                            <label class="custom-control-label" for="addMarkupPersen">Persentase Markup</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Simpan</button>
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
        const tableProduk = $('#tbProduk').DataTable()
    </script>
@endsection
