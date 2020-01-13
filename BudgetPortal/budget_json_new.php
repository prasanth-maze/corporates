 <?php
  include '../auto_load.php';
  include 'ReviewFunc.php';
  $return_array = [];

  if(isset($_POST['Action'])){
 //   p($_POST,'e');
    $from = "01-".$_POST['from'];
    $to = "01-".$_POST['to'];
    $month_range = getMonths($from,$to);
    $_POST['month_range'] = $month_range;
  // element group wise budget
  if($_POST['Action']=='EGwisebudget') {
    //p($_POST,'e');
     $ceGroupWisebudget =  CGroupWise($_POST);   
     $return_array =$ceGroupWisebudget;
  }
  // cost element wise budget
  if($_POST['Action'] == "CEwisebudget"){
     $ceWisebudget =  CElemWise($_POST);   
     $return_array =   $ceWisebudget;
  }
      // busins divsn wise budget
  if($_POST['Action'] == "BDwisebudget"){
	  
     $bdWisebudget =  BussDivWise($_POST);   
     $return_array =   $bdWisebudget;
  }
  //DEPARTMENT WISE BUDGET
  if($_POST['Action'] == "DEPTwisebudget"){
     $bdWisebudget =  DEPTwisebudget($_POST);   
     $return_array =   $bdWisebudget;
  }

  // Division wise budget
  if($_POST['Action'] == "Divwisebudget"){
      $divWisebudget =  DivisionWise($_POST);   
      $return_array =   $divWisebudget;
  }
  // Region wise budget
  if($_POST['Action'] == "Regwisebudget"){
     $rgWisebudget =  RegionWise($_POST);   
     $return_array =   $rgWisebudget;
  }

  // Territory wise budget
  if($_POST['Action'] == "Terrwisebudget"){
    $TerWisebudget =  TerritoryWise($_POST);   
    $return_array =   $TerWisebudget;  
  }

  echo json_encode($return_array);
}else{
 echo json_encode(array('msg'=>'Action parameter missing')); 
}
?>