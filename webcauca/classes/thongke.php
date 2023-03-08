<?php 
    $filepath = realpath(dirname(__FILE__)); //Câu lệnh này dùng để trỏ đường dẫn cho nó đúng
    include_once ($filepath."/../lib/database.php"); //Trỏ đến file database để gọi ra sử dụng
    require ($filepath."/../carbon/autoload.php");
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    
?>

<?php 
    class thongke
    {
        private $db;
    
        public function __construct()
        {
            $this->db = new Database();
        }

        public function thongke_theo7ngay()
        {
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString(); 

            //subdays là thời gian hiện tại, còn subdays(7) có ngĩa là lấy subdays - 7 ngày 
            //vd: subdays hôm nay là: 10/01/2023, trừ 7 là 03/01/2023
            //-> biến $subdays sau khi trừ xong sẽ bằng 03/01/2023

            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 

            $sql = "SELECT * FROM tbl_thongke WHERE paid_date BETWEEN '$subdays' AND '$now' ORDER BY paid_date ASC" ;
            $sql_query = $this->db->select($sql);
            return $sql_query;
        }
    }
?>

<?php
	
    

    // if(isset($_POST['thoigian'])){
    // 	$thoigian = $_POST['thoigian'];
	// }else{
	// 	$thoigian = '';
	// 	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();	
	// }

   
    // if($thoigian=='7ngay'){
    // 	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
	// }elseif($thoigian=='28ngay'){
    // 	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
	// }elseif($thoigian=='90ngay'){
    // 	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
	// }elseif($thoigian=='365ngay'){
	// 	$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();	
	// }
	
    
?>