<?php 
  include 'header.php';
?>
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../assets/css/menu.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
    max-width: 16.66% !important;
    -webkit-box-flex: 0;
    flex: 0 0 16.66%;
    position: relative;
    min-height: 1px;
    padding-right: 1.0715rem;
    padding-left: 1.0715rem;
}
.count
{
  margin-left: 40%;
}
.ct-chart-1
{
  margin-top: 6%;
  position: relative;
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
.highcharts-axis-labels text {
    text-decoration: underline !important;
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
  <!-- Page -->
  <div class="page" >
    <div class="page-content container-fluid ">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
        
          <div class="column-3 col col-sm-12">
          <!-- Widget Linearea One-->
          <a href="#ReportTablediv" title="Click to view the sowing data" class="restabs1" data-filter="SOWING" data-tbl="sowingRestbl" data-tab="sowingRes">
            <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Sowing
                </div>
                
              </div>
              <div class="mb-20 grey-500">
               
              </div>
			  <span class="grey-800 font-size-20 count stage_sowing">0</span>
              <div class="ct-chart-1 h-50">
			  <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C8.829,45.833,17.658,43.056,26.487,37.5C35.315,31.944,44.144,12.5,52.973,12.5C61.802,12.5,70.631,25,79.46,25C88.289,25,97.118,6.25,105.946,6.25C114.775,6.25,123.604,35,132.433,35C141.262,35,150.091,31.25,158.92,31.25C167.749,31.25,176.577,43.75,185.406,50L185.406,50Z" class="ct-area" style="fill:#7CB5EC;fill-opacity: 1;" ></path></g></g><g class="ct-labels"></g></svg>
			  </div>
            </div>
          </div></a>
          <!-- End Widget Linearea One -->
        </div>
      
        <div class="column-3 col-sm-12">
          <!-- Widget Linearea Two -->
          <a href="#ReportTablediv" class="restabs1" title="Click to view the 70-80 day data" data-filter="70-80" data-tbl="70-80dayRestbl" data-tab="70-80Res">
          <div class="card card-shadow" id="widgetLineareaTwo">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  70-80 Days
                </div>
                
              </div>
              <div class="mb-20 grey-500">
                
              </div>
			  <span class="grey-800 font-size-20 count stage_70_80">0</span>
              <div class="ct-chart-1 h-50">
			  <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C7.725,47.917,15.451,46.97,23.176,43.75C30.901,40.53,38.626,22.5,46.352,22.5C54.077,22.5,61.802,25,69.527,25C77.253,25,84.978,15,92.703,15C100.428,15,108.154,21.25,115.879,21.25C123.604,21.25,131.329,8.75,139.055,8.75C146.78,8.75,154.505,13.699,162.23,18.75C169.956,23.801,177.681,39.583,185.406,50L185.406,50Z" class="ct-area" style="fill:#434348;fill-opacity: 1;"></path></g></g><g class="ct-labels"></g></svg>
			  </div>
            </div>
          </div>
        </a>
          <!-- End Widget Linearea Two -->
        </div>
        <div class="column-3 col-md-12">
          <!-- Widget Linearea One-->
           <a href="#ReportTablediv" class="restabs1" title="Click to view the 120-130 days data" data-filter="120-130" data-tbl="120-130Restbl" data-tab="120-130Res"> 
            <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-trending-up grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  120-130 Days
                </div>
                
              </div>
              <div class="mb-20 grey-500">
               
              </div>
			  <span class="grey-800 font-size-20 count stage_120_130">0</span>
              <div class="ct-chart-1 h-50">
                <svg  width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C8.075,45,16.15,40,24.225,35C32.299,30,40.374,20.769,48.449,20C56.524,19.231,64.599,19.508,72.674,18.75C80.749,17.992,88.824,6.25,96.898,6.25C104.973,6.25,113.048,25,121.123,25C129.198,25,137.273,18.75,145.348,18.75C153.423,18.75,161.497,29.8,169.572,35C177.647,40.2,185.722,45,193.797,50L193.797,50Z" class="ct-area" style="fill:#90ED7D;fill-opacity: 1;"></path></g></g></svg>
              </div>
            </div></div></a>
          </div>
          <!-- End Widget Linearea One -->
       
         <div class="column-3 col-sm-12">
          <!-- Widget Linearea Three -->
          <a href="#ReportTablediv" title="Click to view the 150-160 data" class="restabs1" data-filter="150-160" data-tbl="150-160Restbl"  data-tab="150-160Res"> 
           <div class="card card-shadow" id="widgetLineareaThree">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  150-160 Days
                </div>
                
              </div>
              <div class="mb-20 grey-500">
               
              </div>
			  <span class="grey-800 font-size-20 count stage_150_160">0</span>
              <div class="ct-chart-1 h-50">
			  <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C8.829,41.667,17.658,25,26.487,25C35.315,25,44.144,31.25,52.973,31.25C61.802,31.25,70.631,6.25,79.46,6.25C88.289,6.25,97.118,22.5,105.946,22.5C114.775,22.5,123.604,12.5,132.433,12.5C141.262,12.5,150.091,35.111,158.92,40C167.749,44.889,176.577,46.667,185.406,50L185.406,50Z" class="ct-area"style="fill:#F7A35C;fill-opacity: 1;"></path></g></g><g class="ct-labels"></g></svg>
			  </div>
            </div>
          </div>
        </a>

          <!-- End Widget Linearea Three -->
        </div>
        <div class="column-3 col-sm-12">
          <!-- Widget Linearea Three -->
          <a href="#ReportTablediv" title="Click to view the picking & yield data" class="restabs1" data-filter="YIELD" data-tbl="pickingyieldRestbl"  data-tab="pickingyieldRes"> 
           <div class="card card-shadow" id="widgetLineareaThree">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Picking & Yield
                </div>
                
              </div>
              <div class="mb-20 grey-500">
               
              </div>
			  <span class="grey-800 font-size-20 count stage_picking_yield">0</span>
              <div class="ct-chart-1 h-50">
			  <svg  width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C8.075,45,16.15,40,24.225,35C32.299,30,40.374,20.769,48.449,20C56.524,19.231,64.599,19.508,72.674,18.75C80.749,17.992,88.824,6.25,96.898,6.25C104.973,6.25,113.048,25,121.123,25C129.198,25,137.273,18.75,145.348,18.75C153.423,18.75,161.497,29.8,169.572,35C177.647,40.2,185.722,45,193.797,50L193.797,50Z" class="ct-area" style="fill:#8085E9;fill-opacity: 1;"></path></g></g></svg>
			  </div>
            </div>
          </div>
        </a>

          <!-- End Widget Linearea Three -->
        </div>
        <div class="column-3 col-sm-12">
          <!-- Widget Linearea Four -->
          <a href="#ReportTablediv" title="Click to view the closed data" class="restabs1" data-filter="CLOSED" data-tbl="closedResTable"  data-tab="closedRes"> 
            <div class="card card-shadow" id="widgetLineareaFour">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Closed
                </div>
                
              </div>
              <div class="mb-20 grey-500">
               
              </div>
			  <span class="grey-800 font-size-20 count stage_closed">0</span>
              <div class="ct-chart-1 h-50">
			  <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C7.725,45,15.451,40,23.176,35C30.901,30,38.626,20.769,46.352,20C54.077,19.231,61.802,19.508,69.527,18.75C77.253,17.992,84.978,6.25,92.703,6.25C100.428,6.25,108.154,25,115.879,25C123.604,25,131.329,18.75,139.055,18.75C146.78,18.75,154.505,29.8,162.23,35C169.956,40.2,177.681,45,185.406,50L185.406,50Z" class="ct-area" style="fill:#F15C80;fill-opacity: 1;"></path></g></g><g class="ct-labels"></g></svg>
			  </div>
            </div>
          </div>
        </a>
          <!-- End Widget Linearea Four -->
        </div>
        
          
                     <!-- Modal -->
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
                    <div class="tab-pane popres-pane active" id="exampleTabsOne" role="tabpanel">
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
                    <label class="col-sm-6 control-label">No of Trail Covered:</label>
                    <label name="" class="col-sm-6 respopdata respopdata25"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">No of Villages Covered:</label>
                    <label name="" class="col-sm-6 respopdata respopdata26"></label>
                  </div>
                  <div class="row modal-form">
                    <label class="col-sm-6 control-label">No of Hybrid Covered:</label>
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
                  <!-- End Modal -->
        </div>
          <div class="row col-xxl-12" style="margin-left: 15%;margin-bottom: -1%;margin-top: -1%;"> 
      <div class="col-lg-4">
            <div class="panel">
            <div class="card-block1">
              <h4 style="text-align: center;">No of Trails</h4>
              <h4 style="text-align: center;" class="ntrails">0</h4>
            </div>
            </div>
      </div>
      <div class="col-lg-4">
            <div class="panel">
            <div class="card-block1">
              <h4 style="text-align: center;">Hybrids Covered</h4>
              <h4 style="text-align: center;" class="hcovered">0</h4>
            </div>
            </div>
      </div>
  </div> 
       <div class="row">
         <div class="col-xxl-12 col-lg-6 chartDiv" >
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="panel-title">Geographical Wise Chart  </h3>
            </div>
            <div class="panel-body" id="LocationWiseChartContainer" >
              <!-- <div id="LocationWiseChartContainer" ></div>
             </div> -->
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>
          <div class="col-xxl-12 col-lg-6 chartDiv">
          <!-- Example Panel With All -->
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="panel-title">Activity Wise Chart <img src="../global/photos/mini.png" class="wsizebtn" style="float:right;width: 20px;"></h3>
            </div>
            <div class="panel-body" id="ActivityWiseChartContainer">
              
            </div>
          </div>
          <!-- End Example Panel With All -->
        </div>

        <div class="col-xxl-12 col-lg-12 chartDiv">
          <!-- Example Panel With Footer -->
          <div class="panel panel-bordered" >
            <div class="panel-heading">
              <h3 class="panel-title">Hybrid Wise Chart <img src="../global/photos/mini.png" class="wsizebtn" style="float:right;width: 20px;"></h3>
            </div>
            <div class="panel-body" id="ProductWiseChartContainer">
              
            </div>
          </div>
          <!-- End Example Panel With Footer -->
        </div>

      <div class="col-xxl-12 col-lg-12" id="resultarea">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">PD Trails Report</h3>
            </div>
            <div class="panel-body ReportTablediv" id="ReportTablediv">
            <div class="nav-tabs-horizontal" data-plugin="tabs">
                <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link restabs active sowingRes" data-toggle="tab" data-filter="SOWING" data-tbl="sowingRestbl"  href="#sowingRes" aria-controls="sowingRes" role="tab">SOWING</a></li> 
            <li class="nav-item" role="presentation"><a class="nav-link restabs 70_80Res" data-toggle="tab" data-filter="STAGE_70_80" data-tbl="70_80Restbl"  href="#70_80Res" aria-controls="70_80Res" role="tab">70-80 Days</a></li>
             <li class="nav-item" role="presentation"><a class="nav-link restabs 120_130Res" data-toggle="tab" data-filter="STAGE_120_130" data-tbl="120_130Restbl"  href="#120_130Res" aria-controls="120_130Res" role="tab">120-130 Days</a></li> 
             <li class="nav-item" role="presentation"><a class="nav-link restabs 150_160Res" data-toggle="tab" data-filter="STAGE_150_160" data-tbl="150_160Restbl"  href="#150_160Res" aria-controls="150_160Res" role="tab">150-160 Days</a></li>
             <li class="nav-item" role="presentation"><a class="nav-link restabs pyRes" data-toggle="tab" data-filter="STAGE_PICKING_YIELD" data-tbl="pyRestbl"  href="#pyRes" aria-controls="pyRes" role="tab">Picking & Yield</a></li>
             <li class="nav-item" role="presentation"><a class="nav-link restabs closedRes" data-toggle="tab" data-filter="STAGE_CLOSED" data-tbl="closedRestbl"  href="#closedRes" aria-controls="closedRes" role="tab">Closed</a></li>
              
                </ul>
                <div class="tab-content pt-20">
                    <div class="tab-pane restabpanel active" id="sowingRes"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="sowingRestbl" data-loaded='no'>
                          <thead>
                              <tr>
                                   <th>SNo</th><th>loccode</th><th>Year</th><th>Division</th><th>StateRegion</th><th>Irrigation_Type</th><th>Soil_type</th><th>Territory</th><th>Crop_Management</th><th>TM_Name</th><th>PO_Name</th><th>District</th><th>Mandal_Taluk</th><th>Village</th><th>Farmer_Name</th><th>Contact_No</th><th>Spacing</th><th>plot</th><th>entry</th><th>bloc</th><th>name</th><th>checks</th><th>dos</th><th>gpsLocation</th><th>Imagepath</th><th>Latitude</th><th>Longitude</th><th>plntvgr</th><th>jassid1</th><th>whitefly1</th><th>thrips1</th><th>clcuv1</th><th>gapfill</th><th>sym_sym</th><th>boll_boll</th><th>jassid2</th><th>whitefly2</th><th>thrips2</th><th>clcuv2</th><th>shedded2</th><th>no_boll</th><th>bo_weight</th><th>ease_to_pick</th><th>clcuv3</th><th>parawilt</th><th>no_mono</th><th>no_sympo</th><th>stay_green</th><th>rejuvination</th><th>pick1_dt</th><th>pick2_dt</th><th>pick3_dt</th><th>pick4_dt</th><th>pick_1</th><th>pick_2</th><th>pick_3</th><th>pick_4</th><th>yield_plot</th><th>plot_size</th><th>yield_ac</th><th>remarks</th><th>frmr_feedback</th><th>PO_Code</th><th>TM_Code</th><th>StageStatus</th><th>LatLng</th><th>LatLngRoute</th><th>TMID</th><th>REGIONID</th><th>ZONEID</th><th>POHQCODE</th><th>DIVISION2</th>
                              </tr>
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                    <div class="tab-pane restabpanel" id="70_80Res"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="70_80Restbl" data-loaded='no'>
                          <thead>
                              <tr>
                                   <th>SNo</th><th>loccode</th><th>Year</th><th>Division</th><th>StateRegion</th><th>Irrigation_Type</th><th>Soil_type</th><th>Territory</th><th>Crop_Management</th><th>TM_Name</th><th>PO_Name</th><th>District</th><th>Mandal_Taluk</th><th>Village</th><th>Farmer_Name</th><th>Contact_No</th><th>Spacing</th><th>plot</th><th>entry</th><th>bloc</th><th>name</th><th>checks</th><th>dos</th><th>gpsLocation</th><th>Imagepath</th><th>Latitude</th><th>Longitude</th><th>plntvgr</th><th>jassid1</th><th>whitefly1</th><th>thrips1</th><th>clcuv1</th><th>gapfill</th><th>sym_sym</th><th>boll_boll</th><th>jassid2</th><th>whitefly2</th><th>thrips2</th><th>clcuv2</th><th>shedded2</th><th>no_boll</th><th>bo_weight</th><th>ease_to_pick</th><th>clcuv3</th><th>parawilt</th><th>no_mono</th><th>no_sympo</th><th>stay_green</th><th>rejuvination</th><th>pick1_dt</th><th>pick2_dt</th><th>pick3_dt</th><th>pick4_dt</th><th>pick_1</th><th>pick_2</th><th>pick_3</th><th>pick_4</th><th>yield_plot</th><th>plot_size</th><th>yield_ac</th><th>remarks</th><th>frmr_feedback</th><th>PO_Code</th><th>TM_Code</th><th>StageStatus</th><th>LatLng</th><th>LatLngRoute</th><th>TMID</th><th>REGIONID</th><th>ZONEID</th><th>POHQCODE</th><th>DIVISION2</th>
                              </tr>
                              
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                    <div class="tab-pane restabpanel" id="120_130Res"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="120_130Restbl" data-loaded='no'>
                          <thead>
                              <tr>
                                   <th>SNo</th><th>loccode</th><th>Year</th><th>Division</th><th>StateRegion</th><th>Irrigation_Type</th><th>Soil_type</th><th>Territory</th><th>Crop_Management</th><th>TM_Name</th><th>PO_Name</th><th>District</th><th>Mandal_Taluk</th><th>Village</th><th>Farmer_Name</th><th>Contact_No</th><th>Spacing</th><th>plot</th><th>entry</th><th>bloc</th><th>name</th><th>checks</th><th>dos</th><th>gpsLocation</th><th>Imagepath</th><th>Latitude</th><th>Longitude</th><th>plntvgr</th><th>jassid1</th><th>whitefly1</th><th>thrips1</th><th>clcuv1</th><th>gapfill</th><th>sym_sym</th><th>boll_boll</th><th>jassid2</th><th>whitefly2</th><th>thrips2</th><th>clcuv2</th><th>shedded2</th><th>no_boll</th><th>bo_weight</th><th>ease_to_pick</th><th>clcuv3</th><th>parawilt</th><th>no_mono</th><th>no_sympo</th><th>stay_green</th><th>rejuvination</th><th>pick1_dt</th><th>pick2_dt</th><th>pick3_dt</th><th>pick4_dt</th><th>pick_1</th><th>pick_2</th><th>pick_3</th><th>pick_4</th><th>yield_plot</th><th>plot_size</th><th>yield_ac</th><th>remarks</th><th>frmr_feedback</th><th>PO_Code</th><th>TM_Code</th><th>StageStatus</th><th>LatLng</th><th>LatLngRoute</th><th>TMID</th><th>REGIONID</th><th>ZONEID</th><th>POHQCODE</th><th>DIVISION2</th>
                              </tr>
                              
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                    <div class="tab-pane restabpanel" id="150_160Res"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="150_160Restbl" data-loaded='no'>
                          <thead>
                              <tr>
                                   <th>SNo</th><th>loccode</th><th>Year</th><th>Division</th><th>StateRegion</th><th>Irrigation_Type</th><th>Soil_type</th><th>Territory</th><th>Crop_Management</th><th>TM_Name</th><th>PO_Name</th><th>District</th><th>Mandal_Taluk</th><th>Village</th><th>Farmer_Name</th><th>Contact_No</th><th>Spacing</th><th>plot</th><th>entry</th><th>bloc</th><th>name</th><th>checks</th><th>dos</th><th>gpsLocation</th><th>Imagepath</th><th>Latitude</th><th>Longitude</th><th>plntvgr</th><th>jassid1</th><th>whitefly1</th><th>thrips1</th><th>clcuv1</th><th>gapfill</th><th>sym_sym</th><th>boll_boll</th><th>jassid2</th><th>whitefly2</th><th>thrips2</th><th>clcuv2</th><th>shedded2</th><th>no_boll</th><th>bo_weight</th><th>ease_to_pick</th><th>clcuv3</th><th>parawilt</th><th>no_mono</th><th>no_sympo</th><th>stay_green</th><th>rejuvination</th><th>pick1_dt</th><th>pick2_dt</th><th>pick3_dt</th><th>pick4_dt</th><th>pick_1</th><th>pick_2</th><th>pick_3</th><th>pick_4</th><th>yield_plot</th><th>plot_size</th><th>yield_ac</th><th>remarks</th><th>frmr_feedback</th><th>PO_Code</th><th>TM_Code</th><th>StageStatus</th><th>LatLng</th><th>LatLngRoute</th><th>TMID</th><th>REGIONID</th><th>ZONEID</th><th>POHQCODE</th><th>DIVISION2</th>
                              </tr>
                              
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                     <div class="tab-pane restabpanel" id="pyRes"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="pyRestbl" data-loaded='no'>
                          <thead>
                              <tr>
                                   <th>SNo</th><th>loccode</th><th>Year</th><th>Division</th><th>StateRegion</th><th>Irrigation_Type</th><th>Soil_type</th><th>Territory</th><th>Crop_Management</th><th>TM_Name</th><th>PO_Name</th><th>District</th><th>Mandal_Taluk</th><th>Village</th><th>Farmer_Name</th><th>Contact_No</th><th>Spacing</th><th>plot</th><th>entry</th><th>bloc</th><th>name</th><th>checks</th><th>dos</th><th>gpsLocation</th><th>Imagepath</th><th>Latitude</th><th>Longitude</th><th>plntvgr</th><th>jassid1</th><th>whitefly1</th><th>thrips1</th><th>clcuv1</th><th>gapfill</th><th>sym_sym</th><th>boll_boll</th><th>jassid2</th><th>whitefly2</th><th>thrips2</th><th>clcuv2</th><th>shedded2</th><th>no_boll</th><th>bo_weight</th><th>ease_to_pick</th><th>clcuv3</th><th>parawilt</th><th>no_mono</th><th>no_sympo</th><th>stay_green</th><th>rejuvination</th><th>pick1_dt</th><th>pick2_dt</th><th>pick3_dt</th><th>pick4_dt</th><th>pick_1</th><th>pick_2</th><th>pick_3</th><th>pick_4</th><th>yield_plot</th><th>plot_size</th><th>yield_ac</th><th>remarks</th><th>frmr_feedback</th><th>PO_Code</th><th>TM_Code</th><th>StageStatus</th><th>LatLng</th><th>LatLngRoute</th><th>TMID</th><th>REGIONID</th><th>ZONEID</th><th>POHQCODE</th><th>DIVISION2</th>
                              </tr>
                              
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                     <div class="tab-pane restabpanel" id="closedRes"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="closedRestbl" data-loaded='no'>
                          <thead>
                              <tr>
                                   <th>SNo</th><th>loccode</th><th>Year</th><th>Division</th><th>StateRegion</th><th>Irrigation_Type</th><th>Soil_type</th><th>Territory</th><th>Crop_Management</th><th>TM_Name</th><th>PO_Name</th><th>District</th><th>Mandal_Taluk</th><th>Village</th><th>Farmer_Name</th><th>Contact_No</th><th>Spacing</th><th>plot</th><th>entry</th><th>bloc</th><th>name</th><th>checks</th><th>dos</th><th>gpsLocation</th><th>Imagepath</th><th>Latitude</th><th>Longitude</th><th>plntvgr</th><th>jassid1</th><th>whitefly1</th><th>thrips1</th><th>clcuv1</th><th>gapfill</th><th>sym_sym</th><th>boll_boll</th><th>jassid2</th><th>whitefly2</th><th>thrips2</th><th>clcuv2</th><th>shedded2</th><th>no_boll</th><th>bo_weight</th><th>ease_to_pick</th><th>clcuv3</th><th>parawilt</th><th>no_mono</th><th>no_sympo</th><th>stay_green</th><th>rejuvination</th><th>pick1_dt</th><th>pick2_dt</th><th>pick3_dt</th><th>pick4_dt</th><th>pick_1</th><th>pick_2</th><th>pick_3</th><th>pick_4</th><th>yield_plot</th><th>plot_size</th><th>yield_ac</th><th>remarks</th><th>frmr_feedback</th><th>PO_Code</th><th>TM_Code</th><th>StageStatus</th><th>LatLng</th><th>LatLngRoute</th><th>TMID</th><th>REGIONID</th><th>ZONEID</th><th>POHQCODE</th><th>DIVISION2</th>
                              </tr>
                              
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
      </div>
         
        
      </div>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->

  <footer class="site-footer">
    <div class="site-footer-legal">2019 <a href="https://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202"></a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Agna</a>
    </div>
  </footer>
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
  <script type="text/javascript" src="PDTrailDashBoard.js"></script>
  <script src="../assets/js/menu.js?v4.0.1"></script>
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>