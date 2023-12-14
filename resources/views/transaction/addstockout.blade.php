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
                        <form method="POST" action="/barangkeluar/store">

                            @csrf


                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Input Group</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="email2">Kode Barang</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="produk_id"
                                                            id="id" placeholder="Cari barang. . ." aria-label=""
                                                            aria-describedby="basic-addon1">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-default btn-border" data-toggle="modal"
                                                                data-target="#modalload" type="button">cari</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="email2">No transaksi</label>
                                    <input type="text" class="form-control" id="email2" name="id_keluar"
                                        placeholder="No transaksi. . ." >
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email2">Harga Jual</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RP</span>
                                    </div>
                                    <input type="text" class="form-control" name="harga" id="harga"
                                        aria-label="Amount (to the nearest dollar)" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="datepicker" name="tanggal_keluar"
                                        name="datepicker" placeholder="tanggal keluar. . .">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email2">Stok Barang</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Stok Sekarang" name="stok"
                                        id="stok" aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Pcs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Expired</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="datepicker" name="tanggal_expired"
                                        name="datepicker" placeholder="tanggal expired. . .">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">

                    </div>
                    {{-- <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">With textarea</span>
                                            </div>
                                            <textarea class="form-control" aria-label="With textarea"></textarea>
                                        </div>
                                    </div> --}}
                    {{-- <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-default btn-border" type="button">Button</button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="" aria-label=""
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div> --}}
                    <div class="form-group w-50">
                        <label for="email2">Stok Keluar</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Stok keluar" name="jumlah_keluar"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Pcs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success">Submit</button>

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

                                <th>Kategori</th>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_produk }}</td>

                                    <td>{{ $row->harga }}</td>

                                    <td>{{ $row->stok }}</td>

                                    <td>{{ $row->kategori->nama_kategori }}</td>
                                    <td>
                                        {{-- <a href="#EditRowModal{{ $row->id }}" data-toggle="modal"
                                            class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                            Edit</a>
                                        <a href="#DeleteRowModal{{ $row->id }}" data-toggle="modal"
                                            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                            Delete</a> --}}

                                        <button class="btn btn-xs btn-info" id="select" data-id="{{ $row->id }}"
                                            data-harga ="{{ $row->harga }}" data-stok="{{ $row->stok }}">
                                            <i class="fa fa-check"> Pilih </i>
                                        </button>
                                    </td>
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
            })
        })
    </script>


    {{-- @endforeach --}}
@endsection
