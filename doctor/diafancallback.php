<?php
require_once 'dashboard.php';
$msg='';

//capturing the message and the sender from the web connector for diafaan
if (isset($_POST['send'])) {
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'mit');
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $replyMessage=''; //variable to hold the message

    //Check DB connection
    if (mysqli_connect_errno()) {
        $replyMessage= "System is currently experiencing an error";
    }
    $from='+254790366848';
    $to = $_POST['MessageTo'];
    $receivedMessage = $_POST["MessageText"];

    if(!$from){die();} //if the from is not a number (eg Provider name), just exit
    //save the message for audit purpose
    $query = mysqli_query($conn, "insert into messageIn(SendTime,MessageFrom,MessageTo,MessageText) values(now(),'$from','$to','$receivedMessage')");

    //getting the first character to determine if it is a Boda registration number
    $firstCharacter = $receivedMessage[0];
    if($query){
        echo "Message sent successfully";
    }else{
       echo "No message sent".mysqli_error($conn);
    }

    //query the registration details in-case the first letter begins with K

//        $replyMessage = "Dear Customer, the message does not contain a valid registration number";

//    $msgtype='';
//    $query = mysqli_query($conn, "insert into messageout(MessageTo,MessageText,MessageType) values('$FROM','$replyMessage','$msgtype')");

}


?>