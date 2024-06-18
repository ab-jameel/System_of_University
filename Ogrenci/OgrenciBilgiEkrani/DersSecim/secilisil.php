<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Güvenlik için intval kullanıyoruz

    // Öğrenci id'sini oturumdan al
    

    // Seçili dersi sil
    $sql = "DELETE FROM secilidersler WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Başarılı silme işlemi
            $_SESSION['success_message'] = "Ders başarıyla silindi.";
        } else {
            // Silme işlemi başarısız
            $_SESSION['error_message'] = "Ders silinirken bir hata oluştu veya ders bulunamadı.";
        }

        $stmt->close();
    } else {
        // SQL hazırlama hatası
        $_SESSION['error_message'] = "Bir hata oluştu. Lütfen tekrar deneyin.";
    }
} else {
    // id parametresi yoksa hata mesajı
    $_SESSION['error_message'] = "Geçersiz istek.";
}
header("Location: index.php");
?>