<?php
/**
 * Created by PhpStorm.
 * User: CollinsJumah
 * Date: 4/19/2019
 * Time: 12:02
 */

require_once('connection.php');
session_start();
//unset($_SESSION['login']);
unset($_SESSION['user']);
unset($_SESSION['role']);
session_destroy();
header('location:login.php');
?>