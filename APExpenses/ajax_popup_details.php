<?php 

include '../auto_load.php';
$action_type = $_REQUEST['action_type'];
if($action_type == 'ADV_REQUEST_PAYMENT_SPLITUP_DETAILS' && $_REQUEST['permanent_id'] != ''){  
 $adv_id = $_REQUEST['permanent_id'];
?>
<form method="post">
  <div class="row">
  <table class="table table-hover dataTable table-striped w-full example" border="0" id="DivisionRestbl" data-loaded='no'>
      <thead>
        <tr>
            <th>S.No.</th>
            <th style="text-align: right;">Req. Amt.</th>
            <th style="text-align: right;">Approved Amt.</th>
            <th style="text-align: right;">Paid Amt.</th>
            <th >More</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $i =0;
              $viw_adv =sqlsrv_query($conn," SELECT 
                    SUM(AdvAmount) As AdvReq,
                    SUM(ApprovedAmount) As AppAmt,
                    SUM(AdvPaidAmount) As AdvPaidAmount,
                    ANP_Advance_Payment.AdvPayUniqueId,
                    ANP_Advance_Payment.AdvId
                    FROM ANP_Advance 
                    LEFT JOIN ANP_Advance_Amount ON ANP_Advance.AdvId=ANP_Advance_Amount.AdvId 
                    LEFT JOIN RASI_POHQTABLE ON ANP_Advance.AdvanceTo=RASI_POHQTABLE.POHQCODE 
                    LEFT JOIN APSUBACTIVITYMASTER ON ANP_Advance_Amount.SubActivityId=APSUBACTIVITYMASTER.ID 
                    LEFT JOIN ANP_Advance_Payment on ANP_Advance_Amount.Id=ANP_Advance_Payment.AdvAmtId
                    WHERE ANP_Advance.CurrentStatus='1' 
                    AND ANP_Advance_Amount.CurrentStatus='1' 
                    AND  ANP_Advance_Payment.AdvId=$adv_id
                    GROUP BY ANP_Advance_Payment.AdvPayUniqueId,ANP_Advance_Payment.AdvId ");  
            while($rows = sqlsrv_fetch_array($viw_adv)){ 
              $i++;
            ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td align="right"><?php echo $rows['AdvReq']; ?></td>
                <td align="right"><?php echo $rows['AppAmt']; ?></td>
                <td align="right"><?php echo $rows['AdvPaidAmount']; ?></td>
                <td> <button type="button" onclick="window.location.href='update_request_adv_payment.php?Advid=<?php echo $rows['AdvId']; ?>&&AdvPayUniqueId=<?php echo $rows['AdvPayUniqueId']; ?>'" class="btn btn-sm btn-danger">Edit&nbsp;</button>
                </td>
              </tr>
            <?php  } ?>
      </tbody>
    </table>
  </div> 
</form>
<?php } 
if($action_type == 'EXP_CLAIM_EVENT_DETAILS' && $_REQUEST['event_id'] != ''){  
 $event_id = $_REQUEST['event_id'];
 $event_log_actvity =sqlsrv_query($conn,"SELECT DISTINCT *,CONVERT (NVARCHAR(50),RASI_APEVENTRECORDERLOGTABLE.TRANSDATE,105) as TRANSDATE FROM RASI_APEVENTRECORDERLOGTABLE WHERE TYPE='Financial' AND EVENTCODE='".$event_id."' ");
 $rows_settle = sqlsrv_fetch_array($event_log_actvity);

 $ver_det = array(
       $rows_settle['EVENTCODE']
       ,$rows_settle['POCODE']
       ,$rows_settle['POCODE']
       ,$rows_settle['POCODE']
       ,$rows_settle['POCODE']
      ,$rows_settle['EVENTCODE']
      ,$rows_settle['TRANSDATE']
      ,$rows_settle['TYPE']
      ,$rows_settle['ACTIVITYTYPE']
      ,$rows_settle['ACTIVITYNAME']
      ,$rows_settle['TERRITORY']
      ,$rows_settle['TALUKMANDAL']
      ,$rows_settle['VILLAGENAME']
      ,$rows_settle['FARMERNAME']
      ,$rows_settle['MOBILENUMBER'] // 14
      ,$rows_settle['CROPNAME']
      ,$rows_settle['PRODUCT']
      ,$rows_settle['CROPCONDTION']
      ,$rows_settle['STATUS']
      ,$rows_settle['OBSERVATIONON']
      ,$rows_settle['SOLUTIONS']
      ,$rows_settle['VISITNO']
      ,$rows_settle['TMCODE']
      ,$rows_settle['RBMCODE']
      ,$rows_settle['DBMCODE']
      ,$rows_settle['NOOFFARMERCOVERED']
      ,$rows_settle['NOOFVILLAGECOVERED']
      ,$rows_settle['NOOFDEALERSCOVERED'] // 27
      ,$rows_settle['IMAGE1']
      ,$rows_settle['IMAGE2']
      ,$rows_settle['IMAGE3']
);
echo json_encode($ver_det);
} ?>