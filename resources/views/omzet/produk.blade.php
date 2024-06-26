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
                                    <h4 class="card-title">Omzet Produk</h4>

                                </div>
                            </div>
                            <div class="card-body">

                                <div class="container px-4 mx-auto">

                                    <div class="bg-white rounded shadow">
                                        {!! $chart->container() !!}
                                    </div>

                                </div>
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
                                            <form method="POST" action="/salesman/store" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama_salesman"
                                                            placeholder="Nama salesman..." required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>No Telfon</label>
                                                        <input type="text" class="form-control" name="no_telp"
                                                            placeholder="no telfon..." required>

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



                                <div class="table-responsive">
                                    <form method="POST" action="{{ route('cariomzetpr') }}">
                                        @csrf
                                        <div class="container">
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <div class="form-group row mx-auto">
                                                        <label for="date" class="col-form-label col-sm-1">Tanggal Mulai</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" onkeydown="return false" class="form-control input-sm" id="form" name="fromdate" required>
                                                        </div>
                                                        <label for="date" class="col-form-label col-sm-1">Tanggal Akhir</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" onkeydown="return false" class="form-control input-sm" id="form" name="todate" required>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="submit" class="btn btn-primary" name="search" >search</button>
                                                        </div>
                                                        <div class="col">
                                                            <a href="/omzet/produk" class="btn btn-success" >Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                {{-- <th>No</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Produk</th>
                                                <th>Stok Terjual</th>
                                                <th>Harga </th>
                                                <th>Harga Jual</th>
                                                <th>Keuntungan</th>
                                                <th>Persentase</th> --}}
                                                <th>No</th>
                                                <th>Nama Produk</th>

                                                <th>Stok Keluar</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                <th>Harga Total</th>

                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($data as $row)
                                                <tr>

                                                    <td>{{ $loop->iteration }}</td>


                                                    <td>{{ $row->nama_produk }}</td>
                                                    <td>{{ $row->total_stok_keluar }}</td>

                                                    <td>{{ number_format($row->harga, 2, ',', '.') }}</td>
                                                    <td>{{ $row->satuan}}</td>

                                                    <td>{{ number_format($row->total_transaksi, 2, ',', '.') }}</td>



                                                    {{-- <td>
                                                        <a href="#EditRowModal{{ $row->id }}" data-toggle="modal"
                                                            class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                            Edit</a>
                                                        <a href="#DeleteRowModal{{ $row->id }}" data-toggle="modal"
                                                            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                                            Delete</a>
                                                    </td> --}}
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

    <script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endsection
