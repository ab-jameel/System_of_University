<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Ödev ID'sini al
$odev_id = $_GET['oid'];

// Ödevi veritabanından sil
$sql = "DELETE FROM odevler WHERE odev_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $odev_id);
$stmt->execute();

// Silme işleminden sonra ödevin dosyasını da silmek isterseniz aşağıdaki kodu kullanabilirsiniz.
// Ödevin dosya_id'sini al
// $sql_dosya = "SELECT dosyaid FROM odevler WHERE odev_id=?";
// $stmt_dosya = $conn->prepare($sql_dosya);
// $stmt_dosya->bind_param("i", $odev_id);
// $stmt_dosya->execute();
// $result_dosya = $stmt_dosya->get_result();
// if ($result_dosya->num_rows > 0) {
//     $row_dosya = $result_dosya->fetch_assoc();
//     $dosya_id = $row_dosya['dosyaid'];

//     // Dosyayı sil
//     $sql_sil_dosya = "DELETE FROM dosyalar WHERE dosya_id=?";
//     $stmt_sil_dosya = $conn->prepare($sql_sil_dosya);
//     $stmt_sil_dosya->bind_param("i", $dosya_id);
//     $stmt_sil_dosya->execute();
//     // Dosya sisteminden de silinebilir, örnek olarak:
//     // unlink("../../Dosyalar/dosya_adı");
// }


exit();
?>
