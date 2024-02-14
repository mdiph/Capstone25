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
                        <form method="POST" action="/tes/add">

                            @csrf


                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Transaksi</div>
                                </div>

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">

                                            <div class="form-group row">
                                                <label for="inputEmail4">Kode Transaksi</label>
                                                <input type="text" class="form-control" placeholder="Kode Transaksi . ."
                                                    name="kode_transaksi">
                                            </div>

                                            <div class="form-group row ">
                                                <label for="inputPassword4">Tanggal transaksi</label>
                                                <input type="date" class="form-control" id="inputPassword4"
                                                    name="tanggal_transaksi" placeholder="Pilih tanggal">
                                            </div>



                                            <div class="form-group row">
                                                <label for="inputEmail4">Salesman</label>
                                                <select class="form-control select2" name="salesman_id" required>
                                                    <option value = "">Pilih Salesman</option>
                                                    @foreach ($salesman as $s)
                                                        <option value="{{ $s->id }}">{{ $s->nama_salesman }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword4">Customer</label>
                                                <select class="form-control select2" name="customer_id" required>
                                                    <option value = "">Pilih Customer</option>
                                                    @foreach ($customer as $c)
                                                        <option value="{{ $c->id }}">{{ $c->nama_customer }}</option>
                                                    @endforeach
                                                </select>
                                            </div>




                                        </div>

                                        <div class="col">

                                            <div class="form-group row">
                                                <label for="inputEmail4">No Batch</label>
                                                <input type="text" class="form-control" placeholder="No batch. . ."
                                                    name="no_batch" id="batch">
                                            </div>

                                            <div class="form-group row ">
                                                <label for="inputPassword4">Tanggal Kedaluwarsa</label>
                                                <input type="date" class="form-control" id="kedaluwarsa"
                                                    name="tanggal_kedaluwarsa" placeholder="Pilih tanggal">
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail4">Produk</label>
                                                <input type="text" class="form-control" id="nama"
                                                    placeholder="Cari Produk" data-toggle="modal" data-target="#modalload">
                                                <input type="hidden" class="form-control" name="produk_id" id="id">

                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail4">Diskon</label>
                                                <input type="number" class="form-control" id="diskonp" name="diskon">


                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail4">Jumlah Keluar</label>
                                                <input type="number" class="form-control" id="jumlah_keluar"
                                                    name="jumlah_keluar">
                                                <input type="hidden" class="form-control" id="harga_jual"
                                                    name="harga_jual">

                                            </div>






                                            <button type="submit" class="btn btn-primary" id="addcart"><i
                                                    class="fa fa-plus"> </i>
                                                Tambah ke Keranjang</button>





                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">Keranjang</div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="carttable">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Harga Sales</th>
                                                                    <th>Jumlah Keluar</th>
                                                                    <th>Diskon</th>
                                                                    <th>Jumlah</th>
                                                                    {{-- <th >Harga</th> --}}
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="">Subtotal </label>

                                                            <input type="text" class="form-control subtotal"
                                                                name="subtotal" id="subtotal" readonly>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="card">

                                                <div class="card-header">
                                                    <div class="card-title">Pembayaran</div>
                                                </div>

                                                <div class="card-body">
                                                    {{-- <div class="form-group row">
                                                        <label for="inputEmail3" class="">Subtotal </label>

                                                        <input type="text" class="form-control subtotal" name="subtotal"
                                                            id="subtotal"  readonly>

                                                    </div> --}}
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="">Diskon</label>

                                                        <input type="number" class="form-control diskon" id="diskon"
                                                            name="diskon" placeholder="diskon">

                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="">Total</label>

                                                        <input type="text" class="form-control total" id="total"
                                                            name="total" readonly>

                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputPassword4">Metode Pembayaran</label>
                                                        <select class="form-control select2" name="metode" required>
                                                            <option value = "">Pilih metode</option>

                                                            <option value="Cash">Cash</option>
                                                            <option value="Tempo">tempo</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="">Bayar</label>

                                                        <input type="number" class="form-control total" name="bayar">

                                                    </div>

                                                    <button type="submit" class="btn btn-success">Bayar</button>

                                                </div>


                                            </div>
                                        </div>
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
    <div class="modal fade bd-example-modal-lg" id="modalload" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                <th>Stok tersisa</th>
                                {{-- <th class="w-10">Qty</th> --}}
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            @php $no = 1 @endphp
                            @foreach ($produk as $row)
                                <tr>
                                    {{-- <form action="/addcart/" method="POST">
                                        @csrf --}}
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_produk }}</td>


                                    <td>{{ $row->harga }}</td>

                                    <td>{{ $row->stok }}</td>

                                    {{-- <td><input type="number" id="qty" name="qty" class="w-100"></td> --}}
                                    <td>



                                        <button class="btn btn-xs btn-info" type="submit" id="select"
                                            data-id="{{ $row->id }}" data-nama = "{{ $row->nama_produk }}"
                                            data-harga ="{{ $row->harga }}" data-stok="{{ $row->stok }}">
                                            <i class="fa fa-check"> Pilih </i>
                                        </button>
                                    </td>
                                    {{-- </form> --}}

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

            fetchData();

            function fetchData() {
                $.ajax({
                    url: '/tes/cart',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var cartData = response.cartData;
                        var total = response.total;
                        displayData(cartData);
                        $('#subtotal').val(total);

                    },
                    error: function(error) {
                        console.log('Error: ' + error);
                    }
                });
            }

            function displayData(data) {
                var tableBody = $('#carttable tbody');
                tableBody.empty();

                $.each(data, function(index, item) {

                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td><input type="hidden" name="produk_id" value="' + item.produk_id + '">' + item
                        .produk.nama_produk + '</td>' +
                        '<td><input class="harga" type="hidden" name="harga_jual" id="harga">' + item
                        .harga_jual + '</td>' +
                        '<input type = "hidden" name ="stok_lama" value="' + item.produk.stok + '">' +
                        '<td><input class="barangkeluar" type="hidden" min="0" max="' + item.jumlah_keluar +
                        '" name="stok_keluar" id="barangkeluar">' + item.jumlah_keluar + '</td>' +
                        '<td><input class="jumlah" type="hidden" id="diskonp" >' + item.diskon + '</td>' +
                        '<td><input class="jumlah" type="hidden" id="jumlah" >' + item.total + '</td>' +
                        '<td><a class="btn btn-xs btn-danger delete-item" data-id="' + item.id +
                        '"><i class="fa fa-trash"></i>Delete</a></td>' +
                        '</tr>';
                    tableBody.append(row);


                });
            }

            $(document).on('click', '.delete-item', function(e) {

                e.preventDefault(); // Mencegah aksi default dari link

                var itemId = $(this).data('id');

                // Lakukan penghapusan menggunakan AJAX

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/deletecart/' + itemId,
                    type: 'GET',


                    success: function(response) {
                        fetchData();



                    },
                    error: function(error) {
                        console.log('Error: ' + error);
                    }
                });
            });

            $(document).on('click', '#addcart', function(e) {

                e.preventDefault(); // Mencegah aksi default dari link

                var itemId = $('#id').val();
                var jumlahK = $('#jumlah_keluar').val();
                var hargaJ = $('#harga_jual').val();
                var diskonp = $('#diskonp').val();
                var batch = $('#batch').val();
                var tk = $('#kedaluwarsa').val();



                // Lakukan penghapusan menggunakan AJAX

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/addcart',
                    type: 'POST',
                    data: {
                        produk_id: itemId,
                        harga_jual: hargaJ,
                        jumlah_keluar: jumlahK,
                        diskon: diskonp,
                        no_batch: batch,
                        tanggal_kedaluwarsa: tk,
                    },

                    success: function(response) {

                        fetchData();
                        calculateTotal();


                    },
                    error: function(error) {
                        console.log('Error: ' + error);
                    }
                });
            });

            $(document).on('click', '#select', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var harga = $(this).data('harga');
                var stok = $(this).data('stok');
                $('#id').val(id);
                $('#harga_jual').val(harga);


                $('#nama').val(nama + ' | ' + ' Stok ' + stok + ' | ' + ' Harga ' + harga)

                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // $.ajax({

                //     url: '/addcart',
                //     type: 'POST',
                //     data: {
                //         produk_id: $(this).data('id')
                //     },
                //     success: function(response) {
                //         fetchData();
                //         calculateTotal();
                //     }


                // })



                $('#modalload').modal('hide');
            });

            $(document).on('keyup change', '#diskon', function() {
                calculateTotal();
            });

            // Fungsi hitung total

            function calculateTotal() {
                let subtotal = $('#subtotal').val();
                const diskon = parseInt($('#diskon').val()) || 0;
                const persen = diskon / 100;
                const total = subtotal - (subtotal * persen);

                console.log("subtotal:", subtotal);
                console.log("diskon:", diskon);
                console.log("persen:", persen);
                console.log("total:", total);
                $('#total').val(total);
            }

            // Hitung total awal
            calculateTotal();
        });


        $(function() {
            // Event handler perubahan harga dan barang keluar

            // $(document).on('keyup change', '#diskon', function() {
            //     calculateTotal();
            // });

            // // Fungsi hitung total

            // function calculateTotal() {
            //     let subtotal = $('#subtotal').val();
            //     const diskon = parseInt($('#diskon').val()) || 0;
            //     const persen = diskon / 100;
            //     const total = subtotal - (subtotal * persen);

            //     $('#subtotal').val(subtotal);
            //     $('#total').val(total);
            // }

            // // Hitung total awal
            // calculateTotal();
        });
    </script>






    {{-- @endforeach --}}
@endsection
