<?php
session_start();
$nama_pengguna = isset($_SESSION['nama']) ? $_SESSION['nama'] : $_SESSION['username'];
// Memasukkan file koneksi ke dalam halaman
require_once('config/connection.php');

$id = 1; // ID data yang ingin diubah

// Query SQL untuk mendapatkan data dari tabel data_header berdasarkan ID
$sql = "SELECT * FROM data_header WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $suhu = $row['suhu'];
    $keterangan_cuaca = $row['keterangan_cuaca'];
    $nama_kota = $row['nama_kota'];
    $kelembaban = $row['kelembaban'];
    $kondisi = $row['kondisi'];
    $kecepatan_angin = $row['kecepatan_angin'];
    $arah_angin = $row['arah_angin'];
} else {
    echo "Data tidak ditemukan.";
}

// Aksi Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $suhu = $_POST['suhu'];
    $keterangan_cuaca = $_POST['keterangan_cuaca'];
    $nama_kota = $_POST['nama_kota'];
    $kelembaban = $_POST['kelembaban'];
    $kondisi = $_POST['kondisi'];
    $kecepatan_angin = $_POST['kecepatan_angin'];
    $arah_angin = $_POST['arah_angin'];

    // Query SQL untuk melakukan update data pada tabel data_header berdasarkan ID
    $sql_update = "UPDATE data_header SET 
                    suhu='$suhu', 
                    keterangan_cuaca='$keterangan_cuaca', 
                    nama_kota='$nama_kota', 
                    kelembaban='$kelembaban', 
                    kondisi='$kondisi', 
                    kecepatan_angin='$kecepatan_angin', 
                    arah_angin='$arah_angin' 
                    WHERE id=$id";

    // Eksekusi query update
    if ($conn->query($sql_update) === TRUE) {
        echo "Data berhasil diperbarui.";
        // Redirect ke halaman yang sesuai setelah update berhasil
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Edit Informasi</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                            <img src="assets/images/logo.png" alt="" height="30" class="logo-large">
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
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
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
                                <a href="admin_dashboard.php"><i class="dripicons-meter"></i>Dashboard</a>
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
                                    <li class="breadcrumb-item active">Form Edit Informasi</li>
                                </ol>
                            </div>
                            <h4 class="page-title">EDIT INFORMASI</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">INFORMASI</h4>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="p-20">
                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <div class="form-group">
                                                    <label>Suhu</label>
                                                    <input type="text" class="form-control" id="suhu" name="suhu" value="<?php echo $suhu; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan Cuaca</label>
                                                    <input type="text" class="form-control" id="keterangan_cuaca" name="keterangan_cuaca" value="<?php echo $keterangan_cuaca; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Kota</label>
                                                    <input type="text" class="form-control" id="nama_kota" name="nama_kota" value="<?php echo $nama_kota; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kelembaban</label>
                                                    <input type="text" class="form-control" id="kelembaban" name="kelembaban" value="<?php echo $kelembaban; ?>">
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <label>Kondisi</label>
                                                    <input type="text" class="form-control" id="kondisi" name="kondisi" value="<?php echo $kondisi; ?>">
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <label>Kecepatan Angin</label>
                                                    <input type="text" class="form-control" id="kecepatan_angin" name="kecepatan_angin" value="<?php echo $kecepatan_angin; ?>">
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <label>Arah Angin</label>
                                                    <input type="text" class="form-control" id="arah_angin" name="arah_angin" value="<?php echo $arah_angin; ?>">
                                                </div>
                                                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

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

        <!-- Bootstrap inputmask js -->
        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            jQuery.browser = {};
                (function () {
                    jQuery.browser.msie = false;
                    jQuery.browser.version = 0;
                    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                        jQuery.browser.msie = true;
                        jQuery.browser.version = RegExp.$1;
                    }
                })();
        </script>
    
    </body>
</html>

<?php
// Tutup koneksi ke database
$conn->close();
?>