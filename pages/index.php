<?php 
include '../auto_load.php';

?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from www.urbanui.com/calmui/template/demo/horizontal-default/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Feb 2019 09:32:04 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rasi Seeds (P) Ltd</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../global/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../global/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../global/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../global/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../global/photos/favicon.ico" />
  <style type="text/css">
    .hide_this{
      display: none;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2019  All rights reserved.</p>
          </div>
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="../global/photos/logo.png" alt="logo">
              </div>
              <h4>Corporate Portal</h4>
              <h6 class="font-weight-light">Sign in with your credentials</h6>
              <div class="progress progress-lg loginProgressdiv hide_this">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated loginProgress " role="progressbar" style="width: 0%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
              <form class="pt-3" id="loginform">

                   <div class="alert alert-danger hide_this noticlass" role="alert">
                  
                  </div>
                  <div class="alert alert-success hide_this noticlass" role="alert">
                    Success
                  </div>
                <div class="form-group">
                  <label for="emp_id">Employee Id</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="emp_id" class="form-control form-control-lg border-left-0" id="emp_id" placeholder="Employee Id">                    
                  </div>
                  <span class="errcls text-danger emp_iderr"></span>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg border-left-0" id="password" placeholder="Password">      
                  </div>
                   <span class="errcls text-danger passerr"></span>
                </div>
             <!--    <div class="form-group form-material">
                      <label class="form-control-label">Division</label>
                      <div>
                        <div class="radio-custom radio-default radio-inline">
                          <input type="radio" id="ras" name="company" value="ras">
                          <label for="ras" checked="checked">RAS</label>
                        </div>
                        <div class="radio-custom radio-default radio-inline">
                          <input type="radio" id="fcm" name="company" value="fcm" >
                          <label for="fcm">FCM</label>
                        </div>
                      </div>
                    </div> -->
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <div class="my-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../global/js/vendor.bundle.base.js"></script>
  <script src="../global/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../global/js/off-canvas.js"></script>
  <script src="../global/js/hoverable-collapse.js"></script>
  <script src="../global/js/template.js"></script>
  <script src="../global/js/settings.js"></script>
  <script src="../global/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script type="text/javascript">
    $(document).ready(function() {
      var loginProgress = $(".loginProgress");
      var loginProgressdiv = $(".loginProgressdiv");
        $("#loginform").submit(function(){
           
            var emp_id = $("#emp_id");
            var pass = $("#password");
            var status = true;
            $(".errcls").text('');
              if(emp_id.val()==''){
                $('.emp_iderr').text('Enter the employee id');
                status = false;
              }

              if(pass.val()==''){
                $('.passerr').text('Enter the password');
                status = false;
              }
              loginProgressdiv.show();
              loginProgress.css('width', 10);
              if(status){
                loginProgress.css('width', 30);
                   var data = $(this).serialize();
                    data +="&Action=Login";
                  $.ajax({
                    url: 'Ajax1.php',
                    type: 'POST',
                    dataType:'json',
                    data: data,
                    beforeSend:function(){
                        loginProgress.css('width', 50);
                    },
                    success:function(res){
                      loginProgress.css('width', 90);
                      $(".noticlass").hide();                      
                        if(res.status=='ok'){
                          loginProgress.css('width', 100);
                          loginProgressdiv.hide();
                          setTimeout(function(){
                            $(".alert-success").show();
                            window.location.href = 'landing.php';
                            },1000);
                            
                        }else{
                           loginProgress.css('width', 100);
                          loginProgressdiv.hide();
                            $(".alert-danger").text('Invalid Username or Password!').show();
                        }
                    }
                  });                  
              }

            
            return false;
        });
    });
  </script>
</body>


<!-- Mirrored from www.urbanui.com/calmui/template/demo/horizontal-default/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Feb 2019 09:32:04 GMT -->
</html>
