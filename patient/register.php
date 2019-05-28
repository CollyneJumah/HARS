<?php
/**
 * Created by PhpStorm.
 * User: CollinsJumah
 * Date: 4/19/2019
 * Time: 07:42
 */
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
            <h5 class="text-center"></h5>
            <img src="../images/hiv.jpg" class="img-responsive center-block" width="100" height="100">
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="register.php">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Full Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="pwd">ID No.:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="idNo" id="idNo" placeholder="Enter Id Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="pwd">Phone Number.:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-sm-4"  for="sel1">Location:</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="sel1">
                            <option>Kisii County</option>
                            <option>Nairobi County</option>
                            <option>Kiambu County</option>
                            <option>Mombasa County</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
