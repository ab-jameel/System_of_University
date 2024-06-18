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
$sql = "SELECT * FROM duyurular WHERE duyuru_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $duyuru_id);
$stmt->execute();
$result = $stmt->get_result();
$duyuru = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $duyuru_id = $_POST['duyuru_id'];
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $aciklama_saati = $_POST['aciklama_saati'];

    // Dosya yükleme işlemi
    if (!empty($_FILES["dosyaYukle"]["name"])) {
        $dosya_yolu = "../../../../Dosyalar/" . basename($_FILES["dosyaYukle"]["name"]);
        if (move_uploaded_file($_FILES["dosyaYukle"]["tmp_name"], $dosya_yolu)) {
            // Dosya başarıyla yüklendi, dosya_url ve dosya_id'yi güncelle
            $dosya_adi = basename($_FILES["dosyaYukle"]["name"]);
            $sql = "INSERT INTO dosyalar (dosya_url) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $dosya_adi);
            $stmt->execute();

            // Eklenen dosyanın id'sini al
            $yeni_dosya_id = $stmt->insert_id;

            // Duyurular tablosundaki dosya_id'yi güncelle
            $sql = "UPDATE duyurular SET baslik=?, aciklama=?, aciklama_saati=?, dosya_id=? WHERE duyuru_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $baslik, $aciklama, $aciklama_saati, $yeni_dosya_id, $duyuru_id);
            $stmt->execute();
        } else {
            echo "Dosya yüklenirken bir hata oluştu.";
            exit();
        }
    } else {
        // Dosya yüklenmediyse sadece diğer alanları güncelle
        $sql = "UPDATE duyurular SET baslik=?, aciklama=?, aciklama_saati=? WHERE duyuru_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $baslik, $aciklama, $aciklama_saati, $duyuru_id);
        $stmt->execute();
    }

    echo "Duyuru başarıyla güncellendi.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyuru Güncelle</title>
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
                    <h2>Duyuru Güncelle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="container mt-5">
                            <form action="DuyuruGuncelle.php?hid=<?php echo $duyuru_id; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="baslik" class="col-sm-2 col-form-label">Başlık</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="baslik" name="baslik" value="<?php echo $duyuru['baslik']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="aciklama" class="col-sm-2 col-form-label">Açıklama</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="aciklama" name="aciklama"><?php echo $duyuru['aciklama']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="aciklama_saati" class="col-sm-2 col-form-label">Açıklama Saati</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="aciklama_saati" name="aciklama_saati" value="<?php echo date('Y-m-d\TH:i', strtotime($duyuru['aciklama_saati'])); ?>">
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
                                <input type="hidden" name="duyuru_id" value="<?php echo $duyuru_id; ?>">
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
