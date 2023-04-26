<?php
session_start();
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT * FROM `lichthidau` WHERE `ve` = 0";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM `soluongve`";
$result2 = mysqli_query($conn, $sql2);


if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
} else {
    if ($_SESSION['position'] != 3 && $_SESSION['position'] != 1) {
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
                    <h2>Quản lý vé</h2>
                </div>
                <div class='card-body'>
                    <button type="button" class="btn btn-secondary" id="nhapttct">
                        Tạo vé
                    </button>

                    <div class="content__lstve">
                        <?php
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                if ($row2['status'] == "Đang bán") {
                                    $color = "#28a745";
                                } else {
                                    $color = "#dc3545";
                                }
                        ?>
                                <div id="content__line"> </div>
                                <Table>
                                    <tr>
                                        <td style="width: 25%; border-right: solid 1px #d1d0d0;" rowspan="2">ID match : <?php echo $row2['idmatch'] ?> </td>
                                        <td>
                                            <label for="">Vé thường: </label><input disabled value="<?php echo $row2['vethuong'] ?>">
                                        </td>
                                        <td style="width: 40%; border-left: solid 1px  #d1d0d0; " rowspan="2">
                                            <p style="color:<?php echo $color;?>">Status: <?php echo $row2['status'] ?></p>
                                            <form action="db/closeve.php" method="post" enctype="multipart/form-data">
                                                <button type="submit" class="btn btn-danger" name="submit" value="<?php echo $row2['idmatch'] ?>">Đóng vé</button>
                                            </form>
                                            <form action="db/openve.php" method="post" enctype="multipart/form-data">
                                                <button type="submit" class="btn btn-success" name="submit" value="<?php echo $row2['idmatch'] ?>">mở vé</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Vé vip : </label><input disabled value="<?php echo $row2['vevip'] ?>">
                                        </td>
                                    </tr>
                                </Table>
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
                                        <select name="selectmatch" id="selectmatch" class="form-control form-control-sm" style="width: 400px;">
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option value="<?php echo $row['idmatch'] ?>">
                                                        Trận <?php echo  $row['idmatch'] ?>: <?php echo  $row['homename'] . " - " . $row['awayname'] . " (" . $row['matchdate']; ?>)</option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="vethuong">Vé thường: </label>
                                        <input id="vethuong" type="number" name="vethuong" value="0" style="width: 100px; text-align: center;">
                                    </div>
                                    <div>
                                        <label for="vevip" >Vé vip: </label>
                                        <input style="width: 100px; text-align: center;" id="vevip" type="number" name="vevip" value="0">
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
    if ($_SESSION['status'] == "DoneVe") {
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
    } else if ($_SESSION['status'] == "ErrorVe") {
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
    } else if ($_SESSION['status'] == "CloseVe") {
    ?>
        <script>
            swal({
                title: "Thành công!",
                text: "Đã đóng vé",
                icon: "success",
                button: "Aww yisss",
            });
        </script>
    <?php
        unset($_SESSION['status']);
    } else if ($_SESSION['status'] == "OpenVe") {
    ?>
        <script>
            swal({
                title: "Thành công!",
                text: "Đã mở vé",
                icon: "success",
                button: "Aww yisss",
            });
        </script>
<?php
        unset($_SESSION['status']);
    }
}
?>