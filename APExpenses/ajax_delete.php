<?php 
include '../auto_load.php';
$_SESSION['EmpID'];   // Employee id
$_SESSION['status'];  // Status = 0
$_SESSION['Dcode'];   // Dcode -- Designation Code
$_SESSION['Name'];    // Name of emp
$_SESSION['finRights'];  // finRights  = 0 or 1

$action_type = $_REQUEST['action_type'];

if($action_type == 'DELETE_ADV_REQ_EACH' && $_REQUEST['AdvAmtid'] != ''){
    $updatedon=date("Y-m-d H:i:s");
    $updatedby      = $_SESSION['EmpID'];
    $AdvAmtid      = $_REQUEST['AdvAmtid'];
		$qry_update=sqlsrv_query($conn,"UPDATE ANP_Advance_Amount SET CurrentStatus='0',ModifiedBy='$updatedby',ModifiedAt='$updatedon' WHERE Id='$AdvAmtid'");
    if($qry_update){	
      echo "1"; 
    }else{
      echo "0";
    }
}



?>