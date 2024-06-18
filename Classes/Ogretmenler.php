
<?php
class Ogretmenler {
    private $ogretmen_id;
    private $ad;
    private $soyad;
    private $email;
    private $password;
    private $tc;
    private $dosya_id;

    // Constructor
    public function __construct($ogretmen_id, $ad, $soyad, $email, $password, $tc, $dosya_id) {
        $this->ogretmen_id = $ogretmen_id;
        $this->ad = $ad;
        $this->soyad = $soyad;
        $this->email = $email;
        $this->password = $password;
        $this->tc = $tc;
        $this->dosya_id = $dosya_id;
    }

    // Getters and Setters
    public function getOgretmenId() {
        return $this->ogretmen_id;
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

    public function getDosyaId() {
        return $this->dosya_id;
    }

    public function setOgretmenId($ogretmen_id) {
        $this->ogretmen_id = $ogretmen_id;
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

    public function setDosyaId($dosya_id) {
        $this->dosya_id = $dosya_id;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO Ogretmenler (ogretmen_id, ad, soyad, email, password, tc, dosya_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssii", $this->ogretmen_id, $this->ad, $this->soyad, $this->email, $this->password, $this->tc, $this->dosya_id);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $ogretmen_id) {
        $sql = "SELECT * FROM Ogretmenler WHERE ogretmen_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ogretmen_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Ogretmenler SET ad = ?, soyad = ?, email = ?, password = ?, tc = ?, dosya_id = ? WHERE ogretmen_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiii", $this->ad, $this->soyad, $this->email, $this->password, $this->tc, $this->dosya_id, $this->ogretmen_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $ogretmen_id) {
        $sql = "DELETE FROM Ogretmenler WHERE ogretmen_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ogretmen_id);
        $stmt->execute();
    }
}
?>