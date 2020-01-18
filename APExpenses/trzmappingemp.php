<?php

  $_SESSION['EmpID'];   // Employee id
  $_SESSION['status'];  //Status = 0
  $_SESSION['Dcode'];    // Dcode -- Designation Code
  $_SESSION['Name']; 
  $_SESSION['finRights'];  // finRights  = 0 or 1 
  // This for query used in List of for all the pages
 if($_SESSION['Dcode'] == 'ZM'){
    $zmall ='';
    $ZM_all = array();
    $divsion =sqlsrv_query($conn,"SELECT DISTINCT ZONEID,ZONENAME  FROM RASI_ZONETABLE WHERE DBMID='".$_SESSION['EmpID']."'");
/*     $row_count = sqlsrv_fetch_array($res);
    $zone_id = $row_count['ZONEID'];
    $zone_name = $row_count['ZONENAME']; */
    
    while($ZMlevel=sqlsrv_fetch_array($divsion))
    {
        $allbrn = $ZMlevel['ZONEID'];
        $ZM_all[] = $allbrn;
    }
    $dmall = "'" . implode ( "', '", $ZM_all ) . "'";
}elseif($_SESSION['Dcode'] == 'RBM'){
    $rgall ='';
    $RM_all = array();
    $sql ="SELECT REGIONID FROM  RASI_REGIONTABLE WHERE RBMID='".$_SESSION['EmpID']."'";
     $res = sqlsrv_query($conn,$sql);
    /*$row_count = sqlsrv_fetch_array($res);
    $region_id = $row_count['REGIONID']; */

    while($RMlevel=sqlsrv_fetch_array($res))
    {
        $allrm = $RMlevel['REGIONID'];
        $RM_all[] = $allrm;
    }
    $rgall = "'" . implode ( "', '", $RM_all ) . "'";


    /* $sqls ="SELECT TOP 1 ZONEID FROM RASI_TRZMAPPINGTABLE WHERE REGIONID='".$region_id."'";
    $ress = sqlsrv_query($conn,$sqls);
    $row_counts = sqlsrv_fetch_array($ress);
    $zone_ids = $row_counts['ZONEID'];
    
    $zone_det ="SELECT TOP 1 ZONENAME FROM RASI_ZONETABLE WHERE ZONEID='".$zone_ids."'";
    $zoneqer = sqlsrv_query($conn,$zone_det);
    $zone_counts = sqlsrv_fetch_array($zoneqer);
    $zone_name = $zone_counts['ZONENAME']; */
}elseif($_SESSION['Dcode'] == 'TM'){
    $tmall ='';
    $TM_all = array();
    // Echo "SELECT TMID,TMNAME FROM RASI_TMTABLE WHERE EMPLID='".$_SESSION['EmpID']."'";
    $tztable =sqlsrv_query($conn,"SELECT TMID,TMNAME FROM RASI_TMTABLE WHERE EMPLID='".$_SESSION['EmpID']."'");
    // $row_tm = sqlsrv_fetch_array($tztable);
    // $TMID_id = $row_tm['TMID'];
    // $TMID_NAME = $row_tm['TMNAME'];
    while($TMlevel=sqlsrv_fetch_array($tztable))
    {
        $allbrn = $TMlevel['TMID'];
        $TM_all[] = $allbrn;
    }

    // $tmall = implode(",",$TM_all);
    $tmall = "'" . implode ( "', '", $TM_all ) . "'";
 
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