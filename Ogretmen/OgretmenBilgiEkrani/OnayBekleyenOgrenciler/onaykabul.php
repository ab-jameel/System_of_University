<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../login.php");
    exit();
}
?>



<?php

if (isset($_GET['id'])) {
    $ogrenci_id = $_GET['id'];

    // İlk olarak ilgili öğrencinin aktif olmayan tüm kayıtlarını seçiyoruz
    $sqlSelect = "SELECT * FROM kayit WHERE active = 0 AND Dersi_alan_ogrenci_id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $ogrenci_id);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    // Sonra bu kayıtları güncellemek için döngü ile tüm sonuçları işliyoruz
    while ($row = $result->fetch_assoc()) {
        $kayit_id = $row['kayit_id'];

        // Kayıtları güncelleme sorgusu
        $sqlUpdate = "UPDATE kayit SET active = 1 WHERE kayit_id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("i", $kayit_id);
        $stmtUpdate->execute();
    }

    // İşlem tamamlandıktan sonra bir geri bildirim mesajı veya yönlendirme ekleyebilirsiniz
    header("Location: index.php"); // Örneğin ana sayfaya yönlendirme
    exit();
} else {
    echo "Geçersiz öğrenci ID.";
}






?>