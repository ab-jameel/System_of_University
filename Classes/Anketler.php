
<?php
class Anketler {
    private $anket_id;
    private $aciklama;
    private $sontarih;
    private $aktif;
    private $cevap;
    private $admin_id;

    // Constructor
    public function __construct($conn,$aciklama, $sontarih, $aktif, $cevap, $admin_id) {
        
        $this->aciklama = $aciklama;
        $this->sontarih = $sontarih;
        $this->aktif = $aktif;
        $this->cevap = $cevap;
        $this->admin_id = $admin_id;
        $this->create($conn);
        $this->anket_id = $conn->insert_id;
    }

    // Getters and Setters
    public function getAnketId() {
        return $this->anket_id;
    }

    public function getAciklama() {
        return $this->aciklama;
    }

    public function getSontarih() {
        return $this->sontarih;
    }

    public function getAktif() {
        return $this->aktif;
    }

    public function getCevap() {
        return $this->cevap;
    }

    public function getAdminId() {
        return $this->admin_id;
    }


    public function setAciklama($aciklama) {
        $this->aciklama = $aciklama;
    }

    public function setSontarih($sontarih) {
        $this->sontarih = $sontarih;
    }

    public function setAktif($aktif) {
        $this->aktif = $aktif;
    }

    public function setCevap($cevap) {
        $this->cevap = $cevap;
    }


    // Create
    public function create($conn) {
        $sql = "INSERT INTO Anketler (aciklama, sontarih, aktif, cevap, admin_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii",$this->aciklama, $this->sontarih, $this->aktif, $this->cevap, $this->admin_id);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $anket_id) {
        $sql = "SELECT * FROM Anketler WHERE anket_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $anket_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Anketler SET aciklama = ?, sontarih = ?, aktif = ?, cevap = ?, admin_id = ? WHERE anket_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisii", $this->aciklama, $this->sontarih, $this->aktif, $this->cevap, $this->admin_id, $this->anket_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $anket_id) {
        $sql = "DELETE FROM Anketler WHERE anket_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $anket_id);
        $stmt->execute();
    }
    public static function AnketleriGetir($conn) {
        $sql = "SELECT * FROM Anketler";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $anketler = array();
        while ($row = $result->fetch_assoc()) {
            $anketler[] = $row;
        }
        
        return json_encode($anketler);
    }
}
?>
