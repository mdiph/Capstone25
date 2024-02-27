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
                                    <h4 class="card-title">Detail Hutang </h4>

                                </div>
                            </div>
                            <div class="card-body">




                                <div class="table-responsive">
                                    <table id="table" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>

                                                <th>No</th>
                                                <th>Nama Salesman</th>
                                                <th>Alamat</th>

                                                <th>Total Hutang</th>
                                                <th>Action</th>


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
                                                    <td>{{ $row->nama_customer}}</td>
                                                    <td>{{ $row->alamat }}</td>
                                                    <td>RP. {{ number_format($row->sisa_utang , 2, ',', '.') }}</td>
                                                    <td>
                                                        <a href="/transaksi/detail/piutang/{{ $row->transaksi_id }}" class="btn btn-xs btn-warning">
                                                            <i class="fa fa-money"></i> Pelunasan
                                                        </a>
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
