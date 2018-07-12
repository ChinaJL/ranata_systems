<!-- Styler -->
<style type="text/css">
.panel * {
	font-family: "Arial","​Helvetica","​sans-serif";
}
.fa {
	font-family: "FontAwesome";
}
.datagrid-header-row * {
	font-weight: bold;
}
.messager-window * a:focus, .messager-window * span:focus {
	color: blue;
	font-weight: bold;
}
.daterangepicker * {
	font-family: "Source Sans Pro","Arial","​Helvetica","​sans-serif";
	box-sizing: border-box;
}
.glyphicon	{font-family: "Glyphicons Halflings"}

	
</style>
<?php 
$periode_default = date("Y")."-01-01";
$periode_now = date("Y-m-d");
if(!empty($_GET['start']) && !empty($_GET['end'])){
    $periode_default = $_GET['start'];
    $periode_now = $_GET['end'];
}
?>
<div id="page-content" class="clearfix">
    <div style="max-width: 1000px; margin: auto;">
        
        <div id="invoice-status-bar">
        	<div class="panel panel-default  p5 no-border m0">
            
            <span class="ml15">
                <form action="" method="GET" role="form" class="general-form">
               <table class="table table-bordered">
                   <tr>
                       <td><label>Start Date</label></td>
                       <td><input type="text" class="form-control" name="start" id="start" value="<?php echo $periode_default ?>" autocomplete="off"></td>
                        <td><label>End Date</label></td>
                       <td><input type="text" class="form-control" name="end" id="end" value="<?php echo $periode_now ?>" autocomplete="off"></td>
                        <td>
                            <button type="submit" name="search" class="btn btn-default" value="1"><i class=" fa fa-search"></i> Filter</button>
                            <button type="submit" name="print"  class="btn btn-default" value="2"><i class=" fa fa-print"></i> Print</button>

                        </td>
                   </tr>
               </table>
               </form>
                </span>

            </div>
        </div>

        

        <div class="mt15">
            <div class="panel panel-default p15 b-t">
                

                <div class="table-responsive mt15 pl15 pr15">

<p style="text-align:center; font-size: 15pt; font-weight: bold;"> Laporan Laba Rugi <br> Periode <?php echo format_to_date($periode_default)." - ".format_to_date($periode_now);  ?></p>
	
	<hr>


<h3> Pendapatan </h3>
<table  class="table table-bordered">
	<tr style="background: lightgrey">
		<th style="width:5%; vertical-align: middle; text-align:center" > No. </th>
		<th style="width:75%; vertical-align: middle; text-align:center">Keterangan </th>
		<th style="width:20%; vertical-align: middle; text-align:center"> Jumlah  </th>
	</tr>
	

	<?php
	$no_dapat = 1;
	$jml_dapat = 0;
	foreach ($data_dapat as $row) {
		echo '
				<tr>
					<td class="h_tengah"> '.$no_dapat.' </td>
		';
		$jml_akun = $this->Profitloss_model->get_jml_akun($row->id,$periode_default,$periode_now);
		$jumlah = $jml_akun->jum_debet + $jml_akun->jum_kredit;
		echo '<td>'.$row->account_name.'</td>
				<td class="h_kanan">'.number_format(nsi_round($jumlah)).'</td>';
		$jml_dapat += $jumlah;
		echo '</tr>';
		$no_dapat++;
	}
	?>
	<tr style="background: lightgrey">
		<td colspan="2" class="h_kanan"> Jumlah Pendapatan</td>
		<td class="h_kanan"><?php $jml_p = $jml_dapat;
		echo number_format(nsi_round($jml_p))   ?></td>
	</tr>
</table>


<h3> Pendapatan non Operasional </h3>
<table  class="table table-bordered">
	<tr style="background: lightgrey">
		<th style="width:5%; vertical-align: middle; text-align:center" > No. </th>
		<th style="width:75%; vertical-align: middle; text-align:center">Keterangan </th>
		<th style="width:20%; vertical-align: middle; text-align:center"> Jumlah  </th>
	</tr>
	

	<?php
	$no_dapat = 1;
	$jml_dapat = 0;
	foreach ($dapat_non_op as $row) {
		echo '
				<tr>
					<td class="h_tengah"> '.$no_dapat.' </td>
		';
		$jml_akun = $this->Profitloss_model->get_jml_akun($row->id,$periode_default,$periode_now);
		$jumlah = $jml_akun->jum_debet + $jml_akun->jum_kredit;
		echo '<td>'.$row->account_name.'</td>
				<td class="h_kanan">'.number_format(nsi_round($jumlah)).'</td>';
		$jml_dapat += $jumlah;
		echo '</tr>';
		$no_dapat++;
	}
	?>
	<tr style="background: lightgrey">
		<td colspan="2" class="h_kanan"> Jumlah Pendapatan</td>
		<td class="h_kanan"><?php $jml_p = $jml_dapat;
		echo number_format(nsi_round($jml_p))   ?></td>
	</tr>
</table>


<h3> Biaya dan Beban </h3>
<table  class="table table-bordered">
	<tr style="background: lightgrey">
		<th style="width:5%; vertical-align: middle; text-align:center" > No. </th>
		<th style="width:75%; vertical-align: middle; text-align:center">Keterangan </th>
		<th style="width:20%; vertical-align: middle; text-align:center"> Jumlah  </th>
	</tr>
	<?php 
		$no=1;
		$jml_beban = 0;
		foreach ($data_biaya as $rows) {
			$jml_akun = $this->Profitloss_model->get_jml_akun($rows->id,$periode_default,$periode_now);
			$jumlah = $jml_akun->jum_debet + $jml_akun->jum_kredit;
			$jml_beban += $jumlah;

			echo '<tr>
						<td class="h_tengah">'.$no++.'</td>
						<td>'.$rows->account_name.'</td>
						<td class="h_kanan">'.number_format(nsi_round($jumlah)).'</td>
					</tr>';
		}
	?>
			<tr style="background: lightgrey">
				<td colspan="2" class="h_kanan"> Jumlah Biaya</td>
				<td class="h_kanan"> <?php echo number_format($jml_beban) ?></td>
			</tr>
</table>

<h3> Biaya non Operasional </h3>
<table  class="table table-bordered">
	<tr style="background: lightgrey">
		<th style="width:5%; vertical-align: middle; text-align:center" > No. </th>
		<th style="width:75%; vertical-align: middle; text-align:center">Keterangan </th>
		<th style="width:20%; vertical-align: middle; text-align:center"> Jumlah  </th>
	</tr>
	<?php 
		$no=1;
		$jml_beban = 0;
		foreach ($data_biaya_other as $rows) {
			$jml_akun = $this->Profitloss_model->get_jml_akun($rows->id,$periode_default,$periode_now);
			$jumlah = $jml_akun->jum_debet + $jml_akun->jum_kredit;
			$jml_beban += $jumlah;

			echo '<tr>
						<td class="h_tengah">'.$no++.'</td>
						<td>'.$rows->account_name.'</td>
						<td class="h_kanan">'.number_format(nsi_round($jumlah)).'</td>
					</tr>';
		}
	?>
			<tr style="background: lightgrey">
				<td colspan="2" class="h_kanan"> Jumlah Biaya</td>
				<td class="h_kanan"> <?php echo number_format($jml_beban) ?></td>
			</tr>
</table>


<table width="100%" class="table">
	<tr style="background-color: lightgrey;">
		<td colspan="2" class="h_kanan"> Laba Rugi </td>
		<td class="h_kanan"><?php echo number_format(nsi_round($jml_p - $jml_beban )) ?></td>
	</tr>
</table>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {

setDatePicker("#start");
   setDatePicker("#end");

});
</script>