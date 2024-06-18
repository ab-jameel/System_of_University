<?php
class Adminler {
    private $admin_id;
    private $email;
    private $password;
    private $active;

    // Constructor
    
    public function __construct($conn, $email = null, $password = null, $active = 1, $admin_id = null) {
        if($email && $password) {
            // Yeni admin oluşturma
            $this->email = $email;
            $this->password = $password;
            $this->active = $active;
            $this->create($conn);
            $this->admin_id = $conn->insert_id;
        } elseif ($admin_id) {
            // Mevcut admini yükleme
            $admin = self::read($conn, $admin_id);
            $this->admin_id = $admin['admin_id'];
            $this->email = $admin['email'];
            $this->password = $admin['password'];
            $this->active = $admin['active'];
        }
    }

    // Getters and Setters
    public function getAdminId() {
        return $this->admin_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getActive() {
        return $this->active;
    }

    public function setAdminId($admin_id) {
        $this->admin_id = $admin_id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    // Create
    public function create($conn) {
        $sql = "INSERT INTO Adminler (email, password, active) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi",$this->email, $this->password, $this->active);
        $stmt->execute();
    }

    // Read
    public static function read($conn, $admin_id) {
        $sql = "SELECT * FROM Adminler WHERE admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update
    public function update($conn) {
        $sql = "UPDATE Adminler SET email = ?, password = ?, active = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $this->email, $this->password, $this->active, $this->admin_id);
        $stmt->execute();
    }

    // Delete
    public static function delete($conn, $admin_id) {
        $sql = "DELETE FROM Adminler WHERE admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
    }
    public static function AdminleriiGetir($conn) {
        $sql = "SELECT * FROM Adminler";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $adminler = array();
        while ($row = $result->fetch_assoc()) {
            $adminler[] = $row;
        }
        
        return json_encode($adminler);
    }

    
}

?>