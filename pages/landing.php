<?php 
  include 'header.php';
?>
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<!-- <link rel="stylesheet" href="../assets/css/font-awesome.min.css?v4.0.1"> -->
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
}
/*div#myDIV {
    max-height: 100%;
    width: 100%;
    margin-left: 262px;

}*/
.container {
    max-width: 100%;
    background-color: #fff;
    max-height: 100%;
    padding: 1%;
    margin-top: 50px;

}
.row .land
{
  margin-left: 2%;
}
.site-footer
{
  height:  40px !important;
  background-color: #ccc;
  color: black;
 }
.site-footer a
{
  color: darkgreen;
}
body.site-navbar-small
{
  
}
.icon, .media-body1
{
text-align: center;
text-decoration: none;
}

img
{
    width: 40%;
    height: 50px;
}
.dashboard
{
  background: #f1f4f5;
  background-repeat: no-repeat;
  background-size: cover;
}
.page {
    margin-top: 0px;
}
.shrink:hover
{
        -webkit-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
}
.grow:hover
{
        -webkit-transform: scale(1.2);
        -ms-transform: scale(1.2);
        transform: scale(1.2);
}
h6
{
font-weight: bold;
}
rasi-main
{
  text-align: center;
}
</style>


<body class="animsition site-navbar-small dashboard" style="font-size: small;">


  <?php

    include 'top_nav_home.php';

   ?>
<div class="page">
  <div class="page-content container-fluid">

  <div class="container">
    <section>
     <div class="row">
      <div class="col-md-4">
        <a href="landing.php">
        <div class="rasi-main1">
        <img src="../assets/images/rasi-main.png" alt="main logo" style="width:30%;height: 110px;">
      </a>
        </div>
        
      </div>
      <div class="col-md-4" style="text-align: center;">
        <h2 style="font-weight: 400">Corporate Portal</h2>
      </div>
      <div class="col-md-4">
        <div class="rasi-logo" style="float:right;">
        <a href="index.php">
        <img src="../global/photos/logo.png" alt="main logo" style="width:100%;height: 100%;">
      </a>
        </div>
      </div>
     </div>
    </section>
    <section style="margin-top: -1%">
   <div class="row" style="margin-left: 27%">

    <div class="col-md-3 grow">
       <a href="../APExpenses/advancedashboard.php" target="_blank">
      <div class="icon">
       
        <img src="../assets/images/area-chart.png" alt="a & p portal" style="width:30%;height: 60px;"></div>
              <div class="media-body">
                <h4 class="heading mb-4" style="text-align: center;">A & P Portal</h4>
                </div>
              </a>
    </div>
    <div class="col-md-3 grow" style="margin-left: -10%;">
       <a href="../PDTrail/PDTrailDashBoard.php" target="_blank">
      <div class="icon"><img src="../assets/images/cube1.png" alt="pd rials" style="width:30%;height: 60px;"></div>
              <div class="media-body">
                <h4 class="heading mb-4" style="text-align: center;">PD Trials</h4>
                </div></a>
    </div>
	<?php
		if($_SESSION['finRights']==1){
	?>
    <div class="col-md-4 grow" style="margin-left: -12%;
    top: 5px;">
       <a href="../BudgetPortal/Review.php" target="_blank">
      <div class="icon"><img src="../assets/images/rupees.png" alt="budget tools" style="width:16%;height: 50px;margin-top: 6px;"></div>
              <div class="media-body">
                <h4 class="heading mb-4" style="text-align: center;">Financial Dashboard</h4>
                </div></a>
    </div>
		<?php } ?>
  </div>
  </section>
  <?php
		if($_SESSION['Dcode']=='ADMIN'){
	?>
  <section  style="margin-top: 5%;width: 100%; ">
     <div class="row" style="margin:auto;border:2px solid #aaa; ">
      <div class="col" style="border-right: 2px solid #aaa;">
        <a href="https://saprouter.rasiseeds.com:44301/webgui" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/sap.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 19px; ">  
          <h6 class="media-body" style="text-align:center;">SAP</h6>
        </div></a>

        
      </div>
      <div class="col">
        <a href="https://biometric.rasiseeds.com/iClock/" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/biomatic.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px;">  
          <h6 class="media-body" style="text-align:center;">Biometric</h6>
        </div></a>
        
      </div>
      <div class="col">
        <a href="https://ess.rasiseeds.com/hr/login.php" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/relyon.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px; ">  
          <h6 class="media-body" style="text-align:center;">Employee Service Portal</h6>
        </div></a>
        
      </div>
      <div class="col" style="border-right: 2px solid #aaa;">
        <a href="https://travel.rasiseeds.com/JSMeHRIS/Default.aspx" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/hris.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px; ">  
          <h6 class="media-body" style="text-align:center;">Travel & HRMS</h6>
        </div></a>
        
      </div>
      <div class="col">
        <a href="https://rasiconnect.rasiseeds.com/views/Mng_loginpage.aspx" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/connect.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px; ">  
          <h6 class="media-body" style="text-align:center;">RasiConnect Cotton</h6>
        </div></a>
        
      </div>
      <div class="col">
        <a href="https://rasiconnect.rasiseeds.com/views/Mng_loginpage.aspx" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/connect.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px;">  
          <h6 class="media-body" style="text-align:center;">RasiConnect Field Crops</h6>
        </div></a>
        
      </div>
      <div class="col" style="border-right: 2px solid #aaa;">
        <a href="https://rasigencheck.rasiseeds.com/views/Mng_loginpage.aspx" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/Eggplant.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px; ">  
          <h6 class="media-body" style="text-align:center;">GenCheck</h6>
        </div></a>
        
      </div>
      <div class="col" style="border-right: 2px solid #aaa;">
        <a href="https://www.complinity.com/" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/complinity.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px; ">  
          <h6 class="media-body" style="text-align:center;">Complinity</h6>
        </div></a>
        
      </div>
      <div class="col">
        <a href="https://webmail.rasiseeds.com/" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/zimbra.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px; ">  
          <h6 class="media-body" style="text-align:center;">Mail Server</h6>
        </div></a>
        
      </div>
      <div class="col">
        <a href="https://outlook.office365.com/owa/" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/office.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px;">  
          <h6 class="media-body" style="text-align:center;">Office365</h6>
        </div></a>
        
      </div>
      <div class="col">
        <a href="https://app.powerbi.com/home" target="_blank">
        <div class="rasi-main grow">
        <img src="../assets/images/powerbi.png" alt="main logo" style="width:75%;height: 100%;padding-top: 15px;margin-left: 15px;">  
          <h6 class="media-body" style="text-align:center;">PowerBI</h6>
        </div></a>
        
      </div>
      <!-- <div class="col-md-1">
        <img src="../assets/images/rasi-main.jpeg" alt="main logo">
      </div> -->
      
      </div>
    </section>

		<?php } ?>

  </div>
 </div>
 </div>


  <footer class="site-footer">
    <div class="site-footer-legal">2019 <a href="#"></a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://www.agnaindia.com/" target="_blank">Agna</a>
    </div>
  </footer>
  </div>
  <!-- Core  -->
  <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../global/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1"></script>
  <script src="../global/vendor/jquery/jquery.minfd53.js?v4.0.1"></script>
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
  <script>
    Config.set('assets', 'assets');
  </script>

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
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

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


  <!-- <script src="chartGen.js"></script> -->
  
  
  <script src="../assets/js/menu.js?v4.0.1"></script>



</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>