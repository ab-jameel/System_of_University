<?php
include '../OgretmenSil.php';
require_once '../../../../Classes/Adminler.php';
require_once '../../../../Classes/connect.php';

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
    <script>
        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll('input, select, textarea');
            var emptyFields = [];

            inputs.forEach(function(input) {
                if (input.value.trim() === "") {
                    emptyFields.push(input.name);
                    isValid = false;
                }
            });

            if (!isValid) {
                alert("Please fill out the fields");
            }

            return isValid;
        }
    </script>
</head>
<body>
    <?php include '../../../header.php';?>
    <main class="container-fluid  p-1">
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="shortcut-container p-3 text-center">
                    <h2>Öğretmen Ekle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                     <div class="container mt-5">
                     <form onsubmit="return validateForm()" action="../OgretmenSil.php" method="POST">
                        <p>Öğretmenin</p>
                        <input type="hidden" value="<?php echo $id; ?>" name="Ogretmenid">
                        <div class="form-group row">
                            <label for="ogretmenAdi" class="col-sm-2 col-form-label">Adı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenAdi" name="ogretmenAdi" placeholder="Adı" value="<?php echo $ogretmenAdi ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenSoyadi" class="col-sm-2 col-form-label">Soyadı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenSoyadi" name="ogretmenSoyadi" placeholder="Soyadı" value="<?php echo $ogretmenSoyadi ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenTC" class="col-sm-2 col-form-label">TC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenTC" name="ogretmenTC" placeholder="TC" value="<?php echo $ogretmenTC ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenEmail" name="ogretmenEmail" placeholder="Email" value="<?php echo $ogretmenEmail ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogretmenPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogretmenPassword" name="ogretmenPassword" placeholder="Password" value="<?php echo $ogretmenPassword ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-5">
                                <?php 
                                    if ($update == false):
                                ?>
                                    <button type="submit" name="save" class="btn btn-primary">Ekle</button>
                                <?php else: ?>
                                    <button type="submit" name="update" class="btn btn-primary">Güncelle</button>
                                <?php endif; ?>
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

