<?php
@session_start();
require_once 'diafancallback.php';
$msg=$role='';

if(strlen($_SESSION['user'])==0)
{
    echo '<script>window.location="login.php"</script>';
}

 $show=$_SESSION['user'];
    $conn=mysqli_connect('localhost','root','','mit');
    $count=1;
    $sql="SELECT * FROM mit_account WHERE serial='$show' AND role='doctor'";

    $query = mysqli_query($conn,$sql);
    while ($row= mysqli_fetch_array($query)) {
        $email = $row['email'];
        $id = $row['id'];
        $role = $row['role'];
    }
    if($role !='doctor'){
        echo '<script>window.location="../login.php"</script>';

    }

$msg='';
if(isset($_GET['del']))
{
    require_once ('connection.php');
    mysqli_query($conn,"delete from patient where id = '".$_GET['id']."'");
    $msg = "<span class='text-danger'>Deleted one record!</span>";
}

//===============================doctor account details==================================
function doctorAccount(){
    $show=$_SESSION['user'];
    $conn=mysqli_connect('localhost','root','','mit');
    $count=1;
    $sql="SELECT * FROM mit_account WHERE serial='$show' AND role='doctor'";

    $query = mysqli_query($conn,$sql);
    while ($row= mysqli_fetch_array($query))
    {
        $email=$row['email'];
        $id=$row['id'];
        $role=$row['role'];

        ;?>
        <tr class="odd gradeX">
            <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
            <td width="10%"><?php echo $show ?></td>
            <td width="20%"><?php echo $email ?></td>
            <td width="10%"><?php echo $role ?></td>
            <td rowspan="1">
                <a href="dashboard.php?id=<?php echo $id?>" ><button type="submit" name="edit" class="btn btn-primary btn-xs" title="Edit user information"><i class="fa fa-edit fa-lg">Edit</i></button></a>
                <a href="dashboard.php?id=<?php echo $id ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" title="delete user permanently"><button type="submit" name="delete" class="btn btn-danger btn-xs">Delete<i class="fa fa-cut fa-lg"></i></button></a>
                <a href="dashboard.php?id=<?php echo $id?>" ><button type="submit" name="block" class="btn btn-warning btn-xs" title="block user"><i class="fa fa-blog-lg"></i>Block</button></a>
            </td>

        </tr>
        <?php
        $count=$count+1;
    };
}
//==========================display patient data==========================
function patientData(){
    $conn=mysqli_connect('localhost','root','','mit');
    $count=1;
    $sql="SELECT * FROM patient ORDER BY id ASC";

    $query = mysqli_query($conn,$sql);
    while ($row= mysqli_fetch_array($query))
    {

        $serial=$row['serial'];
        $id=$row['id'];
        $name=$row['name'];
        $phone=$row['phone'];
        $location=$row['location'];

        ;?>
        <tr class="odd gradeX">
            <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
            <td width="10%"><?php echo $serial ?></td>
            <td width="20%"><?php echo $name ?></td>
            <td width="15%"><?php echo $phone ?></td>
            <td width="20%"><?php echo $location ?></td>
            <td rowspan="1">
                <a href="editPatient.php?id=<?php echo $id?>" ><button type="submit" name="edit" class="btn btn-primary btn-xs" title="Edit user information"><i class="fa fa-edit fa-lg">Edit</i></button></a>
                <a href="dashboard.php?id=<?php echo $id ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" title="delete user permanently"><button type="submit" name="delete" class="btn btn-danger btn-xs">Delete<i class="fa fa-cut fa-lg"></i></button></a>
                <a href="dashboard.php?id=<?php echo $id?>" ><button type="submit" name="block" class="btn btn-warning btn-xs" title="block user"><i class="fa fa-blog-lg"></i>Block</button></a>
            </td>

        </tr>
        <?php
        $count=$count+1;
    };
}

function sendMessages(){
    $conn=mysqli_connect('localhost','root','','mit');
    $count=1;
    $sql="SELECT * FROM messagein ";

    $query = mysqli_query($conn,$sql);
    while ($row= mysqli_fetch_array($query))
    {
        $sentTime=$row['SendTime'];
        $receive=$row['ReceiveTime'];
        $from=$row['MessageFrom'];
        $to=$row['MessageTo'];
        $message=$row['MessageText'];

        ;?>
        <tr class="odd gradeX">
            <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
            <td width="10%"><?php echo $to?></td>
            <td width="10%"><?php echo $from ?></td>
            <td width="30%"><?php echo $message ?></td>
            <td width="10%"><?php echo $sentTime ?></td>
            <td width="10%"><?php echo $receive ?></td>
        </tr>
        <?php
        $count=$count+1;
    };
}
function receivedMsg(){
    $conn=mysqli_connect('localhost','root','','mit');
    $count=1;
    $sql="SELECT * FROM messageout ";

    $query = mysqli_query($conn,$sql);
    while ($row= mysqli_fetch_array($query))
    {
        $from=$row['MessageFrom'];
        $to=$row['MessageTo'];
        $message=$row['MessageText'];

        ;?>
        <tr class="odd gradeX">
            <td width="5%"><label class="label label-info"><?php echo $count ?></label></td>
            <td width="10%"><?php echo $to?></td>
            <td width="10%"><?php echo $from ?></td>
            <td width="30%"><?php echo $message ?></td>

        </tr>
        <?php
        $count=$count+1;
    };
}

//==========================================register patient============================================================
if(isset($_POST['submitPatient'])){
    require_once 'connection.php';
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
//======================================================================================================================
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Doctor Dashboard</title>
    <link rel="icon" href="../images/aids.jpg" type="image/x-icon">

    <!--    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">-->
<!--    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">-->
<!--    <script rel="script" type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>-->
<!--    <script rel="script" type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel-primary">
                <div class="panel-heading">HIV AIDS RESULTS SYSTEM</div>
                <div class="panel-body">
                        <h2>Doctor's Dashboard</h2>
                    <span><?php echo $msg ?></span>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                            <li><a data-toggle="tab" href="#menu1">Account</a></li>
                            <li><a data-toggle="tab" href="#menu3">Patients data</a></li>
                            <li><a data-toggle="tab" href="#menu4">Message</a></li>
                            <li><a data-toggle="tab" href="#menu5">Sent Messages</a></li>
                            <li><a data-toggle="tab" href="#menu6">Received Reponses</a></li>

                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <h3>HOME</h3>
                                <div class="panel-primary">
                                    <div class="panel-header">
                                        <span>Welcome: <?php echo $email?> | <a href="../signOut.php" target="_blank">Sign out</a> </span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3 card">
                                                <img class="card-img-top img-responsive img-circle" height="150" width="150" src="../images/doc1.jpg">
                                                <div class="card-body text-justify">Patients with HIV infection:
                                                    Carry a complex disease which can be a great mimic of other illness. However,
                                                    advances such as early treatment with antiretroviral therapy (ART) and effective treatment of
                                                    opportunistic infections have improved prognosis considerably in recent years.
                                                </div>

                                            </div>
                                            <hr>
                                            <div class=" card col-md-6">
                                                <div class="card-body">
                                                    <p class="text-justify">Management of HIV-positive individuals in primary care
                                                        With the increased survival of patients treated with ART, the management of HIV in primary care has become much the same as for any other long-term condition. Shared care with local specialist clinics is becoming increasingly common. Guidelines for primary care teams have been produced by the Medical Foundation for AIDS and Sexual Health (MedFASH).[11]

                                                        GPs and their teams should consider the following aspects of care:

                                                        Emotional aspects
                                                        It is important when dealing with medical aspects of sexual health and the presence of
                                                        HIV infection that practitioners be sensitive to the emotive nature of all aspects
                                                        of care. Newly diagnosed patients are likely to need much emotional support. Some may have
                                                        been unaware of their risk until diagnosed (eg, during antenatal screening).

                                                        Health promotion
                                                        As with any other chronic disease, measures to maximise health are important.
                                                        Issues may include:
                                                        Cardiovascular disease prevention: for reasons unknown, patients with HIV are at
                                                        increased risk. ART can increase the risk of diabetes and dyslipidaemia.
                                                        Cervical screening: women with HIV are more prone to human papillomavirus-related
                                                        diseases and should have annual screening smears.
                                                        Immunisation (adults)
                                                        Annual influenza.
                                                        Hepatitis B testing and immunisation where appropriate.
                                                        Hepatitis A immunisation for MSM.
                                                        Pneumococcal vaccination.<img class="card-img img-responsive" style="float: left" height="150" width="150" src="../images/doc3.jpg">
                                                        Reproductive and sexual health
                                                        Primary care teams should be supportive, uncritical and non-prejudiced. Safe sex advice should be provided at
                                                        appropriate opportunities; this may include provision of condoms and lubricants or advice as to where
                                                        these can be obtained according to local protocols.
                                                        HIV-positive patients should be under regular review and have:
                                                        Sexual health assessment at diagnosis and six-monthly.
                                                        Access to staff trained to carry out such sexual history and sexual health assessment.
                                                        Access to high-quality counselling and support to ensure good sexual health and to maintain
                                                        protective behaviours.
                                                        Offer of full annual sexual health screen (regardless of reported history).
                                                        Documented local care pathways for diagnosis, treatment and partner work for sexually
                                                        transmitted infections (which are actively communicated to all members of clinic staff).
                                                        <img class="card-img img-responsive" style="float: right" height="150" width="150" src="../images/doc4.jpg">
                                                        Confidentiality

                                                        Confidentiality is as important for HIV patients as it is for all other patients.
                                                        HIV status is a particularly sensitive piece of information and patients will have additional concerns
                                                        about confidentiality. It is worth discussing this with the patient and the practice to agree a policy.
                                                        There is a need to have readily available information (eg, CD4 counts, ART) whilst at the same time ensuring
                                                        that such data are only accessed on a need-to-know basis. MedFASH and the General Medical Council (GMC) have both
                                                        produced guidance on this issue. It is preferable that any clinician who treats the patient be aware
                                                        of the diagnosis. These considerations have implications for:

                                                        Medical records:
                                                        It is important to consider how and where to record the diagnosis in the patient's computer record.
                                                        Needless to say, written or Lloyd George records should not have a sticker saying HIV or AIDS on the front of the envelope!
                                                        Staff confidentiality:

                                                    </p>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-md-3">
                                                <img class="card-img img-responsive" height="150" width="150" src="../images/doc2.jpg">
                                                <div class="card-body">
                                                    <p>
                                                        Staff confidentiality:
                                                        Doctors should set an example by maintaining confidentiality and an appropriate attitude towards affected patients.
                                                        Doctors and nurses should know but receptionists do not have to.
                                                        Reception staff may get to know.
                                                        Education of staff about confidentiality and HIV may be appropriate.
                                                        Advice to the patient:
                                                        Share information or policies on confidentiality within the practice.
                                                        Discuss record keeping and sharing of information with outside agencies.
                                                        Encourage appropriate sharing of information with dental and other professional colleagues.
                                                        Discuss any implications for their workplace.
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <h3>Doctors account details</h3>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Serial No.</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <?php doctorAccount(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <h3>Manage Patients Data</h3>
                                <button type="button" class="btn btn-primary bt-sm" data-toggle="modal" data-target="#myModal">
                                    Add patient
                                </button>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Serial No.</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php patientData(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="menu4" class="tab-pane fade">
                                <h3>Send Message</h3>
                                <div class="panel-primary">
                                    <div class="panel-heading">
                                        <h5 class="text-center">Send message to Patient</h5>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" action="diafancallback.php" method="POST">
                                            <div class="form-group">
                                                <?php
                                                require_once ('connection.php');
                                                $sql='SELECT * FROM patient ORDER BY id ASC ';
                                                $results=mysqli_query($conn,$sql);
                                                ?>
                                                <label  class="control-label col-sm-4"  for="sel1">Recipient:</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control text-center" name="MessageTo" id="sel1" required>
                                                        <option value="">--Select--Recipient--</option>
                                                        <<?php while ($row=mysqli_fetch_array($results)):;?>
                                                            <option  value="<?php echo $row[3];?>"><?php echo $row[3];?></option>
                                                        <?php endwhile;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="message">Message</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" id="message" name="MessageText" cols="5" rows="5" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-4">
                                                    <button type="submit" name="send" class="btn btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                        </div>
                            </div>

                                <div id="menu5" class="tab-pane fade">
                                    <h3>Send Messages</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>To</th>
                                                <th>From</th>
                                                <th>Message</th>
                                                <th>Sent Time</th>
                                                <th>Received Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php sendMessages(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <div id="menu6" class="tab-pane fade">
                                <h3>Responses</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>To</th>
                                            <th>From</th>
                                            <th>Message</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php receivedMsg(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add patients</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <span><?php echo $msg ?></span>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form-horizontal" action="dashboard.php"method="post" autocomplete="off">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="name">Full Name:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter  full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd">ID No.:</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="serial" id="idNo" placeholder="Enter Id Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd">Phone Number.:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" onclick="showPhone()" name="phone" id="phone" placeholder="Enter Phone">
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
                                <button type="submit" name="submitPatient" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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