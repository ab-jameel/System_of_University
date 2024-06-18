
<?php

class Ogrenciler {
    private $ogrenci_no;
    private $ad;
    private $soyad;
    private $email;
    private $password;
    private $tc;
    private $donem;
    private $Danisman_ogretmen_id;
    private $dosya_id;

    // Constructor
    public function __construct($ogrenci_no, $ad, $soyad, $email, $password, $tc, $donem, $Danisman_ogretmen_id, $dosya_id) {
        $this->ogrenci_no = $ogrenci_no;
        $this->ad = $ad;
        $this->soyad = $soyad;
        $this->email = $email;
        $this->password = $password;
        $this->tc = $tc;
        $this->donem = $donem;
        $this->Danisman_ogretmen_id = $Danisman_ogretmen_id;
        $this->dosya_id = $dosya_id;
    }

    // Getters and Setters
    public function getOgrenciNo() {
        return $this->ogrenci_no;
    }

    public function getAd() {
        return $this->ad;
    }

    public function getSoyad() {
        return $this->soyad;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTc() {
        return $this->tc;
    }

    public function getDonem() {
        return $this->donem;
    }

    public function getDanismanOgretmenId() {
        return $this->Danisman_ogretmen_id;
    }

    public function getDanismanOgretmenadi($conn) {
        $sql = "SELECT CONCAT(ad, ' ',soyad) as isim FROM ogretmenler WHERE ogretmen_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->Danisman_ogretmen_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['isim'];
    }

    public function getDosyaId() {
        return $this->dosya_id;
    }

    public function setOgrenciNo($ogrenci_no) {
        $this->ogrenci_no = $ogrenci_no;
    }

    public function setAd($ad) {
        $this->ad = $ad;
    }

    public function setSoyad($soyad) {
        $this->soyad = $soyad;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTc($tc) {
        $this->tc = $tc;
    }

    public function setDonem($donem) {
        $this->donem = $donem;
    }

    public function setDanismanOgretmenId($Danisman_ogretmen_id) {
        $this->Danisman_ogretmen_id = $Danisman_ogretmen_id;
    }

    public function setDosyaId($dosya_id) {
        $this->dosya_id = $dosya_id;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO Ogrenciler (ogrenci_no, ad, soyad, email, password, tc, donem, Danisman_ogretmen_id, dosya_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssiii", $this->ogrenci_no, $this->ad, $this->soyad, $this->email, $this->password, $this->tc, $this->donem, $this->Danisman_ogretmen_id, $this->dosya_id);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $ogrenci_no) {
        $sql = "SELECT * FROM Ogrenciler WHERE ogrenci_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ogrenci_no);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Ogrenciler SET ad = ?, soyad = ?, email = ?, password = ?, tc = ?, donem = ?, Danisman_ogretmen_id = ?, dosya_id = ? WHERE ogrenci_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiiii", $this->ad, $this->soyad, $this->email, $this->password, $this->tc, $this->donem, $this->Danisman_ogretmen_id, $this->dosya_id, $this->ogrenci_no);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $ogrenci_no) {
        $sql = "DELETE FROM Ogrenciler WHERE ogrenci_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ogrenci_no);
        $stmt->execute();
    }
}





?>