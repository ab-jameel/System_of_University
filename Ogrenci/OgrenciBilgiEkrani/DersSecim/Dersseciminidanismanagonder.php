<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../../login.php");
    exit();
}

$sql = "SELECT * FROM secilidersler WHERE ogrenci_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['ogrenci']);
$stmt->execute();
$result = $stmt->get_result();

$sql6 = "SELECT SUM(akts) AS 'TOPLAMAKTS' FROM secilidersler WHERE ogrenci_id=?";
$stmt6 = $conn->prepare($sql6);
$stmt6->bind_param('i', $_SESSION['ogrenci']);
$stmt6->execute();
$result6 = $stmt6->get_result();
$seciliAkts = $result6->fetch_assoc();
if($seciliAkts['TOPLAMAKTS']>45 ||  $seciliAkts['TOPLAMAKTS']==0){
    $_SESSION['aktsHata']='hata';
    header("Location: index.php");
    exit();
}
while ($row = $result->fetch_assoc()) {
    $sqlInsert = "INSERT INTO kayit (Ders_id, Dersi_alan_ogrenci_id, Vize, final, Butunleme, kayit_tarihi, active) VALUES (?, ?, 0, 0, 0, NOW(), 0)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param('ii', $row['ders_id'], $_SESSION['ogrenci']);
    $stmtInsert->execute();
}

// Seçili dersleri temizle
$sqlDelete = "DELETE FROM secilidersler WHERE ogrenci_id=?";
$stmtDelete = $conn->prepare($sqlDelete);
$stmtDelete->bind_param('i', $_SESSION['ogrenci']);
$stmtDelete->execute();
$_SESSION['danisman_onayinda']='danismanonayında';
header("Location: index.php");
?>