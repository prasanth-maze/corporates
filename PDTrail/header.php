<?php
include '../auto_load.php';
//p($_SESSION);exit;

if(!isset($_SESSION['EmpID'])){
  header('Location:index.php');
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/material/topbar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2019 07:28:14 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap material admin template">
  <meta name="author" content="">

<title>Rasi Seeds (P) Ltd - PD Trials</title>

  <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../global/photos/favicon.ico" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../global/css/bootstrap.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/css/bootstrap-extend.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../assets/css/site.minfd53.css?v4.0.1">

  <!-- Skin tools (demo site only) -->
  <link rel="stylesheet" href="../global/css/skintools.minfd53.css?v4.0.1">
  <script src="../assets/js/Plugin/skintools.minfd53.js?v4.0.1"></script>

  <!-- Plugins -->
  <link rel="stylesheet" href="../global/vendor/animsition/animsition.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/asscrollable/asScrollable.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/switchery/switchery.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/intro-js/introjs.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/slidepanel/slidePanel.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/flag-icon-css/flag-icon.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/waves/waves.minfd53.css?v4.0.1">

  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="../global/vendor/chartist/chartist.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/jvectormap/jquery-jvectormap.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.minfd53.css?v4.0.1">

    <link rel="stylesheet" href="../global/vendor/datatables.net-bs4/dataTables.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.minfd53.css?v4.0.1">

  <!-- Page -->
  <link rel="stylesheet" href="../assets/examples/css/tables/datatable.minfd53.css?v4.0.1">

  <!-- Page -->
  <link rel="stylesheet" href="../assets/examples/css/dashboard/v1.minfd53.css?v4.0.1">

  <!-- Fonts -->
  <link rel="stylesheet" href="../global/fonts/material-design/material-design.minfd53.css?v4.0.1">
  <link rel="stylesheet" href="../global/fonts/brand-icons/brand-icons.minfd53.css?v4.0.1">

  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,700">
  <style type="text/css">
    .page{margin-top: 34px;}
  </style>

  <!--[if lt IE 9]>
    <script src="../global/vendor/html5shiv/html5shiv.min.js?v4.0.1"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="../global/vendor/media-match/media.match.min.js?v4.0.1"></script>
    <script src="../global/vendor/respond/respond.min.js?v4.0.1"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="../global/vendor/breakpoints/breakpoints.minfd53.js?v4.0.1"></script>
  <script>
    Breakpoints();
  </script>
</head>