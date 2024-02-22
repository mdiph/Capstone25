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

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach
                            </ul>
                            <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    @endif



                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">produk</h4>
                                    <a class="btn btn-warning btn-round ml-auto text-light" href="/produk/trash">
                                        <i class="fa fa-trash"></i>
                                        Trash
                                    </a>
                                    <button class="btn btn-primary btn-round ml-2" data-toggle="modal"
                                        data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Add Row
                                    </button>
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
                                            <form method="POST" action="/produk/store" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama_produk"
                                                            placeholder="Nama produk..." required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <input type="text" class="form-control" name="deskripsi"
                                                            placeholder="deksripsi..." required>

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Harga</label>
                                                        <input type="text" class="form-control" name="harga"
                                                            placeholder="Harga..." required>

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Satuan</label>
                                                        <select class="form-control select2" name="satuan" required>

                                                            <option  value = "" >Pilih satuan</option>
                                                            <option value="MDS">MDS</option>
                                                            <option value="KTN">KTN</option>

                                                        </select>

                                                    </div>



                                                    <div class="form-group">
                                                        <label>Kategori</label>
                                                        <select class="form-control select2" name="kategori_id" required>
                                                            <option  value = "" >Pilih kategori</option>
                                                            @foreach ($kategori as $k)
                                                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>

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
                                                <form method="POST" action="/produk/update/{{ $d->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama_produk" value="{{ $d->nama_produk }}"
                                                                placeholder="Nama produk..." required>

                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi</label>
                                                            <input type="text" class="form-control" name="deksripsi" value="{{ $d->deskripsi }}"
                                                                placeholder="Deskripsi..." required>

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Harga</label>
                                                            <input type="text" class="form-control" name="harga" value="{{ $d->harga }}"
                                                                placeholder="Harga..." required>

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Satuan</label>
                                                            <input type="text" class="form-control" name="satuan" value="{{ $d->satuan }}"
                                                                placeholder="satuan..." required>

                                                        </div>



                                                        <div class="form-group">
                                                            <label>Kategori</label>
                                                            <select class="form-control select2" name="kategori_id" required>

                                                                <option disabled value="{{ $d->id }}">Dipilih {{ $d->kategori->nama_kategori }}</option>
                                                                @foreach ($kategori as $k)
                                                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                                                @endforeach
                                                            </select>

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
                                @endforeach

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
                                                <form method="POST" action="/produk/delete/{{ $d->id }}"
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
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No </th>
                                                <th>Kode </th>
                                                <th>Nama </th>
                                                <th>Deskripsi</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
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
                                                    <td>{{ $row->kode }}</td>
                                                    <td>{{ $row->nama_produk }}</td>
                                                    <td>{{ $row->deskripsi}}</td>
                                                    <td>{{ $row->harga }}</td>
                                                    <td>{{ $row->satuan}}</td>
                                                    <td>{{ $row->stok }}</td>

                                                    <td>{{ $row->kategori->nama_kategori }}</td>
                                                    <td>
                                                        <a href="#EditRowModal{{ $row->id }}" data-toggle="modal"
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
