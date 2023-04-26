<?php
    require 'db/db.php';
    $conn = create_connection();
    $sql="SELECT * FROM `thongtindoi`";  
    $result=mysqli_query($conn,$sql); 
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
        Thêm đội
    </button>
    <div>
        <?php
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result))
                {?> 
                    <img src="img/gallery/<?php  echo $row['img'];?>" alt="">
                    <h3>Id: <?php echo $row['idteam'] ?></h3>
                    <h3><?php echo $row['teamname'] ?></h3>
                    <h5><?php echo $row['hlvname'] ?></h5>
                    <a href="db/deleteteam.php?id=<?php echo $row['idteam'];?>">Xóa team</a>
                    <a href="infoteam.php?id=<?php echo $row['idteam'];?>">Thông tin</a>    
                    <br>               
                <?php
                }
            }
        ?>
       
    </div>

    
    <div id="myModal" class="abc">
        <form action="db/addteam.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nhập thông tin đội</h5>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="teamname">Tên đội</label>
                        <input class="form-control" name="teamname" id="teamname" type="text"
                            placeholder="Nhập tên đội">
                    </div>
                    <div class="form-group">
                        <label for="hlvname">Huấn luyện viên</label>
                        <input class="form-control" id="hlvname" name="hlvname" type="text"
                            placeholder="Nhập tên huấn luyện viên">
                    </div>
                    <div class="form-group">
                      Logo đội:<input for="img" type="file" name="file" id="file">
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