<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Eğer duyuru_id GET parametresiyle gelmediyse veya boşsa, hata mesajı ver ve çık
if (!isset($_GET['hid']) || empty($_GET['hid'])) {
    echo "Hata: Duyuru ID belirtilmemiş.";
    exit();
}

// Duyuru ID'sini al
$duyuru_id = $_GET['hid'];

// Veritabanından duyuru bilgilerini al
$sql = "SELECT dosya_id FROM duyurular WHERE duyuru_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $duyuru_id);
$stmt->execute();
$stmt->bind_result($dosya_id);
$stmt->fetch();
$stmt->close();

// Duyuruyu sil
$sql = "DELETE FROM duyurular WHERE duyuru_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $duyuru_id);
$stmt->execute();
$stmt->close();

// Eğer duyuruya ait dosya varsa, dosya tablosundan da sil
if ($dosya_id) {
    // Dosya yolunu veritabanından al
    $sql = "SELECT dosya_url FROM dosyalar WHERE dosya_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $dosya_id);
    $stmt->execute();
    $stmt->bind_result($dosya_url);
    $stmt->fetch();
    $stmt->close();

    // Dosya tablosundan sil
    $sql = "DELETE FROM dosyalar WHERE dosya_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $dosya_id);
    $stmt->execute();
    $stmt->close();

    // Dosya sisteminden sil
    $dosya_yolu = "../../../../Dosyalar/" . $dosya_url;
    if (file_exists($dosya_yolu)) {
        unlink($dosya_yolu);
    }
}

// Yönlendirme yap veya mesaj göster
echo "Duyuru başarıyla silindi.";

exit();
?>