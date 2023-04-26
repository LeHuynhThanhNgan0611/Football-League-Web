<?php
    require 'db/db.php';
    $conn = create_connection();
    $idteam=(int)$_GET['id'];
    $sql="SELECT * FROM `thongtindoi` WHERE `idteam` = {$idteam}";
    $result=mysqli_query($conn,$sql);
    if(!$result)
    {
        die('lỗi'.mysqli_error($conn));
    }
    $sql2="SELECT * FROM `cauthu` WHERE `idteam` = {$idteam}";
    $result2=mysqli_query($conn,$sql2);
    if(!$result2)
    {
        die('lỗi'.mysqli_error($conn));
    }
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
    <a href="dsdoi.php">ve addteam</a>
    <button class="hidden-sm" id="nhapttct">
        Thêm cầu thủ
    </button>
    <div>
        <?php
            if(mysqli_num_rows($result2)>0){
                while($row=mysqli_fetch_assoc($result2))
                {?>
                    <h5><?php echo $row['ctname'] ?></h5>
                    <h5><?php echo $row['vitri'] ?></h5>
                    <h5><?php echo $row['nationality'] ?></h5>
                    <h5><?php echo $row['birthday'] ?></h5>
                    <a href="db/deletect.php?id=<?php echo $row['idct'];?>">Xóa ct</a>
                <?php
                }
            }
        ?>
       
    </div>


    <div id="myModal" class="abc">
        <form action="db/addct.php?id=<?php echo $idteam?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nhập thông tin thành viên</h5>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="teamname">Tên cầu thủ</label>
                        <input class="form-control" name="ctname" id="ctname" type="text"
                            placeholder="Nhập tên cầu thủ">
                    </div>
                    <div>
                        <label for="hlvname">Quốc tịch</label>
                        <input class="form-control" id="nationality" name="nationality" type="text"
                            placeholder="Nhập quốc tịch">
                    </div>
                    <div>
                        <label for="birthday">Birthday:</label>
                        <input type="date" id="birthday" name="birthday">
                    </div>
                    <div>
                        <label for="vitri">Vị Trí: </label>
                        <select name="vitri" id="vitri">
                            <option value="Thủ môn">Thủ môn</option>
                            <option value="Hậu vệ">Hậu vệ</option>
                            <option value="Tiền vệ">Tiền vệ</option>
                            <option value="Tiền đạo">Tiền đạo</option>
                        </select>
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