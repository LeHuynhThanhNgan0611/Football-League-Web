<?php
session_start();
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT * FROM `thongtindoi`";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM `lichthidau`";
$result2 = mysqli_query($conn, $sql2);
$a = 2;

if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
} else {
    if ($_SESSION['position'] != 3 && $_SESSION['position'] !=2 ) {
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
                    <h2>Lịch thi đấu</h2>
                </div>
                <div class='card-body'>
                    <button type="button" class="btn btn-secondary" id="nhapttct">
                        Thêm trận
                    </button>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Đội nhà</th>
                                    <th scope="col">Đội khách</th>
                                    <th scope="col">Ngày</th>
                                    <th scope="col">Tỉ số</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <?php
                            mysqli_data_seek($result2, 0);
                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                    <div class="lichthidau">
                                        <form action="db/updatetiso.php?idmatch=<?php echo $row2['idmatch']; ?>" method="post" enctype="multipart/form-data">
                                            <tr>
                                                <td>
                                                    <p><?php echo $row2['homename'] ?></p>
                                                    </td>
                                                <td>
                                                    <p><?php echo $row2['awayname'] ?></p>
                                                    </td>
                                                <td>
                                                    <p><?php echo $row2['matchdate'] ?></p>
                                                </td>
                                                <td>
                                                    <input disabled id="homegoal<?php echo $a ?>" type="number" name="homegoal" class="homegoal goal Adlichtiso" value="<?php echo $row2['homegoal'] ?>"> -
                                                    <input disabled id="awaygoal<?php echo $a ?>" type="number" name="awaygoal" class="awaygoal goal Adlichtiso" value="<?php echo $row2['awaygoal'] ?>">
                                                </td>
                                                <td>
                                                    <p><?php echo $row2['status'] ?></p>
                                                </td>
                                                <td>
                                                    <i onclick="undisableTxt(this.id)" id="<?php echo $a ?>" class="fa-solid fa-pen-to-square"></i>
                                                    <button disabled type="submit" id="submit<?php echo $a ?>" name="submit2" class="hidden-sm btn btn-info" value="update">
                                                        Xác nhận
                                                    </button>
                                                </td>

                                            </tr>
                                        </form>
                                    </div>
                            <?php
                                    $a++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div id="myModal" class="abc">
                        <form action="db/addmatch.php" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm trận</h5>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <h3>Đội nhà</h3>
                                    <div>
                                        <select name="doinha" id="doinha" class="form-control form-control-sm" style="width: 200px;">
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option value="<?php echo $row['idteam'] ?>">
                                                        ID: <?php echo $row['idteam'] . " | " . $row['teamname']; ?></option>
                                            <?php
                                                }
                                                mysqli_data_seek($result, 0);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <h3>Đội khách</h3>
                                    <div>
                                        <select name="doikhach" id="doikhach" class="form-control form-control-sm" style="width: 200px;" >
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option value="<?php echo $row['idteam'] ?>">
                                                        ID: <?php echo $row['idteam'] . " | " . $row['teamname'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="matchdate">Ngày thi đấu:</label>
                                        <input type="date" id="matchdate" name="matchdate">
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
    if ($_SESSION['status'] == "DoneMatch") {
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