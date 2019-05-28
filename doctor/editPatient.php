<?php
@session_start();
include('connection.php');

$id='';
if(strlen($_SESSION['user'])==0)
{
    header('location:../login.php');
}
else{
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $currentTime = date( 'd-m-Y h:i:s A', time () );

    if(isset($_POST['submitUpdate'])) {

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $location= $_POST['location'];
        $serial = $_POST['serial'];
        $id = intval($_GET['id']);
        $sql =mysqli_query($conn,"update patient set name='$name',phone='$phone',serial='$serial',location='$location' where id='$id'");
        $_SESSION['msg'] = "Member data updated. Redirecting back please wait...".mysqli_error($conn);
        echo "<script> setTimeout(function () {
             window.location.href= 'dashboard.php'; // the redirect goes here
             },3000);</script>";

    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <!-- Bootstrap Select Css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="icon" href="../images/aids.jpg" type="image/x-icon">

    </head>
<body>
    <div class="container-fluid">
        <div class="panel-primary">
            <div class="panel-heading">
                <h5 class="text-center">Update patients' data</h5>
                <img src="../images/hiv.jpg" class="img-responsive center-block" width="100" height="100">
            </div>

                        <div class="panel-body">
                            <div class="card card-panel">
                                <div class="body">


                                    <?php if(isset($_POST['submitUpdate']))
                                    {?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                        </div>
                                    <?php } ?>

                                    <br />

                                    <form class="form-horizontal" action="editPatient.php" enctype="multipart/form-data" name="edit_members" method="post" >
                                        <?php
                                        $id=intval($_GET['id']);
                                        $query=mysqli_query($conn,"select * from patient where id='$id'");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                            ?>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="name">Full Name:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="name" value="<?php echo htmlentities($row['name']);?>" id="name" placeholder="Enter  full Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="pwd">ID No.:</label>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" value="<?php echo htmlentities($row['serial']);?>" name="serial" id="idNo" placeholder="Enter Id Number">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="pwd">Phone Number.:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($row['phone']);?>" name="phone" id="phone" placeholder="Enter Phone">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="control-label col-sm-4"  for="sel1">Location:</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="location" id="sel1">
                                                        <option value="<?php echo htmlentities($row['location']);?>"><?php echo htmlentities($row['location']);?></option>
                                                        <option>Kisii County</option>
                                                        <option>Nairobi County</option>
                                                        <option>Kiambu County</option>
                                                        <option>Mombasa County</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-4">
                                                    <button type="submit" name="submitUpdate" class="btn btn-primary">Update</button>
                                                </div>
                                                <a href="dashboard.php">Back</a>
                                            </div>

                                        <?php } ?>
                                    </form>

                                </div>
                            </div>



                        </div>

                    </div>
                </div>


    </body>

    </html>
<?php } ?>