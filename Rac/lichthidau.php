<?php
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT * FROM `thongtindoi`";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM `lichthidau`";
$result2 = mysqli_query($conn, $sql2);
$a=2;
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
        Thêm tran
    </button>
    <div>
    <?php
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
    ?> <form action="db/updatetiso.php?idmatch=<?php echo $row2['idmatch'];?>" method="post" enctype="multipart/form-data">
        <h5><?php echo $row2['homename'] ?>-<?php echo $row2['awayname'] ?></h5>
        <input disabled id="homegoal<?php echo $a?>" type="number" name="homegoal" class="homegoal goal"
            value="<?php echo $row2['homegoal'] ?>"> -
        <input disabled id="awaygoal<?php echo $a?>" type="number" name="awaygoal" class="awaygoal goal"
            value="<?php echo $row2['awaygoal'] ?>">
        <h5><?php echo $row2['matchdate'] ?></h5>
        <div> 
            <button type="button" onclick="undisableTxt(this.id)" class="hidden-sm" id="<?php echo $a?>">
                Chỉnh sửa
            </button>
            <button disabled type="submit" id="submit<?php echo $a?>" name="submit2" class="hidden-sm" value="update" >
                Xác nhận
            </button>
        </div>
    </form>
    <?php
        $a++;
        }
        mysqli_data_seek($result2, 0);
    }
    ?>
    </div>
    <div id="myModal" class="abc">
        <form action="db/addmatch.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm trận</h5>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <h3>Doinha</h3>
                    <div>
                        <select name="doinha" id="doinha">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['idteam'] ?>">
                                ID:<?php echo $row['idteam'] . " " . $row['teamname']; ?></option>
                            <?php
                                }
                                mysqli_data_seek($result, 0);
                            }
                            ?>
                        </select>
                    </div>
                    <h3>Doikhach</h3>
                    <div>
                        <select name="doikhach" id="doikhach">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['idteam'] ?>">
                                ID:<?php echo $row['idteam'] . " " . $row['teamname'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="matchdate">Ngay thi dau:</label>
                        <input type="date" id="matchdate" name="matchdate">
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