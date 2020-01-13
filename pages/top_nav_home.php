<?php
  $cpage = basename($_SERVER['SCRIPT_NAME'],'.php');
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
// Brand Colors
.fa-history {
 color: green !important;
}
.site-navbar-small .site-navbar
{
  height: 4.8rem !important;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


</style>


   
  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
    role="navigation"  style="padding-left: 6px;box-shadow: 10px 1.3px 0px #ccc;">
     
  <div id="mySidenav_sc" class="sidenav">
     <a href="index.php" class="closebtn1 fa fa-signout" style="color:#0f56dd;">&nbsp;&nbsp;logout</a>
  <a href="javascript:void(0)" class="closebtn fa fa-th" onclick="closeNav()"></a>
  <ul style="padding-left: 1%;margin-left: -6%;margin-top: 15%;">
        <a style="font-weight: bold;">Enterprise Apps</a>
  </ul>
  <ul class="nav navbar-nav">
    <li><a href="EventDashboard.php" class="fa fa-area-chart" style="color: blue"><span style="color:#424242;">&nbsp;&nbsp;A & P Portal</span></a></li>
	<?php
		if($_SESSION['finRights']==1){
	?>
    <li><a href="../BudgetPortal/Review.php" class="fa fa-inr" style="color:red;"><span style="color:#424242;">&nbsp;&nbsp;Financial Dashboard</span></a></li>
		<?php } ?>
    <!-- <li><a href="#events">EVENTS</a></li> -->
    <!-- <li><a href="#sch">SCHEDULE</a></li> -->
  </ul>
  <ul class="nav navbar-nav" style="margin-left: 10%;">
    <li><a href="../PDTrail/PDTrailDashBoard.php" class=" fa fa-cubes" style="color: green;"><span style="color:#424242;">&nbsp;&nbsp;PD Trials</span></a></li>
    <!-- <li><a href="#gallery">Settings</a></li> -->
    <!-- <li><a href="#spons">SPONSORS</a></li> -->
   <!--  <li><a href="#contact" class="fa fa fa-history">&nbsp;&nbsp;CONTACT US</a></li> -->
  </ul>
</div>
<div class="row">
<span onclick="openNav()" class="fa fa-th" style="font-size: 20px;
    float: left;
    padding-left: 41px;
    padding-top: 12px;
    padding-right: 26px;"></span><br><br><br>
</div>
   <div class="navbar-header">
     
        
          <div class="brand-logo">
		   
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
      <!-- <a class="navbar-brand navbar-brand-center" href="index.html">
       
        <span class="navbar-brand-text hidden-xs-down"> Remark</span>
      </a> -->
      
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">


        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">   
        <!-- <li class="nav-item hidden-float" id="filter">
            <a class="nav-link" href="javascript:void(0);"><img src="../global/photos/filter.png"></a>
          </li> -->
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
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
              <!-- <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
              <div class="dropdown-divider"> -->
              <a class="dropdown-item" href="logout.php" role="menuitem"><i class="closebtn1 fa fa-sign-out" aria-hidden="true"></i> Logout</a>
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
 </div>
</div>
