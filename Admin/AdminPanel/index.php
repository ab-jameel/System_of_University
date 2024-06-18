<?php
include '../../Classes/AllClasses.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

?>
<?php 
 $sql = "SELECT * FROM adminler WHERE admin_id = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('i',$_SESSION['admin']);
 $stmt->execute();
 $result = $stmt->get_result();
 $ogrenci = $result->fetch_assoc();

 $sql2 = "SELECT * FROM dosyalar WHERE dosya_id = ?";
 $stmt2 = $conn->prepare($sql2);
 $stmt2->bind_param('i',$admin['dosya_id']);
 $stmt2->execute();
 $result2 = $stmt2->get_result();
 $dosya = $result2->fetch_assoc();
 
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../style/ogrenci-bilgi.css">
</head>
<body>
    <?php include '../header.php';?>
    <main class="container-fluid  p-1">
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="shortcut-container card p-3 text-center">
                    <h2>Kişisel Kısayollar</h2>
                    <div class="shortcuts d-flex flex-wrap p-3 text-center justify-content-center">
                        <div class="shortcut-link d-flex flex-column p-3 align-items-center justify-content-center my_button">
                            <i class="fa-solid fa-arrows-rotate fa-2xl mt-4"></i>
                            <a href="Dersler" class=" mt-4">Dersler</a>
                        </div>
                        <div class="shortcut-link d-flex flex-column p-3 align-items-center justify-content-center my_button">
                            <i class="fa-regular fa-calendar fa-2xl mt-4"></i>
                            <a href="Ogrenciler" class="mt-4">Öğrenciler</a>
                        </div>
                        <div class="shortcut-link d-flex flex-column p-3 align-items-center justify-content-center my_button">
                            <i class="fa-regular fa-calendar fa-2xl mt-4"></i>
                            <a href="Ogretmenler" class="mt-4">Ogretmenler</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../logout.php';
        }
    </script>
</body>
</html>
