<?php 
include 'header.php';

 if($_SESSION['EmpID'] == 'RS5548' || $_SESSION['EmpID'] == 'RS5983') { 
  echo '<script type="text/javascript"> window.location.replace("financedashboard.php"); </script>';
 }
 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<!-- datatables coumn visibility -->
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../assets/css/menu.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style type="text/css">
  .my-custom-scrollbar { 
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
  h3.panel-title 
{
padding: 4px 30px;
}
.panel-heading
{
  max-height: 9%;
}
.site-navbar-small .site-menubar {
    top: 2.286rem;
    max-height: 111px;
}
  .table tr {
    cursor: pointer;
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
  margin-top: -84px !important;
}
div#myDIV {
    display: none;
    max-height: 100% !important;
    width: 100%;
}
.column-3 {
    max-width: 100% !important;
    -webkit-box-flex: 0;
    flex: 0 0 100% !important;
}
.col-xxl-4.col-lg-3.col-sm-12{
  max-width: 100% !important;
}
.col-xxl-4.col-lg-4.col-sm-12{
  height: 0px !important;
}
.col-xxl-4.col-lg-5{
    max-width: 100% !important;
    margin-left: 0 !important;
    height: 65% !important;
}
.panel.panel-bordered-clm{
  height: 100% !important;
}
.col-xxl-4 .col-lg-4 .col-sm-12-clm{
 height: 100% !important; 
}
.row.top-menu.scrollable-content{
  width: 100% !important;
}
.panel.panel-bordered-clm1{
    margin-top: -18px !important;
    width: 100% !important;
    padding-top: 0px !important;
    margin-left: 165px !important;
    margin-bottom: 18px !important;
    
}
.site-navbar.navbar-inverse .navbar-container {
    background-color: #ccc !important;
}

}

#myDIV {
    display: none !important;
}
.page-content {
    padding: 10px 10px 30px 0px;
}
.page {
    padding-left: 4.3%;
}
h3.panel-title {
    padding: 20px 30px;
}
.bg-green {background: #a7e4b5;}
.main-dash h3 {
    padding: 50px;
    background: #ccc;
    text-align: center;
}
.dash_url a {
    color: #0095ff;
    font-weight: bold;
    font-size: 15px;
    margin: 0 12px;
}
/* dashboard */
.expense-dash .card {
    background: #e69c33;
    margin-bottom: 0;
    height: auto;

}
.expense-dash .card1, .expense-dash .card2, .expense-dash .card3, .expense-dash .card4 { 
  margin: 0 0px 30px 0;
}
.expense-dash .card .media {
    padding: 10px;
    height: 90px;
}
.expense-dash .media img {
    max-width: 37px;
}
.expense-dash .card h5 {
    padding: 6px 0px;
    text-align: right;
    margin: 0;
}
.expense-dash .card h5 a{
  color:#fff; font-size: 14px;
}
.expense-dash .card h5 {
    padding: 6px 5px;
    text-align: right;
    margin: 0;
    background: #0000002e;
}
.expense-dash .card .media-body h4 b {
    font-size: 30px;
    color: #fff;
    font-weight: bold; padding: 0 10px;
}
.expense-dash .card .media-body h4 {
    color: #fff;
    padding: 0 6px;     text-align: center;
}
.card2 {
  background: #e15349 !important;
}
.card3 {
  background: #885081 !important; 
}
.card4 {
  background: #c72638 !important;
}
.card5 {
  background: #1363ba !important;
}
.card6 {
  background: #f43602 !important; 
}
.card7 {
  background: #86711e !important;
}
.card8 {
  background: #08a5aa !important;
}
.expense-dash {
    padding: 10px;
    background: #fff;
}
</style>

<body class="animsition site-navbar-small dashboard" style="font-size: small;">
<div id="loader-wrapper" style="display: none;" >
    <div id="loader"></div>
</div>
</div>
<?php include 'top_nav.php'; ?>
<?php
 
    $anp_adv ="SELECT COUNT(AdvId) AS tot_adv FROM ANP_Advance WHERE CurrentStatus='1' ";
    $wait_approval.="SELECT COUNT(AdvId) AS tot_adv_pend,SUM(AdvAmount) As tot_advamt_pend FROM ANP_Advance_Amount WHERE CurrentStatus='1' AND ApprovedAmount!=null ";
    if($_SESSION['Dcode'] == 'ZM'){

    }else if($_SESSION['Dcode'] == 'RBM'){

    }else if($_SESSION['Dcode'] == 'TM'){
      $anp_adv.=" AND ANP_Advance.AdvanceTo='".$_SESSION['EmpID']."'";
    }
    $wait_approval.=" GROUP BY ANP_Advance_Amount.AdvId";
    
    $anpadv       = sqlsrv_query($conn,$anp_adv);
    $fetch_anp    = sqlsrv_fetch_array($anpadv);
    $tot_adv_req  = $fetch_anp['tot_adv'];

    $anpwait    = sqlsrv_query($conn,$wait_approval);
    $fetch_wait = sqlsrv_fetch_array($anpwait);
    $tot_pend_cout  = $fetch_wait['tot_adv_pend'];
    $tot_pend_amt   = $fetch_wait['tot_advamt_pend'];
?>
  <!-- Page -->
  <div class="page" style="margin-top: 0px !important">
    <div class="page-content container-fluid ">
      <div class="panel panel-bordered">
            </div>
            <div class="panel-body ReportTablediv" id="ReportTablediv">

            <div class="container">
                <div class="col-md-12 main-dash">
                    
                    <div class="row expense-dash">
                      <div class="col-md-3">
                        <div class="card">
                          <div class="media">
                            <img src="icon/icon1.png" class="img-fluid" />
                            <div class="media-body">
                            <h4><b>No. <?php echo $tot_adv_req;?> </b> Expenses Claims</h4>
                            </div>
                            </div>
                            <h5><a href="#">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a></h5>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card4">
                          <div class="media">
                            <img src="icon/icon4.png" class="img-fluid" />
                            <div class="media-body">
                              <h4><b>No. <?php echo $tot_pend_cout; ?> </b> Waiting for <br/><span>Approval - Rs. <?php echo $tot_pend_amt;?></span></h4>
                            </div>
                            </div>
                            <h5><a href="#">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a></h5>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card2">
                          <div class="media">
                            <img src="icon/icon2.png" class="img-fluid" />
                            <div class="media-body">
                              <h4><b>No. 0 </b> Approved & Waiting for Verification - Rs. 0 <br/><span></span></h4>
                            </div>
                            </div>
                            <h5><a href="#">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a></h5>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="card card3">
                          <div class="media">
                            <img src="icon/icon3.png" class="img-fluid" />
                            <div class="media-body">
                              <h4><b>NO. 50  </b><br/> Verified & Settled</h4>
                            </div>
                            </div>
                            <h5><a href="#">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a></h5>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="card card8">
                          <div class="media">
                            <img src="icon/icon4.png" class="img-fluid" />
                            <div class="media-body">
                              <h4><b>No. 176 </b> Advance Not <br/><span>Settled</span></h4>
                            </div>
                            </div>
                            <h5><a href="#">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a></h5>
                        </div>
                      </div>

                      
                      
                    </div>
               </br>
                  <div class="dash_url">
                      <a href="expense_settlement.php">Expenses Claim Form</a>
                      <a href="view_expense_settlement.php">List Of Claims</a>
                  </div>
                </br>
                
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- select 2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<!-- datatables column visibility -->
<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="../global/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1"></script>
<!-- <script src="../global/vendor/jquery/jquery.minfd53.js?v4.0.1"></script> -->
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
<!-- <script src="../global/vendor/datatables.net-buttons/buttons.flash.minfd53.js?v4.0.1"></script> -->
<script src="../global/vendor/datatables.net-buttons/buttons.print.minfd53.js?v4.0.1"></script>
<script src="../global/vendor/datatables.net-buttons/buttons.colVis.minfd53.js?v4.0.1"></script>
<script src="../global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.minfd53.js?v4.0.1"></script>

<script src="../global/js/Plugin/datatables.minfd53.js?v4.0.1"></script>
<script src="../assets/js/menu.js?v4.0.1"></script>
<!-- <script src="chartGen.js"></script> -->
</body>
</html>