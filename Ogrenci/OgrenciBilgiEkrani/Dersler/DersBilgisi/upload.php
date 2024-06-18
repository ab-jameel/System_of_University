<?php
include '../../../../Classes/AllClasses.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $odev_id = $_POST['odev_id'];
    $ogrenci_id = $_SESSION['ogrenci'];

    // Eski dosya var mı kontrol et ve sil
    $sql_check = "SELECT d.dosya_url FROM odevcevaplar oc
                  LEFT JOIN Dosyalar d ON oc.dosya_id = d.dosya_id
                  WHERE oc.odev_id = ? AND oc.ogrenci_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('ii', $odev_id, $ogrenci_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $old_file = "../../../../Dosyalar/" . $row['dosya_url'];
        if (file_exists($old_file)) {
            unlink($old_file); // Eski dosyayı sil
        }
    }

    // Dosya yükleme işlemi
    $target_dir = "../../../../Dosyalar/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Dosya tipi kontrolü (isteğe bağlı)
    // $allowed_types = array('pdf', 'doc', 'docx', 'jpg', 'png'); // İzin verilen dosya türleri
    // if (!in_array($fileType, $allowed_types)) {
    //     $uploadOk = 0;
    // }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Dosya URL'sini veritabanına kaydetme
            $file_url = basename($_FILES["file"]["name"]);

            // Dosyalar tablosuna yeni kayıt ekleme
            $sql1 = "INSERT INTO Dosyalar (dosya_url) VALUES (?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param('s', $file_url);
            $stmt1->execute();
            $new_dosya_id = $stmt1->insert_id;

            // odevcevaplar tablosunu güncelleme
            $sql2 = "UPDATE odevcevaplar SET dosya_id = ? WHERE odev_id = ? AND ogrenci_id = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param('iii', $new_dosya_id, $odev_id, $ogrenci_id);
            $stmt2->execute();

            echo "Dosya başarıyla yüklendi ve kaydedildi.";
        } else {
            echo "Dosya yükleme sırasında bir hata oluştu.";
        }
    } else {
        echo "Dosya yükleme şartları sağlanamadı.";
    }
}
?>
