<?php

include '../auto_load.php';
//p($_POST,'e');
$from = date("Ymd",strtotime("01-".$_POST['from']));
$to = date("Ymd",strtotime("01-".$_POST['to']));

$_POST['pdivision'] = str_replace(",","COMMAOPERATOR",$_POST['pdivision'],$i);
$_POST['department'] = str_replace(",","COMMAOPERATOR",$_POST['department'],$i);
$_POST['division'] = str_replace(",","COMMAOPERATOR",$_POST['division'],$i);
$_POST['region'] = str_replace(",","COMMAOPERATOR",$_POST['region'],$i);
$_POST['expgroup'] = str_replace(",","COMMAOPERATOR",$_POST['expgroup'],$i);
$_POST['costElement'] = str_replace(",","COMMAOPERATOR",$_POST['costElement'],$j);

$PDvsn = @implode(",", $_POST['pdivision']);
$Dept = @implode(",", $_POST['department']);
$Dvsn = @implode(",", $_POST['division']);
$Rgn = @implode(",", $_POST['region']);
$terr = @implode(",", $_POST['terriotry']);
$Ceg = @implode(",", $_POST['expgroup']);
$celm = @implode(",", $_POST['costElement']);

if(isset($_POST['datafor'])){
        $datafor=$_POST['datafor'];
  }else{
        $datafor='table';
  }

$ReturnVal = array();

$psql = "EXEC GetBudgetReviewData @action='".$_POST['Action']."',@from='".$from."',@to='".$to."',@bdiv='".$PDvsn."',@dept='".$Dept."',@div='".$Dvsn."',@reg='".$Rgn."',@terr='".$terr."',@ceg='".$Ceg."',@celm='".$celm."',@dataFor='".$datafor."' ";
//echo $psql;exit;
/*if($datafor=='chart'){
        echo $psql;exit;
    }*/
    $stmt = sqlsrv_prepare($conn, $psql);
    sqlsrv_execute($stmt);
   
   if($_POST['Action']=='EGwisebudget'){
     while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 

        $ReturnVal['BRE@Nmonths'][] = $prow['MONTHNAME'].' '.$prow['YEAR']."<span style='display:none'>".$prow['MONTH'].'-'.$prow['YEAR']."</span>";
     }
        sqlsrv_next_result($stmt);

         while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){  
            $loop = 'yes';
             $temparr =array();
              $cols =  array_keys($prow);
             //p($cols,'e');
              $firstcol = $cols[0];
              $bfor = $prow[$firstcol];
              //p($prow,'e');
              unset($prow[$firstcol]);
              unset($cols[0]);
              foreach ($cols as $key => $clname) {
                //echo $clname.'<br>';
                $eclname = explode("_",$clname);
                $ckey = $eclname[1];
                if($prow[$clname]=='' || $prow[$clname]==NULL){
                  $prow[$clname] = 0;
                }
                $temparr[$ckey] = $prow[$clname];

                if($ckey=='VARIANCEP'){
                  $ReturnVal[$bfor][] = $temparr;
                    $temparr =array();
                }
              }
        }
        sqlsrv_next_result($stmt);    
        while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){  
            $loop = 'yes';
             $temparr =array();
              $cols =  array_keys($prow);
             // p($cols,'e');
              foreach ($cols as $key => $clname) {
                 $eclname = explode("_",$clname);
                  $ckey = $eclname[1];
                  $temparr[$ckey] = $prow[$clname];
                if($ckey=='VARIANCEP'){
                  $ReturnVal['BRE@RowTot'][] = $temparr;
                    $temparr =array();
                }
                
              }
               
              //p($temparr,'e');
        }
  }else if($_POST['Action']=='CEwisebudget'){
    if($datafor=='table'){
       while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
           $cols =  array_keys($prow);         
           $ceg = $prow['CostElementGroup'];
           $celm = $prow['CostElementName'];
           
            unset($prow['CostElementGroup']);
            unset($prow['CostElementName']);         
            unset($cols[0]);
            unset($cols[1]); 

           foreach ($cols as $key => $clname) {
              $eclname = explode("_",$clname);
              $ckey = @$eclname[1];
              if($prow[$clname]=='' || $prow[$clname]==NULL){
                    $prow[$clname] = 0;
                  }
              $temparr[$ckey] = $prow[$clname];
              if($ckey=='VARIANCEP'){
                 $ReturnVal[$ceg][$celm][] = $temparr;
                 $temparr =array();
              }
           }        
       }      
     }else{
        while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
           $cols =  array_keys($prow);         
           $celm = $prow['CostElementName'].'<span class="lname" style="display:none">'.$prow['CostElementName'].'</span>';
            unset($prow['CostElementName']);         
            unset($cols[0]);

           foreach ($cols as $key => $clname) {
              $eclname = explode("_",$clname);
              $ckey = @$eclname[1];
              if($prow[$clname]=='' || $prow[$clname]==NULL){
                    $prow[$clname] = 0;
                  }
              $temparr[$ckey] = $prow[$clname];
           }        
           $ReturnVal[$celm] = $temparr;
       }     
     }
     //p($ReturnVal,'e');
  }else if($_POST['Action']=='BDwisebudget'){
      if($datafor=='table'){
         while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
             $temparr =array();
             $cols =  array_keys($prow);         
             $ceg = $prow['CostElementGroup'];
             $celm = $prow['CostElementName'];
             $bdiv = $prow['BusinessDivision'];
             
              unset($prow['CostElementGroup']);
              unset($prow['CostElementName']);         
              unset($prow['BusinessDivision']);   
              unset($cols[0]);
              unset($cols[1]); 
              unset($cols[2]); 

             foreach ($cols as $key => $clname) {
                $eclname = explode("_",$clname);
                $ckey = @$eclname[1];
                if($prow[$clname]=='' || $prow[$clname]==NULL){
                      $prow[$clname] = 0;
                    }
                $temparr[$ckey] = $prow[$clname];
                if($ckey=='VARIANCEP'){
                      $ReturnVal[$ceg][$celm][$bdiv][] = $temparr;   
                   
                   $temparr =array();
                }
             }        
         }      
     }else{
          while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
                 $cols =  array_keys($prow);         
                 $bdiv = $prow['BusinessDivision'];
          
                  unset($prow['BusinessDivision']);   
                  unset($cols[0]);

                 foreach ($cols as $key => $clname) {
                    $eclname = explode("_",$clname);
                    $ckey = @$eclname[1];
                    if($prow[$clname]=='' || $prow[$clname]==NULL){
                          $prow[$clname] = 0;
                        }
                    $temparr[$ckey] = $prow[$clname];
                 } 
                  $ReturnVal[$bdiv] = $temparr;   
              } 
       }
  }else if($_POST['Action']=='DEPTwisebudget'){
    if($datafor=='table'){
     while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
           $cols =  array_keys($prow);         
           $ceg = $prow['CostElementGroup'];
           $celm = $prow['CostElementName'];
           $bdiv = $prow['BusinessDivision'];
           $dept = $prow['DepartmentName'];
           
            unset($prow['CostElementGroup']);
            unset($prow['CostElementName']);         
            unset($prow['DepartmentName']);   
            unset($cols[0]);
            unset($cols[1]); 
            unset($cols[2]); 
            unset($cols[3]); 

           foreach ($cols as $key => $clname) {
              $eclname = explode("_",$clname);
              $ckey = @$eclname[1];
              if($prow[$clname]=='' || $prow[$clname]==NULL){
                    $prow[$clname] = 0;
                  }
              $temparr[$ckey] = $prow[$clname];
              if($ckey=='VARIANCEP'){
                 $ReturnVal[$ceg][$celm][$bdiv][$dept][] = $temparr;
                 $temparr =array();
              }
           }        
       }     
     }else{
         while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
           $cols =  array_keys($prow);                  
           $dept = $prow['DepartmentName'];
             
            unset($prow['DepartmentName']);   
            unset($cols[0]);
        

           foreach ($cols as $key => $clname) {
              $eclname = explode("_",$clname);
              $ckey = @$eclname[1];
              if($prow[$clname]=='' || $prow[$clname]==NULL){
                    $prow[$clname] = 0;
                  }
              $temparr[$ckey] = $prow[$clname];
           }        
            $ReturnVal[$dept] = $temparr;
       }     
     } 
     //p($ReturnVal,'e');
  }else if($_POST['Action']=='Divwisebudget'){
      if($datafor=='table'){
         while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
             $temparr =array();
             $cols =  array_keys($prow);         
             $ceg = $prow['CostElementGroup'];
             $celm = $prow['CostElementName'];
             $bdiv = $prow['BusinessDivision'];
             $dept = $prow['DepartmentName'];
             $div = $prow['Division'];
             
              unset($prow['CostElementGroup']);
              unset($prow['CostElementName']);         
              unset($prow['DepartmentName']);   
              unset($prow['Division']);   
              unset($cols[0]);
              unset($cols[1]); 
              unset($cols[2]); 
              unset($cols[3]); 
              unset($cols[4]); 

             foreach ($cols as $key => $clname) {
                $eclname = explode("_",$clname);
                $ckey = @$eclname[1];
                if($prow[$clname]=='' || $prow[$clname]==NULL){
                      $prow[$clname] = 0;
                    }
                $temparr[$ckey] = $prow[$clname];
                if($ckey=='VARIANCEP'){
                   $ReturnVal[$ceg][$celm][$bdiv][$dept][$div][] = $temparr;
                   $temparr =array();
                }
             }        
         }      
    }else{
      while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
               $temparr =array();
               $cols =  array_keys($prow);         
               $div = $prow['Division']; 
                unset($prow['Division']);   
                unset($cols[0]);

               foreach ($cols as $key => $clname) {
                  $eclname = explode("_",$clname);
                  $ckey = @$eclname[1];
                  if($prow[$clname]=='' || $prow[$clname]==NULL){
                        $prow[$clname] = 0;
                      }
                  $temparr[$ckey] = $prow[$clname];
                  
               }        
                  $ReturnVal[$div] = $temparr;
           }      
    }
  }else if($_POST['Action']=='Regwisebudget'){
    if($datafor=='table'){
       while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
           $cols =  array_keys($prow);         
           $ceg = $prow['CostElementGroup'];
           $celm = $prow['CostElementName'];
           $bdiv = $prow['BusinessDivision'];
           $dept = $prow['DepartmentName'];
           $div = $prow['Division'];
           $reg = $prow['Region'];
           
            unset($prow['CostElementGroup']);
            unset($prow['CostElementName']);         
            unset($prow['DepartmentName']);   
            unset($prow['Division']);   
            unset($prow['Region']);   
            unset($cols[0]);
            unset($cols[1]); 
            unset($cols[2]); 
            unset($cols[3]); 
            unset($cols[4]); 
            unset($cols[5]);

           foreach ($cols as $key => $clname) {
              $eclname = explode("_",$clname);
              $ckey = @$eclname[1];
              if($prow[$clname]=='' || $prow[$clname]==NULL){
                    $prow[$clname] = 0;
                  }
              $temparr[$ckey] = $prow[$clname];
              if($ckey=='VARIANCEP'){
                 $ReturnVal[$ceg][$celm][$bdiv][$dept][$div][$reg][] = $temparr;
                 $temparr =array();
              }
           }        
       }      
      }else{
            while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
                 $temparr =array();
                 $cols =  array_keys($prow);         
                 $reg = $prow['Region'];
                 unset($prow['Region']);   
                 unset($cols[0]);

                 foreach ($cols as $key => $clname) {
                    $eclname = explode("_",$clname);
                    $ckey = @$eclname[1];
                    if($prow[$clname]=='' || $prow[$clname]==NULL){
                          $prow[$clname] = 0;
                        }
                    $temparr[$ckey] = $prow[$clname];
                 }        
                  $ReturnVal[$reg] = $temparr;
        }  
      }
     //p($ReturnVal,'e');
  }else if($_POST['Action']=='Terrwisebudget'){
    if($datafor=='table'){
       while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
           $temparr =array();
           $cols =  array_keys($prow);         
           $ceg = $prow['CostElementGroup'];
           $celm = $prow['CostElementName'];
           $bdiv = $prow['BusinessDivision'];
           $dept = $prow['DepartmentName'];
           $div = $prow['Division'];
           $reg = $prow['Region'];
           $terr = $prow['Territory'];
           
            unset($prow['CostElementGroup']);
            unset($prow['CostElementName']);         
            unset($prow['DepartmentName']);   
            unset($prow['Division']);   
            unset($prow['Region']);   
            unset($prow['Territory']);   
            unset($cols[0]);
            unset($cols[1]); 
            unset($cols[2]); 
            unset($cols[3]); 
            unset($cols[4]); 
            unset($cols[5]);
            unset($cols[6]);

           foreach ($cols as $key => $clname) {
              $eclname = explode("_",$clname);
              $ckey = @$eclname[1];
              if($prow[$clname]=='' || $prow[$clname]==NULL){
                    $prow[$clname] = 0;
                  }
              $temparr[$ckey] = $prow[$clname];
              if($ckey=='VARIANCEP'){
                 $ReturnVal[$ceg][$celm][$bdiv][$dept][$div][$reg][$terr][] = $temparr;
                 $temparr =array();
              }
           }     
          }   
       }else{
            while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ 
               $temparr =array();
               $cols =  array_keys($prow);         
               $terr = $prow['Territory'];
                unset($prow['Territory']);   
                unset($cols[0]);
               foreach ($cols as $key => $clname) {
                  $eclname = explode("_",$clname);
                  $ckey = @$eclname[1];
                  if($prow[$clname]=='' || $prow[$clname]==NULL){
                        $prow[$clname] = 0;
                      }
                  $temparr[$ckey] = $prow[$clname];
               }     
                 $ReturnVal[$terr] = $temparr;
            }
       }    
     //p($ReturnVal,'e');
  }

    
    //p($ReturnVal,'e');

    echo json_encode($ReturnVal);
     
?>