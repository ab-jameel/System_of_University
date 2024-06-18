<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../login.php");
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
    <link rel="stylesheet" href="../../../../style/ders-bilgi-detay.css">
</head>
<body>
    <?php include '../../../header.php';?>
    <div class="border">200000 - Mühendislik Fakültesi - Bilgisayar Mühendisliği Bölümü - Lisans - Normal Öğretim Eğitim Dönemi : 1</div>
    <main class="container-fluid  p-1">
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="shortcut-container p-3 text-center">
                    <h2>Öğretmen Güncelle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                     <div class="container mt-5">
                    <form>
                        <p>Öğretmenin</p>
                        <div class="form-group row">
                            <label for="ogretmenAdi" class="col-sm-2 col-form-label">Adı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenAdi" placeholder="Adı">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenSoyadi" class="col-sm-2 col-form-label">Soyadı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenSoyadi" placeholder="Soyadı">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenTC" class="col-sm-2 col-form-label">TC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="teacherTC" placeholder="TC">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="ogretmenEmail" placeholder="Email">
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

