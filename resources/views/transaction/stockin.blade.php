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
                                    <h4 class="card-title">Barang Masuk</h4>
                                    <div id="datarange" class="float-end">

                                    </div>
                                    @if (auth()->user()->role == "Admin")
                                    <a class="btn btn-warning btn-round ml-auto text-light" href="/barangmasuk/trash">
                                        <i class="fa fa-trash"></i>
                                        Trash
                                    </a>
                                    @endif
                                    <a class="btn btn-primary btn-round ml-2 text-light" href="/barangmasuk/add">

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

                                @foreach ($data as $d)
                                    <!-- Modal delete -->
                                    <div class="modal fade" id="DeleteRowModal{{ $d->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
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
                                                <form method="POST" action="/barangmasuk/delete/{{ $d->id }}"
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


                                <div class="table-responsive">
                                    <form method="POST" action="{{ route('caristockin') }}">
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
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn" name="search" >search</button>
                                                        </div>
                                                        <div class="col">
                                                            <a href="/barangmasuk" class="btn btn-success" >Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No </th>
                                                <th>ID</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Batch</th>
                                                <th>Tanggal Kadaluarsa</th>
                                                <th>Jumlah Masuk</th>
                                                <th>Produk</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $row->id_masuk }}</td>
                                                    <td>{{ $row->tanggal_masuk }}</td>
                                                    <td>{{ $row->batch }}</td>
                                                    <td>{{ $row->tanggal_kadaluarsa }}</td>
                                                    <td>{{ $row->jumlah_masuk }}</td>

                                                    @if ($row->produk)
                                                        <td>{{ $row->produk->nama_produk }}</td>
                                                    @else
                                                        <td>Produk sudah dihapus atau tidak tersedia</td>
                                                    @endif
                                                    <td>
                                                        <a href="/barangmasuk/edit/{{ $row->id }}"
                                                            class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                            Edit</a>
                                                        <a href="#DeleteRowModal{{ $row->id }}" data-toggle="modal"
                                                            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                                            Delete</a>
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
