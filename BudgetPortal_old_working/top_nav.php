<?php
                    $cpage = basename($_SERVER['SCRIPT_NAME'],'.php');

                  $addfcm = $addras = $addfrg =  'no';
                    if($_SESSION['Dcode']=='ADMIN'){
                      $addfcm = $addras = $addfrg= 'yes';
                    }else if($_SESSION['Dcode']=='ZM'){
                      $sql ="SELECT * FROM  ".$zmtbl." WHERE DBMID='".$_SESSION['EmpID']."' AND dataAreaid='ras' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addras='yes';
                      }

                      $sql ="SELECT * FROM  ".$zmtbl." WHERE DBMID='".$_SESSION['EmpID']."' AND dataAreaid='fcm' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfcm='yes';
                      }

                      $sql ="SELECT * FROM  ".$zmtbl." WHERE DBMID='".$_SESSION['EmpID']."' AND dataAreaid='frg' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfrg='yes';
                      }

                    }else if($_SESSION['Dcode']=='GM'){
                      $sql ="SELECT * FROM  ".$emptbl." WHERE EMPLID='".$_SESSION['EmpID']."' AND DIVISION='Cotton' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addras='yes';
                      }

                      $sql ="SELECT * FROM  ".$emptbl." WHERE EMPLID='".$_SESSION['EmpID']."' AND DIVISION='FieldCrop' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfcm='yes';
                      }

                      $sql ="SELECT * FROM  ".$emptbl." WHERE EMPLID='".$_SESSION['EmpID']."' AND DIVISION='ForageSeeds' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfrg='yes';
                      }

                    }else if($_SESSION['Dcode']=='RBM'){
                      $sql ="SELECT * FROM  ".$regtbl." WHERE RBMID='".$_SESSION['EmpID']."' AND dataAreaid='ras' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addras='yes';
                      }

                      $sql ="SELECT * FROM  ".$regtbl." WHERE RBMID='".$_SESSION['EmpID']."' AND dataAreaid='fcm' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfcm='yes';
                      }

                      $sql ="SELECT * FROM  ".$regtbl." WHERE RBMID='".$_SESSION['EmpID']."' AND dataAreaid='frg' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfrg='yes';
                      }

                    }else if($_SESSION['Dcode']=='TM'){
                      $sql ="SELECT * FROM  ".$tmtbl." WHERE EMPLID='".$_SESSION['EmpID']."' AND dataAreaid='ras' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addras='yes';
                      }

                      $sql ="SELECT * FROM  ".$tmtbl." WHERE EMPLID='".$_SESSION['EmpID']."' AND dataAreaid='fcm' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfcm='yes';
                      }

                      $sql ="SELECT * FROM  ".$tmtbl." WHERE EMPLID='".$_SESSION['EmpID']."' AND dataAreaid='frg' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfrg='yes';
                      }

                    }else if($_SESSION['Dcode']=='PO'){
                      $sql ="SELECT * FROM  ".$pohqtbl." WHERE POCODE='".$_SESSION['EmpID']."' AND dataAreaid='ras' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addras='yes';
                      }

                      $sql ="SELECT * FROM  ".$pohqtbl." WHERE POCODE='".$_SESSION['EmpID']."' AND dataAreaid='fcm' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfcm='yes';
                      }

                      $sql ="SELECT * FROM  ".$pohqtbl." WHERE POCODE='".$_SESSION['EmpID']."' AND dataAreaid='frg' ";

                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                      $row_count = sqlsrv_num_rows($res);
                      if($row_count!=0){
                        $addfrg='yes';
                      }

                    }

                      $pdivopt = array();
                    if($addras=='yes'){
                      $pdivopt["ras"] = "Cotton";
                    }
                    if($addfcm=='yes'){
                      $pdivopt["fcm"] = "Field Crop";
                    }

                      if($addfrg=='yes'){
                         $pdivopt["frg"] = "Forage Seeds";
                    }
               ?>

?>
<script type="text/javascript">
  function openNav() {
    document.getElementById("mySidenav_sc").style.width = "25%";
}

function closeNav() {
    document.getElementById("mySidenav_sc").style.width = "0";
}

</script>

<style type="text/css">
  .row.top-menu {
    margin-top: 1.4%;
}
.page-cs{
  margin-top: -84px;
}
button.btn.btn-success.btn-rs.resetbtn.waves-effect.waves-classic {
    height: 33px;
    width: 66px;
    left: 4px;
    top: 3px;
    background-color: #868e96;
    border-color: #616161;
}
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 40;
    top: 0;
    left: 0;
    background-color: #FFFFFF;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    box-shadow: 1px 0px 3px #cccccc;
    font-family: "Roboto";
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 16px;
    color: #000000;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #818181;
}

.sidenav .closebtn {
    position: absolute;
    float: left;
    top: 8px;
    /*right: 0px;*/
    font-size: 21px;
    /*margin-left: 50px;*/
}
.closebtn1
{
  float: right;
  position: absolute;
  top: 1%;
  right: 0px;
  margin-left: 50px;

}


@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.topdashboardicon{
  cursor:pointer
}
.Plan .col-md-6 {
    float: left;
    max-height: 10px;
}
.Plan .panel-bordered>.panel-body {
    padding-top: 10px!important;
}
.panel-bordered>.panel-body
{
  padding-top: 15px!important;
}
.Plan .form-group {
    margin-bottom: 2.429rem;
}

/*.dropdown-toggle
{
  padding: 0!important;
  font-size: 13px!important;
}*/
/*.btn-group-sm>.btn, .btn-sm
{
padding: .429rem 17.5px;
margin-bottom: 12px;
}*/
.btn
{
  padding: 0.429rem 0.752rem;
  font-size: 10px;
}
.dropdown-toggle .btn .btn-default
{
padding-right: 11px;
}
.dropdown-toggle::after
{
/*margin-right: 9prx;*/
margin-left: 0.7em;
}

.col-lg-5
{
  flex: 0 0 33.667%;
}
.btn.btn-default.btn-rs.fresetbtn.waves-effect.waves-classic
{
    padding: 10px 18px;
    margin-top: 10px;
    margin-left: -10px;
    font-size: 12px;
    border-radius: 8px;
}
.btn.btn-success.btn-sm.submitbtn.waves-effect.waves-classic
{
    padding: 10px 18px;
    margin-left: -10px;
    font-size: 12px;
    border-radius: 8px;
}
.multiselect-container {
        max-height: 200px;
        width: 150;
        overflow-y: auto;
        
    }
     .btn-group .dropdown-menu>li>a{
      padding: 3px 0px;
    }
    .multiselect-container>li>a>label
    {
      padding: 3px 10px!important ;
    }
</style>

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
    role="navigation" style="margin-top: -18px;padding-left: 6px;">

    <div id="mySidenav_sc" class="sidenav" style="font-family: sans-serif;font-size:18px;">
     <a href="../logout.php" class="closebtn1 fa fa-sign-out" style="color:#0f56dd;">&nbsp;&nbsp;Logout</a>
  <a href="javascript:void(0)" class="closebtn fa fa-th" onclick="closeNav()"></a>
  <ul style="padding-left: 1%;margin-left:  -6%;margin-top: 15%;">
        <a style="">Enterprise Apps</a>
  </ul>
  <ul class="nav navbar-nav">
    <li><a href='../pages/EventDashboard.php' class="fa fa-area-chart" style="color: blue;"><span style="color: #424242;">&nbsp;&nbsp;A & P  Portal</span></a></li>
	<?php
		if($_SESSION['Dcode']=='ADMIN1'){
	?>
    <li><a href="Review.php" class="fa fa-inr" style="color: red;"><span style="color: #424242;">&nbsp;&nbsp;Financial Dashboard</span></a></li>
		<?php } ?>
    <!-- <li><a href="#events">EVENTS</a></li> -->
    <!-- <li><a href="#sch">SCHEDULE</a></li> -->
  </ul>
  <ul class="nav navbar-nav" style="margin-left: 10%;">
   <li><a href="../PDTrail/PDTrailDashBoard.php" class=" fa fa-cubes" style="color: green;"><span style="color: #424242;">&nbsp;&nbsp;PD Trials</span></a></li>
    <!-- <li><a href="#gallery">Settings</a></li> -->
    <!-- <li><a href="#spons">SPONSORS</a></li> -->
   <!--  <li><a href="#contact" class="fa fa fa-history">&nbsp;&nbsp;CONTACT US</a></li> -->
  </ul>
</div>

<div class="row topdashboardicon">
<span onclick="openNav()" class="fa fa-th" style="font-size: 20px;float: right;padding-left: 35px;padding-top: 25px;"></span><br><br><br>
</div>

<!--/. Sidebar navigation -->
  <div class="sidebar-menu sidebar-collapsed">
    
    <header class="logo">

      <a href="javascript:void(0);" class="sidebar-icon">
      <span class="fa fa-bars">
    </span> </a> <a href="javascript:void(0);"> <!-- <img src="../global/photos/logo.png" alt="logo" style="max-width: 55%;
margin-top: 25px;
margin-left: 18px;
margin-right: -40px;"> --></a> </header>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
    <div class="menu">
      <ul id="menu" >
        <li id="menu-home" class="active"><a href="Review.php"><i class="fa fa-home"></i><span>Budget Review</span></a></li>
		<li id="menu-reports" ><a><i class="fa fa-book fa-fw"></i><span>Revenue Analysis</span></a></li>
        
        

        <!-- <li><a href="#"><i class="fa fa-share-alt"></i><span>Share</span><span class="fa fa-angle-right" style="float: right"></span></a>
          <ul>
            <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
            <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
            <li><a href="#"><i class="fa fa-pinterest"></i> Pinterest</a></li>
          </ul>
        </li>
        <li id="menu-comunicacao" ><a href="#"><i class="fa fa-anchor"></i><span>Category</span><span class="fa fa-angle-double-right" style="float: right"></span></a>
          <ul id="menu-comunicacao-sub" >
            <li id="menu-mensagens" style="width: 120px" ><a href="#">Item 1<i class="fa fa-angle-right" style="float: right; margin-right: -8px; margin-top: 2px;"></i></a>
              <ul id="menu-mensagens-sub" >
                <li id="menu-mensagens-enviadas" ><a href="#">Item 1.1</a></li>
                <li id="menu-mensagens-recebidas" ><a href="#">Item 1.2</a></li>
                <li id="menu-mensagens-nova" ><a href="#">Item 1.3</a></li>
              </ul>
            </li>
            <li id="menu-arquivos" ><a href="#">Item 2</a></li>
          </ul>
        </li> -->
        <!-- <li id="menu-academico" ><a href="#"><i class="fa fa-envelope"></i><span>About</span><span class="fa fa-angle-right" style="float: right"></span></a>
          <ul id="menu-academico-sub" >
            <li id="menu-academico-avaliacoes" ><a href="#">Contact us</a></li>
            <li id="menu-academico-boletim" ><a href="#">About us</a></li>
          </ul>
        </li>
        
        <li><a href="#"><i class="fa fa-history"></i><span>Blog</span></a></li>
        <li><a href="#"><i class="fa fa-gears"></i><span>Settings</span></a></li> -->
      </ul>
    </div>
  </div>

    <div class="navbar-header">
      <button type="button" id="menu-id" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"f
        data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
        data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
       <div class="brand-logo" >
	     <a href="../pages/landing.php">
                <img src="../global/photos/logo.png" alt="logo" style="height: 45px !important;
    padding-left: 16px;
    margin-top: -2px;" ></a>
              </div>
    
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
        data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">         
        <li class="nav-item hidden-float">
            <a class="nav-link" href="" role="button">Financial Dashboard</a>
          </li>
         <li class="nav-item hidden-float <?=@($cpage=='Review')?"active":""?>">
            <a class="nav-link" href="Review.php" role="button">Budget Review</a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->

        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">   
        <li class="nav-item hidden-float" id="filter">
            <a class="nav-link" href="javascript:void(0);"><img src="../global/photos/filter.png"></a>
          </li>
                <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);"><?=@$_SESSION['Name'] ?></a>
          </li>  
          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
              data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="../global/photos/signin.png" alt="...">
                <i></i>
              </span>
            </a>
           <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="../logout.php" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
            </div>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
 
  <div id="myDIV" class="site-menubar site-menubar-light" style="height:100%;background-color: #bceacf !important;box-shadow: 1px 2px 10px lightseagreen;display: block;">
    <div class="site-menubar-body">
    
    <form class="form filter-form">
       <div class="row top-menu" style="margin-right: -50px;margin-left:-5px;">
       <div class="col-xxl-3 col-lg-3 col-sm-12" style="max-width: 24%">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered" style="height:106px;width:90%;padding-top: 1px;margin-left: -5%">
            <div class="panel-body" style="margin-top: -10px">
               <div class="row"> 
                 <label class="form-control-label" style="padding-left: 2px;">Period</label>
               <div class="input-daterange" data-plugin="datepicker" data-date-format="mm-yyyy">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control form-control-sm" name="from" autocomplete="off" value="10-2019" />
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control form-control-sm" name="to" autocomplete="off" value="11-2019" />
                    </div>
                  </div>
              <!-- Department -->
               <div style="padding-top: 12px;">
                <label class="form-control-label">Business Division</label>
                <div class="col-lg-12" style="float: right;top: -35px;left: 56%;">
                <select id="pdivision" class="MulSel pdivision" multiple="multiple"  name="pdivision[]">
                <?php
                  $FltrBnsnDvsnArr = array();
                  $sql ="SELECT BusinessDivision FROM  ".$costcentrtbl." GROUP BY BusinessDivision ORDER BY BusinessDivision ASC";
                  $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                  while($row = sqlsrv_fetch_array($res)){ 
                    $FltrBnsnDvsnArr[]=$row['BusinessDivision'];
                        ?>
                        <option selected="selected" value="<?=@utf8_encode(trim($row['BusinessDivision']))?>"><?=@$row['BusinessDivision']?></option>
                        <?php
                     }
                   ?>
                  </select>
                </div>
                 </div>
               <!-- Department -->
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>
      </div>
      
      <div class="panel panel-bordered col-xxl-4 col-lg-5" style="height:106px;max-width: 33.5%;margin-left: -55px;">
         <div class="panel panel-bordered" style="height:106px;width: 114%;">
          <!-- style="margin-left: -100px;" -->
            <div class="panel-body">
              <div class="row"> 
                 <div class="form-group form-material col-md-3 col-sm-12" style="margin-top: 22px;margin-left: -1%;padding-left: 1px;">
                      <label class="form-control-label" for="department" style="margin-top: -10px">Department</label>
                        <select id="FiltrtDep" name="department[]" class="departmentList MulSel mark" multiple="multiple">
                  <?php
                  $sql ="SELECT DepartmentName FROM  ".$costcentrtbl."  GROUP BY DepartmentName ORDER BY DepartmentName ASC";
                  $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                  while($row = sqlsrv_fetch_array($res)){ 
                    $FiltrDepArr[]=$row['DepartmentName'];
                        ?>
                        <option selected="selected" value="<?=@utf8_encode(trim($row['DepartmentName']))?>"><?=@$row['DepartmentName']?></option>
                        <?php
                     }
                   ?>
                  </select>
                  </div>
                <?php
                    if($_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                      ?>
                  <div class="form-group form-material col-md-3 col-sm-12" style="margin-top: 22px;margin-left: 1%;padding-left: 1px;">
                      <label class="form-control-label" for="zmLocation">Division/Crop</label>
                      <select id="division" name="division[]" class="MulSel divisionSelect" multiple="multiple">
                  <?php
                  $ImpldFltrBnsnDvsnArr = implode("','", $FltrBnsnDvsnArr);
                  $sql ="SELECT Division FROM  ".$costcentrtbl." WHERE BusinessDivision IN('".$ImpldFltrBnsnDvsnArr."') GROUP BY Division ORDER BY Division ASC";
                  $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                  while($row = sqlsrv_fetch_array($res)){ 
                        ?>
                            <option selected="selected" value="<?=@utf8_encode(trim($row['Division']))?>"><?=@$row['Division']?></option>
                          <?php
                     }
                   ?>

                  </select>
                  </div>
                  <?php } ?>
                          <?php
                        if($_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3 col-sm-12" style="margin-top: 3px;margin-left: 1%;padding-left: 1px;">
                      <label class="form-control-label" for="rbmLocation">Region/Project<br>/Process</label>
                     <select id="region" name="region[]" class="MulSel regionSelect" multiple="multiple">
                      <?php
                      $sql ="SELECT Region FROM  ".$costcentrtbl." GROUP BY Region ORDER BY Region ASC";
                      $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                          while($row = sqlsrv_fetch_array($res)){ 
                        ?>
                          <option selected="selected" value="<?=@utf8_encode(trim($row['Region']))?>"><?=@$row['Region']?></option>
                        <?php
                     }
                   ?>

                  </select> 
                    </div>
                  <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                       <div class="form-group form-material col-md-3 col-sm-12" style="margin-top: 22px;margin-left: -2%;">
                        <label class="form-control-label" for="tmLocation">Terriotry</label>
                        <select id="terriotry" name="terriotry[]" class="MulSel terriotrySelect" multiple="multiple">
                        <?php
                        $sql ="SELECT Territory FROM  ".$costcentrtbl." GROUP BY Territory ORDER BY Territory ASC";
                        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                        while($row = sqlsrv_fetch_array($res)){ 
                        ?>
                        <option selected="selected" value="<?=@utf8_encode(trim($row['Territory']))?>"><?=@$row['Territory']?></option>
                      <?php
                     }
                   ?>
                  </select>
                      </div>
                    <?php } ?>
                  <!-- Product division -->

              </div>
            </div>
          </div>
      </div>
         
  <div class="col-xxl-4 col-lg-4 col-sm-12" style="margin-left: 88px;max-width: 21%;">
            <div class="panel panel-bordered" style="height:106px;width: 90%;margin-left: -16%">
            <div class="panel-body">
              <div class="row"> 
                 
            <div class="form-group form-material col-md-4 col-sm-12" style="padding-left: 0px;margin-left: 4px;margin-top: 2px;">
                        <label class="form-control-label" for="expgroup">Expense Group</label>
                       <select id="expgroup" name="expgroup[]" class="MulSel expgroupSelect" multiple="multiple">
                          <?php
                          $FilerExpnsGrpArr = array();
                          $sql = "SELECT CostElementGroup FROM ".$costelemtbl." GROUP BY CostElementGroup ORDER BY CostElementGroup ASC";
                          $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                          while($row = sqlsrv_fetch_array($res)){ 
                            $FilerExpnsGrpArr[]=$row['CostElementGroup'];
                                ?>
                                <option selected="selected" value="<?=@utf8_encode(trim($row['CostElementGroup']))?>"><?=@$row['CostElementGroup']?></option>
                                <?php
                             }
                           ?>
                          </select>
                      </div>
                       <div class="form-group form-material col-md-4 col-sm-12" style="padding-left: 0px;margin-left: 44px;margin-top: 2px;">
                        <label class="form-control-label" for="costElement" style="">Cost Element</label>
                          <select id="costElement" name="costElement[]" class="MulSel costElementSelect" multiple="multiple">

                  
                  <?php
                  $sql ="SELECT CostElementName FROM ".$costelemtbl." GROUP BY CostElementName ORDER BY CostElementName ASC";
                  //echo $sql;exit;
                  $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));  while($row = sqlsrv_fetch_array($res)){ 
                      $cename = $row['CostElementName'];
                      $sql1 = "SELECT CostElement FROM ".$costelemtbl." WHERE CostElementName='".$cename."'";
                      // echo $sql1;exit;
                      $costelemmarray=array();
                      $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                          while($row1= sqlsrv_fetch_array($res1)){ 
                            $costelemmarray[] = utf8_encode(trim($row1['CostElement']));
                          }   
                          // p($costele_namemarray,'e');
                          $costelems = implode("','", $costelemmarray);
                          ?>
                      <option selected="selected" value="<?=@$costelems?>"><?=@$cename?></option>
                      <?php
                      }
                  ?>
                  </select>
                      </div>
                    </div>
          </div>
        </div>
      </div>

<div class="col-xxl-4 col-lg-5 Plan" style="max-width: 22%;margin-left: -92px;"> 
         <div class="panel panel-bordered" style="height:106px;">
            <div class="panel-body" style="">
              <div class="row"> 
                <div class="col-md-8">
                  <div class="form-group form-material col-md-6 col-sm-6">
                      <center><label class="form-control-label" for="activity">Plan</label></center>
                          <center><input type="checkbox" class="ChangeStatus" id="Planhs" checked="checked" name="" style="width: 19px;height: 19px;"></center>
                    </div>
                  
                  <div class="form-group form-material col-md-6 col-sm-6">
                      <center><label class="form-control-label" for="activity">Actual</label></center>
                      <center><input type="checkbox" class="ChangeStatus" id="Actualhs" checked="checked" name="" style="width: 19px;height: 19px;"></center>
                      
                    </div>
                    
                  <div class="form-group form-material col-md-6 col-sm-12" style="float: left;">
                        <label class="form-control-label" for="subactivity">Variance</label><br>
                      <center><input type="checkbox" class="ChangeStatus" id="Varhs" checked="checked" name="" style="width: 19px;height: 19px;"></center>
                        
                      </div>
                    
                      <div class="form-group form-material col-md-6 col-sm-12">
                        <label class="form-control-label" for="subactivity">Variance%</label><br>
                      <center><input type="checkbox" class="ChangeStatus" id="Varphs" checked="checked" name="" style="width: 19px;height: 19px;"></center>
                        
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group form-material col-md-2 col-sm-12" >
                        <!-- style="bottom: 10px;width: 66px;" -->
                        <button type="submit" class="btn btn-success btn-sm submitbtn" >APPLY</button>
                        <button type="reset" class="btn btn-default btn-rs fresetbtn" >RESET</button>
                       
                      </div>               
                    </div>
                      <input type="hidden" class="getCReport" name="required" id="getCReport" value="All">
              </div>
            </div>
            </div>
          </div>
        

 
   
    </form>     
   
        </div>

      </div>
    </div>

  </div>
  
<!-- <script type="text/javascript">
  $(document).ready(function($) {
    $('#filter').click(function(e){
alert("hi");
    $("#myDIV").toggle();
    $(this).toggleClass('h_and_s')
});
  });
</script> -->