<?php
    include 'lib/session.php'; // gọi thư viện session
    Session::init(); //gọi session init ra
?>


<?php 
    include "lib/database.php";
    include "helper/format.php";

    spl_autoload_register(function($class) //hàm autoload này để tự lấy cái class mà mình truyền vào
    {   // lệnh include_once dùng để chèn tập tin '.php' 
        include_once "classes/".$class.".php"; //tạo biến khởi tạo $class để gọi các file class trong thư viện classes ra
    });
    // Lấy các class ra
    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $us = new user();
    $cat = new category();
    $cs = new customer();
    $product = new product();
    $gh = new giohang();
?>








<!DOCTYPE html>
<html>
<head>
    <!--Lệnh meta này sẽ giúp điều chỉnh view(khung hình) 
        hợp lý khi dùng các thiết bị-->
    <meata name="viewport" content="with=device-width, initial-scale=1.0"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cửa Hàng Câu Cá Anh Kiệt </title>
    <!-- Script của trang chatbot Collect.chat -->
<script>(function(w, d) { w.CollectId = "63615d3570e4853cfa5ce1a0"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  
    <!--Link này lấy trong video dùng để tạo icon trên trang web , còn link trong web bootrapcdn ko dùng được ko xài đc-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>   
    <section class="header-sp">
    <nav>
          <a href="index.php"><img id="logo" src="images/logo4.png"  ></a>        
            <div class="nav-links" id="navLinks">
                <!--Gắn thẻ i class vào để đặt icon close vô thanh menu -->
                <i class="fa fa-times" onclick="hideMenu()"></i>        
                <ul>                     
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php#focus-gioithieu">GIỚI THIỆU</a></li>

                    <div class="subnavvv">
<!--Thẻ  #focusvaoday là thẻ được gán trên link , khi click vào link thì nó sẽ focus thẳng tới thẻ name="focusvaoday" trong link cart.php-->
                    <li class="fa fa-shopping-basket"><a href="cart.php#focusvaoday">GIỎ HÀNG</a></li>
                    </div>

                    <?php 
                        if(isset($_GET['customer_id'])){
                            Session::destroy();
                            header("Location:index.php");
                        }
                    ?>
                   
                     <div class="subnavv">
                    <?php 
                        $login_check = Session::get('customer_login');
                        if($login_check == false){
#Thẻ #focus-dn(dk) là thẻ được gán trên link header, khi click vào dn trên link header thì nó sẽ focus thẳng tới thẻ name="focus-dn(dk)" trong link cart.php
                            echo '<li><a href="dangnhap.php#focus-dn">ĐĂNG NHẬP</a></li>';
                            echo '<li><a href="dangkyacc.php#focus-dk">ĐĂNG KÝ</a></li>';
                        }else{
                             echo '<li><a href="?customer_id='.Session::get('customer_id').'">ĐĂNG XUẤT</a></li>';
                            
                        }    
                    ?>

                    </div>

                    



                    <div class="subnavv">
                        <li><a href="lienhe.php#focus-lh">LIÊN HỆ</a></li>
                        
                    </div>

                    <div class="subnavv">
                        <li><a href="sanpham.php#focus-sp">SẢN PHẨM</a></li>
                    </div>

                    

                    <div class="subnavv">
                        <li><a href="noicau.php#focus-noicau">NƠI CÂU</a></li>
                        
                    </div>
                    
                </ul>

                
			
            </div>
            
                     
        </nav>        
            
        </section>

    <style>
.subnav-contentt {
  display: none;
  left: 0;
  position: absolute;
  width: 79.5%;
}

.subnavv:hover .subnav-contentt {
  display: block;
}

.subnavv {
  float: right;
  overflow: hidden;
}

.subnavvv{
  float: right;
  overflow: hidden;
  padding-top: 2.8px;
}
        
</style>

<!-- Đoạn scripts này dùng đẻ làm auto lướt ảnh nhưng đã dẹp-->
