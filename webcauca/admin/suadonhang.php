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
        <center><h2>S???a ????n H??ng</h2></center>
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
                        <label>T??n S???n Ph???m</label>
                    </td>
                    <td>
                        <!-- Gi?? tr??? nh???p v??o s??? l?? t??n s???n ph???m d???a v??o id ???? ???????c g??n trong bi???n -->
                        <input type="text" name="productName" value="<?php echo $result['productName']?>" class="medium" readonly/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>S??? L?????ng</label>
                    </td>
                    <td>
                        <!-- Gi?? nh???p v??o s??? l?? gi?? b??n  -->
                        <input type="text" value = "<?php echo $result['quantity'] ?>"name="soluong" class="medium" readonly/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Gi?? B??n</label>
                    </td>
                    <td>
                        <!-- Gi?? nh???p v??o s??? l?? gi?? b??n  -->
                        <input type="text" value = "<?php echo $fm->format_currency($result['price']) ?>"name="price" class="medium" readonly/>
                        <span class="col-xs-3"><B>VN??</B><span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>???nh S???n Ph???m</label>
                    </td>
                    <td>
                        <!-- ???nh ch???n v??o s??? l?? ???nh s???n ph???m  -->
                        <img src ="uploads/<?php echo $result['image'] ?>" width="220" class="medium" readonly/>

                    </td>
                </tr>
                <tr>
                <td>
                        <label>T??nh Tr???ng</label>
                    </td>
                <td>
                        <!-- Ch???n danh m???c s???n ph???m -->
                        <select id="select" name="status"> <!--D??? li???u tr??n select d??ng class category -->
                            
                
                            <option 
                            <?php
                                // N???u k???t qu??? c???a c??u truy v???n l??(catId) =  v???i (catId) c???a result_product th?? b???t ?????u 
                                if($result['status']==0)
                                echo 'selected';
                            ?> 
                            value="0">??ang Ch??? X??c Nh???n</option> 
                            </option>

                            <option 
                            <?php
                                // N???u k???t qu??? c???a c??u truy v???n l??(catId) =  v???i (catId) c???a result_product th?? b???t ?????u 
                                if($result['status']==1)
                                echo 'selected';
                            ?> 

                            value="1">???? X??c Nh???n</option> 

                            <option 
                            <?php
                                // N???u k???t qu??? c???a c??u truy v???n l??(catId) =  v???i (catId) c???a result_product th?? b???t ?????u 
                                if($result['status']==2)
                                echo 'selected';
                            ?> 
                            value="2" disabled>Giao H??ng</option> 
                            </option>
                            

                            <option 
                            <?php
                                // N???u k???t qu??? c???a c??u truy v???n l??(catId) =  v???i (catId) c???a result_product th?? b???t ?????u 
                                if($result['status']==3)
                                echo 'selected';
                            ?> 
                            value="3">???? Hu??? ????n</option> 
                            </option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>T??n Kh??ch H??ng</label>
                    </td>
                    <td>
                        <!-- Gi?? tr??? nh???p v??o s??? l?? t??n s???n ph???m d???a v??o id ???? ???????c g??n trong bi???n -->
                        <input type="text" name="hoten" value="<?php echo $result['hoten']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>S??? ??i???n Tho???i</label>
                    </td>
                    <td>
                        <!-- Gi?? tr??? nh???p v??o s??? l?? t??n s???n ph???m d???a v??o id ???? ???????c g??n trong bi???n -->
                        <input type="text" name="sodienthoai" value="<?php echo $result['sodienthoai']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>?????a Ch??? Giao</label>
                    </td>
                    <td>
                        <!-- Gi?? tr??? nh???p v??o s??? l?? t??n s???n ph???m d???a v??o id ???? ???????c g??n trong bi???n -->
                        <input type="text" name="diachi" value="<?php echo $result['diachi']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                         </br>
                        <input type="submit" name="submit" Value="S???a ????n H??ng" />
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


