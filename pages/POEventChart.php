<?php 
	include '../auto_load.php';
	$resarr = array();

	$fromdate = date("Y-m-d",strtotime($_POST['fromdate']));
	$todate = date("Y-m-d",strtotime($_POST['todate']));
	$sql = "SELECT * FROM WHERE  CAST(CREATIONDATE AS date) BETWEEN '".$fromdate."' and '".$todate."'";
	$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	$row_count = sqlsrv_num_rows($res);
	$resarr['planned'] = $row_count;

	echo json_encode($resarr);
?>