 <?php
  include '../auto_load.php';
  include 'ReviewFunc.php';
  $return_array = [];

  if(isset($_GET['Action'])){
 //   p($_GET,'e');
    $from = "01-".$_GET['from'];
    $to = "01-".$_GET['to'];
    $month_range = getMonths($from,$to);
    $dept = implode("','", $_POST['department']);

    $costcntrs =array();
      
      $sql = "SELECT CostCenterCode FROM ".$costcentrtbl." ";
      $pdivision = implode("','",$_POST['pdivision']);
      
      $cond = '';
      $addand = '';
      
      if(isset($_POST['pdivision'])){
        $pdivision = implode("','",$_POST['pdivision']);
        $cond .= " BusinessDivision IN('".$pdivision."')";
        $addand = " AND ";
      }

      if(isset($_POST['department'])){
        $DepartmentName = implode("','",$_POST['department']);
        $cond .= " ".$addand." DepartmentName IN('".$DepartmentName."')";
        $addand = " AND ";
      }

      if(isset($_POST['division'])){
        $division = implode("','",$_POST['division']);
        $cond .= " ".$addand." Division IN('".$division."')";
        $addand = " AND ";
      }
      if(isset($_POST['region'])){
        $region = implode("','",$_POST['region']);
        $cond .= " ".$addand." Region IN('".$region."')";
        $addand = " AND ";
      }

      if(isset($_POST['terriotry'])){
        $territory = implode("','",$_POST['terriotry']);
        $cond .= " ".$addand." Territory IN('".$territory."')";
        $addand = " AND ";
      }

      if($cond!='')
          $sql .=" WHERE ".$cond." ";
        }
        echo $sql;exit;
          $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
           $row_count = @sqlsrv_num_rows(@$res);
         if($row_count>0){
            while($row = sqlsrv_fetch_array($res)){ 
              $costcntrs[] = $row['CostCenterCode'];
            }

    $costcntrs = implode("','",$costcntrs);
    
   $filterdata['month_range'] = $month_range;
   $filterdata['dept'] = $dept;
   $filterdata['costcntrs'] = $costcntrs;


  // element group wise budget
  if($_POST['Action']=='EGwisebudget') {
    //p($_POST,'e');
     $ceGroupWisebudget =  CGroupWise($_POST,$filterdata);   
     $return_array =$ceGroupWisebudget;
  }
  // cost element wise budget
  if($_POST['Action'] == "CEwisebudget"){
     $ceWisebudget =  CElemWise($_POST,$filterdata);   
     $return_array =   $ceWisebudget;
  }
      // busins divsn wise budget
  if($_POST['Action'] == "BDwisebudget"){
     $bdWisebudget =  BussDivWise($_POST,$filterdata);   
     $return_array =   $bdWisebudget;
  }
  //DEPARTMENT WISE BUDGET
  if($_POST['Action'] == "DEPTwisebudget"){
     $bdWisebudget =  DEPTwisebudget($_POST,$filterdata);   
     $return_array =   $bdWisebudget;
  }

  // Division wise budget
  if($_POST['Action'] == "Divwisebudget"){
      $divWisebudget =  DivisionWise($_POST,$filterdata);   
      $return_array =   $divWisebudget;
  }
  // Region wise budget
  if($_POST['Action'] == "Regwisebudget"){
     $rgWisebudget =  RegionWise($_POST,$filterdata);   
     $return_array =   $rgWisebudget;
  }

  // Territory wise budget
  if($_POST['Action'] == "Terrwisebudget"){
    $TerWisebudget =  TerritoryWise($_POST,$filterdata);   
    $return_array =   $TerWisebudget;  
  }

  echo json_encode($return_array);
}
?>