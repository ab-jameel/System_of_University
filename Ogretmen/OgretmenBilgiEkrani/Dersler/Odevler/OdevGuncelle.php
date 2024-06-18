<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Ödev ID'sini al
$odev_id = $_GET['oid'];

// Veritabanından ödev bilgilerini al
$sql = "SELECT * FROM odevler WHERE odev_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $odev_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $aciklama = $row['aciklama'];
    $dosya_id = $row['dosyaid'];
    $sonteslim = $row['sonteslim'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödev Güncelle</title>
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
                    <h2>Ödev Güncelle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                     <div class="container mt-5">
                        <form action="update_assignment.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group row h-50">
                                <label for="aciklama" class="col-sm-2 col-form-label">Açıklama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="aciklama" name="aciklama" value="<?php echo $aciklama; ?>" placeholder="Açıklama Giriniz">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dosyaYukle" class="col-sm-2 col-form-label">Dosya Yükle</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" id="dosyaYukle" name="dosyaYukle">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tarih" class="col-sm-2 col-form-label">Tarih</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tarih" name="tarih" value="<?php echo $sonteslim; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-5">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>

                            <input type="hidden" name="odev_id" value="<?php echo $odev_id; ?>">
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
