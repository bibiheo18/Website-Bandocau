<?php include "inc/header.php"; ?>
<?php include "../classes/category.php"; ?>
<?php include "../classes/product.php"; ?>
<?php include "../classes/cart.php"; ?>
<?php include_once "../helper/format.php"; ?>

<link rel="stylesheet" type="text/css" href="css/layout.css" />


<style>.oddgradeX td{
                        padding-right: 2px;
                       	padding-top: 15px;
                       	padding-bottom: 5px;
                     }
                   th {padding-right: 4px;}
		B{
			color: red;
		}
		.shift B{
			color: blue;
		}
		.xn{
			color: brown;
		}
		.dxn{
			color: hotpink;
		}
</style>

<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Danh Sách Đơn Hàng Đã Thanh Toán</h2></center>
        <div class="block"> 
  
        	
            <table class="data display datatable" id="example">
			<thead>
				</br>

				<tr>
					<center><th hidden>Mã Đặt</th>
					<th>Tên Khách Hàng</th>
					<th>SĐT</th>
					<th>Địa Chỉ Giao</th>
					<th>Mã Sản Phẩm</th>
					<th>Tên Sản Phẩm</th>
					<th>Số Lượng</th>
					<th>Tổng Giá Tiền</th>
					<th>Hình Ảnh</th>
					<th>Loại Thanh Toán</th>
					<th>Ngày Đặt</th>
					<th>Xử Lý</th></center>
				</tr>
			</thead>

			<tbody>
				
				<?php
				$fm = new Format();
				$ct = new cart();

				if(isset($_GET['idDatHangPaid']) && $_GET['idThongKe'])
				{
					$cart_details_Id = $_GET['idDatHangPaid'];
					$update_order = $ct->update_order($cart_details_Id);

					$id_thong_ke = $_GET['idThongKe'];
					$thong_ke = $ct->lietke_donhang_online($id_thong_ke);
				}
				elseif(isset($_GET['idXacNhanPaid']))
				{
					$xacnhan_Paid = $_GET['idXacNhanPaid'];
					$update_order_xacnhan = $ct->update_order_xacnhan($xacnhan_Paid);
				}
				elseif(isset($_GET['idHuyDonPaid']))
				{
					$huydon_Paid = $_GET['idHuyDonPaid'];
					$cancel_order = $ct->cancel_order($huydon_Paid);
				}

				?>

				<?php
				$show_order_online = $ct->show_order_online();
				if($show_order_online) {
					
				while ($result = $show_order_online->fetch_assoc()){
				?>

				<tr class="oddgradeX">
					<td hidden><?php echo $result['id_cartdetails']?></td>
					<td><?php echo $result['hoten']?></td>
					<td><?php echo $result['sodienthoai']?></td>
					<td><?php echo $result['diachi']?></td>
					<td><center><?php echo $result['productId']?></center></td>
					<td><?php echo $result['productName']?></td>
					<td><center><?php echo $result['quantity']?></center></td>
					<td><?php echo $fm->format_currency($result['price'])." "."VNĐ"?></td>
					<td><img src ="uploads/<?php echo $result['image'] ?>" width="85"></td>
					<td><center><?php echo $result['paid_type']?></center></td>
					<td><?php echo $result['paid_date']?></td>
					<td><a href="suadonhang.php?cartdetailsId=<?php echo $result['id_cartdetails'] ?>">Sửa Đơn</a></td>
					<td>
<?php 
						if($result['status']==0)
						{
?>
							<td><a onclick="return confirm('Có chắc là muốn xác nhận đơn này không?');"href="?idDatHangPaid=<?php echo $result['id_cartdetails'] ?>&idThongKe=<?php echo $result['id_cartdetails'] ?>"><div class="xn">Xác Nhận Đơn</div></a></td>
							<td>||</td>
							<td><a onclick="return confirm('Có chắc là muốn huỷ đơn này không?');"href="?idHuyDonPaid=<?php echo $result['id_cartdetails'] ?>"><div class="xn">Huỷ Đơn</div></a></td>
<?php
						}
						elseif($result['status']==1)
						{
?>
							<td><a onclick="return confirm('Xác nhận giao đơn hàng này?')"href="?idXacNhanPaid=<?php echo $result['id_cartdetails'] ?>"><div class="dxn">Đã Xác Nhận</div></a></td>
<?php
						}
						elseif($result['status']==3)
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
					</td>
									
					
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
