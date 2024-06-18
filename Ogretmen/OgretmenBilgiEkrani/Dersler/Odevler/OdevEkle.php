<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $aciklama = $_POST['aciklama'];
    $dosya_yolu = "../../../../Dosyalar/" . basename($_FILES["dosyaYukle"]["name"]);
    $tarih = $_POST['tarih'];

    // Dosya yükleme işlemi
    if (move_uploaded_file($_FILES["dosyaYukle"]["tmp_name"], $dosya_yolu)) {
        // Dosya başarıyla yüklendi, dosya_url ve dosya_id'yi güncelle
        $dosya_adi = basename($_FILES["dosyaYukle"]["name"]);
        $sql = "INSERT INTO dosyalar (dosya_url) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dosya_adi);
        $stmt->execute();

        // Eklenen dosyanın id'sini al
        $yeni_dosya_id = $stmt->insert_id;

        // Ödevi ekle
        $sql = "INSERT INTO odevler (aciklama, dosyaid, dersid, aktif, sonteslim) VALUES (?, ?, ?, 1, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $aciklama, $yeni_dosya_id, $_GET['dersid'], $tarih);
        $stmt->execute();

        echo "Ödev başarıyla eklendi.";
    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödev Ekle</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../../../style/ders-bilgi-detay.css">
</head>
<body>
    <?php include '../../../header.php';?>
    <main class="container-fluid  p-1">
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="shortcut-container p-3 text-center">
                    <h2>Ödev Ekle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                     <div class="container mt-5">
                        <form method="POST" enctype="multipart/form-data">
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
                                <label for="tarih" class="col-sm-2 col-form-label">Son Tarih</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tarih" name="tarih">
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
    <script src="../../../../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../../../logout.php';
        }
    </script>
</body>
</html>
