<?php
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT * FROM `lichthidau` WHERE `ve` = 0";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM `soluongve`";
$result2 = mysqli_query($conn, $sql2);
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
    <button class="hidden-sm" id="nhapttct">
        tạo vé
    </button>

    <div>
    <?php
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
    ?>
    ID match : <?php echo $row2['idmatch'] ?>
    <br>
    Vé thường: <input disabled value="<?php echo $row2['vethuong'] ?>" >
    Vé vip : <input disabled value="<?php echo $row2['vevip'] ?>" >
    <br>
    <?php
        }
        mysqli_data_seek($result2, 0);
    }
    ?>
    </div>


    <div id="myModal" class="abc">
        <form action="db/addve.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo vé</h5>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <div>
                        <select name="selectmatch" id="selectmatch">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['idmatch'] ?>">
                                Trận <?php echo  $row['idmatch']?>: <?php echo  $row['homename']." - ". $row['awayname']." (".$row['matchdate'];?>)</option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="vethuong">Vé thường</label>
                        <input  id="vethuong" type="number" name="vethuong" value="0">
                    </div>
                    <div>
                        <label for="vevip">Vé vip</label>
                        <input  id="vevip" type="number" name="vevip" value="0">
                    </div>

                    <button type="button" class="btn btn-secondary close-footer">
                        Đóng
                    </button>
                    <button name="submit" type="submit" class="btn btn-primary order" value="dangki">
                        Nhập
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src='fp.js'></script>
</html>