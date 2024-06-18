
<?php
class Dosyalar {
    private $dosya_id;
    private $dosya_url;

    // Constructor
    public function __construct($dosya_id, $dosya_url) {
        $this->dosya_id = $dosya_id;
        $this->dosya_url = $dosya_url;
    }

    // Getters and Setters
    public function getDosyaId() {
        return $this->dosya_id;
    }

    public function getDosyaUrl() {
        return $this->dosya_url;
    }

    public function setDosyaId($dosya_id) {
        $this->dosya_id = $dosya_id;
    }

    public function setDosyaUrl($dosya_url) {
        $this->dosya_url = $dosya_url;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO Dosyalar (dosya_id, dosya_url) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $this->dosya_id, $this->dosya_url);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $dosya_id) {
        $sql = "SELECT * FROM Dosyalar WHERE dosya_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $dosya_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Dosyalar SET dosya_url = ? WHERE dosya_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $this->dosya_url, $this->dosya_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $dosya_id) {
        $sql = "DELETE FROM Dosyalar WHERE dosya_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $dosya_id);
        $stmt->execute();
    }
}

?>