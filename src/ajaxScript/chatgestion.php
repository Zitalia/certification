<?php
include('../../Modele/modele.php');

$message = $_GET['message'];
$nameuser = htmlspecialchars($_SESSION['name']);
$date = date('Y-m-d');

if (isset($message)){
    insertmessage($nameuser, $message);
    echo "<p>$date $nameuser - $message </p>" ;
};


