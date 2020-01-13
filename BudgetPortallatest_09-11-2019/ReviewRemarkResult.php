<?php
include '../auto_load.php';
global $conn;
global $budgetCmntTable;
$Result = array();
$sql = "SELECT comments FROM ".$budgetCmntTable." ";
//echo $sql1;exit;
$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
	while($row= sqlsrv_fetch_array($res)){ 
		$Result[] = $row['comments'];
	}
echo json_encode($Result);
?>