@extends('layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">


                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="column">
                    <div class="">
                        <form method="POST" action="/barangmasuk/store">

                            @csrf


                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tambah Barang Masuk</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email2">Kode Barang</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="nama" name="nama" disabled value="{{ old('nama') }}"
                                                        placeholder="Cari barang. . ." aria-label=""
                                                        aria-describedby="basic-addon1" required>
                                                    <input type="hidden" class="form-control" name="produk_id" value="{{ old('produk_id') }}"
                                                        id="id">
                                                    <input type="hidden" class="form-control" name="stok_lama" value="{{ old('stok_lama') }}"
                                                        id="stok_lama">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-default btn-border" data-toggle="modal"
                                                            data-target="#modalload" type="button">cari</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label>Tanggal Masuk</label>
                                                    <div class="input-group">
                                                        <input type="date" onkeydown="return false" class="form-control"
                                                            id="datepicker" name="tanggal_masuk"
                                                            placeholder="tanggal masuk. . ." value="{{ old('tanggal_masuk') }}" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label>Tanggal kadaluarsa</label>
                                                    <div class="input-group">
                                                        <input type="date" onkeydown="return false" class="form-control"
                                                            id="datepicker" name="tanggal_kadaluarsa"
                                                            placeholder="tanggal kadaluarsa. . ." value="{{ old('tanggal_kadaluarsa') }}" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">

                                        <div class="col">

                                        </div>
                                    </div>




                                    <div class="form-group w-50">
                                        <label for="email2">Stok Masuk</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" min="0"
                                                placeholder="Stok Masuk" name="jumlah_masuk"
                                                oninput="this.value =
                                        !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2" >
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Pcs</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group w-50">
                                        <label for="email2">Batch</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Batch" name="batch"
                                                 >

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Submit</button>

                            </div>
                    </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    </div>

    {{-- <div class="modal fade" id="modalconfir" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            confirmation</span>
                        <span class="fw-light">
                            Row
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/barangmasuk/store" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" class="form-control" name="tanggal_masuk" id="tanggal_masuk">
                    <div class="form-group">
                        <h4 id="produkIdLabel"> </h4>
                    </div>



                    <div class="modal-footer ">
                        <button type="submit" id="addRowButton" class="btn btn-primary"><i class="fa fa-save"></i>
                            Hapus</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>
                            Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div> --}}
    <!-- Modal data -->
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

                                {{-- <th>Kategori</th> --}}
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($data as $row)
                                <tr id="tes">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_produk }}</td>

                                    <td>{{ $row->harga }}</td>

                                    <td>{{ $row->stok }}</td>

                                    {{-- <td>{{ $row->kategori->nama_kategori }}</td> --}}
                                    <td>
                                        {{-- <a href="#EditRowModal{{ $row->id }}" data-toggle="modal"
                                            class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                            Edit</a>
                                        <a href="#DeleteRowModal{{ $row->id }}" data-toggle="modal"
                                            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                                            Delete</a> --}}

                                        <button class="btn btn-xs btn-info" id="select" data-id="{{ $row->id }}"
                                            data-harga ="{{ $row->harga }}" data-stok="{{ $row->stok }}"
                                            data-nama="{{ $row->nama_produk }}">
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
                var nama = $(this).data('nama');
                var harga = $(this).data('harga');
                var stok = $(this).data('stok');
                var stokold = $(this).data('stok');
                $('#id').val(id);
                $('#harga').val(harga)
                $('#stok_lama').val(stok)
                $('#nama').val(nama)

                $('#produkIdLabel').text('Apakah Anda Ingin Menambah data? ' + nama);


                $('#modalload').modal('hide');
            });


            $('#datepicker').on('change', function() {
                // Mendapatkan nilai tanggal yang baru
                var tanggalMasukValue = $(this).val();

                // Menetapkan nilai tersebut pada elemen input dengan nama "tanggal_masuk"
                $('#tanggal_masuk').val(tanggalMasukValue);
            });
        });
    </script>




    {{-- @endforeach --}}
@endsection
