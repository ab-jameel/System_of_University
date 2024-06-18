
<?php

class Dersler {
    private $Ders_id;
    private $Ders_kodu;
    private $Ders_ismi;
    private $dersi_veren_ogretmen_id;
    private $donem;
    private $akts;
    private $kredi;
    private $Ders_turu;
    private $limit;

    // Constructor
    public function __construct($conn, $Ders_id, $Ders_kodu, $Ders_ismi, $dersi_veren_ogretmen_id, $donem, $akts, $kredi, $Ders_turu, $limit) {
        $this->Ders_id = $Ders_id;
        $this->Ders_kodu = $Ders_kodu;
        $this->Ders_ismi = $Ders_ismi;
        $this->dersi_veren_ogretmen_id = $dersi_veren_ogretmen_id;
        $this->donem = $donem;
        $this->akts = $akts;
        $this->kredi = $kredi;
        $this->Ders_turu = $Ders_turu;
        $this->limit = $limit;
    }

    // Getters and Setters
    public function getDersId() {
        return $this->Ders_id;
    }

    public function getDersKodu() {
        return $this->Ders_kodu;
    }

    public function getDersIsmi() {
        return $this->Ders_ismi;
    }

    public function getDersiVerenOgretmenId() {
        return $this->dersi_veren_ogretmen_id;
    }

    public function getDersiVerenOgretmenadi($conn) {
        $sql = "SELECT CONCAT(ad, ' ',soyad) as isim FROM ogretmenler WHERE ogretmen_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->dersi_veren_ogretmen_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['isim'];
    }

    public function getDonem() {
        return $this->donem;
    }

    public function getAkts() {
        return $this->akts;
    }

    public function getKredi() {
        return $this->kredi;
    }

    public function getDersTuru() {
        return $this->Ders_turu;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function setDersId($Ders_id) {
        $this->Ders_id = $Ders_id;
    }

    public function setDersKodu($Ders_kodu) {
        $this->Ders_kodu = $Ders_kodu;
    }

    public function setDersIsmi($Ders_ismi) {
        $this->Ders_ismi = $Ders_ismi;
    }

    public function setDersiVerenOgretmenId($dersi_veren_ogretmen_id) {
        $this->dersi_veren_ogretmen_id = $dersi_veren_ogretmen_id;
    }

    public function setDonem($donem) {
        $this->donem = $donem;
    }

    public function setAkts($akts) {
        $this->akts = $akts;
    }

    public function setKredi($kredi) {
        $this->kredi = $kredi;
    }

    public function setDersTuru($Ders_turu) {
        $this->Ders_turu = $Ders_turu;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO Dersler (Ders_kodu, Ders_ismi, dersi_veren_ogretmen_id, donem, akts, kredi, Ders_turu, `limit`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiisiis", $this->Ders_kodu, $this->Ders_ismi, $this->dersi_veren_ogretmen_id, $this->donem, $this->akts, $this->kredi, $this->Ders_turu, $this->limit);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $Ders_id) {
        $sql = "SELECT * FROM Dersler WHERE Ders_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $Ders_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Dersler SET Ders_kodu = ?, Ders_ismi = ?, dersi_veren_ogretmen_id = ?, donem = ?, akts = ?, kredi = ?, Ders_turu = ?, `limit` = ? WHERE Ders_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiisiisi", $this->Ders_kodu, $this->Ders_ismi, $this->dersi_veren_ogretmen_id, $this->donem, $this->akts, $this->kredi, $this->Ders_turu, $this->limit, $this->Ders_id);
        $stmt->execute();
    }

    // Delete
    public function deleteders($conn) {
        $sql = "DELETE FROM Dersler WHERE Ders_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->Ders_id);
        $stmt->execute();
    }

    public static function DersleriGetir($conn) {
        $sql = "SELECT * FROM Dersler";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $dersler = array();
        while ($row = $result->fetch_assoc()) {
            $dersler[] = $row;
        }

        return json_encode($dersler);
    }
}
?>
