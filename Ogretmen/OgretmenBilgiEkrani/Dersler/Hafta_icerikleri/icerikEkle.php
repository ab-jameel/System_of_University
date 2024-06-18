<?php

include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Eğer dersid GET parametresiyle gelmediyse veya boşsa, hata mesajı ver ve çık
if (!isset($_GET['dersid']) || empty($_GET['dersid'])) {
    echo "Hata: Ders ID belirtilmemiş.";
    exit();
}

// Ders ID'sini al
$ders_id = $_GET['dersid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $icerik_adi = $_POST['icerikAdi'];
    $icerik_tipi = $_POST['icerikTipi'];
    $aciklama = $_POST['aciklama'];
    
    $dosya_id = NULL;
    if (isset($_FILES["dosyaYukle"]) && $_FILES["dosyaYukle"]["error"] == 0) {
        $dosya_yolu = "../../../../Dosyalar/" . basename($_FILES["dosyaYukle"]["name"]);
        if (move_uploaded_file($_FILES["dosyaYukle"]["tmp_name"], $dosya_yolu)) {
            $dosya_adi = basename($_FILES["dosyaYukle"]["name"]);
            $sql = "INSERT INTO dosyalar (dosya_url) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $dosya_adi);
            $stmt->execute();
            $dosya_id = $stmt->insert_id;
        } else {
            echo "Dosya yüklenirken bir hata oluştu.";
            exit();
        }
    }

    $sql = "INSERT INTO hafta_icerikleri (icerik_adi, icerik_tipi, aciklama, dosya_id, Ders_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $icerik_adi, $icerik_tipi, $aciklama, $dosya_id, $ders_id);
    $stmt->execute();

    echo "İçerik başarıyla eklendi.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafta İçeriği Ekle</title>
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
                    <h2>Hafta İçeriği Ekle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="container mt-5">
                            <form action="icerikEkle.php?dersid=<?php echo $ders_id; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="icerikAdi" class="col-sm-2 col-form-label">İçerik Adı</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="icerikAdi" name="icerikAdi" placeholder="Ad Giriniz...">
                                    </div>
                                </div>
                                <div class="form-group row h-50">
                                    <label for="icerikTipi" class="col-sm-2 col-form-label">İçerik Tipi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="icerikTipi" name="icerikTipi" placeholder="İçerik Tipini Giriniz">
                                    </div>
                                </div>
                                <div class="form-group row h-50">
                                    <label for="aciklama" class="col-sm-2 col-form-label">Açıklama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="aciklama" name="aciklama" placeholder="Açıklama Giriniz">
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
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </div>
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
