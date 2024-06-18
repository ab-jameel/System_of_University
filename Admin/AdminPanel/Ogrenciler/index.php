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
                    <h2>Öğrenciler</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="container mt-5">
                            <div>
                               
                                <table>
                                    <thead>
                                        <tr>
                                            <th>RESİM</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Email</th>
                                            <th>Dönem</th>
                                            <th>Danışman Öğretmen</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        	$result1 = $conn->query("SELECT * FROM ogrenciler") or die($conn->error());
                                            while ($row1 = $result1->fetch_assoc()){
                                                $ogrenci = new Ogrenciler($row1['ogrenci_no'], $row1['ad'], $row1['soyad'], $row1['email'], $row1['password'], $row1['tc'], $row1['donem'], $row1['Danisman_ogretmen_id'], $row1['dosya_id']);
                                        ?>
                                        <tr>
                                            <td>-</td>
                                            <td><?php echo $ogrenci->getAd();?></td>
                                            <td><?php echo $ogrenci->getSoyad();?></td>
                                            <td><?php echo $ogrenci->getEmail();?></td>
                                            <td><?php echo $ogrenci->getDonem();?></td>
                                            <td><?php echo $ogrenci->getDanismanOgretmenadi($conn);?></td>
                                            <td>
                                            <div class="d-flex">
                                                <a class="p-1 btn btn-danger" href="OgrenciEkle/index.php?delete=<?php echo $ogrenci->getOgrenciNo(); ?>">Sil</a>
                                                <a class="p-1 ml-2 btn btn-primary" href="OgrenciEkle/index.php?edit=<?php echo $ogrenci->getOgrenciNo(); ?>">Güncelle</a>
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
                            <a class="btn btn-primary mb-3" href="OgrenciEkle/index.php">Ogrenci Ekle</a>
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

