<?php
	
function LocationWiseChart($data){
//p($data,'e');
 global $conn;
 global $regtbl;
 global $zmtbl;
 global $tmtbl;
 global $pohqtbl;
 $returnarr = $zmcountarr = $rbecountarr = $alltmcountarr = $allpocountarr = $rbmdrilldata = $tmdrilldata = $regidarr =  $zmidarr  =  $tmidarr = $poidarr = array();					
			
$zmall_code = explode(",", @$data['zmall_code']);
$rbmall_code = explode(",", @$data['rbmall_code']);
$tmall_code = explode(",", @$data['tmall_code']);
$poall_code = explode(",", @$data['poall_code']);

if(isset($data['zmall_code'])){
	foreach ($zmall_code as  $ZMID) {
	
	$psql = "EXEC PDTrail_zmLocWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='".@$ZMID."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@activity='".@$data['activity']."'";
		//echo $psql;exit;
			$stmt = sqlsrv_prepare($conn, $psql);
			sqlsrv_execute($stmt);
			$cspen = "no";
			if($data['required']=='All' || $data['required']=="" || $data['required']=="SOWING"){
			while($prow = sqlsrv_fetch_array($stmt)){	
				$cspen='yes';
					$zmid = $prow['ZONENAME'];
					$zid = $prow['ZONEID'];
					if(isset($prow['SOWING'])){
						$zevtcount= $prow['SOWING'];
						$zmcountarr['SOWING'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"SOWING");
						if(!array_key_exists($zid, $zmidarr)){
							$zmidarr[$zid] = $prow['ZONENAME'];
						}
					}
				}
				if($cspen=='no'){
					if(isset($zmidarr[$ZMID])){
						$zmname = $zmidarr[$ZMID];
					}else{
						$sql ="SELECT * FROM  ".$zmtbl."  where DATAAREAID='".$data['pdivision']."' AND ZONEID='".$ZMID."'  ";
						$res1 = sqlsrv_query($conn,$sql);
						while($row = sqlsrv_fetch_array($res1)){
							$zmidarr[$ZMID] = $row['ZONENAME'];
							$zmname = $row['ZONENAME'];
						}
						
					}

					$zmcountarr['SOWING'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"SOWING");
				}

				sqlsrv_next_result($stmt);
			}
			$csapp ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_70_80"){
				while($prow = sqlsrv_fetch_array($stmt)){		
				$csapp ='yes';	
					$zmid = $prow['ZONENAME'];
				    $zid = $prow['ZONEID'];
					if(isset($prow['STAGE_70_80'])){
						$zevtcount= $prow['STAGE_70_80'];
						$zmcountarr['STAGE_70_80'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"STAGE_70_80");
						if(!array_key_exists($zid, $zmidarr)){
							
							$zmidarr[$zid] = $prow['ZONENAME'];
						}
					}
				}

				if($csapp=='no'){
					if(isset($zmidarr[$ZMID])){
						$zmname = $zmidarr[$ZMID];
					}else{
						$sql ="SELECT * FROM  ".$zmtbl."  where DATAAREAID='".$data['pdivision']."' AND ZONEID='".$ZMID."'  ";
						$res1 = sqlsrv_query($conn,$sql);
						while($row = sqlsrv_fetch_array($res1)){
							$zmidarr[$ZMID] = $row['ZONENAME'];
							$zmname = $row['ZONENAME'];
						}
						
					}

					$zmcountarr['STAGE_70_80'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"STAGE_70_80");
				}

				sqlsrv_next_result($stmt);
			}

			$csexe = 'no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_120_130"){
				while($prow = sqlsrv_fetch_array($stmt)){	
				$csexe = 'yes';		
					$zmid = $prow['ZONENAME'];
					$zid = $prow['ZONEID'];									
					if(isset($prow['STAGE_120_130'])){
						$zevtcount= $prow['STAGE_120_130'];
						$zmcountarr['STAGE_120_130'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"STAGE_120_130","fc"=>(int)@$prow['FARMERSCOVERED'],"vc"=>(int)@$prow['VILLAGESCOVERED'],'dc'=>(int)@$prow['DEALERSCOVERED']);
						if(!array_key_exists($zid, $zmidarr)){
							$zmidarr[$zid] = $prow['ZONENAME'];
						}
					
					}
				}

				if($csexe=='no'){
					if(isset($zmidarr[$ZMID])){
						$zmname = $zmidarr[$ZMID];
					}else{
						$sql ="SELECT * FROM  ".$zmtbl."  where DATAAREAID='".$data['pdivision']."' AND ZONEID='".$ZMID."'  ";
						$res1 = sqlsrv_query($conn,$sql);
						while($row = sqlsrv_fetch_array($res1)){
							$zmidarr[$ZMID] = $row['ZONENAME'];
							$zmname = $row['ZONENAME'];
						}
					}

					$zmcountarr['STAGE_120_130'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"STAGE_120_130","fc"=>0,"vc"=>0,'dc'=>0);
				}
			}

				$csexe = 'no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_PICKING_YIELD"){
				while($prow = sqlsrv_fetch_array($stmt)){	
				$csexe = 'yes';		
					$zmid = $prow['ZONENAME'];
					$zid = $prow['ZONEID'];									
					if(isset($prow['STAGE_PICKING_YIELD'])){
						$zevtcount= $prow['STAGE_PICKING_YIELD'];
						$zmcountarr['STAGE_PICKING_YIELD'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"STAGE_PICKING_YIELD","fc"=>(int)$prow['FARMERSCOVERED'],"vc"=>(int)$prow['VILLAGESCOVERED'],'dc'=>(int)$prow['DEALERSCOVERED']);
						if(!array_key_exists($zid, $zmidarr)){
							$zmidarr[$zid] = $prow['ZONENAME'];
						}
					
					}
				}

				if($csexe=='no'){
					if(isset($zmidarr[$ZMID])){
						$zmname = $zmidarr[$ZMID];
					}else{
						$sql ="SELECT * FROM  ".$zmtbl."  where DATAAREAID='".$data['pdivision']."' AND ZONEID='".$ZMID."'  ";
						$res1 = sqlsrv_query($conn,$sql);
						while($row = sqlsrv_fetch_array($res1)){
							$zmidarr[$ZMID] = $row['ZONENAME'];
							$zmname = $row['ZONENAME'];
						}
					}

					$zmcountarr['STAGE_PICKING_YIELD'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"STAGE_PICKING_YIELD","fc"=>0,"vc"=>0,'dc'=>0);
				}

			}

			$csexe = 'no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_CLOSED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
				$csexe = 'yes';		
					$zmid = $prow['ZONENAME'];
					$zid = $prow['ZONEID'];									
					if(isset($prow['STAGE_CLOSED'])){
						$zevtcount= $prow['STAGE_CLOSED'];
						$zmcountarr['STAGE_CLOSED'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"STAGE_CLOSED","fc"=>(int)$prow['FARMERSCOVERED'],"vc"=>(int)$prow['VILLAGESCOVERED'],'dc'=>(int)$prow['DEALERSCOVERED']);
						if(!array_key_exists($zid, $zmidarr)){
							$zmidarr[$zid] = $prow['ZONENAME'];
						}
					
					}
				}

				if($csexe=='no'){
					if(isset($zmidarr[$ZMID])){
						$zmname = $zmidarr[$ZMID];
					}else{
						$sql ="SELECT * FROM  ".$zmtbl."  where DATAAREAID='".$data['pdivision']."' AND ZONEID='".$ZMID."'  ";
						$res1 = sqlsrv_query($conn,$sql);
						while($row = sqlsrv_fetch_array($res1)){
							$zmidarr[$ZMID] = $row['ZONENAME'];
							$zmname = $row['ZONENAME'];
						}
					}

					$zmcountarr['STAGE_CLOSED'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"STAGE_CLOSED","fc"=>0,"vc"=>0,'dc'=>0);
				}

			}

		}

//p($zmcountarr,'e');
				$returnarr['series1'] = $zmcountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
				$returnarr['CL'] = "ZM";
}else if(isset($data['rbmall_code'])){

	foreach (@$rbmall_code as  $REGIONID) {

	$psql = "EXEC PDTrail_rbmLocWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='',@rbmcode='".@$REGIONID."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@activity='".@$data['activity']."'";
			 	//echo $psql;exit;
			 	$stmt = sqlsrv_prepare($conn, $psql);
				sqlsrv_execute($stmt);
				$cspen = "no";
				if($data['required']=='All' || $data['required']=="" || $data['required']=="SOWING"){
					
				while($prow = sqlsrv_fetch_array($stmt)){
					$cspen	= 'yes';
					$regid = $prow['REGIONNAME'];
					$rid = $prow['REGIONID'];
					if(isset($prow['SOWING'])){
						$revtcount= $prow['SOWING'];
						$rdrilldown = $regid.'PEND';
						$rbecountarr['SOWING'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"SOWING");
						if(!array_key_exists($rid, $regidarr)){
							$regidarr[$rid] = $prow['REGIONNAME'];
						}
					}
				}

				if($cspen=='no'){
					if(isset($regidarr[$REGIONID])){
						$rname = $regidarr[$REGIONID];
					}else{
						$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$REGIONID."' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sqlr);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$rname = $row1['REGIONNAME'];
	 							$regidarr[$REGIONID] = $row1['REGIONNAME'];
	 						}
					}

				$rbecountarr['SOWING'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"SOWING");
			}

				sqlsrv_next_result($stmt);
			}

			$csapp = 'no';

			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_70_80"){

				while($prow = sqlsrv_fetch_array($stmt)){
				$csapp = 'yes';
					$regid = $prow['REGIONNAME'];
				    $rid = $prow['REGIONID'];
					if(isset($prow['STAGE_70_80'])){
						$revtcount= $prow['STAGE_70_80'];
						$rdrilldown = $regid.'APP';
						$rbecountarr['STAGE_70_80'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"STAGE_70_80");
						if(!array_key_exists($rid, $regidarr)){
							
							$regidarr[$rid] = $prow['REGIONNAME'];
						}
					}
				}

					if($csapp=='no'){
					if(isset($regidarr[$REGIONID])){
						$rname = $regidarr[$REGIONID];
					}else{
						$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$REGIONID."' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sqlr);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$rname = $row1['REGIONNAME'];
	 							$regidarr[$REGIONID] = $row1['REGIONNAME'];
	 						}
					}
					
					$rbecountarr['STAGE_70_80'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"STAGE_70_80");
			}

				sqlsrv_next_result($stmt);

			}
			$csapp = 'no';

			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_120_130"){

				while($prow = sqlsrv_fetch_array($stmt)){
				$csapp = 'yes';
					$regid = $prow['REGIONNAME'];
				    $rid = $prow['REGIONID'];
					if(isset($prow['STAGE_120_130'])){
						$revtcount= $prow['STAGE_120_130'];
						$rdrilldown = $regid.'APP';
						$rbecountarr['STAGE_120_130'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"STAGE_120_130");
						if(!array_key_exists($rid, $regidarr)){
							
							$regidarr[$rid] = $prow['REGIONNAME'];
						}
					}
				}

					if($csapp=='no'){
					if(isset($regidarr[$REGIONID])){
						$rname = $regidarr[$REGIONID];
					}else{
						$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$REGIONID."' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sqlr);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$rname = $row1['REGIONNAME'];
	 							$regidarr[$REGIONID] = $row1['REGIONNAME'];
	 						}
					}
					
					$rbecountarr['STAGE_120_130'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"STAGE_120_130");
			}

				sqlsrv_next_result($stmt);

			}

			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_PICKING_YIELD"){

				while($prow = sqlsrv_fetch_array($stmt)){
				$csapp = 'yes';
					$regid = $prow['REGIONNAME'];
				    $rid = $prow['REGIONID'];
					if(isset($prow['STAGE_PICKING_YIELD'])){
						$revtcount= $prow['STAGE_PICKING_YIELD'];
						$rdrilldown = $regid.'APP';
						$rbecountarr['STAGE_PICKING_YIELD'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"STAGE_PICKING_YIELD");
						if(!array_key_exists($rid, $regidarr)){
							
							$regidarr[$rid] = $prow['REGIONNAME'];
						}
					}
				}

					if($csapp=='no'){
					if(isset($regidarr[$REGIONID])){
						$rname = $regidarr[$REGIONID];
					}else{
						$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$REGIONID."' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sqlr);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$rname = $row1['REGIONNAME'];
	 							$regidarr[$REGIONID] = $row1['REGIONNAME'];
	 						}
					}
					
					$rbecountarr['STAGE_PICKING_YIELD'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"STAGE_PICKING_YIELD");
			}

				sqlsrv_next_result($stmt);

			}

			$csexe='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_CLOSED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
				$csexe='yes';
					$regid = $prow['REGIONNAME'];
					$rid = $prow['REGIONID'];									
					if(isset($prow['STAGE_CLOSED'])){
						$revtcount= $prow['STAGE_CLOSED'];
						$rdrilldown = $regid.'EXEC';
						$rbecountarr['STAGE_CLOSED'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"STAGE_CLOSED","fc"=>(int)@$prow['FARMERSCOVERED'],"vc"=>(int)@$prow['VILLAGESCOVERED'],'dc'=>(int)@$prow['DEALERSCOVERED']);
						if(!array_key_exists($rid, $regidarr)){
							
							$regidarr[$rid] = $prow['REGIONNAME'];
						}
					}
				}

				if($csexe=='no'){
					if(isset($regidarr[$REGIONID])){
						$rname = $regidarr[$REGIONID];
					}else{
						$sqlr ="SELECT * FROM  ".$regtbl."  where REGIONID='".$REGIONID."' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sqlr);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$rname = $row1['REGIONNAME'];
	 							$regidarr[$REGIONID] = $row1['REGIONNAME'];
	 						}
					}
					
					$rbecountarr['STAGE_CLOSED'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"STAGE_CLOSED","fc"=>0,"vc"=>0,'dc'=>0);
			}
				}
			}
			//p($rbecountarr,'e');
				$returnarr['series1'] = $rbecountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
				$returnarr['CL'] = "RBM";
}elseif(isset($data['tmall_code'])){
	foreach ($tmall_code as $TMID){

		$psql1 = "EXEC PDTail_tmLocWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='',@rbmcode='',@tmcode='".$TMID."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@activity='".@$data['activity']."'";
		//echo $psql1;exit;
					$stmt1 = sqlsrv_prepare($conn, $psql1);
					sqlsrv_execute($stmt1);
					$cspen = 'no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="SOWING"){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$cspen = 'yes';
						$tmid = $prow1['TMNAME'].'';
						$tid = $prow1['TMID'];
						if(isset($prow1['SOWING'])){
						$tevtcount= $prow1['SOWING'];						
						$alltmcountarr['SOWING'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"SOWING");

							if(!array_key_exists($prow1['TMID'], $tmidarr)){
								$tmidarr[$tid] = $prow1['TMNAME'];
							}
						}
					}
					if($cspen=='no'){
						if(isset($tmidarr[$TMID])){
						$tname = $tmidarr[$TMID];
						}else{
							$sqlr ="SELECT * FROM  ".$tmtbl."  where TMID='".$TMID."' AND DATAAREAID='".$data['pdivision']."' ";
			 					$resr = sqlsrv_query($conn,$sqlr);
		 						while($row1 = sqlsrv_fetch_array($resr)){
		 							$tname = $row1['TMNAME'];
		 							$tmidarr[$TMID] = $row1['TMNAME'];
		 						}
					}

					$alltmcountarr['SOWING'][] =  array("name"=>$tname."<span style='display:none'>".$TMID."</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"SOWING");
					}

					sqlsrv_next_result($stmt1);
				
		}
				$csapp = 'no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_70_80"){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csapp = 'yes';
						$tmid = $prow1['TMNAME'].'';
						$tid = $prow1['TMID'];
						if(isset($prow1['STAGE_70_80'])){
						$tevtcount= $prow1['STAGE_70_80'];
						$alltmcountarr['STAGE_70_80'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"STAGE_70_80");
							if(!array_key_exists($prow1['TMID'], $tmidarr)){
								
								$tmidarr[$tid] = $prow1['TMNAME'];
							}
						}
					}
							if($csapp=='no'){
					if(isset($tmidarr[$TMID])){
						$tname = $tmidarr[$TMID];
						}else{
							$sqlr ="SELECT * FROM  ".$tmtbl."  where TMID='".$TMID."' AND DATAAREAID='".$data['pdivision']."' ";
			 					$resr = sqlsrv_query($conn,$sqlr);
		 						while($row1 = sqlsrv_fetch_array($resr)){
		 							$tname = $row1['TMNAME'];
		 							$tmidarr[$TMID] = $row1['TMNAME'];
		 						}
					}

					$alltmcountarr['STAGE_70_80'][] =  array("name"=>$tname."<span style='display:none'>".$TMID."</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"STAGE_70_80");
					}

	
					sqlsrv_next_result($stmt1);
				}

				$csapp = 'no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_120_130"){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csapp = 'yes';
						$tmid = $prow1['TMNAME'].'';
						$tid = $prow1['TMID'];
						if(isset($prow1['STAGE_120_130'])){
						$tevtcount= $prow1['STAGE_120_130'];
						$alltmcountarr['STAGE_120_130'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"STAGE_120_130");
							if(!array_key_exists($prow1['TMID'], $tmidarr)){
								
								$tmidarr[$tid] = $prow1['TMNAME'];
							}
						}
					}
							if($csapp=='no'){
					if(isset($tmidarr[$TMID])){
						$tname = $tmidarr[$TMID];
						}else{
							$sqlr ="SELECT * FROM  ".$tmtbl."  where TMID='".$TMID."' AND DATAAREAID='".$data['pdivision']."' ";
			 					$resr = sqlsrv_query($conn,$sqlr);
		 						while($row1 = sqlsrv_fetch_array($resr)){
		 							$tname = $row1['TMNAME'];
		 							$tmidarr[$TMID] = $row1['TMNAME'];
		 						}
					}

					$alltmcountarr['STAGE_120_130'][] =  array("name"=>$tname."<span style='display:none'>".$TMID."</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"STAGE_120_130");
					}

	
					sqlsrv_next_result($stmt1);
				}

				$csapp = 'no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_PICKING_YIELD"){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csapp = 'yes';
						$tmid = $prow1['TMNAME'].'';
						$tid = $prow1['TMID'];
						if(isset($prow1['STAGE_PICKING_YIELD'])){
						$tevtcount= $prow1['STAGE_PICKING_YIELD'];
						$alltmcountarr['STAGE_PICKING_YIELD'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"STAGE_PICKING_YIELD");
							if(!array_key_exists($prow1['TMID'], $tmidarr)){
								
								$tmidarr[$tid] = $prow1['TMNAME'];
							}
						}
					}
							if($csapp=='no'){
					if(isset($tmidarr[$TMID])){
						$tname = $tmidarr[$TMID];
						}else{
							$sqlr ="SELECT * FROM  ".$tmtbl."  where TMID='".$TMID."' AND DATAAREAID='".$data['pdivision']."' ";
			 					$resr = sqlsrv_query($conn,$sqlr);
		 						while($row1 = sqlsrv_fetch_array($resr)){
		 							$tname = $row1['TMNAME'];
		 							$tmidarr[$TMID] = $row1['TMNAME'];
		 						}
					}

					$alltmcountarr['STAGE_PICKING_YIELD'][] =  array("name"=>$tname."<span style='display:none'>".$TMID."</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"STAGE_PICKING_YIELD");
					}

	
					sqlsrv_next_result($stmt1);
				}

				$csexe ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_CLOSED"){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csexe ='yes';
						$tmid = $prow1['TMNAME'].'';
						$tid = $prow1['TMID'];
						if(isset($prow1['STAGE_CLOSED'])){
						$tevtcount= $prow1['STAGE_CLOSED'];
						$alltmcountarr['STAGE_CLOSED'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"STAGE_CLOSED","fc"=>(int)@$prow1['FARMERSCOVERED'],"vc"=>(int)@$prow1['VILLAGESCOVERED'],'dc'=>(int)@$prow1['DEALERSCOVERED']);
						if(!array_key_exists($prow1['TMID'], $tmidarr)){
								$tmidarr[$tid] = $prow1['TMNAME'];
							}
							
						}
					}

						if($csexe=='no'){
					if(isset($tmidarr[$TMID])){
						$tname = $tmidarr[$TMID];
						}else{
							$sqlr ="SELECT * FROM  ".$tmtbl."  where TMID='".$TMID."' AND DATAAREAID='".$data['pdivision']."' ";
			 					$resr = sqlsrv_query($conn,$sqlr);
		 						while($row1 = sqlsrv_fetch_array($resr)){
		 							$tname = $row1['TMNAME'];
		 							$tmidarr[$TMID] = $row1['TMNAME'];
		 						}
					}

					$alltmcountarr['STAGE_CLOSED'][] =  array("name"=>$tname."<span style='display:none'>".$TMID."</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"STAGE_CLOSED","fc"=>0,"vc"=>0,'dc'=>0);
					}
					
				sqlsrv_next_result($stmt1);
				
			}
	}
	//p($alltmcountarr,'e');
	$returnarr['series1'] = $alltmcountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
	$returnarr['CL'] = "TM";
}else{
	
	foreach ($poall_code as $POCODE) {
	
	$psql2 = "EXEC PDTrail_pohqWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='',@rbmcode='',@tmcode='',@pocode='".@$POCODE."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@activity='".@$data['activity']."'";
	//echo $psql2;exit;
					$stmt2 = sqlsrv_prepare($conn, $psql2);

					sqlsrv_execute($stmt2);
					$cspen='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="SOWING"){
						while($prow2 = sqlsrv_fetch_array($stmt2)){	
							$cspen='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['SOWING'])){
							$poevtcount= $prow2['SOWING'];
							$allpocountarr['SOWING'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"SOWING");
							$poidarr[$pid] = $poid;
						}
					}
					if($cspen=='no'){
					if(isset($poidarr[$POCODE])){
						$poname = $poidarr[$POCODE];
						}else{
							$sql =" SELECT * FROM  ".$pohqtbl." where POHQCODE = '$POCODE' AND DATAAREAID='".$data['pdivision']."' ";
			 					$resr = sqlsrv_query($conn,$sql);
		 						while($row1 = sqlsrv_fetch_array($resr)){
		 							$poname = $row1['POHQNAME'];
		 							$poidarr[$POCODE] = $row1['POHQNAME'];
		 						}
					}

					$allpocountarr['SOWING'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"SOWING");
					}

					sqlsrv_next_result($stmt2);
				}
					$csapp='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_70_80"){
					while($prow2 = sqlsrv_fetch_array($stmt2)){	
						$csapp='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['STAGE_70_80'])){
						$poevtcount= $prow2['STAGE_70_80'];
						$allpocountarr['STAGE_70_80'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"STAGE_70_80");
						$poidarr[$pid] = $poid;
						}
					}
						if($csapp=='no'){
					if(isset($poidarr[$POCODE])){
						$poname = $poidarr[$POCODE];
						}else{
						$sql =" SELECT * FROM  ".$pohqtbl." where POHQCODE = '$POCODE' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sql);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$poname = $row1['POHQNAME'];
	 							$poidarr[$POCODE] = $row1['POHQNAME'];
	 						}
					}

					$allpocountarr['STAGE_70_80'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"STAGE_70_80");
					}
					sqlsrv_next_result($stmt2);
				}

				$csapp='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_120_130"){
					while($prow2 = sqlsrv_fetch_array($stmt2)){	
						$csapp='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['STAGE_120_130'])){
						$poevtcount= $prow2['STAGE_120_130'];
						$allpocountarr['STAGE_120_130'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"STAGE_120_130");
						$poidarr[$pid] = $poid;
						}
					}
						if($csapp=='no'){
					if(isset($poidarr[$POCODE])){
						$poname = $poidarr[$POCODE];
						}else{
						$sql =" SELECT * FROM  ".$pohqtbl." where POHQCODE = '$POCODE' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sql);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$poname = $row1['POHQNAME'];
	 							$poidarr[$POCODE] = $row1['POHQNAME'];
	 						}
					}

					$allpocountarr['STAGE_120_130'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"STAGE_120_130");
					}
					sqlsrv_next_result($stmt2);
				}

				$csapp='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_PICKING_YIELD"){
					while($prow2 = sqlsrv_fetch_array($stmt2)){	
						$csapp='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['STAGE_PICKING_YIELD'])){
						$poevtcount= $prow2['STAGE_PICKING_YIELD'];
						$allpocountarr['STAGE_PICKING_YIELD'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"STAGE_PICKING_YIELD");
						$poidarr[$pid] = $poid;
						}
					}
						if($csapp=='no'){
					if(isset($poidarr[$POCODE])){
						$poname = $poidarr[$POCODE];
						}else{
						$sql =" SELECT * FROM  ".$pohqtbl." where POHQCODE = '$POCODE' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sql);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$poname = $row1['POHQNAME'];
	 							$poidarr[$POCODE] = $row1['POHQNAME'];
	 						}
					}

					$allpocountarr['STAGE_PICKING_YIELD'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"STAGE_PICKING_YIELD");
					}
					sqlsrv_next_result($stmt2);
				}

				$csexe='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_CLOSED"){

					while($prow2 = sqlsrv_fetch_array($stmt2)){	
						$csexe='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['STAGE_CLOSED'])){
						$poevtcount= $prow2['STAGE_CLOSED'];
						$allpocountarr['STAGE_CLOSED'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"STAGE_CLOSED","fc"=>(int)@$prow2['FARMERSCOVERED'],"vc"=>(int)@$prow2['VILLAGESCOVERED'],'dc'=>(int)@$prow2['DEALERSCOVERED']);
							$poidarr[$pid] = $poid;
						}
					}
					if($csexe=='no'){
					if(isset($poidarr[$POCODE])){
						$poname = $poidarr[$POCODE];
						}else{
						$sql =" SELECT * FROM  ".$pohqtbl." where POHQCODE = '$POCODE' AND DATAAREAID='".$data['pdivision']."' ";
		 					$resr = sqlsrv_query($conn,$sql);
	 						while($row1 = sqlsrv_fetch_array($resr)){
	 							$poname = $row1['POHQNAME'];
	 							$poidarr[$POCODE] = $row1['POHQNAME'];
	 						}
					}

					$allpocountarr['STAGE_CLOSED'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"STAGE_CLOSED","fc"=>0,"vc"=>0,'dc'=>0);
					}
				}
					
}
					//p($allpocountarr,'e');
					$returnarr['series1'] = $allpocountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
					$returnarr['CL'] = "PO";

}



	
 return $returnarr;

}
//PRODUCTwISE CHART GENERATION
function ProductWiseChart($data){

 global $conn;
 $returnarr = $prodwisearr = $productdrilldown = $pidarr =   $allhybridcountarr =array();

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




if(isset($data['prodall_code']))
{
	$prodall_code = explode(",", @$data['prodall_code']);

	foreach($prodall_code AS $PRODUCT){
	 $psql = "EXEC ProductWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$PRODUCT."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
//echo $psql;exit;
			 
				$stmt = sqlsrv_prepare($conn, $psql);
				sqlsrv_execute($stmt);
				$cspen='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$cspen ='yes';
					$product = $prow['CROPNAME'];
					if(isset($prow['evtpending'])){
					$prodwisearr['PENDING'][] = array('name'=>$product,'y'=>$prow['evtpending'],"tname"=>$product,"NID"=>$product,'act'=>"PENDING");

						if(!in_array($product, $pidarr)){
							$pidarr[] = $product;
						}
					}
				}

				if($cspen=='no'){
					$prodwisearr['PENDING'][] = array('name'=>$PRODUCT,'y'=>0,"tname"=>$PRODUCT,"NID"=>$PRODUCT,'act'=>"PENDING");
				}

				sqlsrv_next_result($stmt);
			}
			$csapp='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){

				while($prow = sqlsrv_fetch_array($stmt)){	
					$csapp='yes';
					$product = $prow['CROPNAME'];
					if(isset($prow['evtapproved'])){
					$prodwisearr['APPROVED'][] = array('name'=>$product,'y'=>$prow['evtapproved'],"tname"=>$product,"NID"=>$product,'act'=>"APPROVED");
					if(!in_array($product, $pidarr)){
							$pidarr[] = $product;
						}
					}
				}

				if($csapp=='no'){
					$prodwisearr['APPROVED'][] = array('name'=>$PRODUCT,'y'=>0,"tname"=>$PRODUCT,"NID"=>$PRODUCT,'act'=>"APPROVED");
				}

				sqlsrv_next_result($stmt);
			}
			$csexe='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csexe='yes';
					$product = $prow['CROPNAME'];
					if(isset($prow['evtexecuted'])){
					$prodwisearr['EXECUTED'][] = array('name'=>$product,'y'=>$prow['evtexecuted'],"tname"=>$product,"NID"=>$product,'act'=>"EXECUTED");
					if(!in_array($product, $pidarr)){
							$pidarr[] = $product;
						}
					}
				}

				if($csexe=='no'){
					$prodwisearr['EXECUTED'][] = array('name'=>$PRODUCT,'y'=>0,"tname"=>$PRODUCT,"NID"=>$PRODUCT,'act'=>"EXECUTED");
				}
			}
		}

		$returnarr['series1'] = $prodwisearr;
		$returnarr['CP'] = 'PRODUCT';
		/*$returnarr['pdseriesfor'] = array('series1'=>'PRODUCT','series2'=>'HYBRID');*/
}else{

	$hyball_code = explode(",", @$data['hyball_code']);
$ckey = 0;
	foreach($hyball_code AS $HYBRID){
		
		$ovhcount = 0;
		$psql1 = "EXEC PDTrail_HybridWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".$data['product']."',@hybrid='".@$HYBRID."',@activity='".$data['activity']."'";
		
		$stmt1 = sqlsrv_prepare($conn, $psql1);
			 sqlsrv_execute($stmt1);
			 $cspen ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="SOWING"){
				$sfrom ='SOWING';
			while($prow1 = sqlsrv_fetch_array($stmt1)){	
				 $cspen ='yes';
				if(isset($prow1['SOWING'])){
					$ovhcount +=$prow1['SOWING'];
				$allhybridcountarr['SOWING'][$ckey] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['SOWING'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"SOWING");
				}
			}
				if($cspen=='no'){
					$ovhcount +=0;
					$allhybridcountarr['SOWING'][$ckey] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"SOWING");
				}


			sqlsrv_next_result($stmt1);
		}

		$csapp ='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_70_80"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){
				$csapp ='yes';	
				if(isset($prow1['STAGE_70_80'])){
					$ovhcount +=$prow1['STAGE_70_80'];
				$allhybridcountarr['STAGE_70_80'][$ckey] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['STAGE_70_80'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"STAGE_70_80");
				}
			}

			if($csapp=='no'){
				$ovhcount +=0;
				$allhybridcountarr['STAGE_70_80'][$ckey] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"STAGE_70_80");
				}

			sqlsrv_next_result($stmt1);
		}

		$csapp ='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_120_130"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){
				$csapp ='yes';	
				if(isset($prow1['STAGE_120_130'])){
					$ovhcount +=$prow1['STAGE_120_130'];
				$allhybridcountarr['STAGE_120_130'][$ckey] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['STAGE_120_130'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"STAGE_120_130");
				}
			}

			if($csapp=='no'){
				$ovhcount +=0;
				$allhybridcountarr['STAGE_120_130'][$ckey] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"STAGE_120_130");
				}

			sqlsrv_next_result($stmt1);
		}

		$csapp ='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_PICKING_YIELD"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){
				$csapp ='yes';	
				if(isset($prow1['STAGE_PICKING_YIELD'])){
					$ovhcount +=$prow1['STAGE_PICKING_YIELD'];
				$allhybridcountarr['STAGE_PICKING_YIELD'][$ckey] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['STAGE_PICKING_YIELD'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"STAGE_PICKING_YIELD");
				}
			}

			if($csapp=='no'){
				$ovhcount +=0;
				$allhybridcountarr['STAGE_PICKING_YIELD'][$ckey] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"STAGE_PICKING_YIELD");
				}

			sqlsrv_next_result($stmt1);
		}

			$csexe = 'no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_CLOSED"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){	
				$csexe = 'yes';
				if(isset($prow1['STAGE_CLOSED'])){
				$ovhcount +=$prow1['STAGE_CLOSED'];
				$allhybridcountarr['STAGE_CLOSED'][$ckey] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['STAGE_CLOSED'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"STAGE_CLOSED");
				}
			}

			if($csexe=='no'){
				$ovhcount +=0;
				$allhybridcountarr['STAGE_CLOSED'][$ckey] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"STAGE_CLOSED");
				}
		}

		if($ovhcount==0){
			unset($allhybridcountarr['SOWING'][$ckey]);
			unset($allhybridcountarr['STAGE_70_80'][$ckey]);
			unset($allhybridcountarr['STAGE_120_130'][$ckey]);
			unset($allhybridcountarr['STAGE_PICKING_YIELD'][$ckey]);
			unset($allhybridcountarr['STAGE_CLOSED'][$ckey]);
		}else{
			$ckey++;
		}

	}	
//p($allhybridcountarr,'e');
		$returnarr['series1'] = $allhybridcountarr;
		$returnarr['CP'] = 'HYBRID';
}
	
	//p($returnarr,'e');
	return $returnarr;
}

function ActivityWisesChart($data){
 global $conn;
 $returnarr = $actidarr = $activitywisearr = $activitydrilldown = $allactivitycountarr =$allsubactivity = array();

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

//p($data,'e');
if(isset($data['actall_code'])){
	$actall_code = explode(",", $data['actall_code']);
	foreach ($actall_code as $ACTIVITY) {
		$psql = "EXEC PDTrail_ActivityWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@activity='".@$ACTIVITY."'";
		//echo $psql;exit;
		 $stmt = sqlsrv_prepare($conn, $psql);
		sqlsrv_execute($stmt);
		$cspen = "no";
			if($data['required']=='All' || $data['required']=="" || $data['required']=="SOWING"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$cspen = "yes";
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['SOWING'])){
					$acevtcount= $prow['SOWING'];
					$allactivitycountarr['SOWING'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"SOWING");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}

				if($cspen=='no'){
					$allactivitycountarr['SOWING'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"SOWING");
				}

				sqlsrv_next_result($stmt);
			}

			$csapp='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_70_80"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csapp='yes';
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['STAGE_70_80'])){
					$acevtcount= $prow['STAGE_70_80'];
					$allactivitycountarr['STAGE_70_80'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"STAGE_70_80");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}
				if($csapp=='no'){
					$allactivitycountarr['STAGE_70_80'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"STAGE_70_80");
				}
				sqlsrv_next_result($stmt);
			}

			$csapp='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_120_130"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csapp='yes';
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['STAGE_120_130'])){
					$acevtcount= $prow['STAGE_120_130'];
					$allactivitycountarr['STAGE_120_130'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"STAGE_120_130");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}
				if($csapp=='no'){
					$allactivitycountarr['STAGE_120_130'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"STAGE_120_130");
				}
				sqlsrv_next_result($stmt);
			}

				$csapp='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_PICKING_YIELD"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csapp='yes';
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['STAGE_PICKING_YIELD'])){
					$acevtcount= $prow['STAGE_PICKING_YIELD'];
					$allactivitycountarr['STAGE_PICKING_YIELD'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"STAGE_PICKING_YIELD");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}
				if($csapp=='no'){
					$allactivitycountarr['STAGE_PICKING_YIELD'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"STAGE_PICKING_YIELD");
				}
				sqlsrv_next_result($stmt);
			}

			$csexe = 'no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="STAGE_CLOSED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csexe = 'yes';
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['STAGE_CLOSED'])){
					$acevtcount= $prow['STAGE_CLOSED'];
					$allactivitycountarr['STAGE_CLOSED'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"STAGE_CLOSED");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}
				if($csexe=='no'){
					$allactivitycountarr['STAGE_CLOSED'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"STAGE_CLOSED");
				}
			}
	}

	$returnarr['series1'] = $allactivitycountarr;
	$returnarr['CA'] = "ACTIVITY";
}else{
	$subactall_code = explode(",", $data['subactall_code']);
	foreach ($subactall_code as $SUBACTIVITY) {

			$psql1 = "EXEC SubActivityWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$ACTIVITY."',@subactivity='".@$SUBACTIVITY."'";
			//echo $psql1;exit;
			$stmt1 = sqlsrv_prepare($conn, $psql1);
			sqlsrv_execute($stmt1);
			$cspen = 'no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
				while($prow1 = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){	
					$cspen = 'yes';
					$sactivity = $prow1['ACTIVITYNAME'];
					if(isset($prow1['evtpending'])){
						$sacevtcount= $prow1['evtpending'];
						$allsubactivity['PENDING'][] = array("name"=>$sactivity,'y'=>$sacevtcount,"tname"=>$sactivity,"NID"=>$sactivity,"act"=>"PENDING");
					}
				}

				if($cspen=='no'){
					$allsubactivity['PENDING'][] = array("name"=>$SUBACTIVITY,'y'=>0,"tname"=>$SUBACTIVITY,"NID"=>$SUBACTIVITY,"act"=>"PENDING");
				}
					sqlsrv_next_result($stmt1);
			}
			$csapp ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){

				while($prow1 = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){	
					$csapp ='yes';
					$sactivity = $prow1['ACTIVITYNAME'];
					if(isset($prow1['evtapproved'])){
						$sacevtcount= $prow1['evtapproved'];
						$allsubactivity['APPROVED'][] =  array("name"=>$sactivity,'y'=>$sacevtcount,"tname"=>$sactivity,"NID"=>$sactivity,"act"=>"APPROVED");
					}
				}

				if($csapp=='no'){
					$allsubactivity['APPROVED'][] = array("name"=>$SUBACTIVITY,'y'=>0,"tname"=>$SUBACTIVITY,"NID"=>$SUBACTIVITY,"act"=>"APPROVED");
				}

				sqlsrv_next_result($stmt1);
		}
		$csexe ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
				while($prow1 = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){	
					$csexe ='yes';
				$sactivity = $prow1['ACTIVITYNAME'];
				if(isset($prow1['evtexecuted'])){
					$sacevtcount= $prow1['evtexecuted'];
					$allsubactivity['EXECUTED'][] = array("name"=>$sactivity,'y'=>$sacevtcount,"tname"=>$sactivity,"NID"=>$sactivity,"act"=>"EXECUTED");
				}
			}

			if($csexe=='no'){
					$allsubactivity['EXECUTED'][] = array("name"=>$SUBACTIVITY,'y'=>0,"tname"=>$SUBACTIVITY,"NID"=>$SUBACTIVITY,"act"=>"EXECUTED");
				}

		}
	}

		$returnarr['series1'] = $allsubactivity;
		$returnarr['CA'] = "SUBACTIVITY";
}
 
 
 return $returnarr;

}

function TrendChart($data){
	global $conn;
	 $returnarr = $trenddata = array();
	$psql = "EXEC TrendChartEvt @pdiv='".@$data['pdivision']."',@season='".@$data['season']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
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

