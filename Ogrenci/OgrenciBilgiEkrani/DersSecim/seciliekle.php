<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../../login.php");
    exit();
}

if (isset($_GET['dersid'], $_GET['dersKodu'], $_GET['dersismi'], $_GET['akts'])) {
    $ders_id = intval($_GET['dersid']);
    $ders_kodu = $_GET['dersKodu'];
    $ders_ismi = $_GET['dersismi'];
    $akts = intval($_GET['akts']); // Güvenlik için intval kullanıyoruz

    // Öğrenci id'sini oturumdan al
    $ogrenci_id = $_SESSION['ogrenci'];

    // Seçili dersi secilidersler tablosuna ekle
    $sql = "INSERT INTO secilidersler (ogrenci_id, ders_id, ders_kodu, ders_ismi, akts) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('iisss', $ogrenci_id, $ders_id, $ders_kodu, $ders_ismi, $akts);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Başarılı ekleme işlemi
            $_SESSION['success_message'] = "Ders başarıyla seçildi.";
        } else {
            // Ekleme işlemi başarısız
            $_SESSION['error_message'] = "Ders seçilirken bir hata oluştu.";
        }

        $stmt->close();
    } else {
        // SQL hazırlama hatası
        $_SESSION['error_message'] = "Bir hata oluştu. Lütfen tekrar deneyin.";
    }
} else {
    // GET parametrelerinden biri eksikse hata mesajı göster
    $_SESSION['error_message'] = "Geçersiz istek.";
}

// Ana sayfaya yönlendir
header("Location: index.php");
?>