<?php 
require_once 'login.php';
require_once('connection.php');


if(isset($_POST['submit'])){
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);

	$sql="SELECT * FROM doctor WHERE email='$email' || password='$password'";
	$result=mysqli_query($conn,$sql);
	$checkUser=mysqli_num_rows($result);
	if($checkUser==1){

        echo '<script>window.location.href="menu.php";</script>';

    }else{
	    echo 'error'.mysqli_error($conn);
    }
	
}

?>