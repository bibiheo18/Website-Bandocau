<?php
    include '../lib/session.php';
    Session::checkSession(); //checkSession để kiểm tra xem đã đúng session không, để cho ta vào admin
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="../dist/styles.css">
    <link rel="stylesheet" href="../dist/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
	<title>Trang Chủ Admim</title>
	
</head>


<body>
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <a href="index.php"><h1 class="text-white p-2">Quản Lý Cửa Hàng Bán Đồ Câu Cá </h1></a>
                </div>
                <div class="p-1 flex flex-row items-center">
                    <a href="#" class="text-white p-2 mr-2 no-underline hidden md:block lg:block">Xin Chào Admin <?php echo Session::get('adminName') ?> </a>
                    <img class="inline-block h-8 w-8 rounded-full" src="../dist/images/kiet.jpg" alt="">

                    <a href="?action=dangxuat" class="text-white p-2 mr-2 no-underline hidden md:block lg:block">Đăng Xuất </a>
                    
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block"></a>
                    <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                        <ul class="list-reset">
                          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                          <li><hr class="border-t mx-2 border-grey-ligght"></li>
                           <?php

							if(isset($_GET['action']) && $_GET['action']=='dangxuat')
							{
								Session::destroy();
							}

							?>
                          <li><a href="?action=dangxuat" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a></li>
                         <!-- Đăng xuất -->
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!--/Header-->

        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                <ul class="list-reset flex flex-col">
                    <li class="w-full h-full py-3 px-2">
                        <ul class="list-reset -mx-2 bg-white-medium-dark">
                            <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                                <!--Gọi class chức năng thêm loại sp-->
                                <a href="addsp.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Thêm Loại Sản Phẩm      
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                            <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                                <!--Gọi class chức năng thêm sp-->
                                <a href="productadd.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Thêm Sản Phẩm      
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                            <li class="border-t border-light-border w-full h-full px-2 py-3">
                                <!--Gọi class chức năng show danh sách loại sp-->
                                <a href="listloaisp.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Danh Sách Loại Sản Phẩm
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                            <li class="border-t border-light-border w-full h-full px-2 py-3">
                                 <!--Gọi class chức năng show danh sách sp-->
                                <a href="produclist.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Danh Sách Sản Phẩm
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                            <li class="border-t border-light-border w-full h-full px-2 py-3">
                                 <!--Gọi class chức năng show danh sách đặt hàng -->
                                <a href="dathang.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Danh Sách Đặt Hàng
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                            <li class="border-t border-light-border w-full h-full px-2 py-3">
                                 <!--Gọi class chức năng show danh sách đặt hàng -->
                                <a href="dathangpaid.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Đơn Hàng Đã Thanh Toán
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                            <li class="border-t border-light-border w-full h-full px-2 py-3">
                                 <!--Gọi class chức năng show danh sách đặt hàng -->
                                <a href="thongke.php"
                                   class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                    Thống Kê Bán Hàng
                                    <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </aside>
            <!--/Sidebar-->




<script src="./main.js"></script>
</body>

</html>

