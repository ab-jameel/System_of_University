
<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

$sql = "SELECT * FROM odevler o 
LEFT JOIN dosyalar d ON d.dosya_id = o.dosyaid WHERE o.dersid=?";
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
                        <th>Açıklama</th>
                        <th>Son Tarih</th>
                        <th>Aktiflik Durumu</th>
                        <th>Dosya</th>
                        
                        <th>
                            İşlemler
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['aciklama']; ?></td>
                            <td><?php echo date('d.m.Y', strtotime($row['sonteslim'])); ?></td>
                            <td>
                                <div class="">
                                    <div class="secili-dersler"></div>
                                </div>
                            </td>
                            <td>
                                <a href="../../../../Dosyalar/<?php echo $row['dosya_url']; ?>"><button class="btn btn-primary">Görüntüle</button></a>
                            </td>
                            
                            <td>
                                <div>
                                   <a href="OdevGuncelle.php?oid=<?php echo $row['odev_id']; ?>"><button class="btn btn-primary">Düzenle</button></a> 
                                    <a href="OdevSil.php?oid=<?php echo $row['odev_id']; ?>"><button class="btn btn-secondary">Sil</button></a>
                                    <a href="ödevlerigoruntule.php?oid=<?php echo $row['odev_id']; ?>"><button class="btn btn-warning">Cevapları Görüntüle</button></a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
            <div class="form-group row">
                                    <div class="col-sm-10 ml-5 center-button">
                                      <a href="OdevEkle.php?dersid=<?php echo $_GET['dersid']; ?>"><button type="submit" class="btn btn-primary"> Ödev Ekle</button></a>  
                                    </div>
                    </div>
    </main>
    <div class="center-button">
    </div>
    <style>

    .secili-dersler{
        height: 20px;
        width: 20px;
        background-color: rgb(116, 234, 134);
        margin-right: 1rem;
        margin-top: .1rem;
        border-radius: 1rem;
    }
    .zorunlu-secili-dersler{
        height: 20px;
        width: 20px;
        background-color: rgb(239, 149, 149);
        margin-right: 1rem;
        margin-top: .1rem;
        border-radius: 1rem;
    }

    .secmeli-secili-dersler{
        height: 20px;
        width: 20px;
        background-color: rgb(142, 227, 234);
        margin-right: 1rem;
        margin-top: .1rem;
        border-radius: 1rem;
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../../../logout.php';
        }
    </script>
</body>
</html>

