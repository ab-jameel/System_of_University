<?php

include 'Duyurular.php';



$Ders_id = 1;
$aciklama = "Yeni ders materyalleri eklendi.";
$aciklama_saati = date("Y-m-d H:i:s");
$dosya_id = null; // Dosya ID varsa buraya eklenebilir

// Duyurular sınıfından bir örnek oluşturun ve duyuru oluşturun
$duyuru = new Duyurular($conn, $Ders_id, $aciklama, $aciklama_saati, $dosya_id);

// Tüm duyuruları JSON formatında döndür
$json_data = Duyurular::DuyurulariGetir($conn);

// JSON verisini ekrana yazdırın
echo $json_data;

// Veritabanı bağlantısını kapat
$conn->close();
?>
