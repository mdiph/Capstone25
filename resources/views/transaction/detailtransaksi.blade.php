@extends('layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">DataTables.Net</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Tables</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Datatables</a>
                        </li>
                    </ul>
                </div>
                <div class="row">




                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Pembayaran Piutang</h4>
                                    <div id="datarange" class="float-end">

                                    </div>

                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                     <p>Kode Transaksi : {{ $data->kode_transaksi }}</p>
                                     <p>Bill to : {{ $data->customer->nama_customer }}</p>

                                    </div>

                                    <div class="col">
                                     <p>Salesmsan : {{ $data->salesman->nama_salesman }}</p>

                                    </div>
                                 </div>

                                <div class="row">
                                    <div class="col">
                                        <h1>Tenggat waktu {{ $data->pembayaran->tanggal_bayar}} - {{ $data->pembayaran->jatuh_tempo }} </h1>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td>{{ $data->total }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Bayar</td>
                                                    <td>{{ $data->pembayaran->bayar }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Sisa Piutang</td>
                                                    <td>{{ $data->total - $data->pembayaran->bayar }} </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col">
                                        <h1>Rincian Cicilan </h1>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tanggal Bayar</th>
                                                    <th scope="col">Angsuran</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->pembayaran->piutang as $p )
                                                <tr>
                                                    <td>{{ $p->tanggal_bayar}}</td>
                                                    <td>{{ $p->angsuran }}</td>
                                                </tr>

                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if ($data->pembayaran->status == "Lunas")
                                    <h1>LUNAS</h1>
                                @else
                                <form method="POST" action="/bayar/angsuran/{{ $data->pembayaran->id }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bayar Piutang</label>
                                        <input type="date" class="form-control " name="tanggal_bayar">
                                        <input type="hidden" name="pembayaran_id" value="{{ $data->pembayaran->id }}">

                                    </div>
                                    <div class="form-group">

                                        <input type="number" class="form-control" placeholder="Jumlah Bayar" name="angsuran">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                </form>
                                @endif



                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Harga / Item</th>
                                            <th scope="col">Diskon</th>
                                            <th scope="col">Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->detailTransaksi as $p )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->produk->nama_produk}}</td>
                                            <td>{{ $p->stok_keluar }}</td>
                                            <td>{{ $p->produk->satuan}}</td>
                                            <td>{{ $p->produk->harga }}</td>
                                            <td>{{ $p->diskon }}</td>
                                            <td>{{ $p->total }}</td>

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
