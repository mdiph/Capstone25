@extends('layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">

                <div class="row">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif




                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Barang Masuk Trash</h4>

                                    <a class="btn btn-primary btn-round ml-auto"
                                        href="/barangmasuk">
                                        <i class="fa fa-back"></i>
                                        Kembali
                                </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal tambah -->






                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No </th>
                                                <th>ID</th>
                                                <th>tanggal_masuk</th>
                                                <th>jumlah_masuk</th>
                                                <th>produk</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $row->id_masuk }}</td>
                                                    <td>{{ $row->tanggal_masuk }}</td>
                                                    <td>{{ $row->jumlah_masuk }}</td>
                                                    <td>{{ $row->produk->nama_produk }}</td>
                                                    <td>
                                                        <form method="POST" action="/barangmasuk/kembali/{{ $row->id }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-xs btn-success">
                                                                <i class="fa fa-back"></i> Kembalikan
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
