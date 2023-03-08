<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include "../classes/cart.php"; ?>
<?php include_once "../helper/format.php"; ?>

<!-- Dùng phương thức server để post lên khi nhấn submit.
 Khi truy cập server thành công sẽ dùng class insert sp để chạy chức năng thêm sản phẩm  -->
<?php    
  $pd = new product();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
      
      $insertProduct = $pd->insert_product($_POST,$_FILES); //dùng $_FILES để chèn thêm hình ảnh
  }
?>

<link rel="stylesheet" type="text/css" href="css/layout.css" />


 <style>table.form input[type="text"] {
                                    font-size: 16px;
                                    border-bottom: 1px solid #b3b3b3;
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;
                                    padding-right: 50px;
                                }</style>

<style>table.form label {padding-right: 20px} </style>
<style>#grid_10 .h2 {padding-right: 360px}</style>



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
                                    border-top: 1px solid #b3b3b3;}</style>



<style>.tinymce {border-bottom: 1px solid #b3b3b3;
                                    padding: 0px 200px 100px 0px; /*top right bottom left*/
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;}
                                </style>

<style>#select {border-right: 1px solid #b3b3b3;
                border-left: 1px solid #b3b3b3;
                border-top: 1px solid #b3b3b3;
                border-bottom: 1px solid #b3b3b3;
                }
        
        .col-xs-3{
        margin-left: -45px;
        }
</style>


<?php
				$fm = new Format();
				$ct = new cart();
?>




<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Thêm sản phẩm</h2></center>
        </br>
        </br>
        <div class="block">           
        <?php
            if(isset($insertProduct)){
                echo $insertProduct;
            }
        ?>    
        <!-- enctype="..." là dòng không thể thiếu khi thêm ảnh  -->
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">    
                <tr>
                    <td>
                        <label>Tên Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Khi nhập Text vào nó sẽ gán vào productName trong csdl -->
                        <input type="text" name="productName" placeholder="Tên Sản Phẩm" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Khi chọn loại sản phẩm nó sẽ show_category(danh mục sp) lên để lựa chọn  -->
                        <select id="select" name="category">
                            <option>Chọn Loại Sản Phẩm</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>

                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                            
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 5px;">
                        <label>Mô Tả</label>
                    </td>
                    <td>
                        <!-- Nội dung nhập vào sẽ là nội dung về sản phẩm -->
                        <textarea name="product_desc" class="tinymce"></textarea>
                    </td>
                 </tr>
				<tr>
                    <td>
                        <label>Giá Bán</label>
                    </td>
                    <td>
                        <!-- Giá nhập vào sẽ là giá bán  -->
                        
                        <input onkeyup="format_curency(this);" name="price" placeholder="Giá Bán" class="medium"  type="text"/>
                        <span class="col-xs-3"><B>VNĐ</B><span>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Ảnh nhập vào sẽ là ảnh sản phẩm -->
                        <input type="file" name="image" placeholder="Chưa có ảnh được chọn" class="medium"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Danh Mục</label>
                    </td>
                    <td>
                        <!-- Chọn sản phẩm đặc trưng hoặc không đặc trưng -->
                        <select id="select" name="type">
                            <option>Chọn Loại</option>
                            <option value="1">Đặc Trưng</option>
                            <option value="0">Không Đặc Trưng</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                         </br>
                         <!-- Nút click vào thêm sản phẩm  -->
                        <input type="submit" name="submit" Value="Thêm Sản Phẩm" />
                    </td>
                </tr>
            </table>
            </form>
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

    function format_curency(a) {
        a.value = a.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
    
</script>
<!-- Load TinyMCE -->