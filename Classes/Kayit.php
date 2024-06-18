
<?php
class Kayit {
    private $kayit_id;
    private $Ders_id;
    private $Dersi_alan_ogrenci_id;
    private $Vize;
    private $final;
    private $Butunleme;
    private $kayit_tarihi;
    private $active;

    // Constructor
    public function __construct($kayit_id, $Ders_id, $Dersi_alan_ogrenci_id, $Vize, $final, $Butunleme, $kayit_tarihi, $active) {
        $this->kayit_id = $kayit_id;
        $this->Ders_id = $Ders_id;
        $this->Dersi_alan_ogrenci_id = $Dersi_alan_ogrenci_id;
        $this->Vize = $Vize;
        $this->final = $final;
        $this->Butunleme = $Butunleme;
        $this->kayit_tarihi = $kayit_tarihi;
        $this->active = $active;
    }

    // Getters and Setters
    public function getKayitId() {
        return $this->kayit_id;
    }

    public function getDersId() {
        return $this->Ders_id;
    }

    public function getDersiAlanOgrenciId() {
        return $this->Dersi_alan_ogrenci_id;
    }

    public function getVize() {
        return $this->Vize;
    }

    public function getFinal() {
        return $this->final;
    }

    public function getButunleme() {
        return $this->Butunleme;
    }

    public function getKayitTarihi() {
        return $this->kayit_tarihi;
    }

    public function getActive() {
        return $this->active;
    }

    public function setKayitId($kayit_id) {
        $this->kayit_id = $kayit_id;
    }

    public function setDersId($Ders_id) {
        $this->Ders_id = $Ders_id;
    }

    public function setDersiAlanOgrenciId($Dersi_alan_ogrenci_id) {
        $this->Dersi_alan_ogrenci_id = $Dersi_alan_ogrenci_id;
    }

    public function setVize($Vize) {
        $this->Vize = $Vize;
    }

    public function setFinal($final) {
        $this->final = $final;
    }

    public function setButunleme($Butunleme) {
        $this->Butunleme = $Butunleme;
    }

    public function setKayitTarihi($kayit_tarihi) {
        $this->kayit_tarihi = $kayit_tarihi;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO kayit (kayit_id, Ders_id, Dersi_alan_ogrenci_id, Vize, final, Butunleme, kayit_tarihi, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiissi", $this->kayit_id, $this->Ders_id, $this->Dersi_alan_ogrenci_id, $this->Vize, $this->final, $this->Butunleme, $this->kayit_tarihi, $this->active);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $kayit_id) {
        $sql = "SELECT * FROM kayit WHERE kayit_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kayit_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE kayit SET Ders_id = ?, Dersi_alan_ogrenci_id = ?, Vize = ?, final = ?, Butunleme = ?, kayit_tarihi = ?, active = ? WHERE kayit_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiisii", $this->Ders_id, $this->Dersi_alan_ogrenci_id, $this->Vize, $this->final, $this->Butunleme, $this->kayit_tarihi, $this->active, $this->kayit_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $kayit_id) {
        $sql = "DELETE FROM kayit WHERE kayit_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kayit_id);
        $stmt->execute();
    }
}
?>