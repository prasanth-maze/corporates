<?php 

if($_SESSION['Dcode'] == 'ZM'){
  $divsion =sqlsrv_query($conn,"SELECT DISTINCT ZONEID,ZONENAME  FROM RASI_ZONETABLE WHERE DBMID='".$_SESSION['EmpID']."'");
}elseif($_SESSION['Dcode'] == 'RBM'){
    $sql ="SELECT REGIONID FROM  RASI_REGIONTABLE WHERE RBMID='".$_SESSION['EmpID']."'";
    $res = sqlsrv_query($conn,$sql);
    $row_count = sqlsrv_fetch_array($res);
    $sqls ="SELECT TOP 1 ZONEID FROM RASI_TRZMAPPINGTABLE WHERE REGIONID='".$req_id."'";
    $ress = sqlsrv_query($conn,$sqls);
    $row_counts = sqlsrv_fetch_array($ress);
    $zone_ids = $row_counts['ZONEID'];
    
    $zone_det ="SELECT TOP 1 ZONENAME FROM RASI_ZONETABLE WHERE ZONEID='".$zone_ids."'";
    $zoneqer = sqlsrv_query($conn,$zone_det);
    $zone_counts = sqlsrv_fetch_array($zoneqer);
    $zone_name = $zone_counts['ZONENAME'];
}elseif($_SESSION['Dcode'] == 'TM'){
    $tztable =sqlsrv_query($conn,"SELECT TOP 1 TMID FROM RASI_TMTABLE WHERE EMPLID='".$_SESSION['EmpID']."'");
    $row_tm = sqlsrv_fetch_array($tztable);
    $TMID_id = $row_tm['TMID'];

    $ress = sqlsrv_query($conn,"SELECT TOP 1 REGIONID,ZONEID FROM RASI_TRZMAPPINGTABLE WHERE TMID='".$TMID_id."'");
    $row_counts = sqlsrv_fetch_array($ress);
    $zone_ids   = $row_counts['ZONEID'];
    $region_ids = $row_counts['REGIONID'];
    
    $sql ="SELECT TOP 1 REGIONNAME FROM  RASI_REGIONTABLE WHERE REGIONID='".$region_ids."'";
    $res = sqlsrv_query($conn,$sql);
    $row_count = sqlsrv_fetch_array($res);
    $regions_names = $row_count['REGIONNAME']; 
    
    $zone_det ="SELECT TOP 1 ZONENAME FROM RASI_ZONETABLE WHERE ZONEID='".$zone_ids."'";
    $zoneqer = sqlsrv_query($conn,$zone_det);
    $zone_counts = sqlsrv_fetch_array($zoneqer);
    $zone_name = $zone_counts['ZONENAME'];
} 

?>