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
$ogretmenAdi = '';
$ogretmenSoyadi = '';
$ogretmenTC = '';
$ogretmenEmail = '';
$ogretmenPassword = '';


if (isset($_POST['save'])){
	$ogretmenAdi = $_POST['ogretmenAdi'];
	$ogretmenSoyadi = $_POST['ogretmenSoyadi'];
	$ogretmenTC = $_POST['ogretmenTC'];
	$ogretmenEmail = $_POST['ogretmenEmail'];
	$ogretmenPassword = $_POST['ogretmenPassword'];

    $conn->query("INSERT INTO Ogretmenler (ad, soyad, email, `password`, tc, dosya_id) VALUES ('$ogretmenAdi', '$ogretmenSoyadi', '$ogretmenEmail', '$ogretmenPassword', '$ogretmenTC',0)");
    header("Location: ../Ogretmenler/index.php");
}

if (isset($_GET['delete'])){
	$id=$_GET['delete'];
	$conn->query("DELETE FROM Ogretmenler WHERE ogretmen_id=$id");
	header("Location: ../index.php");
}

if (isset($_GET['edit'])){
	$id=$_GET['edit'];
	$update = true;
	$result=$conn->query("SELECT * FROM Ogretmenler WHERE ogretmen_id=$id");
	if (empty($result)){
	}else{
		$row = $result->fetch_array();
        $ogretmenAdi = $row['ad'];
        $ogretmenSoyadi = $row['soyad'];
        $ogretmenTC = $row['tc'];
        $ogretmenEmail = $row['email'];
        $ogretmenPassword = $row['password'];
	}
}

if (isset($_POST['update'])){
	$id = $_POST['Ogretmenid'];
	$ogretmenAdi = $_POST['ogretmenAdi'];
	$ogretmenSoyadi = $_POST['ogretmenSoyadi'];
	$ogretmenTC = $_POST['ogretmenTC'];
	$ogretmenEmail = $_POST['ogretmenEmail'];
	$ogretmenPassword = $_POST['ogretmenPassword'];

    $conn->query("UPDATE Ogretmenler SET ad='$ogretmenAdi', soyad='$ogretmenSoyadi', tc='$ogretmenTC', email='$ogretmenEmail', `password`='$ogretmenPassword' WHERE ogretmen_id=$id");
    header("Location:../Ogretmenler/index.php");
}


?>