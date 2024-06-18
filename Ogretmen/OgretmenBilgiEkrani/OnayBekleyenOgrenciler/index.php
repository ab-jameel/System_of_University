<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../login.php");
    exit();
}
?>
<?php
$sql = "SELECT o.donem, o.ad, o.ogrenci_no, o.soyad FROM kayit k 
LEFT JOIN ogrenciler o ON o.ogrenci_no = k.Dersi_alan_ogrenci_id 
WHERE k.active = 0 
GROUP BY o.ogrenci_no";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Öğrenci bilgilerini almak için ilk satırı çekiyoruz



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../style/ders-bilgisi.css">
    <style>
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .error {
            border-color: red;
        }
    </style>
</head>
<body>
    <?php include '../../header.php';?>
     <div class="error-popup" id="errorPopup"></div>
      <div class="alert alert-danger error-popup" id="errorPopup" role="alert"></div>
   
    <main>
        <div class="border m-auto">
       
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Şb</th>
                        <th>Öğrenci No</th>
                        <th>Adı</th>
                        <th>Soyadı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($ogrenci = $result->fetch_assoc()): ?>
                        <tr>
                                <td><?php echo $ogrenci['donem']; ?></td>
                                <td><?php echo htmlspecialchars($ogrenci['ogrenci_no']); ?></td>
                                <td><?php echo htmlspecialchars($ogrenci['ad']); ?></td>
                                <td><?php echo htmlspecialchars($ogrenci['soyad']); ?></td>
                                <td>
                                <div>
                                   <a href="onayla.php?id=<?php echo $ogrenci['ogrenci_no'] ;?>"><button class="btn btn-primary">Öğrencinin Seçtiği Dersler</button></a> 
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <div class="center-button">
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../../scripts/ogrenci-index.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const scoreInputs = document.querySelectorAll('.score-input');
            
            scoreInputs.forEach(input => {
                input.addEventListener('input', function (e) {
                    const value = parseFloat(e.target.value);
                    if (isNaN(value) || value < 0 || value > 100) {
                        e.target.classList.add('error');
                        showErrorPopup('Notlar 0 ile 100 arasında olmalıdır.');
                    } else {
                        e.target.classList.remove('error');
                    }
                });
            });

            function showErrorPopup(message) {
                const errorPopup = document.getElementById('errorPopup');
                errorPopup.textContent = message;
                errorPopup.classList.add('show');
                
                setTimeout(() => {
                    errorPopup.classList.remove('show');
                }, 3000); // 3 saniye sonra popup'ı kaldır
            }
        });

        function logout() {
            window.location.href = '../../logout.php';
        }
    </script>


</body>
</html>
