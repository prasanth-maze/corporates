<?php
	

function LocationWiseChart($data){

 global $conn;
 $returnarr = $rbecountarr = $alltmcountarr = $allpocountarr = $rbmdrilldata = $tmdrilldata = array();
	 if($_SESSION['Dcode']=='ZM'){
	 			
			 $psql = "EXEC rbmLocWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
			 	//echo $psql;exit;
			 	$stmt = sqlsrv_prepare($conn, $psql);
				sqlsrv_execute($stmt);
				
				while($prow = sqlsrv_fetch_array($stmt)){
				   //p($prow,'e');
					$regid = $prow['REGIONNAME'];
				   $rbecountarr[] = array("name"=>$regid,"y"=>$prow['evtcount'],"drilldown"=>$regid);
				    $psql1 = "EXEC tmLocWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$prow['REGIONID']."',@tmcode='".@$data['tmlocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
				    //echo $psql1;exit;
				    $stmt1 = sqlsrv_prepare($conn, $psql1);
					sqlsrv_execute($stmt1);
					$tmcountarr = array();
					while($prow1 = sqlsrv_fetch_array($stmt1)){
						$tmid = $prow1['TMNAME'];
						$tmcountarr[] = array("name"=>$tmid,"y"=>$prow1['evtcount'],"drilldown"=>$tmid);
						$alltmcountarr[] =  array("name"=>$tmid,"y"=>$prow1['evtcount'],"drilldown"=>$tmid);
						$psql2 = "EXEC pohqWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$prow['REGIONID']."',@tmcode='".@$prow1['TMID']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
						//echo $psql2;exit;
						$stmt2 = sqlsrv_prepare($conn, $psql2);
						sqlsrv_execute($stmt2);
						$pocountarr = array();
						while($prow2 = sqlsrv_fetch_array($stmt2)){
							$pocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
							$allpocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
						}
						$tmdrilldata[$tmid] = $pocountarr;

					}

					$rbmdrilldata[$regid] = $tmcountarr;
				}

				if( $data['rbmLocation']=="All" && $data['tmlocation']=="All" && $data['polocation']=="All"){
					$returnarr['series1'] = $rbecountarr;
					$returnarr['series2'] = $rbmdrilldata;
					$returnarr['series3'] = $tmdrilldata;
					$returnarr['locseriesfor'] = array('series1'=>'RBM','series2'=>'TM','series3'=>'PO');
				}else if($data['tmlocation']=="All"&&($data['rbmLocation']=="All" || $data['rbmLocation']!="All") && $data['polocation']=="All"){
					$returnarr['series1'] = $alltmcountarr;
					$returnarr['series2'] = $tmdrilldata;
					$returnarr['locseriesfor'] = array('series1'=>'TM','series2'=>'PO');
				}else if(($data['tmlocation']=="All" || $data['tmlocation']!="All") && ($data['polocation']=="All" ||  $data['polocation']!="All")){
					$returnarr['series1'] = $allpocountarr;
					$returnarr['locseriesfor'] = array('series1'=>'PO');
				}
		}

		if($_SESSION['Dcode']=='RBM'){

			$psql1 = "EXEC tmLocWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$_POST['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@product='".$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";

			 //echo $psql1;exit;
		    $stmt1 = sqlsrv_prepare($conn, $psql1);
			sqlsrv_execute($stmt1);
			$tmcountarr = array();
			while($prow1 = sqlsrv_fetch_array($stmt1)){
				$tmid = $prow1['TMNAME'];
				$tmcountarr[] = array("name"=>$tmid,"y"=>$prow1['evtcount'],"drilldown"=>$tmid);
				$psql2 = "EXEC pohqWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$prow1['TMID']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".$data['activity']."',@subactivity='".@$data['subactivity']."'";
						//echo $psql2;exit;
						$stmt2 = sqlsrv_prepare($conn, $psql2);
						sqlsrv_execute($stmt2);
						$pocountarr = array();
						while($prow2 = sqlsrv_fetch_array($stmt2)){
							$pocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
							$allpocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
						}
						$tmdrilldata[$tmid] = $pocountarr;
			}

			if($data['tmlocation']=="All" && $data['polocation']=="All"){
				$returnarr['series1'] = $tmcountarr;
				$returnarr['series2'] = $tmdrilldata;
				$returnarr['locseriesfor'] = array('series1'=>'TM','series2'=>'PO');
			}else{
				$returnarr['series1'] = $allpocountarr;
				$returnarr['locseriesfor'] = array('series1'=>'PO');
			}
			
		}

		if($_SESSION['Dcode']=='TM'){
			$psql2 = "EXEC pohqWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
						//echo $psql2;exit;
						$stmt2 = sqlsrv_prepare($conn, $psql2);
						sqlsrv_execute($stmt2);
						$pocountarr = array();
						while($prow2 = sqlsrv_fetch_array($stmt2)){
							$pocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
							$allpocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
						}
				$returnarr['series1'] = $allpocountarr;
				$returnarr['locseriesfor'] = array('series1'=>'PO');
		}

		if($_SESSION['Dcode']=='PO'){
			$psql2 = "EXEC pohqWiseEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
						//echo $psql2;exit;
						$stmt2 = sqlsrv_prepare($conn, $psql2);
						sqlsrv_execute($stmt2);
						$pocountarr = array();
						while($prow2 = sqlsrv_fetch_array($stmt2)){
							$pocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
							$allpocountarr[] = array('name'=>$prow2['POHQNAME'],'y'=>$prow2['evtcount']);
						}
				$returnarr['series1'] = $allpocountarr;
				$returnarr['locseriesfor'] = array('series1'=>'PO');
		}



	 //p($returnarr,'e');
 return $returnarr;

}
//PRODUCTwISE CHART GENERATION
function ProductWiseChart($data){

 global $conn;
 $returnarr = $prodwisearr = $productdrilldown =  $allhybridcountarr =array();

 $psql = "EXEC ProductWiseEvtChart @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
 //echo  $psql;exit;
	 $stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);
	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$product = $prow['CROPNAME'];
		$prodwisearr[] = array('name'=>$product,'y'=>$prow['pcount'],'drilldown'=>$product);
		$psql1 = "EXEC HybridWiseEvtChart @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".$product."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".$data['activity']."',@subactivity='".@$data['subactivity']."'";
		//echo $psql1;exit;
		$stmt1 = sqlsrv_prepare($conn, $psql1);
		sqlsrv_execute($stmt1);
		$hybridcountarr = array();
		while($prow1 = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
			$hybridcountarr[] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['COUNT']);
			$allhybridcountarr[] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['COUNT']);
		}
		$productdrilldown[$product] = $hybridcountarr;
	}

	if($data['product']=='All' && (@$data['hybrid']=='All' || @$data['hybrid']=="")){
		$returnarr['series1'] = $prodwisearr;
		$returnarr['series2'] = $productdrilldown;
		$returnarr['pdseriesfor'] = array('series1'=>'PRODUCT','series2'=>'HYBRID');
	}else{
		$returnarr['series1'] = $allhybridcountarr;
		$returnarr['pdseriesfor'] = array('series1'=>'HYBRID');
	}
	
	//p($returnarr,'e');
	return $returnarr;

}

function ActivityWisesChart($data){
 global $conn;
 $returnarr = $activitywisearr = $activitydrilldown = $allactivitycountarr = array();

 $psql = "EXEC ActivityWiseEvtChart @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
 //echo $psql;exit;
	 $stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);
	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$activity = $prow['ACTIVITYTYPE'];
		$activitywisearr[] = array('name'=>$activity,'y'=>$prow['COUNT'],'drilldown'=>$activity);
		$psql1 = "EXEC SubActivityWiseEvtChart @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$activity."',@subactivity='".@$data['subactivity']."'";
		//echo $psql1;exit;
		$stmt1 = sqlsrv_prepare($conn, $psql1);
		sqlsrv_execute($stmt1);
		$countarr = array();
		while($prow1 = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
			$countarr[] = array("name"=>$prow1['ACTIVITYNAME'],'y'=>$prow1['COUNT']);
			$allactivitycountarr[] = array("name"=>$prow1['ACTIVITYNAME'],'y'=>$prow1['COUNT']);
		}
		$activitydrilldown[$activity] = $countarr;
	}

	if($data['activity']=='All' && (@$data['subactivity']=='All' || @$data['subactivity']=="")){
		$returnarr['series1'] = $activitywisearr;
		$returnarr['series2'] = $activitydrilldown;
		$returnarr['actseriesfor'] = array('series1'=>'ACTIVITY','series2'=>'SUB-ACTIVITY');
	}else{
		$returnarr['series1'] = $allactivitycountarr;
		$returnarr['actseriesfor'] = array('series1'=>'SUB-ACTIVITY');
	}
	
	//p($returnarr,'e');
	return $returnarr;

 
 return $returnarr;

}

function TrendChart($data){
	global $conn;
	 $returnarr = $trenddata = array();
	$psql = "EXEC TrendChartEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$_POST['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
	 $stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);
	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$time = strtotime($prow['DATE']->format('Y-m-d H:i:s'))*1000;
		
		$trenddata[] = array($time,$prow['COUNT']);
	}
	 $returnarr['tdata'] = $trenddata;
	 return $returnarr;
}

?>

