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
      <div class="panel panel-bordered">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Result</h3>
            </div>
            <div class="panel-body ReportTablediv" id="ReportTablediv">
    <div class="nav-tabs-horizontal" data-plugin="tabs">
         <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link restabs active" data-toggle="tab"  href="#DivisionRes" aria-controls="DivisionRes" role="tab">Division</a></li>
           <li class="nav-item" role="presentation"><a class="nav-link restabs" data-toggle="tab"  href="#RegionRes" aria-controls="RegionRes" role="tab">Region</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link restabs" data-toggle="tab"  href="#TerriotryRes" aria-controls="TerriotryRes" role="tab">Terriotry</a></li>
             <li class="nav-item" role="presentation"><a class="nav-link restabs" data-toggle="tab"  href="#POHQRes" aria-controls="POHQRes" role="tab">POHQ</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link restabs" data-toggle="tab"  href="#VillageRes" aria-controls="VillageRes" role="tab">Villages</a></li>
               <li class="nav-item" role="presentation"><a class="nav-link restabs" data-toggle="tab"  href="#UserRes" aria-controls="UserRes" role="tab">User Information</a></li>
        </ul>
          <div class="tab-content pt-20">
             <div class="tab-pane restabpanel active" id="DivisionRes"  role="tabpanel">
                <table class="table table-hover dataTable table-striped w-full" id="DivisionRestbl" data-loaded='no'>
                    <thead>
                        <tr>
                           <th>SNo</th><th>DBM Id</th><th>DBM Name</th><th>ZONE Id</th><th>ZONE Name</th><th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
               <div class="tab-pane restabpanel" id="RegionRes"  role="tabpanel">
                  <table class="table table-hover dataTable table-striped w-full" id="RegionRestbl" data-loaded='no'>
                      <thead>
                          <tr>
                             <th>SNo</th><th>RBM Id</th><th>Employee Name</th><th>Region Id</th><th>Region Name</th><th>State Id</th><th>Zone Id</th><th>Zone Name</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
               <div class="tab-pane restabpanel" id="TerriotryRes"  role="tabpanel">
                  <table class="table table-hover dataTable table-striped w-full" id="TerriotryRestbl" data-loaded='no'>
                      <thead>
                          <tr>
                             <th>SNo</th><th>TM Id</th><th>TM Name</th><th>Employee Id</th><th>Employee Name</th><th>Email</th><th>State Id</th><th>Region Id</th><th>Region Name</th><th>Zone Id</th><th>Zone Name</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
               <div class="tab-pane restabpanel" id="POHQRes"  role="tabpanel">
                  <table class="table table-hover dataTable table-striped w-full" id="POHQRestbl" data-loaded='no'>
                      <thead>
                          <tr>
                             <th>SNo</th><th>State Id</th><th>POHQ Code</th><th>POHQ Name</th><th>PO Code</th><th>PO Name</th><th>Password</th><th>Vacant</th><th>TM Id</th><th>TM Name</th><th>Region Id</th><th>Region Name</th><th>Zone Id</th><th>Zone Name</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
               <div class="tab-pane restabpanel" id="VillageRes"  role="tabpanel">
                  <table class="table table-hover dataTable table-striped w-full" id="VillageRestbl" data-loaded='no'>
                      <thead>
                          <tr>
                             <th>SNo</th><th>POHQ Code</th><th>TM Code</th><th>Village Name</th><th>TM Id</th><th>TM Name</th><th>Region Id</th><th>Region Name</th><th>Zone Id</th><th>Zone Name</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
          <div class="tab-pane restabpanel" id="UserRes"  role="tabpanel">
            <table class="table table-hover dataTable table-striped w-full" id="UserRestbl" data-loaded='no'>
                <thead>
                    <tr>
                       <th>SNo</th><th>Employee Id</th><th>Password</th><th>User Status</th><th>AP Designation</th><th>Division</th>
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

      </div>
    </div>
  </div>

        
                  </div>
                  <!-- End Modal -->
  <footer class="site-footer">
    <div class="site-footer-legal">2019 <a href="https://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202"></a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Agna</a>
    </div>
  </footer>
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
  if($("#DivisionRestbl").length>0){
    var DivisionRestbl = $("#DivisionRestbl").DataTable();    
  }

  if($("#RegionRestbl").length>0){
    var RegionRestbl = $("#RegionRestbl").DataTable();    
  }

   if($("#TerriotryRestbl").length>0){
    var TerriotryRestbl = $("#TerriotryRestbl").DataTable();    
  }

   if($("#POHQRestbl").length>0){
    var POHQRestbl = $("#POHQRestbl").DataTable();    
  }

  if($("#VillageRestbl").length>0){
    var VillageRestbl = $("#VillageRestbl").DataTable();    
  }

   if($("#UserRestbl").length>0){
    var UserRestbl = $("#UserRestbl").DataTable();    
  }
  
  function genReport(filteropt){
    $("#loader-wrapper").css('display','block');
      if($("#DivisionRestbl").length>0){
         $('#DivisionRestbl').DataTable().destroy();
            DivisionRestbl = $("#DivisionRestbl").DataTable({
                 //destroy: true,
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
                       "url": "UMReportgen.php",
                        "type": "POST",
                        "data" : {Action:'ZONEDET',filterData:filteropt}
                    }
                
                });
    }

     if($("#RegionRestbl").length>0){
      $('#RegionRestbl').DataTable().destroy();
            RegionRestbl = $("#RegionRestbl").DataTable({
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
                       "url": "UMReportgen.php",
                        "type": "POST",
                        "data" : {Action:'REGIONDET',filterData:filteropt}
                    }
                
                });
    }

      if($("#TerriotryRestbl").length>0){
          $('#TerriotryRestbl').DataTable().destroy();
            TerriotryRestbl = $("#TerriotryRestbl").DataTable({
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
                       "url": "UMReportgen.php",
                        "type": "POST",
                        "data" : {Action:'TMDET',filterData:filteropt}
                    }
                
                });
    }

    if($("#POHQRestbl").length>0){
       $('#POHQRestbl').DataTable().destroy();
            POHQRestbl = $("#POHQRestbl").DataTable({
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
                       "url": "UMReportgen.php",
                        "type": "POST",
                        "data" : {Action:'POHQDET',filterData:filteropt}
                    }
                
                });
    }

    if($("#VillageRestbl").length>0){
      $('#VillageRestbl').DataTable().destroy();
            VillageRestbl = $("#VillageRestbl").DataTable({
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
                       "url": "UMReportgen.php",
                        "type": "POST",
                        "data" : {Action:'VILLAGEDET',filterData:filteropt}
                    }
                
                });
    }
    
    if($("#UserRestbl").length>0){
      $('#UserRestbl').DataTable().destroy();
            UserRestbl = $("#UserRestbl").DataTable({
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
                       "url": "UMReportgen.php",
                        "type": "POST",
                        "data" : {Action:'USERINFO',filterData:filteropt}
                    }
                
                });
    }
    $("#loader-wrapper").css('display','hide');
  }
  
  

    $("body").on("submit",".filter-form",function(e){
      /*$('#TMReportTable').DataTable().destroy();
      $('#POReportTable').DataTable().destroy();*/
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

           genReport(data);

           $("#loader-wrapper").css('display','none');
    

       return false;
      });

  var fcurrentRequest = null;
     $("body").on("change",".pdivision",function(){

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

  </script>
  
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>