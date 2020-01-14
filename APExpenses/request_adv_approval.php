<?php 
  include 'header.php';
  include("phpmailer/class.phpmailer.php");
  $url = 'http://' . $_SERVER['HTTP_HOST'];
  $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
if(isset($_REQUEST['Advid'])){  $adv_id = $_REQUEST['Advid']; }else{ $adv_id  =  0;  }
if(isset($_REQUEST['submit'])){
  $approved_by     = $_SESSION['EmpID'];
  $approved_at     = date('Y-m-d H:i:s');
  $request_id      = $_REQUEST['request_id']; 
  $common_remark   = $_REQUEST['common_remark']; 

  $adv_amt_id       = array();
  $activity_id      = array();
  $sub_activity_id  = array();

  $crop_name    = array();
  $act_name     = array();
  $subact_name  = array();
  $advreq_name  = array();

  $crop_name        = $_REQUEST['crop_name']; 
  $act_name         = $_REQUEST['act_name']; 
  $subact_name      = $_REQUEST['subact_name']; 
  $advreq_name      = $_REQUEST['advreq_name'];

  $div_name      = $_REQUEST['div_name']; 
  $reg_name      = $_REQUEST['reg_name']; 
  $teri_name     = $_REQUEST['teri_name']; 
  $adv_to        = $_REQUEST['adv_to']; 

  $adv_amt_id      = $_REQUEST['adv_amt_id']; 
  $approve_amt     = $_REQUEST['approve_amt']; 
  $approve_remark  = $_REQUEST['approve_remark']; 
  $reamrk_update = sqlsrv_query($conn,"UPDATE ANP_Advance SET AdvApproveCommonRemark='$common_remark' WHERE AdvId = '$adv_id'" ); 
  for($i=0,$j=0;$i<sizeof($adv_amt_id);$i++,$j++){
        $inserta = sqlsrv_query($conn,"UPDATE ANP_Advance_Amount SET ApprovedAmount='$approve_amt[$i]',ApprovedRemark='$approve_remark[$i]',ApprovedBy='$approved_by',ApprovedAt='$approved_at' WHERE Id = '$adv_amt_id[$i]'" ); 
   }
  if(sizeof($adv_amt_id) == $j){
    $tot_appr_amt = array_sum($approve_amt); 
      $subject  ="INR ".$tot_appr_amt." Approved By $approved_by";
      $message 	="<div>
					<table border='0'>
						<tr><td>Approved By   </td><td> : </td><td> $approved_by</td></tr>
						<tr><td>Requested By  </td><td> : </td><td> $adv_to</td></tr>
						<tr><td>Division      </td><td> : </td><td> $div_name</td></tr>
						<tr><td>Region        </td><td> : </td><td> $reg_name</td></tr>
						<tr> <td>Territory    </td><td> : </td><td> $teri_name</td></tr>
					</table>
					</div></br>
					<table border='1'>
					<tr>
					  <th style='padding:5px;'>S.No.</th>
					  <th style='padding:5px;'>Crop</th>
					  <th style='padding:5px;'>Activity</th>
					  <th style='padding:5px;'>Sub Activity</th>
					  <th style='padding:5px;'>Request Amount</th>
					  <th style='padding:5px;'>Approved Amount</th>
					</tr>";
      for($i=0,$j=1;$i<sizeof($adv_amt_id);$i++,$j++){
      $message.= "<tr>
                      <td style='padding:5px;'>$j</td>
                      <td style='padding:5px;'>$crop_name[$i]</td>
                      <td style='padding:5px;'>$act_name[$i]</td>
                      <td style='padding:5px;'>$subact_name[$i]</td>
                      <td align='right' style='padding:5px;'>$advreq_name[$i]</td>
                      <td align='right' style='padding:5px;'>$approve_amt[$i]</td>
                    </tr>";
      }
      $request = array_sum($advreq_name);
      $message.= "<tr>
                      <td colspan='4' style='padding:5px;'> Total</td>
                      <td align='right' style='padding:5px;'>$request</td>
                      <td align='right' style='padding:5px;'>$tot_appr_amt</td>
                    </tr></table>";
      $message.= "<a href='$url/request_adv_payment.php?Advid=$adv_id'> Click Here To Payment </a>";
      $name 	= "prasanth.p@mazenetsolution.com";
      $pass		=  "prasanth@12";
      $to		=  "prasanth.p@mazenetsolution.com";
                        
      $mail = new PHPMailer();
      $mail->CharSet =  "utf-8";
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
      $mail->Username = $name;
      $mail->Password = $pass;
      $mail->SMTPSecure = "ssl"; // SSL FROM DATABASE
      $mail->Host = "smtp.gmail.com";// Host FROM DATABASE
      $mail->Port = "465";// Port FROM DATABASE
      $mail->setFrom($name);
      $mail->AddAddress($to);
      $mail->addCC('prasanth.p@mazenetsolution.com');
      $mail->addBCC('prasanth.p@mazenetsolution.com');
      $mail->Subject  = $subject;
      $mail->IsHTML(true);
      $mail->Body    = $message;
      if($mail->Send())
      {
/*         echo "<script type='text/javascript'>alert('Approved SuccessFully.')</script>";
        echo '<script type="text/javascript">
                window.location.replace("advance_payment_approval_view.php");
            </script>'; */
            echo "<script>window.location='request_adv_approval.php?request_id=".$request_id."'</script>";

      }else{
        echo '<script type="text/javascript">
          window.location.replace("advance_payment_approval_view.php?sts=fail");
          </script>'; 
      }
        }else {      
        echo '<script type="text/javascript">
          window.location.replace("advance_payment_approval_view.php?sts=fail");
          </script>';
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
    font-size: 13px;
    font-weight: bold;
    padding: 0px 12px;
}
.expensesDiv h3 {
    font-size: 22px;
    font-weight: bold;
    padding: 13px 0;
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
<?php if(isset($_REQUEST['request_id'])){  ?>
          <div class="fullscreen-container">
            <div id="popdiv">
              <h1> Thank You ! </h1>
              <h3>  
                  Request ID is <?php echo $_REQUEST['request_id']; ?>. </br>
                  Advance Request is Send for Finance Approval.</br>
              </h3>
              <button id="but2">Close</button>
            </div>
          </div>
            <script>
                $( document ).ready(function() {
                  $(".fullscreen-container").fadeTo(200, 1);
                  $("#but2").click(function() {
                    window.location='advance_payment_approval_view.php';
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
            <div class="form-group row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
<?php   
  $view_part_adv = sqlsrv_query($conn,"SELECT ANP_Advance.AdvId, ANP_Advance.ReqId, CONVERT (NVARCHAR(50),ANP_Advance.ReqDate,105) as ReqDate,ANP_Advance.ReqDivisionName,  ANP_Advance.ReqRegionName, ANP_Advance.ReqTeritoryName,ANP_Advance.AdvanceTo FROM ANP_Advance LEFT JOIN RASI_POHQTABLE ON ANP_Advance.AdvanceTo=RASI_POHQTABLE.POHQCODE WHERE ANP_Advance.CurrentStatus=1 AND  ANP_Advance.AdvId=$adv_id");  
  $fetch_adv_det = sqlsrv_fetch_array($view_part_adv);
  $adv_tos = $fetch_adv_det['AdvanceTo'];
  $emp_tbl        = sqlsrv_query($conn,"SELECT TOP 1 APDESIGN FROM EMPLTABLE WHERE EMPLID='$adv_tos'");  
  $fetch_emp_tbl  = sqlsrv_fetch_array($emp_tbl);
  if($fetch_emp_tbl['APDESIGN'] == 'DBM'){
    $role_tbl        = sqlsrv_query($conn,"SELECT TOP 1 DBMNAME As EmpName FROM RASI_ZONETABLE WHERE DBMID='$adv_tos'");  
    $fetch_role_tbl  = sqlsrv_fetch_array($role_tbl);
    $Empnames        = $fetch_role_tbl['EmpName'];
  }if($fetch_emp_tbl['APDESIGN'] == 'RBM'){
    $role_tbl        = sqlsrv_query($conn,"SELECT TOP 1 EMPLNAME As EmpName FROM RASI_REGIONTABLE WHERE RBMID='$adv_tos'");  
    $fetch_role_tbl  = sqlsrv_fetch_array($role_tbl);
    $Empnames        = $fetch_role_tbl['EmpName'];
  }if($fetch_emp_tbl['APDESIGN'] == 'TM'){
    $role_tbl        = sqlsrv_query($conn,"SELECT TOP 1 EMPLNAME As EmpName FROM RASI_TMTABLE WHERE EMPLID='$adv_tos'");  
    $fetch_role_tbl  = sqlsrv_fetch_array($role_tbl);
    $Empnames        = $fetch_role_tbl['EmpName'];
  }
?>
                
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Request ID</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="request_id"  value="<?php echo $fetch_adv_det['ReqId']; ?>" readonly>
                    </div>
                </div>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Request Date</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" value="<?php echo $fetch_adv_det['ReqDate'];?>" readonly>
                    </div>
                </div>
                </div>
              </div>
            <div class="form-group row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Divison</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                    <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="div_name" value="<?php echo $fetch_adv_det['ReqDivisionName'];?>" readonly>
                    </div>
                </div>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Region</label>
                    <div class="col-md-9 col-sm-8 col-xs-12 ">
                    <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="reg_name" value="<?php echo $fetch_adv_det['ReqRegionName'];?>" readonly>
                    </div>
                  </div>
                  </div>
                </div>
              <div class="form-group row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="row">
                    <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Territory </label>
                      <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="teri_name" value="<?php echo $fetch_adv_det['ReqTeritoryName'];?>" readonly>
                      </div>
                  </div>
                  </div>
                  <div class=" col-md-4 col-sm-12 col-xs-12">
                  <div class="row">
                    <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Advance To</label>
                      <div class="col-md-9 col-sm-8 col-xs-12 ">
                      <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="adv_to" value="<?php echo $Empnames;?>" readonly>
                      </div>
                  </div>
                  </div>
                </div>
                <div class="col-xs-12">
                <table class="table">
                  <thead>
                    <th>S.No.</th>
                    <th>Crop</th>
                    <th>Activity</th>
                    <th>Sub Activity</th>
                    <th>Req. Amt.</th>
                    <th>Approve Amt.</th>
                    <th>Remark</th>
                  </thead>
                  <tbody>                    
                    <?php   $i = $tot_adv_amt = 0;
                      $view_activity = sqlsrv_query($conn,"  SELECT ANP_Advance_Amount.Id As adv_amt_id,
                      ANP_Advance_Amount.CropId,  ANP_Advance_Amount.ActivityId,APACTIVITYTYPEMASTER.ACTIVITYTYPE,
                      ANP_Advance_Amount.SubActivityId, APSUBACTIVITYMASTER.SUBACTIVITY, ANP_Advance_Amount.AdvAmount 
                      FROM ANP_Advance_Amount LEFT JOIN APACTIVITYTYPEMASTER ON ANP_Advance_Amount.ActivityId=APACTIVITYTYPEMASTER.ID
                      LEFT JOIN APSUBACTIVITYMASTER ON ANP_Advance_Amount.SubActivityId=APSUBACTIVITYMASTER.ID
                      WHERE ANP_Advance_Amount.CurrentStatus=1 AND  ANP_Advance_Amount.AdvId='$adv_id'");  
                      while($fetch_activity_det = sqlsrv_fetch_array($view_activity)){
                        ?>
                        <tr>
                            <td><?php echo ++$i;?></td>
                            <td><input type="hidden" name="crop_name[]" value="<?php echo $fetch_activity_det['CropId'] ;?>"><?php echo $fetch_activity_det['CropId'] ;?></td>
                            <td><input type="hidden" name="act_name[]" value="<?php echo $fetch_activity_det['ACTIVITYTYPE'] ;?>"><?php echo $fetch_activity_det['ACTIVITYTYPE'] ;?></td>
                            <td>
                            <input type="hidden" name="subact_name[]" value="<?php echo $fetch_activity_det['SUBACTIVITY'] ;?>">
                            <input type="hidden" name="advreq_name[]" value="<?php echo $fetch_activity_det['AdvAmount'] ;?>">
                            <?php echo $fetch_activity_det['SUBACTIVITY'] ;?></td>
                            <td class ="max_amount" align="right"><?php  $tot_adv_amt =  $tot_adv_amt + $fetch_activity_det['AdvAmount']; echo $fetch_activity_det['AdvAmount'];?></td>
                            <td ><div ><input type="text"  class="form-control right only_numbers required_for_valid entering_amt" max="500" name="approve_amt[]" value="<?php echo $fetch_activity_det['AdvAmount'];?>"></div></td>
                            <td>
                                <div><input type="text" class="form-control"  name="approve_remark[]" value=""></div>
                                <input type="hidden" name="adv_amt_id[]" value="<?php echo $fetch_activity_det['adv_amt_id']; ?>" class="form-control">
                            </td>
                        </tr>
                        <?php
                      }
                    ?>
                    <tr class="bold_total">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td align="right"><?php echo number_format((float)$tot_adv_amt, 2, '.', ''); ?></td>
                        <td align="right"><div class="entered_total_amt"><?php echo $tot_adv_amt; ?></div></td>
                        <td></td>
                    </tr>
                 </tbody>
              </table>
              </div>

              <div class="row mb-3">
              <label class="control-label col-md-1 text-center" for="name">Remark <span class="required">*</span></label>
                <div class="col-md-9">
                <textarea name="common_remark" class="form-control" rows="2"></textarea>
              </div>          
              <div class="col-md-2" style=" margin: auto;">
                    <a href="advance_payment_approval_view.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Approve</button>
              </div>
          </div>
<!--                 <div class="col-xs-12" style="float: right;">
                    <a href="advance_payment_approval_view.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Approve</button>
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