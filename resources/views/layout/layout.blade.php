<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Ceritnaya skripsi</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Open+Sans:300,400,600,700"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                urls: ['/assets/css/fonts.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/azzara.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <!--
    Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
  -->
        <div class="main-header" data-background-color="purple">
            <!-- Logo Header -->
            <div class="logo-header">

                <a href="#" class="logo">
                    <img src="/assets/img/logoazzara.svg" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize btn-rounded">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">


            </nav>
            <!-- End Navbar -->
        </div>
        <!-- Sidebar -->
        <div class="sidebar">

            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    {{ auth()->user()->nama }}
                                    <span class="user-level">{{ auth()->user()->role }}</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#settings">
                                            <span class="link-collapse">Settings</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="../index.html">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="badge badge-count">5</span>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>

                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Data Master</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="/salesman">
                                            <span class="sub-item">Data Salesman</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/customer">
                                            <span class="sub-item">Data Customer</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/kategori">
                                            <span class="sub-item">kategori Produk</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/produk">
                                            <span class="sub-item">Data Produk</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a data-toggle="collapse" href="#charts">
                                <i class="far fa-chart-bar"></i>
                                <p>Laporan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../charts/charts.html">
                                            <span class="sub-item">Omzet Customer</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/omzet/salesman">
                                            <span class="sub-item">Omzet Salesman</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/omzet/produk">
                                            <span class="sub-item">Omzet Produk</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a data-toggle="collapse" href="#transaksi">
                                <i class="far fa-chart-bar"></i>
                                <p>Transaksi</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="transaksi">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="/barangmasuk">
                                            <span class="sub-item">Barang Masuk</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/transaksi">
                                            <span class="sub-item">Transaksi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/barangkeluar">
                                            <span class="sub-item">Barang Keluar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a data-toggle="collapse" href="#custompages">
                                <i class="fas fa-paint-roller"></i>
                                <p>Admins</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="custompages">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="/User">
                                            <span class="sub-item">User Control</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../login2.html">
                                            <span class="sub-item">Login & Register 2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../userprofile.html">
                                            <span class="sub-item">User Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../404.html">
                                            <span class="sub-item">404</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">


                            <a data-toggle="collapse" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>

                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: one;">
                                {{ csrf_field() }}
                            </form>

                        </li>

                    </ul>
                </div>
            </div>
        </div>

        @yield('content')


    </div>
    <!--   Core JS Files   -->


<!-- jQuery UI -->
<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="/assets/js/plugin/moment/moment.min.js"></script>

<!-- Chart JS -->
<script src="/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="/assets/js/plugin/gmaps/gmaps.js"></script>

<!-- Dropzone -->
<script src="/assets/js/plugin/dropzone/dropzone.min.js"></script>

<!-- Fullcalendar -->
<script src="/assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

<!-- DateTimePicker -->
<script src="/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

<!-- Bootstrap Tagsinput -->
<script src="/assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Bootstrap Wizard -->
<script src="/assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

<!-- jQuery Validation -->
<script src="/assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

<!-- Summernote -->
<script src="/assets/js/plugin/summernote/summernote-bs4.min.js"></script>

<!-- Select2 -->
<script src="/assets/js/plugin/select2/select2.full.min.js"></script>

<!-- Sweet Alert -->
<script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="/assets/js/ready.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({});




        });
    </script>

    <script type="text/javascript">
    $('#datepicker').datetimepicker({
	format: 'MM/DD/YYYY'
});
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $('#datepicker').datetimepicker({
                    format: 'MM/DD/YYYY',
                });
            });
        });
    </script>

    <script>
        //== Class definition
        var SweetAlert2Demo = function() {

            //== Demos
            var initDemos = function() {


                //== Sweetalert Demo 4
                $('#alert_demo_4').click(function(e) {
                    swal({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Confirm Me",
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                                closeModal: true
                            }
                        }
                    });
                });



                $('#alert_demo_8').click(function(e) {
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        buttons: {
                            cancel: {
                                visible: true,
                                text: 'No, cancel!',
                                className: 'btn btn-danger'
                            },
                            confirm: {
                                text: 'Yes, delete it!',
                                className: 'btn btn-success'
                            }
                        }
                    }).then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                        } else {
                            swal("Your imaginary file is safe!", {
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                        }
                    });
                })

            };

            return {
                //== Init
                init: function() {
                    initDemos();
                },
            };
        }();

        //== Class Initialization
        jQuery(document).ready(function() {
            SweetAlert2Demo.init();
        });
    </script>
</body>

</html>
