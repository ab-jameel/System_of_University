<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "ubys";

$conn = new mysqli($host, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

$update = false;
$id = 0;
$togrenciAdi = '';
$togrenciSoyadi = '';
$ogrenciTC = '';
$ogrenciEmail = '';
$ogrenciPassword = '';
$donem = '';
$ogrenciDanisman = '';



if (isset($_POST['save'])){
	$togrenciAdi = $_POST['togrenciAdi'];
	$togrenciSoyadi = $_POST['togrenciSoyadi'];
	$ogrenciTC = $_POST['ogrenciTC'];
	$ogrenciEmail = $_POST['ogrenciEmail'];
	$ogrenciPassword = $_POST['ogrenciPassword'];
	$ogrenciDanisman = $_POST['ogrenciDanisman'];
    $donem = $_POST['donem'];

    $conn->query("INSERT INTO Ogrenciler (ad, soyad, tc, email, `password`, Danisman_ogretmen_id, donem, dosya_id) VALUES ('$togrenciAdi', '$togrenciSoyadi', '$ogrenciTC', '$ogrenciEmail', '$ogrenciPassword', '$ogrenciDanisman', '$donem',0)");
    header("Location: ../Ogrenciler/index.php");
}

if (isset($_GET['delete'])){
	$id=$_GET['delete'];
	$conn->query("DELETE FROM Ogrenciler WHERE ogrenci_no=$id");
	header("Location: ../index.php");
}

if (isset($_GET['edit'])){
	$id=$_GET['edit'];
	$update = true;
	$result=$conn->query("SELECT * FROM Ogrenciler WHERE ogrenci_no=$id");
	if (empty($result)){
	}else{
		$row = $result->fetch_array();
        $togrenciAdi = $row['ad'];
        $togrenciSoyadi = $row['soyad'];
        $ogrenciTC = $row['tc'];
        $ogrenciEmail = $row['email'];
        $ogrenciPassword = $row['password'];
        $ogrencidonem = $row['donem'];
        $ogrenciDanisman = $row['Danisman_ogretmen_id'];
	}
}

if (isset($_POST['update'])){
	$id = $_POST['Ogrenciid'];
	$togrenciAdi = $_POST['togrenciAdi'];
	$togrenciSoyadi = $_POST['togrenciSoyadi'];
	$ogrenciTC = $_POST['ogrenciTC'];
	$ogrenciEmail = $_POST['ogrenciEmail'];
	$ogrenciPassword = $_POST['ogrenciPassword'];
	$ogrenciDanisman = $_POST['ogrenciDanisman'];
    $donem = $_POST['donem'];

    $conn->query("UPDATE Ogrenciler SET ad='$togrenciAdi', soyad='$togrenciSoyadi', tc='$ogrenciTC', email='$ogrenciEmail', `password`='$ogrenciPassword', Danisman_ogretmen_id='$ogrenciDanisman', donem='$donem' WHERE ogrenci_no=$id");
    header("Location:../Ogrenciler/index.php");
}


?>