<?php
require_once('accoutDoctor.php');
$msg='';
if(isset($_POST['submit'])){
	require_once('connection.php');
	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$passsword=mysqli_real_escape_string($conn,$_POST['password']);
    
	$sql="INSERT INTO `doctor`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
	$result=mysqli_query($conn,$sql);
	if($result){
		echo "Your account has been created successfully";
	}else{
		echo "Error occurred while creating account.Please try again".mysqli_error($conn);
	}
}

 ?>