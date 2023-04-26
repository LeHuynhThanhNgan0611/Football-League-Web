<?php
require 'db/db.php';
$conn = create_connection();
session_start();
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
} else {
    if ($_SESSION['position'] != 3) {
        $usercheck = 'user';
        header('Location: Home.php');
    }
}

$temp = $_GET['id'];
$sql = "SELECT * FROM `baocao` Where id = {$temp}";
$result = mysqli_query($conn, $sql);
?>
<?php include 'view/adviewheader.php' ?>
<div class='dashboard-app'>
    <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
    <div class='dashboard-content'>
        <div class='container'>
            <div class='card'>
                <div class='card-header'>
                    <h2>Xem báo cáo</h2>
                </div>
                <div class='card-body'>
                    <?php
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form action="" class="content__chitietbaocao">
                        <label for="">Nhân viên: <?php echo $row['user'] ?></label>
                        <label for="">| Ngày: <?php echo $row['date'] ?></label>
                        <input class="form-control" name="tieude" disabled value="Tiêu đề: <?php echo $row['title'] ?>"></input>
                        <textarea class="form-control" name="noidung"  rows="8" disabled>Nội dung: <?php echo $row['content'] ?></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/adviewmenu.php' ?>