<?php
include '../auto_load.php';

if(isset($_POST['Action'])){
	$Action = $_POST['Action'];

if($Action=='GetFilterOpt'){	
	if(!isset($_POST['subact'])){		
			$poLocCode =  $poLocName = $products = $activity =  $croparr =  array(); 
			$getpodet = $getpodet1 = $gettmdet = $getrbmdet = $getzmdet ='no';

			if($_SESSION['Dcode']=='PO'){
				$pocode = $_SESSION['EmpID'];
				$getpodet1 = 'yes';
			}

			if($_SESSION['Dcode']=='TM'){
				$tmcode = $_SESSION['EmpID'];
				$gettmdet = 'yes';
				$getpodet = 'yes';
			}

			if($_SESSION['Dcode']=='RBM'){
				$rbmcode = $_SESSION['EmpID'];
				$getrbmdet ='yes';
				$gettmdet = 'yes';
				$getpodet = 'yes';
			}

			if($_SESSION['Dcode']=='ZM'){
				$zmcode = $_SESSION['EmpID'];
				$getpodet = 'yes';
				$gettmdet = 'yes';
				$getrbmdet ='yes';
				$getzmdet='yes';
			}

			if($_SESSION['Dcode']=='ADMIN'){
				$zmcode = 'All';
				$getzmdet='yes';
				$getrbmdet ='yes';
				$gettmdet = 'yes';
				$getpodet = 'yes';
			}

			if($_SESSION['Dcode']=='GM'){
				$zmcode = 'All';
				$getzmdet='yes';
				$getrbmdet ='yes';
				$gettmdet = 'yes';
				$getpodet = 'yes';
			}

			if($getzmdet=='yes'){
				$zres = array();
				$sql ="SELECT Division FROM  ".$costcentrtbl." ";
				$cond = "";
				$addand = "";
				if($_POST['dataAreaId']!='All'){
					$cond .= " BusinessDivision='".$_POST['dataAreaId']."' ";
					$addand = " AND ";
				}

				if($cond!=''){
					$sql .= " WHERE ".$cond." ";
				} 

				$sql .= " GROUP BY Division ORDER BY Division";

				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
				$row_count = sqlsrv_num_rows($res1);

				if($row_count>0){
					if($row_count>1){
						$zres[] = array('ZoneId'=>'All','ZoneName'=>'All');
					}
					while($row = sqlsrv_fetch_array($res1)){ 		 			
						$zres[] = array('ZoneId'=>$row['Division'],'ZoneName'=>$row['Division']);
					}

					$vc_array_name = sortbyval($zres,'ZoneName');
					array_multisort($vc_array_name, SORT_ASC, $zres);
					$result['zoneDet'] = $zres;
				}
			}

			if($getrbmdet=='yes'){

				if(isset($result['zoneDet'])){
					$rres = array();
					//$regidarr = array();
					$ridarr = array();
					$i=1;

					foreach ($result['zoneDet'] as  $zdata) {

					$sql = "SELECT REGION FROM  ".$costcentrtbl."  ";
					$cond = ""; 
					$addand = "";
					if($_POST['dataAreaId']!='All'){
						$cond .= " BusinessDivision='".$_POST['BusinessDivision']."' ";
						$addand = " AND ";
					}

					if($zdata['ZoneId']!="All"){
						$cond .= " ".$addand." Division='".$zdata['ZoneId']."' ";
					
						if($cond!="")
							$sql .= " WHERE ".$cond." ";
						$sql .= "  GROUP BY REGION ORDER BY REGION";
						//echo $zdata['ZoneId'];echo "<br>";
						$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						@$row_count = sqlsrv_num_rows($res1);
						if($row_count>0){
							if($i==1){
								$i++;
							}				
					 		while($row = sqlsrv_fetch_array($res1,SQLSRV_FETCH_ASSOC)){ 
					 			$rid = $row['REGION'];
								if(!in_array($row['REGION'], $ridarr)){
			 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row['REGION'],'Zone'=>$zdata['ZoneId']);
			 						$ridarr[] = $rid;
								}
					 		}
						 	
						}				
					}
				}

				$rresname = sortbyval($rres,'RegionName');
		 		array_multisort($rresname,SORT_ASC,SORT_STRING,$rres);
		 		array_unshift($rres, array('RegionId'=>'All','RegionName'=>'All',"Zone"=>""));
			
				}else{
					
				}

				$result['regionDet'] = @$rres;
			}

			if($gettmdet=='yes'){
				$rbmids = array();
				$tmDet = array();
				if(isset($result['regionDet'])){
					$rbmids = $result['regionDet'];
					
				}else if(isset($rbmcode)){
					
					$sql ="SELECT * FROM  ".$regtbl."  where RBMID='".$rbmcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME  ";

					$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
					$row_count = sqlsrv_num_rows($res1);
					if($row_count>0){
						$RBMres[] = array('RegionId'=>"All",'RegionName'=>"All");
					}
					$RBMres = array();
					if($row_count>0){
					 		while($row = sqlsrv_fetch_array($res1)){ 		 			
					 			 $RBMres[] = array('RegionId'=>$row['REGIONID'],'RegionName'=>$row['REGIONNAME']);
					 		}

					 	$result['regionDet'] = $RBMres;
					}
					$rbmids = $RBMres;
				}
				
				if(isset($result['regionDet']) || isset($rbmcode) ){
					$tmidarr = array();
					$rbmids1 = array();
					foreach ($rbmids as  $rbdata) {
						if($rbdata['RegionId']!="All")
						$rbmids1[] = "'".$rbdata['RegionId']."'";
					}
					$rbmids1 = implode(",",$rbmids1);
						
						$sql ="SELECT Territory FROM  ".$costcentrtbl." ";
						$cond = '';
						$addand = '';
						if($_POST['dataAreaId']!='All'){
							$cond .= " BusinessDivision='".$_POST['dataAreaId']."' ";
							$addand = " AND ";
						}
							if($cond!=''){
								$cond.=" AND ";
							}

						$sql .=" WHERE ".$cond." REGION IN (".$rbmids1.") GROUP BY Territory ORDER BY Territory";

						//echo $sql;exit;
						$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						$row_count = sqlsrv_num_rows($res1);
						if($row_count>0){
					 		while($row = sqlsrv_fetch_array($res1)){ 		
					 			if(!in_array($row['Territory'], $tmidarr)){
					 				$tmDet[] = array('Territory'=>$row['Territory'],'TMName'=>$row['Territory'],'Region'=>$rbdata['RegionId']);	
					 				$tmidarr[] = $row['Territory'];
					 			} 			
					 		}
						}

					if(count(@$tmDet)>0){
						$tmDetname = sortbyval($tmDet,'TMName');
			 		array_multisort($tmDetname,SORT_ASC,SORT_STRING,$tmDet);
			 		array_unshift($tmDet, array('TMID'=>'All','TMName'=>'All','Region'=>'All'));
					}
				}else{

					$sql ="SELECT * FROM  ".$tmtbl."  where EMPLID='".@$tmcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY TMNAME  ";
				 		$resr = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				 			
				 	$row_countr = sqlsrv_num_rows($resr);

				 	if($row_countr>1){
				 		$tmDet[] =array('TMID'=>"All",'TMName'=>"All");
				 	}
						if($row_countr>0){
							while($row1 = sqlsrv_fetch_array($resr)){ 
		 						$tmDet[] = array('TMID'=>$row1['TMID'],'TMName'=>$row1['TMNAME']);
							}
						}
							
				}
				$result['tmDet'] = $tmDet;
			}
			$sql ="SELECT CostElementGroup FROM  ".$costelemtbl."   GROUP BY CostElementGroup ";
	 		 	//echo $sql;exit;
		 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			 $row_count = sqlsrv_num_rows($res);
			 $CostElementGroup[] = 'All';
			 $CostElementName[] = 'All';
			 $activity[] = 'All';
		 	if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res)){ 	
			 		if(!in_array($row['CostElementGroup'], $croparr)){
			 			$CostElementGroup[] = $row['CostElementGroup'];
			 			//$croparr[] = $row['CROP'];
			 		}		
		 		}
			}

			$sql ="SELECT CostElementName FROM  ".$costelemtbl."  ";
	 		 	//echo $sql;exit;
		 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			 $row_count = sqlsrv_num_rows($res);
		 	if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res)){ 	
			 		if(!in_array($row['CostElementName'], $croparr)){
			 			$CostElementName[] = $row['CostElementName'];
			 			//$croparr[] = $row['CROP'];
			 		}		
		 		}
			}



		$result['CostElementGroup'] = $CostElementGroup;
		$result['CostElementName'] = $CostElementName;

	}else{

	}
}elseif($Action=='GET_RBM'){
		//p($_POST,'e');
		$sql ="SELECT REGION FROM  ".$costcentrtbl." ";

		$cond = "";
		$addand = " ";
		if($_POST['dataAreaId']!='All'){
			$cond .=" BusinessDivision='".$_POST['dataAreaId']."' ";
			$addand = " AND ";
		}

		$zmcode = explode(",",$_POST['ZMLOC']);
		$zmcode = implode("','",$zmcode);

		$cond .= " ".$addand." Division IN('".$zmcode."') ";
		$sql .= " WHERE ".$cond."  GROUP BY REGION ORDER BY REGION";
			//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				$ridarr = array();
				if($row_count>0){
					if($row_count>1){
						$rres[] = array('RegionId'=>'All','RegionName'=>'All');	
					}
					
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGION'];
 							if(!in_array($row['REGION'], $ridarr)){
		 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row['REGION']);
		 						$ridarr[] = $rid;
	 						}
			 		}

				}
				$tmidarr  = $tmidarr = array();
				foreach ($ridarr as  $rbdata) {
					$rbmids1[] = "'".$rbdata."'";
				}
			$rbmids1 = implode(",",$rbmids1);
				
				$sql ="SELECT Territory FROM  ".$costcentrtbl." ";
				$cond = "";
				$addand = " ";
				if($_POST['dataAreaId']!='All'){
					$cond .=" BusinessDivision='".$_POST['dataAreaId']."' ";
					$addand = " AND ";
				}

				if($cond!=""){
					$cond .=" AND ";
				}
			

				$sql .=" WHERE ".$cond." Division IN('".$zmcode."') AND REGION IN (".$rbmids1.") GROUP BY Territory ORDER BY Territory";

				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		
			 			if(!in_array($row['Territory'], $tmidarr)){
			 				$tmDet[] = array('TMID'=>$row['Territory'],'TMName'=>$row['Territory']);	
			 				$tmidarr[] = $row['Territory'];
			 			} 			
			 		}
				}

			if(count(@$tmDet)>0){
				$tmDetname = sortbyval($tmDet,'TMName');
		 		array_multisort($tmDetname,SORT_ASC,SORT_STRING,$tmDet);
		 		array_unshift($tmDet, array('TMID'=>'All','TMName'=>'All'));
			}
			
		$result['regionDet'] = $rres;
		$result['tmDet'] = $tmDet;
		
}elseif($Action=='GET_TM'){
		//p($_POST,'e');
		$sql ="SELECT * FROM  ".$TRZMapping."  where  dataAreaId='".$_POST['dataAreaId']."'  ";
			
			if($_POST['lcode']!="All"){
				 $sql .= " AND REGIONID='".$_POST['lcode']."' ";
			}

				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				$ridarr = array();
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGIONID']	;
		 				if(!in_array($rid, $ridarr)){
		 					$ridarr[] = $rid;		 					
		 				}
			 		}
				}
				$tmidarr  = $tmidarr = array();
				foreach ($ridarr as  $rbdata) {
					$rbmids1[] = "'".$rbdata."'";
				}
				$rbmids1 = implode(",",$rbmids1);
				
				$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID IN (".$rbmids1.") AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY TMNAME ";
				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		
			 			if(!in_array($row['TMID'], $tmidarr)){
			 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$row['REGIONID']);	
			 				$tmidarr[] = $row['TMID'];
			 			} 			
			 		}
				}

			if(count(@$tmDet)>0){
				$tmDetname = sortbyval($tmDet,'TMName');
	 		array_multisort($tmDetname,SORT_ASC,SORT_STRING,$tmDet);
	 		array_unshift($tmDet, array('TMID'=>'All','TMName'=>'All','Region'=>'All'));
			}

			foreach ($tmidarr as  $tmdata) {
					$tmidarr1[] = "'".$tmdata."'";
			}

				$tmidarr1 = implode(",",$tmidarr1);

			$sql ="SELECT * FROM  ".$pohqtbl."  where dataAreaId='".$_POST['dataAreaId']."' AND TMID IN (".$tmidarr1.")  ORDER BY POHQNAME  ";
			
		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		$poDet = array();
		if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res1)){ 		 			
		 			 $poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME']);	
		 		}

		 		if(count(@$poDet)>0){
				$poDetname = sortbyval($poDet,'POHQNAME');
	 		array_multisort($poDetname,SORT_ASC,SORT_STRING,$poDet);
	 		array_unshift($poDet, array('POHQCODE'=>'All','POHQNAME'=>'All'));
			}

		 	$result['poDet'] = $poDet;
		}
			

		$result['tmDet'] = $tmDet;
	

}elseif($Action=='getExpElement'){
		$sql ="SELECT * FROM ".$costelemtbl."   ";

		if($_POST['expgroup']!='All'){
			$costeg = $_POST['expgroup'];
				$sql .=" WHERE CostElementGroup='".$_POST['expgroup']."' ";		
		}
		
		$expg = array();
		$expelem = array();
		$expelem["All"] = "All";
			//echo $sql;exit;
		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		$cearr = array();
		if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res1)){ 
		 			$cecode = $row['CostElement'];
		 			$cename = $row['CostElementName'];
		 			if(!array_key_exists($cename, $expelem)){
		 				$expelem[$cename] = $cecode;
		 			}else{
		 				$expelem[$cename] = $expelem[$cename].",".$cecode;
		 			}
		 			
		 		}
		 }

		 $expg[] = $expelem;
		 $result = $expg;
	}
}else{
	$result = array('status'=>'failed','msg'=>'action missing');
}

echo json_encode($result);