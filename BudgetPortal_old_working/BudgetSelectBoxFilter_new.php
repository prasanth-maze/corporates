<?php
include '../auto_load.php';
// SelectBox Onchange Function Values
    //get cost element group
    if($_POST["Action"]=='getCostElementgroup'){
        //p($_POST,'e');
        $PDvsn = implode("','", $_POST['PDvsn']);
        $Dept = implode("','", $_POST['Dept']);
        $Dvsn = implode("','", $_POST['Dvsn']);
        $Rgn = implode("','", $_POST['Rgn']);
        $terr = implode("','", $_POST['terr']);
       
        $ReturnVal = array();
        
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$PDvsn."') AND DepartmentName IN ('".$Dept."') AND Division IN ('".$Dvsn."') AND Region IN ('".$Rgn."') AND Territory IN ('".$terr."')  GROUP BY CostElementGroup ORDER BY CostElementGroup ASC";
         //echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        $CostElemCodeArr = array();
        while($row = sqlsrv_fetch_array($res)){ 
            $cename = trim($row['CostElementGroup']);
            $sql1 = "SELECT CostElement FROM ".$costcentrelmtbl." WHERE CostElementGroup='".$cename."'";
            //echo $sql1;exit;
            $costelemmarray=array();
            $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
          /*  if(!$res1){
                echo $sql1;exit;
            }*/
            while($row1= sqlsrv_fetch_array($res1)){ 
                $costelemmarray[] = trim($row1['CostElement']);
            }   
            $costelems = implode("','", $costelemmarray);
            $ReturnVal[]=array(utf8_encode($row['CostElementGroup']));
        }        
        echo json_encode($ReturnVal);
    }
	// Cost Elems Name and Code
	if($_POST["Action"]=='getCostElement'){

        $PDvsn = implode("','", $_POST['PDvsn']);
        $Dept = implode("','", $_POST['Dept']);
        $Dvsn = implode("','", $_POST['Dvsn']);
        $Rgn = implode("','", $_POST['Rgn']);
        $terr = implode("','", $_POST['terr']);
  		$exgp = implode("','", $_POST['ElemGroup']);
		$ReturnVal = array();
		
        $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$PDvsn."') AND DepartmentName IN ('".$Dept."') AND Division IN ('".$Dvsn."') AND Region IN ('".$Rgn."') AND Territory IN ('".$terr."') AND CostElementGroup IN ('".$exgp."')  GROUP BY CostElementName ORDER BY CostElementName ASC";

         //echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        $CostElemCodeArr = array();
        while($row = sqlsrv_fetch_array($res)){ 
        	$cename = trim($row['CostElementName']);
            /*$sql1 = "SELECT CostElement FROM ".$costcentrelmtbl." WHERE TRIM(CostElementName)='".$cename."'";
            
        	$costelemmarray=array();
            $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
         
            while($row1= sqlsrv_fetch_array($res1)){ 
            	$costelemmarray[] = trim($row1['CostElement']);
            }   */
            //$costelems = implode("','", $costelemmarray);
            $ReturnVal[]=array("CeName"=>trim(utf8_encode($row['CostElementName'])),"CeCode"=>@$costelems);
        }        
        echo json_encode($ReturnVal);
	}

    if($_POST["Action"]=="getDepartment"){

            $Pdvsn = $_POST['Pdvsn'];
            $ReturnVal = array();
            $ImpldFltrBnsnPdvsnArr = implode("','", $Pdvsn);
            $sql ="SELECT DepartmentName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN('".$ImpldFltrBnsnPdvsnArr."') GROUP BY DepartmentName ";
            //echo $sql;exit;
              $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){ 
                $ReturnVal[]=utf8_encode(trim($row['DepartmentName']));
            }
            echo json_encode($ReturnVal);
    }
	// Division Name   
  if($_POST["Action"]=="getDivision"){
        $Pdvsn = $_POST['Pdvsn'];
        $Dept = $_POST['Dept'];
		$ReturnVal = array();
		$ImpldFltrBnsnPdvsnArr = implode("','", $Pdvsn);
        $ImpldFltrDeptArr = implode("','", $Dept);
        $sql ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN('".$ImpldFltrBnsnPdvsnArr."') AND DepartmentName IN ('".$ImpldFltrDeptArr."') GROUP BY Division ORDER BY Division ASC";
        //echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
        	$ReturnVal[]=utf8_encode(trim($row['Division']));
        }
        echo json_encode($ReturnVal);
	}
	// Region Name 
  if($_POST["Action"]=="getRegion"){
  		$PDvsn = $_POST['PDvsn'];
        $Dept = $_POST['Dept'];
        $Dvsn = $_POST['Dvsn'];
		$ReturnVal = array();
		$ImpldFltrPDvsnArr = implode("','", $PDvsn);
        $ImpldFltrDeptArr = implode("','", $Dept);
        $ImpldFltrDvsnArr = implode("','", $Dvsn);
        $sql ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN('".$ImpldFltrPDvsnArr."') AND DepartmentName IN ('".$ImpldFltrDeptArr."') AND Division IN('".$ImpldFltrDvsnArr."') GROUP BY Region ORDER BY Region ASC";
        
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
        	$ReturnVal[]=$row['Region'];
        }
        echo json_encode($ReturnVal);
	}
	// Territory Name 
  if($_POST['Action']=="getTerritory"){
  		$PDvsn = $_POST['PDvsn'];
        $Dept = $_POST['Dept'];
        $Dvsn = $_POST['Dvsn'];
        $Rgn = $_POST['Rgn'];
        $ReturnVal = array();
        $ImpldFltrPDvsnArr = implode("','", $PDvsn);
        $ImpldFltrDeptArr = implode("','", $Dept);
        $ImpldFltrDvsnArr = implode("','", $Dvsn);
        $ImpldFltrRgnArr = implode("','", $Rgn);
        $sql ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN('".$ImpldFltrPDvsnArr."') AND DepartmentName IN ('".$ImpldFltrDeptArr."') AND Division IN('".$ImpldFltrDvsnArr."') AND Region IN('".$ImpldFltrRgnArr."') GROUP BY Territory ";

        //echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
        	$ReturnVal[]=$row['Territory'];
        }
        echo json_encode($ReturnVal);
	}
?>