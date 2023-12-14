@extends('layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Forms</h4>
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
                            <a href="#">Forms</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Basic Form</a>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <div class="">
                        <form method="POST" action="/barangmasuk/store">

                            @csrf


                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Input Group</div>
                                </div>

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Produk</label>
                                            <input type="email" class="form-control" id="inputEmail4"
                                                placeholder="Cari Produk" data-toggle="modal" data-target="#modalload">

                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Tanggal transaksi</label>
                                            <input type="date" class="form-control" id="inputPassword4"
                                                placeholder="Pilih tanggal">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Salesman</label>
                                            <input type="text" class="form-control" id="inputEmail4"
                                                placeholder="Pilih Salesman">
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Customer</label>
                                            <input type="text" class="form-control" id="inputPassword4"
                                                placeholder="Pilih Customer">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Bayar</label>
                                            <input type="text" class="form-control" id="inputPassword4"
                                                placeholder="Nilai Bayar">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Total</label>
                                            <input type="text" class="form-control" id="inputPassword4" disabled
                                                placeholder="Total bayar">
                                        </div>

                                    </div>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php $no = 1 @endphp
                                            @foreach ($tes as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->produk->nama_produk }}
                                                <td>{{ $row->qty }}</td>
                                                <td>{{ $row->qty * $row->harga }}</td>
                                                <td>
                                                    <button class="btn btn-xs btn-danger" type="submit">
                                                        <i class="fa fa-trash"> Hapus </i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="card-action">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </div>

                    </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    </div>

    {{-- @foreach ($data as $d) --}}
    <!-- Modal edit -->
    <div class="modal fade" id="modalload" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Load</span>
                        <span class="fw-light">
                            Data
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped" id="add-row" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Nama </th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Qty</th>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            @php $no = 1 @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <form action="/addcart/{{ $row->id }}" method="POST">
                                        @csrf
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <input type="hidden" id="id" name="produk_id" value="{{ $row->id }}">

                                        <td>{{ $row->harga }}</td>
                                        <input type="hidden" id="harga" name="harga" value="{{ $row->harga }}">
                                        <td>{{ $row->stok }}</td>

                                        <td><input type="number" id="qty" name="qty" class="w-100"></td>
                                        <td>
                                            {{-- <a href="#EditRowModal{{ $row->id }}" data-toggle="modal"
                                            class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                            Edit</a>
                                        <a href="#DeleteRowModal{{ $row->id }}" data-toggle="modal"
                                            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                            Delete</a> --}}

                                            <button class="btn btn-xs btn-info" type="submit">
                                                <i class="fa fa-check"> Pilih </i>
                                            </button>
                                        </td>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#select', function() {
                var id = $(this).data('id');
                var harga = $(this).data('harga');
                var stok = $(this).data('stok');
                $('#id').val(id);
                $('#harga').val(harga)
                $('#stok').val(stok)



                $('#modalload').modal('hide');
            });
        });
    </script>




    {{-- @endforeach --}}
@endsection
