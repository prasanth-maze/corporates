<?php
	include '../auto_load.php';
	$resp = array();
		$data = array();
	if(isset($_POST['seriesdata'])){
		if($_SESSION['Dcode']=='TM' && $_SESSION['Acting']=='Single'){
            $posql = "SELECT * FROM ".$pohqtbl." WHERE TMId='".$_SESSION['TMId']."' ";
            $res = sqlsrv_query($conn,$posql,array(), array( "Scrollable" => 'static' ));
            $porowc = sqlsrv_num_rows($res);
            if($porowc>0){
                while($porow = sqlsrv_fetch_array($res)){ 
                	$po = $porow['POCODE'];
					if(isset($_POST['pocode']) && $_POST['pocode']!='all'){
						if($po==$_POST['pocode']){
							$poesql = "SELECT * FROM ".$eventtbl." WHERE POCODE='".$po."' ";
							if(isset($_POST['atype']) && $_POST['atype']!='all'){
								$poesql .= " AND Type='".$_POST['atype']."' ";
							}

							if(isset($_POST['status']) && $_POST['status']!='all'){
								$poesql .= "AND OpenCloseStatus='".$_POST['status']."'" ;
							}
								$res1 = sqlsrv_query($conn,$poesql,array(), array( "Scrollable" => 'static' ));
							$num = sqlsrv_num_rows($res1);
		            		$data[] = array("name"=>$po,"y"=>$num,"drilldown"=> $po);
		                	
		                }
					}else{
						$poesql = "SELECT * FROM ".$eventtbl." WHERE POCODE='".$po."' ";
						if(isset($_POST['atype']) && $_POST['atype']!='all'){
								$poesql .= " AND Type='".$_POST['atype']."' ";
							}

						if(isset($_POST['status']) && $_POST['status']!='all'){
							$poesql .= "AND OpenCloseStatus='".$_POST['status']."'" ;
						}		
							$res1 = sqlsrv_query($conn,$poesql,array(), array( "Scrollable" => 'static' ));
	                	$num = sqlsrv_num_rows($res1);
	                	$data[] = array("name"=>$po,"y"=>$num,"drilldown"=> $po);
					}
                	
                }
             }
		}
	}else{

		if(isset($_POST['level'])){
			if($_SESSION['Dcode']=='TM' && $_SESSION['Acting']=='Single'){
            $posql = "SELECT * FROM ".$pohqtbl." WHERE TMId='".$_SESSION['TMId']."' ";
            $res = sqlsrv_query($conn,$posql,array(), array( "Scrollable" => 'static' ));
            $porowc = sqlsrv_num_rows($res);
            $fopen = $fclose =  0;
            if($porowc>0){
            	$fopen =0;
                while($porow = sqlsrv_fetch_array($res)){ 
                	$po = $porow['POCODE'];
					if(isset($_POST['pocode']) && $_POST['pocode']!='all'){
						if($po==$_POST['pocode']){
							$poesql = "SELECT * FROM ".$eventtbl." WHERE POCODE='".$po."' ";
							$fsql = $poesql;
							$nfsql = $poesql;
							if(isset($_POST['atype'])){
								if($_POST['atype']=='all' || $_POST['atype']=='Financial'){
									$fsql .= " AND Type='Financial' ";

									if(isset($_POST['status'])){
										if($_POST['status']=='OPEN'){
											$fsql .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$fsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Financial','y'=>$num,'drilldown'=>'Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'OPEN','y'=>$num);
			            					}
										}else  if($_POST['status']=='CLOSE'){
											$fsql .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$fsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Financial','y'=>$num,'drilldown'=>'Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'CLOSE','y'=>$num);
			            					}
										}else{
											$poesqloc = $fsql;
											$poesqloc .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num1 = sqlsrv_num_rows($res1);
											$poesqloc = $fsql;

											$poesqloc .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num2 = sqlsrv_num_rows($res1);
											$tot = $num1+$num2;
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Financial','y'=>$tot,'drilldown'=>'Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$fopen += $num1;
			            						$fclose += $num2;
			            						//$data[] =  array('name'=>'OPEN','y'=>$num1);
			            						//$data[] =  array('name'=>'CLOSE','y'=>$num2);
			            					}

										}
									}							   
							 }

								if($_POST['atype']=='all' || $_POST['atype']=='Non-Financial'){
									$nfsql .= " AND Type='Non-Financial' ";

									if(isset($_POST['status'])){
										if($_POST['status']=='OPEN'){
											$nfsql .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$nfsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Non-Financial','y'=>$num,'drilldown'=>'Non-Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'OPEN','y'=>$num);
			            					}
										}else  if($_POST['status']=='CLOSE'){
											$nfsql .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$nfsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Non-Financial','y'=>$num,'drilldown'=>'Non-Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'CLOSE','y'=>$num);
			            					}
										}else{
											$poesqloc = $nfsql;
											$poesqloc .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num1 = sqlsrv_num_rows($res1);
											$poesqloc = $nfsql;

											$poesqloc .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num2 = sqlsrv_num_rows($res1);
											$tot = $num1+$num2;
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Non-Financial','y'=>$tot,'drilldown'=>'Non-Financial');
				            					}
			            					if($_POST['level']==3){		            			
			            						$fopen += $num1;
			            						$fclose += $num2;
			            						/*$data[] =  array('name'=>'OPEN','y'=>$num1);
			            						$data[] =  array('name'=>'CLOSE','y'=>$num2);*/
			            					}

										}
									}				
								}

							}
		                }
					}else{
							$poesql = "SELECT * FROM ".$eventtbl." WHERE POCODE='".$po."' ";
							$fsql = $poesql;
							$nfsql = $poesql;
							if(isset($_POST['atype'])){
								if($_POST['atype']=='all' || $_POST['atype']=='Financial'){
									$fsql .= " AND Type='Financial' ";

									if(isset($_POST['status'])){
										if($_POST['status']=='OPEN'){
											$fsql .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$fsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Financial','y'=>$num,'drilldown'=>'Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'OPEN','y'=>$num);
			            					}
										}else  if($_POST['status']=='CLOSE'){
											$fsql .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$fsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Financial','y'=>$num,'drilldown'=>'Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'CLOSE','y'=>$num);
			            					}
										}else{
											$poesqloc = $fsql;
											$poesqloc .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num1 = sqlsrv_num_rows($res1);
											$poesqloc = $fsql;

											$poesqloc .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num2 = sqlsrv_num_rows($res1);
											$tot = $num1+$num2;
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Financial','y'=>$tot,'drilldown'=>'Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$fopen += $num1;
			            						$fclose += $num2;
			            						//$data[] =  array('name'=>'OPEN','y'=>$num1);
			            						//$data[] =  array('name'=>'CLOSE','y'=>$num2);
			            					}

										}
									}							   
							 }

								if($_POST['atype']=='all' || $_POST['atype']=='Non-Financial'){
									$nfsql .= " AND Type='Non-Financial' ";

									if(isset($_POST['status'])){
										if($_POST['status']=='OPEN'){
											$nfsql .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$nfsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Non-Financial','y'=>$num,'drilldown'=>'Non-Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'OPEN','y'=>$num);
			            					}
										}else  if($_POST['status']=='CLOSE'){
											$nfsql .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$nfsql,array(), array("Scrollable" => 'static' ));
											$num = sqlsrv_num_rows($res1);
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Non-Financial','y'=>$num,'drilldown'=>'Non-Financial');
				            					}
			            					if($_POST['level']==3){	
			            						$data[] =  array('name'=>'CLOSE','y'=>$num);
			            					}
										}else{
											$poesqloc = $nfsql;
											$poesqloc .= " AND OpenCloseStatus='OPEN' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num1 = sqlsrv_num_rows($res1);
											$poesqloc = $nfsql;

											$poesqloc .= " AND OpenCloseStatus='CLOSE' ";
											$res1 = sqlsrv_query($conn,$poesqloc,array(), array("Scrollable" => 'static' ));
											$num2 = sqlsrv_num_rows($res1);
											$tot = $num1+$num2;
											if($_POST['level']==2){								
				            					$data[] =  array('name'=>'Non-Financial','y'=>$tot,'drilldown'=>'Non-Financial');
				            					}
			            					if($_POST['level']==3){		            			
			            						$fopen += $num1;
			            						$fclose += $num2;
			            						/*$data[] =  array('name'=>'OPEN','y'=>$num1);
			            						$data[] =  array('name'=>'CLOSE','y'=>$num2);*/
			            					}

										}
									}				
								}

							}
		                
						
					}                	
                }

                if($_POST['status']=='all'){
	                if($_POST['level']==3){	
	                	$data = array();
						$data[] =  array('name'=>'OPEN','y'=>$fopen);
						$data[] =  array('name'=>'Close','y'=>$fclose);
					}
				}
             }
		}
		}
}
	
   	echo json_encode($data);
?>