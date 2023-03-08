<?php

   include "../classes/category.php";
?>

 <?php

    include "inc/header.php";
?>

<link rel="stylesheet" type="text/css" href="css/layout.css" />



<?php  
  $cat = new category(); //Gọi class category ra
  if(isset($_GET['delId'])){
   // Nếu tồn tại biến delId này thì lấy delId gán cho $Id .Sau đó gọi del_cat ra và cho nó = với del_Id
    $Id = $_GET['delId'];
    $delCat = $cat->del_cat($Id);
    }
?>




<div class="grid_10">

            <div class="box round first grid">
                <center><h2>Danh Mục Loại Sản Phẩm</h2></center>
                <div class="block">    
               <?php
                if(isset($delCat)){
                  echo $delCat;
                }
                ?>
             </br>           
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                           <th>Thứ Tự</th>
                           <th>Tên Loại Sản Phẩm</th>
                           <th>Cập Nhật</th>
                        </tr>
                    </thead>
                     <tbody>
                     <?php  
                        $show_cate = $cat->show_category();
                        if($show_cate){
                           $i = 0; //khai báo biến i , biến i là số Thứ tự của danh mục sản phẩm
                           while($result = $show_cate->fetch_assoc()){
                              $i++;
                     
                  ?>
                  <tr class="oddgradeX">
                     <td><?php echo $i; ?></td> <!-- Show stt danh mục sp($i) -->
                     <td><?php echo $result['catName']?></td> <!-- Show tên danh mục sp(catName) -->
                     
                     <td><a href="sualoaisp.php?catId=<?php echo $result ['catId']?>">Sửa</a> || 
                     <a onclick = "return confirm('Bạn có chắc muốn xóa loại sản phẩm này không?')" 
                     href="?delId=<?php echo $result ['catId']?>">Xóa</a></td>

                     <!-- Nhấn vào sửa sẽ chuyển trang sửa sp và nó sửa catName của id đó (catId)
                      trong trang sửa loại sp  -->
                     <style>.oddgradeX td{
                        padding-right: 365px;
                        padding-bottom: 7px;
                        padding-top: 10px;
                     }</style>
                  </tr>
                  <?php 
               }
                  }
                  ?>
               </tbody>
            </table>
               </div>
            </div>
        </div>

<script type="text/javascript">
   $(document).ready(function () {
       setupLeftMenu();

       $('.datatable').dataTable();
       setSidebarHeight();
   });
</script>
 

