<?php
include '../auto_load.php';
//	p($_POST,'e');
if(isset($_POST['Action'])){
	$Action = $_POST['Action'];
	if($_POST['Action']=='Login'){
	$EmpCode=$_POST['emp_id'];
	$password=$_POST['password'];
    $EmpID="";
    $LocationName ="";
    $LocationNamearr = array();
    $LocationCodearr = array();
    $LocationCode = "";
    $Token = '';

    $sql =" SELECT POCODE,POHQNAME,POHQCODE,PONAME FROM  ".$pohqtbl." where POCODE = '$EmpCode' and password='$password' ";

     $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	 $row_count = sqlsrv_num_rows($res);
	 
	  $sql =" SELECT POCODE,POHQNAME,POHQCODE,PONAME FROM  ".$pohqtbl." where POCODE = '$EmpCode' and password='$password' ";

    $sql1 =" SELECT TOP(1) * FROM  ".$BRoleMappingtbl." where Empcode = '$EmpCode' ";
    $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
	$row_count1 = sqlsrv_num_rows($res1);
	$finRights=0;
	if($row_count1>0){
		$finRights=1;
	}
	
 	 $result = array();
 	if($row_count>0){
 		while($row = sqlsrv_fetch_array($res)){	
 			$EmpID = $EmpCode;
			$Dcode = "PO";
			$Name = $row['PONAME'];
 		}


 		$result = array('status'=>'ok','EmpID'=>$EmpID,'Dcode'=>$Dcode,"Name"=>$Name,"finRights"=>$finRights);
 		$_SESSION = $result;
 	}else{

// 		  $sql =" SELECT RECID,TMID,TMNAME,EMPLID FROM  ".$tmtbl."  where EmplId = '$EmpCode' and password='$password' ";
 		  $sql =" SELECT * FROM  ".$emptbl."  where EmplId = '$EmpCode' and password='$password' AND APDESIGN='TM' ";
 		  		
	 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		 @$row_count = sqlsrv_num_rows(@$res);

	 	if(@$row_count>0){
 		while($row = sqlsrv_fetch_array($res)){ 			
 			$EmpID = $EmpCode;
			$Dcode = "TM";
			$PARTYID = $row['PARTYID'];
			$DATAAREAID = $row['DATAAREAID'];
			if($PARTYID!=""){
				$sql =" SELECT * FROM  ".$partytbl." where PARTYID = '$PARTYID' and DATAAREAID='$DATAAREAID' ";
	 		
		 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			 $row_count = sqlsrv_num_rows($res);
			 if($row_count>0){
				 while($row = sqlsrv_fetch_array($res)){ 
				 	$Name =$row['NAME'];
	 				}
				 }
			 }
 		}

 		$result = array('status'=>'ok','EmpID'=>$EmpID,'Dcode'=>$Dcode,"Name"=>$Name,"finRights"=>$finRights);
 		$_SESSION = $result;
 		}else{
	 		 $sql =" SELECT * FROM  ".$emptbl."  where EmplId = '$EmpCode' and password='$password' AND APDESIGN='RBM' ";
	 		  		
	 		  		//echo $sql;exit;
		 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			 $row_count = sqlsrv_num_rows($res);

		 	if($row_count>0){
	 		while($row = sqlsrv_fetch_array($res)){ 			
	 			$EmpID = $EmpCode;
				$Dcode = "RBM";
				$PARTYID = $row['PARTYID'];
	 				$DATAAREAID = $row['DATAAREAID'];
	 				if($PARTYID!=""){
	 					$sql =" SELECT * FROM  ".$partytbl." where PARTYID = '$PARTYID' and DATAAREAID='$DATAAREAID' ";
	 		
				 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					 $row_count = sqlsrv_num_rows($res);
					 if($row_count>0){
						 while($row = sqlsrv_fetch_array($res)){ 
						 	$Name =$row['NAME'];
			 				}
						 }
					 
	 				}else{
	 					$Name ="Admin";
	 				}
	 		}
	 		$result = array('status'=>'ok','EmpID'=>$EmpID,'Dcode'=>$Dcode,"Name"=>$Name,"finRights"=>$finRights);
	 		$_SESSION = $result;
	 	}else{

	 		 $sql =" SELECT * FROM  ".$emptbl."  where EmplId = '$EmpCode' and password='$password' AND( APDESIGN='DBM' OR APDESIGN='ZM') ";
	 		  	
		 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			 $row_count = sqlsrv_num_rows($res);

		 	if($row_count>0){
	 		while($row = sqlsrv_fetch_array($res)){ 			
	 			$EmpID = $EmpCode;
				$Dcode = "ZM";

				$PARTYID = $row['PARTYID'];
	 				$DATAAREAID = $row['DATAAREAID'];
	 				if($PARTYID!=""){
	 					$sql =" SELECT * FROM  ".$partytbl." where PARTYID = '$PARTYID' and DATAAREAID='$DATAAREAID' ";
	 		
				 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					 $row_count = sqlsrv_num_rows($res);
					 if($row_count>0){
						 while($row = sqlsrv_fetch_array($res)){ 
						 	$Name =$row['NAME'];
			 				}
						 }
	 				}else{
	 					$Name ="Admin";
	 				}
	 		}

	 		$result = array('status'=>'ok','EmpID'=>$EmpID,'Dcode'=>$Dcode,"Name"=>$Name,"finRights"=>$finRights);
			$_SESSION = $result;
	 		
	 	}else{

	 		$sql =" SELECT * FROM  ".$emptbl." where EmplId = '$EmpCode' and password='$password' AND APDESIGN='SUPERADMIN' ";
	 		
		 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			 $row_count = sqlsrv_num_rows($res);
			 	//var_dump($row_count );exit;
		 	if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res)){ 			
	 				$PARTYID = $row['PARTYID'];
	 				$DATAAREAID = $row['DATAAREAID'];
	 				if($PARTYID!=""){
	 					$sql =" SELECT * FROM  ".$partytbl." where PARTYID = '$PARTYID' and DATAAREAID='$DATAAREAID' ";
	 		
				 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					 $row_count = sqlsrv_num_rows($res);
					 if($row_count>0){
						 while($row = sqlsrv_fetch_array($res)){ 
						 	$Name =$row['NAME'];
			 				}
						 }
					 
	 				}else{
	 					$Name ="Admin";
	 				}
	 		}
		 		$EmpID = $EmpCode;
				$Dcode = "ADMIN";
				$result = array('status'=>'ok','EmpID'=>$EmpID,'Dcode'=>$Dcode,"Name"=>$Name,"finRights"=>$finRights);
				$_SESSION = $result;
		 	}else{

		 		$sql =" SELECT * FROM  ".$emptbl."  where EmplId = '$EmpCode' and password='$password' AND APDESIGN='GM' ";
	 			//echo $sql;exit;
			 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				 $row_count = sqlsrv_num_rows($res);
				 if($row_count>0){

				 	while($row = sqlsrv_fetch_array($res)){
					 		$PARTYID = $row['PARTYID'];
		 				$DATAAREAID = $row['DATAAREAID'];
		 				if($PARTYID!=""){
		 					$sql =" SELECT * FROM  ".$partytbl." where PARTYID = '$PARTYID' and DATAAREAID='$DATAAREAID' ";
		 		
					 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						 $row_count = sqlsrv_num_rows($res);
						 if($row_count>0){
							 while($row = sqlsrv_fetch_array($res)){ 
							 	$Name =$row['NAME'];
				 				}
							 }
						
						 
		 				}else{
		 					$Name ="Admin";
		 				}
				 	}
			 		$EmpID = $EmpCode;
					$Dcode = "GM";
					$result = array('status'=>'ok','EmpID'=>$EmpID,'Dcode'=>$Dcode,"Name"=>$Name,"finRights"=>$finRights);
					$_SESSION = $result;
		 		}else{
		 			$result = array('status'=>'failed');	
		 		}
		 		
		 	}
	 	}
	 }
 		
 	}
 }
}elseif($Action=='GET_RBM'){
		//p($_POST,'e');
		$sql ="SELECT * FROM  ".$TRZMapping."  where  dataAreaId='".$_POST['dataAreaId']."'  ";

		$zmcode = explode(",",$_POST['ZMLOC']);
		$zmcode = implode("','",$zmcode);
		$sql .= " AND ZoneId IN('".$zmcode."') ";
			
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				$ridarr = array();
				if($row_count>0){
					if($row_count>1){
						$rres[] = array('RegionId'=>'All','RegionName'=>'All');	
					}
					
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGIONID']	;
		 				if(!in_array($rid, $ridarr)){
		 					$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$rid."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 					$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 					$row_countr = sqlsrv_num_rows($resr);
		 					if($row_countr>0){
		 						while($row1 = sqlsrv_fetch_array($resr)){ 
		 							if(!in_array($row1['REGIONID'], $ridarr)){
				 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row1['REGIONNAME'],'Zone'=>$row['ZONEID']);
				 						$ridarr[] = $rid;
			 						}
		 						}
		 					}
		 					
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
			 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME']);	
			 				$tmidarr[] = $row['TMID'];
			 			} 			
			 		}
				}

			if(count(@$tmDet)>0){
				$tmDetname = sortbyval($tmDet,'TMName');
		 		array_multisort($tmDetname,SORT_ASC,SORT_STRING,$tmDet);
		 		array_unshift($tmDet, array('TMID'=>'All','TMName'=>'All'));
			}

			foreach ($tmidarr as  $tmdata) {
					$tmidarr1[] = "'".$tmdata."'";
				}

				$tmidarr1 = implode(",",$tmidarr1);

			$sql ="SELECT * FROM  ".$pohqtbl."  where dataAreaId='".$_POST['dataAreaId']."' AND TMID IN (".$tmidarr1.")  ORDER BY POHQNAME  ";
			
		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		$poDet = array();
		$poDet[] =array('POHQCODE'=>'All','POHQNAME'=>'All');
		if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res1)){ 		 			
		 			 $poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME']);	
		 		}

		}
			
		$result['regionDet'] = $rres;
		$result['tmDet'] = $tmDet;
		$result['poDet'] = $poDet;
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
}elseif($Action=='GET_PO'){
		
			
			if($_POST['lcode']=="All"){
				 
				 $tmidarr = explode(",",$_POST['allcode']);
			}else{
				$tmidarr = array($_POST['lcode']);
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
			
}else if($Action=='getresult'){
	
	parse_str($_POST['filterData'], $data);
	
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

	$data['fromdate'] = date("Y-m-d",strtotime($data['fromdate']));
	$data['todate'] = date("Y-m-d",strtotime($data['todate']));
	 $returnarr = $resultarr = array();
	 $psql = "EXEC GetEvtReport @required='".$data['filter']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
	 //echo $psql;exit;
	 $stmt = sqlsrv_prepare($conn, $psql);
	sqlsrv_execute($stmt);
	 $sno=1;
	 while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {		
	 	$columns = array_keys($prow);
	 	//p($prow,'e');
	 	$resarr = array();
	 	$resarr[] = $sno++;
	 	foreach ($columns as $col) {
	 		$colval = $prow[$col];
	 		if($col=='TRANSDATE'){
	 			$colval = $colval->format('d-m-Y');
	 		}
	 		$resarr[] = utf8_encode($colval);
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

}else if($Action=='GET_HYBIRDS'){
	$hybridsarr = array();
	$hybridsarr[] = "All";
	$sql =" SELECT * FROM  ".$producttbl."  where CROP = '".$_POST['crop']."'  ";
	//echo $sql;exit;
	$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	while($row = sqlsrv_fetch_array($res)){ 			
		$hybridsarr[] = $row['HYBRIDS'];
	}

	$result = $hybridsarr;

}else if($Action=='GET_ACTIVITY'){
	$actarr = array();
	$sql =" SELECT * FROM  ".$atypemaster."   ";
	if($_POST['atype']!='All'){
		$sql .= " where TYPE = '".$_POST['atype']."' ";
	}
	$sql .= " ORDER BY ACTIVITYTYPE";
	$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	while($row = sqlsrv_fetch_array($res)){ 			
		$actarr[] = $row['ACTIVITYTYPE'];
	}

	$result['activity'] = $actarr;

}else if($Action=='GET_SUBACTIVITY'){
	$sactarr = array();
	$sactarr[] = "All";
	$sql =" SELECT * FROM  ".$subatypemaster."  where ACTIVITYTYPE = '".$_POST['activity']."'  ";
	$sql .= " ORDER BY SUBACTIVITY";
	$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	while($row = sqlsrv_fetch_array($res)){ 			
		$sactarr[] = $row['SUBACTIVITY'];
	}

	$result = $sactarr;

}else if($Action=='GetFilterOpt'){
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
		$sql ="SELECT ZONEID,ZONENAME FROM  ".$zmtbl."  where dataAreaId='".$_POST['dataAreaId']."'  ";

		if($_SESSION['Dcode']=='ADMIN' || $_SESSION['Dcode']=='GM'){
			
		}
		
		if($zmcode!='All'){
			 $sql .= " AND DBMID= '".$zmcode."'";
			 //$zres[] = 'All';
		}

		$sql .= " GROUP BY ZONEID,ZONENAME ORDER BY ZONENAME ASC ";

		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		
		if($row_count>0){
			if($row_count>1){
				$zres[] = array('ZoneId'=>'All','ZoneName'=>'All');
			}
		 		while($row = sqlsrv_fetch_array($res1)){ 		 			
		 			 $zres[] = array('ZoneId'=>$row['ZONEID'],'ZoneName'=>$row['ZONENAME']);
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

				$sql ="SELECT REGIONID FROM  ".$TRZMapping."  where  dataAreaId='".$_POST['dataAreaId']."'   ";
				if($zdata['ZoneId']!="All"){
					$sql .= " AND ZoneId='".$zdata['ZoneId']."'  ";
				

				$sql .= " GROUP BY REGIONID ORDER BY  REGIONID ";

				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				
				if($row_count>0){
					if($i==1){
						//$rres[] = array('RegionId'=>'All','RegionName'=>'All','Zone'=>$zdata['ZoneId']);
						$i++;
					}
					
				
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGIONID']	;
		 				if(!in_array($rid, $ridarr)){
		 					$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$rid."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 					$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 					$row_countr = sqlsrv_num_rows($resr);
		 					if($row_countr>0){
		 						while($row1 = sqlsrv_fetch_array($resr)){ 
		 							if(!in_array($row1['REGIONID'], $ridarr)){
				 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row1['REGIONNAME'],'Zone'=>$zdata['ZoneId']);
				 						$ridarr[] = $rid;
			 						}
		 						}
		 					}
		 					
		 				}
			 			 
			 		}
				 	
				}				
			}
			}

			$rresname = sortbyval($rres,'RegionName');
	 		array_multisort($rresname,SORT_ASC,SORT_STRING,$rres);
	 		array_unshift($rres, array('RegionId'=>'All','RegionName'=>'All',"Zone"=>""));
			
			
		}else{
			$sqlr ="SELECT * FROM  ".$regtbl."  where RBMID='".$_SESSION['EmpID']."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 		$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 			
		 	$row_countr = sqlsrv_num_rows($resr);

		 	if($row_countr>1){
		 		$rres[] = array('RegionId'=>"All",'RegionName'=>"All");
		 	}
				if($row_countr>0){
					while($row1 = sqlsrv_fetch_array($resr)){ 
 						$rres[] = array('RegionId'=>$row1['REGIONID'],'RegionName'=>$row1['REGIONNAME']);
					}
				}

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
				
				$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID IN (".$rbmids1.") AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY TMNAME ";
				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		
			 			if(!in_array($row['TMID'], $tmidarr)){
			 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$rbdata['RegionId']);	
			 				$tmidarr[] = $row['TMID'];
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


if($getpodet=='yes'){
	$tmids =array();
	$poDet = array();
		if(isset($result['tmDet'])){
			$tmids = $result['tmDet'];
			
		}else if(isset($tmcode)){

			$sql ="SELECT * FROM  ".$tmtbl."  where EMPLID='".$tmcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY TMNAME  ";
			
			$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
			$row_count = sqlsrv_num_rows($res1);
			$TMres = array();
			if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		 			
			 			 $TMres[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME']);	
			 		}

			 	$result['tmDet'] = $TMres;
			}

			$tmids = $TMres;

		}

		
			$poidarr = array();
				$tmids1= array();
			foreach ($tmids as  $tmdata) {
				if($tmdata['TMID']!="All")
				$tmids1[] = "'".$tmdata['TMID']."'";
			}	

			$tmids1 = implode(",", $tmids1)	;

				$sql ="SELECT * FROM  ".$pohqtbl."  where TMID IN (".$tmids1.") AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY POHQNAME  ";
				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = @sqlsrv_num_rows($res1);
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		
			 			if(!in_array($row['POHQCODE'], $poidarr)){
			 				$poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME'],'TMID'=>$tmdata['TMID']);	
			 				$poidarr[] = $row['POHQCODE'];
			 			} 			
			 		}
				}

			if(count(@$poDet)>0){
				$poDetname = sortbyval($poDet,'POHQNAME');
	 		array_multisort($poDetname,SORT_ASC,SORT_STRING,$poDet);
	 		array_unshift($poDet, array('POHQCODE'=>'All','POHQNAME'=>'All'));
			}
		
		$result['poDet'] = $poDet;
}

if($getpodet1=='yes'){
	$poDet = array();
	$sql ="SELECT * FROM  ".$pohqtbl."  where POCODE='".$pocode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY POHQNAME  ";
			
		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		if($row_count>1){
			 $poDet[] = array('POHQCODE'=>"All",'POHQNAME'=>"All");
		}
		
		if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res1)){ 		 			
		 			 $poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME']);	
		 		}

		 	$result['poDet'] = $poDet;
		}
}
	
	$sql ="SELECT * FROM  ".$producttbl."  where dataAreaId='".$_POST['dataAreaId']."' ORDER BY CROP ";
 		 	
	 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		 $row_count = sqlsrv_num_rows($res);
		 $products[] = 'All';
		 $activity[] = 'All';
	 	if($row_count>0){
	 		while($row = sqlsrv_fetch_array($res)){ 	
		 		if(!in_array($row['CROP'], $croparr)){
		 			$products[] = $row['CROP'];
		 			$croparr[] = $row['CROP'];
		 		}		
	 		}
		}



		$result['products'] = $products;

		/*$sql =" SELECT * FROM  ".$atypemaster."  ORDER BY ACTIVITYTYPE ";
 			
	 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		 $row_count = sqlsrv_num_rows($res);

	 	if($row_count>0){
	 		while($row = sqlsrv_fetch_array($res)){ 	
		 			$activity[] = $row['ACTIVITYTYPE'];
	 		}
		}

		$result['activity'] = $activity;*/

		
	}else{

		if($_POST['Dcode']=='ZM'){

		$sql ="SELECT trzm.REGIONID,trzm.ZONEID FROM  ".$TRZMapping." AS trzm  where trzm.dataAreaId='".$_POST['dataAreaId']."'   ";

		if($_POST['lcode']!='All'){
			$sql .= " AND trzm.ZoneId='".$_POST['lcode']."'";
		}

		
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				$ridarr = array();
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGIONID']	;
		 				if(!in_array($rid, $ridarr)){
		 					$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$rid."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 					$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 					$row_countr = sqlsrv_num_rows($resr);
		 					if($row_countr>0){
		 						while($row1 = sqlsrv_fetch_array($resr)){ 
		 							if(!in_array($row1['REGIONID'], $ridarr)){
				 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row1['REGIONNAME'],'Zone'=>$row['ZONEID']);
				 						$ridarr[] = $rid;
			 						}
		 						}
		 					}
		 					
		 				}
			 			 
			 		}

				 	$rresname = sortbyval($rres,'RegionName');
			 		array_multisort($rresname,SORT_ASC,SORT_STRING,$rres);
			 		array_unshift($rres, array('RegionId'=>'All','RegionName'=>'All'));
				}

				$result['regionDet'] = $rres;

		}		
		if($_POST['Dcode']=='RBM'){
			$tmidarr = array();
			$tmDet = array();
			//$tmDet[] = array('TMID'=>'All','TMName'=>'All','Region'=>'All');
			$rblcode = $_POST['lcode'];
			if($rblcode=="All"){
				if(isset($_POST['all_code'])){
						$allregcode = explode(",", $_POST['all_code']);
					foreach ($allregcode as  $RegionId) {
						$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID='".$RegionId."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  TMNAME";
						$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						$row_count = sqlsrv_num_rows($res1);
						if($row_count>0){
					 		while($row = sqlsrv_fetch_array($res1)){ 		
					 			if(!in_array($row['TMID'], $tmidarr)){
					 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$RegionId);	
					 				$tmidarr[] = $row['TMID'];
					 			} 			
					 		}
						}
					}					
			}
		}else{

			$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID='".$rblcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  TMNAME  ";
						$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						$row_count = sqlsrv_num_rows($res1);
						if($row_count>0){
					 		while($row = sqlsrv_fetch_array($res1)){ 		
					 			if(!in_array($row['TMID'], $tmidarr)){
					 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$rblcode);	
					 				$tmidarr[] = $row['TMID'];
					 			} 			
					 		}
						}

		}

				$tmDetname = sortbyval($tmDet,'TMName');
	 		array_multisort($tmDetname,SORT_ASC,SORT_STRING,$tmDet);
	 		array_unshift($tmDet, array('TMID'=>'All','TMName'=>'All','Region'=>'All'));

			$result['tmDet'] = $tmDet;

		}

		if($_POST['Dcode']=='TM'){
			$poidarr = array();
			$poDet = array();
			//$poDet[] = array('POHQCODE'=>'All','POHQNAME'=>'All');
			$tmlcode = $_POST['lcode'];
			if($tmlcode=='All'){
				$alltmcode = explode(",", $_POST['all_code']);
				foreach ($alltmcode as  $TMID) {
					$sql ="SELECT * FROM  ".$pohqtbl."  where TMID='".$TMID."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  POHQNAME  ";
					
					$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					$row_count = sqlsrv_num_rows($res1);
					if($row_count>0){
				 		while($row = sqlsrv_fetch_array($res1)){ 		
				 			if(!in_array($row['POHQCODE'], $poidarr)){
				 				$poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME'],'TMID'=>$TMID);	
				 				$poidarr[] = $row['POHQCODE'];
				 			} 			
				 		}
					}
				}
			}else{
				$sql ="SELECT * FROM  ".$pohqtbl."  where TMID='".$tmlcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  POHQNAME  ";
					$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					$row_count = sqlsrv_num_rows($res1);
					if($row_count>0){
				 		while($row = sqlsrv_fetch_array($res1)){ 		
				 			if(!in_array($row['POHQCODE'], $poidarr)){
				 				$poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME'],'TMID'=>$tmlcode);	
				 				$poidarr[] = $row['POHQCODE'];
				 			} 			
				 		}
					}
			}

								$poDetname = sortbyval($poDet,'POHQNAME');
	 		array_multisort($poDetname,SORT_ASC,SORT_STRING,$poDet);
	 		array_unshift($poDet, array('POHQCODE'=>'All','POHQNAME'=>'All'));

			$result['poDet'] = $poDet;
		}
	}
}else if($Action=='GetFilterOptPDTrail'){
			//p($_POST,'e');
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
		$sql ="SELECT ZONEID,ZONENAME FROM  ".$zmtbl."  where dataAreaId='".$_POST['dataAreaId']."'  ";

		if($_SESSION['Dcode']=='ADMIN' || $_SESSION['Dcode']=='GM'){
			
		}
		
		if($zmcode!='All'){
			 $sql .= " AND DBMID= '".$zmcode."'";
			 //$zres[] = 'All';
		}

		$sql .= " GROUP BY ZONEID,ZONENAME ORDER BY ZONENAME ASC ";

		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		
		if($row_count>0){
			if($row_count>1){
				$zres[] = array('ZoneId'=>'All','ZoneName'=>'All');
			}
		 		while($row = sqlsrv_fetch_array($res1)){ 		 			
		 			 $zres[] = array('ZoneId'=>$row['ZONEID'],'ZoneName'=>$row['ZONENAME']);
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

				$sql ="SELECT REGIONID FROM  ".$TRZMapping."  where  dataAreaId='".$_POST['dataAreaId']."'   ";
				if($zdata['ZoneId']!="All"){
					$sql .= " AND ZoneId='".$zdata['ZoneId']."'  ";
				

				$sql .= " GROUP BY REGIONID ORDER BY  REGIONID ";

				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				
				if($row_count>0){
					if($i==1){
						$i++;
					}
					
				
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGIONID']	;
		 				if(!in_array($rid, $ridarr)){
		 					$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$rid."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 					$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 					$row_countr = sqlsrv_num_rows($resr);
		 					if($row_countr>0){
		 						while($row1 = sqlsrv_fetch_array($resr)){ 
		 							if(!in_array($row1['REGIONID'], $ridarr)){
				 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row1['REGIONNAME'],'Zone'=>$zdata['ZoneId']);
				 						$ridarr[] = $rid;
			 						}
		 						}
		 					}
		 					
		 				}
			 			 
			 		}
				 	
				}				
			}
			}

			$rresname = sortbyval($rres,'RegionName');
	 		array_multisort($rresname,SORT_ASC,SORT_STRING,$rres);
	 		array_unshift($rres, array('RegionId'=>'All','RegionName'=>'All',"Zone"=>""));
			
			
		}else{
			$sqlr ="SELECT * FROM  ".$regtbl."  where RBMID='".$_SESSION['EmpID']."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 		$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 			
		 	$row_countr = sqlsrv_num_rows($resr);

		 	if($row_countr>1){
		 		$rres[] = array('RegionId'=>"All",'RegionName'=>"All");
		 	}
				if($row_countr>0){
					while($row1 = sqlsrv_fetch_array($resr)){ 
 						$rres[] = array('RegionId'=>$row1['REGIONID'],'RegionName'=>$row1['REGIONNAME']);
					}
				}

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
				
				$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID IN (".$rbmids1.") AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY TMNAME ";
				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		
			 			if(!in_array($row['TMID'], $tmidarr)){
			 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$rbdata['RegionId']);	
			 				$tmidarr[] = $row['TMID'];
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


if($getpodet=='yes'){
	$tmids =array();
	$poDet = array();
		if(isset($result['tmDet'])){
			$tmids = $result['tmDet'];
			
		}else if(isset($tmcode)){

			$sql ="SELECT * FROM  ".$tmtbl."  where EMPLID='".$tmcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY TMNAME  ";
			
			$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
			$row_count = sqlsrv_num_rows($res1);
			$TMres = array();
			if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		 			
			 			 $TMres[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME']);	
			 		}

			 	$result['tmDet'] = $TMres;
			}

			$tmids = $TMres;

		}

		
			$poidarr = array();
				$tmids1= array();
			foreach ($tmids as  $tmdata) {
				if($tmdata['TMID']!="All")
				$tmids1[] = "'".$tmdata['TMID']."'";
			}	

			$tmids1 = implode(",", $tmids1)	;

				$sql ="SELECT * FROM  ".$pohqtbl."  where TMID IN (".$tmids1.") AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY POHQNAME  ";
				//echo $sql;exit;
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = @sqlsrv_num_rows($res1);
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 		
			 			if(!in_array($row['POHQCODE'], $poidarr)){
			 				$poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME'],'TMID'=>$tmdata['TMID']);	
			 				$poidarr[] = $row['POHQCODE'];
			 			} 			
			 		}
				}

			if(count(@$poDet)>0){
				$poDetname = sortbyval($poDet,'POHQNAME');
	 		array_multisort($poDetname,SORT_ASC,SORT_STRING,$poDet);
	 		array_unshift($poDet, array('POHQCODE'=>'All','POHQNAME'=>'All'));
			}
		
		$result['poDet'] = $poDet;
}

if($getpodet1=='yes'){
	$poDet = array();
	$sql ="SELECT * FROM  ".$pohqtbl."  where POCODE='".$pocode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY POHQNAME  ";
			
		$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));	
		$row_count = sqlsrv_num_rows($res1);
		if($row_count>1){
			 $poDet[] = array('POHQCODE'=>"All",'POHQNAME'=>"All");
		}
		
		if($row_count>0){
		 		while($row = sqlsrv_fetch_array($res1)){ 		 			
		 			 $poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME']);	
		 		}

		 	$result['poDet'] = $poDet;
		}
}
	
	 //$products[] = 'All';
	 $activity[] = 'All';

	/*$sql ="SELECT * FROM  ".$producttbl."  where dataAreaId='".$_POST['dataAreaId']."' ORDER BY CROP ";
 		 	
	 	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		 $row_count = sqlsrv_num_rows($res);
		
	 	if($row_count>0){
	 		while($row = sqlsrv_fetch_array($res)){ 	
		 		if(!in_array($row['CROP'], $croparr)){
		 			$products[] = $row['CROP'];
		 			$croparr[] = $row['CROP'];
		 		}		
	 		}
		}*/
		
		if($_POST['dataAreaId']=='ras'){
			$products[] = 'HYBRID COTTON BGII';
		}

		if($_POST['dataAreaId']=='fcm'){
			$products[] = 'Bajra';
			$products[] = 'Maize';
			$products[] = 'Paddy';
		}

		$result['products'] = $products;

	}else{

		if($_POST['Dcode']=='ZM'){

		$sql ="SELECT trzm.REGIONID,trzm.ZONEID FROM  ".$TRZMapping." AS trzm  where trzm.dataAreaId='".$_POST['dataAreaId']."'   ";

		if($_POST['lcode']!='All'){
			$sql .= " AND trzm.ZoneId='".$_POST['lcode']."'";
		}

		
				$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows($res1);
				
				$ridarr = array();
				if($row_count>0){
			 		while($row = sqlsrv_fetch_array($res1)){ 
			 			$rid = $row['REGIONID']	;
		 				if(!in_array($rid, $ridarr)){
		 					$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$rid."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY REGIONNAME   ";
		 					$resr = sqlsrv_query($conn,$sqlr,array(), array( "Scrollable" => 'static' ));
		 					$row_countr = sqlsrv_num_rows($resr);
		 					if($row_countr>0){
		 						while($row1 = sqlsrv_fetch_array($resr)){ 
		 							if(!in_array($row1['REGIONID'], $ridarr)){
				 						$rres[] = array('RegionId'=>$rid,'RegionName'=>$row1['REGIONNAME'],'Zone'=>$row['ZONEID']);
				 						$ridarr[] = $rid;
			 						}
		 						}
		 					}
		 					
		 				}
			 			 
			 		}

				 	$rresname = sortbyval($rres,'RegionName');
			 		array_multisort($rresname,SORT_ASC,SORT_STRING,$rres);
			 		array_unshift($rres, array('RegionId'=>'All','RegionName'=>'All'));
				}

				$result['regionDet'] = $rres;

		}		
		if($_POST['Dcode']=='RBM'){
			$tmidarr = array();
			$tmDet = array();
			//$tmDet[] = array('TMID'=>'All','TMName'=>'All','Region'=>'All');
			$rblcode = $_POST['lcode'];
			if($rblcode=="All"){
				if(isset($_POST['all_code'])){
						$allregcode = explode(",", $_POST['all_code']);
					foreach ($allregcode as  $RegionId) {
						$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID='".$RegionId."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  TMNAME";
						$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						$row_count = sqlsrv_num_rows($res1);
						if($row_count>0){
					 		while($row = sqlsrv_fetch_array($res1)){ 		
					 			if(!in_array($row['TMID'], $tmidarr)){
					 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$RegionId);	
					 				$tmidarr[] = $row['TMID'];
					 			} 			
					 		}
						}
					}					
			}
		}else{

			$sql ="SELECT * FROM  ".$TRZMapping."  where REGIONID='".$rblcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  TMNAME  ";
						$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
						$row_count = sqlsrv_num_rows($res1);
						if($row_count>0){
					 		while($row = sqlsrv_fetch_array($res1)){ 		
					 			if(!in_array($row['TMID'], $tmidarr)){
					 				$tmDet[] = array('TMID'=>$row['TMID'],'TMName'=>$row['TMNAME'],'Region'=>$rblcode);	
					 				$tmidarr[] = $row['TMID'];
					 			} 			
					 		}
						}

		}

				$tmDetname = sortbyval($tmDet,'TMName');
	 		array_multisort($tmDetname,SORT_ASC,SORT_STRING,$tmDet);
	 		array_unshift($tmDet, array('TMID'=>'All','TMName'=>'All','Region'=>'All'));

			$result['tmDet'] = $tmDet;

		}

		if($_POST['Dcode']=='TM'){
			$poidarr = array();
			$poDet = array();
			//$poDet[] = array('POHQCODE'=>'All','POHQNAME'=>'All');
			$tmlcode = $_POST['lcode'];
			if($tmlcode=='All'){
				$alltmcode = explode(",", $_POST['all_code']);
				foreach ($alltmcode as  $TMID) {
					$sql ="SELECT * FROM  ".$pohqtbl."  where TMID='".$TMID."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  POHQNAME  ";
					
					$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					$row_count = sqlsrv_num_rows($res1);
					if($row_count>0){
				 		while($row = sqlsrv_fetch_array($res1)){ 		
				 			if(!in_array($row['POHQCODE'], $poidarr)){
				 				$poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME'],'TMID'=>$TMID);	
				 				$poidarr[] = $row['POHQCODE'];
				 			} 			
				 		}
					}
				}
			}else{
				$sql ="SELECT * FROM  ".$pohqtbl."  where TMID='".$tmlcode."' AND dataAreaId='".$_POST['dataAreaId']."' ORDER BY  POHQNAME  ";
					$res1 = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
					$row_count = sqlsrv_num_rows($res1);
					if($row_count>0){
				 		while($row = sqlsrv_fetch_array($res1)){ 		
				 			if(!in_array($row['POHQCODE'], $poidarr)){
				 				$poDet[] = array('POHQCODE'=>$row['POHQCODE'],'POHQNAME'=>$row['POHQNAME'],'TMID'=>$tmlcode);	
				 				$poidarr[] = $row['POHQCODE'];
				 			} 			
				 		}
					}
			}

								$poDetname = sortbyval($poDet,'POHQNAME');
	 		array_multisort($poDetname,SORT_ASC,SORT_STRING,$poDet);
	 		array_unshift($poDet, array('POHQCODE'=>'All','POHQNAME'=>'All'));

			$result['poDet'] = $poDet;
		}
	}

	}else if($Action=='GET_HYBIRDSPDTRAIL'){
			$hybridsarr = array();
			$hybridsarr[] = "All";
			/*$sql =" SELECT * FROM  ".$producttbl."  where CROP = '".$_POST['crop']."'  ";
			//echo $sql;exit;
			$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			while($row = sqlsrv_fetch_array($res)){ 			
				$hybridsarr[] = $row['HYBRIDS'];
			}
*/

			if($_POST['crop']=='HYBRID COTTON BGII'){

				$sql =" SELECT * FROM  ".$hybridtbl." ";
			//echo $sql;exit;
			$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
			while($row = sqlsrv_fetch_array($res)){ 			
				$hybridsarr[] = $row['HYBRID'];
			}

				
			}else if($_POST['crop']=='Bajra'){
				$hybridsarr[] = 'Dhanyaa 77';
				$hybridsarr[] = 'PHI 86M88';
				$hybridsarr[] = 'Rasi 1827';
				$hybridsarr[] = 'TH121492';
				$hybridsarr[] = 'TH16K158';
				$hybridsarr[] = 'TH16K170';
				$hybridsarr[] = 'TH16K171';
			}else if($_POST['crop']=='Maize'){
				$hybridsarr[] ='3033';
				$hybridsarr[] ='DKC7074';
				$hybridsarr[] = 'NC1';
				$hybridsarr[] = 'NC2';
				$hybridsarr[] = 'NC3';
				$hybridsarr[] = 'NK30';
			}else if($_POST['crop']=='Paddy'){
				$hybridsarr[] ='5116';
				$hybridsarr[] ='5224';
				$hybridsarr[] ='6039';
				$hybridsarr[] ='RRX 113';
				$hybridsarr[] ='US 312';
			}
			
			$result = $hybridsarr;

	}
}
else{
	$result = array('status'=>'failed','msg'=>'action missing');
}

echo json_encode($result);

?>