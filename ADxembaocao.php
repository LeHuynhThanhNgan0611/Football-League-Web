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

$sql = "SELECT * FROM `baocao` ORDER BY `date` desc ";
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
                    <table class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Mã báo cáo</th>
                                <th scope="col">Ngày</th>
                                <th scope="col">Nhân viên</th>
                                <th scope="col">Tiêu đề</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr class="selectbaocao" onclick="selectbaocao(this.id)" id="<?php echo $row['id'] ?>">
                                        <th scope="row"><?php echo $row['id'] ?></th>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php echo $row['user'] ?></td>
                                        <td><?php echo $row['title'] ?></td>                                       
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/adviewmenu.php' ?>