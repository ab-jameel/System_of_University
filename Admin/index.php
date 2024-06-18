<?php
include '../Classes/AllClasses.php';
?>
<?php 
 if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
 }
 header("Location:AdminPanel/index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Button</title>
</head>
<body>

<!-- Diğer HTML içeriğiniz -->

<!-- Buton -->
<button onclick="logout()">Logout</button>

<!-- JavaScript ile yönlendirme -->
<script>
function logout() {
    window.location.href = 'logout.php';
}
</script>

</body>
</html>

