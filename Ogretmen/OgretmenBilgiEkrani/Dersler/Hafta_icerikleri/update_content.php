<?php

include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $icerik_id = $_POST['icerik_id'];
    $icerik_adi = $_POST['icerikAdi'];
    $icerik_tipi = $_POST['icerikTipi'];
    $aciklama = $_POST['aciklama'];

    // Dosya yükleme işlemi
    if (!empty($_FILES["dosyaYukle"]["name"])) {
        $dosya_yolu = "../../../../Dosyalar/" . basename($_FILES["dosyaYukle"]["name"]);
        if (move_uploaded_file($_FILES["dosyaYukle"]["tmp_name"], $dosya_yolu)) {
            // Dosya başarıyla yüklendi, dosya_url ve dosya_id'yi güncelle
            $dosya_adi = basename($_FILES["dosyaYukle"]["name"]);
            $sql = "INSERT INTO dosyalar (dosya_url) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $dosya_adi);
            $stmt->execute();

            // Eklenen dosyanın id'sini al
            $yeni_dosya_id = $stmt->insert_id;

            // Hafta icerikleri tablosundaki dosya_id'yi güncelle
            $sql = "UPDATE hafta_icerikleri SET icerik_adi=?, icerik_tipi=?, aciklama=?, dosya_id=? WHERE icerik_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $icerik_adi, $icerik_tipi, $aciklama, $yeni_dosya_id, $icerik_id);
            $stmt->execute();

            echo "İçerik başarıyla güncellendi.";
        } else {
            echo "Dosya yüklenirken bir hata oluştu.";
        }
    } else {
        // Dosya yüklenmediyse sadece diğer alanları güncelle
        $sql = "UPDATE hafta_icerikleri SET icerik_adi=?, icerik_tipi=?, aciklama=? WHERE icerik_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $icerik_adi, $icerik_tipi, $aciklama, $icerik_id);
        $stmt->execute();

        echo "İçerik başarıyla güncellendi.";
    }
}
?>
