<?php
session_start();
$hashPass=$email=$serial=$status=$password=$username=$password=$error='';

if(isset($_POST['submit'])) {
    include('connection.php');
    $serial = mysqli_real_escape_string($conn, $_POST['serial']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM mit_account WHERE serial= '" .$serial. "' or password='".$password."'";

    $results = mysqli_query($conn, $sql);
    $checkUser = mysqli_num_rows($results);

    //end remember me
    if($checkUser ==0){
        $error="<p class='alert alert-danger'><strong>Error!</strong>Serial number or password does not exist.Contact system administrator.</p>".mysqli_error($conn) ;
    }

    else {
        if ($row = mysqli_fetch_assoc($results)) {
            $hashPass = password_verify($password, $row['password']);
            $role=$row['role'];
        }

        if ($hashPass == false) {
            $error="<p class='alert alert-danger'><strong>Error!</strong>Serial number or password does not match the records we have. Please try again.".mysqli_error($conn)."</p>" ;
        } elseif ($hashPass == true) {
            $_SESSION['user'] =$serial;
            $_SESSION['role'] =$role;

            if($role=='patient'){
                echo '<script>window.location="patient/dashboard.php"</script>';
            }
            if($role=='doctor'){

                echo '<script>window.location="doctor/dashboard.php"</script>';
            }

        }

    }

}
?>

<!--===============================================end login-=================================================-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="icon" href="images/aids.jpg" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script rel="script" type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script rel="script" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body class="bg-primary">

<div class="col-md-4 col-md-4 offset-4">

    <div class="card align-content-center">
        <div class="card-header bg-primary">
            <h4 class="text-center text-white">Sign-In</h4>
            <?php echo $error?>
        </div>
        <div class="card-body">
            <form action="login.php" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="serial">Serial number/Patient Id:</label>
                    <input type="text" class="form-control" id="serial" title="Must be 8-character length" name="serial" placeholder="Enter serial number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <input type="submit" name="submit" id="btnLogIn" class="btn btn-block btn-outline-primary">
            </form>
            <h6>Have no account?</h6><a href="createAccount.php">Sign Up</a>
        </div>
    </div>
</div>

</body>
</html>
