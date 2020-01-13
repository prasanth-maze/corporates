<?php 
include '../auto_load.php';
parse_str($_POST['filterData'], $postdata);
//p($postdata,'e');
$postdata['fromdate'] = date("Y-m-d",strtotime($postdata['fromdate']));
$postdata['todate'] = date("Y-m-d",strtotime($postdata['todate']));
$psql = "EXEC LoginActivity @act='".@$postdata['act']."',@cemp='".@$_SESSION['Dcode']."',@empcode='".@$postdata['empcode']."', @pdiv='".@$postdata['pdivision']."',@fromdate='".@$postdata['fromdate']."',@todate='".@$postdata['todate']."',@zcode='".@$postdata['zmLocation']."',@rbmcode='".@$postdata['rbmLocation']."',@tmcode='".@$postdata['tmlocation']."',@pocode='".@$postdata['polocation']."'";
	//echo $psql;exit;
	$stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);
	$result = $resarr = array();
	$sn=1;

	if($postdata['act']=='GETCOUNTRBM'){

		while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
			
			$regcount = $prow['REGIONCOUNT'];
			$zone = $prow['ZONENAME'];
			$zoneid =  $prow['ZONEID'];
			$empcount = $prow['EMPCOUNT'];
			$loggedin =  $notloggeding =  0;
			 $regids = "";
			 $sep = "";
			for($i=1;$i<=$regcount;$i++){
				sqlsrv_next_result($stmt);
				while($prow1 = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
					if($prow1['LOGINSTATUS']>0){
						$loggedin++;
					}else{
						$notloggeding++;
					}
					$regids .= $sep.$prow1['REGIONID'];
					$sep = "'',''";
				}
				$regids = "'".$regids+"'";
			}

			$res = calcAttendance($empcount,$loggedin,$notloggeding);

			$resarr[] = array($sn++,$zone,$zoneid,$regids,$regcount,$empcount,$loggedin,$notloggeding,$loggedin,$notloggeding);
			sqlsrv_next_result($stmt);
		}
		//p($resarr,'e');

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;
}

if($postdata['act']=='GETLOGINDETRBM'){
	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
			$status = "Not logged in";
			if($prow['LOGDET']!="")
			{
				$status = 'Logged in';
			}
	$resarr[] = array($sn++,$prow['REGIONNAME'],$prow['RBMID'],$prow['EMPLNAME'],$status,$prow['LOGDET']);
	 sqlsrv_next_result($stmt);
}

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;
}

if($postdata['act']=='GETCOUNTTM'){

		while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
			//p($prow);
			
			$ZONEID =  $prow['ZONEID'];
			$ZONENAME = $prow['ZONENAME'];
			$REGIONID = $prow['REGIONID'];
			$REGIONNAME = $prow['REGIONNAME'];
			$TMcount = $prow['TMCOUNT'];
			$EMPcount = $prow['EMPCOUNT'];
			$loggedin =  $notloggeding =  0;
			 $regids = "";
			 $sep = "";
			for($i=1;$i<=$TMcount;$i++){
				sqlsrv_next_result($stmt);
				while($prow1 = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
					if($prow1['LOGINSTATUS']>0){
						$loggedin++;
					}else{
						$notloggeding++;
					}
					$sep = "'',''";
				}

			}

			$res = calcAttendance($EMPcount,$loggedin,$notloggeding);

			$resarr[] = array($sn++,$ZONENAME,$ZONEID,$REGIONID,$REGIONNAME,$TMcount,$EMPcount,$loggedin,$notloggeding,$loggedin,$notloggeding);
			sqlsrv_next_result($stmt);
		}

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;
}

if($postdata['act']=='GETCOUNTPO'){
	

	 while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
			//p($prow);
			$POCOUNT = $prow['POCOUNT'];
			$ZONENAME = $prow['ZONENAME'];
			$ZONEID =  $prow['ZONEID'];
			$REGIONID = $prow['REGIONID'];
			$REGIONNAME = $prow['REGIONNAME'];
			$TMID = $prow['TMID'];
			$TMNAME = $prow['TMNAME'];
			
			$loggedin =  $notloggeding =  0;
			 $regids = "";
			 $sep = "";
			for($i=1;$i<=$POCOUNT;$i++){
				sqlsrv_next_result($stmt);
				while($prow1 = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
					if($prow1['LOGINSTATUS']>0){
						$loggedin++;
					}else{
						$notloggeding++;
					}
					$sep = "'',''";
				}
			}

			$res = calcAttendance($POCOUNT,$loggedin,$loggedin);


			$resarr[] = array($sn++,$ZONENAME,$REGIONNAME,$TMID,$TMNAME,$POCOUNT,$loggedin,$notloggeding,$loggedin,$notloggeding);
			sqlsrv_next_result($stmt);
		}
		//p($resarr,'e');

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;
        //p($result,'e');
}


if($postdata['act']=='GETLOGINDETTM'){
	
	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$status = "Not logged in";
			if($prow['LOGDET']!="")
			{
				$status = 'Logged in';
			}
		$resarr[] = array($sn++,$prow['ZONENAME'],$prow['REGIONNAME'],$prow['TMID'],$prow['TMNAME'],$prow['EMPLID'],$prow['EMPLNAME'],$status,$prow['LOGDET']);
		sqlsrv_next_result($stmt);
	}

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;
}



if($postdata['act']=='GETLOGINDETPO'){

	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$status = "Not logged in";
			if($prow['LOGDET']!="")
			{
				$status = 'Logged in';
			}
		$resarr[] = array($sn++,$prow['ZONENAME'],$prow['REGIONNAME'],$prow['TMNAME'],$prow['POHQNAME'],$prow['PONAME'],$status,$prow['LOGDET']);
		sqlsrv_next_result($stmt);
	}

		$found = count($resarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $data1['data'] = $resarr;
        $result = $data1;
}

echo json_encode($result);
/*if( json_encode($result) === false ) {
        throw new Exception( json_last_error() );
    }*/
?>