<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/layout.css" />

<style>.oddgradeX td{
                        padding-right: 2px;
                       	padding-top: 15px;
                       	padding-bottom: 5px;
                     }
                   th {padding-right: 4px;}
        #chart{
          width: 37%;
        }
</style>

<?php 
    
    require "../carbon/autoload.php";
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include "inc/header.php";
    include "../classes/thongke.php";
    // printf("Now: %s", Carbon::now('Asia/Ho_Chi_Minh'));
    $now = Carbon::now('Asia/Ho_Chi_Minh');
?>

<?php 
    $thong_ke = new thongke();

    $show_data = $thong_ke->thongke_theo7ngay();
    $chart_data = '';
    if($show_data)
    {
        while($val = $show_data->fetch_array())
        {
            $chart_data .= 
            "{ 
              date:'".$val['paid_date']."', 
              order:".$val['tong_soluongdonhang'].", 
              quantity:".$val['tong_soluongban'].", 
              sales:".$val['doanhthu']."
          }, ";
        }
        $chart_data = substr($chart_data, 0, -2);
    }
    else {}
?>

<div class="grid_10">
    <div class="box round first grid">
        <center><h2>Thống kê đơn hàng theo:</h2></center>
        <select class="select-date">
		<option value="7ngay" selected>7 ngày qua</option>
		<option value="28ngay">28 ngày qua</option>
		<option value="90ngay">90 ngày qua</option>
		<option value="365ngay">365 ngày qua</option>
	</select>

  </div>
  
  </div>
  <div id="chart"></div>


<script>
Morris.Line({
        element: 'chart',

        data:[<?php echo $chart_data; ?>],

        xkey:'date',
      
        ykeys:['order','quantity','sales'],
      
        labels:['Tổng Đơn hàng','Tổng Số Lượng bán','Tổng Doanh thu']

        // hideHover:'auto'

        // stacked:true (cái này dùng cho Morris.Bar)
      });
</script>
