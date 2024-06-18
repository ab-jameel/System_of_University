
<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

$sql = "SELECT * FROM hafta_icerikleri h
LEFT JOIN dersler d ON d.Ders_id = h.Ders_id 
LEFT JOIN Dosyalar dosya ON dosya.dosya_id = h.dosya_id WHERE d.Ders_id=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['dersid']);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../../style/ders-bilgisi.css">
    <style>
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include '../../../header.php';?>
    
    <main>
        <div class="border w-75 m-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>İçerik Adı</th>
                        <th>İçerik Tipi</th>
                        <th>Açıklama</th>
                        <th>Tarih</th>
                        <th>Dosya</th>
                        <th>Ders</th>
                        <th>
                            İşlemler
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['icerik_id']; ?>. Hafta</td>
                                    <td><?php echo $row['icerik_tipi']; ?></td>
                                    <td><?php echo $row['aciklama']; ?></td>
                                    <td><?php echo $row['tarih']; ?></td>
                                    <td><a href="../../../../Dosyalar/<?php echo $row['dosya_url']; ?>"><button class="btn btn-primary">İndir</button></a></td>
                                    <td><?php echo $row['Ders_ismi'];?></td>
                                    <td><a href="icerikGuncelle.php?hid=<?php echo $row['icerik_id'] ?>"><button class="btn btn-primary">Düzenle</button></a>
                                    <a href="icerikSil.php?hid=<?php echo $row['icerik_id'] ?>"><button class="btn btn-secondary">Sil</button></a></td>
                                </tr>
                            <?php } ?>
                </tbody>
            </table>
        </div>
                    <div class="form-group row">
                                    <div class="col-sm-10 ml-5 center-button">
                                       <a href="icerikEkle.php?dersid=<?php echo $_GET['dersid'];?>"><button type="submit" class="btn btn-primary"> Hafta İçeriği Ekle</button></a> 
                                    </div>
                    </div>
    </main>
    <div class="center-button">
    </div>
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
