<?php 
  include 'header.php';
?>
<body class="animsition site-navbar-small dashboard">
  <?php
    include 'top_nav.php';
   ?>
  <!-- Page -->
  <div class="page" style="">
    <div class="page-content container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="col-xl-3 col-md-6">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  User
                </div>
                <span class="float-right grey-700 font-size-30">1,253</span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-up green-500 font-size-16"></i> 15%
                From this yesterday
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
                  <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  VISITS
                </div>
                <span class="float-right grey-700 font-size-30">2,425</span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-up green-500 font-size-16"></i> 34.2%
                From this week
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
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Total Clicks
                </div>
                <span class="float-right grey-700 font-size-30">1,864</span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-down red-500 font-size-16"></i> 15%
                From this yesterday
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
                  <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>                  Items
                </div>
                <span class="float-right grey-700 font-size-30">845</span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-up green-500 font-size-16"></i> 18.4%
                From this yesterday
              </div>
              <div class="ct-chart h-50"></div>
            </div>
          </div>
          <!-- End Widget Linearea Four -->
        </div>

        <div class="col-xxl-7 col-lg-6">
        <?php
        
          if($_SESSION['Dcode']=='TM'){
            $posql = "SELECT * FROM ".$pohqtbl." WHERE TMId='".$_SESSION['EmpID']."' ";
            $res = sqlsrv_query($conn,$posql,array(), array( "Scrollable" => 'static' ));
            $porowc = sqlsrv_num_rows($res); 
         ?>
        <div class="col-xxl-7 col-lg-3">
          <div class="form-group">
            <label class="form-label">PO</label>
             <select class="form-control form-control-sm pocode filterInputs" >
              <option value="all">All</option>
              <?php
                  if($porowc>0){
                    while($porow = sqlsrv_fetch_array($res)){ 
               ?>
                  <option value="<?=@$porow['POCODE']?>"><?=@$porow['POCODE'].'-'.$porow['PONAME'] ?></option>
                <?php } } ?>
                </select>
          </div>
        </div>
           <div class="col-xxl-7 col-lg-3">
          <div class="form-group">
            <label class="form-label">Type</label>
             <select class="form-control form-control-sm filterInputs type" >
              <option value="all">All</option>
                <option value="Financial">Financial</option>
                <option value="Non-Financial">Non-Financial</option>
                </select>
          </div>
        </div>
         <div class="col-xxl-7 col-lg-3">
          <div class="form-group">
            <label class="form-label">Status</label>
             <select class="form-control form-control-sm activitystatus filterInputs" >
              <option value="all">All</option>
                <option value="OPEN">Open</option>
                <option value="CLOSE">Close</option>
                </select>
          </div>
        </div>
        <?php

        }
        
         ?>
         <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->

  <footer class="site-footer">
    <div class="site-footer-legal">© 2018 <a href="https://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
    </div>
  </footer>
  <!-- Core  -->
  <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../global/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1"></script>
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
   <script src="chartGen.js"></script>
  <script type="text/javascript">
    $("body").on("submit",".filter-form",function(e){
      e.preventDefault();
      var filterOpt = $(this).serialize();
      $.ajax({
        url: '',
        type: 'default GET (Other values: POST)',
        dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {param1: 'value1'},
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    });
  </script>
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>