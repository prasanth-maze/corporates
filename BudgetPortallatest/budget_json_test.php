<?php

include '../auto_load.php';

$from = date("Ymd",strtotime("01-".$_POST['from']));
$to = date("Ymd",strtotime("01-".$_POST['to']));

$PDvsn = implode(",", $_POST['pdivision']);
$Dept = implode(",", $_POST['department']);
$Dvsn = implode(",", $_POST['division']);
$Rgn = implode(",", $_POST['region']);
$terr = implode(",", $_POST['terriotry']);
$Ceg = implode(",", $_POST['expgroup']);
$celm = implode(",", $_POST['costElement']);


  $return_array = array();
  $months_array = array();
  $monthwisetot = array();

  $psql = "EXEC AutoCalculateBudget @action='".$_POST['Action']."',@from='".$from."',@to='".$to."',@bdiv='".$PDvsn."',@dept='".$Dept."',@div='".$Dvsn."',@reg='".$Rgn."',@terr='".$terr."',@ceg='".$Ceg."',@celm='".$celm."' ";
//Echo $psql;exit();
$stmt = sqlsrv_prepare($conn, $psql);
    sqlsrv_execute($stmt);

$psql1 = "EXEC GetBudgetReviewData @action='".$_POST['Action']."',@from='".$from."',@to='".$to."',@bdiv='".$PDvsn."',@dept='".$Dept."',@div='".$Dvsn."',@reg='".$Rgn."',@terr='".$terr."',@ceg='".$Ceg."',@celm='".$celm."' ";
        //echo $psql1;exit;
    $stmt1 = sqlsrv_prepare($conn, $psql1);
    sqlsrv_execute($stmt1);
   
   if($_POST['Action']=='EGwisebudget'){
   for($i=0;$i<10000;$i++){
     $loop = 'no';
        if($i==0){
                 while($prow = sqlsrv_fetch_array($stmt1)){   
                    $loop = 'yes';
                    $months_array[] = $prow['MONTHNAME'].' '.$prow['YEAR'];
                 }
        }else{

            while($prow = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){ 
          // p($prow,'e')  ;
                        $loop = 'yes';
                        $bfor = $prow['BudgetFor'];
                        $plan = $prow['BudgetPlan'];
                        $actual = $prow['BudgetActual'];
                        $var = $prow['Variance'];
                        $varp = $prow['VarianceP'];
                        $month = $prow['MONTH'];
                        $year = $prow['YEAR'];

                        $ReturnVal[$bfor][] = array('plan'=>$plan,'actual'=>$actual,'var'=>$var,'varp'=>$varp);
                        $monthwisetot[$year][$month]['plan'] = @$monthwisetot[$year][$month]['plan']+$plan;
                        $monthwisetot[$year][$month]['actual'] = @$monthwisetot[$year][$month]['actual']+$actual;
                        $monthwisetot[$year][$month]['var'] = @$monthwisetot[$year][$month]['var']+$var;
                        $monthwisetot[$year][$month]['varp'] = @$monthwisetot[$year][$month]['var']+$varp;

                     }
                 }
                 if($loop=='yes'){
                    sqlsrv_next_result($stmt);
                }else{
                    break;
                }
        }


         $ReturnVal['BRE@Nmonths'] = $months_array;
         foreach ($monthwisetot as $year => $mdata){
            foreach ($mdata as $month => $bdata) {
                //p($bdata,'e');
                 $ReturnVal['BRE@RowTot'][] = array('plan'=>$bdata['plan'],'actual'=>$bdata['actual'],'var'=>$bdata['var'],'varp'=>$bdata['varp']);
            }
    }
         

   }
    
    echo json_encode($ReturnVal);
     //p($ReturnVal,'e');
?>