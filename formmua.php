<?php
session_start();
require 'db/db.php';
$conn = create_connection();
$idmatch = $_GET['id'];
$sql2 = "SELECT * FROM soluongve WHERE `status`='Đang bán' and `idmatch`='$idmatch' ORDER BY matchdate";
$result2 = mysqli_query($conn, $sql2);

$user = $_SESSION['user'];
$sql = "SELECT * FROM bill WHERE `accname`='$user' ORDER BY idhd";
$result = mysqli_query($conn, $sql);
    
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
    echo '<script>
    window.onload = function(){
        addbuttonadmin();
        addbuttonlogin();
    };
 </script>';
} else {
    echo '<script>
        window.onload = function(){
            addbuttonlogout();
        };
     </script>';
    if ($_SESSION['position'] != 0) {
        $usercheck = 'user';
        echo '<script>
        window.onload = function(){
            addbuttonadmin();
            addbuttonlogout();
        };
     </script>';
    }
}
?>
<?php include 'view/userviewheader.php'?>
<div class="content__formmua">
    <div class="content__formmua__form">

    <form action="db/datve.php"method="post" enctype="multipart/form-data">
        <h1>Đặt vé</h1>
        <label for="tenkh" >Họ tên:</label>
        <input name="tenkh" type="text" id="tenkh" placeholder="Nhập tên" class="form-control">
        <label for="phone">Số điện thoại:</label>
        <input name="phone" type="text" id="phone" placeholder="Nhập sdt" class="form-control">
        <label for="pid">CMND/CCCD:</label>
        <input name="pid" type="text" id="pid" placeholder="Nhập CMND/CCCD" class="form-control">
        <label for="">Loại vé: </label>
        <input type="radio" id="vethuong" name="ve" value="vethuong">
        <label for="vethuong">Thường</label>
        <input type="radio" id="vevip" name="ve" value="vevip">
        <label for="vevip">Vip</label><br>
        <label >Số lượng: </label>
        <select name="soluong" id="soluong" style="width: 200px;" class="form-control form-control-sm">
            <option value="1">1 vé</option>
            <option value="2">2 vé</option>
            <option value="3">3 vé</option>
            <option value="4">4 vé</option>
            <option value="5">5 vé</option>
        </select>
        <br>
        <label for="">Phương thức thanh toán:</label>
        <input type="radio" id="thetindung" name="thanhtoan" value="thetindung">
        <label for="thetindung" >Thẻ tín dụng</label>
        <input type="radio" id="paypal" name="thanhtoan" value="paypal">
        <label for="paypal" >Paypal</label><br>
        <div id="test">
        <button type="submit" name="submit" class="btn btn-success" value="<?php echo $idmatch ?>">Thanh Toán</button>
        </div>
    </form>
    </div>
    <div class="content__formmua__form">
    <h1>Lịch sử mua</h1>
    <table class="table" style="margin-top: 25px;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Mã hóa đơn</th>
            <th scope="col">Tên</th>
            <th scope="col">Sđt</th>
            <th scope="col">Loại vé</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thanh toán</th>
        </tr>
    </thead>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['idhd'] ?> </td>
                    <td><?php echo $row['hoten'] ?> </td>
                    <td><?php echo $row['sdt'] ?></td>
                    <td><?php echo $row['cateve'] ?></td>
                    <td><?php echo $row['soluong'] ?></td>
                    <td><?php echo $row['phuongthuc'] ?></td>
                </tr>
                
        <?php
            }
            mysqli_data_seek($result, 0);
        }
        ?>     

    </table>
    </div>
</div>
   
<?php include 'view/userviewfooter.php'?>
<script src='js/fp.js'></script>
<script src="js/sweetalert.min.js"></script>
<?php
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "DoneDatve") {
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
    else if($_SESSION['status'] == "ErrorDatve"){
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
    else if($_SESSION['status'] == "ErrorHetve"){
        ?>
        <script>
            swal({
                title: "Thông báo!",
                text: "Rất tiếc, không đủ số lượng vé bạn muốn mua",
                icon: "warning",
                button: "Đóng",
            });
        </script>
<?php
    unset($_SESSION['status']);
    }
}
?>