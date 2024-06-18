<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

// Ödev ID'sini al
$odev_id = $_GET['oid'];

// Ödev cevaplarını veritabanından al
$sql = "SELECT oc.*, ogr.ad, ogr.soyad, d.dosya_url FROM odevcevaplar oc 
        LEFT JOIN odevler o ON oc.odev_id=o.odev_id 
        LEFT JOIN dosyalar d ON oc.dosya_id = d.dosya_id
        LEFT JOIN ogrenciler ogr ON ogr.ogrenci_no = oc.ogrenci_id
        WHERE o.odev_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $odev_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödev Cevapları</title>
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
                        <th>Numara</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Dosya</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ogrenci_id'] . "</td>";
                        echo "<td>" . $row['ad'] . "</td>";
                        echo "<td>" . $row['soyad'] . "</td>";
                        echo "<td>" . ($row['dosya_url'] ? '<a href="../../../../Dosyalar/' . $row['dosya_url'] . '">İndir</a>' : '-') . "</td>";
                        
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
    </main>
    
    <style>
        .secili-dersler {
            height: 20px;
            width: 20px;
            background-color: rgb(116, 234, 134);
            margin-right: 1rem;
            margin-top: .1rem;
            border-radius: 1rem;
        }

        .zorunlu-secili-dersler {
            height: 20px;
            width: 20px;
            background-color: rgb(239, 149, 149);
            margin-right: 1rem;
            margin-top: .1rem;
            border-radius: 1rem;
        }

        .secmeli-secili-dersler {
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
