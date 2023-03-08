<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include "../classes/cart.php"; ?>
<?php include_once "../helper/format.php"; ?>



<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 5px;
                       	padding-top: 15px;
                       	padding-bottom: 5px;
                     }
                   th {padding-right: 33px;}
				   B{
			color: red;
		}
		.shift B{
			color: blue;
		}
		.confirm {
			color: orange;
		}
</style>






<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Đặt Hàng</h2></center>
        <div class="block"> 
  
        	
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
					<center><th hidden>Mã Đặt</th>
					<th>Tên Khách Hàng</th>
					<th>SĐT</th>
					<th>Địa Chỉ Giao</th>
					<th>Thành Phố</th>
					<th>Mã Sản Phẩm</th>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng</th>
					<th>Tổng Giá Tiền</th>
					<th>Hình Ảnh</th>
					<th>Thời Gian</th>
					<th>Xử Lý</th></center>
				</tr>
			</thead>

			<tbody>
				
				<?php

				$ct = new cart();
				$fm = new format();

				if(isset($_GET['idDatHang']) && $_GET['idThongKe_Off'])
				{
					$Id = $_GET['idDatHang'];
					$update_order_offline = $ct->update_order_offline($Id);

					$IdThongKe = $_GET['idThongKe_Off'];
					$thongke = $ct->lietke_donhang_offline($IdThongKe);
				}
				elseif(isset($_GET['idHuyDon']))
				{
					$Id_Huy = $_GET['idHuyDon'];
					$cancel_order_offline = $ct->cancel_order_offline($Id_Huy);
				}
				elseif(isset($_GET['idXacNhan']))
				{
					$id_xacnhan = $_GET['idXacNhan'];
					$update_order_confirm = $ct->update_order_confirm($id_xacnhan);
				}

				$getallorder = $ct->getallorder();
				if($getallorder) {
					
				while ($result = $getallorder->fetch_assoc()){
				
				?>

				<tr class="oddgradeX">
					<td hidden><?php echo $result['orderId']?></td>
					<td><?php echo $result['hotenkhach']?></td>
					<td><?php echo $result['sdt']?></td>
					<td><?php echo $result['diachi']?></td>
					<td><?php echo $result['thanhpho']?></td>
					<td><?php echo $result['productId']?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['quantity']?></td>
					<td><?php echo $fm->format_currency($result['price'])?></td>
					<td><img src ="uploads/<?php echo $result['image'] ?>" width="85"></td>
					<td><?php echo $result['paid_date']?></td>
<?php 
					if($result['status'] == 0)
					{
?>	
						<td><a onclick="return confirm('Có chắc là muốn xác nhận đơn này không?');" href="?idDatHang=<?php echo $result['orderId']?>&idThongKe_Off=<?php echo $result['orderId'] ?>">Xác Nhận Đơn</a></td>	
						<td>||</td>
							<td><a onclick="return confirm('Có chắc là muốn huỷ đơn này không?');"href="?idHuyDon=<?php echo $result['orderId'] ?>">Huỷ Đơn</a></td>
<?php				
					}
					elseif($result['status'] == 1)
					{
?>
						<td><a onclick="return confirm('Xác nhận giao đơn hàng?');" href="?idXacNhan=<?php echo $result['status'] ?>"><div class="confirm">Đã Xác Nhận</div></a></td>
<?php
					}
					elseif($result['status'] == 3)
					{
?>
						<td><B>Đã huỷ đơn<B></td>
<?php						
					}
					else
					{
?>					
						<td><div class="shift"><B>Giao Hàng<B></div></td>
<?php						
					}
?>
									
					
				</tr>
				<?php
					}
				}else{
					echo '<span class="error"><center>Hiện tại không có Khách Đặt Hàng. Vui lòng quay lại sau!</center></span><br>';
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

