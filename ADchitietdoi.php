<?php
require 'db/db.php';
session_start();
$conn = create_connection();
$idteam = (int)$_GET['id'];
$sql = "SELECT * FROM `thongtindoi` WHERE `idteam` = {$idteam}";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('lỗi' . mysqli_error($conn));
}
$sql2 = "SELECT * FROM `cauthu` WHERE `idteam` = {$idteam}";
$result2 = mysqli_query($conn, $sql2);
if (!$result2) {
    die('lỗi' . mysqli_error($conn));
}

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
                    <h2>Chi tiết đội</h2>
                </div>
                <?php
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class='card-body'>
                    <table class="content__chitetdoi__header">
                        <tr style="width:30%;">
                            <td rowspan="3" style="text-align: center; border-right: solid 1px rgb(194, 194, 194);"><img class="img-ctteam" src="img/gallery/<?php echo $row['img']; ?>" alt=""> </td>
                            <td rowspan="3">
                                <h4>Tên đội: <?php echo $row['teamname'] ?></h4>
                                <br>
                                <h5>Huấn luyện viên: <?php echo $row['hlvname'] ?></h5>
                            </td>
                            <td style="text-align:right; padding-bottom: 180px;"><a href="ADdoi.php"><button class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i> Danh sách đội</button></a> </td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="text-align:right;">
                                <button type="button" class="btn btn-success" id="nhapttct">
                                    Thêm cầu thủ
                                </button>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID cầu thủ</th>
                                <th scope="col">Tên cầu thủ</th>
                                <th scope="col">Vị trí</th>
                                <th scope="col">Quốc tịch</th>
                                <th scope="col">Năm sinh</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbodyct">

                            <?php
                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $row2['idct'] ?></th>
                                        <td class="tencauthu"><?php echo $row2['ctname'] ?></td>
                                        <td><?php echo $row2['vitri'] ?></td>
                                        <td><?php echo $row2['nationality'] ?></td>
                                        <td><?php echo $row2['birthday'] ?></td>
                                        <td><i onclick="editct2(this.id)" id="ct<?php echo $row2['idct'] ?>" class="fa-solid fa-pen-to-square"></i></td>
                                        <td><a href="db/deletect.php?id=<?php echo $row2['idct']; ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                                    </tr>
                            <?php
                                }
                                mysqli_data_seek($result2, 0);
                            }
                            ?>
                            </ul>
                        </tbody>
                    </table>


                    <div id="myModal" class="abc">
                        <form action="db/addct.php?id=<?php echo $idteam ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Nhập thông tin thành viên</h5>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="ctname">Tên cầu thủ</label>
                                        <input class="form-control" name="ctname" type="text" id="ctname" placeholder="Nhập tên cầu thủ">
                                    </div>
                                    <div>
                                        <label for="nationality">Quốc tịch</label>
                                        <input class="form-control" id="nationality" name="nationality" type="text" placeholder="Nhập quốc tịch">
                                    </div>
                                    <div>
                                        <label for="birthday">Birthday:</label>
                                        <input type="date" id="birthday" name="birthday">
                                    </div>
                                    <div >
                                        <label for="vitri">Vị Trí:</label>
                                        <select name="vitri" id="vitri" class="form-control form-control-sm" style="width: 200px;">
                                            <option value="Thủ môn">Thủ môn</option>
                                            <option value="Hậu vệ">Hậu vệ</option>
                                            <option value="Tiền vệ">Tiền vệ</option>
                                            <option value="Tiền đạo">Tiền đạo</option>
                                        </select>
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



                    <div id="myModal2" class="abc2">
                        <form action="db/editctmini.php?id=<?php echo $row['idteam'] ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chỉnh sửa</h5>
                                    <span onclick="closemd()" class="close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="ctname2">Tên cầu thủ</label>
                                        <input class="form-control" name="ctname2" type="text" id="ctname2" placeholder="Nhập tên cầu thủ">
                                    </div>
                                    <div>
                                        <label for="nationality2">Quốc tịch</label>
                                        <input class="form-control" id="nationality2" name="nationality2" type="text" placeholder="Nhập quốc tịch">
                                    </div>
                                    <div>
                                        <label for="birthday2">Birthday:</label>
                                        <input type="date" id="birthday2" name="birthday2">
                                    </div>
                                    <div>
                                        <label for="vitri2">Vị Trí: </label>
                                        <select name="vitri2" id="vitri2"  class="form-control form-control-sm" style="width: 200px;" >
                                            <option value="Thủ môn">Thủ môn</option>
                                            <option value="Hậu vệ">Hậu vệ</option>
                                            <option value="Tiền vệ">Tiền vệ</option>
                                            <option value="Tiền đạo">Tiền đạo</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                    <button onclick="closemd()" type="button" class="btn btn-secondary close-footer">
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