<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Formdan gelen verileri al
$odev_id = $_POST['odev_id'];
$aciklama = $_POST['aciklama'];
$tarih = $_POST['tarih'];

// Dosya yükleme işlemi
if (!empty($_FILES["dosyaYukle"]["name"])) {
    $dosya_yolu = "../../../../Dosyalar/" . basename($_FILES["dosyaYukle"]["name"]);
    if (move_uploaded_file($_FILES["dosyaYukle"]["tmp_name"], $dosya_yolu)) {
        // Dosya başarıyla yüklendi, dosya_id'yi güncelle
        $dosya_adi = basename($_FILES["dosyaYukle"]["name"]);
        $sql = "INSERT INTO dosyalar (dosya_url) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dosya_adi);
        $stmt->execute();

        // Eklenen dosyanın id'sini al
        $yeni_dosya_id = $stmt->insert_id;

        // Ödev tablosundaki dosya_id ve tarih'i güncelle
        $sql = "UPDATE odevler SET aciklama=?, dosyaid=?, sonteslim=? WHERE odev_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $aciklama, $yeni_dosya_id, $tarih, $odev_id);
        $stmt->execute();

        echo "Ödev başarıyla güncellendi.";
    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
    }
} else {
    // Dosya yüklenmedi, sadece diğer verileri güncelle
    $sql = "UPDATE odevler SET aciklama=?, sonteslim=? WHERE odev_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $aciklama, $tarih, $odev_id);
    $stmt->execute();

    echo "Ödev başarıyla güncellendi.";
}
?>
