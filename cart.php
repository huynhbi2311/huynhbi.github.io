<?php session_start();
$title = "Giỏ Hàng Của Bạn";
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title><?php echo $title; ?></title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="./assets/img/favicon.png" rel="icon">
<link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">


<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


<!-- Vendor CSS Files -->
<link href="./assets/vendor/aos/aos.css" rel="stylesheet">
<link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Template Main CSS File -->
<link href="./assets/css/style.css" rel="stylesheet">
 <script type="text/javascript" src="template/ckeditor/ckeditor.js"></script>
<script src="./assets/vendor/aos/aos.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="./assets/vendor/php-email-form/validate.js"></script>
<script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>

<!-- =======================================================
* Template Name: Knight - v4.0.1
* Template URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->
</head>

<body>

<!-- ======= Hero Section ======= -->
<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
<div class="container d-flex align-items-center justify-content-between">

  <div class="logo">
    <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
  </div>

  <nav id="navbar" class="navbar" >
    <ul>
       <li><a class="nav-link scrollto " href="#portfolio">Home</a></li>
      
      <li><a class="nav-link scrollto " href="laptops.php">Laptops</a></li>
      
    
     
      <li><a class="nav-link scrollto " href="contact.php">Contact</a></li>

       <li><a class="nav-link scrollto active" href="cart.php">Giỏ Hàng</a></li>
          <li> <a href="login.php">
               <?php   
require_once "logingg.php";
if(!empty($_SESSION['username'])) // Nếu user tồn tại thì show thông tin hiện có
{
     echo '<ul>
          <li class="dropdown"><a href="#"><img src="'.$_SESSION['userpic'].'" style="border-radius:30px; width:30px;margin-top:-30px"/></a>
            <ul>
             <li style="margin-left:20px">'.$_SESSION['username'].'</li>
              <li><a href="logout.php">Đăng Xuất</a></li>
              
            </ul>
          </li>   ';
   
}
else{
echo '<i class="fa fa-user-o " aria-hidden="true" style="font-size: 20pt"></i>';  }
?>
</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->

</div>
</header>
<?php
  if(isset($title) && $title == "Cart") ?>
   <div id="main">
    <?php
     
// connecto database
require_once "./functions/database_functions.php";

$conn = db_connect();

function rand_string( $length ) {
$str ="";
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

$size = strlen( $chars );

for( $i = 0; $i < $length; $i++ ) {

$str .= $chars[ rand( 0, $size - 1 ) ];

}

return $str;

}

if(isset($_POST['laptopisbn'])){
    $laptop_isbn = $_POST['laptopisbn'];
}


    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    $GLOBALS['changed_cart'] = false;
    $error = false;
    $success = false;
    if (isset($_GET['action'])) {

        function update_cart($conn, $add = false) {
            foreach ($_POST['quantity'] as $laptop_isbn => $quantity) {
                if ($quantity == 0) {
                    unset($_SESSION["cart"][$laptop_isbn]);
                } else {
                    if (!isset($_SESSION["cart"][$laptop_isbn])) {
                        $_SESSION["cart"][$laptop_isbn] = 0;
                    }
                    // var_dump($_SESSION["cart"][$laptop_isbn]);
                    if ($add) {
                        $_SESSION["cart"][$laptop_isbn] += $quantity;
                    } else {
                        $_SESSION["cart"][$laptop_isbn] = $quantity;
                    }
                    //Kiểm tra số lượng sản phẩm tồn kho
                    $addProduct = mysqli_query($conn, "SELECT `quantity` FROM `laptops` WHERE `laptop_isbn` = " . $laptop_isbn);
                    if ($addProduct) {
                        $addProduct = mysqli_fetch_assoc($addProduct);
                    }
                    
                    if ($_SESSION["cart"][$laptop_isbn] > $addProduct['quantity']) {
                        $_SESSION["cart"][$laptop_isbn] = $addProduct['quantity'];
                        $GLOBALS['changed_cart'] = true;
                    }
                }
            }
        }

        switch ($_GET['action']) {
            case "add":
                update_cart($conn, true);
                if ($GLOBALS['changed_cart'] == false) {
                    header('Location: ./cart.php');
                }
                break;
            case "delete":
                if (isset($_GET['laptop_isbn'])) {
                    unset($_SESSION["cart"][$_GET['laptop_isbn']]);
                }
                header('Location: ./cart.php');
                break;
            case "submit":
                if (isset($_POST['update_click'])) { //Cập nhật số lượng sản phẩm
                    update_cart($conn);
                    header('Location: ./cart.php');
                } elseif ($_POST['order_click']) { //Đặt hàng sản phẩm
                    if (empty($_POST['ship_name'])) {
                        $error = "Bạn chưa nhập tên của người nhận";
                    } elseif (empty($_POST['ship_city'])) {
                        $error = "Bạn chưa nhập thành phố bạn ở";
                    } elseif (empty($_POST['ship_address'])) {
                        $error = "Bạn chưa nhập địa chỉ người nhận";
                    } elseif (empty($_POST['quantity'])) {
                        $error = "Giỏ hàng rỗng";
                    }
                    if ($error == false && !empty($_POST['quantity'])) { //Xử lý lưu giỏ hàng vào db
                        $products = mysqli_query($conn, "SELECT * FROM laptops WHERE laptop_isbn IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                        $total = 0;
                        $my_string ="";
                        $orderProducts = array();
                        $updateString = "";
                        while ($row = mysqli_fetch_array($products)) {
                            $orderProducts[] = $row;
                            if ($_POST['quantity'][$row['laptop_isbn']] > $row['quantity']) {
                                $_POST['quantity'][$row['laptop_isbn']] = $row['quantity'];
                                $GLOBALS['changed_cart'] = true;
                            } else {
                                $total += $row['laptop_price'] * $_POST['quantity'][$row['laptop_isbn']];
                                $updateString .= " when laptop_isbn = ".$row['laptop_isbn']." then quantity - ".$_POST['quantity'][$row['laptop_isbn']];
                            }

                        }
                        if ($GLOBALS['changed_cart'] == false) {
                            $updateQuantity = mysqli_query($conn, "update laptops set quantity = CASE".$updateString." END where laptop_isbn in (".implode(",", array_keys($_POST['quantity'])).")");
                            $_SESSION['macode'] = $my_string = rand_string(5);

                            
                            $insertOrder = mysqli_query($conn,  "INSERT INTO `orders` (`orderid`,`amount`,`ship_name`, `ship_address`, `ship_city`,`ship_country`,`macode`) VALUES (NULL, '" . $total . "' ,'" . $_POST['ship_name'] . "', '" . $_POST['ship_address'] . "', '" . $_POST['ship_city'] . "', '" . $_POST['ship_country'] . "','".$my_string."');");
                             $insertOrder = mysqli_query($conn, "INSERT INTO `customers` (`customerid`, `name`, `address`, `city`, `country`) VALUES (NULL,'" . $_POST['ship_name'] . "', '" . $_POST['ship_address'] . "', '" . $_POST['ship_city'] . "', '" . $_POST['ship_country'] . "');");
                            $orderid = $conn->insert_id;
                            $insertString = "";
                            foreach ($orderProducts as $key => $row) {
                                $insertString .= "('" . $orderid . "', '" . $row['laptop_isbn'] . "', '" . $row['laptop_price'] . "', '" . $_POST['quantity'][$row['laptop_isbn']] . "')";
                                if ($key != count($orderProducts) - 1) {
                                    $insertString .= ",";
                                }
                            }
                            $inserthd ="";
                            foreach ($orderProducts as $key => $row ) {
                              $inserthd .="('" . $orderid . "' ,'" . $_POST['ship_name'] . "', '" . $_POST['ship_address'] . "', '" . $_POST['ship_city'] . "', '" . $_POST['ship_country'] . "','".$my_string."','".$row['laptop_isbn']."','".$row['laptop_image']."','".$row['laptop_price']."','".$row['laptop_title']."', '" . $_POST['quantity'][$row['laptop_isbn']] . "', '" . $total . "' )";
                              if ($key != count($orderProducts) - 1) {
                                    $inserthd .= ",";
                                }

                            }
                            $insertOrder = mysqli_query($conn, "INSERT INTO `order_hd` (`orderid`,`ship_name`, `ship_address`, `ship_city`,`ship_country`,`macode`,`laptop_isbn`,`laptop_image`,`laptop_price`, `laptop_title`, `quatity`,`amount`) VALUES " . $inserthd . ";");
                            $insertOrder = mysqli_query($conn, "INSERT INTO `order_items` (`orderid`, `laptop_isbn`, `item_price`,`quantity`) VALUES " . $insertString . ";");
                            $success = "Đặt hàng thành công";
                            unset($_SESSION['cart']);
                        }
                    }
                }
                break;
        }
    }
    if (!empty($_SESSION["cart"])) {
        $products = mysqli_query($conn, "SELECT * FROM laptops WHERE laptop_isbn IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
    }
//        $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = ".$_GET['id']);
//        $product = mysqli_fetch_assoc($result);
//        $imgLibrary = mysqli_query($con, "SELECT * FROM `image_library` WHERE `product_id` = ".$_GET['id']);
//        $product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
    ?>
 
     
    <div class="container" style="text-align: center">
        <?php if (!empty($error)) { ?> 
            <div id="notify-msg">
                <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
            </div>
        <?php } elseif (!empty($success)) { ?>
           

        <div  id="notify-msg" style="box-shadow: 0px 0 30px rgb(21 21 21 / 8%);border-radius: 40px">
              <h2>Đây là mã sản phẩm của quý khách mong quý khách vui lòng ghi nhớ để check sản phẩm đã đặt. <h1 style="color: red">  <?php echo $_SESSION['macode']; ?></h1></h2><br>
                <p><?= $success ?>. <a href="index.php">Tiếp tục mua hàng</a></p>
</div>
            </div>
       
        <?php } else { ?>
          <!--   <a href="index.php">Trang chủ</a> -->
            <h1>Giỏ hàng</h1>
            <?php if ($GLOBALS['changed_cart']) { ?>
                <h3>Số lượng sản phẩm trong giỏ hàng đã thay đổi, do lượng sản phẩm tồn kho không đủ. Vui lòng <a href="cart.php">tải lại</a> giỏ hàng</h3>
            <?php } else { ?>
                <form id="cart-form" class="form-horizontal" action="cart.php?action=submit" method="POST">
                    <table  class="table">
                        <tr>
                            <th >STT</th>
                           
                            <th >Tên sản phẩm</th>
                           <th>Hình ảnh</th>
                            <th >Đơn giá</th>
                            <th>Số lượng</th>
                            <th >Thành tiền</th>
                            
                        </tr>
                        <?php
                        if (!empty($products)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($products)) {
                                ?>
                                <tr>
                                    <td ><?= $num++; ?></td>
                                    
                                    <td ><?= $row['laptop_title'] ?></td>
                                   <td><img src="./assets/img/<?php echo $row['laptop_image']?>" alt="" style="width: 50px;"></td>
                                    <td ><?= number_format($row['laptop_price'], 0, ",", ".") ?>₫</td>
                                    <td ><input type="text" value="<?= $_SESSION["cart"][$row['laptop_isbn']] ?>" name="quantity[<?= $row['laptop_isbn'] ?>]" size="2" /></td>
                                    <td ><?= number_format($row['laptop_price'] * $_SESSION["cart"][$row['laptop_isbn']], 0, ",", ".") ?>₫</td>
                                   
                                </tr>
                                <?php
                                $total += $row['laptop_price'] * $_SESSION["cart"][$row['laptop_isbn']];
                                $num++;
                            }
                            ?>
                            <tr id="row-total">
                                
                                 <td><B>Tổng tiền:</B></td>
                                 <td></td>
                                 <td></td>
                                
                                
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td ><?= number_format($total, 0, ",", ".") ?>₫</td>
                               
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <div id="form-button" >
                        <input type="submit"class="btn btn-primary" name="update_click" value="Cập nhật"  style="background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 15px; float: right;font-size: 10pt " />

                        <a href="laptops.php" class="btn btn-primary" style="background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 15px ;text-align: center;font-size: 10pt;margin-left: -860px">Quay Trở Lại Mua Hàng</a>
                         <a href="thanhtoan.php" class="btn btn-primary" style="background-color: pink;background-image: linear-gradient(to right,#E92EFB, #FF2079,#440BD4, #04005E); border-radius: 15px ;text-align: center;font-size: 10pt;">tt</a>

                    </div>
                
                   <!--  <input type="submit" name="order_click" value="Đặt hàng" /> -->
                </form>
            <?php } ?>
        <?php } ?>
    </div>
</main>
<?php
if(isset($conn)) {mysqli_close($conn);}
require "./template/footer.php";
?>