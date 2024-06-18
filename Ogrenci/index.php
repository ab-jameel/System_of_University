<?php
include '../Classes/AllClasses.php';

if (!isset($_SESSION['ogrenci'])) {
    header("Location: ../login.php");
    exit();
}

?>
<?php 
 $sql = "SELECT * FROM ogrenciler WHERE ogrenci_no = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('i',$_SESSION['ogrenci']);
 $stmt->execute();
 $result = $stmt->get_result();
 $ogrenci = $result->fetch_assoc();

 $sql2 = "SELECT * FROM dosyalar WHERE dosya_id = ?";
 $stmt2 = $conn->prepare($sql2);
 $stmt2->bind_param('i',$ogrenci['dosya_id']);
 $stmt2->execute();
 $result2 = $stmt2->get_result();
 $dosya = $result2->fetch_assoc();
 
?>
<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="../style/ogrenci-index.css">
   
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="student-info card p-3 mb-3">
                    <div class="d-flex align-items-center p-2">
                        <img class="profile-photo rounded-circle" src="../Dosyalar/<?php  echo $dosya['dosya_url']; ?>" alt="Profile Photo">
                        <h3 class="profile-name"><?php echo $ogrenci['ad']  . " " . $ogrenci['soyad']; ?></h3>
                    </div>
                    <button  class="btn btn-danger mt-3" onclick="logout()">Log Out</button>
                </div>

                <div class="student-menu card p-3 mb-3">
                    <h3>Hızlı Linkler</h3>
                    <ul class="list-unstyled">

                        <li>
                            <div>
                                <i class="fa-solid fa-link"></i>
                                <a href="">Web Sayfası</a>
                            </div>
                        </li> 
                        <li>
                            <div>
                                <i class="fa-solid fa-phone"></i>
                                <a href="">444 17 18</a>
                            </div>
                        </li>  
                        <li>
                            <div>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="">Kurumsal Mail</a>
                            </div>
                        </li>  

                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="shortcut-container card p-3">
                    <h2>Kişisel Kısayollar</h2>
                    <div class="shortcuts d-flex flex-wrap">
                        <a href="OgrenciBilgiEkrani/index.php" class="shortcut-link d-flex align-items-center justify-content-center">Öğrenci Bilgi Ekranı</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>
