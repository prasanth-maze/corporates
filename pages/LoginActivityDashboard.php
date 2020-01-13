<?php 
  include 'header.php';
?>
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
  <div class="page" style="margin-top: 34px !important">

    <div class="page-content container-fluid ">
     
                  <!-- Modal -->
                 <div class="modal fade modal-rotate-from-bottom" id="LoginDetModal"
                    aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
                    tabindex="-1">
                    <div class="modal-dialog modal-simple">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Login Details</h4>
                        </div>
                        <div class="modal-body">
                          <div class="table-wrapper-scroll-y my-custom-scrollbar"> 

              <table class="table table-bordered table-striped mb-0">
                <thead style="">
                  <tr>
                    <th scope="col">S.NO</th>
                    <th scope="col">Login Date/Time</th>
                  </tr>
                </thead>
                <tbody class="logindetbody">
                  
                </tbody>
              </table>

      </div>
                    </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-primary btn-pure" data-dismiss="modal">Close</button>
                          
                        </div>
                        </div>
                        
                      </div>
                    </div>
                  <!-- End Modal -->
<div class="row">
        <div class="col-xxl-12 col-lg-12">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Login Summary</h3>
            </div>
            <div class="panel-body" id="LoginSummary">

            </div>
          </div>
        </div>
      </div>

      <?php
if($_SESSION['Dcode']=='ADMIN' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='GM'){
       ?>
             <div class="row">
     
        <div class="col-xxl-6 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Divison Wise RM Login Summary</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full dataTablechart" id="RBMReportTable">
            <thead>
              <tr>
                <th>Sno</th>
               <th>Division</th><th>Divison id</th><th>Region ids</th><th>Num of Region</th><th>No of Emp</th><th>Logged in</th><th>Not Logged in</th><th>Logged in</th><th>Not Logged in</th>
              </tr>
            </thead>
          
            <tbody>
              
            </tbody>
            <tfoot class="inichartData1">
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
                <th class="totemp"></th>
                <th class="totlin"></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
          </table>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
        <div class="col-xxl-6 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">List of RMs</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full" id="RBMReportTableDet">
            <thead>
              <tr>
                <th>Sno</th>
               <th>Region</th><th>RBMId</th><th>Employee</th><th>Login Status</th><th>Login Details</th>
              </tr>
            </thead>
           
            <tbody>
              
            </tbody>

          </table>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
      </div>
<?php }  ?>
<?php if($_SESSION['Dcode']=='ADMIN' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='GM' || $_SESSION['Dcode']=='RBM'){ ?>
     
       <div class="row">
     
        <div class="col-xxl-6 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Region Wise TM Login Summary</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full dataTablechart" id="TMReportTable">
            <thead>
              <tr>
                <th>Sno</th>
               <th>Division</th><th>Division Id</th><th>Region Id</th><th>Region</th><th>Num of Territory</th><th>No of Emp</th><th>Logged in</th><th>Not Logged in</th><th>Logged in</th><th>Not Logged in</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
             <tfoot class="inichartData2">
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
                <th></th>
                <th class="totemp"></th>
                <th class="totlin"></th>
                <th></th>
                <th></th>
                <th></th>

            </tr>
        </tfoot>
          </table>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
        <div class="col-xxl-6 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">List of TMs</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full" id="TMReportTableDet">
            <thead>
              <tr>
                <th>Sno</th>
             <th>Division</th><th>Region</th><th>TMID</th><th>Territory</th><th>Emp Code</th><th>Employee</th><th>Login Status</th><th>Login Details</th>
              </tr>
            </thead>
            <tbody>
            </tbody>

          </table>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
      </div>

<?php } ?>

<?php if($_SESSION['Dcode']=='ADMIN' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='GM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='TM'){ ?>
     <div class="row">
     
        <div class="col-xxl-6 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Territory Wise PO Login Summary</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full dataTablechart" id="POReportTable">
            <thead>
              <tr>
                <th>Sno</th>
              <th>Division</th><th>Region</th><th>Territory Id</th><th>Territory</th><th>PO Count</th><th>Logged in</th><th>Not Logged in</th><th>Logged in</th><th>Not Logged in</th>
              </tr>
            </thead>
           
            <tbody>
              
            </tbody>
          <tfoot class="inichartData3">
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
                <th class="totemp"></th>
                <th class="totlin"></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
          </table>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
        <div class="col-xxl-6 col-lg-6">
          <!-- Example Heading With Desc -->
          <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">List of POs</h3>
            </div>
            <div class="panel-body ReportTablediv">
          <table class="table table-hover dataTable table-striped w-full" id="POReportTableDet">
            <thead>
              <tr>
                <th>Sno</th>
               <th>Division</th><th>Region</th><th>Territory</th><th>POHQ Name</th><th>PO Name</th><th>Login Status</th><th>Login details</th>
              </tr>
            </thead>
           
            <tbody>
              
            </tbody>
          </table>
            </div>
          </div>
          <!-- End Example Heading With Desc -->
        </div>
      </div>
         <?php } ?>
        
      </div>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
  <!-- Modal -->
        
                  </div>
                  <!-- End Modal -->
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
<script src="../assets/js/menu.js?v4.0.1"></script>

  <!-- <script src="chartGen.js"></script> -->
  <script type="text/javascript">
   
    $('#menu-id,#filter').click(function () {
      
  if($('#myDIV').css('display') == 'none')
        {
         $('#myDIV').css('display','block');
        }
        else
        {
         $('#myDIV').css('display','none'); 
        }
});

 var currentRequest = null;    
  desgcode = '';
  var windowsonload = true;
  var RBMReportTable = $("#RBMReportTable").DataTable();
  var RBMReportTableDet = $("#RBMReportTableDet").DataTable({
    "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": false
            }
        ],
  });
var TMReportTable = $("#TMReportTable").DataTable();
var TMReportTableDet = $("#TMReportTableDet").DataTable({
    "columnDefs": [
            {
                "targets": [ 8 ],
                "visible": false,
                "searchable": false
            }
        ],
  });
var POReportTable = $("#POReportTable").DataTable();
var POReportTableDet = $("#POReportTableDet").DataTable({
    "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
                "searchable": false
            }
        ],
  });
    $("body").on("submit",".filter-form",function(e){
      /*$('#TMReportTable').DataTable().destroy();
      $('#POReportTable').DataTable().destroy();*/
      $("#loader-wrapper").css('display','block');     
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

        rbmdata = data+"&act=GETCOUNTRBM";

         tmdata = data+"&act=GETCOUNTTM";

         podata = data+"&act=GETCOUNTPO";
         var catearr = [];
         var totemparr = [];
         var totemplin = [];

         var rbmtotemp = 0;
         var tmtotemp = 0;
         var pototemp = 0;

         var rbmtotlin = 0;
         var tmtotlin = 0;
         var pototlin = 0;

         //$('#RBMReportTable').DataTable().destroy();
         RBMReportTable = $('#RBMReportTable').DataTable({
           destroy: true,
            "columnDefs": [
            {
                "targets": [ 2,3,8,9 ],
                "visible": false,
              }],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "LoginActivity.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:rbmdata}
            },
            "footerCallback": function ( row, data, start, end, display ) {
               var api = this.api(), data;
              // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };
              // Total emp
               emptotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                 // Total over all login
               lintotal = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                nlintotal = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 5 ).footer() ).html(emptotal);
            $( api.column( 6 ).footer() ).html(lintotal);
            $( api.column( 7 ).footer() ).html(nlintotal);

            rbmtotemp = emptotal;
            rbmtotlin = lintotal;
            }

        });

            
           
           TMReportTable = $('#TMReportTable').DataTable({
             destroy: true,
            "columnDefs": [
            {
                "targets": [ 2,3,9,10 ],
                "visible": false,
              }],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "LoginActivity.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:tmdata},
            },
                "footerCallback": function ( row, data, start, end, display ) {
               var api = this.api(), data;
              // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };

               // Total terriorty
               tmtotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

              // Total emp
               emptotal = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                 // Total over all login
               lintotal = api
                .column( 9)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                nlintotal = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 5 ).footer() ).html(tmtotal);
            $( api.column( 6 ).footer() ).html(emptotal);
            $( api.column( 7 ).footer() ).html(lintotal);
            $( api.column( 8 ).footer() ).html(nlintotal);
            
            tmtotemp = emptotal;
            tmtotlin = lintotal;
               
            }
        });

         /* POReportTableDet.rows().remove().draw();
           $('#POReportTable').DataTable().destroy();*/
           POReportTable = $('#POReportTable').DataTable({
             destroy: true,
            "columnDefs": [
            {
                "targets": [ 3,8,9 ],
                "visible": false,
            }],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "LoginActivity.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:podata}
            },
            
          "footerCallback": function ( row, data, start, end, display ) {
               var api = this.api(), data;
              // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };
              // Total emp
               emptotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                 // Total over all login
               lintotal = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                nlintotal = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 5 ).footer() ).html(emptotal);
            $( api.column( 6 ).footer() ).html(lintotal);
            $( api.column( 7 ).footer() ).html(nlintotal);

            pototemp = emptotal;
            pototlin = lintotal;
            },
             "initComplete": function(settings, json) {
              if($(".inichartData1").length>0){
                catearr.push('RM');
                totemparr.push(rbmtotemp);
                totemplin.push(rbmtotlin);
              }
              if($(".inichartData2").length>0){
                catearr.push('TM');
                totemparr.push(tmtotemp);
                totemplin.push(tmtotlin);
              }
                
               if($(".inichartData3").length>0){
                catearr.push('PO');
                totemparr.push(pototemp);
                totemplin.push(pototlin);
               }
               genLoginChart(catearr,totemparr,totemplin);

                if($('#RBMReportTable').length>0){
                  $('#RBMReportTable tbody tr:eq(0)').trigger('click'); 
                }

                if($('#TMReportTable').length>0){
                  $('#TMReportTable tbody tr:eq(0)').trigger('click'); 
                }

                if($('#POReportTable').length>0){
                  $('#POReportTable tbody tr:eq(0)').trigger('click'); 
                }
          }

        });
         

           $("#loader-wrapper").css('display','none');
    

      /* currentRequest =  $.ajax({
          url: 'LoginActivity.php',
          type: 'POST',
          dataType: 'json',
          data: data,
           beforeSend : function() {     
            
              if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            if(res!=null)
              genReport(data);
               $("#loader-wrapper").css('display','none');
          }
           });*/

       return false;
      });

 $('#RBMReportTable tbody').on( 'click', 'tr', function () {
    //console.log( TMReportTable.row( this ).data() );
    var rowdata = RBMReportTable.row( this ).data() ;
    console.log(rowdata);
      var data = $(".filter-form").serialize();
     data += "&act=GETLOGINDETRBM&zmLocation="+rowdata[2];
  $('#RBMReportTableDet').DataTable().destroy();
           RBMReportTableDet = $('#RBMReportTableDet').DataTable({
            "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": false
            }
        ],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "LoginActivity.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:data}
            },
        });
} );

    $('#TMReportTable tbody').on( 'click', 'tr', function () {
    
    var rowdata = TMReportTable.row( this ).data() ;
    console.log(rowdata);
      var data = $(".filter-form").serialize();
     data += "&act=GETLOGINDETTM&rbmLocation="+rowdata[3];
    $('#TMReportTableDet').DataTable().destroy();
           TMReportTableDet = $('#TMReportTableDet').DataTable({
            "columnDefs": [
            {
                "targets": [ 8 ],
                "visible": false,
                "searchable": false
            }
        ],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "LoginActivity.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:data}
            },
        });
} );


        $('#POReportTable tbody').on( 'click', 'tr', function () {
    //console.log( TMReportTable.row( this ).data() );
    var rowdata = POReportTable.row( this ).data() ;
      var data = $(".filter-form").serialize();
     data += "&act=GETLOGINDETPO&tmlocation="+rowdata[3];
    $('#POReportTableDet').DataTable().destroy();
           POReportTableDet = $('#POReportTableDet').DataTable({
           "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
                "searchable": false
            }
        ],
        "scrollX": true,
            //"responsive": true,
            "pageLength": 5,
             "aProcessing": true,
                "aServerSide": true,
            "ajax": {
               "url": "LoginActivity.php",
                "type": "POST",
                "data" : {Action:'getresult',filterData:data}
            },
        });
} );

        $('#RBMReportTableDet tbody').on( 'click', 'tr', function () {
          
    
    var rowdata = RBMReportTableDet.row( this ).data() ;
    Logindata = rowdata[5];
   Logindata =  Logindata.split("<br>");
   var dtrows = "";
   var sno = 1
   for(var dt in Logindata){
    if(Logindata[dt]!=""){
        dtrows +="<tr><td>"+sno+"</td><td>"+Logindata[dt]+"</td></tr>";
        sno++;
    }
      
   }
    $(".logindetbody").html("");
     $(".logindetbody").html(dtrows);
    $("#LoginDetModal").modal("show");
      
} );
        $('#TMReportTableDet tbody').on( 'click', 'tr', function () {
    var rowdata = TMReportTableDet.row( this ).data() ;
    Logindata = rowdata[8];
   Logindata =  Logindata.split("<br>");
   var dtrows = "";
   var sno = 1
   for(var dt in Logindata){
    if(Logindata[dt]!=""){
        dtrows +="<tr><td>"+sno+"</td><td>"+Logindata[dt]+"</td></tr>";
        sno++;
    }
      
   }
    $(".logindetbody").html("");
     $(".logindetbody").html(dtrows);
    $("#LoginDetModal").modal("show");
      
} );

     $('#POReportTableDet tbody').on( 'click', 'tr', function () {
    var rowdata = POReportTableDet.row( this ).data() ;
    Logindata = rowdata[7];
   Logindata =  Logindata.split("<br>");
   var dtrows = "";
   var sno = 1
   for(var dt in Logindata){
    if(Logindata[dt]!=""){
        dtrows +="<tr><td>"+sno+"</td><td>"+Logindata[dt]+"</td></tr>";
        sno++;
    }
      
   }
    $(".logindetbody").html("");
     $(".logindetbody").html(dtrows);
    $("#LoginDetModal").modal("show");
} );

          /*  $("body").on("click",".pdivision",function(){

       //$("#loader-wrapper").css('display','block');
        TMReportTable.rows().remove().draw();
        TMReportTableDet.rows().remove().draw();
        POReportTable.rows().remove().draw();
        POReportTableDet.rows().remove().draw();


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
         
    });*/

var fcurrentRequest = null;
     $("body").on("change",".pdivision",function(){

       //$("#loader-wrapper").css('display','block');
        TMReportTable.rows().remove().draw();
        TMReportTableDet.rows().remove().draw();
        POReportTable.rows().remove().draw();
        POReportTableDet.rows().remove().draw();

        dataAreaId = $(this).val();
         fcurrentRequest =  $.ajax({
            url: 'Ajax1.php',
            type: 'POST',
            dataType: 'json',
            async:false,
             beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
             /* if(currentRequest != null) {
                  currentRequest.abort();
              }*/
          },
            data: {Action: 'GetFilterOpt',dataAreaId:dataAreaId},
            success:function(res){
              var Dcode = "";
              if($(".zmLocSelect").length>0){
                Dcode ="ZM";
              }else if($(".rbmLocSelect").length>0){
                Dcode ="RBM";
              }else if($(".tmLocSelect").length>0){
                Dcode ="TM";
              }else {
                Dcode ="PO";
              }
              GenSelectOpt(res,Dcode);
              $("#loader-wrapper").css('display','none');
            }
          });
       });


$(".pdivision").change();


    
   /* function genTrendChart(TrendChartData){
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
               allowDecimals:false,
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
    }*/


/*0*/

  function GenSelectOpt(res,Dcode=""){

              var zmLocOpt =  rbmLocSelect = tmLocSelect = poLocCodeOpt =  popt = activityOpt = "";
               
              if(res.hasOwnProperty('zoneDet')){
                 zoneDet = res.zoneDet;
                 for(var zi in zoneDet ){
                      zmLocOpt +="<option value='"+zoneDet[zi].ZoneId+"'>"+zoneDet[zi].ZoneName+"</option>";
                 }
                 $(".zmLocSelect").html("");
                   $(".zmLocSelect").html(zmLocOpt);
              }

              if(res.hasOwnProperty('regionDet')){
                 regionDet = res.regionDet;
                 for(var ri in regionDet ){
                  rid  = regionDet[ri].RegionId;
                  rname  = regionDet[ri].RegionName;
                  var zone="";
                  if(regionDet[ri].hasOwnProperty('Zone')){
                    zone=regionDet[ri].Zone;
                  }
                  ridval = rname;
                  if(rid=="All"){
                    ridval = 'All';
                  }

                      rbmLocSelect +="<option value='"+rid+"' data-zone='"+zone+"' >"+ridval+"</option>";
                 }
                 $(".rbmLocSelect").html("");
                   $(".rbmLocSelect").html(rbmLocSelect);
              }
             

              if(res.hasOwnProperty('tmDet')){
                 tmDet = res.tmDet;
                 for(var ti in tmDet ){
                  tid  = tmDet[ti].TMID;
                  tmname  = tmDet[ti].TMName;
                  tidval = tmname;
                 
                  if(tid=="All"){
                    tidval = 'All';
                  }

                      tmLocSelect +="<option value='"+tid+"' >"+tidval+"</option>";
                 }
                  $(".tmLocSelect").html("");
                   $(".tmLocSelect").html(tmLocSelect);
              }
             
              if(res.hasOwnProperty('poDet')){
                  poDet = res.poDet;
                  for(var pi in poDet ){
                     poid  = poDet[pi].POHQCODE;
                    // console.log(poid);
                    poname  = poDet[pi].POHQNAME;
                    poval = poname;
                    if(poid=="All"){
                      poval = 'All';
                    }
                  poLocCodeOpt +="<option value='"+poid+"' >"+poval+"</option>";
                 }

                 $(".poLocSelect").html(poLocCodeOpt);

              } 
              
               if(res.hasOwnProperty('products')){
                    products = res.products;
                    for(var j in products ){
                      popt +="<option value='"+products[j]+"'>"+products[j]+"</option>";
                  }
                  $(".productSelect").html(popt);
               }

      

        if(Dcode=="ZM"){
          if($(".zmLocSelect").val()=="All"){
            $(".rbmLocSelect").prop("disabled",true);  
          }else{
            $(".rbmLocSelect").prop("disabled",false);  
          }
          $(".tmLocSelect").prop("disabled",true);
          $(".poLocSelect").prop("disabled",true);
        }else if(Dcode=="RBM"){
           if($(".rbmLocSelect").val()=="All"){
            $(".tmLocSelect").prop("disabled",true);  
          }else{
             $(".tmLocSelect").prop("disabled",false); 
          }
          $(".poLocSelect").prop("disabled",true);
        }else if(Dcode=="TM"){
            if($(".tmLocSelect").val()=="All"){
             $(".poLocSelect").prop("disabled",true);  
           }else{
             $(".poLocSelect").prop("disabled",false);
           }  
        }else{
          $(".poLocSelect").prop("disabled",false);  
        }
        

              if(windowsonload){
                $(".filter-form").submit();
                windowsonload = false;
               }
    }

 

$(window).bind('beforeunload',function(){

     //save info somewhere

   if(currentRequest != null) {
                  currentRequest.abort();
              }

});

$("body").on("change",".zmLocSelect",function(e){
  //$("#loader-wrapper").css('display','block');
  var zmall_code = sep ="";
    if($(this).val()=="All"){
        $(".rbmLocSelect").prop("disabled",true);
        $(".tmLocSelect").prop("disabled",true);
        $(".poLocSelect").prop("disabled",true);
         $(".zmLocSelect option").each(function(index, el) {
          if($(this).val()!="All") {
            zmall_code +=sep+$(this).val();
            sep=",";
          }
      });
     
      zmval = zmall_code;
    }else{
      $(".rbmLocSelect").prop("disabled",false);
      zmval = $(this).val();
    }
  
    
      fcurrentRequest =  $.ajax({
          url: 'Ajax1.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {Action: 'GET_RBM',ZMLOC:zmval,dataAreaId:$(".pdivision").val()},
          beforeSend : function()   {           
              if(fcurrentRequest != null) {
                  fcurrentRequest.abort();
              }
               if(currentRequest != null) {
                  currentRequest.abort();
              }
          },
          success:function(res){
            GenSelectOpt(res,"ZM");
              $("#loader-wrapper").css('display','none');
          }
        });
});


  
    function genLoginChart(categoriesarr=[],totemparr=[],linarr=[]){
       console.log(categoriesarr);
                console.log(totemparr);
                console.log(linarr);
  Highcharts.chart('LoginSummary', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: categoriesarr
        },
        yAxis: {
            min: 0,
        },
        tooltip: {
        shared: true,
    },
        legend: {
              align: 'center',
                verticalAlign: 'bottom',
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
        },
        plotOptions: {
            column: {
                grouping: true,
                shadow: false
            }
        },
        series: [{
            name: 'Total Employee',
            data: totemparr,
        }, {
            name: 'Logged in',
            data: linarr,
        }]
    });

    }

    $("body").on("click",".fresetbtn",function(){
     window.location.reload();
  });
  </script>
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>