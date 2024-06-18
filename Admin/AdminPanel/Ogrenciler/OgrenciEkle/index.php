<?php

include '../OgerenciSil.php';
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
                    <h2>Öğrenci Ekle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                     <div class="container mt-5">
                    <form onsubmit="return validateForm()" action="../OgerenciSil.php" method="POST">
                        <p>Öğrencinin</p>
                        <input type="hidden" value="<?php echo $id; ?>" name="Ogrenciid">
                        <div class="form-group row">
                            <label for="ogrenciAdi" class="col-sm-2 col-form-label">Adı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="togrenciAdi" name="togrenciAdi" placeholder="Adı" value="<?php echo $togrenciAdi ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogrenciSoyadi" class="col-sm-2 col-form-label">Soyadı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="togrenciSoyadi" name="togrenciSoyadi" placeholder="Soyadı" value="<?php echo $togrenciSoyadi ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogrenciTC" class="col-sm-2 col-form-label">TC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogrenciTC" name="ogrenciTC" placeholder="TC" value="<?php echo $ogrenciTC ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogrenciEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogrenciEmail" name="ogrenciEmail" placeholder="Email" value="<?php echo $ogrenciEmail ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogrenciPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ogrenciPassword" name="ogrenciPassword" placeholder="Password" value="<?php echo $ogrenciPassword ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="donem" class="col-sm-2 col-form-label">Donem</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="donem" name="donem">
                                    <?php for($i = 1; $i < 11; $i++){ ?>
                                        <option <?php if($i == $donem){ echo "Selected"; } ?>><?php echo $i; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ogrenciDanisman" class="col-sm-2 col-form-label">Danışman Öğretmen</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="ogrenciDanisman" name="ogrenciDanisman">
                                    <?php
                                        $result1 = $conn->query("SELECT ogretmen_id, CONCAT(ad, soyad) as isim FROM ogretmenler");
                                        while ($row1 = $result1->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $row1['ogretmen_id']; ?>" <?php if($row1['ogretmen_id'] == $ogrenciDanisman){ echo "selected"; } ?>><?php echo $row1['isim']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
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

