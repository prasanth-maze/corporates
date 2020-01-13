<?php
include '../auto_load.php';
//p($_POST,'e');
$PDvsn = implode(",", @$_POST['PDvsn']);
$Dept = @implode(",", $_POST['Dept']);
$Dvsn = @implode(",", $_POST['Dvsn']);
$Rgn = @implode(",", $_POST['Rgn']);
$terr = @implode(",", $_POST['terr']);
$Ceg = @implode(",", $_POST['ElemGroup']);
//echo $PDvsn;exit;
$ReturnVal = array();
$psql = "EXEC BudgetFilters @action='".$_POST['Action']."',@bdiv='".$PDvsn."',@dept='".$Dept."',@div='".$Dvsn."',@reg='".$Rgn."',@terr='".$terr."',@ceg='".$Ceg."'";
//echo $psql;exit;
    $stmt = sqlsrv_prepare($conn, $psql);
    sqlsrv_execute($stmt);
   
    for($i=0;$i<10;$i++){
        $loop = 'no';
        while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){   
          
             $loop = 'yes';
                $res = array_keys($prow);
                $fkey = $res[0];
                $ReturnVal[$fkey][] = trim(utf8_encode($prow[$fkey]));
         }
        

        if($loop=='yes'){
            sqlsrv_next_result($stmt);
        }else{
            break;
        }
    }
    
      
    // p($ReturnVal,'e');
    echo json_encode($ReturnVal);
?>