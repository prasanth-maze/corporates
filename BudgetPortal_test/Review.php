<?php 
  include 'header.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../assets/css/menu.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style type="text/css">
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
/*div.sticky {
  position: fixed;
  z-index: 99;
  background-color: green;
  display: none;
  max-height: 34px;
  margin-left: 20px;
}
.breadcrumb{
  height:30px;
  padding: 0.45rem 1.3rem !important;
}
.sticky a{
  color: white
}*/
div.sticky {
background-color: green;
  display: none;
}
.sticky a{
  color: white
}
.breadcrumb{
  height:30px;
  padding: 0.45rem 1.3rem !important;
}
td.dwbg{
  color:#000066 !important;background-color:#e6eeff;
}
td.dwobg{
  font-weight:bold !important;color:#000066 !important;background-color:white !important; 
}
th.dhbg{
  font-weight:bold !important;color:#000066 !important;background-color:#e6eeff !important;
}
th.dhnbg{
  font-weight:bold !important;color:#000066 !important;
}
.totdbg{
 font-weight:bold !important;color:#000066 !important;background-color:lightgreen !important;
}
tr.selectedRow{
  background-color:#8ED1F7 !important;
}


table {
  font-size: 13px; 
  table-layout: fixed;
  border-spacing: 0px;
  max-width: 1400px;
  color: black;
}

td, th {
  padding-left: 5px;
  padding-right: 5px;
}

.tr_shaded:nth-child(even) {
  background: #fff;
}

.tr_shaded:nth-child(odd) {
  background: #ffffff;
}

.scrolly_table {
  white-space: nowrap;
  overflow: auto;
}

/* The frozen cells will each get two class names,
   making it easier for me to select all of them or
   only a subset.  All frozen cells will be "fixed",
   the corner will also be in class "freeze", and the
   row and column headers will be "horizontal" and
   "vertical" respectively. */
.fixed.freeze {
  z-index: 10;
  position: relative;
}

.fixed.freeze_vertical {
  z-index: 5;
  position: relative;
}

.fixed.freeze_horizontal {
  z-index: 1;
  position: relative;
}
.total
{
  background-color: lightgreen !important;
  color: #000066;
  font-weight: bold !important;
}
.column
{
  background-color:#e6eeff;
  color: #000066;
}
th
{
  color: darkblue;
  font-weight: 800;
  text-align: center;
}
thead th, tbody td
{
  background-color: white;
  padding: 0.512rem;
  border: 0.5px solid #ddd;
  border-collapse: collapse;
}

</style>

<body class="animsition site-navbar-small dashboard" style="font-size: small;">
<div id="loader-wrapper" style="display: none;" >
    <div id="loader"></div>
</div>
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
                   <li class="nav-item" role="presentation">
                      <a class="nav-link active" data-toggle="tab" href="#bChartTab" aria-controls="bChartTab" role="tab" aria-selected="true">Chart</a>
                       <li class="nav-item" role="presentation"><a class="nav-link bdataTable" data-toggle="tab" href="#bdataTable" aria-controls="bdataTable" role="tab" aria-selected="false">Table</a></li>
                  </li>
                </ul>
                <div class="tab-content pt-20">
                  <div class="tab-pane active" id="bChartTab" role="tabpanel">
                       <div class="row">
                            <div class="col-xxl-4 col-lg-6">
                              <div class="panel panel-bordered">
                                <div class="panel-heading">
                                  <h3 class="panel-title" id="myBudgettitle">Monthly budget</h3>
                                </div>
                                <div class="panel-body" id="monthWiseBudgetChart">
                                </div>
                              </div>
                            </div>
                            <div class="col-xxl-4 col-lg-6">
                              <div class="panel panel-bordered">
                                <div class="panel-heading">
                                <h3 class="panel-title" id="geoBudgettitle">Business division</h3>
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
                                  <h3 class="panel-title" id="elmBudgettitle">Cost element group</h3>
                                </div>
                                <div class="panel-body" id="expenseChart">
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="tab-pane" id="bdataTable" role="tabpanel">
                       <div ng-controller="MainCtrl">
                         <div id="scrolling_table_1" class="scrolly_table" style="max-height:440px;margin-left: 19px;">
                        <table  id="newTable" style="color: black;font-size: 12px;">
                    <!-- style="background-color: #4682B4;" -->
                        <thead id="t_head" style="text-align: center;" >
                        </thead>
                        <tbody id="t_body">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                    </div>

                  </div>
                </div>
              </div>
               
            </div>
          </div>
	
  </div>
  </div>
  </div>
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
</body>
  <script src="../global/js/Plugin/datatables.minfd53.js?v4.0.1"></script>
<script src="../assets/js/menu.js?v4.0.1"></script>
   <script src="../global/js/jquery.serializeObject.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
  <script  src="../global/js/CustomFunction.js"></script>

  <script src="BudgetReview.js"></script>
  <!-- <script src="BudgetFilter.js"></script> -->
  
  <script type="text/javascript">
  function freeze_pane_listener(what_is_this, table_class) {
  // Wrapping a function so that the listener can be defined
  // in a loop over a set of scrolling table id's.
  // Cf. http://stackoverflow.com/questions/750486/javascript-closure-inside-loops-simple-practical-example
  
  return function() {
    var i;
    var translate_y = "translate(0," + what_is_this.scrollTop + "px)";
    var translate_x = "translate(" + what_is_this.scrollLeft + "px,0px)";
    var translate_xy = "translate(" + what_is_this.scrollLeft + "px," + what_is_this.scrollTop + "px)";
    
    var fixed_vertical_elts = document.getElementsByClassName(table_class + " freeze_vertical");
    var fixed_horizontal_elts = document.getElementsByClassName(table_class + " freeze_horizontal");
    var fixed_both_elts = document.getElementsByClassName(table_class + " freeze");
    
    // The webkitTransforms are for a set of ancient smartphones/browsers,
    // one of which I have, so I code it for myself:
    for (i = 0; i < fixed_horizontal_elts.length; i++) {
      fixed_horizontal_elts[i].style.webkitTransform = translate_x;
      fixed_horizontal_elts[i].style.transform = translate_x;
    }

    for (i = 0; i < fixed_vertical_elts.length; i++) {
       fixed_vertical_elts[i].style.webkitTransform = translate_y;
       fixed_vertical_elts[i].style.transform = translate_y;
    }

    for (i = 0; i < fixed_both_elts.length; i++) {
       fixed_both_elts[i].style.webkitTransform = translate_xy;
       fixed_both_elts[i].style.transform = translate_xy;
    }
  }
}

function even_odd_color(i) {
  if (i % 2 == 0) {
    return "#ffffff";
  } else {
    return "#ffffff";
  }
}

function parent_id(wanted_node_name, elt) {
  // Function to work up the DOM until it reaches
  // an element of type wanted_node_name, and return
  // that element's id.
  
  var wanted_parent = parent_elt(wanted_node_name, elt);
  
  if ((wanted_parent == undefined) || (wanted_parent.nodeName == null)) {
    // Sad trombone noise.
    return "";
  } else {
    return wanted_parent.id;
  }
}

function parent_elt(wanted_node_name, elt) {
  // Function to work up the DOM until it reaches 
  // an element of type wanted_node_name, and return
  // that element.
  
  var this_parent = elt.parentElement;
  if ((this_parent == undefined) || (this_parent.nodeName == null)) {
    // Sad trombone noise.
    return null;
  } else if (this_parent.nodeName == wanted_node_name) {
    // Found it:
    return this_parent;
  } else {
    // Recurse:
    return parent_elt(wanted_node_name, this_parent);
  }
}

var i, parent_div_id, parent_tr, table_i, scroll_div;
var scrolling_table_div_ids = ["scrolling_table_1", "scrolling_table_2"];

// This array will let us keep track of even/odd rows:
var scrolling_table_tr_counters = [];
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scrolling_table_tr_counters.push(0);
}

// Append the parent div id to the class of each frozen element:
var fixed_elements = document.getElementsByClassName("fixed");
for (i = 0; i < fixed_elements.length; i++) {
  fixed_elements[i].className += " " + parent_id("DIV", fixed_elements[i]);
}

// Set background colours of row headers, alternating according to 
// even_odd_color(), which should have the same values as those
// defined in the CSS for the tr_shaded class.
var fixed_horizontal_elements = document.getElementsByClassName("freeze_horizontal");
for (i = 0; i < fixed_horizontal_elements.length; i++) {
  parent_div_id = parent_id("DIV", fixed_horizontal_elements[i]);
  table_i = scrolling_table_div_ids.indexOf(parent_div_id);
  
  if (table_i >= 0) {
    parent_tr = parent_elt("TR", fixed_horizontal_elements[i]);
    
    if (parent_tr.className.match("tr_shaded")) {
      fixed_horizontal_elements[i].style.backgroundColor = even_odd_color(scrolling_table_tr_counters[table_i]);
      scrolling_table_tr_counters[table_i]++;
    }
  }
}

// Add event listeners.
for (i = 0; i < scrolling_table_div_ids.length; i++) {
  scroll_div = document.getElementById(scrolling_table_div_ids[i]);
  scroll_div.addEventListener("scroll", freeze_pane_listener(scroll_div, scrolling_table_div_ids[i]));
}
</script>
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>
