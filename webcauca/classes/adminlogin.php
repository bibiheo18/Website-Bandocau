<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath."/../lib/session.php");
	Session::checkLogin(); // Gọi lớp này khi dn admin đúng và nó sẽ chuyển qua trang index
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	
?>





<?php
	class adminlogin
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function login_admin($adminUser,$adminPass)
		{	
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);
            //kiểm tra hai cái (user&pass) có hiệu lực hay không
			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);//1 biến là kết nối csdl,1 biến là dữ liệu user
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);//1 biến là kết nối csdl,1 biến là dữ liệu pass
            // nếu hợp lệ sẽ lấy hai cái user&pass để kết nối với cơ sổ dữ liệu

			if(empty($adminUser) || empty($adminPass)){
				//Nếu để trống tk & mk
				$alert = '<span class= "error"><center>Vui lòng nhập Tên Tài Khoản và Mật Khẩu.</center></span>';
				return $alert;
			} else {
				$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
				//lệnh
				$result = $this->db->select($query); // lệnh select trong this database
                //Thực thi câu lệnh
				if($result != false){
					// nếu kết quả khác sai (có nghĩa là đúng)
					$value = $result->fetch_assoc();
					Session::set('adminlogin',true);
					Session::set('adminid', $value['adminid']);
					Session::set('adminUser', $value['adminUser']);
					Session::set('adminName', $value['adminName']);
					header('Location:index.php');
                //Trường hợp Nếu trừng khớp các giá trị adminid/user/name thì hệ thống sẽ chuyển sang trang index
				}else{
					$alert = '<span class= "error"><center>Tài Khoản hoặc Mật Khẩu không đúng. Mời bạn nhập lại.</center></span>';
				//trường hợp sai
					return $alert;
				}
			}
		}
	}

?>


<style>.error {color: red;}</style>