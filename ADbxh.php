<?php
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT * FROM `bxh` ORDER BY `pt` desc ";
$result = mysqli_query($conn, $sql);
session_start();
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
} else {
    if ($_SESSION['position'] == 0) {
        $usercheck = 'user';
        header('Location: Home.php');
    }
}
?>
<?php include 'view/adviewheader.php'?>
        <div class='dashboard-app'>
            <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h2>Bảng xếp hạng</h2>
                        </div>
                        <div class='card-body'>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">TOP</th>
                                        <th scope="col">Đội</th>
                                        <th scope="col">Thắng</th>
                                        <th scope="col">Hòa</th>
                                        <th scope="col">Thua</th>
                                        <th scope="col">Điểm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $a++ ?></th>
                                                <td><?php echo $row['teamname'] ?> </td>
                                                <td><?php echo $row['win'] ?></td>
                                                <td><?php echo $row['draw'] ?></td>
                                                <td><?php echo $row['lose'] ?></td>
                                                <td><?php echo $row['pt'] ?></td>
                                            </tr>
                                           
                                    <?php
                                        }
                                        mysqli_data_seek($result, 0);
                                    }
                                    ?>     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'view/adviewmenu.php'?>   