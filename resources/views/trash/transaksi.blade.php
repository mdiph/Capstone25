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

                            @foreach ($data as $d)
                                <!-- Modal delete -->
                                <div class="modal fade" id="ReturnRowModal{{ $d->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        Return</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="/transaksi/kembali/{{ $d->id }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <h4>Apakah Anda Ingin Mengembalikan Data <strong>{{ $d->kode_transaksi }}</strong>? </h4>
                                                </div>



                                                <div class="modal-footer ">
                                                    <button type="submit" id="addRowButton" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>
                                                        Kembalikan</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                            class="fa fa-undo"></i> Close</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($data as $d)
                                <!-- Modal delete -->
                                <div class="modal fade" id="DeleteRowModal{{ $d->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        Delete</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="/transaksi/forcedelete/{{ $d->id }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <h4>Apakah Anda Ingin Menghapus Data <strong>{{ $d->kode_transaksi}}</strong>? </h4>
                                                </div>



                                                <div class="modal-footer ">
                                                    <button type="submit" id="addRowButton" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>
                                                        Hapus</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                            class="fa fa-undo"></i> Close</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                                @if ($row->salesman)
                                                <td>{{ $row->salesman->nama_salesman }}</td>
                                                @else
                                                <td>Data salesman telah terhapus atau tidak ditemukan</td>
                                                @endif
                                                @if ($row->customer)
                                                <td>{{ $row->customer->nama_customer }}</td>
                                                @else
                                                <td>Data customer telah terhapus atau tidak ditemukan</td>
                                                @endif


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

                                                        <a href="#ReturnRowModal{{ $row->id }}" data-toggle="modal"
                                                            class="btn btn-xs btn-success"><i class="fa fa-undo"></i>
                                                            Kembalikan</a>


                                                        <a href="#DeleteRowModal{{ $row->id }}" data-toggle="modal"
                                                            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                                            Hapus Permanen</a>


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
