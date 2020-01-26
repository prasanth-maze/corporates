<?php 
  include 'header.php';
  $_SESSION['EmpID'];   // Employee id
  $_SESSION['status'];  //Status = 0
  $_SESSION['Dcode'];    // Dcode -- Designation Code
  $_SESSION['Name']; 
  $_SESSION['finRights'];  // finRights  = 0 or 1 

if($_SESSION['Dcode'] == 'ZM'){

  $divsion =sqlsrv_query($conn,"SELECT DISTINCT ZONEID,ZONENAME  FROM RASI_ZONETABLE WHERE DBMID='".$_SESSION['EmpID']."'");

}elseif($_SESSION['Dcode'] == 'RBM'){
    $sql ="SELECT REGIONID FROM  RASI_REGIONTABLE WHERE RBMID='".$_SESSION['EmpID']."'";
    $res = sqlsrv_query($conn,$sql);
    $row_count = sqlsrv_fetch_array($res);
    $req_id = $row_count['REGIONID'];

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
  
  include("phpmailer/class.phpmailer.php");
  $max_is =sqlsrv_query($conn,"SELECT COALESCE(MAX(AdvId),0)+1 As res_id FROM $advreques");  
  $req_det = sqlsrv_fetch_array($max_is);
  $req_id = $req_det['res_id'];
  $url = 'http://' . $_SERVER['HTTP_HOST'];             // Get the server
  $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // Get the current directory
             
  if(isset($_REQUEST['submit'])){
    $created_by      = $_SESSION['EmpID'];
    $created_name    = $_SESSION['Name'];
    $created_at      = date('Y-m-d H:i:s');
    $request_id      = $_REQUEST['request_id'];
    $request_date    = date("Y-m-d", strtotime($_REQUEST['request_date']));
    $division_id     = $_REQUEST['division_id'];
    $region_id       = $_REQUEST['region_id'];
    $teritory_id     = $_REQUEST['teritory_id'];
    $emp_id          = $_REQUEST['emp_id']; 
    $division_name   = $_REQUEST['div_name'];
    $region_name     = $_REQUEST['reg_name'];
    $teritory_name   = $_REQUEST['teri_name'];
    $common_remark   = $_REQUEST['common_remark'];
    $tot_amt         = 0;
    $crop_id         = array();
    $activity_id      = array();
    $sub_activity_id  = array();
    $avt_amt          = array();
  
    $crop_id         = $_REQUEST['crop_id']; 
    $activity_id     = $_REQUEST['activity_id']; 
    $sub_activity_id = $_REQUEST['sub_activity_id']; 
    $avt_amt         = $_REQUEST['avt_amt']; 
    $max_isd    = sqlsrv_query($conn,"SELECT COALESCE(MAX(AdvId),0)+1 As res_id FROM $advreques");  
    $req_detd   = sqlsrv_fetch_array($max_isd);
    $req_idd    = $req_detd['res_id'];
    $request_id = "ANP/ADV/2019-2020/".''.$req_idd;
    $insert = sqlsrv_query($conn,"INSERT INTO ANP_Advance(ReqIdPre,ReqId,ReqDate,ReqDivisionId,ReqDivisionName,ReqRegionId,ReqRegionName,ReqTeritoryId,ReqTeritoryName,AdvanceTo,AdvRequestCommonRemark,CreatedBy,CreatedAt ) VALUES ('$request_id','$request_id','$request_date','$division_id','$division_name','$region_id','$region_name','$teritory_id','$teritory_name','$emp_id','$common_remark','$created_by','$created_at')");
    if($insert){
      $max_ids  = sqlsrv_query($conn,"SELECT AdvId As max_id FROM ANP_Advance WHERE ReqId = '$request_id'");  
      $req_dets = sqlsrv_fetch_array($max_ids);
      $adv_ids  = $req_dets['max_id'];
    
      for($i=0,$j=0;$i<sizeof($crop_id);$i++,$j++){
           $inserta = sqlsrv_query($conn,"INSERT INTO ANP_Advance_Amount(AdvId,CropId,ActivityId,SubActivityId,AdvAmount,CreatedBy,CreatedAt) VALUES ('$adv_ids','$crop_id[$i]','$activity_id[$i]','$sub_activity_id[$i]','$avt_amt[$i]','$created_by','$created_at')"); 
        $tot_amt = $tot_amt + $avt_amt[$i];
        }
      if(sizeof($crop_id) == $j){
        $Emp_det =sqlsrv_query($conn,"SELECT APDESIGN FROM  EMPLTABLE WHERE EMPLID='".$emp_id."'");
        $emp_fetch = sqlsrv_fetch_array($Emp_det);
        $emp_designation = $emp_fetch['APDESIGN'];
        if($emp_designation == 'DBM'){      
          $etztable  = sqlsrv_query($conn,"SELECT TOP 1 ZONEID,EMAIL FROM RASI_ZONETABLE WHERE DBMID='".$emp_id."'");
          $erow_tm   = sqlsrv_fetch_array($etztable);
          $eTMID_id  = $erow_tm['ZONEID'];
          $cc_mail   = $erow_tm['EMAIL'];
          
          $zone =sqlsrv_query($conn,"SELECT EMAIL FROM RASI_ZONETABLE WHERE ZONEID='".$eTMID_id."' AND EMAIL != ''");
          While($row_zone = sqlsrv_fetch_array($zone)){
            $to_mail[] = $row_zone['EMAIL']; 
          }

        }elseif($emp_designation == 'RBM'){
          $etztable  = sqlsrv_query($conn,"SELECT REGIONID,EMAIL FROM RASI_REGIONTABLE WHERE RBMID='".$emp_id."'");
          $erow_tm   = sqlsrv_fetch_array($etztable);
          $eRGID_id  = $erow_tm['REGIONID'];
          $cc_mail   = $erow_tm['EMAIL'];

          $eress=sqlsrv_query($conn,"SELECT TOP 1 ZONEID FROM RASI_TRZMAPPINGTABLE WHERE REGIONID='".$eRGID_id."'");
          $erow_counts = sqlsrv_fetch_array($eress);
          $ezone_ids = $erow_counts['ZONEID'];
          
          $zone =sqlsrv_query($conn,"SELECT EMAIL FROM RASI_ZONETABLE WHERE ZONEID='".$ezone_ids."' AND EMAIL != ''");
          While($row_zone = sqlsrv_fetch_array($zone)){
            $to_mail[] = $row_zone['EMAIL']; 
          }
        }elseif($emp_designation == 'TM'){
          $etztable  = sqlsrv_query($conn,"SELECT TMID,EMAIL FROM RASI_TMTABLE WHERE EMPLID='".$emp_id."'");
          $erow_tm   = sqlsrv_fetch_array($etztable);
          $eTMID_id  = $erow_tm['TMID'];
          $cc_mail   = $erow_tm['EMAIL'];

          $eress=sqlsrv_query($conn,"SELECT TOP 1 REGIONID FROM RASI_TRZMAPPINGTABLE WHERE TMID='".$eTMID_id."'");
          $erow_counts = sqlsrv_fetch_array($eress);
          $eregion_ids = $erow_counts['REGIONID'];
          
          $regon =sqlsrv_query($conn,"SELECT EMAIL FROM RASI_REGIONTABLE WHERE REGIONID='".$eregion_ids."' AND EMAIL != ''");
          While($row_regon = sqlsrv_fetch_array($regon)){
            $to_mail[] = $row_regon['EMAIL']; 
          }
        }
        /*  */
        $subject  ="INR ".$tot_amt." Advance Request From $created_name";
        $message 	="<div>
              <table border='0'>
                  <tr><td>Requested By  </td><td> : </td><td> $created_name</td></tr>
                  <tr><td>Requested For </td><td> : </td><td> $emp_id</td></tr>
                  <tr><td>Division      </td><td> : </td><td> $division_name</td></tr>
                  <tr><td>Region        </td><td> : </td><td> $region_name</td></tr>
                  <tr> <td>Territory    </td><td> : </td><td> $teritory_name</td></tr>
              </table>
            </div></br>
            <table border='1' >
            <tr>
              <th style='padding:5px;'>S.No.</th>
              <th style='padding:5px;'>Crop</th>
              <th style='padding:5px;'>Activity</th>
              <th style='padding:5px;'>Sub Activity</th>
              <th align='right' style='padding:5px;'>Req. Amt.</th>
            </tr>";
          for($i=0,$j=1;$i<sizeof($crop_id);$i++,$j++){
              $viw_adv =sqlsrv_query($conn,"SELECT DISTINCT ACTIVITYTYPE,SUBACTIVITY FROM APSUBACTIVITYMASTER WHERE APSUBACTIVITYMASTER.ID='$sub_activity_id[$i]'");  
              $rows             = sqlsrv_fetch_array($viw_adv);
              $activity_ids     = $rows['ACTIVITYTYPE'];
              $subactivity_ids  = $rows['SUBACTIVITY'];
        $message.= " <tr>
                        <td style='padding:5px;'>$j</td>
                        <td style='padding:5px;'>$crop_id[$i]</td>
                        <td style='padding:5px;'>$activity_ids</td>
                        <td style='padding:5px;'>$subactivity_ids</td>
                        <td align='right' style='padding:5px;'>$avt_amt[$i]</td>
                      </tr>";
          }
          $message.= "<tr>
                          <td colspan='4' style='padding:5px;'> <b>Total </b></td>
                          <td align='right' style='padding:5px;'><b>$tot_amt </b></td>
                        </tr></table>";
              
            $message.= "</br><a href='$url/request_adv_approval.php?Advid=$adv_ids'> Click Here To Approve </a>";          
            $name 	= "prasanth.p@mazenetsolution.com";
            $pass		=	"prasanth@12";
            // $to		  =	"prasanth.p@mazenetsolution.com";
                              
            $mail = new PHPMailer();
            $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = $name;
            $mail->Password = $pass;
            $mail->SMTPSecure = "ssl"; // SSL FROM DATABASE
            $mail->Host = 	    "smtp.gmail.com";// Host FROM DATABASE
            $mail->Port = 		"465";// Port FROM DATABASE
            $mail->setFrom($name);
            foreach($to_mail as $key => $val){   // To Mail ids
              $mail->AddAddress($val); 
            }
            // $mail->AddAddress($to);
            $mail->addCC($cc_mail);
            $mail->Subject  = $subject;
            $mail->IsHTML(true);
            $mail->Body    = $message;
            
            // if($mail->Send())
            // {
              echo "<script>window.location='advance_request.php?request_id=".$request_id."'</script>";
            /* }else {      
              echo '<script type="text/javascript">
                window.location.replace("view_advance_request.php?sts=fail");
                </script>';
            } */
      }else{
          echo '<script type="text/javascript">
              window.location.replace("view_advance_request.php?sts=fail");
          </script>';
      }
    }else{
      echo '<script type="text/javascript">
          window.location.replace("view_advance_request.php?sts=fail");
      </script>';
    }
  }
  ?>