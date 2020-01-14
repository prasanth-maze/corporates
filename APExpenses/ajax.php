<?php 
include '../auto_load.php';
$_SESSION['EmpID'];   // Employee id
$_SESSION['status'];  // Status = 0
$_SESSION['Dcode'];   // Dcode -- Designation Code
$_SESSION['Name'];    // Name of emp
$_SESSION['finRights'];  // finRights  = 0 or 1
if(isset($_REQUEST['action_emp'])){ $action_emp  = $_REQUEST['action_emp']; } else{ $action_emp  = ''; }
$action_type = $_REQUEST['action_type'];
if($action_type == 'GET_REG' && $_REQUEST['division_id'] != ''){
  if($_SESSION['Dcode'] == 'RBM'){
    $divsion =sqlsrv_query($conn,"SELECT DISTINCT REGIONID,REGIONNAME  FROM RASI_REGIONTABLE WHERE RBMID='".$_SESSION['EmpID']."'");
  }else{
    $divsion =sqlsrv_query($conn,"SELECT DISTINCT $TRZMapping.REGIONID,$regtbl.REGIONNAME  FROM $TRZMapping LEFT JOIN $regtbl on $TRZMapping.REGIONID=$regtbl.REGIONID WHERE $TRZMapping.ZONEID='".$_REQUEST['division_id']."'");    
  }
  $option="";
  $option.="<option value=''>Select </option>";
  while($row = sqlsrv_fetch_array($divsion)){
    $option.="<option value=".$row['REGIONID'].">".$row['REGIONNAME']."</option>";

  }
  echo $option;
}


if($action_type == 'GET_TM'  && $_REQUEST['region_id'] != ''){
  if($_SESSION['Dcode'] == 'TM'){
    $region =sqlsrv_query($conn,"SELECT DISTINCT TMID,TMNAME FROM RASI_TMTABLE WHERE EMPLID='".$_SESSION['EmpID']."'");
  }else{
    $region =sqlsrv_query($conn,"SELECT DISTINCT $TRZMapping.TMID,$tmtbl.TMNAME  FROM $TRZMapping LEFT JOIN $tmtbl on $TRZMapping.TMID=$tmtbl.TMID WHERE $TRZMapping.REGIONID='".$_REQUEST['region_id']."'");
  }

  $options="";
  $options.="<option value=''>Select </option>";
  while($rows = sqlsrv_fetch_array($region)){
    $options.="<option value=".$rows['TMID'].">".$rows['TMNAME']."</option>";

  }
  echo $options;
}


if($action_emp =='GET_EMP_DETAILS' && $action_type != ''  &&  $_REQUEST['teritory_id'] != '' ){

  if($action_type == 'GET_REG'){
    $teritory =sqlsrv_query($conn,"SELECT DISTINCT DBMID As EMPID,DBMNAME  AS EMPNAME FROM RASI_ZONETABLE WHERE ZONEID= '".$_REQUEST['teritory_id']."'");
  }elseif($action_type == 'GET_TM'){
    $teritory =sqlsrv_query($conn,"SELECT DISTINCT RBMID As EMPID,EMPLNAME AS EMPNAME FROM RASI_REGIONTABLE WHERE REGIONID='".$_REQUEST['teritory_id']."'");
  }elseif($action_type == 'GET_EMP_DETAILS'){
    $teritory =sqlsrv_query($conn,"SELECT DISTINCT EMPLID AS EMPID, EMPLNAME AS EMPNAME  FROM RASI_TMTABLE WHERE TMID='".$_REQUEST['teritory_id']."'");
    // $teritory =sqlsrv_query($conn,"SELECT DISTINCT $pohqtbl.POHQCODE,$pohqtbl.POHQNAME,$pohqtbl.POCODE  FROM $pohqtbl WHERE $pohqtbl.TMID='".$_REQUEST['teritory_id']."'");
  }
  $options="";
  // $options.="<option value=''>Select </option>";
  while($rteri = sqlsrv_fetch_array($teritory)){
    $options.="<option value=".$rteri['EMPID'].">".$rteri['EMPNAME']." / ".$rteri['EMPID']."</option>";
  }
  echo $options;
}

if($action_type == 'GET_SUB_ACTIVITY'  && $_REQUEST['activity_id'] != ''){
  $sub_actvity =sqlsrv_query($conn,"SELECT DISTINCT ID,SUBACTIVITY  FROM $subatypemaster WHERE ACTIVITYTYPE='".$_REQUEST['activity_text']."'");
  $options="";
  $options.="<option value=''>Select </option>";
  while($rsactivity = sqlsrv_fetch_array($sub_actvity)){
    $options.="<option value=".$rsactivity['ID'].">".$rsactivity['SUBACTIVITY']."</option>";
  }
  echo $options;
}

if($action_type == 'GET_EXPENSE_HEAD'  && $_REQUEST['exe_group_id'] != ''){
  $sub_actvity =sqlsrv_query($conn,"SELECT DISTINCT Id,ExpenseHeadName  FROM ANP_Claim_Expenses_Head WHERE CurrentStatus=1 AND ExpensesGroupId='".$_REQUEST['exe_group_id']."'");
  $options="";
  $options.="<option value=''>Select </option>";
  while($rsactivity = sqlsrv_fetch_array($sub_actvity)){
    $options.="<option value=".$rsactivity['Id'].">".$rsactivity['ExpenseHeadName']."</option>";
  }
  echo $options;
}

if($action_type == 'GET_ADVANCE_DETAILS' && $_REQUEST['adv_id'] != ''){
  $adv_det =sqlsrv_query($conn,"SELECT CONVERT(NVARCHAR(50),ANP_Advance.ReqDate,105) as ReqDate
  ,COALESCE(SUM(ANP_Advance_Payment.AdvPaidAmount),0) As AdvPaid 
  FROM ANP_Advance 
  LEFT JOIN  ANP_Advance_Payment ON ANP_Advance.AdvId=ANP_Advance_Payment.AdvId AND ANP_Advance_Payment.CurrentStatus=1 
  WHERE ANP_Advance.CurrentStatus=1 AND ANP_Advance.AdvId='".$_REQUEST['adv_id']."' GROUP BY  ANP_Advance.ReqDate");

  $viw_advs1 =sqlsrv_query($conn,"SELECT SUM(ANP_Settlements_AdvanceRef.VerifiedAmount) as AdvClaimPaid FROM ANP_Settlements_AdvanceRef WHERE ANP_Settlements_AdvanceRef.CurrentStatus=1 AND ANP_Settlements_AdvanceRef.AdvId='".$_REQUEST['adv_id']."'");  
  $rows_settle = sqlsrv_fetch_array($viw_advs1);
  $f_adv_det = sqlsrv_fetch_array($adv_det);
  $bal =  $f_adv_det['AdvPaid'] -  $rows_settle['AdvClaimPaid'];

  $reqdates = $f_adv_det['ReqDate'];
  $advpaid = $f_adv_det['AdvPaid'];
  $advclaimpaid = $rows_settle['AdvClaimPaid'] + 0;
  $balclaimamt = $bal;
  $ver_det = array(
    "reqdate" => $reqdates,
    "advpaid" => $advpaid,
    "advclaimpaid" => $advclaimpaid,
    "balclaimamt" => $balclaimamt,
  );
  echo json_encode($ver_det);
}

if($action_type == 'GET_EVENT_LOG_ACTIVITY'){
  $event_log_actvity =sqlsrv_query($conn,"SELECT DISTINCT TOP 10 EVENTCODE,POHQCODE,POHQNAME,TMCODE,VILLAGENAME,TERRITORY FROM $eventlogtbl WHERE TYPE='Financial' AND ACTIVITYTYPE='".$_REQUEST['activity_text']."' AND ACTIVITYNAME='".$_REQUEST['sub_activity_text']."'");
  $tr="";
  $i =1;
  while($f_event_log_actvity = sqlsrv_fetch_array($event_log_actvity)){
    $tr.="<tr><td>".$i++."</td><td>".$f_event_log_actvity['EVENTCODE']."</td><td>".$f_event_log_actvity['POHQCODE']."</td> <td>".$f_event_log_actvity['POHQNAME']."</td><td>".$f_event_log_actvity['TMCODE']."</td><td>".$f_event_log_actvity['TMCODE']."</td><td>".$f_event_log_actvity['VILLAGENAME']."</td><td>".$f_event_log_actvity['TERRITORY']."</td><td>".$f_event_log_actvity['TERRITORY']."</td><td><input type='checkbox'  class='cls_event_code' name='event_code[]' value='".$f_event_log_actvity['EVENTCODE']."' </td></tr>";
  }
  echo $tr;
}

?>