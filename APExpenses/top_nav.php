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
    margin-top: 0%;
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

</style>

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
    role="navigation" style="margin-top: -18px;padding-left: 6px;">

    <div id="mySidenav_sc" class="sidenav" style="font-family: sans-serif;font-size:18px;">
     <a href="../logout.php" class="closebtn1 fa fa-sign-out" style="color:#0f56dd;">&nbsp;&nbsp;Logout</a>
  <a href="javascript:void(0)" class="closebtn fa fa-th" onclick="closeNav()"></a>
  <ul style="padding-left: 1%;margin-left:  -6%;margin-top: 15%;">
        <a style="font-weight:bold;">Enterprise Apps</a>
  </ul>
  <ul class="nav navbar-nav">
    <li><a href='EventDashboard.php' class="fa fa-area-chart" style="color: blue;"><span style="color: #424242;">&nbsp;&nbsp;A & P  Portal</span></a></li>
    <li><a href="../BudgetPortal/Review.php" class="fa fa-inr" style="color: red;"><span style="color: #424242;">&nbsp;&nbsp;Financial Dashboard</span></a></li>
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
        <li id="menu-reports" class="<?=@($cpage=='advancedashboard')?'active':''?>"><a href="advancedashboard.php"><i class="fa fa-inbox fa-fw" aria-hidden="true" ></i><span>Advance Request</span></a></li>
        <li id="menu-reports" class="<?=@($cpage=='approverdashboard')?'active':''?>"><a href="approverdashboard.php"><i class="fa fa-laptop fa-fw" aria-hidden="true" ></i><span>Advance Approve</span></a></li>
        <li id="menu-reports" class="<?=@($cpage=='financedashboard')?'active':''?>"><a href="financedashboard.php"><i class="fa fa-money fa-fw" aria-hidden="true" ></i><span>Advance Payment Approve</span></a></li>
        <li id="menu-reports" class="<?=@($cpage=='expensesclaimdashboard')?'active':''?>"><a href="expensesclaimdashboard.php"><i class="fa fa-money fa-fw" aria-hidden="true" ></i><span>Expenses Claim</span></a></li>
        <li id="menu-reports" class="<?=@($cpage=='claimapproverdashboard')?'active':''?>"><a href="claimapproverdashboard.php"><i class="fa fa-dashboard fa-fw" aria-hidden="true" ></i><span>Expenses Approve</span></a></li>
        <li id="menu-reports" class="<?=@($cpage=='claimfinancedashboard')?'active':''?>"><a href="claimfinancedashboard.php"><i class="fa fa-dashboard fa-fw" aria-hidden="true" ></i><span>Expenses Verification</span></a></li>
        

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
      <!-- <button type="button" id="menu-id" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"f
        data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
        data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
       <div class="brand-logo" >
                <img src="../global/photos/logo.png" alt="logo" style="height: 45px !important;
    padding-left: 16px;
    margin-top: -2px;" >
              </div>
    
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
        data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button> -->
      <div class="brand-logo">
	  <a href="../pages/landing.php">
               <img src="../global/photos/logo.png" alt="logo" style="height: 45px !important;padding-left: 16px;margin-top: -2px;">
			   </a>
    <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
        data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    <button type="button" class="navbar-toggler collapsed hamburger hamburger-close" data-target="#site-navbar-collapse"
        data-toggle="collapse" style="float: left;">
        <i class="hamburger-bar" aria-hidden="true"></i>
      </button>
      </div>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">     
		 <li class="nav-item hidden-float">
            <a class="nav-link" href="" role="button">A & P Expenses</a>
          </li>
			<?php if($cpage=='advancedashboard'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="advancedashboard.php" role="button">Advance Request</a>
          </li> 
			<?php }elseif($cpage=='advance_request'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="advance_request.php" role="button">Advance Request</a>
          </li> 
			<?php }elseif($cpage=='view_advance_request'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="view_advance_request.php" role="button">View Advance Request</a>
          </li> 
			<?php }elseif($cpage=='approverdashboard'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="approverdashboard.php" role="button">Advance Payment Approve</a>
          </li> 
			<?php }elseif($cpage=='advance_payment_approval_view'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="advance_payment_approval_view.php" role="button">Pending Advance Requests</a>
          </li> 
			<?php }elseif($cpage=='advance_finance_approve_view'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="advance_finance_approve_view.php" role="button">Pending Advance Requests</a>
          </li> 
			<?php }elseif($cpage=='financedashboard'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="financedashboard.php" role="button">Finance Dashboard</a>
          </li> 
			<?php }elseif($cpage=='advance_payment_view'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="advance_payment_view.php" role="button">Advance Payment</a>
          </li> 
			<?php }elseif($cpage=='request_adv_approval'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="request_adv_approval.php" role="button">Advance Approve Request</a>
          </li> 
			<?php }elseif($cpage=='request_adv_payment'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="request_adv_payment.php" role="button">Advance Payment</a>
          </li> 
			<?php }elseif($cpage=='request_adv_finance_approval'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="#" role="button">Approve Payment</a>
          </li> 
			<?php }elseif($cpage=='expensesclaimdashboard'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="expensesclaimdashboard.php" role="button">Expenses Claim</a>
          </li> 
			<?php }elseif($cpage=='expense_settlement'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="expense_settlement.php" role="button">Expenses Claim</a>
          </li> 
			<?php }elseif($cpage=='view_expense_settlement'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="view_expense_settlement.php" role="button">List of Claim</a>
          </li> 
			<?php }elseif($cpage=='claimapproverdashboard'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="#" role="button">Expenses Approve</a>
          </li> 
			<?php }elseif($cpage=='view_claim_approval'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="view_claim_approval.php" role="button">Expenses Approve</a>
          </li> 
			<?php }elseif($cpage=='claim_approval'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="#" role="button">Expenses Approve</a>
          </li> 
			<?php }elseif($cpage=='claimfinancedashboard'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="claimfinancedashboard.php" role="button">Expenses Verification</a>
          </li> 
			<?php }elseif($cpage=='view_claim_finance_verify'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="view_claim_finance_verify.php" role="button">Expenses Verification</a>
          </li> 
			<?php }elseif($cpage=='claim_finance_approval'){ ?>
          <li class="nav-item hidden-float active">
            <a class="nav-link" href="#" role="button">Expenses Verification</a>
          </li> 
			<?php } ?>
        
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
 
  <div id="myDIV" class="site-menubar site-menubar-light" style="height:100%;display: block;background-color: #bceacf;box-shadow:1px 0px 0px #bceacf">
    <div class="site-menubar-body">
      <?php if($cpage=='EventDashboard' || $cpage=='PDTrailDashBoard'){?>
    <form class="form filter-form">
       <div class="row top-menu" style="/*margin-right: -50px*/;/*margin-left:-5px*/;">
       <div class="col-xxl-4 col-lg-3 col-sm-12" style="max-width: 24%">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered" style="height:106px;padding-top: 1px;margin: 0 -10px;">
            <div class="panel-body" style="margin-top: -26px">
               <div class="row">
                 <?php  if($cpage=='EventDashboard'){ ?>
                 <label class="form-control-label" style="padding-left: 2px;">Periods</label>
                     <!--  <select class="form-control form-control-sm pdivision" name="pdivision" style="margin-left: 37%;margin-top: -11%;">
                                          <option value="#">Yesterday</option>
                                                <option value="#">Last Week</option>
                                                <option value="#">Last Month</option>
                                                <option value="#">Last 3 Months</option>
                                                <option value="#">Last 6 Months</option>
                                                <option value="#">Custom Range</option>
                                                                                
                  </select> -->
               <div class="input-daterange" data-plugin="datepicker" data-date-format="dd-mm-yyyy">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control form-control-sm" name="fromdate" autocomplete="off" value="<?=@date("d-m-Y",strtotime("-1 day")) ?>" />
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control form-control-sm" name="todate" autocomplete="off" value="<?=@date("d-m-Y",strtotime("-1 day")) ?>" />
                    </div>
                  </div>
                  <?php }?>
                  <?php  if($cpage=='PDTrailDashBoard'){ ?>
                 <label class="form-control-label" style="padding-left: 2px;">Periods</label>
                
              <select class="form-control form-control-sm season" name="season" style="margin-left: 31%;margin-top: -6%;">
                <option value="19">2019</option>
                <
              </select>
            
                  <?php } ?>

              <!--  -->
              <div style="padding-top: 12px;">
                <label class="form-control-label">Product Division</label>
                <div class="col-lg-11" style="float: right;">
                  <?php if($cpage!='PDTrailDashBoard') {?>
              <select class="form-control form-control-sm pdivision" name="pdivision" style="margin-left: 39%;margin-top: -20%;">
                  <?php
                    foreach ($pdivopt as $key => $value) {
                        ?>
                            <option value="<?=@$key?>"><?=@$value?></option>
                          <?php
                      }
                   ?>
                                                        
                  </select>
                <?php } else{
                    
                  ?>
                 <select class="form-control form-control-sm pdivision" name="pdivision" style="margin-left: 39%;margin-top: -20%;">
                     <?php
                    foreach ($pdivopt as $key => $value) {
                        ?>
                            <option value="<?=@$key?>"><?=@$value?></option>
                          <?php
                      }
                   ?>
                  </select>
                  <?php   } ?>
                </div>
                 </div>
              
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>
      </div>
        <div class="col-xxl-4 col-lg-4 col-sm-12" style="margin-left: 0px;max-width: 21%;">
            <div class="panel panel-bordered" style="height:106px;margin-right: 26px;">
            <div class="panel-body">
              <div class="row"> 
                 
            <div class="form-group form-material col-md-4 col-sm-12">
                        <label class="form-control-label" for="product">Crop</label>
                           <select class="form-control form-control-sm productSelect" name="product" id="product" style="width:105px;" >
                           
                         </select>
                      </div>
                       <div class="form-group form-material col-md-4 col-sm-12" style="padding-left: 2px;margin-left: 60px;">
                        <label class="form-control-label" for="hybrids" style="">Hybrids</label>
                           <select class="form-control form-control-sm hybridsSelect" name="hybrid" id="hybrids" style="width: 80px;" >
                           
                         </select>
                      </div>
                    </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4 col-lg-5" style="max-width: 25%;margin-left: -55px;">
         <div class="panel panel-bordered" style="height:106px;left: 23px">
            <div class="panel-body" style="margin-left: 0px;">
              <div class="row"> 
                <?php
                        if($_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3 col-sm-12">
                      <label class="form-control-label" for="zmLocation">Division</label>
                      <select class="form-control form-control-sm zmLocSelect" name="zmLocation" id="zmLocation" data-Dcode="ZM" > 
                      </select>
                    </div>
                  <?php } ?>
                          <?php
                        if($_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3 col-sm-12">
                      <label class="form-control-label" for="rbmLocation">Region</label>
                      <select class="form-control form-control-sm rbmLocSelect" data-Dcode="RBM" name="rbmLocation" id="rbmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                       <div class="form-group form-material col-md-3 col-sm-12">
                        <label class="form-control-label" for="tmLocation">Terriotry</label>
                        <select class="form-control form-control-sm tmLocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation">
                         
                        </select>
                      </div>
                    <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='PO' || $_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM'  || $_SESSION['Dcode']=='ZM' ||  $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM' ){
                       ?>
                      <div class="form-group form-material col-md-3 col-sm-12">
                        <label class="form-control-label" for="poLocation">PO/Village</label>
                        <select class="form-control form-control-sm poLocSelect" data-Dcode="PO" name="polocation" id="poLocation">
                         
                        </select>
                      </div>
                       <?php } ?>
              </div>
            </div>
          </div>
      </div>
         <div class="col-xxl-4 col-lg-4 col-sm-12">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered-clm" style="height:106px;/*margin-top: 0px !important*/;width: 100%;/*margin-left: -28px*/;margin-bottom: 16px;/*padding-top: 18px*/;">
            <div class="panel-body" style="padding-right: 0;">
              <div class="row">
            <?php  if($cpage=='EventDashboard'){ ?>
               <div class="form-group form-material col-md-3 col-sm-12">
                        <label class="form-control-label" for="activity">Activity Type</label>
                        <select class="form-control atype" name="atype" >
                          <option value="All">All</option>
                          <option value="Financial">Financial</option>
                          <option value="Non-Financial">Non-Financial</option>
                      </select>
                      </div>
                      <div class="form-group form-material col-md-3 col-sm-12">
                        <label class="form-control-label" for="activity">Select Activity</label>
                       <select class="form-control form-control-sm activitySelect" name="activity">
                          
                          <option value="All">All</option>
                           <?php
                           $sql =" SELECT * FROM  ".$atypemaster."   ORDER BY ACTIVITYTYPE ";
      
                       $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                       $row_count = sqlsrv_num_rows($res);

                      if($row_count>0){
                        while($row = sqlsrv_fetch_array($res)){   
                            ?>
                            <option value="<?=@$row['ACTIVITYTYPE']?>"><?=@$row['ACTIVITYTYPE']?></option>
                            <?php 
                        }
                      }
                           ?>
                         </select>
                      </div>
                      <div class="form-group form-material col-md-3 col-sm-12">
                        <label class="form-control-label" for="subactivity">Sub-Activity</label>
                       <select class="form-control form-control-sm subactivitySelect" name="subactivity" id="subactivity">
                         </select>
                      </div>
                       <div class="form-group form-material col-md-3 col-sm-6">
                        <label class="form-control-label" for="activity"></label>
                       <button type="submit" class="btn btn-success btn-sm submitbtn" style="bottom: 10px;width: 66px;">APPLY</button><br>
                       <button type="reset" class="btn btn-default btn-rs fresetbtn">RESET</button>
                      </div>
                      <input type="hidden" class="getCReport" name="required" id="getCReport" value="All">                                  
                    <?php } else if($cpage=='PDTrailDashBoard'){ ?>

                      <div class="form-group form-material col-md-3 col-sm-12">
                        <label class="form-control-label" for="activity">Activity</label>
                       <select class="form-control form-control-sm activitySelect" name="activity">
                          <option value="All">All</option>
                           <option value="PD-1">Product Development 1</option>
                           <option value="PD-2">Product Development 2</option>
                           <option value="PCD">Pre-Commercial Demo</option>
                           <option value="CD">Commercial Demo</option>
                           <option value="AGR">Agronomy</option>
                         </select>
                      </div>
                   
                       <div class="form-group form-material col-md-3 col-sm-6">
                        <label class="form-control-label" for="activity"></label>
                       <button type="submit" class="btn btn-success btn-sm submitbtn" style="bottom: 10px;width: 66px;">APPLY</button><br>
                       <button type="reset" class="btn btn-default btn-rs fresetbtn">RESET</button>
                      </div>
                      <input type="hidden" class="getCReport" name="required" id="getCReport" value="All"> 
                    <?php  } ?>
            </div>
          </div>
                    <!-- End Example Panel With Heading -->
        </div>
      </div>
    </div>
    </form>     
    <?php

  }else if($cpage=='LoginActivityDashboard'){
    
    ?>
    <form class="form filter-form">
       <div class="row top-menu" style="margin-right: -50px;margin-left:-5px;">
       <div class="col-xxl-4 col-lg-3 col-sm-12" style="max-width: 24%">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered" style="height:106px;padding-top: 1px;">
            <div class="panel-body" style="margin-top: -26px">
               <div class="row">
                 <label class="form-control-label" style="padding-left: 2px;">Periods</label>
                 <div class="input-daterange" data-plugin="datepicker" data-date-format="dd-mm-yyyy">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm" name="fromdate" autocomplete="off" value="<?=@date("d-m-Y",strtotime("2019-08-01")) ?>" />
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control form-control-sm" name="todate" autocomplete="off" value="<?=@date("d-m-Y",strtotime("2019-08-01")) ?>" />
                      </div>
                    </div>
              <!--  -->

              <div style="padding-top: 12px;">
                <label class="form-control-label">Product Division</label>
       
                 <div class="col-lg-11" style="float: right;">
                    <select class="form-control form-control-sm pdivision" name="pdivision" style="margin-left: 39%;margin-top: -20%;"*>
                        <?php
                          foreach ($pdivopt as $key => $value) {
                              ?>
                                <option value="<?=@$key?>"><?=@$value?></option>
                              <?php
                          }
                         ?>
                                                              
                        </select>
                </div>
                 </div>
              
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>
      </div>
        <div class="col-xxl-4 col-lg-4 col-sm-12" style="margin-left: 0px;max-width: 0%;">
            <div class="panel panel-bordered" style="height:106px;margin-right: 26px;">
            <div class="panel-body">
              <div class="row"> 
                 
            <!-- <div class="form-group form-material col-md-4">
                        <label class="form-control-label" for="product">Crop</label>
                           <select class="form-control form-control-sm productSelect" name="product" id="product" style="width:105px;" >
                           
                         </select>
                      </div>
                       <div class="form-group form-material col-md-4" style="padding-left: 2px;margin-left: 60px;">
                        <label class="form-control-label" for="hybrids" style="">Hybrids</label>
                           <select class="form-control form-control-sm hybridsSelect" name="hybrid" id="hybrids" style="width: 80px;" >
                           
                         </select>
                      </div> -->
                    </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4 col-lg-5" style="max-width: 25%;margin-left: -29px;">
         <div class="panel panel-bordered-clm" style="height:106px;left: 20px">
            <div class="panel-body" style="margin-left: 0px;">
              <div class="row"> 
                <?php
                        if($_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="zmLocation">Division</label>
                      <select class="form-control form-control-sm zmLocSelect" name="zmLocation" id="zmLocation" data-Dcode="ZM" > 
                      </select>
                    </div>
                  <?php } ?>
                          <?php
                        if($_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="rbmLocation">Region</label>
                      <select class="form-control form-control-sm rbmLocSelect" data-Dcode="RBM" name="rbmLocation" id="rbmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                        <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="tmLocation">Terriotry</label>
                      <select class="form-control form-control-sm tmLocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation"> 
                      </select>
                    </div>
                      <!--  <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="tmLocation">Terriotry</label>
                        <select class="form-control form-control-sm tmLocSelect LocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation">
                        </select>
                      </div> -->
                    <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='PO' || $_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM'  || $_SESSION['Dcode']=='ZM' ||  $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM' ){
                       ?>
                      <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="poLocation">PO/Village</label>
                        <select class="form-control form-control-sm poLocSelect" data-Dcode="PO" name="polocation" id="poLocation">
                        </select>
                      </div>
                       <?php } ?>
              </div>
            </div>
          </div>
      </div>
          <div class="col-xxl-4 col-lg-6 col-sm-12">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered-clm1" style="height:106px;background:transparent !important;margin-top: -12px;width: 21%;padding-top: 18px;margin-left: -28px;margin-bottom: 18px;box-shadow: none !important;">
            <div class="panel-body" style="
            padding-right: 0;">
              <div class="row">    
                <div class="form-group form-material col-md-3 col-sm-12">
                  <label class="form-control-label" for="activity"></label>
                 <button type="submit" class="btn btn-success btn-sm" style="bottom: 10px;width: 66px;">APPLY</button>
                 <button type="reset" class="btn btn-default btn-rs fresetbtn">RESET</button>
                </div>                                   
            </div>
          </div>
                    <!-- End Example Panel With Heading -->
        </div>
      </div>
    </div>
    </form>
    <?php }else if($cpage=='UMReport'){ ?>
             <form class="form filter-form">
       <div class="row top-menu" style="margin-right: -50px;margin-left:-5px;">
       <div class="col-xxl-4 col-lg-3 col-sm-12" style="max-width: 24%">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered" style="height:106px;padding-top: 1px;">
            <div class="panel-body" style="margin-top: -26px">
               <div class="row">
                   <div class="form-group form-material col-md-6">
                      <label class="form-control-label" >Product Division</label>
                      <select class="form-control form-control-sm pdivision" name="pdivision" > 
                        <?php
                          foreach ($pdivopt as $key => $value) {
                              ?>
                                <option value="<?=@$key?>"><?=@$value?></option>
                              <?php
                          }
                         ?>
                      </select>
                    </div>        
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>
      </div>
        <div class="col-xxl-4 col-lg-4 col-sm-12" style="margin-left: 0px;max-width: 0%;">
            <div class="panel panel-bordered" style="height:106px;margin-right: 26px;">
            <div class="panel-body">
              <div class="row"> 
                 
           
                    </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4 col-lg-5" style="max-width: 25%;margin-left: -29px;">
         <div class="panel panel-bordered-clm" style="height:106px;left: 23px">
            <div class="panel-body" style="margin-left: -10px;">
              <div class="row"> 
                <?php
                        if($_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="zmLocation">Division</label>
                      <select class="form-control form-control-sm zmLocSelect" name="zmLocation" id="zmLocation" data-Dcode="ZM" > 
                      </select>
                    </div>
                  <?php } ?>
                          <?php
                        if($_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                  <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="rbmLocation">Region</label>
                      <select class="form-control form-control-sm rbmLocSelect" data-Dcode="RBM" name="rbmLocation" id="rbmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM' || $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM'){
                       ?>
                        <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="tmLocation">Terriotry</label>
                      <select class="form-control form-control-sm tmLocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation"> 
                      </select>
                    </div>
                      <!--  <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="tmLocation">Terriotry</label>
                        <select class="form-control form-control-sm tmLocSelect LocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation">
                        </select>
                      </div> -->
                    <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='PO' || $_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM'  || $_SESSION['Dcode']=='ZM' ||  $_SESSION['Dcode']=='ADMIN' ||  $_SESSION['Dcode']=='GM' ){
                       ?>
                      <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="poLocation">PO/Village</label>
                        <select class="form-control form-control-sm poLocSelect" data-Dcode="PO" name="polocation" id="poLocation">
                        </select>
                      </div>
                       <?php } ?>
              </div>
            </div>
          </div>
      </div>
          <div class="col-xxl-4 col-lg-6 col-sm-12">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered-clm1" style="height:106px;background:transparent !important;margin-top: -12px;width: 21%;padding-top: 18px;margin-left: -28px;margin-bottom: 18px;box-shadow: none !important;">
            <div class="panel-body" style="
            padding-right: 0;">
              <div class="row">    
                <div class="form-group form-material col-md-3 col-sm-12">
                  <label class="form-control-label" for="activity"></label>
                 <button type="submit" class="btn btn-success btn-sm" style="bottom: 10px;width: 66px;">APPLY</button>
                 <button type="reset" class="btn btn-default btn-rs fresetbtn">RESET</button>
                </div>                                   
            </div>
          </div>
                    <!-- End Example Panel With Heading -->
        </div>
      </div>
    </div>
    </form>
    <?php } ?>
        </div>

      </div>
    </div>

  </div>
