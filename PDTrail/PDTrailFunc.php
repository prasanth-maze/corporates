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
	
	$psql = "EXEC zmLocWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$ZMID."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
		//echo $psql;exit;
			$stmt = sqlsrv_prepare($conn, $psql);
			sqlsrv_execute($stmt);
			$cspen = "no";
			if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
			while($prow = sqlsrv_fetch_array($stmt)){	
				$cspen='yes';
					$zmid = $prow['ZONENAME'];
					$zid = $prow['ZONEID'];
					if(isset($prow['evtpending'])){
						$zevtcount= $prow['evtpending'];
						$zmcountarr['PENDING'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"PENDING");
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

					$zmcountarr['PENDING'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"PENDING");
				}

				sqlsrv_next_result($stmt);
			}
			$csapp ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){
				while($prow = sqlsrv_fetch_array($stmt)){		
				$csapp ='yes';	
					$zmid = $prow['ZONENAME'];
				    $zid = $prow['ZONEID'];
					if(isset($prow['evtapproved'])){
						$zevtcount= $prow['evtapproved'];
						$zmcountarr['APPROVED'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"APPROVED");
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

					$zmcountarr['APPROVED'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"APPROVED");
				}

				sqlsrv_next_result($stmt);
			}

			$csexe = 'no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
				$csexe = 'yes';		
					$zmid = $prow['ZONENAME'];
					$zid = $prow['ZONEID'];									
					if(isset($prow['evtexecuted'])){
						$zevtcount= $prow['evtexecuted'];
						$zmcountarr['EXECUTED'][] = array("name"=>$zmid."<span style='display:none'>".$zid."</span>","y"=>$zevtcount,"tname"=>$zmid,"NID"=>$zid,"act"=>"EXECUTED","fc"=>(int)$prow['FARMERSCOVERED'],"vc"=>(int)$prow['VILLAGESCOVERED'],'dc'=>(int)$prow['DEALERSCOVERED']);
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

					$zmcountarr['EXECUTED'][] = array("name"=>$zmname."<span style='display:none'>".$ZMID."</span>","y"=>0,"tname"=>$zmname,"NID"=>$ZMID,"act"=>"EXECUTED","fc"=>0,"vc"=>0,'dc'=>0);
				}

			}
		}

//p($zmcountarr,'e');
				$returnarr['series1'] = $zmcountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
				$returnarr['CL'] = "ZM";
}else if(isset($data['rbmall_code'])){

	foreach (@$rbmall_code as  $REGIONID) {

	$psql = "EXEC rbmLocWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='',@rbmcode='".@$REGIONID."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
			 	
			 	$stmt = sqlsrv_prepare($conn, $psql);
				sqlsrv_execute($stmt);
				$cspen = "no";
				if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
					
				while($prow = sqlsrv_fetch_array($stmt)){
					$cspen	= 'yes';
					$regid = $prow['REGIONNAME'];
					$rid = $prow['REGIONID'];
					if(isset($prow['evtpending'])){
						$revtcount= $prow['evtpending'];
						$rdrilldown = $regid.'PEND';
						$rbecountarr['PENDING'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"PENDING");
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

				$rbecountarr['PENDING'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"PENDING");
			}

				sqlsrv_next_result($stmt);
			}

			$csapp = 'no';

			if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){

				while($prow = sqlsrv_fetch_array($stmt)){
				$csapp = 'yes';
					$regid = $prow['REGIONNAME'];
				    $rid = $prow['REGIONID'];
					if(isset($prow['evtapproved'])){
						$revtcount= $prow['evtapproved'];
						$rdrilldown = $regid.'APP';
						$rbecountarr['APPROVED'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"APPROVED");
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
					
					$rbecountarr['APPROVED'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"APPROVED");
			}

				sqlsrv_next_result($stmt);

			}
			$csexe='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
				$csexe='yes';
					$regid = $prow['REGIONNAME'];
					$rid = $prow['REGIONID'];									
					if(isset($prow['evtexecuted'])){
						$revtcount= $prow['evtexecuted'];
						$rdrilldown = $regid.'EXEC';
						$rbecountarr['EXECUTED'][] = array("name"=>$regid."<span style='display:none'>".$rid."</span>","y"=>$revtcount,"tname"=>$regid,"NID"=>$rid,"act"=>"EXECUTED","fc"=>(int)$prow['FARMERSCOVERED'],"vc"=>(int)$prow['VILLAGESCOVERED'],'dc'=>(int)$prow['DEALERSCOVERED']);
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
					
					$rbecountarr['EXECUTED'][] = array("name"=>$rname."<span style='display:none'>".$REGIONID."</span>","y"=>0,"tname"=>$rname,"NID"=>$REGIONID,"act"=>"EXECUTED","fc"=>0,"vc"=>0,'dc'=>0);
			}
				}
			}
			//p($rbecountarr,'e');
				$returnarr['series1'] = $rbecountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
				$returnarr['CL'] = "RBM";
}elseif(isset($data['tmall_code'])){
	foreach ($tmall_code as $TMID){

		$psql1 = "EXEC tmLocWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='',@rbmcode='',@tmcode='".$TMID."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
		//echo $psql1;exit;
					$stmt1 = sqlsrv_prepare($conn, $psql1);
					sqlsrv_execute($stmt1);
					$cspen = 'no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
				if($data['atype']=='All' || $data['atype']=='' || $data['atype']=='Financial'){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$cspen = 'yes';
						$tmid = $prow1['TMNAME'].'-F';
						$tid = $prow1['TMID'];
						if(isset($prow1['evtpending'])){
						$tevtcount= $prow1['evtpending'];						
						$alltmcountarr['PENDING'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span><span style='display:none'>Financial</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"PENDING");

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

					$alltmcountarr['PENDING'][] =  array("name"=>$tname."-F<span style='display:none'>".$TMID."</span><span style='display:none'>Financial</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"PENDING");
					}

					sqlsrv_next_result($stmt1);
				}


				if($data['atype']=='All' || $data['atype']=='' || $data['atype']=='Non-Financial'){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$cspen = 'yes';
						$tmid = $prow1['TMNAME'].'-NF';
						$tid = $prow1['TMID'];
						if(isset($prow1['evtpending'])){
						$tevtcount= $prow1['evtpending'];						
						$alltmcountarr['PENDING'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span><span style='display:none'>Non-Financial</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"PENDING");

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

					$alltmcountarr['PENDING'][] =  array("name"=>$tname."-NF<span style='display:none'>".$TMID."</span><span style='display:none'>Non-Financial</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"PENDING");
					}

					sqlsrv_next_result($stmt1);
				}

				//p($alltmcountarr,'e');
					
				}
				$csapp = 'no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){
					if($data['atype']=='All' || $data['atype']=='' || $data['atype']=='Financial'){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csapp = 'yes';
						$tmid = $prow1['TMNAME'].'-F';
						$tid = $prow1['TMID'];
						if(isset($prow1['evtapproved'])){
						$tevtcount= $prow1['evtapproved'];
						$alltmcountarr['APPROVED'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span><span style='display:none'>Financial</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"APPROVED");
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

					$alltmcountarr['APPROVED'][] =  array("name"=>$tname."-F<span style='display:none'>".$TMID."</span><span style='display:none'>Financial</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"APPROVED");
					}
					sqlsrv_next_result($stmt1);

					}

					if($data['atype']=='All' || $data['atype']=='' || $data['atype']=='Non-Financial'){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csapp = 'yes';
						$tmid = $prow1['TMNAME'].'-NF';
						$tid = $prow1['TMID'];
						if(isset($prow1['evtapproved'])){
						$tevtcount= $prow1['evtapproved'];
						$alltmcountarr['APPROVED'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span><span style='display:none'>Non-Financial</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"APPROVED");
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

					$alltmcountarr['APPROVED'][] =  array("name"=>$tname."-NF<span style='display:none'>".$TMID."</span><span style='display:none'>Non-Financial</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"APPROVED");
					}
					sqlsrv_next_result($stmt1);

					}
				}
				$csexe ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
				if($data['atype']=='All' || $data['atype']=='' || $data['atype']=='Financial'){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csexe ='yes';
						$tmid = $prow1['TMNAME'].'-F';
						$tid = $prow1['TMID'];
						if(isset($prow1['evtexecuted'])){
						$tevtcount= $prow1['evtexecuted'];
						$alltmcountarr['EXECUTED'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span><span style='display:none'>Financial</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"EXECUTED","fc"=>(int)$prow1['FARMERSCOVERED'],"vc"=>(int)$prow1['VILLAGESCOVERED'],'dc'=>(int)$prow1['DEALERSCOVERED']);
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

					$alltmcountarr['EXECUTED'][] =  array("name"=>$tname."-F<span style='display:none'>".$TMID."</span><span style='display:none'>Financial</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"EXECUTED","fc"=>0,"vc"=>0,'dc'=>0);
					}
					sqlsrv_next_result($stmt1);
				}

				if($data['atype']=='All' || $data['atype']=='' || $data['atype']=='Non-Financial'){
					while($prow1 = sqlsrv_fetch_array($stmt1)){	
						$csexe ='yes';
						$tmid = $prow1['TMNAME'].'-NF';
						$tid = $prow1['TMID'];
						if(isset($prow1['evtexecuted'])){
						$tevtcount= $prow1['evtexecuted'];
						$alltmcountarr['EXECUTED'][] =  array("name"=>$tmid."<span style='display:none'>".$tid."</span><span style='display:none'>Non-Financial</span>","y"=>$tevtcount,"tname"=>$tmid,"NID"=>$tid,"act"=>"EXECUTED","fc"=>(int)$prow1['FARMERSCOVERED'],"vc"=>(int)$prow1['VILLAGESCOVERED'],'dc'=>(int)$prow1['DEALERSCOVERED']);
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

					$alltmcountarr['EXECUTED'][] =  array("name"=>$tname."-NF<span style='display:none'>".$TMID."</span><span style='display:none'>Non-Financial</span>","y"=>0,"tname"=>$tname,"NID"=>$TMID,"act"=>"EXECUTED","fc"=>0,"vc"=>0,'dc'=>0);
					}
					sqlsrv_next_result($stmt1);
				}
			}
	}
	//p($alltmcountarr,'e');
	$returnarr['series1'] = $alltmcountarr;
					//$returnarr['locseriesfor'] = array('series1'=>'ZM');
	$returnarr['CL'] = "TM";
}else{
	
	foreach ($poall_code as $POCODE) {
	
	$psql2 = "EXEC pohqWiseEvt @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='',@rbmcode='',@tmcode='',@pocode='".@$POCODE."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
	//echo $psql2;
					$stmt2 = sqlsrv_prepare($conn, $psql2);

					sqlsrv_execute($stmt2);
					$cspen='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
						while($prow2 = sqlsrv_fetch_array($stmt2)){	
							$cspen='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['evtpending'])){
							$poevtcount= $prow2['evtpending'];
							$allpocountarr['PENDING'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"PENDING");
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

					$allpocountarr['PENDING'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"PENDING");
					}

					sqlsrv_next_result($stmt2);
				}
					$csapp='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){
					while($prow2 = sqlsrv_fetch_array($stmt2)){	
						$csapp='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['evtapproved'])){
						$poevtcount= $prow2['evtapproved'];
						$allpocountarr['APPROVED'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"APPROVED");
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

					$allpocountarr['APPROVED'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"APPROVED");
					}
					sqlsrv_next_result($stmt2);
				}

				$csexe='no';
				if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){

					while($prow2 = sqlsrv_fetch_array($stmt2)){	
						$csexe='yes';
						$poid = $prow2['POHQNAME'];
						$pid = $prow2['POHQCODE'];
						if(isset($prow2['evtexecuted'])){
						$poevtcount= $prow2['evtexecuted'];
						$allpocountarr['EXECUTED'][] =  array("name"=>$poid."<span style='display:none'>".$pid."</span>","y"=>$poevtcount,"tname"=>$poid,"NID"=>$poid,"act"=>"EXECUTED","fc"=>(int)$prow2['FARMERSCOVERED'],"vc"=>(int)$prow2['VILLAGESCOVERED'],'dc'=>(int)$prow2['DEALERSCOVERED']);
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

					$allpocountarr['EXECUTED'][] =  array("name"=>$poname."<span style='display:none'>".$POCODE."</span>","y"=>0,"tname"=>$poname,"NID"=>$poname,"act"=>"EXECUTED","fc"=>0,"vc"=>0,'dc'=>0);
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
	 $psql = "EXEC ProductWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$PRODUCT."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
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

 

	foreach($hyball_code AS $HYBRID){
		$psql1 = "EXEC HybridWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".$data['product']."',@hybrid='".@$HYBRID."',@atype='".@$data['atype']."',@activity='".$data['activity']."',@subactivity='".@$data['subactivity']."'";

		$stmt1 = sqlsrv_prepare($conn, $psql1);
			 sqlsrv_execute($stmt1);
			 $cspen ='no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){	
				 $cspen ='yes';
				if(isset($prow1['evtpending'])){
				
				$allhybridcountarr['PENDING'][] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['evtpending'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"PENDING");
				}
			}
				if($cspen=='no'){
					$allhybridcountarr['PENDING'][] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"PENDING");
				}


			sqlsrv_next_result($stmt1);
		}

		$csapp ='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){
				$csapp ='yes';	
				if(isset($prow1['evtapproved'])){
				$allhybridcountarr['APPROVED'][] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['evtapproved'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"APPROVED");
				}
			}

			if($csapp=='no'){
				$allhybridcountarr['APPROVED'][] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"APPROVED");
				}

			sqlsrv_next_result($stmt1);
		}

			$csexe = 'no';
			if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
			while($prow1 = sqlsrv_fetch_array($stmt1)){	
				$csexe = 'yes';
				if(isset($prow1['evtexecuted'])){
				
				$allhybridcountarr['EXECUTED'][] = array("name"=>$prow1['HYBRIDNAME'],'y'=>$prow1['evtexecuted'],"tname"=>$prow1['HYBRIDNAME'],"NID"=>$prow1['HYBRIDNAME'],"act"=>"EXECUTED");
				}
			}

			if($csexe=='no'){
				$allhybridcountarr['EXECUTED'][] = array("name"=>$HYBRID,'y'=>0,"tname"=>$HYBRID,"NID"=>$HYBRID,"act"=>"EXECUTED");
				}
		}

	}	

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
		$psql = "EXEC ActivityWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$ACTIVITY."',@subactivity='".@$data['subactivity']."'";
		 $stmt = sqlsrv_prepare($conn, $psql);
		sqlsrv_execute($stmt);
		$cspen = "no";
			if($data['required']=='All' || $data['required']=="" || $data['required']=="PENDING"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$cspen = "yes";
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['evtpending'])){
					$acevtcount= $prow['evtpending'];
					$adrilldown = $activity.'PEND';
					$allactivitycountarr['PENDING'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"PENDING");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}

				if($cspen=='no'){
					$allactivitycountarr['PENDING'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"PENDING");
				}

				sqlsrv_next_result($stmt);
			}

			$csapp='no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="APPROVED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csapp='yes';
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['evtapproved'])){
					$acevtcount= $prow['evtapproved'];
					$adrilldown = $activity.'APP';
					$allactivitycountarr['APPROVED'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"APPROVED");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}
				if($csapp=='no'){
					$allactivitycountarr['APPROVED'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"APPROVED");
				}
				sqlsrv_next_result($stmt);
			}

			$csexe = 'no';
		if($data['required']=='All' || $data['required']=="" || $data['required']=="EXECUTED"){
				while($prow = sqlsrv_fetch_array($stmt)){	
					$csexe = 'yes';
					$activity = $prow['ACTIVITYTYPE'];
					if(isset($prow['evtexecuted'])){
					$acevtcount= $prow['evtexecuted'];
					$allactivitycountarr['EXECUTED'][] =  array("name"=>$activity,"y"=>$acevtcount,"tname"=>$activity,'NID'=>$activity,"act"=>"EXECUTED");
						if(!in_array($activity, $actidarr)){
							$actidarr[] = $activity;
						}
					}
				}
				if($csexe=='no'){
					$allactivitycountarr['EXECUTED'][] =  array("name"=>$ACTIVITY,"y"=>0,"tname"=>$ACTIVITY,'NID'=>$ACTIVITY,"act"=>"EXECUTED");
				}
			}
	}

	$returnarr['series1'] = $allactivitycountarr;
	$returnarr['CA'] = "ACTIVITY";
}else{
	$subactall_code = explode(",", $data['subactall_code']);
	foreach ($subactall_code as $SUBACTIVITY) {

			$psql1 = "EXEC SubActivityWiseEvtChart @required='".$data['required']."',@pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$ezmcode."',@rbmcode='".@$erbmcode."',@tmcode='".@$etmcode."',@pocode='".@$epocode."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$ACTIVITY."',@subactivity='".@$SUBACTIVITY."'";
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
	$psql = "EXEC TrendChartEvt @pdiv='".@$data['pdivision']."',@fromdate='".@$data['fromdate']."',@todate='".@$data['todate']."',@zcode='".@$data['zmLocation']."',@rbmcode='".@$data['rbmLocation']."',@tmcode='".@$data['tmlocation']."',@pocode='".@$data['polocation']."',@product='".@$data['product']."',@hybrid='".@$data['hybrid']."',@atype='".@$data['atype']."',@activity='".@$data['activity']."',@subactivity='".@$data['subactivity']."'";
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

