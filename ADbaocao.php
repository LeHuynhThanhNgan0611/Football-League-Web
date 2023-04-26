<?php
require 'db/db.php';
$conn = create_connection();
session_start();
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
} else {
    if ($_SESSION['position'] == 0 ) {
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
                    <h2>Báo cáo</h2>
                </div>
                <div class='card-body'>
                    <form action="db/addbaocao.php" method="post" enctype="multipart/form-data">
                        <label for="">Tiêu đề</label>
                        <input class="form-control" name="tieude"></input>
                        <label for="exampleFormControlTextarea1">Nội dung</label>
                        <textarea class="form-control" name="noidung" id="exampleFormControlTextarea1" rows="8"></textarea>
                        <div class="content__button_right" style="margin: 30px 10px 0 0;">
                            <button type="submit" name="submit" class="btn btn-primary" value="dangki">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/adviewmenu.php' ?>
<?php
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "DoneBC") {
?>
        <script>
            swal({
                title: "Thành công!",
                text: "Thao tác thành công",
                icon: "success",
                button: "Đóng",
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