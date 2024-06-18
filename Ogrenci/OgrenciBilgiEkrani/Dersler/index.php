<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../../login.php");
    exit();
}

$sql = "SELECT d.Ders_kodu, d.Ders_ismi, d.kredi, d.AKTS, k.Vize, k.final, k.Butunleme, k.active, o.donem, d.Ders_id 
        FROM Kayit k
        JOIN Ogrenciler o ON o.ogrenci_no = k.Dersi_alan_ogrenci_id
        JOIN Dersler d ON k.Ders_id = d.Ders_id
        WHERE o.ogrenci_no = ? AND k.active=1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['ogrenci']);
$stmt->execute();
$result = $stmt->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz
$ogrenci = $result->fetch_assoc();
$row_count = $result->num_rows;


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
    <div class="border"><?php echo $_SESSION['ogrenci']; ?> - Mühendislik Fakültesi - Bilgisayar Mühendisliği Bölümü - Lisans - Normal Öğretim Eğitim Dönemi: <?php 
    if($row_count==0){
        echo "1";
    }else{
        echo htmlspecialchars($ogrenci['donem']);
    }
     ?></div>
    <main>
        <div class="border w-75 m-auto">
            <div class="d-flex justify-content-between">
                <p class="p-2"><?php echo date("Y"); ?> - <?php
                if($row_count ==0){
                    echo "Güz";
                }else{
                    echo ($ogrenci['donem'] % 2 == 1) ? "Güz" : "Bahar";
                }
                 ?></p>
                <input class="p-2 h-50 mt-2 mr-2 rounded" type="text" placeholder="Derslerde ara">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ders Kodu</th>
                        <th>Ders Adı</th>
                        <th>Kredi</th>
                        <th>AKTS</th>
                        <th>Devam Durumu</th>
                        <th>Vize</th>
                        <th>Final</th>
                        <th>Butunleme</th>
                        <th>HBN</th>
                        <th>Başarı Durumu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($row_count!=0){

                    
                    // Öğrenci bilgilerini tabloya yazdırmak için tüm satırları döngüyle işliyoruz
                    do {
                        ?>
                        <tr>
                            <td><a href="DersBilgisi/?dersid=<?php echo $ogrenci['Ders_id']; ?>" class="text-decoration-none"><?php echo htmlspecialchars($ogrenci['Ders_kodu']); ?></a></td>
                            <td><?php echo htmlspecialchars($ogrenci['Ders_ismi']); ?></td>
                            <td><?php echo htmlspecialchars($ogrenci['kredi']); ?></td>
                            <td><?php echo htmlspecialchars($ogrenci['AKTS']); ?></td>
                            <td>Devamlı</td>
                            <td><?php echo htmlspecialchars($ogrenci['Vize']); ?></td>
                            <td><?php echo htmlspecialchars($ogrenci['final']); ?></td>
                            <td><?php echo htmlspecialchars($ogrenci['Butunleme']); ?></td>
                            <td><?php
                            if($ogrenci['Butunleme']==0){
                                echo $ogrenci['Vize']*0.4 + $ogrenci['final']*0.6;
                            } 
                            else{
                                echo $ogrenci['Vize']*0.4 + $ogrenci['Butunleme']*0.6;
                            }
                             ?></td>
                            <td><?php if($ogrenci['Butunleme'] ==0 && $ogrenci['final'] ==0 ){
                            echo "Durumu Netleşmedi";
                        }else if($ogrenci['final']<50 && $ogrenci['Butunleme']==0 ){
                            echo "Başarısız";
                        }
                        else if($ogrenci['Butunleme']!=0 && $ogrenci['Butunleme']<50){
                            echo "Başarısız";
                        }else if((($ogrenci['Vize']*0.4 + $ogrenci['final']*0.6) <50)&& $ogrenci['Butunleme']==0){
                            echo "Başarısız";
                        }
                        else if((($ogrenci['Vize']*0.4 + $ogrenci['final']*0.6) >=50) && $ogrenci['final']>=50 && $ogrenci['Butunleme']==0 ){
                            echo "Başarılı";
                        }
                        else if((($ogrenci['Vize']*0.4 + $ogrenci['Butunleme']*0.6) >=50) && $ogrenci['Butunleme']>=50){
                            echo "Başarılı";
                        }
                        else{
                            echo "Başarısız";
                        }
                        
                        ?></td>
                        </tr>
                        <?php
                    } while ($ogrenci = $result->fetch_assoc()); }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <div class="center-button">
        <button type="button" class="btn btn-primary">Geçmiş Dönem Derslerini Göster</button>
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
