<?php

include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Eğer icerik_id GET parametresiyle gelmediyse veya boşsa, hata mesajı ver ve çık
if (!isset($_GET['hid']) || empty($_GET['hid'])) {
    echo "Hata: İçerik ID belirtilmemiş.";
    exit();
}

// İçerik ID'sini al
$icerik_id = $_GET['hid'];

// Veritabanından içerik bilgilerini al
$sql = "SELECT dosya_id FROM hafta_icerikleri WHERE icerik_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $icerik_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Hata: İçerik bulunamadı.";
    exit();
}

$icerik = $result->fetch_assoc();
$dosya_id = $icerik['dosya_id'];

// Dosya bilgilerini al
$sql = "SELECT dosya_url FROM dosyalar WHERE dosya_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dosya_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Hata: Dosya bulunamadı.";
    exit();
}

$dosya = $result->fetch_assoc();
$dosya_yolu = "../../../../Dosyalar/" . $dosya['dosya_url'];

// İçeriği ve dosyayı veritabanından sil
$sql = "DELETE FROM hafta_icerikleri WHERE icerik_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $icerik_id);
$stmt->execute();

$sql = "DELETE FROM dosyalar WHERE dosya_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dosya_id);
$stmt->execute();

// Dosyayı dosya sisteminden sil
if (file_exists($dosya_yolu)) {
    unlink($dosya_yolu);
}

echo "İçerik ve dosya başarıyla silindi.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Sil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../../../style/ders-bilgi-detay.css">
</head>
<body>
    <?php include '../../../header.php';?>
    <main class="container-fluid p-1">
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="shortcut-container p-3 text-center">
                    <h2>İçerik Sil</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="container mt-5">
                            <div class="alert alert-success">
                                İçerik ve dosya başarıyla silindi.
                            </div>
                            <a href="index.php" class="btn btn-primary">Geri Dön</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../../../logout.php';
        }
    </script>
</body>
</html>
<?php header('location:index.php');?>