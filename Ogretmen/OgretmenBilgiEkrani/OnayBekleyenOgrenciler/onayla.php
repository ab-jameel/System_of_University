
<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../login.php");
    exit();
}
?>

<?php
$sql1 = "SELECT * FROM ogrenciler WHERE ogrenci_no = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('i',$_GET['id']);
$stmt1->execute();
$result1 = $stmt1->get_result();
$ogrenci = $result1->fetch_assoc();





$sql = "SELECT * FROM kayit k 
LEFT JOIN ogrenciler o ON o.ogrenci_no = k.Dersi_alan_ogrenci_id 
LEFT JOIN dersler d ON d.Ders_id = k.Ders_id
WHERE k.active = 0 AND o.ogrenci_no= ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
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
    <link rel="stylesheet" href="../../../style/ders-bilgisi.css">
    <style>
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include '../../header.php';?>
   
    <main>
        <div class="border w-75 m-auto">
            <div class="d-flex justify-content-between">
               
            </div>
            <div class="p-3">
                <p><strong>Öğrenci Adı: </strong> <?php echo $ogrenci['ad']." ".$ogrenci['soyad']; ?></p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ders Kodu</th>
                        <th>Ders Adı</th>
                        <th>Kredi</th>
                        <th>AKTS</th>
                    </tr>
                </thead>
                <tbody>
                 <?php while($Ders = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $Ders['Ders_kodu'];?></td>
                            <td><?php echo $Ders['Ders_ismi'];?></td>
                            <td><?php echo $Ders['kredi'];?></td>
                            <td><?php echo $Ders['akts'];?></td>
                        </tr>
                        <?php endwhile; ?>
                </tbody>
            </table>
            <div class="center-button d-flex p-3">
               <a href="onaykabul.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-success">Dersleri Onayla</button></a>
            </div>
            <div class="center-button d-flex p-3">
               <a href="onayreddet.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-danger">Dersleri Onaylama</button></a> 
            </div>
        </div>
    </main>
    <div class="center-button">
    </div>
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
