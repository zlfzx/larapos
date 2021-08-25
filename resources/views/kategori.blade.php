@extends('layouts.app')
@section('title', 'Kategori')

@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah">Tambah Kategori</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
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

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNama">Nama</label>
                            <input type="text" class="form-control" id="addNama" placeholder="Masukkan nama kategori">
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
    <script>

    </script>
@endsection
