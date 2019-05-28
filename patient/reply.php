<?php
@session_start();
$msg='';
$show =$_SESSION['user'];
/**
 * Created by PhpStorm.
 * User: CollinsJumah
 * Date: 4/19/2019
 * Time: 07:42
 */
require_once '../connection.php';
$sql="SELECT * FROM patient WHERE serial='".$_SESSION['user']."'";
$result=mysqli_query($conn,$sql);
while ($ro=mysqli_fetch_array($result)){
    $phone=$ro['phone'];
}




if(isset($_POST['reply'])){

    $messageTo='+254790366848';
    $messageFrom=$phone;
    $message=mysqli_real_escape_string($conn,$_POST['MessageText']);

    $sqlR="INSERT INTO `messageout`(`MessageTo`, `MessageFrom`, `MessageText`) VALUES ('$messageTo','$messageFrom','$message')";
    $resultR=mysqli_query($conn,$sqlR);
    if($resultR){
        $msg='<div class="alert alert-success">
<strong>Success!</strong> Reply send.
</div> ';
        echo '<script>setTimeout(function() {
  window.location.href="dashboard.php";
},3000)</script>';
    }else{
        $msg='<div class="alert alert-danger">
<strong>Error!</strong> Occurred while sending.Please try again.
</div> '.mysqli_error($conn);
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>


<div class="container">
    <div class="panel-primary">
        <div class="panel-heading">
            <h5 class="text-center">Send Reply message to Doctor</h5>
            <span><?php echo $msg ?></span>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="reply.php" method="POST">

                <div class="form-group">
                    <label class="control-label col-sm-4" for="message">Message</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="message" name="MessageText" cols="5" rows="5" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" name="reply" class="btn btn-primary">Send Reply</button>
                    </div>
                    <a href="dashboard.php">back</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
