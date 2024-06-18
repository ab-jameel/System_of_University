<?php
include 'Classes/AllClasses.php';
?>
<?php
if (isset($_SESSION['ogrenci'])) {
    header("Location: Ogrenci/index.php");
    exit();
}
if (isset($_SESSION['ogretmen'])) {
    header("Location: Ogretmen/index.php");
    exit();
}
if (isset($_SESSION['admin'])) {
    header("Location: Admin/index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style/login.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
      integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style source="style/login.css"></style>
</head>
<body>
<div class="navbar" id="navbar">
    <ul>
        <li><a href="#hakkimizda">Hakkımızda</a></li>
        <li><a href="#duyurular">Duyurular</a></li>
        <li><a href="#dil-degistirme">Dil Değiştirme</a></li>
    </ul>
</div>
<div class="login-container">
    <img src="static/images/logo.png" alt="myimage">
    <form action="#" method="post">
        <div class="password-id-input-container">
            <label for="id">Email</label>
            <input type="text" id="username" name="email" required>
            <label for="password">Şifre</label>
            <input type="password" id="password" name="password" required>
            <a href="https://www.google.com">Giriş yapamıyor musun?</a>
            <button type="submit">Giriş Yap</button>
        </div>
        <div class="social-media-icons">
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
    </form>
</div>
<script src="scripts/login.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM adminler WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin'] = $admin['admin_id'];
        header("Location: Admin/index.php");
        exit();
    }

    $sql2 = "SELECT * FROM Ogretmenler WHERE email = ? AND password = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('ss', $email, $password);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($result2->num_rows > 0) {
        $ogretmen = $result2->fetch_assoc();
        $_SESSION['ogretmen'] = $ogretmen['ogretmen_id'];
        header("Location: Ogretmen/index.php");
        exit();
    }

    $sql3 = "SELECT * FROM Ogrenciler WHERE email = ? AND password = ?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param('ss', $email, $password);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    if ($result3->num_rows > 0) {
        $ogrenci = $result3->fetch_assoc();
        $_SESSION['ogrenci'] = $ogrenci['ogrenci_no'];
        header("Location: Ogrenci/index.php");
        exit();
    }

    $login_error = "Geçersiz email veya şifre!";
}
?>

<?php if (isset($login_error)): ?>
    <div class="error-message"><?php echo $login_error; ?></div>
<?php endif; ?>
