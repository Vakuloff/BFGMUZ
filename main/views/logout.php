<?php 
session_start();
session_unset();
unset($_SESSION['age']);

session_destroy();

$url = 'index.php';
header("Location: $url");
 ?>