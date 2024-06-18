<?php
include '../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {

    header("Location: ../../login.php");
    exit();
}

?>
<!DOCTYPE html>
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
                            <i class="fa-regular fa-2xl fa-calendar-check mt-4"></i>
                            <a href="OnayBekleyenOgrenciler" class="mt-4">Onay Bekleyen Öğrenciler</a>
                        </div>
                        <div class="shortcut-link d-flex flex-column p-3 align-items-center justify-content-center">
                            <i class="fa-regular fa-calendar fa-2xl mt-4"></i>
                            <a href="../../Dosyalar/dersprogrami.pdf" class="mt-4">Haftalık Ders Programı</a>
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

