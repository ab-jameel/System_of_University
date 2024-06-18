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
$dersKodu = '';
$dersinIsmi = '';
$dersiVerenOgretmen = '';
$donem = '';
$AKTS = '';
$Kredi = '';
$dersTuru = '';
$limiti = '';


if (isset($_POST['save'])){
	$dersKodu = $_POST['dersKodu'];
	$dersinIsmi = $_POST['dersinIsmi'];
	$dersiVerenOgretmen = $_POST['dersiVerenOgretmen'];
	$donem = $_POST['donem'];
	$AKTS = $_POST['AKTS'];
	$Kredi = $_POST['Kredi'];
	$dersTuru = $_POST['dersTuru'];
	$limiti = $_POST['limit'];

    $conn->query("INSERT INTO Dersler (Ders_kodu, Ders_ismi, dersi_veren_ogretmen_id, donem, akts, kredi, Ders_turu, `limit`) VALUES ('$dersKodu', '$dersinIsmi', '$dersiVerenOgretmen', '$donem', '$AKTS', '$Kredi', '$dersTuru', '$limiti')");
    header("Location: ../Dersler/index.php");
}

if (isset($_GET['delete'])){
	$id=$_GET['delete'];
	$conn->query("DELETE FROM Dersler WHERE Ders_id=$id");
	header("Location: ../index.php");
}

if (isset($_GET['edit'])){
	$id=$_GET['edit'];
	$update = true;
	$result=$conn->query("SELECT * FROM Dersler WHERE Ders_id=$id");
	if (empty($result)){
	}else{
		$row = $result->fetch_array();
        $dersKodu = $row['Ders_kodu'];
        $dersinIsmi = $row['Ders_ismi'];
        $dersiVerenOgretmen = $row['dersi_veren_ogretmen_id'];
        $donem = $row['donem'];
        $AKTS = $row['akts'];
        $Kredi = $row['kredi'];
        $dersTuru = $row['Ders_turu'];
        $limiti = $row['limit'];
	}
}

if (isset($_POST['update'])){
	$id = $_POST['Dersid'];
	$dersKodu = $_POST['dersKodu'];
	$dersinIsmi = $_POST['dersinIsmi'];
	$dersiVerenOgretmen = $_POST['dersiVerenOgretmen'];
	$donem = $_POST['donem'];
	$AKTS = $_POST['AKTS'];
	$Kredi = $_POST['Kredi'];
	$dersTuru = $_POST['dersTuru'];
	$limiti = $_POST['limit'];

    $conn->query("UPDATE Dersler SET Ders_kodu='$dersKodu', Ders_ismi='$dersinIsmi', dersi_veren_ogretmen_id='$dersiVerenOgretmen', donem='$donem', akts='$AKTS', kredi='$Kredi', Ders_turu='$dersTuru', `limit`='$limiti' WHERE Ders_id=$id");
    header("Location:../Dersler/index.php");
}


?>