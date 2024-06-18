
<?php
class HaftaIcerikleri {
    private $icerik_id;
    private $icerik_adi;
    private $icerik_tipi;
    private $aciklama;
    private $tarih;
    private $dosya_id;

    // Constructor
    public function __construct($icerik_id, $icerik_adi, $icerik_tipi, $aciklama, $tarih, $dosya_id) {
        $this->icerik_id = $icerik_id;
        $this->icerik_adi = $icerik_adi;
        $this->icerik_tipi = $icerik_tipi;
        $this->aciklama = $aciklama;
        $this->tarih = $tarih;
        $this->dosya_id = $dosya_id;
    }

    // Getters and Setters
    public function getIcerikId() {
        return $this->icerik_id;
    }

    public function getIcerikAdi() {
        return $this->icerik_adi;
    }

    public function getIcerikTipi() {
        return $this->icerik_tipi;
    }

    public function getAciklama() {
        return $this->aciklama;
    }

    public function getTarih() {
        return $this->tarih;
    }

    public function getDosyaId() {
        return $this->dosya_id;
    }

    public function setIcerikId($icerik_id) {
        $this->icerik_id = $icerik_id;
    }

    public function setIcerikAdi($icerik_adi) {
        $this->icerik_adi = $icerik_adi;
    }

    public function setIcerikTipi($icerik_tipi) {
        $this->icerik_tipi = $icerik_tipi;
    }

    public function setAciklama($aciklama) {
        $this->aciklama = $aciklama;
    }

    public function setTarih($tarih) {
        $this->tarih = $tarih;
    }

    public function setDosyaId($dosya_id) {
        $this->dosya_id = $dosya_id;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO hafta_icerikleri (icerik_id, icerik_adi, icerik_tipi, aciklama, tarih, dosya_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssi", $this->icerik_id, $this->icerik_adi, $this->icerik_tipi, $this->aciklama, $this->tarih, $this->dosya_id);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $icerik_id) {
        $sql = "SELECT * FROM hafta_icerikleri WHERE icerik_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $icerik_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE hafta_icerikleri SET icerik_adi = ?, icerik_tipi = ?, aciklama = ?, tarih = ?, dosya_id = ? WHERE icerik_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $this->icerik_adi, $this->icerik_tipi, $this->aciklama, $this->tarih, $this->dosya_id, $this->icerik_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $icerik_id) {
        $sql = "DELETE FROM hafta_icerikleri WHERE icerik_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $icerik_id);
        $stmt->execute();
    }
}


?>