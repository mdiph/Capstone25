@extends('layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">



                </div>
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
                                    <h4 class="card-title">Transaksi Trash</h4>
                                    <a class="btn btn-primary btn-round ml-auto"
                                        href="/transaksi">
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
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Subtotal</th>
                                                <th>Diskon</th>
                                                <th>Harga Total</th>
                                                <th>Salesman</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->kode_transaksi }}</td>
                                                <td>{{ $row->tanggal_transaksi }}</td>
                                                <td>RP. {{ number_format($row->subtotal, 2, ',', '.') }}</td>
                                                <td>{{ $row->diskon }} %</td>
                                                <td>RP. {{ number_format($row->total, 2, ',', '.') }}</td>
                                                <td>{{ $row->salesman->nama_salesman }}</td>
                                                <td>{{ $row->customer->nama_customer }}</td>

                                                @if ($row->pembayaran->status == 'Lunas')
                                                    <td class="text-success font-weight-bold">
                                                        {{ $row->pembayaran->status }}</td>
                                                @elseif ($row->pembayaran->status == 'Belum Lunas')
                                                    <td class="text-warning font-weight-bold">
                                                        {{ $row->pembayaran->status }}</td>
                                                @elseif ($row->pembayaran->status == 'Telat')
                                                    <td class="text-danger font-weight-bold">
                                                        {{ $row->pembayaran->status }}</td>
                                                @endif

                                                <td>
                                                    <a href="/transaksi/detail/{{ $row->id }}"
                                                        class="btn btn-xs btn-secondary"><i class="fa fa-info"></i>
                                                        Detail</a>
                                                    <form method="POST" action="/transaksi/kembali/{{ $row->id }}">
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
