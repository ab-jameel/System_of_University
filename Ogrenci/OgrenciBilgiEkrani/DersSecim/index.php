<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../../../login.php");
    exit();
}

?>
<?php 
 $sql = "SELECT ogretmenler.ad AS 'ograd' , ogretmenler.soyad  AS 'ogrsoyad',
 ogrenciler.ad,ogrenciler.soyad,ogrenciler.donem  FROM ogrenciler 
 LEFT JOIN ogretmenler ON ogretmenler.ogretmen_id = ogrenciler.Danisman_ogretmen_id
 WHERE ogrenciler.ogrenci_no = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('i',$_SESSION['ogrenci']);
 $stmt->execute();
 $result = $stmt->get_result();
 $ogrenci = $result->fetch_assoc();

 $sql2 = "SELECT * FROM dosyalar WHERE dosya_id = ?";
 $stmt2 = $conn->prepare($sql2);
 $stmt2->bind_param('i',$ogrenci['dosya_id']);
 $stmt2->execute();
 $result2 = $stmt2->get_result();
 $dosya = $result2->fetch_assoc();

 $sql3 = "SELECT * FROM Dersler WHERE donem=? AND Ders_turu='zorunlu'";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param('i', $ogrenci['donem']);
$stmt3->execute();
$result3 = $stmt3->get_result();

 

$sql4 = "SELECT * FROM Dersler WHERE donem=? AND Ders_turu='secmeli'";
$stmt4 = $conn->prepare($sql4);
$stmt4->bind_param('i', $ogrenci['donem']);
$stmt4->execute();
$result4 = $stmt4->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz



$sql5 = "SELECT * FROM secilidersler WHERE ogrenci_id=?";
$stmt5 = $conn->prepare($sql5);
$stmt5->bind_param('i', $_SESSION['ogrenci']);
$stmt5->execute();
$result5 = $stmt5->get_result();

$sira = 1;


$sql6 = "SELECT SUM(akts) AS 'TOPLAMAKTS' FROM secilidersler WHERE ogrenci_id=?";
$stmt6 = $conn->prepare($sql6);
$stmt6->bind_param('i', $_SESSION['ogrenci']);
$stmt6->execute();
$result6 = $stmt6->get_result();
$seciliAkts = $result6->fetch_assoc();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../style/ders-kayit.css">
</head>
<body>
    <?php include '../../header.php';?>
    <main class="container-fluid mt-6">
    <?php if(isset($_SESSION['aktsHata'])){ ?>
    <div class="student-info-header border d-flex justify-content-between bg-danger text-white">
        <div class="d-flex">
            <strong class="p-2">SEÇTİĞİNİZ DERSLERİN AKTS'si 45'DEN BÜYÜK OLAMAZ</strong>
        </div>
    </div>

    <?php unset($_SESSION['aktsHata']) ; } ?>
        <div class="student-info-header border d-flex justify-content-between bg-secondary text-white">
            <div class="d-flex">
                <strong class="p-2"><?php echo $_SESSION['ogrenci']; ?> - Mühendislik Fakültesi - Bilgisayar Mühendisliği Bölümü - Lisans - Normal Öğretim Eğitim Dönemi : 6200401028 Mühendislik Fakültesi - Bilgisayar Mühendisliği</strong>
            </div>
        </div>

        <div class="student-info-header border d-flex justify-content-between mb-3">
            <div class="d-flex">
                <strong class="p-2">Danışman:</strong>
                <p class="p-2"><?php echo $ogrenci['ograd']." ".$ogrenci['ogrsoyad']; ?></p>
            </div>
            <div class="d-flex">
                <strong class="p-2">Öğrenci:</strong>
                <p class="p-2"><?php echo $_SESSION['ogrenci']." ".$ogrenci['ad']." ".$ogrenci['soyad'] ?></p>
            </div>
            <div class="d-flex">
                <strong class="p-2">Sınıf:</strong>
                <p class="p-2"><?php if($ogrenci['donem']%2==0){
                    echo $ogrenci['donem']/2;
                }else{
                    echo $ogrenci['donem']/2 + 0.5;
                } ?></p>
            </div>
            <div class="d-flex">
                <strong class="p-2">Durum:</strong>
                <p class="p-2"><?php if(isset($_SESSION['danisman_onayinda'])){
                    echo "Danışman Onayındaa";
                }else{
                    echo "kayıt yapılmadı";
                } ?></p>
            </div>
            <div class="d-flex">
                <strong class="p-2">Öğretim Planı:</strong>
                <p class="p-2">örgün</p>
            </div>
            <div class="d-flex">
                <strong class="p-2">Gano:</strong>
                <p class="p-2">2,98</p>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div> </div>
            <a href="Dersseciminidanismanagonder.php"><button class="mb-3 btn btn-success">Ders Seçimini Kaydet</button></a>
        </div>

        <div class="row">

            <div class="col-md-4 ">
                <div class="student-menu border-bottom link-container p-3 mb-3">
                    <div class="border-bottom p-2 d-flex justify-content-between">
                        <strong>Seçili Dersler</strong>
                        <button class="btn btn-secondary p-2 mb-2" type="button">Detayları Göster</button>
                    </div>
                    <div class="d-flex justify-content-between p-3 mb-2 secili-ders-container">
                        <div class="text-center">
                            <p>En Fazla AKTS</p>
                            <strong>45</strong>
                        </div class="text-center">
                        <div>
                            <p>Seçili AKTS</p>
                            <strong><?php if($seciliAkts['TOPLAMAKTS']==0){
                                echo 0;
                            }else{ echo $seciliAkts['TOPLAMAKTS']; } ?></strong>
                        </div>
                        <div class="text-center">
                            <p>Kalan AKTS</p>
                            <strong><?php echo 45 - $seciliAkts['TOPLAMAKTS']; ?></strong>
                        </div>
                    </div>

                    <!-- secili dersler -->
                    <div>
                        <table>
                            <thead>
                                <?php $sira=1; ?>
                                <tr>
                                    <th>Sıra</th>
                                    <th>Ders Kodu</th>
                                    <th>Ders Adı</th>
                                    <th>AKTS</th>
                                    <th>Kaldır</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($seciliDers = $result5->fetch_assoc()): ?>
                                    <tr>
                                        <th><?php echo $sira++; ?></th>
                                        <th><?php echo htmlspecialchars($seciliDers['ders_kodu']); ?></th>
                                        <th><?php echo htmlspecialchars($seciliDers['ders_ismi']); ?></th>
                                        <th><?php echo htmlspecialchars($seciliDers['akts']); ?></th>
                                        <th><a href="secilisil.php?id=<?php echo $seciliDers['id']  ;?>"><button>Kaldır</button></a></th>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <div class="color-palette mt-3">
                            <div class="d-flex p-1">
                                <div class="secili-dersler"></div>
                                <div>Seçilmiş Dersler</div>
                            </div>
                            <div class="d-flex p-1">
                                <div class="zorunlu-secili-dersler"></div>
                                <div>Zorunlu Seçilmiş Dersler</div>
                            </div>
                            <div class="d-flex p-1">
                                <div class="secmeli-secili-dersler"></div>
                                <div>Seçilmiş Seçmeli Dersler</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-8">
                <div class="shortcut-container secilecek-dersler card p-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Zorunlu Dersler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Üst Dönem Dersleri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab2" aria-selected="false">Başarılı Olunan Dersler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab2" aria-selected="false">Seçmeli Dersler</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Seçiniz</th>
                                                <th>Ders Kodu</th>
                                                <th>Ders Adı</th>
                                                <th>AKTS</th>
                                                <th>Dönem</th>
                                                <th>Açıklama</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($zorunluDers = $result3->fetch_assoc()): ?>
    <tr>
        <td><a href="seciliekle.php?dersid=<?php echo $zorunluDers['Ders_id'];?>&dersKodu=<?php echo $zorunluDers['Ders_kodu']?>&dersismi=<?php echo $zorunluDers['Ders_ismi'];?>&akts=<?php echo $zorunluDers['akts'];?>"><button class="btn btn-success">Seçiniz</button></a></td>
        <td><?php echo htmlspecialchars($zorunluDers['Ders_kodu']); ?></td>
        <td><?php echo htmlspecialchars($zorunluDers['Ders_ismi']); ?></td>
        <td><?php echo htmlspecialchars($zorunluDers['akts']); ?></td>
        <td><?php echo htmlspecialchars($zorunluDers['kredi']); ?></td>
        <td>Alabilir</td>
    </tr>
<?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- üst dönem dersleri -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Seçiniz</th>
                                                <th>Ders Kodu</th>
                                                <th>Ders Adı</th>
                                                <th>AKTS</th>
                                                <th>Dönem</th>
                                                <th>Şube</th>
                                                <th>Açıklama</th>
                                                <th>Harf Not</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><button class="btn btn-success">seçiniz</button></td>
                                                <td><a href="#">BM-2301</a></td>
                                                <td>Nesneye Yönelik Programlama</td>
                                                <td>5</td>
                                                <td>1</td>
                                                <td>
                                                    <select class="form-control" id="sube">
                                                        <option value="">Seçiniz...</option>
                                                        <option value="teacher1@example.com">A - Prof. Dr. Saitcan Yücebaş A Şubesi</option>
                                                    </select>
                                                </td>
                                                <td>Alabilir</td>
                                                <td> - </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- basarılı olunan dersler -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Seçiniz</th>
                                                <th>Ders Kodu</th>
                                                <th>Ders Adı</th>
                                                <th>AKTS</th>
                                                <th>Dönem</th>
                                                <th>Şube</th>
                                                <th>Açıklama</th>
                                                <th>Harf Not</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><button class="btn btn-success">seçiniz</button></td>
                                                <td><a href="#">BM-2301</a></td>
                                                <td>Veri Yapıları</td>
                                                <td>5</td>
                                                <td>1</td>
                                                <td>
                                                    <select class="form-control" id="sube">
                                                        <option value="">Seçiniz...</option>
                                                        <option value="teacher1@example.com">A - Prof. Dr. İsmail KADAYIF A Şubesi</option>
                                                    </select>
                                                </td>
                                                <td>Alabilir</td>
                                                <td> - </td>
                                            </tr>
                                            <!-- another lecture -->

                                            <tr>
                                                <td><button class="btn btn-success">seçiniz</button></td>
                                                <td><a href="#">BM-2301</a></td>
                                                <td>Veri Yapıları</td>
                                                <td>5</td>
                                                <td>1</td>
                                                <td>
                                                    <select class="form-control" id="sube">
                                                        <option value="">Seçiniz...</option>
                                                        <option value="teacher1@example.com">A - Prof. Dr. İsmail KADAYIF A Şubesi</option>
                                                    </select>
                                                </td>
                                                <td>Alabilir</td>
                                                <td> - </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- secmeli dersler -->
                            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Seçiniz</th>
                                                <th>Ders Kodu</th>
                                                <th>Ders Adı</th>
                                                <th>AKTS</th>
                                                <th>Dönem</th>
                                                <th>Açıklama</th>
                                                <th>Öğrenci Sayısı/ Kota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($secmeliDers = $result4->fetch_assoc()): ?>
                                            <tr>
                                            <td><a href="seciliekle.php?dersid=<?php echo $secmeliDers['Ders_id'];?>&dersKodu=<?php echo $secmeliDers['Ders_kodu']?>&dersismi=<?php echo $secmeliDers['Ders_ismi'];?>&akts=<?php echo $secmeliDers['akts'];?>"><button class="btn btn-success">Seçiniz</button></a></td>
                                                <td><a href="#"><?php echo htmlspecialchars($secmeliDers['Ders_kodu']); ?></a></td>
                                                <td><?php echo htmlspecialchars($secmeliDers['Ders_ismi']); ?></td>
                                                <td><?php echo htmlspecialchars($secmeliDers['akts']); ?></td>
                                                <td><?php echo htmlspecialchars($secmeliDers['kredi']); ?></td>
                                                <td>Alabilir</td>
                                                <td><?php echo htmlspecialchars($secmeliDers['limit']); ?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
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
