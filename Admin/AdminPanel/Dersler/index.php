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
    <link rel="stylesheet" href="../../../style/ders-bilgi-detay.css">
</head>
<body>
    <?php include '../../header.php';?>
    <main class="container-fluid  p-1">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="shortcut-container p-3 text-center">
                    <h2>Tüm Dersler</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="container mt-5">
                            <div>
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Ders Kodu</th>
                                            <th>Ders İsmi</th>
                                            <th>Öğretmen Adı</th>
                                            <th>Dönem</th>
                                            <th>AKTS</th>
                                            <th>Kredi</th>
                                            <th>Limit</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        	$result1 = $conn->query("SELECT * FROM dersler") or die($conn->error());
                                            while ($row1 = $result1->fetch_assoc()){
                                                $ders = new Dersler($conn, $row1['Ders_id'], $row1['Ders_kodu'], $row1['Ders_ismi'], $row1['dersi_veren_ogretmen_id'], $row1['donem'], $row1['akts'], $row1['kredi'], $row1['Ders_turu'], $row1['limit']);
                                        ?>
                                        <tr>
                                            <td><a href="#"><?php echo $ders->getDersKodu();?></a></td>
                                            <td><?php echo $ders->getDersIsmi();?></td>
                                            <td><?php echo $ders->getDersiVerenOgretmenadi($conn);?></td>
                                            <td><?php echo $ders->getDonem();?></td>
                                            <td><?php echo $ders->getAkts();?></td>
                                            <td><?php echo $ders->getKredi();?></td>
                                            <td><?php echo $ders->getLimit();?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="p-1 btn btn-danger" href="DersEkle/index.php?delete=<?php echo $ders->getDersId(); ?>">Sil</a>
                                                    <a class="p-1 ml-2 btn btn-primary" href="DersEkle/index.php?edit=<?php echo $ders->getDersId(); ?>">Güncelle</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div>
                            <a class="btn btn-primary mb-3" href="DersEkle/index.php">Ders Ekle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../../logout.php';
        }
    </script>
</body>
</html>

