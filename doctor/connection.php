<?php 

$server='localhost';
$username='root';
$password='';
$db='mit';

$conn=mysqli_connect($server,$username,$password,$db);
if($conn){

}else{
	echo 'No connection'.mysqli_error($conn);
}


?>