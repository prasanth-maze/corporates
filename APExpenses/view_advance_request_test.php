<?php 
include 'header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<!-- datatables coumn visibility -->
<!-- <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" /> -->
<!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.minfd53.css?v4.0.1">
<link rel="stylesheet" href="../assets/css/menu.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="css/attention.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    padding: 23px 0px 30px 0px;
}
.page {
    padding-left: 4.3%;
}
h3.panel-title {
    padding: 20px 30px;
}
.bg-green {background: #a7e4b5;}
.search_opt .card {
  border: 1px solid #a7e4b5;
}
.search_opt .select2-container {
  width: 100% !important;
}
.search_opt .select2-container .select2-selection--single, .expensesDiv .select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px !important;
}
.search_opt .select2-container .select2-selection--single .select2-selection__rendered {
  padding: 4px 20px;
}
.search_opt label {
    margin-top: 8px;
    display: inline-block;
    font-size: 13px;
    font-weight: bold;
    padding: 0px 12px;
}
.search_opt h5 {
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
}
.search_opt [type=submit] {
    width: 135px;
    margin: 14px auto 0;
    background: #3f51b5;
    color: #fff;
    font-size: 13px;
    border-radius: 5px;
    text-align: center;
}
.search_opt .card-header h5.collapsed:after {
    content: "\f107";
    font-size: 25px;
    line-height: 0.6;
    padding: 0px 12px;
}
.search_opt .card-header h5:after {
    font-family: 'FontAwesome';
    content: "\f106";
    float: left;
    font-size: 25px;
    line-height: 0.6;
    padding: 0px 12px;
}

div.dt-buttons {
    position: relative;
    float: right;
    top: 8px;
}
div.dt-buttons a, div.dt-button-collection a.dt-button{
  background: green;
}
.new-req {
  float: right;
    background: green;
    padding: 6px;
    border-radius: 4px;
    color: #fff;
    font-size: 13px;
    position: relative;
    top: 9px;

}
#ReportTablediv {
  padding-top:0;
}

.table thead:first-child th {
    font-weight: bold;
    
    border-bottom: 1px solid #000;
}
.new-req:hover {
    color: #fff;
}
/* custom show entries */
#DivisionRestbl_length select.form-control {
    padding-right: 0px !important;
    background-position: 33px 12px !important;
}
#DivisionRestbl_length select {
    width: 55px !important;
}
#DivisionRestbl_length .form-control-sm {
  padding: 4px 6px !important;
}
.pt-20 {
    padding-top: 0px!important;
}
.dashboard .card, .dashboard .panel {
    margin-bottom: 15px;
}


</style>

<body class="animsition site-navbar-small dashboard" style="font-size: small;">
<div id="loader-wrapper" style="display: none;" >
    <div id="loader"></div>
</div>
</div>
<?php include 'top_nav.php'; ?>
  <!-- Page -->
  <div class="page" style="margin-top: 0px !important">
    <div class="page-content container-fluid ">
      <div class="panel panel-bordered">
            <div class="col-md-12 search_opt mt-1">
            <div id="accordion">
  <div class="card">
    <div class="card-header p-0" id="headingOne">
      <h5 class="m-0 py-2 px-4 bg-green collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Search Option</h5>    
    </div>

    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <form method="POST" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-md-5 my-1">
              <div class="row">
                <label class="col-md-3">Request Date</label>
                <div class="col-md-9">
                <div class="input-daterange" data-plugin="datepicker" data-date-format="dd-mm-yyyy">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm" name="fromdate" autocomplete="off" value="">
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control form-control-sm" name="todate" autocomplete="off" value="">
                      </div>
                    </div>
                </div>
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col-md-5 my-1">
              <div class="row">
                <label class="col-md-3">Division</label>
                <div class="col-md-9">
                <select class="js-example-basic-single col-xs-12 cls_division" name="division_id" onchange="get_region(this.value);">
                <option value="">Select </option>
                  <?php
                          $divsion =sqlsrv_query($conn,"SELECT DISTINCT $TRZMapping.ZONEID,$zmtbl.ZONENAME  FROM $TRZMapping LEFT JOIN $zmtbl on $TRZMapping.ZONEID=$zmtbl.ZoneID");
                          while($row = sqlsrv_fetch_array($divsion)){
                      ?>
                      <option value="<?php echo $row['ZONEID']; ?>"> <?php echo $row['ZONENAME']; ?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-5 my-1">
              <div class="row">
                <label class="col-md-3">Region</label>
                <div class="col-md-9">
                <select class="js-example-basic-single col-xs-12 cls_region" name="region_id" onchange="get_teritory(this.value);" >
                    <option value="">Select </option>
                    </select>
                </div>
              </div>
            </div>

            <div class="col-md-5 my-1">
              <div class="row">
                <label class="col-md-3">Territory</label>
                <div class="col-md-9">
                    <select class="js-example-basic-single col-xs-12 cls_teritory" name="teritory_id" onchange="get_employee(this.value);">
                    <option value="">Select </option>
                    </select>
                </div>
              </div>
            </div>

            <div class="col-md-5 my-1">
              <div class="row">
                <label class="col-md-3">Status</label>
                <div class="col-md-9">
                  <select class="js-example-basic-single">
                    <option value="">All</option>
                    
                  </select>
                </div>
              </div>
            </div>

      <div class="col-md-11 ">
        <input type="submit" class="form-control" />
      </div>
          </div>
        </form> 
      </div>
    </div>
  </div>
  </div>
  <?php if(isset($_REQUEST['requesthhhh_id'])){  ?>
    <script src="js/attention.js"></script>
    <div class="demo">
    </div>
<script>		
$(document).ready(function(){
  new Attention.Alert({
        title: 'Nice alert!',
        content: 'This is my content',
        afterClose: () => {
          window.location='view_advance_request_test.php';
            // demo.innerHTML += '<h4>Alert was closed</h4>';
        }
      });
  });
  const demo = document.querySelector('.demo');
</script>
  <?php } ?>
  <div class="panel-body ReportTablediv" id="ReportTablediv">
    <div class="tab-content">
        <div class="tab-pane restabpanel active" id="DivisionRes"  role="tabpanel">
        <a href="advance_request.php" class="new-req">Create New Request</a>
          <table class="table table-hover dataTable table-striped w-full example" id="DivisionRestbl" data-loaded='no'>
              <thead>
                  <tr>
                      <th>S.No.</th>
                      <th>Req. Id</th>
                      <th>Region</th>
                      <th>Teritory</th>
                      <th>Crop</th>
                      <th>Sub Activity</th>
                      <th>Req. Date </th>
                      <th>Advance To</th>
                      <th>Req. Amt.</th>
                      <th>Recommended Amt.</th>
                      <th>Paid Amt.</th>
                      <!-- <th>Settled Amt.</th>
                      <th>Balance</th> 
                      <th>Status</th>-->
                      <th>More</th>
                  </tr>
              </thead>
              <tbody>
              <?php 
              $i =0;
              $viw_adv =sqlsrv_query($conn,"usp_ANPAdvvance_view");  
              while($rows = sqlsrv_fetch_array($viw_adv)){ 
                $i++;
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows['ReqId']; ?></td>
                  <td><?php echo $rows['ReqRegionName']; ?></td>
                  <td><?php echo $rows['ReqTeritoryName']; ?></td>
                  <td><?php echo $rows['CropId']; ?></td>
                  <td><?php echo $rows['SUBACTIVITY']; ?></td>
                  <td><?php echo $rows['ReqDate']; ?></td>
                  <td><?php echo $rows['AdvanceTo']; ?></td>
                  <td align="right"><?php echo $rows['AdvAmount']; ?></td>
                  <td align="right"><?php echo $rows['ApprovedAmount']; ?></td>
                  <td align="right"><?php echo $rows['AdvPaidAmount']; ?></td>
                  <!-- <td>0</td>
                  <td>0</td> 
                  <td> - </td>-->

                  <td> 
                  <?php if($rows['ApprovedAmount'] == '') {?>
                    <button type="button" onclick="window.location.href='remark_advance.php?Advid=<?php echo $rows['AdvId']; ?>&&AdvAmtid=<?php echo $rows['AdvAmtId']; ?>'" class="btn btn-sm btn-danger">Delete&nbsp;</button>
                  <?php } ?>
                  </td>
                </tr>
              <?php  } ?>
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
  <!-- End Modal -->
<script>


window.onload = addElement;



function addElement() {
  // create a new div element 
  // and give it popup content 
  var newDiv = document.createElement("div");
  var texts = 'erd';
  newDiv.innerHTML += '<div id="popup" style=" position: absolute;top: 5%;width: 800px;height: 200px;margin: auto;z-index: 99999;display: block;left:25%;background-color: #fff;  border: 1px solid #ddd;  border-radius: 5px;  box-shadow: 0 1px 6px 4px #000;  overflow: hidden;   padding: 10px;"><div class="popup_body" style="  height: 160px;">' + texts + '</div><button style="padding: 10px;" class="close_button"onClick="closePopup()">Sluiten</button><button  style="padding: 10px;" class="close_button"onClick="tostoring()">Meer Informatie</button></div>';

 // Add The Background cover
  var BG = document.createElement("div");
  //BG.style.background-color = 'black';
  BG.style.width = '100%';
  BG.style.height = '100%';
  BG.style.background = 'black';
  BG.style.position = 'fixed';
  BG.style.top = '0';
  BG.style.left = '0';
  BG.style.opacity = '0.9';
  BG.style.displpay = 'none';
  BG.setAttribute("id", "bgcover");
  
  // add the newly created elements and its content into the DOM 
document.body.appendChild(BG);
document.body.insertBefore(newDiv, BG);
  // open popup onload
  openPopup();
}

function openPopup() {
  var el = document.getElementById('popup');
  var BG = document.getElementById('bgcover');
  el.style.display = 'block';
  BG.style.display = 'block';
  
  
 
}

function tostoring() {
window.location.href = '../testing/storing.php';
 
}





  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>
<script type="text/javascript">   
$(document).ready(function() {
     $('#DivisionRestbl').DataTable( {
         orderCellsTop: true,
         fixedHeader: true,
         lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        //  dom: 'lBfrtip',
         "scrollX": true,
         "scrollY":500,
         buttons: [
           'colvis'
       ]
     } );
 } );
 </script>
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
<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:29:07 GMT -->
</html>