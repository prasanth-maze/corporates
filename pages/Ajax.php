<?php
include '../auto_load.php';
if(isset($_POST['Action'])){
	if($_POST['Action']=='Login'){
	$EmpCode=$_POST['emp_id'];
	$password=$_POST['password'];
    $EmpID="";
    $PoLocationName="";
    $PoLocationCode = "";
    $Token = '';

  /*  $sql =" SELECT POCODE,POHQNAME,POHQCODE FROM  ".$pohqtbl." where POCODE = '$EmpCode' and password='$password'";

     $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	 $row_count = sqlsrv_num_rows($res);
 	 $result = array();
 	if($row_count>0){
 		while($row = sqlsrv_fetch_array($res)){	
 			
 			$EmpID = $row['POCODE'];
 			$PoLocationName = $row['POHQNAME'];
 			$PoLocationCode = $row['POHQCODE'];
 			$Acting='Single';
			$Dcode = "PO";
 		}

 		$result = array('status'=>'ok','EmpCode'=>$EmpID,'PoLocationName'=>$PoLocationName);
 		 $_SESSION = $result;
 	}

*/
 
    $sql =" SELECT et.Recid,et.EmplId,et.DesignationCode FROM  ".$emptbl." AS et  where et.EmplId = '$EmpCode' and et.password='$password'";
 //echo $sql;exit;
	 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	 $row_count = sqlsrv_num_rows($res);
 	 $result = array();
 	if($row_count>0){
		while($row = sqlsrv_fetch_array($res)){	
		//echo "<pre>";print_r($row);exit;	
		$DesignationCode = $row['DesignationCode'];
		$EmpCode =$row['EmplId'];
		if ($EmpID==""){ 
			//CHECK EMPLOYEE IS TM
			$sql3 = "SELECT  tm.TMId,tm.TMName,EmplName from ".$tmtbl." as tm where  tm.EmplId = '$EmpCode' ";	
    		$res3 = sqlsrv_query($conn,$sql3); 
			while($row3 = sqlsrv_fetch_array($res3)){
			//p($row3,'e');
			$EmpID =$row3[0];
			$TMId =$row3[0];
			$TerritoryName = $row3[1];
			$EmpName = preg_replace("/[^a-zA-Z 0-9;( )-.]+/", "", $row3[2] );
			$Acting='Single';
			$Dcode = "TM";
		
			$sql31 = "SELECT TMNAME,REGIONID,ZONEID FROM ".$TRZMapping." WHERE TMId='$EmpID'  ";
			$res31 = sqlsrv_query($conn,$sql31); 
			 while($row31 = sqlsrv_fetch_array($res31)){
			 	$REGIONID = $row31[1];
			 	$ZONEID = $row31[2];
			 }


			 $result = array('status'=>'ok','EmpCode'=>$EmpCode,'EmpName'=>$EmpName,'TMId'=>$TMId,'TerritoryName'=>$TerritoryName,"Dcode"=>$Dcode,'Region'=>$REGIONID,'Zone'=>$ZONEID,'Acting'=>$Acting);
			 $_SESSION = $result;
			 //p($_SESSION,'e');
			 //CHECK TM IS RBM
		    $sql35 = "select RegionId,RegionName,EmplName  from ".$regtbl." where RBMId = '$EmpCode' ";
		//echo $sql35;exit;
			 $res35 = sqlsrv_query($conn,$sql35);
			 while($row35 = sqlsrv_fetch_array($res35)){
				$EmpID =$row35[0];
				$RegionId =$row35[0];
				$RegionName=$row35[1];
				$EmpName = preg_replace("/[^a-zA-Z 0-9;( )-.]+/", "", $row35[2] );
				$Acting = 'Dual';
				$Dcode = "RBM";

				$sql31 = "SELECT TOP(1) TMNAME,REGIONID,ZONEID FROM ".$TRZMapping." WHERE RegionId='$EmpID'  ";
			//echo $sql31;exit;
				$res31 = sqlsrv_query($conn,$sql31); 
				 while($row31 = sqlsrv_fetch_array($res31)){
				 	$REGIONID = $row31[1];
				 	$ZONEID = $row31[2];
				 }

				 $result = array('status'=>'ok','EmpCode'=>$EmpCode,'EmpName'=>$EmpName,'RegionId'=>$RegionId,'RegionName'=>$RegionName,"Dcode"=>$Dcode,'Region'=>$REGIONID,'Zone'=>$ZONEID,'Acting'=>$Acting);
				 $_SESSION = $result;
				 //p($result,'e');

			 //CHECK RBM IS ZM
				$sql10 = "select ZoneId,ZoneName,DBMName from ".$zmtbl." where  DBMId = '$EmpCode' ";
		    	$res71 = sqlsrv_query($conn,$sql10); 
			 	  
				while($row71 = sqlsrv_fetch_array($res71)){
					$EmpID =$row71[0];
					$ZoneId =$row71[0];
					$ZoneName =$row71[1];
					$EmpName = preg_replace("/[^a-zA-Z 0-9;( )-.]+/", "", $row71[2] );
					$Acting = 'Trible';
					$Dcode = "ZM";

					$result = array('status'=>'ok','EmpCode'=>$EmpCode,'EmpName'=>$EmpName,'ZoneId'=>$ZoneId,'ZoneName'=>$ZoneName,"Dcode"=>$Dcode,'Zone'=>$ZONEID,'Acting'=>$Acting);
				 	$_SESSION = $result;

			}

		}	
	}
}

	
	if($EmpID=="")
	{
		//CHECK EMPLOYEE IS RBM
	 $sql35 = "select RegionId,RegionName,EmplName  from ".$regtbl." where RBMId = '$EmpCode' ";

     $res35 = sqlsrv_query($conn,$sql35);
	 	 
	while($row35 = sqlsrv_fetch_array($res35)){
		
		$EmpID =$row35[0];
		$RegionId =$row35[0];
		$RegionName=$row35[1];
		$EmpName = preg_replace("/[^a-zA-Z 0-9;( )-.]+/", "", $row35[2] );
		$Dcode = "RBM";
		$Acting = "Single";


		$sql31 = "SELECT TOP(1) TMNAME,REGIONID,ZONEID FROM ".$TRZMapping." WHERE RegionId='$EmpID'  ";
	//echo $sql31;exit;
		$res31 = sqlsrv_query($conn,$sql31); 
		 while($row31 = sqlsrv_fetch_array($res31)){
		 	$REGIONID = $row31[1];
		 	$ZONEID = $row31[2];
		 }

		$result = array('status'=>'ok','EmpCode'=>$EmpCode,'EmpName'=>$EmpName,'RegionId'=>$RegionId,'RegionName'=>$RegionName,"Dcode"=>$Dcode,'Region'=>$REGIONID,'Zone'=>$ZONEID,'Acting'=>$Acting);
		$_SESSION = $result;
		//CHECK RBM IS ZM
		$sql10 = "select ZoneId,ZoneName,DBMName from ".$zmtbl." where  DBMId = '$EmpCode' ";
	    $res71 = sqlsrv_query($conn,$sql10); 
	 	  
			while($row71 = sqlsrv_fetch_array($res71)){
				$EmpID =$row71[0];
				$ZoneId =$ZoneId[0];
				$ZoneName =$row71[1];
				$EmpName = preg_replace("/[^a-zA-Z 0-9;( )-.]+/", "", $row71[2] );
				$Acting = 'Dual';
				$Dcode = "ZM";
				$result = array('status'=>'ok','EmpCode'=>$EmpCode,'EmpName'=>$EmpName,'ZoneId'=>$ZoneId,'RegionName'=>$ZoneName,"Dcode"=>$Dcode,'Region'=>$REGIONID,'Zone'=>$ZONEID,'Acting'=>$Acting);
				$_SESSION = $result;

			}

		}
	}
	
	if ($EmpID==""){
	   		
			 $sql10 = "select ZoneId,ZoneName,DBMName from ".$zmtbl." where  DBMId = '$EmpCode'";
		     $res71 = sqlsrv_query($conn,$sql10); 
			 	  
			while($row71 = sqlsrv_fetch_array($res71)){
				$EmpID =$row71[0];
				$ZoneId =$row71[0];
				$ZoneName =$row71[1];
				$EmpName = preg_replace("/[^a-zA-Z 0-9;( )-.]+/", "", $row71[2] );
				$Acting = 'Single';
				$Dcode = "ZM";

				$sql31 = "SELECT TOP(1) TMNAME,REGIONID,ZONEID FROM ".$TRZMapping." WHERE ZoneId='$EmpID'  ";
				//echo $sql31;exit;
					$res31 = sqlsrv_query($conn,$sql31); 
					 while($row31 = sqlsrv_fetch_array($res31)){
					 	$REGIONID = $row31[1];
					 	$ZONEID = $row31[2];
					 }

				$result = array('status'=>'ok','EmpCode'=>$EmpCode,'EmpName'=>$EmpName,'ZoneId'=>$ZoneId,'ZoneName'=>$ZoneName,"Dcode"=>$Dcode,'Zone'=>$ZONEID,'Acting'=>$Acting);
				 	$_SESSION = $result;

			}
	
	}

		}
	}else{
		$result = array('status'=>'failed');
	}

	echo json_encode($result);
 }
	
}
?>