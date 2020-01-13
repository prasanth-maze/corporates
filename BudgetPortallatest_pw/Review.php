<?php 
  include 'header.php';
?>
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../assets/css/menu.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style type="text/css">
td,th {
    white-space: nowrap;
}
/*body{
  overflow-y: hidden;
overflow-x: hidden; 
}*/
.page
{
	margin-top: 0px !important;
}

  .card-block1{ 
    position: relative;
    padding: 0.429rem;
    background-color: white;
}
  .drilldown{
    cursor: pointer;
}
[data-hightlt="Yes"] {
  background-color: #8ED1F7;
  }
tr.currentbudgetrow {
  background-color: #8ED1F7;
}
.control-label{
font-weight: bold;
color: grey;
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
    margin: 0 0 0 0px;
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
  display: none;
    max-height: 100% !important;
    width: 100%;
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
}
.plan,.actual,.var,.varp{
  text-align: right;
}
.ReviewRemark{
  text-align: center;
}
.costElementCol{
font-weight:bold;
color:#000066;
}
 .resTbl1 { 
            width: 80%; 
            overflow-x:scroll;  
            margin-left:5em; 
            overflow-y:visible;
            padding-bottom:1px;
        }
div.sticky {
  position: fixed;
  z-index: 99;
  background-color: green;
  display: none;
}
.breadcrumb{
  height:30px;
}
.sticky a{
  color: white
}
/*#TableReview{
  max-width: 1270px;
  max-height: auto;
  overflow-x: scroll;
  overflow-y: scroll;
}*/

#BudgetRemarkdiv {
    display:none;
    background-color: #fff;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    -khtml-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 3px 3px 3px 3px rgba(0, 0, 0, 0.2);
    box-shadow: 3px 3px 3px 3px rgba(0, 0, 0, 0.2);
    border: 2px solid #BBB;
    width:210px;
    min-height:100px;
    max-height:auto;
    color: #333;
    position:absolute;
    z-index:10002;
    /*overflow-x: scroll;
    overflow-y: scroll;*/
}
/*Table Freeze code*/
table {
  position: relative;
  width: 100%;
  /*background-color: #aaa;*/
  overflow: hidden;
  border-collapse: collapse;
  height: auto;
}



/*thead*/
thead {
  position: relative;
  display: block; /*seperates the header from the body allowing it to be positioned*/
  width: 700px;

  overflow: visible;
  /*white-space: nowrap;*/
}

thead th {
  /*background-color: #99a;*/
  min-width: 120px;
  /*height: 32px;*/
  border: 1px solid #222;
  width: 250px;
  text-align: center;

}

thead th:nth-child(1) {/*first cell in the header*/
  min-width: 233px;
  position: relative;
  /*display: block;*/ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}
thead th:nth-child(2) {/*first cell in the header*/
  position: relative;
  /* display: block; */ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}
thead th:nth-child(3) {/*first cell in the header*/
  position: relative;
  /* display: block; */ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}
thead th:nth-child(4) {/*first cell in the header*/
  position: relative;
  /* display: block; */ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}
thead th:nth-child(5) {/*first cell in the header*/
  position: relative;
  /* display: block; */ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}
thead th:nth-child(6) {/*first cell in the header*/
  position: relative;
  /* display: block; */ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}
thead th:nth-child(7) {/*first cell in the header*/
  position: relative;
  /* display: block; */ /*seperates the first cell in the header from the header*/
  background-color: #fff;
}

/*#colspanhead
{
    border-left: solid 1px #DDEFEF;
    border-right: solid 1px #DDEFEF;
    left: 0;
    position: absolute;
    top: auto;
    width: 120px;
}*/


/*tbody*/
tbody {
  position: relative;
  display: block; /*seperates the tbody from the header*/
  width: 1250px;
  height: 500px;
  overflow: scroll;
  /*white-space: nowrap;*/
}

tbody td {
 /* background-color: #bbc;*/
  min-width: 120px;
  border: 1px solid #222;
  width: 250px;
}

tbody tr td:nth-child(1) {  /*the first cell in each tr*/
  position: relative;
  /*display: block;*/ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
      white-space: nowrap;
}
tbody tr td:nth-child(2) {  /*the first cell in each tr*/
  position: relative;
  /* display: block; */ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}
/*For Table Body Row Freezing*/
tbody tr:nth-child(1) {  /*the first cell in each tr*/
  position: relative;
  display: fixed; /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
      white-space: nowrap;
}
tbody tr:nth-child(2) {  /*the first cell in each tr*/
  position: relative;
   display: fixed;  /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}
tbody tr td:nth-child(3) {  /*the first cell in each tr*/
  position: relative;
  /* display: block; */ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}
tbody tr td:nth-child(4) {  /*the first cell in each tr*/
  position: relative;
  /* display: block; */ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}
tbody tr td:nth-child(5) {  /*the first cell in each tr*/
  position: relative;
  /* display: block; */ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}
tbody tr td:nth-child(6) {  /*the first cell in each tr*/
  position: relative;
  /* display: block; */ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}
tbody tr td:nth-child(7) {  /*the first cell in each tr*/
  position: relative;
  /* display: block; */ /*seperates the first column from the tbody*/
  /*height: 40px;*/
  background-color: #fff;
}


.content-loader table {
    width: auto;
    background: #aaa;
}
/*th.ElemGroupCol.freezeClass
{
  min-width: 250px;
  position: relative;
  /*display: block;*/ /*seperates the first column from the tbody*/
 /* height: 55px;*/
  /*background-color: #fff;*/
/*}*/
td.freezeClass1
{
  border:none; 
}
.feg1,.fce1,.fbd1,.fdep1,.fdv1,.frgn1,.fter1{
  /*background:#02cf92;*/
  color: white;
  /*font-size: 14px;*/
  font-weight: bold;
}
.table td, .table th
{
  vertical-align: middle;
  padding:2px; 
}
.table thead th
{
  vertical-align: middle;
  text-align: center;
}
</style>

<body class="animsition site-navbar-small dashboard" style="font-size: small;">
<div id="loader-wrapper" style="display: none;" >
    <div id="loader"></div>
</div>

  <?php

    include 'top_nav.php';

   ?>
  <div class="page" >
    <div class="page-content container-fluid ">
        
		<div class="panel panel-bordered resTbl">
            
            <div class="panel-body" >
				<div class="nav-tabs-horizontal" data-plugin="tabs">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"   href="#bChartTab" aria-controls="bChartTab" role="tab">Chart</a></li>
                     <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"   href="#bdataTable" aria-controls="bdataTable" role="tab">Table</a></li>
                  </ul>
                                     <div class="tab-content pt-20">
                    <div class="tab-pane active" id="bChartTab"  role="tabpanel">
                       <div class="row">
                            <div class="col-xxl-4 col-lg-6">
                              <div class="panel panel-bordered">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Monthly Budget</h3>
                                </div>
                                <div class="panel-body" id="monthWiseBudgetChart">
                                </div>
                              </div>
                            </div>
                            <div class="col-xxl-4 col-lg-6">
                              <div class="panel panel-bordered">
                                <div class="panel-heading">
                                <h3 class="panel-title" id="geoBudgettitle">Business Division</h3>
                                </div>
                                <div class="panel-body" id="geoBudgetChart">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xxl-12 col-lg-12">
                              <div class="panel panel-bordered">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Expense Chart</h3>
                                </div>
                                <div class="panel-body" id="expenseChart">
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="tab-pane" id="bdataTable"  role="tabpanel">
                          <table class="table table-bordered" id="newTable" style="color: black;font-size: 12px;">
                      <thead class="table-head" id="t_head" style="text-align: center;" >
                      </thead>
                      <tbody id="t_body" class="table-body">
                        
                      </tbody>
                    </table>
                    </div>
                   </div>
              </div>
            </div>
          </div>
	
  </div>
  </div>
  <!-- Review Remark Div -->
  <div id="BudgetRemarkdiv"> 
  </div>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="../global/js/Plugin/datatables.minfd53.js?v4.0.1"></script>
<script src="../assets/js/menu.js?v4.0.1"></script>
   <script src="../global/js/jquery.serializeObject.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
  <script src="BudgetReview.js"></script>
  <!-- <script src="BudgetFilter.js"></script> -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>

<script type="text/javascript">
//Modal Save Button
// Remark Update into table
  function ReviemRemarkSave(val){
    // This modal id is the class of this text area(input)
    var ModalID = $(val).parent().parent().parent().parent().attr('id');
    // Checking Input Box value is not empty
    var CommentAction={};
    var CommentVal = $("."+ModalID).val();
    CommentAction['Action'] = CommentVal;
    if(CommentVal !=""){
        // Calling Remark Update Page
        $.ajax({
        data: CommentAction,
             type: "post",
             url: "ReviewRemarkUpdate.php",
             success: function(data){
              if(data == "Submission successful."){
                // To identify current comment section is Saved or not
                $(val).parent().parent().parent().parent().parent().children().first().css("color","red");
              }
            }
      });
    }else{
      alert("Please Enter Some Text.....");
    }
}
// Modal Reset Button
  function ReviemRemarkReset(val){
    // $('.RevCommentReset').click(function() {
      // This modal id is the class of this text area(input)
      var ModalID = $(val).parent().parent().parent().parent().attr('id');
      // Resetting Input field
      $("."+ModalID).val("");
    // });
  }
  
</script>