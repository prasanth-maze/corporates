<?php 
  include 'header.php';
?>
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<style type="text/css">
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
  <div class="page" style="margin-top: 175px !important">
    <div class="page-content container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="col-xl-3 col-md-6">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Planned
                </div>
                <span class="float-right grey-700 font-size-30 evtplanned">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>
        <div class="col-xl-3 col-md-6">
          <!-- Widget Linearea Two -->
          <div class="card card-shadow" id="widgetLineareaTwo">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Pending
                </div>
                <span class="float-right grey-700 font-size-30 evtpending">0</span>
              </div>
              <div class="mb-20 grey-500">
                
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
          <!-- End Widget Linearea Two -->
        </div>
        <div class="col-xl-3 col-md-6">
          <!-- Widget Linearea Three -->
          <div class="card card-shadow" id="widgetLineareaThree">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Approved
                </div>
                <span class="float-right grey-700 font-size-30 evtapproved">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
          <!-- End Widget Linearea Three -->
        </div>
        <div class="col-xl-3 col-md-6">
          <!-- Widget Linearea Four -->
          <div class="card card-shadow" id="widgetLineareaFour">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Executed
                </div>
                <span class="float-right grey-700 font-size-30 evtexec">0</span>
              </div>
              <div class="mb-20 grey-500">
               
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
          <!-- End Widget Linearea Four -->
        </div>
        </div>
       <div class="row">
        <div class="col-xxl-4 col-lg-6">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="panel-title">Location Wise Chart</h3>
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
              <h3 class="panel-title">Product Wise Chart</h3>
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
              <h3 class="panel-title">Activity Wise Chart</h3>
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
              <h3 class="panel-title">Result</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full" id="ReportTable">
            <thead>
              <tr>
                <th>Sno</th>
               <th>EVENTCODE</th><th>TRANSDATE</th><th>ACTIVITYTYPE</th><th>ACTIVITYNAME</th><th>PRODUCT</th><th>POCODE</th><th>TERRITORY</th><th>HOSTFARMERNAME</th><th>TALUKMANDAL</th><th>VILLAENAME</th><th>FARMERNAME</th><th>MOBILENUMBER</th><th>OBSERVATIONON</th><th>SOLUTIONS</th><th>VISITNO</th><th>CROPCONDTION</th><th>STATUS</th><th>SUPPORTINGPOS</th><th>EXPENSES</th><th>FARMERCOVERAGE</th><th>REMARKS</th><th>GPSLOCATION</th><th>LATITUDE</th><th>LONGITUDE</th><th>IMAGE1</th><th>IMAGE2</th><th>IMAGE3</th><th>LOCATIONTIME</th><th>STRINGDATE</th><th>SEASONCODE</th><th>CROPNAME</th><th>TMCODE</th><th>RBMCODE</th><th>DBMCODE</th><th>GMCODE</th><th>NOOFFARMERCOVERED</th><th>NOOFVILLAGECOVERED</th><th>NOOFDEALERSCOVERED</th><th>BUDGETAMT</th><th>LOCATIONDATE</th><th>DATAAREAID</th><th>RECVERSION</th><th>CLAIMID</th><th>TYPE</th><th>POHQCODE</th><th>POHQNAME</th>
              </tr>
            </thead>
            <tfoot>
                  <th>Sno</th>
               <th>EVENTCODE</th><th>TRANSDATE</th><th>ACTIVITYTYPE</th><th>ACTIVITYNAME</th><th>PRODUCT</th><th>POCODE</th><th>TERRITORY</th><th>HOSTFARMERNAME</th><th>TALUKMANDAL</th><th>VILLAENAME</th><th>FARMERNAME</th><th>MOBILENUMBER</th><th>OBSERVATIONON</th><th>SOLUTIONS</th><th>VISITNO</th><th>CROPCONDTION</th><th>STATUS</th><th>SUPPORTINGPOS</th><th>EXPENSES</th><th>FARMERCOVERAGE</th><th>REMARKS</th><th>GPSLOCATION</th><th>LATITUDE</th><th>LONGITUDE</th><th>IMAGE1</th><th>IMAGE2</th><th>IMAGE3</th><th>LOCATIONTIME</th><th>STRINGDATE</th><th>SEASONCODE</th><th>CROPNAME</th><th>TMCODE</th><th>RBMCODE</th><th>DBMCODE</th><th>GMCODE</th><th>NOOFFARMERCOVERED</th><th>NOOFVILLAGECOVERED</th><th>NOOFDEALERSCOVERED</th><th>BUDGETAMT</th><th>LOCATIONDATE</th><th>DATAAREAID</th><th>RECVERSION</th><th>CLAIMID</th><th>TYPE</th><th>POHQCODE</th><th>POHQNAME</th>
            </tfoot>
            <tbody>
              
            </tbody>
          </table>
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
  <script type="text/javascript">
   
 var currentRequest = null;    
  desgcode = '';
  var windowsonload = true;

    $("body").on("submit",".filter-form",function(e){
      //$("#loader-wrapper").css('display','block');     
     
        var data = $(this).serialize();
        
        if($(".rbmLocSelect").length>0){
            var rbmloc = $(".rbmLocSelect").val();

            if(rbmloc=='All'){
              var rbmall_code = sep ="";
                 $(".rbmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        rbmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&rbmall_code="+rbmall_code;
            }
        }

        if($(".tmLocSelect").length>0){
            var tmloc = $(".tmLocSelect").val();

            if(tmloc=='All'){
              var tmall_code = sep ="";
                 $(".tmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        tmall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&tmall_code="+tmall_code;
            }
        }


        if($(".poLocSelect").length>0){
            var poloc = $(".poLocSelect").val();

            if(poloc=='All'){
              var poall_code = sep ="";
                 $(".poLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        poall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&poall_code="+poall_code;
            }
        }


         if($(".productSelect").length>0){
            var prodval = $(".productSelect").val();

            if(prodval=='All'){
              var prodall_code = sep ="";
                 $(".productSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        prodall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&prodall_code="+prodall_code;
            }
        }

        if($(".hybridsSelect").length>0){
            var hybval = $(".hybridsSelect").val();

            if(hybval=='All'){
              var hyball_code = sep ="";
                 $(".hybridsSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        hyball_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&hyball_code="+hyball_code;
            }
        }


        if($(".activitySelect").length>0){
            var actval = $(".activitySelect").val();

            if(actval=='All'){
              var actall_code = sep ="";
                 $(".activitySelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        actall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&actall_code="+actall_code;
            }
        }


        if($(".subactivitySelect").length>0){
            var subactval = $(".subactivitySelect").val();

            if(subactval=='All'){
              var subactall_code = sep ="";
                 $(".subactivitySelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        subactall_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                 
                  data = data+"&subactall_code="+subactall_code;
            }
        }


       currentRequest =  $.ajax({
          url: 'EventChart.php',
          type: 'POST',
          dataType: 'json',
          data: data,
           beforeSend : function()   {     
            
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            $(".evtplanned").text(res.evtplanned);
            $(".evtexec").text(res.evtexec);
            $(".evtapproved").text(res.evtapproved);
            $(".evtpending").text(res.evtpending);

            if(res.hasOwnProperty('locationWiseData'))
              genLocationWiseChart(res.locationWiseData);       
            if(res.hasOwnProperty('productWisesData'))
              genProductWiseChart(res.productWisesData);
             if(res.hasOwnProperty('ActivityWisesData'))
              genActivityWiseChart(res.ActivityWisesData);
            if(res.hasOwnProperty('TrendChartData'))
                genTrendChart(res.TrendChartData);

              genReport(data);
               $("#loader-wrapper").css('display','none');
          }
           });
       return false;
      });

   function genLocationWiseChart(locationWiseData,sfor){
           var locSeriousdata = locationWiseData;
           var sfor = locationWiseData.locseriesfor;
           var series1for = series2for = series3for = '';
           //console.log(sfor);
           if(sfor.hasOwnProperty('series1')){
            series1for= sfor.series1;
           } if(sfor.hasOwnProperty('series2')){
            series2for= sfor.series2;
           } if(sfor.hasOwnProperty('series3')){
            series3for= sfor.series3;
           }
           

            
           series1 = locSeriousdata.series1;
           drilldown = {};
           var s2dataarr = {};
           if(locSeriousdata.hasOwnProperty('series2')){
              var series2arr = [];
              var series2 = locSeriousdata.series2;
              series3found = 'no';
              if(locSeriousdata.hasOwnProperty('series3')){
                  var series3 = locSeriousdata.series3;
                  series3found = 'yes';
                }

               for(s1 in series1){
                var s1name =  series1[s1].name;
                var s2dataarr = []
                if(series2.hasOwnProperty(s1name)){
                    var sdataarr = series2[s1name];
                    for(i in sdataarr){
                        var s2name = sdataarr[i].name;
                        var s2data = sdataarr[i];
                       if(series3found=='yes'){
                          var s3dataarr = series3[s2name];
                          var series3arr = [];
                          for(j in s3dataarr){
                            series3arr.push(s3dataarr[j]);
                          }
                          
                           series2arr.push({
                                      id: s2name,
                                      name: series3for,
                                      y:s2data.y,
                                      drilldown:s2name,
                                      data:series3arr
                              });
                       }else{
                             series2arr.push({
                                      id: s2name,
                                      name: series3for,
                                      y:s2data.y
                              });
                        }

                       s2dataarr.push(s2data);
                      
                    }
                  }
                  series2arr.push({
                          id: s1name,
                          name: series2for,
                          data:s2dataarr
                  });
               }
               drilldown.series = series2arr;
           }
        
           var option = {
                  chart: {
                      type: 'column',
                       renderTo: 'LocationWiseChartContainer',
                  },
                  title: {
                      text: 'Location Wise Event Count'
                  },
                  xAxis: {
                      type: 'category'
                  },

                  legend: {
                      enabled: true
                  },

                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                          }
                      }
                  },
                  series: [{
                  name: series1for,
                  colorByPoint: true,
                  data: series1
                }],
                drilldown:{}
              }
              option.drilldown = drilldown;
            chart = new Highcharts.Chart(option);
    }

    function genProductWiseChart(productWisesData){
           var locSeriousdata = productWisesData;
           var sfor = productWisesData.pdseriesfor;
           var series1for = series2for = '';
           console.log(sfor);
           if(sfor.hasOwnProperty('series1')){
            series1for= sfor.series1;
           } if(sfor.hasOwnProperty('series2')){
            series2for= sfor.series2;
           }

           series1 = locSeriousdata.series1;
           drilldown = {};
           var s2dataarr = {};
           if(locSeriousdata.hasOwnProperty('series2')){
              var series2arr = [];
              var series2 = locSeriousdata.series2;
              series3found = 'no';
              if(locSeriousdata.hasOwnProperty('series3')){
                  var series3 = locSeriousdata.series3;
                  series3found = 'yes';
                }

               for(s1 in series1){
                var s1name =  series1[s1].name;
                var s2dataarr = []
                if(series2.hasOwnProperty(s1name)){
                    var sdataarr = series2[s1name];
                    for(i in sdataarr){
                        var s2name = sdataarr[i].name;
                        var s2data = sdataarr[i];
                       if(series3found=='yes'){
                          var s3dataarr = series3[s2name];
                          var series3arr = [];
                          for(j in s3dataarr){
                            series3arr.push(s3dataarr[j]);
                          }
                          
                           series2arr.push({
                                      id: s2name,
                                      name: 'none',
                                      y:s2data.y,
                                      drilldown:s2name,
                                      data:series3arr
                              });
                       }else{
                             series2arr.push({
                                      id: s2name,
                                      name: 'none',
                                      y:s2data.y
                              });
                        }

                       s2dataarr.push(s2data);
                      
                    }
                  }
                  series2arr.push({
                          id: s1name,
                          name: series2for,
                          data:s2dataarr
                  });
               }
               drilldown.series = series2arr;
           }
        
           var option = {
                  chart: {
                      type: 'column',
                       renderTo: 'ProductWiseChartContainer',
                  },
                  title: {
                      text: 'Produt Wise Event Count'
                  },
                  xAxis: {
                      type: 'category'
                  },

                  legend: {
                      enabled: true
                  },

                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                          }
                      }
                  },
                  series: [{
                  name: series1for,
                  colorByPoint: true,
                  data: series1
                }],
                drilldown:{}
              }
              option.drilldown = drilldown;
            productChart = new Highcharts.Chart(option);

    }

    function genActivityWiseChart(ActivityWisesData){
           var locSeriousdata = ActivityWisesData;
           var sfor = ActivityWisesData.actseriesfor;
           var series1for = series2for = '';
           if(sfor.hasOwnProperty('series1')){
            series1for= sfor.series1;
           } if(sfor.hasOwnProperty('series2')){
            series2for= sfor.series2;
           }
           series1 = locSeriousdata.series1;
           drilldown = {};
           var s2dataarr = {};
           if(locSeriousdata.hasOwnProperty('series2')){
              var series2arr = [];
              var series2 = locSeriousdata.series2;
              series3found = 'no';
              if(locSeriousdata.hasOwnProperty('series3')){
                  var series3 = locSeriousdata.series3;
                  series3found = 'yes';
                }

               for(s1 in series1){
                var s1name =  series1[s1].name;
                var s2dataarr = []
                if(series2.hasOwnProperty(s1name)){
                    var sdataarr = series2[s1name];
                    for(i in sdataarr){
                        var s2name = sdataarr[i].name;
                        var s2data = sdataarr[i];
                       if(series3found=='yes'){
                          var s3dataarr = series3[s2name];
                          var series3arr = [];
                          for(j in s3dataarr){
                            series3arr.push(s3dataarr[j]);
                          }
                          
                           series2arr.push({
                                      id: s2name,
                                      name: 'NONE',
                                      y:s2data.y,
                                      drilldown:s2name,
                                      data:series3arr
                              });
                       }else{
                             series2arr.push({
                                      id: s2name,
                                      name: 'NONE',
                                      y:s2data.y
                              });
                        }

                       s2dataarr.push(s2data);
                      
                    }
                  }
                  series2arr.push({
                          id: s1name,
                          name: series2for,
                          data:s2dataarr
                  });
               }
               drilldown.series = series2arr;
           }
        
           var option = {
                  chart: {
                      type: 'column',
                       renderTo: 'ActivityWiseChartContainer',
                  },
                  title: {
                      text: 'Activity Wise Event Count'
                  },
                  xAxis: {
                      type: 'category'
                  },

                  legend: {
                      enabled: true
                  },

                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                          }
                      }
                  },
                  series: [{
                  name: series1for,
                  colorByPoint: true,
                  data: series1
                }],
                drilldown:{}
              }
              option.drilldown = drilldown;
            ActivityWiseChart = new Highcharts.Chart(option);

    } 
    
    function genTrendChart(TrendChartData){
      var data = TrendChartData.tdata;
    
        Highcharts.chart('TrendChart', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Trend Chart'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'COUNT',
                data: data
            }]
        });
    }

    $("#ReportTable").DataTable();
    function genReport(filterData){
       $('#ReportTable').DataTable().destroy();
           $('#ReportTable').DataTable({
            "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "Ajax1.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:filterData}
            },
        });

    }

$(".pdivision").trigger('click');
/*0*/

    $("body").on("click",".pdivision",function(){
       //$("#loader-wrapper").css('display','block');
        dataAreaId = $(this).val();
         currentRequest =  $.ajax({
            url: 'Ajax1.php',
            type: 'POST',
            dataType: 'json',
             beforeSend : function()   {           
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
            data: {Action: 'GetFilterOpt',dataAreaId:dataAreaId},
            success:function(res){
              GenSelectOpt(res,"DIV");
              $("#loader-wrapper").css('display','none');
            }
          });
         
    });
$(".pdivision").trigger('click');
    function GenSelectOpt(res,Dcode=""){
              var zmLocOpt =  rbmLocSelect = tmLocSelect = poLocCodeOpt =  popt = activityOpt = "";
              if(res.hasOwnProperty('zoneDet')){
                 zoneDet = res.zoneDet;
                 for(var zi in zoneDet ){
                      zmLocOpt +="<option value='"+zoneDet[zi].ZoneId+"'>"+zoneDet[zi].ZoneName+"</option>";
                 }
                   $(".zmLocSelect").html(zmLocOpt);
              }else{  
                    if(Dcode=="DIV")               
                 $(".zmLocSelect").html("");
              }

              if(res.hasOwnProperty('regionDet')){
                 regionDet = res.regionDet;
                 for(var ri in regionDet ){
                  rid  = regionDet[ri].RegionId;
                  rname  = regionDet[ri].RegionName;
                  rzone = regionDet[ri].Zone;
                  ridval = rname;
                  if(rid=="All"){
                    ridval = 'All';
                  }

                      rbmLocSelect +="<option value='"+rid+"' data-Zone='"+rzone+"'>"+ridval+"</option>";
                 }
                   $(".rbmLocSelect").html(rbmLocSelect);
              }else{
                     if(Dcode=="DIV" || Dcode=="ZM" ) 
                $(".rbmLocSelect").html("");
              }

              if(res.hasOwnProperty('tmDet')){
                 tmDet = res.tmDet;
                 for(var ti in tmDet ){
                  tid  = tmDet[ti].TMID;
                  tmname  = tmDet[ti].TMName;
                  tidval = tmname;
                  tregion = tmDet[ti].Region;
                  if(tid=="All"){
                    tidval = 'All';
                  }

                      tmLocSelect +="<option value='"+tid+"' data-region='"+tregion+"' >"+tidval+"</option>";
                 }
                   $(".tmLocSelect").html(tmLocSelect);
              }else{
                  if(Dcode=="DIV" || Dcode=="RBM" ) 
                $(".tmLocSelect").html("");
              }

              if(res.hasOwnProperty('poDet')){
                  poDet = res.poDet;
                  for(var pi in poDet ){
                     poid  = poDet[pi].POHQCODE;
                    poname  = poDet[pi].POHQNAME;
                    potm = poDet[pi].TMID;
                    poval = poname;
                    if(poid=="All"){
                      poval = 'All';
                    }
                  poLocCodeOpt +="<option value='"+poid+"' data-TMID='"+potm+"'>"+poval+"</option>";
                 }

                 $(".poLocSelect").html(poLocCodeOpt);

              }else{
                  if(Dcode=="DIV" || Dcode=="TM" )
                $(".poLocSelect").html("");
              } 
              
               if(res.hasOwnProperty('products')){
                    products = res.products;
                    for(var j in products ){
                      popt +="<option value='"+products[j]+"'>"+products[j]+"</option>";
                  }
                  $(".productSelect").html(popt);
               }else{
                if(Dcode=="DIV")
                 $(".productSelect").html("");
               }

               if(windowsonload){
                $(".filter-form").submit();
                windowsonload = false;
               }
    }

    $("body").on("change",".LocSelect",function(){
        var Dcode = $(this).data("dcode");
        desgcode = Dcode;
          if(Dcode!="PO"){
            var lcode = $(this).val();
            var dataAreaId = $(".pdivision:checked").val();
            var fdata = {Action: 'GetFilterOpt',subact:'getInvidualFilter',dataAreaId:dataAreaId,Dcode:Dcode,lcode:lcode};
            var sep ="";
            if(Dcode=='RBM'){
              fdata.zmcode = $(this).find(':selected').data('zone');
              var all_code = "";
                if(lcode=='All'){
                  $(".rbmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        all_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  fdata.all_code = all_code;
                }
            }

            if(Dcode=='TM'){
              fdata.rbmcode = $(this).find(':selected').data('region');
              var all_code = "";
                if(lcode=='All'){
                  $(".tmLocSelect option").each(function(index, el) {
                      if($(this).val()!="All") {
                        all_code +=sep+$(this).val();
                        sep=",";
                      }
                  });
                  fdata.all_code = all_code;
                }
            }


            currentRequest = $.ajax({
              url: 'Ajax1.php',
              type: 'POST',
              dataType: 'json',
              data: fdata,
               beforeSend : function()   {           
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
              success:function(res){
                GenSelectOpt(res,Dcode);

              }
            });
      }
    });
    var hybridsSelect = $(".hybridsSelect");
    var subactivitySelect = $(".subactivitySelect");

    $('body').on("change",".productSelect",function(){
      var product = $(this).val();
      if(product!="All"){
         currentRequest = $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          data: {Action: 'GET_HYBIRDS',crop:product},
           beforeSend : function()   {           
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            var opt =  "";
            for(var i in res){
              opt += "<option value='"+res[i]+"'>"+res[i]+"</option>";
            }
            hybridsSelect.html(opt);
          }
        });
      }else{
        hybridsSelect.html('');
      }
    });

    $('body').on("change",".activitySelect",function(){
      var activity = $(this).val();
      if(activity!="All"){
         currentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          data: {Action: 'GET_SUBACTIVITY',activity:activity},
          beforeSend : function()   {           
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            var opt =  "";
            for(var i in res){
              opt += "<option value='"+res[i]+"'>"+res[i]+"</option>";
            }
            subactivitySelect.html(opt);
          }
        });
      }else{
        subactivitySelect.html('');
      }
    });
    
$("body").on("change",".atype",function(e){
    var atype = $(this).val();
      currentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          data: {Action: 'GET_ACTIVITY',atype:atype},
          beforeSend : function()   {           
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            var activityOpt =  "";
           
            if(res.hasOwnProperty('activity')){
                activity = res.activity;
                activityOpt+="<option value='All'>All</option>";
                for(var k in activity ){
                    activityOpt +="<option value='"+activity[k]+"'>"+activity[k]+"</option>";
                }
                $(".activitySelect").html(activityOpt);
              }else{
                $(".activitySelect").html("");
                subactivitySelect.html('');
              }

          }
        });
});
  
    
  </script>
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>