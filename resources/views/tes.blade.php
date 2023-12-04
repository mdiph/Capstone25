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
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Input Group</div>
                            </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email2">Nama Barang</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="" aria-label=""
                                                        aria-describedby="basic-addon1">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-default btn-border"
                                                            type="button">cari</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email2">No transaksi</label>
                                                <input type="email" class="form-control" id="email2"
                                                    placeholder="No transaksi. . ." disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email2">Harga</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">RP</span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        aria-label="Amount (to the nearest dollar)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tanggal Masuk</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="tanggal masuk. . .">
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
                                                    <input type="text" class="form-control" placeholder="Stok Masuk"
                                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
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
                                                    <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="tanggal expired. . .">
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
                                        <label for="email2">Stok Masuk</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Stok Masuk"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Pcs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success">Submit</button>
                                    <button class="btn btn-danger">Cancel</button>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
