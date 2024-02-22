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
                                    <h4 class="card-title">User</h4>
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
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
                                            <form method="POST" action="/User/store" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            placeholder="Nama User..." required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="email. . ." required>

                                                    </div>



                                                    <div class="form-group">
                                                        <label>password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="password..." required>

                                                    </div>



                                                    <div class="form-group">
                                                        <label>role</label>
                                                        <select class="form-control select2" name="role" required>
                                                            <option  value = "" >Pilih role</option>
                                                            <option  value = "admin" >Admin</option>
                                                            <option  value = "gudang" >Gudang</option>
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

                                @foreach ($user as $d)
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
                                                <form method="POST" action="/User/update/{{ $d->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama" value="{{ $d->nama }}"
                                                                placeholder="Nama User..." required>

                                                        </div>
                                                        <div class="form-group">
                                                            <label>email</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $d->email }}"
                                                                placeholder="deksripsi..." required>

                                                        </div>


                                                        <div class="form-group">
                                                            <label>password</label>
                                                            <input type="password" class="form-control" name="password"
                                                                placeholder="password..." >

                                                        </div>




                                                        <div class="form-group">
                                                            <label>role</label>
                                                            <select class="form-control select2" name="role" required>
                                                                <option  value = "{{ $d->role }}" >{{ $d->role }}</option>
                                                                <option  value = "admin" >Admin</option>
                                                                <option  value = "gudang" >Gudang</option>
                                                            </select>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" id="addRowButton"
                                                            class="btn btn-primary"><i class="fa fa-save"></i>
                                                            Ubah</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($user as $d)
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
                                                <form method="POST" action="/User/delete/{{ $d->id }}"
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
                                    <table id="User" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No </th>
                                                <th>Nama </th>
                                                <th>email</th>
                                                <th>role</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($user as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $row->nama}}</td>
                                                    <td>{{ $row->email}}</td>
                                                    <td>{{ $row->role }}</td>
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
