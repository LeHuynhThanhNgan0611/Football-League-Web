<?php
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT * FROM `thongtindoi` ORDER BY `tongdiem` desc";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LNP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="chung.css">
</head>

<body>
    <a href="front.php">ve trang chu</a>
    <div>
    <?php
    $a=1;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>  <h6>TOP: <?php echo $a++ ?> </h6>
        <h6>ID: <?php echo $row['idteam'] ?> </h6>
        <h6>Diem: <?php echo $row['tongdiem'] ?> </h6>
    <?php
    
        }
        mysqli_data_seek($result, 0);
    }
    ?>
    </div>
</body>
<script src='fp.js'></script>

</html>