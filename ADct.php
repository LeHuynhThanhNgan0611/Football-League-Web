<?php
session_start();
require 'db/db.php';
$conn = create_connection();
$sql = "SELECT c.* ,d.* FROM cauthu c,thongtindoi d WHERE c.idteam=d.idteam ORDER BY `idct`";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('lỗi' . mysqli_error($conn));
}
$sql2 = "SELECT * FROM `thongtindoi`";
$result2 = mysqli_query($conn, $sql2);

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
                    <h2>Danh sách cầu thủ</h2>
                </div>
                <div class='card-body'>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Nhập tên cầu thủ" title="Type in a name">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã cầu thủ</th>
                                <th scope="col">Tên cầu thủ</th>
                                <th scope="col">Vị trí</th>
                                <th scope="col">Quốc tịch</th>
                                <th scope="col">Năm sinh</th>
                                <th scope="col">Đội</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbodyct">

                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['idct'] ?></th>
                                        <td class="tencauthu"><?php echo $row['ctname'] ?></td>
                                        <td><?php echo $row['vitri'] ?></td>
                                        <td><?php echo $row['nationality'] ?></td>
                                        <td><?php echo $row['birthday'] ?></td>
                                        <td><?php echo $row['teamname'] ?></td>
                                        <td><i onclick="editct(this.id)" id="ct<?php echo $row['idct'] ?>" class="fa-solid fa-pen-to-square"></i></td>
                                    </tr>
                            <?php
                                }
                                mysqli_data_seek($result, 0);
                            }
                            ?>
                            </ul>
                        </tbody>
                    </table>
                    <div id="myModal" class="abc">
                        <form action="db/editct.php" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chỉnh sửa thông tin cầu thủ</h5>
                                    <span onclick="closemd2()" class="close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="teamname">Tên cầu thủ</label>
                                        <input class="form-control" name="ctname" id="ctname" type="text" placeholder="Nhập tên cầu thủ">
                                    </div>
                                    <div>
                                        <label for="nationality">Quốc tịch</label>
                                        <input class="form-control" id="nationality" name="nationality" type="text" placeholder="Nhập quốc tịch">
                                    </div>
                                    <div>
                                        <label for="birthday">Birthday:</label>
                                        <input type="date" id="birthday" name="birthday">
                                    </div>
                                    <div>
                                        <label for="vitri">Vị Trí: </label>
                                        <select name="vitri" id="vitri" class="form-control form-control-sm" style="width: 200px;">
                                            <option value="Thủ môn">Thủ môn</option>
                                            <option value="Hậu vệ">Hậu vệ</option>
                                            <option value="Tiền vệ">Tiền vệ</option>
                                            <option value="Tiền đạo">Tiền đạo</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="idteam">Đội: </label>
                                        <select name="idteam" id="idteam" class="form-control form-control-sm" style="width: 200px;">
                                            <?php
                                            if (mysqli_num_rows($result2) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                    <option value="<?php echo $row2['idteam'] ?>">
                                                        ID:<?php echo $row2['idteam'] . " " . $row2['teamname']; ?></option>
                                            <?php
                                                }
                                                mysqli_data_seek($result2, 0);
                                            }
                                            ?>
                                        </select>
                                        <div class="modal-footer">
                                        <button onclick="closemd2()" type="button" class="btn btn-secondary close-footer">
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
    if ($_SESSION['status'] == "DoneCt") {
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
    }
    else{
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