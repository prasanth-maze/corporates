<?php 
  include 'header.php';
  include("phpmailer/class.phpmailer.php");
if(isset($_REQUEST['sid'])){   $sid  =   $_REQUEST['sid']; } else{ $sid  = 0; }
if(isset($_REQUEST['submit'])){
  $approved_by      = $_SESSION['EmpID'];
  $approved_at      = date('Y-m-d H:i:s');
  $set_claim_id     = array();
  $approve_amt      = array();
  $set_AdvRef_id    = array();
  $adv_approve_amt  = array();

  $common_remark        = $_REQUEST['common_remark']; 

  $claim_id        = $_REQUEST['claim_id']; 
  $set_claim_id    = $_REQUEST['set_claim_id']; 
  $approve_amt     = $_REQUEST['approve_amt']; 
  $set_AdvRef_id   = $_REQUEST['set_AdvRef_id']; 
  $adv_approve_amt = $_REQUEST['adv_approve_amt'];
  $reamrk_update = sqlsrv_query($conn,"UPDATE ANP_Settlements SET AdvSettlementApproveCommonRemark='$common_remark' WHERE SId = '$sid'");
    for($i=0,$j=0;$i<sizeof($set_claim_id);$i++,$j++){
      $inserta = sqlsrv_query($conn,"UPDATE ANP_Settlements_Claim SET ApprovedAmount='$approve_amt[$i]',ApprovedBy='$approved_by',ApprovedDate='$approved_at' WHERE Id=$set_claim_id[$i]" ); 
    }
    if(sizeof($set_claim_id) == $j){
      for($ii=0,$jj=0;$ii<sizeof($set_AdvRef_id);$ii++,$jj++){
        $inserta = sqlsrv_query($conn,"UPDATE ANP_Settlements_AdvanceRef SET ApprovedAmount='$adv_approve_amt[$ii]',ApprovedBy='$approved_by',ApprovedDate='$approved_at' WHERE Id = $set_AdvRef_id[$ii]" ); 
      }
      if(sizeof($set_AdvRef_id) == $jj){
        $tot_appr_amt = array_sum($approve_amt);
        /* echo "<script type='text/javascript'>alert('Thank You </br> Claim ID Is $claim_id </br> Claim Request of Rs. $tot_appr_amt has been  send to Finance Team')</script>";
        echo '<script type="text/javascript">window.location.replace("view_claim_approval.php");</script>'; */
        echo "<script>window.location='claim_approval.php?claim_id=".$claim_id."'</script>";
      }else{
        echo '<script type="text/javascript">window.location.replace("claim_approval.php?sts=fail");</script>';
      }
    }else {
      echo '<script type="text/javascript">window.location.replace("claim_approval.php?sts=fail");</script>';
  } 
  exit;
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../assets/css/menu.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/popup.css">

<style type="text/css">  
.card-block1{ 
    position: relative;
    padding: 0.429rem;
    background-color: white;
}
  .table tr {
    cursor: pointer;
}
h3.panel-title 
{
padding: 10px 30px;
}
.panel-heading
{
  max-height: 8%;
}
.chartDiv.fullscreen{
    z-index: 9999; 
    width: 100%; 
    height: 100%; 
    position: fixed; 
    top: 0; 
    left: 0; 
 }
  #loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1500;
    background-color:white;
}
#loader {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #3498db;
    -webkit-animation: spin 2s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
    animation: spin 2s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
}
 
#loader:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #e74c3c;
    -webkit-animation: spin 3s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
      animation: spin 3s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
}
 
#loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #f9c922;
    -webkit-animation: spin 1.5s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
      animation: spin 1.5s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
}
 
@-webkit-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}
@keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}
.column-3 {
    max-width: 20% !important;
    -webkit-box-flex: 0;
    flex: 0 0 20%;
    position: relative;
    min-height: 1px;
    padding-right: 1.0715rem;
    padding-left: 1.0715rem;
}
@media(max-width:767px) 
{
  .site-navbar.navbar-inverse .navbar-header .hamburger .hamburger-bar,
  .site-navbar.navbar-inverse .navbar-header .hamburger:after,
  .site-navbar.navbar-inverse .navbar-header .hamburger:before{
  color: black !important;
}
 .navbar-inverse .navbar-toggler{

color: black !important;    
  }
.navbar-default .navbar-toolbar>.active>.nav-link, {
    background-color: green;
    color: white;
}
  #filter{
    display: none !important;
  }
  .hidden-float {
    display: block !important;
}
.page-cs{
  margin-top: 0px !important;
}
div#myDIV {
    max-height: 100%;
    width: 100%;
    margin-left: 262px;

}
body.animsition.site-navbar-small.dashboard.site-menubar-hide{
  height: 192% !important;
}
.form-group.form-material.col-md-4.col-sm-6{
      margin-left: 0;
}

.column-3 {
    max-width: 100% !important;
    -webkit-box-flex: 0;
    flex: 0 0 100% !important;
}
.panel.panel-bordered{
  height:100% !important;
margin-right:   0px !important;
width:  100%;
}
.col-xxl-4.col-lg-4.col-sm-12
{
  margin-left: 0px !important;
  margin-top: 12px;
}
.col-xxl-4.col-lg-5{
    max-width: 100% !important;
    margin-left: 0px !important;
    margin-top: 12px;
}
.panel.panel-bordered-clm {
    margin-left: 0px !important;
    height:100% !important;
}
.col-sm-12
{
  max-width:  100% !important ;
}
form.form.filter-form.scrollable-container{
width: 100%;
}
.dashboard .card, .dashboard .panel{
    margin-bottom: 0px;
}
.ct-chart.h-50 {
    margin-bottom: 25px;
}
.site-navbar-small .site-navbar .navbar-toggler {
    padding: 6px 1.0715rem !important;
}
.site-navbar.navbar-inverse .navbar-container {
    background-color: #ccc !important;
}
.highcharts-axis-labels text {
    text-decoration: underline !important;
}
.hybrid
{
  margin-left: 0px !important;
}
}
#myDIV {display:none !important;}
.page-content {
    padding: 23px 0px 30px 0px;
}
.page {
    padding-left: 4.3%;
}
h3.panel-title {
    padding: 20px 30px;
}
.expensesDiv label {
    margin-top: 8px;
    display: inline-block;
    font-size: 13px;
    font-weight: bold;
    padding: 0px 12px;
}
.expensesDiv h3 {
    font-size: 15px;
    font-weight: bold;
    padding: 3px -1px;
}
.expensesDiv .select2-container {
  width: 100% !important;
}
.expensesDiv table tr th, .expensesDiv table tr td, .expensesDiv table tr {
    border: 1px solid #ccc;
}
.expensesDiv table tr th {
    font-size: 13px;
    font-weight: 900;
}
.expensesDiv .select2-container .select2-selection--single, .expensesDiv .select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px !important;
}
.expensesDiv .select2-container .select2-selection--single .select2-selection__rendered {
  padding: 4px 20px;
}
.right{
  text-align: right;
}
.bold_total {
    font-weight: 900;
}
</style>

<body class="animsition site-navbar-small dashboard" style="font-size: small;">
<div id="loader-wrapper" style="display: none;" >
    <div id="loader"></div>
</div>
</div>
  <?php include 'top_nav.php';  ?>
  <!-- POP UP -->
  <?php if(isset($_REQUEST['claim_id'])){  ?>
          <div class="fullscreen-container">
            <div id="popdiv">
              <h1> Thank You ! </h1>
              <h3>  
                  Claim ID is <?php echo $_REQUEST['claim_id']; ?>. </br>
                  Claim Request is Send for Finance Approval.</br>
              </h3>
              <button id="but2">Close</button>
            </div>
          </div>
            <script>
                $( document ).ready(function() {
                  $(".fullscreen-container").fadeTo(200, 1);
                  $("#but2").click(function() {
                    window.location='view_claim_approval.php';
                    // $(".fullscreen-container").fadeOut(200);
                  });
                });
          </script>
      <?php } ?>
    <!-- End POP UP -->
<?php   
  $view_part_adv = sqlsrv_query($conn,"SELECT ANP_Settlements.SCode,CONVERT (NVARCHAR(50),ANP_Settlements.SettlementDate,105) as SettledDate, 
  APACTIVITYTYPEMASTER.ACTIVITYTYPE ,APSUBACTIVITYMASTER.SUBACTIVITY  FROM ANP_Settlements LEFT JOIN APACTIVITYTYPEMASTER ON ANP_Settlements.ActivityId=APACTIVITYTYPEMASTER.ID LEFT JOIN APSUBACTIVITYMASTER ON ANP_Settlements.SubActivityId=APSUBACTIVITYMASTER.ID
  WHERE ANP_Settlements.CurrentStatus=1 AND  ANP_Settlements.SId=$sid");  
  $fetch_adv_det = sqlsrv_fetch_array($view_part_adv);
?>
    <!-- Page -->
  <div class="page" style="margin-top: 0px !important">
    <div class="page-content container-fluid ">
      <div class="panel panel-bordered">
            <div class="panel-body ReportTablediv expensesDiv" id="ReportTablediv">
            <form class="form-horizontal form-label-left adv_submit" name="form_name"  role="form" method="POST" enctype="multipart/form-data" >
            <div class="form-group row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Claim ID </label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 " name="claim_id" value="<?php echo $fetch_adv_det['SCode']; ?>" readonly>
                    </div>
                </div>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Date</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 " name="request_date" value="<?php echo $fetch_adv_det['SettledDate']; ?>" readonly>
                    </div>
                </div>
                </div>
              </div>
            <div class="form-group row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Activity </label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                    <input type="text" class="form-control col-md-12 col-xs-12 " value="<?php echo $fetch_adv_det['ACTIVITYTYPE']; ?>" readonly>
                    </div>
                </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Sub Activity</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                    <input type="text" class="form-control col-md-12 col-xs-12 " value="<?php echo $fetch_adv_det['SUBACTIVITY']; ?>" readonly>
                    </div>
                  </div>
                </div>


                </div>
          <div class="col-xs-12">
          <table class="table">
          <thead>
            <th rowspan="2">S.No.</th>
            <th>Date From</th>
            <th>Date To</th>
            <!-- <th>Exp. Group</th>
            <th>Exp. Head</th> -->
            <th>Exp. Category</th>
            <th>Bill No.</th>
            <th>Vendor Name</th>
            <th>GST No.</th>
            <th>Attachment</th>
            <!-- <th class="right">Base Amt.</th>
            <th class="right">GST Amt.</th> -->
            <th class="right">Submitted Amt.</th>
            <th class="right">Approve Amt.</th>
          </thead>
          <tbody>                    
            <?php   $i = $tot_base_amt = $tot_gst_amt = $tot_settle_amt = 0;
              $view_activity = sqlsrv_query($conn,"  SELECT ANP_Settlements_Claim.Id As set_claim_id
              ,CONVERT (NVARCHAR(50),ANP_Settlements_Claim.FromDate,105) as FromDate
                ,CONVERT (NVARCHAR(50),ANP_Settlements_Claim.ToDate,105) as ToDate
              ,ANP_Claim_Expenses_Group.ExpenseGroupName
              ,ANP_Claim_Expenses_Head.ExpenseHeadName
              ,ANP_Claim_Expenses_Category.ExpenseCategoryName
              ,ANP_Settlements_Claim.BillNo
              ,ANP_Settlements_Claim.VendorName
              ,ANP_Settlements_Claim.GstNo
              ,ANP_Settlements_Claim.BaseAmount
              ,ANP_Settlements_Claim.GstAmount
              ,ANP_Settlements_Claim.DocFilePath
              ,(ANP_Settlements_Claim.BaseAmount + ANP_Settlements_Claim.GstAmount) As SubmittedAmt
              FROM ANP_Settlements_Claim 
              LEFT JOIN ANP_Claim_Expenses_Group ON ANP_Settlements_Claim.ExpGroupId=ANP_Claim_Expenses_Group.Id AND ANP_Claim_Expenses_Group.CurrentStatus=1
              LEFT JOIN ANP_Claim_Expenses_Head ON ANP_Settlements_Claim.ExpHeadId=ANP_Claim_Expenses_Head.Id AND ANP_Claim_Expenses_Head.CurrentStatus=1
              LEFT JOIN ANP_Claim_Expenses_Category ON ANP_Settlements_Claim.ExpCategoryId=ANP_Claim_Expenses_Category.Id AND ANP_Claim_Expenses_Category.CurrentStatus=1
              WHERE ANP_Settlements_Claim.CurrentStatus=1 AND  ANP_Settlements_Claim.SId='$sid'");  
              while($fetch_activity_det = sqlsrv_fetch_array($view_activity)){
                ?>
                <tr>
                    <td><?php echo ++$i;?></td>
                    <td><?php echo $fetch_activity_det['FromDate'] ;?></td>
                    <td><?php echo $fetch_activity_det['ToDate'] ;?></td>
                    <!-- <td><?php echo $fetch_activity_det['ExpenseGroupName'] ;?></td>
                    <td><?php echo $fetch_activity_det['ExpenseHeadName'] ;?></td> -->
                    <td><?php echo $fetch_activity_det['ExpenseCategoryName'] ;?></td>
                    <td><?php echo $fetch_activity_det['BillNo'] ;?></td>
                    <td><?php echo $fetch_activity_det['VendorName'] ;?></td>
                    <td><?php echo $fetch_activity_det['GstNo'] ;?></td>
                    <td><?php if($fetch_activity_det['DocFilePath'] !='') { ?><a href="<?php echo $fetch_activity_det['DocFilePath'];?>" target="_blank">View Bill</a> <?php } ?></td>
                    <!--  <td class ="right"><?php $tot_base_amt = $tot_base_amt + $fetch_activity_det['BaseAmount']; echo $fetch_activity_det['BaseAmount'] ;?></td>
                    <td class ="right"><?php $tot_gst_amt = $tot_gst_amt + $fetch_activity_det['GstAmount']; echo $fetch_activity_det['GstAmount'] ;?></td> -->
                    <td class ="max_amount right"><?php $tot_settle_amt = $tot_settle_amt + $fetch_activity_det['SubmittedAmt']; echo $fetch_activity_det['SubmittedAmt'] ;?></td>
                    <td ><div>
                    <input type="hidden" class="form-control" name="set_claim_id[]" value="<?php echo $fetch_activity_det['set_claim_id'];?>">
                    <input type="text" class="form-control right only_numbers required_for_valid entering_amt" name="approve_amt[]" value="<?php echo $fetch_activity_det['SubmittedAmt'];?>">
                    </div></td>
                </tr>
                <?php
                }
              ?>
              <tr class="bold_total">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <!-- <td></td>
                  <td></td> -->
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total</td>
                  <!-- <td align="right"><?php echo number_format((float)$tot_base_amt, 2, '.', ''); ?></td>
                  <td align="right"><?php echo number_format((float)$tot_gst_amt, 2, '.', ''); ?></td> -->
                  <td align="right"><?php echo number_format((float)$tot_settle_amt, 2, '.', ''); ?></td>
                  <td class="entered_total_amt right"><?php echo number_format((float)$tot_settle_amt, 2, '.', ''); ?></td>
              </tr>
            </tbody>
          </table>
              </div>
              <div class="col-xs-12">
              <h3>Advance Taken</h3>
              <table class="table" id="advance_taken">
                <thead>
                  <th>Ref. No.</th>
                  <th>Date of Advance</th>
                  <th class="right">Total Amt.</th>
                  <th class="right">Claimed Amt.</th>
                  <th class="right">Bal. Amt.</th>
                  <th class="right">Settled Amt.</th>
                  <th class="right">Approve Amt.</th>
                </thead>
                <tbody>       
            <?php
            $tot_advpaid_amt = $tot_advclaimpaid_amt = $tot_balclaim_amt = $tot_settle_amt = 0;
              $view_adv_adj = sqlsrv_query($conn,"SELECT ANP_Settlements_AdvanceRef.Id As set_AdvRef_id
              ,ANP_Advance.ReqId
              ,CONVERT(NVARCHAR(50),ANP_Advance.ReqDate,105) as ReqDate
              ,COALESCE(SUM(ANP_Advance_Payment.AdvPaidAmount),0) As AdvPaid
              ,COALESCE(SUM(ANP_Settlements_AdvanceRef.VerifiedAmount),0) As AdvClaimPaid 
              ,(COALESCE(SUM(ANP_Advance_Payment.AdvPaidAmount),0) - COALESCE(SUM(ANP_Settlements_AdvanceRef.VerifiedAmount),0)) As BalClaimAmt 
              ,ANP_Settlements_AdvanceRef.SettledAmount
              FROM ANP_Settlements_AdvanceRef 
              LEFT JOIN ANP_Advance ON ANP_Settlements_AdvanceRef.AdvId=ANP_Advance.AdvId AND ANP_Advance.CurrentStatus=1
              LEFT JOIN  ANP_Advance_Payment ON ANP_Settlements_AdvanceRef.AdvId=ANP_Advance_Payment.AdvId AND ANP_Advance_Payment.CurrentStatus=1 
              WHERE ANP_Settlements_AdvanceRef.CurrentStatus=1 AND  ANP_Settlements_AdvanceRef.SId=$sid
              GROUP BY  ANP_Settlements_AdvanceRef.Id
              ,ANP_Advance.ReqId
              ,ANP_Advance.ReqDate
              ,ANP_Settlements_AdvanceRef.SettledAmount");
              while($fetch_adv_det = sqlsrv_fetch_array($view_adv_adj)){
                ?>
                <tr>
                    <td><?php echo $fetch_adv_det['ReqId']; ?></td>
                    <td><?php echo $fetch_adv_det['ReqDate']; ?></td>
                    <td class="right"><?php $tot_advpaid_amt=$tot_advpaid_amt + $fetch_adv_det['AdvPaid']; echo $fetch_adv_det['AdvPaid']; ?></td>
                    <td class="right"><?php $tot_advclaimpaid_amt=$tot_advclaimpaid_amt+$fetch_adv_det['AdvClaimPaid']; echo $fetch_adv_det['AdvClaimPaid']; ?></td>
                    <td class="right"><?php $tot_balclaim_amt=$tot_balclaim_amt+$fetch_adv_det['BalClaimAmt']; echo $fetch_adv_det['BalClaimAmt']; ?></td>
                    <td class="right max_amount1"><?php $tot_settle_amt=$tot_settle_amt+$fetch_adv_det['SettledAmount']; echo $fetch_adv_det['SettledAmount']; ?></td>
                    <td ><div >
                    <input type="hidden"  class="form-control" name="set_AdvRef_id[]" value="<?php echo $fetch_adv_det['set_AdvRef_id'];?>">
                    <input type="text"  class="form-control right only_numbers required_for_valid entering_amt1" name="adv_approve_amt[]" value="<?php echo $fetch_adv_det['SettledAmount'];?>">
                    </div></td>
                </tr>
                <?php
                }
              ?>
              <tr class="bold_total">
                  <td></td>
                  <td>Total</td>
                  <td class="right"><?php echo number_format((float)$tot_advpaid_amt, 2, '.', ''); ?></td>
                  <td class="right"><?php echo number_format((float)$tot_advclaimpaid_amt, 2, '.', ''); ?></td>
                  <td class="right"><?php echo number_format((float)$tot_balclaim_amt, 2, '.', ''); ?></td>
                  <td class="right"><?php echo number_format((float)$tot_settle_amt, 2, '.', ''); ?></td>
                  <td class="right entered_total_amt1"></td>
              </tr>
            </tbody>
          </table>
              </div>
              <div class="row mb-3">
              <label class="control-label col-md-1 text-center" for="name">Remark </label>
                <div class="col-md-8">
                <textarea name="common_remark" class="form-control" rows="2"></textarea>
              </div>          
              <div class="col-md-3" style=" margin: auto;">
              <a href="view_claim_approval.php" class="btn btn-danger">Back</a>
              <a href="#" class="btn btn-danger">Reject</a>
                    <button type="submit" name="submit" class="btn btn-primary"> Approve </button>
              </div>
            </div>
                <!-- <div class="col-xs-12" style="float: right;">
                    <a href="view_claim_approval.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div> -->
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- End Page -->
<script type="text/javascript">

$(document).on('submit','.adv_submit',function(){
  var error_count=validation();
  if(error_count == 0){
    return true;
  }else{
    return false;
  } 
});
// select 2 plug
</script>
  <!-- select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <!-- Core  -->
  <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="../global/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1"></script>
  <script src="../global/vendor/popper-js/umd/popper.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/bootstrap/bootstrap.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/animsition/animsition.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/mousewheel/jquery.mousewheel.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/asscrollbar/jquery-asScrollbar.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/asscrollable/jquery-asScrollable.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/ashoverscroll/jquery-asHoverScroll.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/waves/waves.minfd53.js?v4.0.1"></script>

  <!-- Plugins -->
  <script src="../global/vendor/switchery/switchery.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/intro-js/intro.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/screenfull/screenfull.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/slidepanel/jquery-slidePanel.minfd53.js?v4.0.1"></script>

  <!-- Plugins For This Page -->
  <script src="../global/vendor/chartist/chartist.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/jvectormap/jquery-jvectormap.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-enfd53.js?v4.0.1"></script>
  <script src="../global/vendor/matchheight/jquery.matchHeight-minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/peity/jquery.peity.minfd53.js?v4.0.1"></script>

  <!-- Scripts -->
  <script src="../global/js/State.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Component.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Base.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Config.minfd53.js?v4.0.1"></script>

  <script src="../assets/js/Section/Menubar.minfd53.js?v4.0.1"></script>
  <script src="../assets/js/Section/Sidebar.minfd53.js?v4.0.1"></script>
  <script src="../assets/js/Section/PageAside.minfd53.js?v4.0.1"></script>
  <script src="../assets/js/Plugin/menu.minfd53.js?v4.0.1"></script>

  <!-- Config -->
  <script src="../global/js/config/colors.minfd53.js?v4.0.1"></script>
  <script src="../assets/js/config/tour.minfd53.js?v4.0.1"></script>
  <!-- Page -->

  <script src="../assets/js/Site.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/asscrollable.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/slidepanel.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/switchery.minfd53.js?v4.0.1"></script>

  <script src="../global/js/Plugin/matchheight.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/jvectormap.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/peity.minfd53.js?v4.0.1"></script>
  <script src="../assets/examples/js/dashboard/v1.minfd53.js?v4.0.1"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/timepicker/jquery.timepicker.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datepair/datepair.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datepair/jquery.datepair.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/bootstrap-datepicker.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/datepair.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net/jquery.dataTablesfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-bs4/dataTables.bootstrap4fd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-rowgroup/dataTables.rowGroup.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-scroller/dataTables.scroller.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-responsive/dataTables.responsive.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-buttons/dataTables.buttons.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-buttons/buttons.html5.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-buttons/buttons.flash.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-buttons/buttons.print.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-buttons/buttons.colVis.minfd53.js?v4.0.1"></script>
  <script src="../global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.minfd53.js?v4.0.1"></script>
  <script src="../global/js/Plugin/datatables.minfd53.js?v4.0.1"></script>
  <script src="../assets/js/menu.js?v4.0.1"></script>
  <?php  include 'public_functions.php'; ?>
</body>
</html>