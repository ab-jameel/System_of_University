<?php
include '../../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {
    header("Location: ../../../../login.php");
    exit();
}

$sql = "SELECT * FROM kayit k
LEFT JOIN dersler d ON d.Ders_id = k.kayit_id
LEFT JOIN ogrenciler o ON o.ogrenci_no = k.Dersi_alan_ogrenci_id WHERE k.Ders_id=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['dersid']);
$stmt->execute();
$result = $stmt->get_result();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $vize = $_POST['vize'];
    $final = $_POST['final'];
    $butunleme = $_POST['butunleme'];
    $kayit_id = $_POST['kayit_id'];

    // Veritabanında güncelleme işlemi yap
    for ($i = 0; $i < count($kayit_id); $i++) {
        $sql = "UPDATE kayit SET Vize=?, final=?, Butunleme=? WHERE kayit_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $vize[$i], $final[$i], $butunleme[$i], $kayit_id[$i]);
        if ($stmt->execute()) {
            echo "Veriler başarıyla güncellendi.";
        } else {
            echo "Verileri güncelleme işlemi sırasında bir hata oluştu.";
        }
    }
    header("Location: index.php?dersid=" . $_GET['dersid']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../../style/ders-bilgisi.css">
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
    <?php include '../../../header.php';?>
     <div class="error-popup" id="errorPopup"></div>
      <div class="alert alert-danger error-popup" id="errorPopup" role="alert"></div>
    
    <main>
        <div class="border m-auto">
            <div class="d-flex justify-content-between">
        
                <input class="p-2 h-50 mt-2 mr-2 rounded" type="text" placeholder="Derslerde ara">
            </div>
            <form method="post">
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Şb</th>
                        <th>Öğrenci No</th>
                        <th>Adı</th>
                        <th>Soyadı</th>
                        <th>Vize</th>
                        <th>Final</th>
                        <th>Bütünleme</th>
                        <th>G.N.</th>
                        <th>H.N.</th>
                        <th>B.D</th>
                        <th>D.D.</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($row = $result->fetch_assoc()) {
                        
                        echo "<tr>";
                        echo "<td>" . $row['donem'] . "</td>";
                        echo "<td>" . $row['Dersi_alan_ogrenci_id'] . "</td>";
                        echo "<td>" . $row['ad'] . "</td>";
                        echo "<td>" . $row['soyad'] . "</td>";
                        echo "<td><input type='number' class='score-input' min='0' max='100' step='0.01' name='vize[]' value='" . $row['Vize'] . "'></td>";
                        echo "<td><input type='number' class='score-input' min='0' max='100' step='0.01' name='final[]' value='" . $row['final'] . "'></td>";
                        echo "<td><input type='number' class='score-input' min='0' max='100' step='0.01' name='butunleme[]' value='" . $row['Butunleme'] . "'></td>";
                        echo "<input type='hidden' name='kayit_id[]' value='" . $row['kayit_id'] . "'>";
                        echo "<td>";
if($row['Butunleme'] == 0) {
    echo (($row['Vize']*4 + $row['final']*6)/10);
} else {
    echo (($row['Vize']*4 + $row['Butunleme']*6)/10);
}
echo "</td>";
                        echo "<td>-</td>";
                        echo "<td>"?><?php if($row['Butunleme'] ==0 && $row['final'] ==0 ){
                            echo "Durumu Netleşmedi";
                        }else if($row['final']<50 && $row['Butunleme']==0 ){
                            echo "Başarısız";
                        }
                        else if($row['Butunleme']!=0 && $row['Butunleme']<50){
                            echo "Başarısız";
                        }else if((($row['Vize']*0.4 + $row['final']*0.6) <50)&& $row['Butunleme']==0){
                            echo "Başarısız";
                        }
                        else if((($row['Vize']*0.4 + $row['final']*0.6) >=50) && $row['final']>=50 && $row['Butunleme']==0 ){
                            echo "Başarılı";
                        }
                        else if((($row['Vize']*0.4 + $row['Butunleme']*0.6) >=50) && $row['Butunleme']>=50){
                            echo "Başarılı";
                        }
                        else{
                            echo "Başarısız";
                        }
                        
                        ?><?php echo "</td>";?><?php
                        echo "<td><div class='d-flex'><p>Devamlı</p><button class='btn btn-warning ml-2'>R</button></div></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <div class="center-button">
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </div>
<<<<<<< HEAD
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
        window.location.href = '../../../logout.php';
    }
    </script> 


</body>
</html>
=======
    </form>
    
>>>>>>> main
