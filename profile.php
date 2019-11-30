<?php

session_start();

if(!isset($_SESSION['username']))
	header("Location: login.php");


include "includes/db.php"; 
include "includes/class.user.php";

$userob = new user();

if(isset($_GET['username']))
	$username = trim($_GET['username']);
else
	$username  = $_SESSION['username'];


$userdetails = $userob->getUserDetails($username, $con);


include "includes/header.php";
include "includes/nav_bar.php";
?>



<?php
	include "includes/footer.php";
?>