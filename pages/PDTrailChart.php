<?php 
	include '../auto_load.php';
	include 'PDTrailChartFunc.php';
	$resarr = array();
//p($_POST,'e');
	$season = $_POST['season'];
	$pdiv = $_POST['pdivision'];

	
	$zmall_code = explode(",", @$_POST['zmall_code']);
	$rbmall_code = explode(",", @$_POST['rbmall_code']);
	$tmall_code = explode(",", @$_POST['tmall_code']);
	$poall_code = explode(",", @$_POST['poall_code']);
	
	if(@$_POST['zmLocation']=="All"){
		$ezmcode = implode( "'',''",$zmall_code);
	}else if(@$_POST['rbmLocation']=="All"){
		$ezmcode = @$_POST['zmLocation'];
		$erbmcode = implode( "'',''",$rbmall_code);
	}else if(@$_POST['tmlocation']=="All"){
		$erbmcode = @$_POST['rbmLocation'];
		$etmcode = implode( "'',''",$tmall_code);
	}else if(@$_POST['polocation']=="All"){
		$etmcode = @$_POST['tmlocation'];
		$epocode = implode( "'',''",$poall_code);
	}else{
		$epocode = $_POST['poall_code'];
	}

	$psql = "EXEC PDTrail_KPI @pdiv='".@$pdiv."',@season='".@$season."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$_POST['product']."',@hybrid='".@$_POST['hybrid']."',@activity='".@$_POST['activity']."' ";
	//echo $psql;exit;
	$stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);

	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$kyikey =  key($prow);
	    $resarr[$kyikey] = $prow[$kyikey];
	    sqlsrv_next_result($stmt);
	}
	

	//GET LOCATION WISE CHART DATA
	$locationWiseData = LocationWiseChart($_POST);
	$resarr['locationWiseData'] = $locationWiseData;
	//GET PRODUCT WISE CHART DATA
	$productWisesData = ProductWiseChart($_POST);
	$resarr['productWisesData'] = $productWisesData;
	//GET ACTIVITY WISE CHART DATA
	$ActivityWisesData = ActivityWisesChart($_POST);
	$resarr['ActivityWisesData'] = $ActivityWisesData;
	
	//GET TREND CHART  DATA
	/*$TrendChartData = TrendChart($_POST);
	$resarr['TrendChartData'] = $TrendChartData;

	//GET RESULT DATA FOR TABLE AND EXCEL REPORT
	/*$ResultData = ResultData($_POST);
	$resarr['ResultData'] = $ResultData;*/	
	
	
//p($resarr,'e');
	echo json_encode($resarr);
?>