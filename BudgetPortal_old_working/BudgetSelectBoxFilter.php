<?php
include '../auto_load.php';
// SelectBox Onchange Function Values
	// Cost Elems Name and Code
	if($_POST["Action"]=='getCostElement'){
  		$ElemGroup = $_POST['ElemGroup'];
		$ReturnVal = array();
		$ImpldFltrElemGroupArr = implode("','", $ElemGroup);
        $sql ="SELECT CostElementName FROM  ".$costelemtbl." WHERE CostElementGroup IN('".$ImpldFltrElemGroupArr."') GROUP BY CostElementName";
        // echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        $CostElemCodeArr = array();
        while($row = sqlsrv_fetch_array($res)){ 
        	$cename = $row['CostElementName'];
            $sql1 = "SELECT CostElement FROM ".$costelemtbl." WHERE CostElementName='".$cename."'";
        	$costelemmarray=array();
            $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
            while($row1= sqlsrv_fetch_array($res1)){ 
            	$costelemmarray[] = $row1['CostElement'];
            }   
            $costelems = implode("','", $costelemmarray);
            $ReturnVal[]=array("CeName"=>$row['CostElementName'],"CeCode"=>$costelems);
        }        
        echo json_encode($ReturnVal);
	}

    if($_POST["Action"]=="getDepartment"){

            $Pdvsn = $_POST['Pdvsn'];
            $ReturnVal = array();
            $ImpldFltrBnsnPdvsnArr = implode("','", $Pdvsn);
            $sql ="SELECT DepartmentName FROM  ".$costcentrtbl." WHERE BusinessDivision IN('".$ImpldFltrBnsnPdvsnArr."') GROUP BY DepartmentName ";
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
        $sql ="SELECT Division FROM  ".$costcentrtbl." WHERE BusinessDivision IN('".$ImpldFltrBnsnPdvsnArr."') AND DepartmentName IN ('".$ImpldFltrDeptArr."') GROUP BY Division ";
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
        $sql ="SELECT Region FROM  ".$costcentrtbl." WHERE BusinessDivision IN('".$ImpldFltrPDvsnArr."') AND DepartmentName IN ('".$ImpldFltrDeptArr."') AND Division IN('".$ImpldFltrDvsnArr."') GROUP BY Region ";
        
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
        $sql ="SELECT Territory FROM  ".$costcentrtbl." WHERE BusinessDivision IN('".$ImpldFltrPDvsnArr."') AND DepartmentName IN ('".$ImpldFltrDeptArr."') AND Division IN('".$ImpldFltrDvsnArr."') AND Region IN('".$ImpldFltrRgnArr."') GROUP BY Territory ";

        //echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
        	$ReturnVal[]=$row['Territory'];
        }
        echo json_encode($ReturnVal);
	}
?>