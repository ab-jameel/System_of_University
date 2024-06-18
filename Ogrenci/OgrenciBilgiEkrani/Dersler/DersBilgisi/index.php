
<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../../../login.php");
    exit();
}
$_SESSION['dersid']=$_GET['dersid'];
$sql = "SELECT d.Ders_kodu, d.Ders_ismi, d.kredi, d.AKTS, k.Vize, k.final, k.Butunleme, o.ad, o.soyad, dosya.dosya_url, o.donem
FROM Kayit k
JOIN Ogrenciler o ON o.ogrenci_no = k.Dersi_alan_ogrenci_id
JOIN Dersler d ON k.Ders_id = d.Ders_id
JOIN Dosyalar dosya ON dosya.dosya_id = o.dosya_id
WHERE o.ogrenci_no = ? AND k.active = 1 AND k.Ders_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $_SESSION['ogrenci'],$_GET['dersid']);
$stmt->execute();
$result = $stmt->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz
$ogrenci = $result->fetch_assoc();
?>
<script>
    var ogrenciBilgisi = <?php echo json_encode($ogrenci); ?>;
</script>

<?php
$sql2 = "SELECT * FROM hafta_icerikleri h
JOIN Dosyalar d ON d.dosya_id = h.dosya_id
WHERE h.Ders_id=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('i', $_GET['dersid']);
$stmt2->execute();
$result2 = $stmt2->get_result();

// Hafta içeriklerini tutacak bir dizi oluşturuyoruz
$haftaIcerikleriListesi = array();

// Tüm hafta içeriklerini döngü ile alıyoruz
while ($row = $result2->fetch_assoc()) {
    // Her bir hafta içeriğini haftaIcerikleriListesi dizisine ekliyoruz
    $haftaIcerikleriListesi[] = $row;
}

// Hafta içeriklerini içeren diziyi JSON formatına dönüştürme
$jsonHaftaIcerikleri = json_encode($haftaIcerikleriListesi);
?>
<script>
    // PHP'den gelen JSON verisini JavaScript koduna aktarıyoruz
    var haftaİcerikleri = <?php echo $jsonHaftaIcerikleri; ?>;
</script>

<?php
$sql3 = "SELECT 
o.odev_id,
o.aciklama,
o.aktif,
d1.dosya_url,
o.sonteslim,
d2.dosya_url AS 'ogrenciteslim',
oc.ogrenci_id
FROM odevler o
LEFT JOIN Dosyalar d1 ON d1.dosya_id = o.dosyaid
LEFT JOIN odevcevaplar oc ON oc.odev_id = o.odev_id
LEFT JOIN Dosyalar d2 ON d2.dosya_id = oc.dosya_id
WHERE o.dersid = ? AND o.aktif = 1 AND oc.ogrenci_id = ?;
";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param('ii', $_GET['dersid'],$_SESSION['ogrenci']);
$stmt3->execute();
$result3 = $stmt3->get_result();

// Hafta içeriklerini tutacak bir dizi oluşturuyoruz
$OdevlerListesi = array();

// Tüm hafta içeriklerini döngü ile alıyoruz
while ($row = $result3->fetch_assoc()) {
    // Her bir hafta içeriğini haftaIcerikleriListesi dizisine ekliyoruz
    $OdevlerListesi[] = $row;
}

// Hafta içeriklerini içeren diziyi JSON formatına dönüştürme
$Odevler = json_encode($OdevlerListesi);

?>
<script>
    var odev = <?php echo $Odevler; ?>;
</script>
<?php
$sql4 = "SELECT o.ad,o.soyad,d.dosya_url FROM kayit k
JOIN ogrenciler o ON o.ogrenci_no = k.Dersi_alan_ogrenci_id
JOIN Dosyalar d ON d.dosya_id = o.dosya_id
WHERE k.Ders_id=? AND k.Dersi_alan_ogrenci_id<>?";
$stmt4 = $conn->prepare($sql4);
$stmt4->bind_param('ii', $_GET['dersid'],$_SESSION['ogrenci']);
$stmt4->execute();
$result4 = $stmt4->get_result();

// Hafta içeriklerini tutacak bir dizi oluşturuyoruz
$DersiAlanDigerOgrListe = array();

// Tüm hafta içeriklerini döngü ile alıyoruz
while ($row = $result4->fetch_assoc()) {
    // Her bir hafta içeriğini haftaIcerikleriListesi dizisine ekliyoruz
    $DersiAlanDigerOgrListe[] = $row;
}

// Hafta içeriklerini içeren diziyi JSON formatına dönüştürme
$DersiAlanDigerOgrenciler = json_encode($DersiAlanDigerOgrListe);

?>
<script>
    var DersiAlanDiger = <?php echo $DersiAlanDigerOgrenciler; ?>;
</script>


<?php
$sql5 = "SELECT * FROM duyurular d
JOIN Dosyalar dosya ON d.dosya_id = dosya.dosya_id
WHERE d.Ders_id=?";
$stmt5 = $conn->prepare($sql5);
$stmt5->bind_param('i', $_GET['dersid']);
$stmt5->execute();
$result5 = $stmt5->get_result();

// Hafta içeriklerini tutacak bir dizi oluşturuyoruz
$DuyuruListe = array();

// Tüm hafta içeriklerini döngü ile alıyoruz
while ($row = $result5->fetch_assoc()) {
    // Her bir hafta içeriğini haftaIcerikleriListesi dizisine ekliyoruz
    $DuyuruListe[] = $row;
}

// Hafta içeriklerini içeren diziyi JSON formatına dönüştürme
$DuyurularJ = json_encode($DuyuruListe);

?>
<script>
    var Duyurular = <?php echo $DuyurularJ; ?>;
</script>

<?php
$sql6 = "SELECT
COUNT(*) + 1 AS sira
FROM
kayit k1
JOIN
kayit k2 ON k1.Ders_id = k2.Ders_id AND k1.Vize < k2.Vize
WHERE
k1.Dersi_alan_ogrenci_id = ? AND k1.Ders_id = ? AND k1.active=1;
";
$stmt6 = $conn->prepare($sql6);
$stmt6->bind_param('ii', $_SESSION['ogrenci'],$_GET['dersid']);
$stmt6->execute();
$result6 = $stmt6->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz
$vizesiralama = $result6->fetch_assoc();

?>
<script>
    var vizeSiralamasi = <?php echo json_encode($vizesiralama); ?>;
</script>


<?php
$sql7 = "SELECT
COUNT(*) + 1 AS sira
FROM
kayit k1
JOIN
kayit k2 ON k1.Ders_id = k2.Ders_id AND k1.final < k2.final
WHERE
k1.Dersi_alan_ogrenci_id = ? AND k1.Ders_id = ? AND k1.active=1;
";
$stmt7 = $conn->prepare($sql7);
$stmt7->bind_param('ii', $_SESSION['ogrenci'],$_GET['dersid']);
$stmt7->execute();
$result7 = $stmt7->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz
$finalsiralama = $result7->fetch_assoc();

?>
<script>
    var finalSiralamasi = <?php echo json_encode($finalsiralama); ?>;
</script>

<?php
$sql8 = "SELECT ROUND(AVG(Vize),1) AS vize_ortalamasi
FROM kayit
WHERE Ders_id = ? AND active=1;
";
$stmt8 = $conn->prepare($sql8);
$stmt8->bind_param('i',$_GET['dersid']);
$stmt8->execute();
$result8 = $stmt8->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz
$vizeort = $result8->fetch_assoc();

?>
<script>
    var vizeOrtalama = <?php echo json_encode($vizeort); ?>;
</script>

<?php
$sql9 = "SELECT ROUND(AVG(final),1) AS final_ortalamasi
FROM kayit
WHERE Ders_id = ? AND active=1;
";
$stmt9 = $conn->prepare($sql9);
$stmt9->bind_param('i',$_GET['dersid']);
$stmt9->execute();
$result9 = $stmt9->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz
$finalort = $result9->fetch_assoc();

?>
<script>
    var finalOrtalama = <?php echo json_encode($finalort); ?>;
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../../style/ders-bilgi-detay.css">
</head>
<body>
    <?php include '../../../header.php';?>
    <main class="container-fluid mt-6">
        <div class="row">
            <div class="col-md-4">
                <div class="student-menu  link-container p-3 mb-3">
                    <ul class="list-unstyled">
                        <li><a href="">Genel Bilgiler</a></li> 
                        <li><a href="">Hafta İçerikleri</a></li> 
                        <li><a href="">Ödevler</a></li>  
                        <li><a href="">Dersi Alan Diğer Öğrenciler</a></li>  
                        <li><a href="">Değerlendirme Sistemi</a></li>  
                        <li><a href="">Duyurular</a></li>  
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="shortcut-container card p-3">
                    <div class="class-info">
                        <div class="d-flex justify-content-between">
                            <p><?php if($ogrenci['donem']%2==0){
                                echo 'Bahar';
                            }else{echo 'Güz';} ?></p>
                            <p>Durum Netleşmemiş</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Mühendislik Fakültesi - Bilgisayar Mühendisliği Bölümü / <?php echo $ogrenci['Ders_kodu']; ?> - <?php echo $ogrenci['Ders_ismi'];  ?> </p>
                            <p><a href="#" class="text-decoration-none">Devamlı</a></p>
                        </div>
                    </div>
                    <div class="results border-top">
                    <table>
                        <thead class="border-bottom">
                            <tr>
                                <th>Sınav Tipi</th>
                                <th>Ders Adı</th>
                                <th>Sınav Notu</th>
                                <th>Mazaret</th>
                                <th>Sınıf Sıralaması</th>
                                <th>Sınıf Ortalaması</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ara Sınav</td>
                                <td><?php echo $ogrenci['Ders_ismi']; ?></td>
                                <td><?php echo $ogrenci['Vize']; ?></td>
                                <td>-</td>
                                <td><?php echo $vizesiralama['sira']; ?></td>
                                <td><?php echo $vizeort['vize_ortalamasi'] ;?></td>
                            </tr>
                            <tr>
                                <td>Final</td>
                                <td><?php echo $ogrenci['Ders_ismi']; ?></td>
                                <td><?php echo $ogrenci['final']; ?></td>
                                <td>-</td>
                                <td><?php echo $finalsiralama['sira']; ?></td>
                                <td><?php echo $finalort['final_ortalamasi'] ;?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                    <div class="teacher mt-2 d-flex justify-content-between p-2">
                        <div class="d-flex">
                            <img class="profile-photo rounded-circle" src="../../../../Dosyalar/<?php echo $ogrenci['dosya_url']; ?>">
                            <p class="pl-4 mt-3"><?php echo $ogrenci['ad']." ".$ogrenci['soyad']; ?></p>
                        </div>
                        <div>
                            <p>Final Sonunda Oluşan Sınıf Ağırlıklı Not Ortalaması : - </p>
                            <p>Bütünleme Sonunda Oluşan Sınıf Ağırlıklı Not Ortalaması : -</p>
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
