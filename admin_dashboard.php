<?php
session_start();
$nama_pengguna = isset($_SESSION['nama']) ? $_SESSION['nama'] : $_SESSION['username'];

// Memasukkan file koneksi ke dalam halaman
require_once('config/connection.php');

// Aksi Hapus Data
if (isset($_GET['hapus_id'])) {
    $id = $_GET['hapus_id'];

    // Query SQL untuk menghapus data dari tabel iklim berdasarkan ID
    $sql_delete = "DELETE FROM iklim WHERE id = $id";

    // Eksekusi query hapus
    if ($conn->query($sql_delete) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
}

// Query SQL untuk mengambil data dari tabel iklim
$sqlIklim = "SELECT * FROM iklim";

// Eksekusi query untuk tabel iklim
$resultIklim = $conn->query($sqlIklim);

// Query SQL untuk mengambil data dari tabel data_header
$sqlDataHeader = "SELECT * FROM data_header";

// Eksekusi query untuk tabel data_header
$resultDataHeader = $conn->query($sqlDataHeader);

// Mengatur nilai default jika tidak ada data yang ditemukan pada tabel data_header
$suhu = $kelembaban = $kondisi = $nama_kota = $kecepatan_angin = $arah_angin = "";

// Periksa apakah ada data yang diambil dari tabel data_header
if ($resultDataHeader->num_rows > 0) {
    // Mendapatkan data dari baris pertama (jika Anda hanya ingin menampilkan satu baris data)
    $row = $resultDataHeader->fetch_assoc();
    
    // Menyimpan data ke dalam variabel
    $suhu = $row['suhu'];
    $kelembaban = $row['kelembaban'];
    $kondisi = $row['kondisi'];
    $nama_kota = $row['nama_kota'];
    $kecepatan_angin = $row['kecepatan_angin'];
    $arah_angin = $row['arah_angin'];
}

// Tutup koneksi ke database
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Image Logo -->
                        <a href="#" class="logo">
                            <img src="assets/images/logo-sm.png" alt="" height="32" class="logo-small">
                            <img src="assets/images/logo.png" alt="" height="40" class="logo-large">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        
                        <ul class="list-inline float-right mb-0">
                            <!-- Search -->
                            <li class="list-inline-item dropdown notification-list d-none d-sm-inline-block">
                                <form role="search" class="app-search">
                                    <div class="form-group mb-0"> 
                                        <input type="text" class="form-control" placeholder="Search..">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form> 
                            </li>
                            <!-- Messages-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                     <i class="mdi mdi-email-outline noti-icon"></i>
                                     <span class="badge badge-danger badge-pill noti-icon-badge">5</span>
                                 </a>
                            </li>
                            <!-- notification-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline noti-icon"></i>
                                    <span class="badge badge-success badge-pill noti-icon-badge">3</span>
                                </a>

                            </li>
                            <!-- User-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                    <a class="dropdown-item" href="profil.php"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                    <a class="dropdown-item" href="login.php"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                </div>

                            </li>
                            <li class="menu-item list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <!-- MENU Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="#"><i class="dripicons-meter"></i>Dashboard</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="dripicons-briefcase"></i>User Interface</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="dripicons-broadcast"></i>Advanced UI</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="dripicons-view-thumb"></i>Components</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="dripicons-graph-bar"></i>Charts</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="dripicons-copy"></i>Pages</a>
                            </li>

                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#"><?php echo $nama_pengguna; ?></a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card bg-primary m-b-30 text-white weather-box">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div>
                                                <canvas id="rain" width="66" height="66"></canvas>
                                            </div>
                                            <div class="d-flex justify-content-between mt-4">
                                                <div class="text-left" style="margin-top:auto;">
                                                    <h6><i class="mdi mdi-water"></i> Kelembaban: <?php echo $kelembaban; ?>&deg</h6>
                                                    <h6 class="mt-4"><i class="mdi mdi-checkbox-blank-circle-outline"></i> Kondisi: <?php echo $kondisi; ?></h6>
                                                </div>
                                                <div>
                                                    <h1><?php echo $suhu; ?>° c</h1>
                                                    <h6><?php echo $kondisi; ?></h6>
                                                    <h2 class="mt-4"><?php echo $nama_kota; ?></h2>
                                                    <a href="edit_informasi.php" class="btn btn-success">Edit Informasi</a>
                                                </div>
                                                <div class="text-right" style="margin-top:auto;">
                                                    <h6><i class="mdi mdi-weather-windy"></i> Kecepatan Angin: <?php echo $kecepatan_angin; ?> km/h</h6>
                                                    <h6 class="mt-4"><i class="mdi mdi-compass-outline"></i> Arah Angin: <?php echo $arah_angin; ?>&deg</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="weather-icon">
                                            <i class="mdi mdi-weather-pouring"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat m-b-30">
                            <div class="p-3 bg-primary text-white">
                                <div class="mini-stat-icon">
                                <i class="fa fa-cloud float-right mb-0"></i>
                                </div>
                                <h6 class="text-uppercase mb-0">Semarang Timur</h6>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom pb-4">
                                    <span class="ml-2 text-muted">Berawan</span>
                                </div>
                                <div class="mt-4 text-muted">
                                    <div class="float-right">
                                        <p class="m-0">Suhu: 29&deg C</p>
                                    </div>
                                    <h5 class="m-0">75%<i class="mdi mdi-water text-primary ml-2"></i></h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat m-b-30">
                            <div class="p-3 bg-primary text-white">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-weather-pouring float-right mb-0"></i>
                                </div>
                                <h6 class="text-uppercase mb-0">Semarang Tengah</h6>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom pb-4">
                                    <span class="ml-2 text-muted">Hujan Ringan</span>
                                </div>
                                <div class="mt-4 text-muted">
                                    <div class="float-right">
                                        <p class="m-0">Suhu: 27&deg C</p>
                                    </div>
                                    <h5 class="m-0">85%<i class="mdi mdi-water text-primary ml-2"></i></h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat m-b-30">
                            <div class="p-3 bg-primary text-white">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-weather-lightning float-right mb-0"></i>
                                </div>
                                <h6 class="text-uppercase mb-0">Semarang Utara</h6>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom pb-4">
                                    <span class="ml-2 text-muted">Hujan Petir</span>
                                </div>
                                <div class="mt-4 text-muted">
                                    <div class="float-right">
                                        <p class="m-0">Suhu: 27&deg C</p>
                                    </div>
                                    <h5 class="m-0">85%<i class="mdi mdi-water text-primary ml-2"></i></h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat m-b-30">
                            <div class="p-3 bg-primary text-white">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-white-balance-sunny float-right mb-0"></i>
                                </div>
                                <h6 class="text-uppercase mb-0">Semarang Selatan</h6>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom pb-4">
                                    <span class="ml-2 text-muted">Sebagian Cerah</span>
                                </div>
                                <div class="mt-4 text-muted">
                                    <div class="float-right">
                                        <p class="m-0">Suhu: 30&deg C</p>
                                    </div>
                                    <h5 class="m-0">70%<i class="mdi mdi-water text-primary ml-2"></i></h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Gelombang Angin</h4>

                                <ul class="list-inline widget-chart m-t-20 text-center">
                                    <li>
                                        <h4 class=""><b>15.37 km/h</b></h4>
                                        <p class="text-muted m-b-0">Kecepatan Rata-Rata</p>
                                    </li>
                                    <li>
                                        <h4 class=""><b>5421</b></h4>
                                        <p class="text-muted m-b-0">Minggu Terakhir</p>
                                    </li>
                                    <li>
                                        <h4 class=""><b>7 Th</b></h4>
                                        <p class="text-muted m-b-0">Periode</p>
                                    </li>
                                </ul>

                                <div id="morris-area-example" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Grafik Cuaca</h4>

                                <ul class="list-inline widget-chart m-t-20 text-center">
                                    <li>
                                        <h4 class=""><b>37%</b></h4>
                                        <p class="text-muted m-b-0">Panas Terik</p>
                                    </li>
                                    <li>
                                        <h4 class=""><b>63%</b></h4>
                                        <p class="text-muted m-b-0">Curah Hujan</p>
                                    </li>
                                    <li>
                                        <h4 class=""><b>5 Th</b></h4>
                                        <p class="text-muted m-b-0">Periode</p>
                                    </li>
                                </ul>
                                <div id="morris-bar-example" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end row -->
                

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <a href="tambah_perkiraan.php" style="color:#FFFFFF" class="btn btn-primary float-right mb-4 mt-0">Tambah Data</a>
                                <h4 class="mt-2 header-title mb-0">Perkiraan Cuaca</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Nama Daerah</th>
                                                <th>Cuaca</th>
                                                <th>Suhu</th>
                                                <th>Kelembaban Udara</th>
                                                <th>Waktu</th>
                                                <th>Aksi</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php
                                            // Periksa apakah ada data yang diambil dari tabel iklim
                                            if ($resultIklim->num_rows > 0) {
                                                // Output data dari setiap baris hasil query
                                                while ($row = $resultIklim->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['nama_daerah'] . "</td>";
                                                    echo "<td>" . $row['cuaca'] . "</td>";
                                                    echo "<td>" . $row['suhu'] . "&deg;C</td>";
                                                    echo "<td>" . $row['kelembaban_udara'] . "%</td>";
                                                    echo "<td>" . $row['waktu'] . "</td>";
                                                    echo "<td>
                                                            <a href='edit_perkiraan.php?id=" . $row['id'] . "'><button class='btn btn-warning'>Edit</button></a>
                                                            <a href='?hapus_id=" . $row['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\"><button class='btn btn-danger'>Hapus</button></a>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>Tidak ada data yang ditemukan dalam tabel iklim.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                            
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2024 <b>WeatherApp</b><span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by WeatherApp.</span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <!-- skycons -->
        <script src="assets/plugins/skycons/skycons.min.js"></script>

        <!-- skycons -->
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- dashboard -->
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>


    </body>
</html>

