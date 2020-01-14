<?php 
  include 'header.php';
  $_SESSION['EmpID'];   // Employee id
  $_SESSION['status'];  //Status = 0
  $_SESSION['Dcode'];    // Dcode -- Designation Code
  $_SESSION['Name']; 
  $_SESSION['finRights'];  // finRights  = 0 or 1 

if($_SESSION['Dcode'] == 'ZM'){
/*   $sql ="SELECT ZONEID FROM  RASI_ZONETABLE WHERE DBMID='".$_SESSION['EmpID']."'";
  $res = sqlsrv_query($conn,$sql);
  $row_count = sqlsrv_fetch_array($res);
  echo "TEST";
  echo $ZONEID = $row_count['ZONEID']; */

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
    $max_isd =sqlsrv_query($conn,"SELECT COALESCE(MAX(AdvId),0)+1 As res_id FROM $advreques");  
    $req_detd = sqlsrv_fetch_array($max_isd);
    $req_idd = $req_detd['res_id'];
    $request_id      = "ANP/ADV/2019-2020/".''.$req_idd;
    $insert = sqlsrv_query($conn,"INSERT INTO ANP_Advance(ReqIdPre,ReqId,ReqDate,ReqDivisionId,ReqDivisionName,ReqRegionId,ReqRegionName,ReqTeritoryId,ReqTeritoryName,AdvanceTo,AdvRequestCommonRemark,CreatedBy,CreatedAt ) VALUES ('$request_id','$request_id','$request_date','$division_id','$division_name','$region_id','$region_name','$teritory_id','$teritory_name','$emp_id','$common_remark','$created_by','$created_at')");
    if($insert){
      $max_ids  = sqlsrv_query($conn,"SELECT AdvId As max_id FROM ANP_Advance WHERE ReqId = '$request_id'");  
      $req_dets = sqlsrv_fetch_array($max_ids);
      $adv_ids = $req_dets['max_id'];
    
      for($i=0,$j=0;$i<sizeof($crop_id);$i++,$j++){
           $inserta = sqlsrv_query($conn,"INSERT INTO ANP_Advance_Amount(AdvId,CropId,ActivityId,SubActivityId,AdvAmount,CreatedBy,CreatedAt) VALUES ('$adv_ids','$crop_id[$i]','$activity_id[$i]','$sub_activity_id[$i]','$avt_amt[$i]','$created_by','$created_at')"); 
        $tot_amt = $tot_amt + $avt_amt[$i];
        }
      if(sizeof($crop_id) == $j){
        
        /*  */
            $subject  ="INR ".$tot_amt." Advance Request From $created_by";
            $message 	="<div>
                          <table border='0'>
                              <tr><td>Requested By  </td><td> : </td><td> $created_by</td></tr>
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
            $to		  =	"prasanth.p@mazenetsolution.com";
                              
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
            $mail->AddAddress($to);
            // $mail->addCC('prasanth.p@mazenetsolution.com');
            // $mail->addBCC('prasanth.p@mazenetsolution.com');
            $mail->Subject  = $subject;
            $mail->IsHTML(true);
            $mail->Body    = $message;
  
            if($mail->Send())
            {
              /* echo "<script type='text/javascript'>alert('Thank You </br> Your Request ID Is $request_id </br> Advance Request is send for Approval')</script>";
              echo '<script type="text/javascript">window.location.replace("view_advance_request.php");</script>'; */
              echo "<script>window.location='advance_request.php?request_id=".$request_id."'</script>";
  
            }else {      
              echo '<script type="text/javascript">
                window.location.replace("view_advance_request.php?sts=fail");
                </script>';
            }
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
      <?php if(isset($_REQUEST['request_id'])){  ?>
          <div class="fullscreen-container">
            <div id="popdiv">
              <h1> Thank You ! </h1>
              <h3>  
                  Your Request ID is <?php echo $_REQUEST['request_id']; ?>. </br>
                  Advance Request is Send for Approval.</br>
              </h3>
              <button id="but2">Close</button>
            </div>
          </div>
            <script>
                $( document ).ready(function() {
                  $(".fullscreen-container").fadeTo(200, 1);
                  $("#but2").click(function() {
                    window.location='view_advance_request.php';
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

              <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Request ID</label>
                <div class="col-md-9 col-sm-8 col-xs-12 ">
                  <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="request_id" value="ANP/ADV/2019-2020/<?php echo $req_id; ?>" readonly>
                </div>
            </div>
            </div>
            <div class=" col-md-4 col-sm-12 col-xs-12">
            <div class="row">
              <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Request Date</label>
                <div class="col-md-9 col-sm-8 col-xs-12 ">
                  <input type="text" class="form-control col-md-12 col-xs-12 required_for_valid" name="request_date" value="<?php echo date('d-m-Y');?>" readonly>
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
                onchange="get_employee('GET_EMP_DETAILS',this.value);document.getElementById('teri_name').value=this.options[this.selectedIndex].text">
                <option value="">Select </option>
                </select>
                <input type="hidden" name="teri_name" id="teri_name" value="" />
                </div>
            </div>
            </div>
            <div class=" col-md-4 col-sm-12 col-xs-12">
            <div class="row">
              <label class="control-label col-md-3 col-sm-4 col-xs-12" for="name">Advance To<span class="required">*</span></label>
                <div class="col-md-9 col-sm-8 col-xs-12 ">
                <select class="js-example-basic-single col-xs-12 required_for_valid cls_adv_to" name="emp_id">
                <option value="">Select </option>

                </select>
                </div>
            </div>
            </div>
          </div>

          <h3>Advance Amount</h3>
          <div class="col-xs-12">
          <table class="table">
            <thead>
              <th>S.No.</th>
              <th>Crop</th>
              <th>Activity</th>
              <th>Sub Activity</th>
              <th class="right">Amount</th>
              <th>Action</th>
            </thead>
            <tbody>
              <tr>
                <td class='srn_no' >1</td>
                <td><div>
                <select class="js-example-basic-single required_for_valid cls_crop" name="crop_id[]">
                <option value="">Select Crop  </option>
                  <?php
                      $crops =sqlsrv_query($conn,"SELECT DISTINCT CROP  FROM $producttbl");
                      while($r_crop = sqlsrv_fetch_array($crops)){
                  ?>
                  <option value="<?php echo $r_crop['CROP']; ?>"> <?php echo $r_crop['CROP']; ?> </option>
                      <?php } ?>
                </select></div>
                </td>
                <td><div>
                <select class="js-example-basic-single required_for_valid cls_activity" name="activity_id[]">
                <option value="">Select Activity </option>
                  <?php
                      $activity =sqlsrv_query($conn,"SELECT DISTINCT ID,ACTIVITYTYPE  FROM $atypemaster WHERE TYPE='Financial'");
                      while($r_activity = sqlsrv_fetch_array($activity)){
                  ?>
                  <option value="<?php echo $r_activity['ID']; ?>"><?php echo $r_activity['ACTIVITYTYPE']; ?></option>
                  <?php } ?>
                </select>  </div>                  
                </td>
                <td><div> 
                <select class="js-example-basic-single form-control required_for_valid cls_sub_activity" name="sub_activity_id[]">
                <option value="">Select Sub Activity </option>
                </select></div> 
                </td>
                <td><div>
                  <input type="text"  class="form-control right only_numbers max_charater required_for_valid" name="avt_amt[]"/>
                </td></div>
                <td>
                  <button type="button" onclick ='add_row()' class="btn btn-success">+</button>
                </td> 
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
                  <a href="view_advance_request.php" class="btn btn-danger">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
        </form>
        </div>
    </div>

          <!-- crop Details Start here -->
          <div class="crop_div" style="display:none">
          <?php
              $crops =sqlsrv_query($conn,"SELECT DISTINCT CROP  FROM $producttbl");
              while($r_crop = sqlsrv_fetch_array($crops)){
            ?>
            <option value="<?php echo $r_crop['CROP']; ?>"> <?php echo $r_crop['CROP']; ?> </option>
              <?php } ?>
          </div>
          <div class="Activity_div" style="display:none">
          <?php
                $activity =sqlsrv_query($conn,"SELECT DISTINCT ID,ACTIVITYTYPE  FROM $atypemaster WHERE TYPE='Financial'");
                while($r_activity = sqlsrv_fetch_array($activity)){
            ?>
            <option value="<?php echo $r_activity['ID']; ?>"><?php echo $r_activity['ACTIVITYTYPE']; ?></option>
            <?php } ?>
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
  function s_no(){
    $(".srn_no").each(function(key,index){
      $(this).html((key+1));
    });
  }
  $(document).ready(function(){
    division_dets();
    region_dets(); 
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
           get_employee(action_type,val);
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
           get_employee(action_type,val);
          }
      });
	}

function get_employee(action_type,val) { 
  $.ajax 
      ({
        type: "POST",
        url: "ajax.php",
        data:'teritory_id='+val+'&&action_type='+action_type+'&&action_emp=GET_EMP_DETAILS',			 
        success: function(data){
           $('.cls_adv_to').append(data);
          }
      });
	}
/* 
function get_subactivity(val) {  
  $.ajax 
      ({
        type: "POST",
        url: "ajax.php",
        data:'teritory_id='+val+'&&action_type=GET_SUB_ACTIVITY',			 
        success: function(data){
           $('.cls_adv_to').html(data);
          }
      });
	} */

  $(document).on("change",".cls_activity",function(){
  var activity_id=$(this).val();
  var $tr=$(this).closest("tr");
  var activity_text=$tr.find(".cls_activity option:selected").text();
  $.ajax
      ({
        type: "POST",
        url: "ajax.php",
        data:'activity_id='+activity_id+'&&activity_text='+activity_text+'&&action_type=GET_SUB_ACTIVITY',			 
        success: function(data){
          $tr.find(".cls_sub_activity").html(data);
          }
      });
  });
    
  function add_row(){
      var markup = "<tr><td class='srn_no'></td><td><div> <select class='js-example-basic-single required_for_valid cls_crop' name='crop_id[]'><option value=''>Select Crop</option>"+ $('.crop_div').html() +"</select></div></td><td><div> <select class='js-example-basic-single  required_for_valid cls_activity' name='activity_id[]'><option value=''>Select Activity</option>"+ $('.Activity_div').html() +"</select></div></td><td><div> <select class='js-example-basic-single required_for_valid cls_sub_activity' name='sub_activity_id[]'><option value=''>Select Sub Activity</option></select></div></td><td><div><input type='text' class='form-control right max_charater required_for_valid only_numbers' name='avt_amt[]'/></div></td><td><button type='button' onclick ='add_row()' class='btn btn-success'>+</button> <button class='delete btn btn-danger' onclick ='delete_user($(this))'>X</button></tr>";
      $("table tbody").append(markup);
      s_no();
      $('.js-example-basic-single').select2();
    }

  function delete_user(row)
  {
    row.closest('tr').remove();
    s_no();
  }
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