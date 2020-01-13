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
    <div class="page-content container-fluid">
          <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="column-3 col col-sm-12">
          <!-- Widget Linearea One-->
		  <a href="#ReportTablediv" class="restabs1" data-filter="PLANNED" data-tbl="plannedRestbl" data-tab="plannedRes" title="Click to view the planned activities">
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Planned
                </div>
                <span class="float-right grey-700 font-size-20 evtplanned">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
		  </a>
          <!-- End Widget Linearea One -->
        </div>
        <div class="column-3  col-sm-12">
          <!-- Widget Linearea Two -->
		  <a href="#ReportTablediv" class="restabs1" data-filter="APPROVALPENDING" data-tbl="approvalPendRestbl" data-tab="approvalPendRes" title="Click to view the approval pending Activities">
          <div class="card card-shadow" id="widgetLineareaTwo">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>                 Approval Pending
                </div>
                <span class="float-right grey-700 font-size-20 evtpending">0</span>
              </div>
              <div class="mb-20 grey-500">
                
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
		  </a>
          <!-- End Widget Linearea Two -->
        </div>
       <div class="column-3 col-md-12">
          <!-- Widget Linearea One-->
		   <a href="#ReportTablediv" class="restabs1" data-filter="APPROVED" data-tbl="approvedRestbl" data-tab="approvedRes" title="Click to view the approved activities"> 
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-trending-up grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Approved
                </div>
                <span class="float-right grey-700 font-size-20 evtapproved">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50">
                <svg  width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C8.075,45,16.15,40,24.225,35C32.299,30,40.374,20.769,48.449,20C56.524,19.231,64.599,19.508,72.674,18.75C80.749,17.992,88.824,6.25,96.898,6.25C104.973,6.25,113.048,25,121.123,25C129.198,25,137.273,18.75,145.348,18.75C153.423,18.75,161.497,29.8,169.572,35C177.647,40.2,185.722,45,193.797,50L193.797,50Z" class="ct-area" style="fill:#FA9191;"></path></g></g></svg>
              </div>
            </div>
          </div>
		  </a>
          <!-- End Widget Linearea One -->
        </div>
         <div class="column-3 col-sm-12">
          <!-- Widget Linearea Three -->
           <a href="#ReportTablediv" class="restabs1" data-filter="EXECUTIONPENDING" data-tbl="exePendRestbl"  data-tab="exePendRes" title="Click to view the execution pending Activities"> 
		   <div class="card card-shadow" id="widgetLineareaThree">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Execution Pending
                </div>
                <span class="float-right grey-700 font-size-20 evtexecpend">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
		  </a>
          <!-- End Widget Linearea Three -->
        </div>
        <div class="column-3 col-sm-12">
          <!-- Widget Linearea Four -->
		  <a href="#ReportTablediv" class="restabs1" data-filter="EXECUTED" data-tbl="exeResTable"  data-tab="exeRes" title="Click to view the executed activities"> 
          <div class="card card-shadow" id="widgetLineareaFour">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Executed
                </div>
                <span class="float-right grey-700 font-size-20 evtexec">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
		  </a>
          <!-- End Widget Linearea Four -->
        </div>
        
        
        </div>
		
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
                       
					<div class="row col-xxl-12" style="margin-left: 3px;margin-bottom: -15px;margin-top: -20px;"> 
					  <div class="col-lg-4">
							<div class="panel">
							<div class="card-block1">
							  <h4 style="text-align: center;">Farmers Covered</h4>
							  <h4 style="text-align: center;" class="fcovered">0</h4>
							</div>
							</div>
					  </div>
					  <div class="col-lg-4">
							<div class="panel">
							<div class="card-block1">
							  <h4 style="text-align: center;">Villages Covered</h4>
							  <h4 style="text-align: center;" class="vcovered">0</h4>
							</div>
							</div>
					  </div>
					  <div class="col-lg-4">
							<div class="panel">
							<div class="card-block1">
							  <h4 style="text-align: center;">Dealers Covered</h4>
							  <h4 style="text-align: center;" class="dcovered">0</h4>
							</div>
							</div>
					  </div>
				  </div> 
       <div class="row">
        <div class="col-xxl-4 col-lg-6">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="panel-title">Geographical Chart</h3>
            </div>
            <div class="panel-body" id="LocationWiseChartContainer">
              <!-- <div id="LocationWiseChartContainer" ></div>
             </div> -->
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>

        <div class="col-xxl-4 col-lg-6">
          <!-- Example Panel With Footer -->
          <div class="panel panel-bordered" >
            <div class="panel-heading">
              <h3 class="panel-title">Product Chart</h3>
            </div>
            <div class="panel-body" id="ProductWiseChartContainer">
              
            </div>
          </div>
          <!-- End Example Panel With Footer -->
        </div>

        <div class="col-xxl-4 col-lg-6">
          <!-- Example Panel With All -->
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="panel-title">Activity Chart</h3>
            </div>
            <div class="panel-body" id="ActivityWiseChartContainer">
              
            </div>
          </div>
          <!-- End Example Panel With All -->
        </div>
        <div class="col-xxl-4 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="panel-title" >Trend Chart</h3>
            </div>
            <div class="panel-body" id="TrendChart">
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
        <div class="col-xxl-12 col-lg-12">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">List of Activities</h3>
            </div>
            <div class="panel-body ReportTablediv" id="ReportTablediv">
			 <div class="nav-tabs-horizontal" data-plugin="tabs">
               <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link restabs active plannedRes" data-toggle="tab" data-filter="PLANNED" data-tbl="plannedRestbl"  href="#plannedRes" aria-controls="plannedRes" role="tab">Planned</a></li>
               <li class="nav-item" role="presentation"><a class="nav-link restabs approvalPendRes" data-toggle="tab" data-filter="APPROVALPENDING" data-tbl="approvalPendRestbl" href="#approvalPendRes" aria-controls="approvalPendRes" role="tab">Approval Pending</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link restabs approvedRes" data-toggle="tab" data-filter="APPROVED" data-tbl="approvedRestbl" href="#approvedRes" aria-controls="approvedRes" role="tab">Approved</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link restabs exePendRes" data-toggle="tab" data-filter="EXECUTIONPENDING" data-tbl="exePendRestbl" href="#exePendRes" aria-controls="exePendRes" role="tab">Execution Pending </a></li>
                     <li class="nav-item" role="presentation"><a class="nav-link restabs exeRes" data-toggle="tab" data-filter="EXECUTED" data-tbl="exeResTable" href="#exeRes" aria-controls="exeRes" role="tab">Executed</a></li>
                </ul>
                <div class="tab-content pt-20">
                    <div class="tab-pane restabpanel active" id="plannedRes"  role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="plannedRestbl" data-loaded='no'>
                          <thead>
                              <tr>
                                 <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                              </tr>
                               <tfoot>
                                <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                    <div class="tab-pane restabpanel" id="approvalPendRes" role="tabpanel">
                       <table class="table table-hover dataTable table-striped w-full" id="approvalPendRestbl" data-loaded='no'>
                          <thead>
                             <tr>
                                <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                              </tr>
                          </thead>
                           <tfoot>
                            <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                           </tfoot>
                          <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab-pane restabpanel" id="approvedRes" role="tabpanel">
                         <table class="table table-hover dataTable table-striped w-full" id="approvedRestbl" data-loaded='no'>
                          <thead>
                             <tr>
                                <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                              </tr>
                          </thead>
                           <tfoot>
                            <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                           </tfoot>
                          <tbody></tbody>
                        </table>
                    </div> 
                    <div class="tab-pane restabpanel" id="exePendRes" role="tabpanel">
                       <table class="table table-hover dataTable table-striped w-full" id="exePendRestbl" data-loaded='no'>
                          <thead>
                             <tr>
                                <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                              </tr>
                          </thead>
                           <tfoot>
                           <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Creation Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Taluk/Mandal</th><th>Territory</th><th>Village Name</th><th>Crop Name</th><th>Product</th><th>Status</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                           </tfoot>
                          <tbody></tbody>
                        </table>
                    </div> 
                    <div class="tab-pane restabpanel" id="exeRes" role="tabpanel">
                      <table class="table table-hover dataTable table-striped w-full" id="exeResTable" data-loaded='no'>
                          <thead>
                              <tr>
                                 <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Activity Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Territory</th><th>Taluk/Mandal</th><th>Village Name</th><th>Farmer Name</th><th>Mobile No.</th><th>Crop Name</th><th>Product</th><th>Crop Condition</th><th>Status</th><th>Observations</th><th>Solutions</th><th>Visit No</th><th>GPS Location</th><th>Latitude</th><th>Longitude </th><th>Image 1</th><th>Image 2</th><th>Image 3</th><th>No of Farmers Covered</th><th>No of Villages Covered</th><th>No of Dealers Covered</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                              </tr>
                               <tfoot>
                                 <th>SNo</th><th>PO Code</th><th>PO Name</th><th>HQ Code</th><th>HQ Name</th><th>Event Code</th><th>Activity Date</th><th>Financial Type</th><th>Activity Type</th><th>Sub Type</th><th>Territory</th><th>Taluk/Mandal</th><th>Village Name</th><th>Farmer Name</th><th>Mobile No.</th><th>Crop Name</th><th>Product</th><th>Crop Condition</th><th>Status</th><th>Observations</th><th>Solutions</th><th>Visit No</th><th>GPS Location</th><th>Latitude</th><th>Longitude </th><th>Image 1</th><th>Image 2</th><th>Image 3</th><th>No of Farmers Covered</th><th>No of Villages Covered</th><th>No of Dealers Covered</th><th>TMID</th><th>TMName</th><th>RBMID</th><th>RBMName</th><th>DBM Id</th><th>DBM Name</th>
                               </tfoot>
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
<script type="text/javascript" src="EventDashBoard.js"></script>
 <script src="../assets/js/menu.js?v4.0.1"></script>
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>