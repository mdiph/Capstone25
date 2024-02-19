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
                                    <h4 class="card-title">Transaksi</h4>
                                    <a class="btn btn-warning btn-round ml-auto text-light" href="">
                                        <i class="fa fa-money-bill"></i>
                                        Telat Bayar
                                    </a>
                                    <a class="btn btn-primary btn-round ml-2 text-light" href="/tes">

                                        <i class="fa fa-plus"></i>
                                        Add Row
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal tambah -->
                                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        New</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="/kategori/store" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama_kategori"
                                                            placeholder="Nama kategori..." required>

                                                    </div>



                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="submit" id="addRowButton" class="btn btn-primary"><i
                                                            class="fa fa-save"></i> Tambah</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                            class="fa fa-undo"></i> Close</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- @foreach ($data as $d)
                                    <!-- Modal edit -->
                                    <div class="modal fade" id="EditRowModal{{ $d->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Edit</span>
                                                        <span class="fw-light">
                                                            Row
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="/kategori/update/{{ $d->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama_kategori"
                                                                value="{{ $d->nama_kategori }}"
                                                                placeholder="Nama kategori..." required>

                                                        </div>



                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" id="addRowButton"
                                                            class="btn btn-primary"><i class="fa fa-save"></i>
                                                            Tambah</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}

                                @foreach ($data as $d)
                                    <!-- Modal delete -->
                                    <div class="modal fade" id="DeleteRowModal{{ $d->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">
                                                            Edit</span>
                                                        <span class="fw-light">
                                                            Row
                                                        </span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="transaksi/delete/{{ $d->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <h4>Apakah Anda Ingin Menghapus data? </h4>
                                                    </div>



                                 <div class="modal-footer ">
                                                        <button type="submit" id="addRowButton"
                                                            class="btn btn-primary"><i class="fa fa-save"></i>
                                                            Hapus</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                                <!-- Modal edit -->
                                {{-- <div class="modal fade" id="ShowRowModal" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        Show</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                                <div class="modal-body">
                                                    <ul>
                                                        @foreach ($show as $item)
                                                            <li>{{ $item->detail->produk->nama_produk }} {{ $item->stok_keluar }}  {{ $item->harga_jual }} </li>
                                                        @endforeach
                                                        </ul>



                                                </div>
                                                <div class="modal-footer ">

                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>


                                        </div>
                                    </div>
                                </div> --}}




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

                                            @foreach($data as $transaksi)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $transaksi->kode_transaksi }}</td>
                                                <td>{{ $transaksi->tanggal_transaksi }}</td>
                                                <td>{{ $transaksi->subtotal }}</td>
                                                <td>{{ $transaksi->diskon }} %</td>
                                                <td>{{ $transaksi->total }}</td>
                                                <td>{{ $transaksi->salesman->nama_salesman }}</td>
                                                <td>{{ $transaksi->customer->nama_customer }}</td>

                                                <td>{{ $transaksi->pembayaran->status}}</td>
                                                <td>
                                                    <a href="#EditRowModal{{ $transaksi->id }}" data-toggle="modal"
                                                        class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                        Edit</a>
                                                    <a href="#DeleteRowModal{{ $transaksi->id }}" data-toggle="modal"
                                                        class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                                        Delete</a>
                                                    @if($transaksi->pembayaran->status == 'Belum Lunas')
                                                        <a href="/transaksi/detail/piutang/{{ $transaksi->id }}" class="btn btn-xs btn-warning">
                                                            <i class="fa fa-money"></i> Pelunasan
                                                        </a>
                                                    @endif
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
