<?php
session_start();
require 'db/db.php';
$conn = create_connection();
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
<h1 style="margin-top: 100px;">Lịch sử mua</h1>   
<div class="content__lichsumua">
<table class="table" >         
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
    <tbody>
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
    </tbody>
</table>
</div>

<?php include 'view/userviewfooter.php'?>
<script src='js/fp.js'></script>
