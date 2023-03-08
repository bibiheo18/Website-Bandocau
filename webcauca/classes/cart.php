<?php
	$filepath = realpath(dirname(__FILE__)); //Câu lệnh này dùng để trỏ đường dẫn cho nó đúng
	include_once ($filepath."/../lib/database.php"); //Trỏ đến file database để gọi ra sử dụng
	include_once ($filepath."/../helper/format.php"); //Trỏ đến file format để gọi ra sử dụng
	require ($filepath."/../carbon/autoload.php");
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	
	
?>
<?php
	class cart
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function add_to_cart($quantity, $id){
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);/*mysqli_real_escape_string để
			 loại bỏ những ký tự có thể gây ảnh hưởng đến câu lệnh SQL, $this là đang ở function hiện tại
			 nó trỏ tới db là trỏ vào file database trong DATABASE.PHP, rồi nó tiếp tục trỏ tới link*/
			$id = mysqli_real_escape_string($this->db->link, $id);// Biến id này được quyền trỏ tới link
			$sId = session_id();// Biến sId này được quyền gọi ra id của phiên làm việc

			
			$check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
			$result_check_cart = $this->db->select($check_cart);

			if($result_check_cart){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào Giỏ Hàng</span>";
				return $msg;
			}else{

				$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
				$result = $this->db->select($query)->fetch_assoc();//fetch_assoc Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)


				$image = $result["image"]; // Lấy đc kết quả của thuộc tính image trong CSDL
				$price = $result["price"];
				$productName = $result["productName"];
				$code_cart = rand(0,9999);//random ngẫu nghiên code cart

				$query_insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image,code_cart) VALUES('$id','$sId',
				'$productName','$price','$quantity','$image','$code_cart')";
				
				$insert_cart = $this->db->insert($query_insert);

					if($insert_cart){
					
						$msg = "<span class='error'>Thêm sản phẩm vào Giỏ Hàng thành công.</span>";
						return $msg;
					
							
					}
				 }
		}

		public function get_product_cart(){// Lấy thông tin sản phẩm trong giỏ hàng
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_quantity_cart($quantity, $cartId){ // cập nhật số lượng giỏ hàng
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);

			$query = "UPDATE tbl_cart SET 
					quantity = '$quantity'
					WHERE cartId = '$cartId' ";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Giỏ Hàng của bạn đã được cập nhật Thành Công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Giỏ Hàng của bạn đã được cập nhật Thất Bại</span>";
				return $msg;
			}
		}


		public function del_product_cart($cartid){ //Xóa sản phẩm giỏ hàng
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);
			$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid' ";
			$result = $this->db->delete($query);
		}

		public function check_cart(){ //Kiểm tra giỏ hàng
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getallorder(){
			$query = "SELECT * FROM tbl_order ";
			$result = $this->db->select($query);
			return $result;
		}



		public function update_order_offline($Id){
			$query_update = "UPDATE tbl_order SET status = 1 WHERE orderId = '$Id' ";
			$result = $this->db->update($query_update);
			if($result){
				echo '<script>alert("Bạn đã cập nhật đơn hàng thành công!")</script>';
				echo "<script>window.location = 'dathang.php'</script>";
			}else{
				echo '<script>alert("Đã xảy ra lỗi!")</script>';
				echo "<script>window.location = 'dathang.php'</script>";
				}
		}

		public function update_order_confirm($id_xacnhan)
		{
			$query_update = "UPDATE tbl_order SET status = 2 WHERE status = '$id_xacnhan' ";
			$result = $this->db->update($query_update);
			if($result)
				{
					echo '<script>alert("Xác nhận thành công, đơn hàng sẽ được vận chuyển!")</script>';
					echo "<script>window.location = 'dathang.php'</script>";
				}
		}

		public function cancel_order_offline($Id_Huy)
		{
			$query_update = "UPDATE tbl_order SET status = 3 WHERE orderID = '$Id_Huy' ";
			$result = $this->db->update($query_update);
			if($result){
				echo '<script>alert("Bạn đã huỷ đơn hàng này thành công!")</script>';
				echo "<script>window.location = 'dathang.php'</script>";
			}else{
				echo '<script>alert("Đã xảy ra lỗi!")</script>';
				echo "<script>window.location = 'dathang.php'</script>";
				}
		}

		public function insert_order($data)
		{
			$hotenkhach = mysqli_real_escape_string($this->db->link, $data['hotenkhach']);
			$sdt = mysqli_real_escape_string($this->db->link, $data['sdt']);
			$diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
			$thanhpho = mysqli_real_escape_string($this->db->link, $data['thanhpho']);
			$now = Carbon::now('Asia/Ho_Chi_Minh');

			if(empty($hotenkhach) || empty($sdt) || empty($diachi) || empty($thanhpho))
			{
				$alert = "<span class='error'>Các Trường không được để trống</span>";
					return $alert;
			}

			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$get_product = $this->db->select($query);

			if($get_product)
			{
				while($result = $get_product->fetch_assoc())  //fetch_assoc để lấy dữ liệu mà câu query(truy vấn) đã thực hiện
				{
					$productid = $result['productId'];
					$productname = $result['productName'];
					$quantity = $result['quantity'];
					$price = $result['price'] * $quantity;
					$vat = $price * 0.1;
					$pricee = $price + $vat;
					$image = $result['image'];
				
					$query_order = "INSERT INTO tbl_order(hotenkhach,sdt,diachi,thanhpho,productId,productName,quantity,price,image,paid_date)
					VALUES('$hotenkhach','$sdt','$diachi','$thanhpho','$productid','$productname','$quantity','$price','$image','$now')";
					$result = $this->db->insert($query_order);

					$query = "DELETE FROM tbl_cart WHERE sId = '$sId'"; //Xóa session Id(phiên giao dịch giỏ hàng)
					$result = $this->db->delete($query); // Thực thi xóa dữ liệu bằng câu truy vấn query
					header('Location:success.php');
					}
				}
			}

			public function lietke_donhang_offline($Id_lietke)
			{
				$soluongban = 0;
				$doanhthu = 0;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

				$query_liet_ke = "SELECT * FROM tbl_order WHERE tbl_order.orderId = '$Id_lietke'";
				$query_excute = $this->db->select($query_liet_ke);

				while($result = $query_excute->fetch_assoc())
				{
					$soluongban += $result['quantity'];
					$doanhthu += $result['price'];
				}

				$query_thong_ke = "SELECT * FROM tbl_thongke WHERE paid_date = '$now' ";
				$select_execute = $this->db->select($query_thong_ke);

				if($select_execute)
				{
					// nếu date_paid = $now -> đã có đơn hàng của ngày hôm nay
					// echo '<script>alert("Đã cộng dồn thành công vào đơn hàng thống kê hôm nay")</script>';

					while($result_thong_ke = $select_execute->fetch_assoc())
					{
						// $all_location_result[] = 
						$tongsoluongdonhang = $result_thong_ke['tong_soluongdonhang'] + 1;
						$tongsoluongban = $result_thong_ke['tong_soluongban'] + $soluongban;
						$tongdoanhthu = $result_thong_ke['doanhthu'] + $doanhthu;

						$update_query = 
						"UPDATE tbl_thongke SET 
						tong_soluongdonhang = '$tongsoluongdonhang',
						tong_soluongban = '$tongsoluongban',
						doanhthu = '$tongdoanhthu'
						WHERE paid_date = '$now'";

						$result_update = $this->db->update($update_query);
					}
				}

				else
				{
					// nếu date_paid != $now -> chưa có đơn hàng của ngày hôm nay
					// echo '<script>alert("đây là đơn hàng mới nhất của hôm nay!")</script>';
					
					$tongsoluongdonhang = 1;
					$tongsoluongban = $soluongban;
					$tongdoanhthu = $doanhthu;
					
					$insert_query = 
					"INSERT INTO tbl_thongke(paid_date, tong_soluongdonhang, tong_soluongban, doanhthu) 
					VALUES ('$now', '$tongsoluongdonhang', '$tongsoluongban', '$tongdoanhthu')";
					$result_insert = $this->db->insert($insert_query);
				}
			}
		

			public function insert_vnpay($vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_OrderInfo, 
			$vnp_PayDate, $vnp_TmnCode, $vnp_TransactionNo, $vnp_CardType, $code_cart)
			{
			
				$insert_vnpay = "INSERT INTO tbl_vnpay(
				vnp_amount, vnp_bankcode, vnp_banktranno, vnp_cardtype, vnp_orderinfo, vnp_paydate, 
				vnp_tmncode, vnp_transactionno, code_cart) 
				VALUES(
				'$vnp_Amount','$vnp_BankCode','$vnp_BankTranNo','$vnp_OrderInfo',
				'$vnp_PayDate','$vnp_TmnCode','$vnp_TransactionNo','$vnp_CardType','$code_cart'
				)";
				$result = $this->db->insert($insert_vnpay);
				return $result;
			}

			public function insert_order_details($data)
			{
				$sId = session_id();
				$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
				$get_product = $this->db->select($query);
				$paid_type = "VNPAY";
				$now = Carbon::now('Asia/Ho_Chi_Minh');
				
				if($get_product)
				{	
					while($result = $get_product->fetch_assoc())
					{
						$productid = $result['productId'];
						$quantity = $result['quantity'];
						$price = $result['price'] * $quantity; //tổng giá
						$code_cart = $result['code_cart'];
						$sId = $result['sId'];

						$query_add_details = "INSERT INTO tbl_cart_details(id_sanpham,soluongmua,giatien,code_cart,sId,paid_type,paid_date)
						VALUES('$productid','$quantity',$price,'$code_cart','$sId','$paid_type','$now')";
						$result = $this->db->insert($query_add_details);
					}
				}
			}

			public function insert_order_online($name,$sodienthoai,$diachi)
			{
				$sId = session_id();
				$query = "SELECT * FROM tbl_cart_details WHERE sId = '$sId' ";
				$get_sId = $this->db->select($query);
				if($get_sId)
				{
					while($result = $get_sId->fetch_assoc())
					{
						$SID = $result['sId'];
						$query_update = "UPDATE tbl_cart_details 
						SET hoten = '$name', sodienthoai = '$sodienthoai', diachi = '$diachi'
						WHERE sId = '$SID'";
						$result_query = $this->db->insert($query_update);
						if($result_query)
						{
							unset($_SESSION['code_cart']);
							echo "<script>window.location = 'success.php'</script>";
							
						}
						else
						{
							echo "<script>window.location = '404.php'</script>";
						}
					}
				}
				unset($_SESSION['code_cart']);
			}

			public function show_order_online()
			{
				//tbl_cart_details lấy id_sanpham, soluongmua, hoten, sdt, diachi
				//DK chung: sId
				//tbl_gio_hang productName, price, image

				$query = 
				"SELECT tbl_cart_details.id_cartdetails, tbl_cart_details.hoten, tbl_cart_details.sodienthoai, 
				tbl_cart_details.diachi, tbl_cart_details.status, tbl_cart_details.paid_type, 
				tbl_cart_details.paid_date, tbl_giohang.productId, tbl_giohang.productName, 
				tbl_giohang.price, tbl_giohang.quantity, tbl_giohang.image 
				FROM tbl_cart_details 
				INNER JOIN tbl_giohang 
				ON tbl_cart_details.code_cart = tbl_giohang.code_cart";

				$result_query = $this->db->select($query);
				return $result_query;
			}

			public function update_order($cart_details_Id)
			{
				$query = "UPDATE tbl_cart_details SET status = 1 WHERE id_cartdetails = $cart_details_Id";
				$result_query = $this->db->update($query);
				if($result_query)
				{
					echo '<script>alert("Bạn đã cập nhật đơn hàng thành công!")</script>';
					echo "<script>window.location = 'dathangpaid.php'</script>";
				}
			}

			public function update_order_xacnhan($xacnhan_Paid)
			{
				$query = "UPDATE tbl_cart_details SET status = 2 WHERE id_cartdetails = $xacnhan_Paid";
				$result_query = $this->db->update($query);
				if($result_query)
				{
					echo '<script>alert("Xác nhận thành công, đơn hàng sẽ được vận chuyển!")</script>';
					echo "<script>window.location = 'dathangpaid.php'</script>";
				}
			}

			public function cancel_order($huydon_Paid)
			{
				$query = "UPDATE tbl_cart_details SET status = 3 WHERE id_cartdetails = $huydon_Paid";
				$result_query = $this->db->update($query);
				if($result_query)
				{
					echo '<script>alert("Đã huỷ thành công đơn hàng này!")</script>';
					echo "<script>window.location = 'dathangpaid.php'</script>";
				}
			}

			public function get_don_hang_paid($id_paid)
			{
				$query = "SELECT tbl_cart_details.id_cartdetails, tbl_cart_details.hoten, tbl_cart_details.sodienthoai, 
				tbl_cart_details.diachi, tbl_cart_details.status, tbl_cart_details.paid_type, tbl_giohang.productId, 
				tbl_giohang.productName, tbl_giohang.price, tbl_giohang.quantity, tbl_giohang.image 
				FROM tbl_cart_details 
				INNER JOIN tbl_giohang 
				ON tbl_cart_details.code_cart = tbl_giohang.code_cart
				WHERE id_cartdetails = '$id_paid' ";
				$result_query = $this->db->select($query);
				return $result_query;
			}

			public function update_paid($id_paid,$data,$idDonHangPaid)
			{
				$hotenkhach = mysqli_real_escape_string($this->db->link, $data['hoten']);
				$sdt = mysqli_real_escape_string($this->db->link, $data['sodienthoai']);
				$diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
				$trangthai = mysqli_real_escape_string($this->db->link, $data['status']);

				$query_update = 
				"UPDATE tbl_cart_details SET 
				hoten = '$hotenkhach',
				sodienthoai = '$sdt',
				diachi = '$diachi',
				status = '$trangthai'
				WHERE id_cartdetails = '$idDonHangPaid' ";

				$result = $this->db->update($query_update);
				if($result)
				{
					echo '<script>alert("Chỉnh sửa thông tin Đơn hàng thành công!")</script>';	
					echo "<script>window.location = 'dathangpaid.php'</script>";
				}
			}

			public function lietke_donhang_online($id_cart_details)
			{
				//lấy ra đơn hàng theo id_cart_details để tiến hành thống kê
				$soluongban = 0;
				$doanhthu = 0;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

				$query_liet_ke = "SELECT * FROM tbl_cart_details WHERE tbl_cart_details.id_cartdetails = '$id_cart_details'";
				$query_excute = $this->db->select($query_liet_ke);

				while($result = $query_excute->fetch_assoc())
				{
					$soluongban += $result['soluongmua'];
					$doanhthu += $result['giatien'];
				}

				$query_thong_ke = "SELECT * FROM tbl_thongke WHERE paid_date = '$now' ";
				$select_execute = $this->db->select($query_thong_ke);

				if($select_execute)
				{
					// nếu date_paid = $now -> đã có đơn hàng của ngày hôm nay
					// echo '<script>alert("Đã cộng dồn thành công vào đơn hàng thống kê hôm nay")</script>';

					while($result_thong_ke = $select_execute->fetch_assoc())
					{
						// $all_location_result[] = 
						$tongsoluongdonhang = $result_thong_ke['tong_soluongdonhang'] + 1;
						$tongsoluongban = $result_thong_ke['tong_soluongban'] + $soluongban;
						$tongdoanhthu = $result_thong_ke['doanhthu'] + $doanhthu;

						$update_query = 
						"UPDATE tbl_thongke SET 
						tong_soluongdonhang = '$tongsoluongdonhang',
						tong_soluongban = '$tongsoluongban',
						doanhthu = '$tongdoanhthu'
						WHERE paid_date = '$now'";

						$result_update = $this->db->update($update_query);
					}
				}

				else
				{
					// nếu date_paid != $now -> chưa có đơn hàng của ngày hôm nay
					// echo '<script>alert("đây là đơn hàng mới nhất của hôm nay!")</script>';
					
					$tongsoluongdonhang = 1;
					$tongsoluongban = $soluongban;
					$tongdoanhthu = $doanhthu;
					
					$insert_query = 
					"INSERT INTO tbl_thongke(paid_date, tong_soluongdonhang, tong_soluongban, doanhthu) 
					VALUES ('$now', '$tongsoluongdonhang', '$tongsoluongban', '$tongdoanhthu')";
					$result_insert = $this->db->insert($insert_query);
				}
			}
		}
?>




