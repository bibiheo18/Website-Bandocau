<?php include "inc/header.php"; ?>
<?php include "../classes/cart.php"; ?>



<?php
    $fm = new Format();
    $ct = new cart();

    if(!isset($_GET['cartdetailsId']) || $_GET['cartdetailsId']==NULL)    
    {
        echo "<script>window.location = 'dathangpaid.php'</script>";
    }
    else
    {
        $idDonHangPaid = $_GET['cartdetailsId'];
    }
    
?>


<link rel="stylesheet" type="text/css" href="css/layout.css" />

<style>table.form input[type="text"] {
                                    font-size: 16px;
                                    border-bottom: 1px solid #b3b3b3;
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;
                                    
                                   
                                   
                                }</style>

<style>table.form label {} </style>
<style>#grid_10 .h2 {padding-right: 360px} #grid_10{width: 220%}</style>



 <style>table.form input[type="submit"] {
                                    border: 1px solid #ddd;
                                    color: #444;
                                    cursor: pointer;
                                    font-size: 18px;
                                    padding: 2px 10px;
                                    border-radius: 50px 50px 50px 50px;
                                    background: aquamarine;

                                }</style>

<style>table.form input[type="file"]{border-bottom: 1px solid #b3b3b3;
                                    
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;}
                                    .col-xs-3{
        margin-left: -45px;
        }                                    
                                    </style>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
    {
        $id_update_Paid = $_POST['submit'];
        $update_paid = $ct->update_paid($id_update_Paid,$_POST,$idDonHangPaid);
    }
?>

<?php 
    if(isset($update_paid))
    echo $update_paid;
?>


<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Sửa Đơn Hàng</h2></center>
        </br>
        </br>
        <div class="block">      

<?php
    $get_donhang_paid = $ct->get_don_hang_paid($idDonHangPaid);
    if($get_donhang_paid)
    {
        while($result = $get_donhang_paid->fetch_assoc())
        {
?>
               
               <form action="" method="post" enctype="multipart/form-data">
            <table class="form">    
                <tr>
                    <td>
                        <label>Tên Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Giá trị nhập vào sẽ là tên sản phẩm dựa vào id đã được gán trong biến -->
                        <input type="text" name="productName" value="<?php echo $result['productName']?>" class="medium" readonly/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Số Lượng</label>
                    </td>
                    <td>
                        <!-- Giá nhập vào sẽ là giá bán  -->
                        <input type="text" value = "<?php echo $result['quantity'] ?>"name="soluong" class="medium" readonly/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá Bán</label>
                    </td>
                    <td>
                        <!-- Giá nhập vào sẽ là giá bán  -->
                        <input type="text" value = "<?php echo $fm->format_currency($result['price']) ?>"name="price" class="medium" readonly/>
                        <span class="col-xs-3"><B>VNĐ</B><span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ảnh Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Ảnh chọn vào sẽ là ảnh sản phẩm  -->
                        <img src ="uploads/<?php echo $result['image'] ?>" width="220" class="medium" readonly/>

                    </td>
                </tr>
                <tr>
                <td>
                        <label>Tình Trạng</label>
                    </td>
                <td>
                        <!-- Chọn danh mục sản phẩm -->
                        <select id="select" name="status"> <!--Dữ liệu trên select dùng class category -->
                            
                
                            <option 
                            <?php
                                // Nếu kết quả của câu truy vấn là(catId) =  với (catId) của result_product thì bắt đầu 
                                if($result['status']==0)
                                echo 'selected';
                            ?> 
                            value="0">Đang Chờ Xác Nhận</option> 
                            </option>

                            <option 
                            <?php
                                // Nếu kết quả của câu truy vấn là(catId) =  với (catId) của result_product thì bắt đầu 
                                if($result['status']==1)
                                echo 'selected';
                            ?> 

                            value="1">Đã Xác Nhận</option> 

                            <option 
                            <?php
                                // Nếu kết quả của câu truy vấn là(catId) =  với (catId) của result_product thì bắt đầu 
                                if($result['status']==2)
                                echo 'selected';
                            ?> 
                            value="2" disabled>Giao Hàng</option> 
                            </option>
                            

                            <option 
                            <?php
                                // Nếu kết quả của câu truy vấn là(catId) =  với (catId) của result_product thì bắt đầu 
                                if($result['status']==3)
                                echo 'selected';
                            ?> 
                            value="3">Đã Huỷ Đơn</option> 
                            </option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Tên Khách Hàng</label>
                    </td>
                    <td>
                        <!-- Giá trị nhập vào sẽ là tên sản phẩm dựa vào id đã được gán trong biến -->
                        <input type="text" name="hoten" value="<?php echo $result['hoten']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số Điện Thoại</label>
                    </td>
                    <td>
                        <!-- Giá trị nhập vào sẽ là tên sản phẩm dựa vào id đã được gán trong biến -->
                        <input type="text" name="sodienthoai" value="<?php echo $result['sodienthoai']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Địa Chỉ Giao</label>
                    </td>
                    <td>
                        <!-- Giá trị nhập vào sẽ là tên sản phẩm dựa vào id đã được gán trong biến -->
                        <input type="text" name="diachi" value="<?php echo $result['diachi']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                         </br>
                        <input type="submit" name="submit" Value="Sửa Đơn Hàng" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                }
            }

            ?>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->


