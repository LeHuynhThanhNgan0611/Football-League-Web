<?php
require 'db/db.php';

$conn = create_connection();
$sql = "SELECT * FROM `thongtindoi`";
$result = mysqli_query($conn, $sql);
session_start();
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
} else {
    if ($_SESSION['position'] != 3 && $_SESSION['position'] != 2) {
        $usercheck = 'user';
        header('Location: Home.php');
    }
}
?>
<?php include 'view/adviewheader.php' ?>
<div class='dashboard-app'>
    <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
    <div class='dashboard-content'>
        <div class='container'>
            <div class='card'>
                <div class='card-header'>
                    <h2>Danh sách đội</h2>
                </div>
                <div class='card-body'>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 80%;">
                                <div class="gird-container">
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <div class="box">
                                                <h3 class="name-team"><?php echo $row['teamname'] ?></h3>
                                                <img class="img-team" src="img/gallery/<?php echo $row['img']; ?>" alt="">
                                                <h3 class="id-team">Mã đội bóng: <?php echo $row['idteam'] ?></h3>
                                                <h5 class="name-hlv">Huấn luyện viên: <?php echo $row['hlvname'] ?></h5>
                                                <a href="ADchitietdoi.php?id=<?php echo $row['idteam']; ?>"><button type="button" class="btn btn-info">Thông tin</button></a>
                                                <br>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td style=" width: 20%; text-align: center;">
                                <button class="btn btn-primary" class="hidden-sm" id="nhapttct">
                                    Thêm đội
                                </button>
                            </td>
                        </tr>
                    </table>
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
                                        <input class="form-control" name="teamname" id="teamname" type="text" placeholder="Nhập tên đội">
                                    </div>
                                    <div class="form-group">
                                        <label for="hlvname">Huấn luyện viên</label>
                                        <input class="form-control" id="hlvname" name="hlvname" type="text" placeholder="Nhập tên huấn luyện viên">
                                    </div>
                                    <div class="form-group">
                                        Logo đội:<input for="img" type="file" name="file" id="file">
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        if (!empty($error)) {
                                            echo "<div class='alert alert-danger'>$error</div>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary close-footer">
                                            Đóng
                                        </button>
                                        <button name="submit" type="submit" class="btn btn-primary order" value="dangki">
                                            Nhập
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/adviewmenu.php' ?>
<?php
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "DoneDoi") {
?>
        <script>
            swal({
                title: "Thành công!",
                text: "Thao tác thành công",
                icon: "success",
                button: "Aww yisss",
            });
        </script>
    <?php
        unset($_SESSION['status']);
    } else {
    ?>
        <script>
            swal({
                title: "Lỗi!",
                text: "Bạn cần nhập đầy đủ thông tin",
                icon: "error",
                button: "Đóng",
            });
        </script>
<?php
        unset($_SESSION['status']);
    }
}
?>