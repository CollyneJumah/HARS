<?php
$msg='';
require_once 'connection.php';
if(isset($_POST['submit'])){
    $serial=mysqli_real_escape_string($conn,$_POST['serial']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $confirm=mysqli_real_escape_string($conn,$_POST['confirmPass']);
    $passHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

    $sql="INSERT INTO `mit_account`(`serial`, `email`, `password`) VALUES ('$serial','$email','$passHash')";
    $result=mysqli_query($conn,$sql);
    if($result){
        $msg='<div class="alert alert-success">
     <strong>Success!</strong> Your Data has been sent successfully.Redirecting...
</div> ';
        echo '<script>setInterval(function() {
  window.location.href="login.php";
},5000)</script>';
    }else{
        $msg='<div class="alert alert-danger">
<strong>Error!</strong> Occurred while saving data.Please try again.
</div> ';
    }

}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script rel="script" type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script rel="script" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body class="bg-primary">

<div class="container-fluid">
    <div class="col-md-4 col-md-4 offset-4">

        <div class="card align-content-center">
            <div class="card-header bg-primary">
                <h4 class="text-center text-white">Sign Up</h4>
                <span><?php echo $msg?></span>
            </div>
            <div class="card-body">
                <form action="createAccount.php" method="post" autocomplete="off">

                    <div class="form-group">
                        <label for="serial">Serial number/Patient Id:</label>
                        <input type="text" class="form-control" id="serial" title="Must be 8-character length" name="serial" placeholder="Enter serial number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Enter password again">
                    </div>
                    <input type="submit" name="submit" id="btnLogIn" class="btn btn-block btn-outline-primary">
                </form>
                <h6>Already have an account?</h6><a href="login.php">Sign in</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
