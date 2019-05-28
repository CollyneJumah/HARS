<?php
/**
 * Created by PhpStorm.
 * User: CollinsJumah
 * Date: 4/19/2019
 * Time: 05:14
 */

$servername = "localhost";
$username = "root";
$password = "";
$db = "mit";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

?>