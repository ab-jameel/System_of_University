<?php
include '../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../login.php");
    exit();
}

?>
<?php 
 $sql = "SELECT * FROM ogrenciler WHERE ogrenci_no = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('i',$_SESSION['ogrenci']);
 $stmt->execute();
 $result = $stmt->get_result();
 $ogrenci = $result->fetch_assoc();

 $sql2 = "SELECT * FROM dosyalar WHERE dosya_id = ?";
 $stmt2 = $conn->prepare($sql2);
 $stmt2->bind_param('i',$ogrenci['dosya_id']);
 $stmt2->execute();
 $result2 = $stmt2->get_result();
 $dosya = $result2->fetch_assoc();
 
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../style/ogrenci-bilgi.css">
</head>
<body>
    <?php include '../header.php';?>
    <div class="border"><?php echo $ogrenci['ogrenci_no']; ?> - Mühendislik Fakültesi - Bilgisayar Mühendisliği Bölümü - Lisans - Normal Öğretim Eğitim Dönemi : <?php echo $ogrenci['donem']; ?></div>
    <main class="container-fluid  p-1">
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="shortcut-container card p-3 text-center">
                    <h2>Kişisel Kısayollar</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="shortcut-link d-flex flex-column align-items-center justify-content-center">
                            <i class="fa-solid fa-book fa-2xl mt-4"></i>
                            <a href="Dersler" class="p-2 mt-4">Derslerim</a>
                        </div>
                        <div class="shortcut-link d-flex flex-column p-3 align-items-center justify-content-center">
                            <i class="fa-solid fa-arrows-rotate fa-2xl mt-4 mb-4"></i>
                            <a href="DersSecim" class="">Ders Seçimi - Kayıt Yenileme</a>
                        </div>
                        <div class="shortcut-link d-flex flex-column p-3 align-items-center justify-content-center">
                            <i class="fa-regular fa-calendar fa-2xl mt-4 mb-4"></i>
                            <a href="HaftalikDersPorgrami/dersprogrami.pdf" class="">Haftalık Ders Programı</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../scripts/ogrenci-index.js"></script> 
    <script>
        function logout() {
            window.location.href = '../logout.php';
        }
    </script>
</body>
</html>

