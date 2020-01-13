<?php
	

function LocationWiseChart($data){

 global $eventtbl;
 global $TRZMapping ;
 global $pohqtbl ;
 global $conn;
 $returnarr = array();

 if($_SESSION['Dcode']=='ZM'){
 	$sql = "SELECT * FROM ".$eventtbl." WHERE CAST(CREATIONDATE AS date) BETWEEN '".$data['fromdate']."' and '".$data['todate']."' AND  dataAreaId='".$data['pdivision']."' ";

 		if(isset($data['activity'])){
			if($data['activity']!='All'){
				$sql .= " AND ACTIVITYTYPE='".$data['activity']."' ";	
			}
		}


	 	if(isset($data['product'])){
			if($data['product']!='All'){
				$sql .= " AND CROPNAME='".$data['product']."' ";	
			}
		}


		if(isset($data['zmLocation'])){
			$sql .= " AND ZONEID='".$data['zmLocation']."' ";
		}

		$regionidarr = array();
		if(isset($data['rbmLocation'])){
			if($data['rbmLocation']!='All'){
				$regionidarr[] = $data['rbmLocation'];
				//$sql .= " AND REGIONID='".$data['rbmLocation']."' ";
			}else{
				$regionidarr = explode(",",$_POST['rbmall_code']);
			}
		}

		$tmidarr = array();
		if(isset($data['tmlocation'])){
				if($data['tmlocation']!='All'){
					$tmidarr[] = $data['tmlocation'];
				}else{
					$tmidarr = explode(",",$_POST['tmall_code']);
				}
			}

			if(isset($data['polocation'])){
				if($data['polocation']!='All'){
					$sql .= " AND POHQCODE='".$data['polocation']."' ";	
				}
				
			}

		//echo $sql;exit;
		$rbecountarr = array();
		$rbmdrilldata = array();
		$tmdrilldata = array();

		if(isset($data['rbmLocation'])){
			if($data['rbmLocation']=='All' && $data['tmlocation']=='All' && $data['tmlocation'] && $data['polocation']=='All'){
				$sql1 = $sql;
				foreach ($regionidarr as $regid) {
				$sql2 = $sql1;
				$sql2 .= " AND REGIONID='".$regid."' ";

				$res = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res);
				$rbecountarr[] = array("name"=>$regid,"y"=>$row_count,"drilldown"=>$regid);

				$mapsql ="SELECT * FROM  ".$TRZMapping."  where REGIONID='".$regid."' AND dataAreaId='".$data['pdivision']."'  ";
					$mapres1 = sqlsrv_query($conn,$mapsql,array(), array( "Scrollable" => 'static' ));
					$mrow_count = sqlsrv_num_rows($mapres1);
					$tmcountarr = array();
					if($mrow_count>0){
				 		while($row = sqlsrv_fetch_array($mapres1)){ 
				 		$sql3 = $sql2;
				 		$ctmid = $row['TMID'];
				 		$sql3 .=" AND TMID='".$ctmid."' ";
				 		$TMres = sqlsrv_query($conn,$sql3,array(), array( "Scrollable" => 'static' ));
						$TMrow_count = sqlsrv_num_rows($TMres);
						$tmcountarr[] = array("name"=>$ctmid,"y"=>$TMrow_count,"drilldown"=>$ctmid);

						$sql4 = $sql3;
						$posql ="SELECT * FROM  ".$pohqtbl."  where TMID='".$ctmid."' AND dataAreaId='".$data['pdivision']."'  ";
						$pores1 = sqlsrv_query($conn,$posql,array(), array( "Scrollable" => 'static' ));
						$porow_count = sqlsrv_num_rows($pores1);
						$pocountarr = array();
						if($porow_count>0){
						 		while($porow = sqlsrv_fetch_array($pores1)){ 
						 			$sql5 = $sql4;
						 			$sql5 .= " AND  POHQCODE='".$porow['POHQCODE']."'";
						 			
						 			$pores2 = sqlsrv_query($conn,$sql5,array(), array( "Scrollable" => 'static' ));
									$poerow_count = sqlsrv_num_rows($pores2);

						 			$pocountarr[] = array('name'=>$porow['POHQCODE'],'y'=>$poerow_count);
						 		}
							}

							$tmdrilldata[$ctmid] = $pocountarr;		 			
				 		}
					}

				$rbmdrilldata[$regid] = $tmcountarr;
			}



			$returnarr['series1'] = $rbecountarr;
			$returnarr['series2'] = $rbmdrilldata;
			$returnarr['series3'] = $tmdrilldata;
		}

	    }
	}
		
	  //p($returnarr,'e');
	  return $returnarr;

}
//PRODUCTwISE CHART GENERATION
function ProductWiseChart($data){

 global $eventtbl;
 global $TRZMapping ;
 global $pohqtbl ;
 global $conn;
 $returnarr = array();

 if($_SESSION['Dcode']=='ZM'){
 		$sql = "SELECT CROPNAME FROM ".$eventtbl." WHERE CAST(CREATIONDATE AS date) BETWEEN '".$data['fromdate']."' and '".$data['todate']."' AND  dataAreaId='".$data['pdivision']."' ";

		if(isset($data['zmLocation'])){
			$sql .= " AND ZONEID='".$data['zmLocation']."' ";
		}
		$regionidarr=array();
		if(isset($data['rbmLocation'])){
			if($data['rbmLocation']!='All'){
				$regionidarr[] =$data['rbmLocation'];
			}else{
				$regionidarr = explode(",",$_POST['rbmall_code']);
			}

			$sql .=" AND (";
			$sep = "";
			foreach ($regionidarr as $regid) {
				$sql .= $sep." REGIONID='".$regid."' ";
				$sep =" OR ";
			}

			$sql .=" ) ";
		}

		$tmidarr = array();
		if(isset($data['tmlocation'])){
			if($data['tmlocation']!='All'){
				$tmidarr[] = $data['tmlocation'];
			}else{
				$tmidarr = explode(",",$data['tmall_code']);
			}

			$sql .=" AND (";
			$sep = "";
			foreach ($tmidarr as $tmid) {
				$sql .= $sep." TMID='".$tmid."' ";
				$sep =" OR ";
			}

			$sql .=" ) ";

		}

		$poidarr = array();
		if(isset($data['polocation'])){
				if($data['polocation']!='All'){
					$poidarr[] = $data['polocation'];
				}else{
					$poidarr =  explode(",",$data['poall_code']);
				}

				$sql .=" AND (";
				$sep = "";
				foreach ($poidarr as $popid) {
					$sql .= $sep." POHQCODE='".$popid."' ";
					$sep =" OR ";
				}

				$sql .=" ) ";
				
			}

			$actiddarr = array();
		if(isset($data['activity'])){
			if($data['activity']!='All'){
				$actiddarr[] = $data['activity'];
				$sql .= " AND  ACTIVITYTYPE='".$data['activity']."' ";
			}else{

				if($data['actall_code']!=""){
						$actiddarr = explode(",",$data['actall_code']);
						$sql .=" AND (";
						$sep = "";
						foreach ($actiddarr as $actid) {
							$sql .= $sep." ACTIVITYTYPE='".$actid."' ";
							$sep =" OR ";
						}

						$sql .=" ) ";
				}
				
			}

			
		}

		$prodidarr = array();
		if(isset($data['product'])){
			if($data['product']!='All'){
				$prodidarr[] = $data['product'];
			}else{
				$prodidarr = explode(",",$data['prodall_code']);
			}
		}

		$prodwisearr = array();
		foreach ($prodidarr as  $prodcut) {
			$sql1 = $sql; 
			$sql1 .= " AND CROPNAME='".$prodcut."' ";
			$pres1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
			$row_count = sqlsrv_num_rows($pres1);
			$prodwisearr[] = array('name'=>$prodcut,'y'=>$row_count,'drilldown'=>$prodcut);
			
		}

		$returnarr['series1'] = $prodwisearr;
 }
		
 
 return $returnarr;

}

function ActivityWisesData($data){

 global $eventtbl;
 global $TRZMapping ;
 global $pohqtbl ;
 global $conn;
 $returnarr = array();

 if($_SESSION['Dcode']=='ZM'){
 		$sql = "SELECT CROPNAME FROM ".$eventtbl." WHERE CAST(CREATIONDATE AS date) BETWEEN '".$data['fromdate']."' and '".$data['todate']."' AND  dataAreaId='".$data['pdivision']."' ";

		if(isset($data['zmLocation'])){
			$sql .= " AND ZONEID='".$data['zmLocation']."' ";
		}
		$regionidarr=array();
		if(isset($data['rbmLocation'])){
			if($data['rbmLocation']!='All'){
				$regionidarr[] =$data['rbmLocation'];
			}else{
				$regionidarr = explode(",",$_POST['rbmall_code']);
			}

			$sql .=" AND (";
			$sep = "";
			foreach ($regionidarr as $regid) {
				$sql .= $sep." REGIONID='".$regid."' ";
				$sep =" OR ";
			}

			$sql .=" ) ";
		}

		$tmidarr = array();
		if(isset($data['tmlocation'])){
			if($data['tmlocation']!='All'){
				$tmidarr[] = $data['tmlocation'];
			}else{
				$tmidarr = explode(",",$data['tmall_code']);
			}

			$sql .=" AND (";
			$sep = "";
			foreach ($tmidarr as $tmid) {
				$sql .= $sep." TMID='".$tmid."' ";
				$sep =" OR ";
			}

			$sql .=" ) ";

		}

		$poidarr = array();
		if(isset($data['polocation'])){
				if($data['polocation']!='All'){
					$poidarr[] = $data['polocation'];
				}else{
					$poidarr =  explode(",",$data['poall_code']);
				}

				$sql .=" AND (";
				$sep = "";
				foreach ($poidarr as $popid) {
					$sql .= $sep." POHQCODE='".$popid."' ";
					$sep =" OR ";
				}

				$sql .=" ) ";
				
			}

			$prdiddarr = array();
		if(isset($data['product'])){
			if($data['product']!='All'){
				$prdiddarr[] = $data['product'];
				$sql .= " AND CROPNAME='".$data['product']."' ";
			}else{

				if($data['prodall_code']!=""){
						$prdiddarr = explode(",",$data['prodall_code']);
						$sql .=" AND (";
						$sep = "";
						foreach ($prdiddarr as $pid) {
							$sql .= $sep." CROPNAME='".$pid."' ";
							$sep =" OR ";
						}

						$sql .=" ) ";
				}
				
			}

			
		}

		$actiddarr = array();
		if(isset($data['activity'])){
			if($data['activity']!='All'){
				$actiddarr[] = $data['activity'];
			}else{
				$actiddarr = explode(",",$data['actall_code']);
			}
		}

		$activitywisearr = array();
		foreach ($actiddarr as  $actid) {
			$sql1 = $sql; 
			$sql1 .= " AND ACTIVITYTYPE='".$actid."' ";
			$pres1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
			$row_count = sqlsrv_num_rows($pres1);
			$activitywisearr[] = array('name'=>$actid,'y'=>$row_count);
			
		}

		$returnarr['series1'] = $activitywisearr;
 }
		
 
 return $returnarr;

}

function TrenChart($data){
	
}

?>

