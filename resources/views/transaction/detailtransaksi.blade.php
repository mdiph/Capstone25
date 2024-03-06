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
                                    <h4 class="card-title font-weight-bold">Detail Transaksi #{{ $data->kode_transaksi }}</h4>
                                    <div id="datarange" class="float-end">

                                    </div>

                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <p>Tanggal Transaksi : {{ $data->pembayaran->tanggal_bayar }}</p>
                                        <p>Bill to : {{ $data->customer->nama_customer }}</p>
                                        <p>Alamat: {{ $data->customer->alamat }}</p>
                                        <p>Telfon : {{ $data->customer->no_telp }}</p>

                                    </div>

                                    <div class="col">
                                        <p>Salesmsan : {{ $data->salesman->nama_salesman }}</p>
                                        <p>Telfon : {{ $data->salesman->no_telp }}</p>
                                        @if ($data->pembayaran->status == 'Lunas')
                                        <h1 class="text-success font-weight-bold">LUNAS</h1>
                                        @elseif ($data->pembayaran->status == 'Belum Lunas')
                                            <h1 class="text-warning font-weight-bold">Belum LUNAS</h1>
                                        @elseif ($data->pembayaran->status == 'Telat')
                                        <h1 class="text-danger font-weight-bold">TELAT</h1>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">


                                    </div>

                                    {{-- <div class="col">
                                        <h1>Status Transaksi</h1>
                                        @if ($data->pembayaran->status == 'Lunas')
                                        <h1 class="text-success">LUNAS</h1>
                                        @elseif ($data->pembayaran->status == 'Belum Lunas')
                                            <h1 class="text-danger">Belum LUNAS</h1>
                                        @else
                                        @endif
                                    </div> --}}
                                </div>






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
                                        @foreach ($data->detailTransaksi as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->produk->nama_produk }}</td>
                                                <td>{{ $p->stok_keluar }}</td>
                                                <td>{{ $p->produk->satuan }}</td>
                                                <td>RP. {{ number_format($p->produk->harga, 2, ',', '.') }}</td>
                                                <td>{{ $p->diskon }} %</td>
                                                <td>RP. {{ number_format($p->total, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="5" ></td>
                                            <td  class="font-weight-bold">Subtotal</td>
                                            <td>RP. {{ number_format($data->subtotal, 2, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>


                                <div class="col-md-4 offset-md-8">
                                    <table class="table  table-hover table-bordered">
                                        <tbody>

                                            <tr>
                                                <td>Diskon</td>
                                                <td>{{ $data->diskon }} %</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>RP. {{ number_format($data->total, 2, ',', '.') }} </td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Bayar</td>
                                                <td>RP. {{ number_format($data->pembayaran->bayar, 2, ',', '.') }}</td>
                                            </tr>


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

    </div>
@endsection
