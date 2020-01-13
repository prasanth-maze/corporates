<?php
//error_reporting(0);
session_start();
//mssql_connect();exit;


$http_server = $_SERVER['HTTP_HOST'];
if($http_server=='192.168.35.40' || $http_server=='localhost:8080'){
	$serverName = "DESKTOP-ROEBQ2V\RAASI";
	$connectionInfo = array("Database"=>"ANPAndroid","UID"=>"sa","PWD"=>"123");
	$host = $http_server.'/rasi_seeds/';
}else{
	$serverName = "RASISEEDS\SQLEXPRESS";
	$connectionInfo = array( "Database"=>"ANPAndroid", "UID"=>"sa", "PWD"=>"Rasi@Jun2018" ); 
	$http_server.'/Corporate/';
}

$DOCUMENT_ROOT =  $_SERVER['DOCUMENT_ROOT'].'/Corporate/';
	
//echo $serverName;exit;
$conn = sqlsrv_connect( $serverName, $connectionInfo);
//var_dump($conn);exit;
if( $conn ) {
    // echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

 date_default_timezone_set('Asia/Kolkata');

 include $DOCUMENT_ROOT.'Globals.php';

 
function p($arr,$e=''){
	echo "<pre>";print_r($arr);
	if($e!=''){
		exit;
	}
}

/*$sql = "EXEC eventReport";
$stmt = sqlsrv_prepare($conn, $sql);
sqlsrv_execute($stmt);
while($row = sqlsrv_fetch_array($stmt)){
    p($row);
}
exit;*/
?>