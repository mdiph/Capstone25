@extends('layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">

                <div class="row">




                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Persediaan Barang</h4>

                                </div>
                            </div>
                            <div class="card-body">




                                <div class="table-responsive">
                                    <form method="POST" action="{{ route('changedate') }}">
                                        @csrf
                                        <div class="container">
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <div class="form-group row mx-auto">

                                                        <div class="col-sm-3">
                                                            <input type="date" onkeydown="return false" class="form-control input-sm" id="form" name="date" required>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn" name="search" >search</button>
                                                        </div>
                                                        <div class="col">
                                                            <a href="/stok" class="btn btn-success" >Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <table id="table" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>

                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Satuan</th>
                                                <th>Stok Awal</th>
                                                <th>Stok Masuk</th>
                                                <th>Stok Keluar</th>
                                                <th>Stok AKhir</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($data as $row)
                                                <tr>
                                                    {{-- <td>{{ $no++ }}</td>
                                                    <td>{{ $row->tanggal_transaksi}}</td>
                                                    <td>{{ $row->nama_produk }}</td>
                                                    <td>{{ $row->stok_keluar }}</td>
                                                    <td>{{ $row->harga }}</td>
                                                    <td>{{ $row->harga_jual }}</td>
                                                    <td>{{ $row->keuntungan }}</td>
                                                    <td>{{ $row->persentase }} %</td> --}}
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $row->nama_produk}}</td>

                                                    <td>{{ $row->satuan}}</td>
                                                    <td>{{ $row->stok_awal}}</td>
                                                    <td>{{ $row->stok_masuk}}</td>
                                                    <td>{{ $row->stok_keluar }}</td>
                                                    <td>{{ $row->stok_akhir}}</td>


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
