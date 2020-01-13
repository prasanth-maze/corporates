  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
    role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
        data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
        data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
       <div class="brand-logo">
                <img src="../global/photos/logo.png" alt="logo" style="height:48px !important" >
              </div>
      <!-- <a class="navbar-brand navbar-brand-center" href="index.html">
       
        <span class="navbar-brand-text hidden-xs-down"> Remark</span>
      </a> -->
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
            <a class="nav-link" href="EventDashboard.php" role="button">Event</a>
          </li>
          <li class="nav-item hidden-float">
            <a class="nav-link" role="button">Login Activity</a>
          </li>
          <li class="nav-item hidden-float">
            <a class="nav-link" role="button">Expense</a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->

        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">          
          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
              data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="../global/portraits/5.jpg" alt="...">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
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
  <div class="site-menubar site-menubar-light" style="height:15.25rem;background-color: #bceacf !important">
    <div class="site-menubar-body">
      
    <form class="form filter-form">
       <div class="row" style="margin-top:-21px !important;">
       <div class="col-xxl-4 col-lg-3">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered" style="height:106px !important;">
            <div class="panel-body">
              <div class="row">
                 <label class="form-control-label">Periods</label>
               <div class="input-daterange" data-plugin="datepicker" data-date-format="dd-mm-yyyy">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                      <input type="text" class="form-control form-control-sm" name="fromdate" autocomplete="off" value="<?=@date("d-m-Y",strtotime("-1 day"))?>" />
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control form-control-sm" name="todate" autocomplete="off" value="<?=@date("d-m-Y",strtotime("-1 day"))?>"/>
                    </div>
                  </div>
              <!--  -->
              
            </div>
          </div>
          <!-- End Example Panel With Heading -->
        </div>
      </div>
<!--    <div class="col-xxl-4 col-lg-9">
          <div class="panel panel-bordered">
            <div class="panel-body">
              <div class="row"> 
               <div class="form-group form-material col-md-2">
                <label class="form-control-label">Product Division</label>
                <div class="radio-custom radio-success" style="margin-bottom:0px !important;margin-top: 0px !important;">
                      <input type="radio" class="pdivision" id="inputRadiosUnchecked" name="pdivision" value="ras">
                      <label for="inputRadiosUnchecked">Cotton</label>
                  </div>
                      <div class="radio-custom radio-danger" style="margin-bottom:0px !important;margin-top: 0px !important;">
                  <input type="radio" class="pdivision" id="inputRadiosChecked" name="pdivision" value="fcm" >
                  <label for="inputRadiosChecked">Field Crop</label>
                </div>
                 </div>
                 <?php
                        if($_SESSION['Dcode']=='ZM'){
                       ?>
                  <div class="form-group form-material col-md-2">
                      <label class="form-control-label" for="zmLocation">Division</label>
                      <select class="form-control form-control-sm zmLocSelect" name="zmLocation" id="zmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                  <?php
                        if($_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM'){
                       ?>
                  <div class="form-group form-material col-md-2">
                      <label class="form-control-label" for="rbmLocation">Region</label>
                      <select class="form-control form-control-sm rbmLocSelect LocSelect" data-Dcode="RBM" name="rbmLocation" id="rbmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM'){
                       ?>
                       <div class="form-group form-material col-md-2">
                        <label class="form-control-label" for="tmLocation">Terriotry</label>
                        <select class="form-control form-control-sm tmLocSelect LocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation">
                         
                        </select>
                      </div>
                    <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='PO' || $_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM'  || $_SESSION['Dcode']=='ZM' ){
                       ?>
                      <div class="form-group form-material col-md-2">
                        <label class="form-control-label" for="poLocation">PO/Village</label>
                        <select class="form-control form-control-sm poLocSelect LocSelect" data-Dcode="PO" name="polocation" id="poLocation">
                         
                        </select>
                      </div>
                       <?php } ?>
                      <div class="form-group form-material col-md-2">
                        <label class="form-control-label" for="activity">Activity</label>
                       <select class="form-control form-control-sm activitySelect" name="activity" id="activity" >
                           
                         </select>
                      </div>
                      <div class="form-group form-material col-md-2">
                        <label class="form-control-label" for="subactivity">Sub-Activity</label>
                       <select class="form-control form-control-sm subactivitySelect" name="subactivity" id="subactivity" >
                           
                         </select>
                      </div>
                      <div class="form-group form-material col-md-2">
                        <label class="form-control-label" for="activity">&nbsp;</label>
                       <button type="submit" class="btn btn-success btn-sm">Apply</button>
                      </div>
               </div> 
            </div>
          </div>
        </div> -->
        <div class="col-xxl-4 col-lg-4">
            <div class="panel panel-bordered" style="height:106px !important;">
            <div class="panel-body">
              <div class="row"> 
                 <div class="form-group form-material col-md-4">
                <label class="form-control-label">Product Division</label>
                <div class="radio-custom radio-success" style="margin-bottom:0px !important;margin-top: 0px !important;">
                      <input type="radio" class="pdivision" id="inputRadiosUnchecked" name="pdivision" value="ras">
                      <label for="inputRadiosUnchecked">Cotton</label>
                  </div>
                      <div class="radio-custom radio-danger" style="margin-bottom:0px !important;margin-top: 0px !important;">
                  <input type="radio" class="pdivision pdivisionfcm"  id="inputRadiosChecked" name="pdivision" value="fcm" checked >
                  <label for="inputRadiosChecked" >Field Crop</label>
                </div>
                 </div>
            <div class="form-group form-material col-md-4">
                        <label class="form-control-label" for="product">Crop</label>
                           <select class="form-control form-control-sm productSelect" name="product" id="product" >
                           
                         </select>
                      </div>
                       <div class="form-group form-material col-md-4">
                        <label class="form-control-label" for="hybrids">Hybrids</label>
                           <select class="form-control form-control-sm hybridsSelect" name="hybrid" id="hybrids" >
                           
                         </select>
                      </div>
                    </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4 col-lg-5">
         <div class="panel panel-bordered" style="height:106px !important;">
            <div class="panel-body">
              <div class="row"> 
                <?php
                        if($_SESSION['Dcode']=='ZM'){
                       ?>
                  <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="zmLocation">Division</label>
                      <select class="form-control form-control-sm zmLocSelect" name="zmLocation" id="zmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                          <?php
                        if($_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM'){
                       ?>
                  <div class="form-group form-material col-md-3">
                      <label class="form-control-label" for="rbmLocation">Region</label>
                      <select class="form-control form-control-sm rbmLocSelect LocSelect" data-Dcode="RBM" name="rbmLocation" id="rbmLocation"> 
                      </select>
                    </div>
                  <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM' || $_SESSION['Dcode']=='ZM'){
                       ?>
                       <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="tmLocation">Terriotry</label>
                        <select class="form-control form-control-sm tmLocSelect LocSelect" data-Dcode="TM" name="tmlocation" id="tmLocation">
                         
                        </select>
                      </div>
                    <?php } ?>
                    <?php
                        if($_SESSION['Dcode']=='PO' || $_SESSION['Dcode']=='TM' || $_SESSION['Dcode']=='RBM'  || $_SESSION['Dcode']=='ZM' ){
                       ?>
                      <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="poLocation">PO/Village</label>
                        <select class="form-control form-control-sm poLocSelect LocSelect" data-Dcode="PO" name="polocation" id="poLocation">
                         
                        </select>
                      </div>
                       <?php } ?>
              </div>
            </div>
          </div>
      </div>
         <div class="col-xxl-4 col-lg-6">
          <!-- Example Panel With Heading -->
          <div class="panel panel-bordered" style="height:106px !important;margin-top: -18px !important;">
            <div class="panel-body">
              <div class="row">
              <div class="form-group form-material col-md-3">
                <label class="form-control-label">Type</label>
                <select class="form-control atype" name="atype" >
                    <option value="All">All</option>
                    <option value="Financial">Financial</option>
                    <option value="Non-Financial">Non-Financial</option>
                </select>
              </div> 
               <div class="form-group form-material col-md-4">
                        <label class="form-control-label" for="activity">Activity</label>
                       <select class="form-control form-control-sm activitySelect" name="activity"  >
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
                      <div class="form-group form-material col-md-4">
                        <label class="form-control-label" for="subactivity">Sub-Activity</label>
                       <select class="form-control form-control-sm subactivitySelect" name="subactivity" id="subactivity" >
                           
                         </select>
                      </div>
                                 
            </div>

          </div>
          <!-- End Example Panel With Heading -->
        </div>
      </div>
       <div class="form-group form-material col-md-3">
          <div class="form-group form-material col-md-3">
                        <label class="form-control-label" for="activity">&nbsp;</label>
                       <button type="submit" class="btn btn-success btn-sm">Apply</button>
                      </div> 
       </div>
    </div>
    </form>     
        </div>

      </div>
    </div>

  </div>