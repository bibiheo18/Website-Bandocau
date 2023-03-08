<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>

<?php    
  $pd = new product();
// Nếu không tồn tại productId hoặc productId = Null(không có giá trị) nó sẽ chuyển về trang productlist.php
 if(!isset($_GET['productId']) || $_GET['productId']==NULL){
        echo "<script>window.location = 'produclist.php'</script>";
    }else{
        // Ngược lại nếu có nó sẽ lấy productId để bắt đầu thực hiện phương thức 
    $Id = $_GET['productId'];
    }
// Thực hiện phương thức post để dùng chức năng update sản phẩm
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
      // $pd là class product và trong class product này ta sẽ lấy ra được update_product để sử dụng
      $updateProduct = $pd->update_product($_POST,$_FILES,$Id); //dùng $_FILES để chèn thêm hình ảnh 
  }   //dùng $Id để mỗi khi nhấn update thì nó sẽ dựa vào Id của sản phẩm đó mà thay đổi

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
                                                 
</style>







<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Sửa Sản Phẩm</h2></center>
        </br>
        </br>
        <div class="block">           
        <?php
            if(isset($updateProduct)){ // Kiểm tra xem biến updateProduct có chưa
                echo $updateProduct;
            }
        ?>    

        <?php 
            // Tạo 1 biến mới và cho nó bằng  với chức năng lấy id sản phẩm để sử dụng
            $get_product_by_id = $pd->getproductbyId($Id);
                if($get_product_by_id){
                    while($result_product = $get_product_by_id->fetch_assoc()){
        ?>

        <!-- action sẽ hành động trên trang này luôn , dùng phương thức là post để truyền dữ liệu -->                                
        <!--Muốn có hình thì nên dùng enctype, ko có sẽ ko update được-->
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">    
                <tr>
                    <td>
                        <label>Tên Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Giá trị nhập vào sẽ là tên sản phẩm dựa vào id đã được gán trong biến -->
                        <input type="text" name="productName" value="<?php echo $result_product['productName']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Chọn danh mục sản phẩm -->
                        <select id="select" name="category"> <!--Dữ liệu trên select dùng class category -->
                            <option>Chọn Loại Sản Phẩm</option>
                            <?php
                                $cat = new category(); // Tạo 1 biến mới là $cat
                                $catlist = $cat->show_category(); // Truyền dữ liệu show_category của biến $cat vào biến $catlist
                                // Nếu catlist = result(kết quả của câu truy vấn) thì sẽ trả về kết quả trong câu truy vấn
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>

                            <option 
                            <?php
                                // Nếu kết quả của câu truy vấn là(catId) =  với (catId) của result_product thì bắt đầu 
                                if($result['catId']==$result_product['catId'])
                                {
                                    echo 'selected'; // cho phép chọn những danh mục đã có sẵn trong dữ liệu
                                }

                            ?>

                            
                            value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option> 
                            <!-- Gía trị kết quả quả câu truy vấn để hiển thị trên select sẽ là catId và catName Id -->
                            
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
                        <!-- Nội dung nhập vào sẽ là nội dung sản phẩm  -->
                        <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                 </tr>
				<tr>
                    <td>
                        <label>Giá Bán</label>
                    </td>
                    <td>
                        <!-- Giá nhập vào sẽ là giá bán  -->
                        <input type="text" value = "<?php echo $result_product['price'] ?>"name="price" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ảnh Sản Phẩm</label>
                    </td>
                    <td>
                        <!-- Ảnh chọn vào sẽ là ảnh sản phẩm  -->
                        <img src ="uploads/<?php echo $result_product['image'] ?>" width="220">
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
                            <?php 

                                if($result_product['type'] == 0){



                            ?>
                            <option selected value="1">Đặc Trưng</option>
                            <option value="0">Không Đặc Trưng</option>
                            <?php 
                                }else{
                                    ?>
                                    <option value="0">Không Đặc Trưng</option>
                                    <option selected value="1">Đặc Trưng</option>
                                    <?php

                                }
                                    ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                         </br>
                        <input type="submit" name="submit" Value="Sửa Sản Phẩm" />
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