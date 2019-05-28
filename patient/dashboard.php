<?php
/**
 * Created by PhpStorm.
 * User: CollyneJumah
 * Date: 01/08/2019
 * Time: 14:29
 */
//require_once ('userSidebar.php');
@session_start();
//$_SESSION['user']='';
if(strlen($_SESSION['user'])==0)
{
    echo '<script>window.location="../login.php"</script>';
}
$username=$email=$photo=$phone1=$msg='';
include('../connection.php');
$show=$_SESSION['user'];

$sql1="SELECT * FROM mit_account WHERE serial='".$show."'";

$query1=mysqli_query($conn,$sql1);

while($row1=mysqli_fetch_array($query1)) {
    $serial = $row1['serial'];
    $email=$row1['email'];

}
//===============================display patients account=====================================
           function patientAccount(){
               $show=$_SESSION['user'];
               $conn=mysqli_connect('localhost','root','','mit');
               $count=1;
               $sql="SELECT * FROM mit_account WHERE serial='$show'";

               $query = mysqli_query($conn,$sql);
               while ($row= mysqli_fetch_array($query))
               {
                   $email=$row['email'];
                   $role=$row['role'];

                   ;?>
                   <tr class="odd gradeX">
                       <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
                       <td width="10%"><?php echo $show ?></td>
                       <td width="20%"><?php echo $email ?></td>
                       <td width="10%"><?php echo $role ?></td>
                   </tr>
                   <?php
                   $count=$count+1;
               };
           }
function message(){
    $show=$_SESSION['user'];
    $from=$to=$message='';
    $conn=mysqli_connect('localhost','root','','mit');
    $count=1;
    $sql="SELECT * FROM patient WHERE serial='$show'";

        $query = mysqli_query($conn,$sql);
        while ($row= mysqli_fetch_array($query))
        {
            $phone=$row['phone'];

            $sqlMs="SELECT * FROM messagein WHERE MessageTo='$phone'";
            $queryMS = mysqli_query($conn,$sqlMs);
            while ($rowMs=mysqli_fetch_array($queryMS)){
                $id=$rowMs['Id'];
                $from=$rowMs['MessageFrom'];
                $to=$rowMs['MessageTo'];
                $message=$rowMs['MessageText'];

            }
        ;?>
        <tr class="odd gradeX">
            <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
            <td width="10%"><?php echo $from ?></td>
            <td width="10%"><?php echo $to ?></td>
            <td width="30%"><?php echo $message?></td>
            <td rowspan="1">
                <a href="reply.php?id=<?php echo $id?>" ><button type="submit" name="edit" class="btn btn-primary btn-xs" title="Edit user information"><i class="fa fa-edit fa-lg">Reply</i></button></a>
            </td>
        </tr>
        <?php
        $count=$count+1;
    };
}

//===================================end-==============patient account=============================================


//=================================register patient and save data in db============================================
    if(isset($_POST['register'])){
        $serialR=mysqli_real_escape_string($conn,$_POST['serial']);
        $nameR=mysqli_real_escape_string($conn,$_POST['name']);
        $phoneR=mysqli_real_escape_string($conn,$_POST['phone']);
        $locationR=mysqli_real_escape_string($conn,$_POST['location']);

        $sqlR="INSERT INTO `patient`(`serial`, `name`, `phone`, `location`) VALUES ('$serialR','$nameR','$phoneR','$locationR')";
        $resultR=mysqli_query($conn,$sqlR);
        if($resultR){
             $msg='<div class="alert alert-success">
<strong>Success!</strong> Success data saved.
</div> ';
        }else{
            $msg='<div class="alert alert-danger">
<strong>Error!</strong> Occurred while saving data.Please try again.
</div> ';
        }
    }
//==========================================end register patient===================================================
$sqlDR="SELECT * FROM patient WHERE serial='".$show."'";

$queryDR=mysqli_query($conn,$sqlDR);

while($rowDR=mysqli_fetch_array($queryDR)) {
    $serialDR = $rowDR['serial'];
    $nameDR=$rowDR['name'];
    $phoneDR=$rowDR['phone'];
    $locationDR=$rowDR['location'];
}
//=================update patient details=========================
if(isset($_POST['update'])){
    $nameUR=mysqli_real_escape_string($conn,$_POST['name']);
    $phoneUR=mysqli_real_escape_string($conn,$_POST['phone']);
    $locationUR=mysqli_real_escape_string($conn,$_POST['location']);

    $sqlUR="UPDATE `patient` SET `name`='$nameUR',`phone`='$phoneUR',`location`='$locationUR' WHERE serial='$serial'";
    $resultUR=mysqli_query($conn,$sqlUR);
    if($resultUR){
        $msg='<div class="alert alert-success">
<strong>Success!</strong> Data updated.
</div> ';
        echo '<script>setTimeout(function() {
  window.location.href="dashboard.php";
},2000)</script>';
    }else{
        $msg='<div class="alert alert-danger">
<strong>Error!</strong> Occurred while updating data.Please try again.
</div> ';
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Patients' Dashboard</title>
    <link rel="icon" href="../images/aids.jpg" type="image/x-icon">

    <!--    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">-->
    <!--    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">-->
    <!--    <script rel="script" type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>-->
    <!--    <script rel="script" type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <!-- Add icon library -->
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel-primary">
                <div class="panel-heading text-center">HIV AIDS RECORD SYSTEM
                </div>
                <div class="panel-body">
                    <h2>Patients's Dashboard</h2>
                    <span><?php echo $msg ?></span>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                        <li><a data-toggle="tab" href="#menu1">Account</a></li>
                        <li><a data-toggle="tab" href="#register">Registration</a></li>
                        <li><a data-toggle="tab" href="#menu2">Patients Details</a></li>
                        <li><a data-toggle="tab" href="#menu4">Hospitals</a></li>
                        <li><a data-toggle="tab" href="#menu3">Messages</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
<!--  ============================== =========================HOME TAB-========================================-->
                            <h3>HOME</h3>
                            <span>Welcome: <?php echo $email?> | <a href="../signOut.php" target="_blank">Sign out</a> </span>
                            <div class="row">
                                <hr>
                                <div class="col-md-3 card">
                                    <img class="card-img-top img-responsive" height="150" width="150" src="../images/hivLogo.jpg">
                                    <div class="card-body text-justify">
                                        As we know very well, in the world today, movement of people from one region to another has escalated
                                        considerably owing to various unforeseen reasons. Economic pursuit had in the past been the major
                                    </div>
                                </div>
                                <hr>
                                <div class=" card col-md-3">
                                    <div class="card-body">
                                        <p class="text-justify">HIV stands for human immunodeficiency virus, which is the virus that causes HIV infection. The abbreviation “HIV” can refer to the virus or to HIV infection.
                                            AIDS stands for acquired                                        <img class="card-img img-responsive" style="float: left" height="150" width="150" src="../images/hiv.jpg">
                                            immunodeficiency syndrome. AIDS is the most advanced stage of HIV infection.
                                            HIV attacks and destroys the infection-fighting CD4 cells of the immune system. The loss of CD4 cells makes it difficult for the body to fight infections
                                            and certain cancers. Without treatment, HIV can gradually destroy the immune system and advance to AIDS.</p>

                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-3">
                                    <img class="card-img img-responsive" height="150" width="150" src="../images/aids.jpg">
                                    <div class="card-body">
                                        <p>
                                            HIV is spread through contact with certain body fluids from a person with HIV. These body fluids include:
                                            <ul>
                                            <li>Blood</li>
                                            <li>Semen</li>
                                            <li>Pre-seminal fluid</li>
                                            <li>Vaginal fluids
                                            <li> Rectal fluids</li>
                                            <li>Breast milk</li>
                                        </ul>

                                            The spread of HIV from person to person is called HIV transmission. The spread of HIV from a woman with
                                            HIV to her child during pregnancy, childbirth, or breastfeeding is called mother-to-child transmission of HIV.
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-3">
                                    <img class="card-img img-responsive" height="150" width="150" src="../images/awarenes.png">

                                    <div class="card-body">
                                        <p>To reduce your risk of HIV infection, use condoms correctly every time you have sex, limit your number of sexual partners, and never share injection drug equipment. Also talk to your health care provider about pre-exposure prophylaxis (PrEP). PrEP is an HIV prevention option for people who don’t have HIV but who are at high risk of becoming infected with HIV.
                                            PrEP involves taking a specific HIV medicine every day. For more information, read the AIDSinfo fact sheet on PrEP.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- ==================================================Patient Account=======================================================-->
                        <div id="menu1" class="tab-pane fade">
                            <h3>Patient account details</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Serial No.</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    patientAccount();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- -=====================================Patient details===========================================================-->
                        <div id="menu2" class="tab-pane fade">
                            <h3>Patients Details</h3>
                            <form class="form-horizontal" action="dashboard.php" method="post">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="name">Full Name:</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="<?php echo $nameDR ?>" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">ID No.:</label>
                                    <div class="col-sm-6">
                                        <input type="number" value="<?php echo $serial ?>" class="form-control" name="serial" id="idNo" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Phone Number.:</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="<?php echo $phoneDR ?>" class="form-control" name="phone" id="phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="control-label col-sm-4"  for="sel1">Location:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="location" id="sel1">
                                            <option><?php echo $locationDR ?></option>
                                            <option>Kisii County</option>
                                            <option>Nairobi County</option>
                                            <option>Kiambu County</option>
                                            <option>Mombasa County</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-4">
                                        <button type="submit" name="update" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
<!-- ==========================================Messages==============================================================-->
                        <div id="menu3" class="tab-pane fade">
                            <h3>Received Messages</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                <?php message() ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

<!--==============================================Patient Registration  tab========================================-->
                        <div id="register" class="tab-pane fade">
                            <h3></h3>
                            <div class="panel-primary">
                                <div class="panel-heading">
                                    <h5 class="text-center">Register here as a patient</h5>
                                    <img src="../images/hiv.jpg" class="img-responsive center-block" width="80" height="50">
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="dashboard.php" autocomplete="off">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="name">Full Name:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter full Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="pwd">ID No.:</label>
                                            <div class="col-sm-6">
                                                <input type="number"  value="<?php echo $serial ?>" class="form-control" name="serial" id="idNo" placeholder="Enter Id Number" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="pwd">Phone Number.:</label>
                                            <div class="col-sm-6">
                                                <input type="text" onclick="showPhone()" class="form-control" name="phone" id="phone" placeholder="+2547">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label col-sm-4"  for="sel1">Location:</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="location" id="sel1">
                                                    <option>Kisii County</option>
                                                    <option>Nairobi County</option>
                                                    <option>Kiambu County</option>
                                                    <option>Mombasa County</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-4">
                                                <button type="submit" name="register" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
<!-- ============================================hospital lists======================================================-->
                        <div id="menu4" class="tab-pane fade">
                            <div class="panel-primary">
                                <div class="panel-heading">
                                    Available hospitals in Western Region
                                </div>
                                <div class="panel-body">

                                        <h4 class="text-center">You can visit nearby hospital for consultation</h4>
                                    <hr>
                                   <div class="col-md-2">
                                       <div class="card">
                                           <div class="card-header text-center text-primary"><strong>South Nyanza Region</strong></div>
                                          <hr>
                                           <div class="card-body">
                                               <ol type="i">
                                                   <li>Kisii Level 5 Hospital</li>
                                                   <li>Neema Hospital</li>
                                                   <li>Chriatamarrian Hlspital</li>
                                                   <li>Gendia Hospital</li>

                                               </ol>
                                           </div>
                                           <hr>
                                       </div>
                                   </div>
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center text-primary"><strong>Nyanza Region</strong></div>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <ol type="1">

                                                <li>Aga Khan Hospital	</li>
                                                <li>Nyanza Provincial Hospital</li>
                                                <li>Avenue Hospital</li>
                                                <li>Kilimani Hospital</li>
                                            </ol>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center text-primary"><strong>Western Region</strong></div>
                                            <hr>
                                            <div class="card-body">
                                                <ol type="1">

                                                    <li>Iguhu Dist Hospital	</li>
                                                    <li>Ijara Dist Hospital</li>
                                                    <li>Avenue Hospital</li>
                                                    <li>Vihiga Dist hospital</li>
                                                </ol>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center text-primary"><strong>Kakamega Region</strong></div>
                                            <hr>
                                            <div class="card-body">
                                                <ol type="1">

                                                    <li>Iguhu Dist Hosp	</li>
                                                    <li>Webuye Dist Hosp</li>
                                                    <li>Webuye Nursing
                                                        Home</li>
                                                    <li>Vihiga Dist 5 hosp</li>
                                                </ol>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center text-primary"><strong>Migori</strong></div>
                                            <hr>
                                            <div class="card-body">
                                                <ol type="1">

                                                    <li>Migori Dist Hosp	</li>
                                                    <li>WChendwa Dist Hosp</li>
                                                    <li>Runyenjes Dist Hosp</li>
                                                    <li>Vihiga Dist 5 hosp</li>
                                                </ol>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center text-primary"><strong>HomaBay</strong></div>
                                            <hr>
                                            <div class="card-body">
                                                <ol type="1">

                                                    <li>Homabay Dist Hosp	</li>
                                                    <li>The County  Hosp</li>
                                                    <li>Mumias Maternity
                                                        and Nursing Home</li>
                                                </ol>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="text-center">
                        Let's spread this by sharing:
                        Follow us on:
                        <!-- Add font awesome icons -->
                        <a href="https://www.facebook.com/stories/kadogokenya/" target="_blank" class="fa fa-facebook"></a>
                        <a href="https://twitter.com/@kadogokenya"  target="_blank" class="fa fa-twitter"></a>
                        <a href="https://www.instagram.com/kadogo_kenya_/" target="_blank" class="fa fa-instagram"></a>
                        <a href="https://youtube.com" target="_blank" class="fa fa-youtube"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function showPhone() {
        document.getElementById('phone').value='+2547';
    }
</script>