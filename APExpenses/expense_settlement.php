<?php 
include 'header.php';
$_SESSION['EmpID'];   // Employee id
$_SESSION['status'];  //Status = 0
$_SESSION['Dcode'];    // Dcode -- Designation Code
$_SESSION['Name'];    // Name of employee
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
$max_is =sqlsrv_query($conn,"SELECT COALESCE(MAX(SId),0)+1 As res_id FROM ANP_Settlements");  
$req_det = sqlsrv_fetch_array($max_is);
$req_id = $req_det['res_id'];

if(isset($_REQUEST['submit'])){
  $createdons      = date("dmYHisA");
  $request_date    = date("Y-m-d", strtotime($_REQUEST['request_date'])); 
  $activity_id     = $_REQUEST['activity_id']; 
  $sub_activity_id = $_REQUEST['sub_activity_id']; 
  $division_id     = $_REQUEST['division_id']; 
  $region_id       = $_REQUEST['region_id']; 
  $teritory_id     = $_REQUEST['teritory_id']; 
  $division_name   = $_REQUEST['div_name']; 
  $region_name     = $_REQUEST['reg_name'];  
  $teritory_name   = $_REQUEST['teri_name'];
  $common_remark   = $_REQUEST['common_remark']; 
  $created_by      = $_SESSION['EmpID'];
  $created_at      = date('Y-m-d H:i:s');
  $max_isd =sqlsrv_query($conn,"SELECT COALESCE(MAX(SId),0)+1 As res_id FROM ANP_Settlements");  
  $req_detd = sqlsrv_fetch_array($max_isd);
  $req_idd = $req_detd['res_id'];
  $request_id      = "ANP/CLM/2019-2020/".''.$req_idd;
  
  $tbl_settlements = sqlsrv_query($conn,"INSERT INTO ANP_Settlements(SCode,SettlementDate,ActivityId,SubActivityId,DivisionId,RegionId,TeritoryId,DivisionName,RegionName,TeritoryName,AdvSettlementCommonRemark,CreatedBy,CreatedAt )VALUES('$request_id','$request_date','$activity_id','$sub_activity_id','$division_id','$region_id','$teritory_id','$division_name','$region_name','$teritory_name','$common_remark','$created_by','$created_at')");
  if($tbl_settlements){
      $max_ids  = sqlsrv_query($conn,"SELECT SId As max_id FROM ANP_Settlements WHERE SCode = '$request_id'");  
      $req_dets = sqlsrv_fetch_array($max_ids);
      $settle_id = $req_dets['max_id'];
      $event_code         = array();
      $event_code         = $_REQUEST['event_code']; 
      for($i=0,$j=0;$i<sizeof($event_code);$i++,$j++){
        $tbl_settlements_events = sqlsrv_query($conn,"INSERT INTO ANP_Settlements_Events(SId,EventCode,CreatedBy,CreatedAt )VALUES('$settle_id','$event_code[$i]','$created_by','$created_at')");
      }
     if(sizeof($event_code) == $j){

      $claim_date_frm   = array();
      $claim_date_to    = array();
      $exp_group_id     = array();
      $exp_head_id      = array();
      $exp_category_id  = array();
      $bill_no      = array();
      $vendor_name  = array();
      $gst_no       = array();
      $base_amt   = array();
      $gst_amt    = array();

      $claim_date_frm   = $_REQUEST['claim_date_frm']; 
      $claim_date_to    = $_REQUEST['claim_date_to']; 
      $exp_group_id     = $_REQUEST['exp_group_id']; 
      $exp_head_id      = $_REQUEST['exp_head_id']; 
      $exp_category_id  = $_REQUEST['exp_category_id']; 
      $bill_no          = $_REQUEST['bill_no']; 
      $vendor_name      = $_REQUEST['vendor_name']; 
      $gst_no           = $_REQUEST['gst_no']; 
      $base_amt         = $_REQUEST['base_amt']; 
      $gst_amt          = $_REQUEST['gst_amt']; 

      for($c=0,$e=0;$c<sizeof($claim_date_frm);$c++,$e++){
        $claim_date_frms   = date("Y-m-d", strtotime($claim_date_frm[$c]));
        $claim_date_tos    = date("Y-m-d", strtotime($claim_date_to[$c]));
        $tmpFilePath = $_FILES['atch_file']['tmp_name'][$c]; 
          $temp = explode(".", $_FILES['atch_file']['name'][$c]);
          $newfilename = $createdons . '.' . end($temp);
          $newFilePath = "documents/claim/" . $newfilename;  
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
              $tbl_settlements_claim = sqlsrv_query($conn,"INSERT INTO ANP_Settlements_Claim(SId,FromDate,ToDate,ExpGroupId,ExpHeadId,ExpCategoryId,BillNo,VendorName,GstNo,GstAmount,BaseAmount,DocFilePath,CreatedBy,CreatedAt )VALUES('$settle_id','$claim_date_frms','$claim_date_tos','$exp_group_id[$c]','$exp_head_id[$c]','$exp_category_id[$c]','$bill_no[$c]','$vendor_name[$c]','$gst_no[$c]','$gst_amt[$c]','$base_amt[$c]','$newFilePath','$created_by','$created_at')");
            }else{
              $tbl_settlements_claim = sqlsrv_query($conn,"INSERT INTO ANP_Settlements_Claim(SId,FromDate,ToDate,ExpGroupId,ExpHeadId,ExpCategoryId,BillNo,VendorName,GstNo,GstAmount,BaseAmount,CreatedBy,CreatedAt )VALUES('$settle_id','$claim_date_frms','$claim_date_tos','$exp_group_id[$c]','$exp_head_id[$c]','$exp_category_id[$c]','$bill_no[$c]','$vendor_name[$c]','$gst_no[$c]','$gst_amt[$c]','$base_amt[$c]','$created_by','$created_at')");
            }
      }
      if(sizeof($claim_date_frm) == $e){
          $adv_req_id  = array();
          $adv_amt     = array();
          $adv_req_id  = $_REQUEST['adv_req_id']; 
          $adv_amt     = $_REQUEST['adv_amt']; 
          for($ii=0,$jj=0;$ii<sizeof($adv_req_id);$ii++,$jj++){
            $tbl_settlements_adv = sqlsrv_query($conn,"INSERT INTO ANP_Settlements_AdvanceRef(SId,AdvId,SettledAmount,CreatedBy,CreatedAt )VALUES('$settle_id','$adv_req_id[$ii]','$adv_amt[$ii]','$created_by','$created_at')");
          }
        if(sizeof($adv_req_id) == $jj){
          /* echo "<script type='text/javascript'>alert('Thank You </br> Your Claim ID Is $request_id </br> Claim Request is send for Approval')</script>";
          echo '<script type="text/javascript">window.location.replace("view_expense_settlement.php");</script>'; */
          echo "<script>window.location='expense_settlement.php?claim_id=".$request_id."'</script>";

        }else{
          echo '<script type="text/javascript">window.location.replace("view_expense_settlement.php?sts=fail");</script>';
        }
      }else{
        echo '<script type="text/javascript">window.location.replace("view_expense_settlement.php?sts=fail");</script>';
      }      
     }else{
      echo '<script type="text/javascript">window.location.replace("view_expense_settlement.php?sts=fail");</script>';
    }
  }else{
    echo '<script type="text/javascript">window.location.replace("view_expense_settlement.php?sts=fail");</script>';
  }
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
    font-size: 12px;
    font-weight: bold;
    padding: 0px 12px;
}
.expensesDiv h3 {
    font-size: 14px;
    font-weight: bold;
    padding: 3px -1px;
}
.expensesDiv .select2-container {
  width: 100% !important;
}
#expense_claim .select2-container {
  width: 180px !important;
}
.expensesDiv table tr th, .expensesDiv table tr td, .expensesDiv table tr {
    border: 1px solid #ccc;
}
.expensesDiv table tr th {
    font-size: 12px;
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
#custom-upload {
    position: relative;
}
#custom-upload input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 50px;
    height: 38px;
}
#custom-upload button {
    border: 2px solid #4caf50;
    color: #4caf50;
    background-color: white;
    padding: 4px 16px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
}
#expense_claim input.form-control {
    padding: 2px 2px;
}
#advance_taken input.form-control {
    width: 127px;
    margin: 0 auto;
}
#advance_taken .select2-container {
  width:300px !important; 
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
                  Your Claim ID is <?php echo $_REQUEST['claim_id']; ?>. </br>
                  Claim Request is Send for Approval.</br>
              </h3>
              <button id="but2">Close</button>
            </div>
          </div>
            <script>
                $( document ).ready(function() {
                  $(".fullscreen-container").fadeTo(200, 1);
                  $("#but2").click(function() {
                    window.location='view_expense_settlement.php';
                    // $(".fullscreen-container").fadeOut(200);
                  });
                });
          </script>
      <?php } ?>
    <!-- End POP UP -->
    <!-- Page -->
  <div class="page" style="margin-top: 0px !important">
    <div class="page-content container-fluid ">
      <div class="panel panel-bordered">
          <div class="panel-body ReportTablediv expensesDiv" id="ReportTablediv">
            <form class="form-horizontal form-label-left adv_submit" name="form_name"  role="form" method="POST" enctype="multipart/form-data" >
            <input type="hidden" class="login_type" value="<?php echo $_SESSION['Dcode']?>" readonly>

            <div class="form-group row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Claim ID</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 " value="ANP/CLM/2019-2020/<?php echo $req_id; ?>" readonly>
                    </div>
                </div>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Claim Date</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 " name="request_date" value="<?php echo date('d-m-Y');?>" readonly>
                    </div>
                </div>
                </div>
              </div>
              <h3 class="col-xs-12">Advance Receiver Details</h3>
        <div class="form-group row">
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="row">
              <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Divison<span class="required">*</span> </label>
                <div class="col-md-9 col-sm-8 col-xs-12 ">
                <select class="js-example-basic-single col-xs-12 required_for_valid cls_division div_select" name="division_id" onchange="get_region(this.value);document.getElementById('div_name').value=this.options[this.selectedIndex].text" >
                  <option value="">  Select Divison  </option>
                  <?php
                    if($_SESSION['Dcode'] == 'ZM'){
                      $divsion =sqlsrv_query($conn,"SELECT DISTINCT ZONEID,ZONENAME  FROM RASI_ZONETABLE WHERE DBMID='".$_SESSION['EmpID']."'");
                    }else{
                      $divsion =sqlsrv_query($conn,"SELECT DISTINCT $TRZMapping.ZONEID,$zmtbl.ZONENAME  FROM $TRZMapping LEFT JOIN $zmtbl on $TRZMapping.ZONEID=$zmtbl.ZoneID");
                    }
                    while($row = sqlsrv_fetch_array($divsion)){
                  ?>
                  <option value="<?php echo $row['ZONEID']; ?>" <?php if(isset($zone_ids) && $zone_ids == $row['ZONEID']){ echo 'Selected'; }?>> <?php echo $row['ZONENAME']; ?> </option>
                <?php } ?>
                </select>
                <!--  <input type="hidden" name="div_name" id="div_name7" value="" /> -->
                <input type="hidden" name="division_id" class="div_text" value="<?php echo isset($zone_ids) ? $zone_ids : ""; ?>" disabled/>
                <input type="hidden" name="div_name"  class=""  id="div_name" value="<?php echo isset($zone_name) ? $zone_name : "" ; ?>"/>
                </div>
            </div>
            </div>
            <div class=" col-md-4 col-sm-12 col-xs-12">
            <div class="row">
              <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Region<span class="required">*</span></label>
                <div class="col-md-9 col-sm-8 col-xs-12 ">
                <select class="js-example-basic-single col-xs-12 required_for_valid cls_region reg_select" name="region_id" onchange="get_teritory(this.value);document.getElementById('reg_name').value=this.options[this.selectedIndex].text" >
                <option value="">Select </option>
                </select>
                <!-- <input type="hidden" name="reg_name" id="reg_name" value="" /> -->
                <input type="hidden" name="region_id" class="reg_text" value="<?php echo isset($region_ids) ? $region_ids : ""; ?>" disabled/>
                <input type="hidden" name="reg_name"  id="reg_name" value="<?php echo isset($regions_names) ? $regions_names : "" ; ?>"/>
                </div>
            </div>
            </div>
          </div>
        <div class="form-group row">
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="row">
              <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Territory<span class="required">*</span> </label>
                <div class="col-md-9 col-sm-8 col-xs-12 ">
                <select class="js-example-basic-single col-xs-12 required_for_valid cls_teritory" name="teritory_id" 
                onchange="document.getElementById('teri_name').value=this.options[this.selectedIndex].text">
                <option value="">Select </option>
                </select>
                <input type="hidden" name="teri_name" id="teri_name" value="" />
                </div>
            </div>
            </div>
          </div>

            <div class="form-group row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Activity<span class="required">*</span> </label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                    <select class="js-example-basic-single required_for_valid cls_activity" name="activity_id">
                    <option value="">Select Activity </option>
                      <?php
                          $activity =sqlsrv_query($conn,"SELECT DISTINCT ID,ACTIVITYTYPE  FROM $atypemaster WHERE TYPE='Financial'");
                          while($r_activity = sqlsrv_fetch_array($activity)){
                      ?>
                      <option value="<?php echo $r_activity['ID']; ?>"><?php echo $r_activity['ACTIVITYTYPE']; ?></option>
                      <?php } ?>
                    </select>
                    </div>
                </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Sub Activity<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                    <select class="js-example-basic-single form-control required_for_valid cls_sub_activity" name="sub_activity_id">
                    <option value="">Select Sub Activity </option>
                    </select>
                    </div>
                </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <button type="button" class="btn btn-primary event_list">Apply</button>
                </div>
              </div>
              <!-- Start Pending-->
              <div class="calim_pending_details">
              <h3>List of Pending claim event numbers</h3>
              <div class="col-xs-12">
              <table class="table" id="pending_claim">
                  <thead>
                    <th>S.No.</th>
                    <th>Event No</th>
                    <th>PO No</th>
                    <th>PO Name</th>
                    <th>TM No</th>
                    <th>TM Name</th>
                    <th>Village</th>
                    <th>Territory</th>
                    <th>Region</th>
                    <th>Selection Box</th>
                  </thead>
                <tbody>

                </tbody>
              </table>
              </div>

          <h3>A&P Expenses Claim Form</h3>
          <div class="col-xs-12">
          <table class="table" id="expense_claim">
            <thead>
              <th>S.No.</th>
              <th>Date From</th>
              <th>Date To</th>
              <!-- <th>Expenses Group</th>
              <th>Expenses Head</th> -->
              <th>Expenses Category</th>
              <th>Bill No.</th>
              <th>Vendor Name</th>
              <th>GST No.</th>
              <th class="right">Base Amt.</th>
              <th class="right">GST Amt.</th>
              <th class="right">Total Amt.</th>
              <th>Attachment</th>
              <th>Action</th>
            </thead>
            <tbody>
              <tr>
                <td class='srn_no'>1</td>
                <td >
                  <div class="input-daterange input-group" data-plugin="datepicker" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control required_for_valid"  name="claim_date_frm[]" value="<?php echo date('d-m-Y'); ?>">
                    </div>
                </td>
                <td >
                  <div class="input-daterange input-group" data-plugin="datepicker" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control required_for_valid"  name="claim_date_to[]" value="<?php echo date('d-m-Y'); ?>">
                    </div>
                </td>
                <!-- <td><div>
                <select class="js-example-basic-single required_for_valid cls_expense_group" name="exp_group_id[]">
                <option value="">Select Expense Group </option>
                  <?php
                      $grp =sqlsrv_query($conn,"SELECT DISTINCT Id,ExpenseGroupName  FROM ANP_Claim_Expenses_Group  WHERE CurrentStatus=1");
                      while($f_grp = sqlsrv_fetch_array($grp)){
                  ?>
                  <option value="<?php echo $f_grp['Id']; ?>"><?php echo $f_grp['ExpenseGroupName']; ?></option>
                      <?php } ?>
                </select></div>
                </td> -->
                <!-- <td><div>
                <select class="js-example-basic-single required_for_valid cls_expense_head" name="exp_head_id[]">
                <option value="">Select Expense Head </option>
                  
                </select></div>                  
                </td> -->
                <td>
                  <div> 
                    <select class="js-example-basic-single form-control required_for_valid cls_expense_category" name="exp_category_id[]">
                    <option value="">Select Expense Category </option>
                    <?php
                        $category =sqlsrv_query($conn,"SELECT DISTINCT Id,ExpenseCategoryName  FROM ANP_Claim_Expenses_Category WHERE CurrentStatus=1");
                        while($r_category = sqlsrv_fetch_array($category)){
                      ?>
                      <option value="<?php echo $r_category['Id']; ?>"><?php echo $r_category['ExpenseCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div> 
                </td>

                <!-- Bill NO -->
                <td><div><input type="text" class="form-control required_for_valid " name="bill_no[]"/></div></td>
                <td><div><input type="text" class="form-control required_for_valid " name="vendor_name[]"/></div></td>
                <td><div><input type="text" class="form-control" name="gst_no[]"/></div></td>
                <td><div><input type="text" class="form-control required_for_valid right each_sum_amt1 max_charater only_numbers cls_amt1" name="base_amt[]"/></div></td>
                <td><div><input type="text" class="form-control required_for_valid right each_sum_amt2 max_charater only_numbers cls_amt2" name="gst_amt[]"/></div></td>
                <td><div><input type="text" class="form-control right only_numbers cls_amt_ans" readonly name="tot_amt[]"/></div></td>
                <td><div id="custom-upload"><button ><i class="fa fa-upload" aria-hidden="true"></i></button><input type="file" name="atch_file[]"></div></td>
                <td>
                  <button type="button" onclick ='add_row()' class="btn btn-success">+</button>
                </td> 
              </tr>
          
            </tbody>
           <tfoot>
           <tr class="bold_total">
              <td></td>
              <td></td>
              <td></td>
              <td>Total</td>
              <td align="right"></td>
              <td align="right"></td>
              <td align="right"></td>
              <td align="right"><div class="total_sum_amt1"></div></td>
              <td align="right"><div class="total_sum_amt2"></div></td>
              <td align="right"><div class="over_all_total"></div></td>
              <td></td>
              <td></td>
          </tr>
           </tfoot>
            
          </table>
          </div>

            <h3>Advance Taken</h3>
            <div class="col-xs-12">
            <table class="table" id="advance_taken">
              <thead>
                <th>Ref. No.</th>
                <th>Date of Advance</th>
                <th class="right">Total Amt.</th>
                <th class="right">Claimed Amt.</th>
                <th class="right">Bal. Amt.</th>
                <th class="right">Adjust Amt.</th>
                <th>Action</th>
              </thead>
              <tbody>
              <tr>
                <td>
                  <div>
                    <select class="js-example-basic-single required_for_valid cls_adv_req" name="adv_req_id[]">
                    <option value="">Select Ref. No.</option>
                    <?php
                        $adv_req =sqlsrv_query($conn,"SELECT AdvId,ReqId  FROM ANP_Advance WHERE CurrentStatus=1");
                        while($r_adv_req = sqlsrv_fetch_array($adv_req)){
                      ?>
                      <option value="<?php echo $r_adv_req['AdvId']; ?>"><?php echo $r_adv_req['ReqId']; ?></option>
                      <?php } ?>
                    </select>
                    </div>
                  </td>
                  <td><input type="text" class="form-control reqdate"  value="" readonly></td>
                  <td><input type="text" class="form-control right advpaidtot"  value="" readonly></td>
                  <td><input type="text" class="form-control right advclaimpaid"  value="" readonly></td>
                  <td><input type="text" class="form-control right bal_amts max_amount2"  value="" readonly></td>
                  <td><div><input type="text" class="form-control required_for_valid each_adv_tot1 entering_amt2  right only_numbers" name="adv_amt[]"/></div></td>
                  <td>
                    <button type="button" onclick ='add_row_adv()' class="btn btn-success">+</button>
                  </td> 
                </tr>
              </tbody>
              <tfoot>
           <tr class="bold_total">
              <td>Total</td>
              <td align="right"></td>
              <td align="right"></td>
              <td align="right"><div class=""></div></td>
              <td align="right"><div class=""></div></td>
              <td align="right"><div class="entered_total_amt2"></div></td>
              <td></td>
          </tr>
           </tfoot>
            </table>
            </div>

            <div class="row mb-3">
              <label class="control-label col-md-1 text-center" for="name">Remark </label>
                <div class="col-md-9">
                <textarea name="common_remark" class="form-control" rows="2"></textarea>
              </div>          
              <div class="col-md-2" style=" margin: auto;">
                <a href="view_expense_settlement.php" class="btn btn-danger">Cancel</a>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>

            <!--  <div class="col-xs-12" style="float: right;">
                <a href="view_expense_settlement.php" class="btn btn-danger">Cancel</a>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div> -->
            </div>
            <!-- End -->
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- crop Details Start here -->
<!-- <div class="group_div" style="display:none">
  <?php
      $grps =sqlsrv_query($conn,"SELECT DISTINCT Id,ExpenseGroupName  FROM ANP_Claim_Expenses_Group  WHERE CurrentStatus=1");
      while($f_grps = sqlsrv_fetch_array($grps)){
  ?>
  <option value="<?php echo $f_grps['Id']; ?>"><?php echo $f_grps['ExpenseGroupName']; ?></option>
    <?php } ?>
</div> -->
<div class="category_div" style="display:none">
<?php
    $categorys =sqlsrv_query($conn,"SELECT DISTINCT Id,ExpenseCategoryName  FROM ANP_Claim_Expenses_Category WHERE CurrentStatus=1");
    while($r_categorys = sqlsrv_fetch_array($categorys)){
  ?>
  <option value="<?php echo $r_categorys['Id']; ?>"><?php echo $r_categorys['ExpenseCategoryName']; ?></option>
  <?php } ?>
</div>
<div class="adv_req_div" style="display:none">
<?php
    $adv_reqs =sqlsrv_query($conn,"SELECT AdvId,ReqId  FROM ANP_Advance WHERE CurrentStatus=1");
    while($r_adv_reqs = sqlsrv_fetch_array($adv_reqs)){
  ?>
  <option value="<?php echo $r_adv_reqs['AdvId']; ?>"><?php echo $r_adv_reqs['ReqId']; ?></option>
  <?php } ?>
</div>
<!-- START POP -->
<!-- <div class="modal fade" id="modal_fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Event Details</h4>
            </div>
            <div class="modal-body modal_fade_content">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->


<div class="modal fade modal-rotate-from-bottom" id="ResultModal"
                    aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
                    tabindex="-1" >
                    <div class="modal-dialog modal-simple">
                      <div class="modal-content" style="width: 130%;margin-left:-12%">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Event Details</h4>
                        </div>
                        <div class="modal-body">
                <div class="nav-tabs-horizontal" data-plugin="tabs">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item" role="presentation"><a class="nav-link ptabs active exampleTabsOne" data-toggle="tab" href="#exampleTabsOne"
                        aria-controls="exampleTabsOne" role="tab">Event Details</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link ptabs" data-toggle="tab" href="#exampleTabsTwo"
                        aria-controls="exampleTabsTwo" role="tab">Images</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link ptabs" data-toggle="tab" href="#exampleTabsThree"
                        aria-controls="exampleTabsThree" role="tab">Map</a></li>
                  </ul>
                  <div class="tab-content pt-20">
                    <div class="tab-pane popres-pane  active" id="exampleTabsOne" role="tabpanel">
                      <div class="row">
                                     <div class="col-sm-6">
              <div class="form-horizontal">              
                <div class="row modal-form">
                    <label class="col-sm-6 control-label">PO Code:</label>
                    <label class="col-sm-6 respopdata respopdata1"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">PO Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata2"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">HQ Code:</label>
                    <label name="" class="col-sm-6 respopdata respopdata3"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">HQ Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata4"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Event Code:</label>
                    <label name="" class="col-sm-6 respopdata respopdata5"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Activity Date:</label>
                    <label name="" class="col-sm-6 respopdata respopdata6"></label>
                  </div>
                 
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Financial Type:</label>
                    <label name="" class="col-sm-6 respopdata respopdata7"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Activity Type:</label>
                    <label name="" class="col-sm-6 respopdata respopdata8"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Sub Type:</label>
                    <label name="" class="col-sm-6 respopdata respopdata9"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Territory:</label>
                    <label name="" class="col-sm-6 respopdata respopdata10"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Taluk/Mandal:</label>
                    <label name="" class="col-sm-6 respopdata respopdata11"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Village Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata12"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Farmer Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata13"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Mobile No:</label>
                    <label name="" class="col-sm-6 respopdata respopdata14"></label>
                  </div>
                   


              </div>
            </div>
                      <div class="col-sm-6">
              <div class="form-horizontal">              
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Crop Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata15"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Product:</label>
                    <label name="" class="col-sm-6 respopdata respopdata16"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Crop Condition:</label>
                    <label name="" class="col-sm-6 respopdata respopdata17"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Status:</label>
                    <label name="" class="col-sm-6 respopdata respopdata18"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Observations:</label>
                    <label name="" class="col-sm-6 respopdata respopdata19"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Solutions:</label>
                    <label name="" class="col-sm-6 respopdata respopdata20"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">Visit No:</label>
                    <label name="" class="col-sm-6 respopdata respopdata21"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">TMCode & Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata22"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">RBM Code & Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata23"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">DBM Code & Name:</label>
                    <label name="" class="col-sm-6 respopdata respopdata24"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">No of Farmers Covered:</label>
                    <label name="" class="col-sm-6 respopdata respopdata25"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">No of Villages Covered:</label>
                    <label name="" class="col-sm-6 respopdata respopdata26"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">No of Dealers Covered:</label>
                    <label name="" class="col-sm-6 respopdata respopdata27"></label>
                  </div>

              </div>
            </div>
                      </div>

                    </div>
                    <div class="tab-pane popres-pane" id="exampleTabsTwo" role="tabpanel">
                       <div class="row">
                  <div class="col-6 col-md-3">
                    <div class="example">
                      <div class="card">
                        <img class="img-fluid w-full respopdata eimage1" src="" alt="..." data-type="image">
                      </div>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="example">
                      <div class="card">
                        <img class="img-fluid w-full respopdata eimage2" src="" alt="..." data-type="image">
                      </div>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="example">
                      <div class="card">
                       <img class="img-fluid w-full respopdata eimage3" src="" alt="..." data-type="image">
                      </div>
                    </div>
                  </div>
                </div>
                    </div>
                    <div class="tab-pane popres-pane" id="exampleTabsThree" role="tabpanel">
                      <div class="example">
                      <div class="card">
					  Coming soon..
					  </div>
					  </div>
                      </div>
                    </div>
                  </div>
				   </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary btn-pure" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>




<!-- END POP -->
  <!-- End Page -->
<script type="text/javascript">
  $(document).on('submit','.adv_submit',function(){
    var error_count=validation();
    var cls_event_code_length=$(".cls_event_code:checked").length;
    if(cls_event_code_length == 0){
      alert("Please Choose Atleast One Event");
    }
    if(error_count == 0 && cls_event_code_length >0){
      return true;
    }else{
      return false;
    } 
  });
/* User Acccess */

  $(document).ready(function(){
    var login_type = $(".login_type").val();
      if(login_type =='RBM'){
          region_dets();
          division_dets(); 
      }else if(login_type =='TM'){
        division_dets();
        region_dets();
      }else if(login_type =='ADMIN'){
      }else if(login_type =='ZM'){
      }
  });
/* Region level login disable for Division */
function division_dets(){
var val        = $(".cls_division").val();
var login_type = $(".login_type").val();
var id         = $(".reg_text").val();

 $.ajax 
  ({
    type: "POST",
    url: "ajax.php",
    data:'division_id='+val+'&&action_type=GET_REG',			 
    success: function(data){
        $('.cls_region').html(data);
        $('.cls_region').val(id);

        $(".div_select").removeAttr("disabled", "disabled");
        $(".div_text").removeAttr("disabled", "disabled");
        if(login_type == "RBM"){
          $(".div_select").attr("disabled", "disabled");
          $(".div_text").removeAttr("disabled", "disabled");
        }else{
          $(".div_text").attr("disabled", "disabled");
          $(".div_select").removeAttr("disabled", "disabled");
        }
      }
  });
}

/* Territory level login disable for region and Division */
function region_dets(){
    var val = $(".reg_text").val();
    var login_type = $(".login_type").val();
    // alert(login_type);
    $.ajax 
      ({
        type: "POST",
        url: "ajax.php",
        data:'region_id='+val+'&&action_type=GET_TM',			 
        success: function(data){
                  $('.cls_teritory').html(data);
                  $(".div_select").removeAttr("disabled", "disabled");
                  $(".div_text").removeAttr("disabled", "disabled");
                  $(".reg_select").removeAttr("disabled", "disabled");
                  $(".reg_text").removeAttr("disabled", "disabled");
              if(login_type == "TM"){
                $(".div_select").attr("disabled", "disabled");
                  $(".div_text").removeAttr("disabled", "disabled");
                  $(".reg_select").attr("disabled", "disabled");
                  $(".reg_text").removeAttr("disabled", "disabled");
              }else{
                  $(".div_select").removeAttr("disabled", "disabled");
                  $(".div_text").attr("disabled", "disabled");
                  $(".reg_select").removeAttr("disabled", "disabled");
                  $(".reg_text").attr("disabled", "disabled");
              }
          }
      });
}

function get_region(val) {  
  var action_type = 'GET_REG';
  $.ajax 
    ({
      type: "POST",
      url: "ajax.php",
      data:'division_id='+val+'&&action_type='+action_type,			 
      success: function(data){
          $('.cls_region').html(data);
        }
    });
	}

  function get_teritory(val) {  
    var action_type = 'GET_TM';
    $.ajax 
      ({
        type: "POST",
        url: "ajax.php",
        data:'region_id='+val+'&&action_type='+action_type,			 
        success: function(data){
           $('.cls_teritory').html(data);
          }
      });
	}

/* End User Acccess */

  $(document).on('keyup','.cls_amt1,.cls_amt2', function(){
    var _this = this;
    var cls_amt1 =  $(this).closest("tr").find(".cls_amt1").val();
    var cls_amt2 = $(this).closest("tr").find(".cls_amt2").val();

    cls_amt1=cls_amt1!="" ? cls_amt1 : 0;
    cls_amt2=cls_amt2!="" ? cls_amt2 : 0;

    var number = parseFloat(cls_amt1) + parseFloat(cls_amt2);

    $(this).closest("tr").find(".cls_amt_ans").val(number);

    console.log(" cls_amt1 == " + cls_amt1);
    console.log(" cls_amt2 == " + cls_amt2);
   // $(_this).closest('td').next().find('.cls_amt_ans').val(number);
    // $('#sno_to').val(number - 1);
    // console.log(number);
    // console.log(cls_amt2);
    // var number = parseFloat(cls_amt1) + parseFloat(cls_amt2) +0 ;
    // $(this).closest(".cls_amt_ans").val(number);

});

  $(document).on("change",".cls_sub_activity",function(){
    $(".calim_pending_details").hide();  // HIDE PENDING CLAAIM CLASS
  });
  $(document).on("change",".cls_activity",function(){
    $(".calim_pending_details").hide();  // HIDE PENDING CLAAIM CLASS
    var activity_id = $(this).val();
    var activity_text = $(".cls_activity option:selected").text();
    $.ajax
      ({
        type: "POST",
        url: "ajax.php",
        data:'activity_id='+activity_id+'&&activity_text='+activity_text+'&&action_type=GET_SUB_ACTIVITY',			 
        success: function(data){
          $('.cls_sub_activity').html(data);
        }
      });
    });
  $(document).on("click",".event_list",function(){
    var activity_text = $(".cls_activity option:selected").text();
    var sub_activity_text = $(".cls_sub_activity option:selected").text();
    var sub_activity_val = $(".cls_sub_activity option:selected").val();
    if(sub_activity_val ==''){
      return;
    }
    $.ajax
      ({
        type: "POST",
        url: "ajax.php",
        data:'activity_text='+activity_text+'&&sub_activity_text='+sub_activity_text+'&&action_type=GET_EVENT_LOG_ACTIVITY',			 
        success: function(data){
          $("#pending_claim > tbody").html(data);
          $(".calim_pending_details").show();
        }
      });
  });
  $(document).ready(function(){
    $(".calim_pending_details").hide();
  });
  $(document).on("change",".cls_expense_group",function(){
  var exe_group_id=$(this).val();
  var $tr=$(this).closest("tr");
  $.ajax
    ({
      type: "POST",
      url: "ajax.php",
      data:'exe_group_id='+exe_group_id+'&&action_type=GET_EXPENSE_HEAD',			 
      success: function(data){
        $tr.find(".cls_expense_head").html(data);
        }
    });
});

  $(document).on("change",".cls_adv_req",function(){
    var adv_id = $(this).val();
    var $tr=$(this).closest("tr");
    $.ajax
        ({
          type: "POST",
          url: "ajax.php",
          data:'adv_id='+adv_id+'&&action_type=GET_ADVANCE_DETAILS',			 
          success:function(res){
              var obj = JSON.parse(res);
              $tr.find(".reqdate").val(obj.reqdate);
              $tr.find(".advpaidtot").val(obj.advpaid);
              $tr.find(".advclaimpaid").val(obj.advclaimpaid);
              $tr.find(".bal_amts").val(obj.balclaimamt);
              
            }
        });
});


  function s_no(){
    $(".srn_no").each(function(key,index){
        $(this).html((key+1));
    });
  }

  function add_row(){
      var markup = "<tr><td class='srn_no'></td><td><div class='input-daterange input-group' data-plugin='datepicker' data-date-format='dd-mm-yyyy'><input type='text' class='form-control required_for_valid '  name='claim_date_frm[]' value='<?php echo date('d-m-Y'); ?>'></div></td><td><div class='input-daterange input-group' data-plugin='datepicker' data-date-format='dd-mm-yyyy'><input type='text' class='form-control required_for_valid '  name='claim_date_to[]' value='<?php echo date('d-m-Y'); ?>'></div></td> <td><div><select class='js-example-basic-single form-control  required_for_valid cls_expense_category' name='exp_category_id[]'><option value=''>Select Expense Category </option>"+ $('.category_div').html() +"</select></div></td><td><div><input type='text' class='form-control required_for_valid ' name='bill_no[]'/></div></td><td><div><input type='text' class='form-control required_for_valid ' name='vendor_name[]'/></div></td><td><div><input type='text' class='form-control' name='gst_no[]'/></div></td><td><div><input type='text' class='form-control required_for_valid each_sum_amt1 right max_charater only_numbers cls_amt1' name='base_amt[]'/></div></td><td><div><input type='text' class='form-control required_for_valid each_sum_amt2 right max_charater only_numbers cls_amt2' name='gst_amt[]'/></div></td><td><div><input type='text' class='form-control right only_numbers cls_amt_ans' readonly name='tot_amt[]'/></div></td><td><div id='custom-upload'><button ><i class='fa fa-upload' aria-hidden='true'></i></button><input type='file' name='atch_file[]'></div></td><td><button type='button' onclick ='add_row()' class='btn btn-success'>+</button> <button class='delete btn btn-danger' onclick ='delete_user($(this))'>X</button></td></tr>";
      $("#expense_claim > tbody").append(markup);
      s_no();
      $('.js-example-basic-single').select2();
      $('.input-daterange').datepicker();
   }

  function delete_user(row)
  {
    row.closest('tr').remove();
    s_no();
  }
  function add_row_adv(){
      var markup = "<tr><td><div><select class='js-example-basic-single required_for_valid cls_adv_req' name='adv_req_id[]'><option value=''>Select Ref. No.</option>"+ $('.adv_req_div').html() +"</select></div></td><td><input type='text' class='form-control reqdate' readonly></td><td><input type='text' class='form-control right advpaidtot'  value='' readonly></td><td><input type='text' class='form-control right advclaimpaid' readonly></td><td><input type='text' class='form-control max_amount2 right bal_amts' readonly></td><td><div><input type='text' class='form-control required_for_valid entering_amt2 right only_numbers' name='adv_amt[]'/></div></td><td><button type='button' onclick ='add_row_adv()' class='btn btn-success'>+</button> <button class='delete btn btn-danger' onclick ='delete_user_adv($(this))'>X</button></tr>";
      $("#advance_taken > tbody").append(markup);
      $('.js-example-basic-single').select2();
   }

  function delete_user_adv(row)
  {
    row.closest('tr').remove();
  }


  $(document).on("click", ".edit_btn", function (){
        var $tr = $(this).closest("tr");
        var event_id = $tr.find(".event_id").val();
        $.ajax({
            type: "POST",
            url: "ajax_popup_details.php",
            data: {
                event_id: event_id,
				        action_type:"EXP_CLAIM_EVENT_DETAILS"
            },
            success: function (output) {
              var rowdata = JSON.parse(output);
              $(".respopdata1").text(rowdata[1]);
              $(".respopdata2").text(rowdata[2]);
              $(".respopdata3").text(rowdata[3]);
              $(".respopdata4").text(rowdata[4]);
              $(".respopdata5").text(rowdata[5]);
              $(".respopdata6").text(rowdata[6]);
              $(".respopdata7").text(rowdata[7]);
              $(".respopdata8").text(rowdata[8]);
              $(".respopdata9").text(rowdata[9]);
              $(".respopdata10").text(rowdata[10]);
              $(".respopdata11").text(rowdata[11]);
              $(".respopdata12").text(rowdata[12]);
              $(".respopdata13").text(rowdata[13]);
              $(".respopdata14").text(rowdata[14]);
              $(".respopdata15").text(rowdata[15]);
              $(".respopdata16").text(rowdata[16]);
              $(".respopdata17").text(rowdata[17]);
              $(".respopdata18").text(rowdata[18]);
              $(".respopdata19").text(rowdata[19]);
              $(".respopdata20").text(rowdata[20]);
              $(".respopdata21").text(rowdata[21]);
              $(".respopdata22").text(rowdata[22],rowdata[32]);
              $(".respopdata23").text(rowdata[23],rowdata[33]);
              $(".respopdata24").text(rowdata[24],rowdata[34]);
              $(".respopdata25").text(rowdata[25]);
              $(".respopdata26").text(rowdata[26]);
              $(".respopdata27").text(rowdata[27]);
              
              $(".eimage1").prop('src',rowdata[28]);
              $(".eimage2").prop('src',rowdata[29]);
              $(".eimage3").prop('src',rowdata[30]);
              
              $("#ResultModal").modal('show');
            }
        });
    });
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