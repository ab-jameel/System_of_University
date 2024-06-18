<?php
include '../../../Classes/AllClasses.php';

if (!isset($_SESSION['ogretmen'])) {

    header("Location: ../../../login.php");
    exit();
}

?>
<?php
$sql = "SELECT d.Ders_kodu,d.Ders_ismi,d.Ders_id FROM dersler d
LEFT JOIN ogretmenler o ON o.ogretmen_id = d.dersi_veren_ogretmen_id
WHERE o.ogretmen_id=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['ogretmen']);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../../style/ders-kayit.css">
<style>
     /* Style the dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Style the dropdown button */
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        /* The container for the dropdown items */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Style the dropdown links */
        .dropdown-content a {
            color: black;
            margin-top:1rem;
            margin-left:1rem;
            text-decoration: none;
            display: block;
            
        }

        /* Change the color of the links on hover */
        .dropdown-content a:hover {
            background-color: #f1f1f1;
            border-radius:1rem;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button on hover */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
</style>
</head>
<body>
    <?php include '../../header.php';?>
    <main class="container-fluid mt-6">
        <div class="row">
            <div class="w-100">
                <div class="shortcut-container secilecek-dersler card p-3">
                    <table id="lectureTable">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>Dersi Açan Birim</th>
                                <th>Program</th>
                                <th>Kodu</th>
                                <th>Adı</th>
                                <th>Yıl</th>
                                <th>Dönem</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td></td>
                                    <td>Dersi Açan Birim</td>
                                    <td>Program</td>
                                    <td><?php echo $row['Ders_kodu']; ?></td>
                                    <td><?php echo $row['Ders_ismi']; ?></td>
                                    <td>2024</td>
                                    <td>Bahar</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropbtn">İşlemler</button>
                                            <div class="dropdown-content">
                                                <a href="Hafta_icerikleri/?dersid=<?php echo $row['Ders_id'] ?>">
                                                    <div class="d-flex">
                                                        <i class="p-1 fa-solid fa-info"></i>
                                                        <p class="p-1 ml-2"> Hafta İçerikleri </p>
                                                    </div>
                                                </a>
                                                <a href="Duyurular/?dersid=<?php echo $row['Ders_id'] ?>">
                                                    <div class="d-flex p-1">
                                                        <i class="p-1 fa-solid fa-bullhorn"></i>
                                                        <p class="p-1 ml-2">Duyurular</p>
                                                    </div>
                                                </a>
                                                <a href="Notlar/?dersid=<?php echo $row['Ders_id'] ?>">
                                                    <div class="d-flex p-1">
                                                        <i class="p-1 fa-solid fa-newspaper"></i>
                                                        <p class="p-1 ml-2">Not İşlemleri</p>
                                                    </div>
                                                </a>
                                                <a href="Odevler/?dersid=<?php echo $row['Ders_id'] ?>">
                                                    <div class="d-flex p-1">
                                                        <i class="p-1 fas fa-tasks"></i>
                                                        <p class="p-1 ml-2">Ödevler</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../scripts/ogrenci-index.js"></script>
    <script>
        function logout() {
            window.location.href = '../../logout.php';
        }
    </script>
</body>
</html>
