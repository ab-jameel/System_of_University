<?php 
include 'Classes/connect.php';

if(!(isset($_SESSION['ogrenci']) || isset($_SESSION['ogretmen']) ||  isset($_SESSION['admin'] ))){
    header("Location: login.php");
}

if(isset($_SESSION['ogrenci'])){
    header("Location: Ogrenci/index.php");
}

if(isset($_SESSION['ogretmen'])){
    header("Location: Ogretmen/index.php");
}

if(isset($_SESSION['admin'])){
    header("Location: admin/index.php");
}



?>
