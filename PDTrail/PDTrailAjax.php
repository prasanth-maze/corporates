<?php
include '../auto_load.php';
//	p($_POST,'e');
if(isset($_POST['Action'])){
	$Action = $_POST['Action'];
	if($Action=='getresult'){
	parse_str($_POST['filterData'], $data);
	//p($data,'e');
	$zmall_code = explode(",", @$data['zmall_code']);
	$rbmall_code = explode(",", @$data['rbmall_code']);
	$tmall_code = explode(",", @$data['tmall_code']);
	$poall_code = explode(",", @$data['poall_code']);


	if(@$data['zmLocation']=="All"){
		$ezmcode = implode( "'',''",$zmall_code);
	}else if(@$data['rbmLocation']=="All"){
		$ezmcode = @$data['zmLocation'];
		$erbmcode = implode( "'',''",$rbmall_code);
	}else if(@$data['tmlocation']=="All"){
		$erbmcode = @$data['rbmLocation'];
		$etmcode = implode( "'',''",$tmall_code);
	}else if(@$data['polocation']=="All"){
		$etmcode = @$data['tmlocation'];
		$epocode = implode( "'',''",$poall_code);
	}else{
		$epocode = $data['poall_code'];
	}

	 $returnarr = $resultarr = array();
	 $psql = "EXEC GetPDTrailReport @required='".$data['filter']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='',@rbmcode='',@tmcode='',@pocode='".@$POCODE."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@activity='".@$data['activity']."'";
	 //echo $psql;exit;
	 $stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);
	 $sno=1;
	 while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {		
	 	$columns = array_keys($prow);
	 	//p($prow,'e');
	 	$resarr = array();
	 	$resarr[] = $sno++;
	 	//echo implode(",",$columns);exit;
	 	foreach ($columns as $col) {
	 		$colval = $prow[$col];
	 		/*if($col=='TRANSDATE'){
	 			$colval = $colval->format('d-m-Y');
	 		}*/
	 		$resarr[] = $colval;
	 	}
	 	//p($resarr,'e');
	 	$resultarr[] = $resarr;
	}
	

	    $found = count($resultarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $res['data'] = $resultarr;
        $result = $res;

	}
	}else{
	$result = array('status'=>'failed','msg'=>'action missing');
}

echo json_encode($result);