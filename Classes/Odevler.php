
<?php
class Odevler {
    private $odev_id;
    private $aciklama;
    private $dosyaid;
    private $sonteslim;
    private $dersid;
    private $aktif;

    // Constructor
    public function __construct($odev_id, $aciklama, $dosyaid, $sonteslim, $dersid, $aktif) {
        $this->odev_id = $odev_id;
        $this->aciklama = $aciklama;
        $this->dosyaid = $dosyaid;
        $this->sonteslim = $sonteslim;
        $this->dersid = $dersid;
        $this->aktif = $aktif;
    }

    // Getters and Setters
    public function getOdevId() {
        return $this->odev_id;
    }

    public function getAciklama() {
        return $this->aciklama;
    }

    public function getDosyaid() {
        return $this->dosyaid;
    }

    public function getSonteslim() {
        return $this->sonteslim;
    }

    public function getDersid() {
        return $this->dersid;
    }

    public function getAktif() {
        return $this->aktif;
    }

    public function setOdevId($odev_id) {
        $this->odev_id = $odev_id;
    }

    public function setAciklama($aciklama) {
        $this->aciklama = $aciklama;
    }

    public function setDosyaid($dosyaid) {
        $this->dosyaid = $dosyaid;
    }

    public function setSonteslim($sonteslim) {
        $this->sonteslim = $sonteslim;
    }

    public function setDersid($dersid) {
        $this->dersid = $dersid;
    }

    public function setAktif($aktif) {
        $this->aktif = $aktif;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO odevler (odev_id, aciklama, dosyaid, sonteslim, dersid, aktif) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssii", $this->odev_id, $this->aciklama, $this->dosyaid, $this->sonteslim, $this->dersid, $this->aktif);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $odev_id) {
        $sql = "SELECT * FROM odevler WHERE odev_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $odev_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE odevler SET aciklama = ?, dosyaid = ?, sonteslim = ?, dersid = ?, aktif = ? WHERE odev_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisiii", $this->aciklama, $this->dosyaid, $this->sonteslim, $this->dersid, $this->aktif, $this->odev_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $odev_id) {
        $sql = "DELETE FROM odevler WHERE odev_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $odev_id);
        $stmt->execute();
    }
}


?>