<?php
require_once('config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, nama, email) VALUES ('$username', '$password', '$nama', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Drixo - Responsive Booststrap 4 Admin & Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="pb-0">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg">
            
            <div class="content-center">
                <div class="content-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                    
                                        <h3 class="text-center mt-0 m-b-15">
                                            <a href="index.html" class="logo logo-admin">Weather App</a>
                                        </h3>
                    
                                        <h4 class="text-muted text-center font-18"><b>Register</b></h4>
                    
                                        <div class="p-3">
                                            <form class="form-horizontal m-t-20" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" id="nama" name="nama" type="text" required="" placeholder="Nama">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" id="email" name="email" type="email" required placeholder="Email">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" id="username" name="username" type="text" required="" placeholder="Username">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" id="password" name="password" type="password" required="" placeholder="Password">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label font-weight-normal" for="customCheck1">I accept <a href="#" class="text-primary">Terms and Conditions</a></label>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                                    </div>
                                                </div>
                    
                                                <div class="form-group m-t-10 mb-0 row">
                                                    <div class="col-12 m-t-20 text-center">
                                                        <a href="login.php" class="text-muted">Already have account?</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                    
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>

        
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>