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
$sql = "SELECT * FROM hafta_icerikleri WHERE icerik_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $icerik_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Hata: İçerik bulunamadı.";
    exit();
}

$icerik = $result->fetch_assoc();
$icerik_adi = $icerik['icerik_adi'];
$icerik_tipi = $icerik['icerik_tipi'];
$aciklama = $icerik['aciklama'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafta İçeriği Güncelle</title>
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
                    <h2>Hafta İçeriği Güncelle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="container mt-5">
                            <form action="update_content.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="icerikAdi" class="col-sm-2 col-form-label">İçerik Adı</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="icerikAdi" name="icerikAdi" value="<?php echo $icerik_adi; ?>">
                                    </div>
                                </div>
                                <div class="form-group row h-50">
                                    <label for="icerikTipi" class="col-sm-2 col-form-label">İçerik Tipi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="icerikTipi" name="icerikTipi" value="<?php echo $icerik_tipi; ?>">
                                    </div>
                                </div>
                                <div class="form-group row h-50">
                                    <label for="aciklama" class="col-sm-2 col-form-label">Açıklama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="aciklama" name="aciklama" value="<?php echo $aciklama; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dosyaYukle" class="col-sm-2 col-form-label">Dosya Yükle</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control-file" id="dosyaYukle" name="dosyaYukle">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 ml-5">
                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                                <input type="hidden" name="icerik_id" value="<?php echo $icerik_id; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../../../logout.php';
        }
    </script>
</body>
</html>
