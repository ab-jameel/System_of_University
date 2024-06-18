
<?php

include '../DersSil.php';
require_once '../../../../Classes/Adminler.php';
require_once '../../../../Classes/connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../../../login.php");
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
                    <h2>Ders Ekle</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                     <div class="container mt-5">
                    <form onsubmit="return validateForm()" action="../DersSil.php" method="POST">
                        <p>Dersin</p>
                        <input type="hidden" value="<?php echo $id; ?>" name="Dersid">
                        <div class="form-group row">
                            <label for="dersKodu" class="col-sm-2 col-form-label">Kodu</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="dersKodu" name="dersKodu" placeholder="Ders Kodu" value="<?php echo $dersKodu ; ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dersinIsmi" class="col-sm-2 col-form-label">İsmi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="dersinIsmi" name="dersinIsmi" placeholder="Ders İsmi" value="<?php echo $dersinIsmi ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dersiVerenOgretmen" class="col-sm-2 col-form-label">Dersi Veren Öğretmen</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="dersiVerenOgretmen" name="dersiVerenOgretmen">
                                    <?php
                                        $result1 = $conn->query("SELECT ogretmen_id, CONCAT(ad, soyad) as isim FROM ogretmenler");
                                        while ($row1 = $result1->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $row1['ogretmen_id']; ?>" <?php if($row1['ogretmen_id'] == $dersiVerenOgretmen){ echo "selected"; } ?>><?php echo $row1['isim']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
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
                            <label for="AKTS" class="col-sm-2 col-form-label">AKTS</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="AKTS" name="AKTS" placeholder="AKTS" value="<?php echo $AKTS ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Kredi" class="col-sm-2 col-form-label">Kredi</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="Kredi" name="Kredi" placeholder="Kredi" value="<?php echo $Kredi ; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dersTuru" class="col-sm-2 col-form-label">Ders Türü</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="dersTuru" name="dersTuru">
                                    <option value="">Seçiniz...</option>
                                    <option value="secmeli" <?php if($dersTuru == 'secmeli'){ echo "selected"; } ?> > Seçmeli</option>
                                    <option value="zorunlu" <?php if($dersTuru == 'zorunlu'){ echo "selected"; } ?> > Zorunlu</option>
                                    <option value="zorunlu-secmeli" <?php if($dersTuru == 'zorunlu-secmeli'){ echo "selected"; } ?> > Zorunlu Seçmeli Falan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="limit" class="col-sm-2 col-form-label">Limit</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="limit" name="limit" placeholder="Limit" value="<?php echo $limiti ; ?>">
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