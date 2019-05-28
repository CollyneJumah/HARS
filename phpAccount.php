<?php
/**
 * Created by PhpStorm.
 * User: CollinsJumah
 * Date: 4/19/2019
 * Time: 05:13
 */
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
        echo '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong> Your Data has been sent successfully.</div>';

    }else{
        $msg='<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>
                   <strong>Success!</strong> Error occured while creating account.Please try again.</div>';
    }

}



?>