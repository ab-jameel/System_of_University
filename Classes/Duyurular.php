
<?php

class Duyurular {
    private $duyuru_id;
    private $Ders_id;
    private $aciklama;
    private $aciklama_saati;
    private $dosya_id;

    // Constructor
    public function __construct($conn, $Ders_id, $aciklama, $aciklama_saati, $dosya_id) {
        $this->Ders_id = $Ders_id;
        $this->aciklama = $aciklama;
        $this->aciklama_saati = $aciklama_saati;
        $this->dosya_id = $dosya_id;
        $this->create($conn);
        $this->duyuru_id = $conn->insert_id;
    }

    // Getters and Setters
    public function getDuyuruId() {
        return $this->duyuru_id;
    }

    public function getDersId() {
        return $this->Ders_id;
    }

    public function getAciklama() {
        return $this->aciklama;
    }

    public function getAciklamaSaati() {
        return $this->aciklama_saati;
    }

    public function getDosyaId() {
        return $this->dosya_id;
    }

    public function setDuyuruId($duyuru_id) {
        $this->duyuru_id = $duyuru_id;
    }

    public function setDersId($Ders_id) {
        $this->Ders_id = $Ders_id;
    }

    public function setAciklama($aciklama) {
        $this->aciklama = $aciklama;
    }

    public function setAciklamaSaati($aciklama_saati) {
        $this->aciklama_saati = $aciklama_saati;
    }

    public function setDosyaId($dosya_id) {
        $this->dosya_id = $dosya_id;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO Duyurular (Ders_id, aciklama, aciklama_saati, dosya_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $this->Ders_id, $this->aciklama, $this->aciklama_saati, $this->dosya_id);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $duyuru_id) {
        $sql = "SELECT * FROM Duyurular WHERE duyuru_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $duyuru_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Duyurular SET aciklama = ?, aciklama_saati = ?, dosya_id = ? WHERE duyuru_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $this->aciklama, $this->aciklama_saati, $this->dosya_id, $this->duyuru_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $duyuru_id) {
        $sql = "DELETE FROM Duyurular WHERE duyuru_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $duyuru_id);
        $stmt->execute();
    }

    // Get all announcements
    public static function DuyurulariGetir($conn) {
        $sql = "SELECT * FROM Duyurular";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $duyurular = array();
        while ($row = $result->fetch_assoc()) {
            $duyurular[] = $row;
        }

        return json_encode($duyurular);
    }
}
?>
