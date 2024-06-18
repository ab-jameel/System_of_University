<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/ders-bilgi-detay.css">
</head>
<body>
    <?php include 'header.php';?>
    <main class="container-fluid mt-6">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="mobilePhone">Cep Telefonu</label>
                <input type="text" class="form-control" id="mobilePhone" placeholder="Cep Telefonu">
            </div>
            <div class="col-md-12 mb-3">
                <label for="corporateEmail">Kurumsal E-posta</label>
                <input type="email" class="form-control" id="corporateEmail" placeholder="Kurumsal E-posta" value="200401028@ogr.comu.edu.tr">
            </div>
            <div class="col-md-12 mb-3">
                <label for="personalEmail">Kişisel E-posta</label>
                <input type="email" class="form-control" id="personalEmail" placeholder="Kişisel E-posta">
            </div>

            <div>
                <div class="col-md-12 mb-3">
                    <label for="oldPassword">Eski Şifre</label>
                    <input type="password" class="form-control" id="oldPassword" placeholder="Eski Şifre">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="newPassword">Yeni Şifre</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Yeni Şifre">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>

