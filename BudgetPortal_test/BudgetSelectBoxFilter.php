<?php
include '../auto_load.php';
//p($_POST,'e');
$ReturnVal =array();
$PDvsn = @implode("','", @$_POST['PDvsn']);
$Dept = @implode("','", @$_POST['Dept']);
$Dvsn = @implode("','", @$_POST['Dvsn']);
$Rgn = @implode("','", @$_POST['Rgn']);
$terr = @implode("','", @$_POST['terr']);
$Ceg = @implode("','", @$_POST['ElemGroup']);
$bdivs = array();
$depts = array();
$divs = array();
$regs = array();
$terrs = array();
$cegs = array();
$celem = array();
$empid = isset($_POST['EmpID'])?$_POST['EmpID']:$_SESSION['EmpID'];
$action = $_POST['Action'];
$bdivact = '';
$deptact = '';
$divact = '';
$regact = '';
$terract = '';
if($action=='getBusinessdivision'){
    $sql ="SELECT BusinessDivision FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' GROUP BY BusinessDivision ORDER BY BusinessDivision ASC ";
	
    $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
      while($row = sqlsrv_fetch_array($res)){
            $cdata = trim(utf8_encode($row['BusinessDivision']));
            if($cdata=='ALL'){
                $bdivact='ALL';
                $Bsql ="SELECT BusinessDivision FROM  ".$costcentrelmtbl."  GROUP BY BusinessDivision ORDER BY BusinessDivision ASC ";
                $Bres = sqlsrv_query($conn,$Bsql,array(), array( "Scrollable" => 'static' ));
                     while($Brow = sqlsrv_fetch_array($Bres)){
                        $cdata = trim(utf8_encode($Brow['BusinessDivision']));
                         $bdivs[] = $cdata;
                    }
              }else{
                $bdivs[] = $cdata;
              }
    } 

    $impbdiv = implode("','", $bdivs);
    if($bdivact=='ALL'){
         $tempbdiv = $impbdiv;
         $tempbdiv .="','ALL";

         $dsql ="SELECT DepartmentName FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN('".$tempbdiv."')  GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
         
          $dres = sqlsrv_query($conn,$dsql,array(), array( "Scrollable" => 'static' ));
          while($drow = sqlsrv_fetch_array($dres)){
                $cdept = trim(utf8_encode($drow['DepartmentName']));
                if($cdept=='ALL'){
                    $deptact = 'ALL';
                        $dsql1 ="SELECT DepartmentName FROM  ".$costcentrelmtbl." WHERE  BusinessDivision IN('".$impbdiv."') GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
                          $dres1 = sqlsrv_query($conn,$dsql1,array(), array( "Scrollable" => 'static' ));
                         while($drow1 = sqlsrv_fetch_array($dres1)){ 
                             $cdept = trim(utf8_encode($drow1['DepartmentName']));
                              if(!in_array($cdept, $depts))
                                $depts[] = $cdept;
                         }
                }else{
                     if(!in_array($cdept, $depts))
                         $depts[] = $cdept;
                }
          }

    }else{
            foreach ($bdivs as $fbdiv) {
            $dsql ="SELECT DepartmentName FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision='".$fbdiv."' GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
			
             $dres = sqlsrv_query($conn,$dsql,array(), array( "Scrollable" => 'static' ));
              while($drow = sqlsrv_fetch_array($dres)){
                    $cdept = trim(utf8_encode($drow['DepartmentName']));
                    if($cdept=='ALL'){
                        $deptact = 'ALL';
                        $dsql1 ="SELECT DepartmentName FROM  ".$costcentrelmtbl." WHERE  BusinessDivision='".$fbdiv."' GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
                          $dres1 = sqlsrv_query($conn,$dsql1,array(), array( "Scrollable" => 'static' ));
                         while($drow1 = sqlsrv_fetch_array($dres1)){ 
                             $cdept = trim(utf8_encode($drow1['DepartmentName']));
                              if(!in_array($cdept, $depts))
                                $depts[] = $cdept;
                         }
                    }else{
                        if(!in_array($cdept, $depts))
                         $depts[] = $cdept;
                    }
                         
                }
        }
    }

    $impdept = implode("','", $depts);
    if($deptact=="ALL"){
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        

        $tempdept = $impdept;
        $tempdept .="','ALL";

        $sql ="SELECT Division FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') GROUP BY Division ORDER BY Division ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
            $cdata = trim(utf8_encode($row['Division']));
            if($cdata=='ALL'){
                 $divact ='ALL';
                $sql1 ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."')  GROUP BY Division ORDER BY Division ASC ";
                 $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                while($row1 = sqlsrv_fetch_array($res1)){ 
                         $cdata = trim(utf8_encode($row1['Division']));
                        if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                        }
            }else{
                if(!in_array($cdata, $divs))
                 $divs[] = $cdata;
                }
            }
    }else{
        foreach($depts as $fdept){
            $divsql ="SELECT Division FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$impbdiv."') AND DepartmentName='".$fdept."' GROUP BY Division ORDER BY Division ASC ";
            $divres = sqlsrv_query($conn,$divsql,array(), array( "Scrollable" => 'static' ));
            while($divrow = sqlsrv_fetch_array($divres)){ 
                $cdata = trim(utf8_encode($divrow['Division']));
                if($cdata=='ALL'){
                    $divact ='ALL';
                    $divsql1 ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."')  GROUP BY Division ORDER BY Division ASC ";
                    $divres1 = sqlsrv_query($conn,$divsql1,array(), array( "Scrollable" => 'static' ));
                    while($divrow1 = sqlsrv_fetch_array($divres1)){ 
                         $cdata = trim(utf8_encode($divrow1['Division']));
                        if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                        }

                }else{
                    if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                }
            }
        }
    }

    $impdiv = implode("','", $divs);

    if($divact=='ALL') {
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }

        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }

        $tempdiv = $impdiv;
         $tempdiv .="','ALL";


          $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') GROUP BY Region ORDER BY Region ASC ";

            $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                     $cdata = trim(utf8_encode($row['Region']));
                     if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }
                     }else{
                       if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                     }
                     
                }
        }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }

            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }

            foreach ($divs as $fdiv) {
                $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division='".$fdiv."' GROUP BY Region ORDER BY Region ASC ";
                $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                    $cdata = trim(utf8_encode($row['Region']));
                    if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                    }
                }
            }
        }

     $impreg = implode("','",$regs);

     if($regact=='ALL'){        
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }
        $tempdiv = $impdiv;
        if($divact=='ALL'){
            $tempdiv .="','ALL";
        }
        $tempreg = $impreg;
        $tempreg .="','ALL";
        $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') GROUP BY Territory ORDER BY Territory ASC ";
		
		//echo $sql;exit;
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['Territory']));
                    if($cdata=='ALL'){
                        $terract ='ALL';
                        $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Territory']));
                            if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                    }
            }
     }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }
            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }
            $tempdiv = $impdiv;
            if($divact=='ALL'){
                $tempdiv .="','ALL";
            }

            foreach ($regs as $freg) {
                $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region='".$freg."' GROUP BY Territory ORDER BY Territory ASC ";
                 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                    while($row = sqlsrv_fetch_array($res)){
                        $cdata = trim(utf8_encode($row['Territory']));
                            if($cdata=='ALL'){
                                $terract ='ALL';
                                $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                                $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                                while($row1 = sqlsrv_fetch_array($res1)){ 
                                     $cdata = trim(utf8_encode($row1['Territory']));
                                    if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                                    }

                            }else{
                                if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                            }
                    }
            }
        
     }

       $imptrr = implode("','",  $terrs);
                   
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') AND Territory IN('".$imptrr."') GROUP BY CostElementGroup ORDER BY CostElementGroup ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementGroup']));
                //$cdata = str_replace(",","COMMAOPERATOR",$cdata,$i);
                    $cegs[] = $cdata;
            }

            /*$tempceg = array_map(function($value) { return str_replace(',', 'COMMAOPERATOR', $value); }, $cegs);*/
            $tempceg = $cegs;
            $imcegs = implode("','", $tempceg);
            //$imcegs = str_replace("COMMAOPERATOR",",",$imcegs,$i);
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }

    $ReturnVal['BusinessDivision'] = $bdivs;
    $ReturnVal['DepartmentName'] = $depts;
    $ReturnVal['Division'] = $divs;
    $ReturnVal['Region'] = $regs;
    $ReturnVal['Territory'] = $terrs;
    $ReturnVal['CostElementGroup'] = $cegs;
    $ReturnVal['CostElementName'] = $celem;
}else if($action=='getDepartment'){
    $bdivs = $_POST['PDvsn'];
    $impbdiv = implode("','", $bdivs);
    $bdivact ='ALL';
    if($bdivact=='ALL'){
         $tempbdiv = $impbdiv;
         $tempbdiv .="','ALL";

         $dsql ="SELECT DepartmentName FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN('".$tempbdiv."')  GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
         
          $dres = sqlsrv_query($conn,$dsql,array(), array( "Scrollable" => 'static' ));
          while($drow = sqlsrv_fetch_array($dres)){
                $cdept = trim(utf8_encode($drow['DepartmentName']));
                if($cdept=='ALL'){
                    $deptact = 'ALL';
                        $dsql1 ="SELECT DepartmentName FROM  ".$costcentrelmtbl." WHERE  BusinessDivision IN('".$impbdiv."') GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
                          $dres1 = sqlsrv_query($conn,$dsql1,array(), array( "Scrollable" => 'static' ));
                         while($drow1 = sqlsrv_fetch_array($dres1)){ 
                             $cdept = trim(utf8_encode($drow1['DepartmentName']));
                              if(!in_array($cdept, $depts))
                                $depts[] = $cdept;
                         }
                }else{
                     if(!in_array($cdept, $depts))
                         $depts[] = $cdept;
                }
          }

    }else{
            foreach ($bdivs as $fbdiv) {
            $dsql ="SELECT DepartmentName FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision='".$fbdiv."' GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
        
             $dres = sqlsrv_query($conn,$dsql,array(), array( "Scrollable" => 'static' ));
              while($drow = sqlsrv_fetch_array($dres)){
                    $cdept = trim(utf8_encode($drow['DepartmentName']));
                    if($cdept=='ALL'){
                        $deptact = 'ALL';
                        $dsql1 ="SELECT DepartmentName FROM  ".$costcentrelmtbl." WHERE  BusinessDivision='".$fbdiv."' GROUP BY DepartmentName ORDER BY DepartmentName ASC ";
                          $dres1 = sqlsrv_query($conn,$dsql1,array(), array( "Scrollable" => 'static' ));
                         while($drow1 = sqlsrv_fetch_array($dres1)){ 
                             $cdept = trim(utf8_encode($drow1['DepartmentName']));
                              if(!in_array($cdept, $depts))
                                $depts[] = $cdept;
                         }
                    }else{
                        if(!in_array($cdept, $depts))
                         $depts[] = $cdept;
                    }
                         
                }
        }
    }

    $impdept = implode("','", $depts);
    if($deptact=="ALL"){
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        

        $tempdept = $impdept;
        $tempdept .="','ALL";

        $sql ="SELECT Division FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') GROUP BY Division ORDER BY Division ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
            $cdata = trim(utf8_encode($row['Division']));
            if($cdata=='ALL'){
                 $divact ='ALL';
                $sql1 ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."')  GROUP BY Division ORDER BY Division ASC ";
                 $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                while($row1 = sqlsrv_fetch_array($res1)){ 
                         $cdata = trim(utf8_encode($row1['Division']));
                        if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                        }
            }else{
                if(!in_array($cdata, $divs))
                 $divs[] = $cdata;
                }
            }
    }else{
        foreach($depts as $fdept){
            $divsql ="SELECT Division FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$impbdiv."') AND DepartmentName='".$fdept."' GROUP BY Division ORDER BY Division ASC ";
            $divres = sqlsrv_query($conn,$divsql,array(), array( "Scrollable" => 'static' ));
            while($divrow = sqlsrv_fetch_array($divres)){ 
                $cdata = trim(utf8_encode($divrow['Division']));
                if($cdata=='ALL'){
                    $divact ='ALL';
                    $divsql1 ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."')  GROUP BY Division ORDER BY Division ASC ";
                    $divres1 = sqlsrv_query($conn,$divsql1,array(), array( "Scrollable" => 'static' ));
                    while($divrow1 = sqlsrv_fetch_array($divres1)){ 
                         $cdata = trim(utf8_encode($divrow1['Division']));
                        if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                        }

                }else{
                    if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                }
            }
        }
    }

    $impdiv = implode("','", $divs);

    if($divact=='ALL') {
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }

        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }

        $tempdiv = $impdiv;
         $tempdiv .="','ALL";


          $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') GROUP BY Region ORDER BY Region ASC ";

            $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                     $cdata = trim(utf8_encode($row['Region']));
                     if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }
                     }else{
                       if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                     }
                     
                }
        }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }

            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }

            foreach ($divs as $fdiv) {
                $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division='".$fdiv."' GROUP BY Region ORDER BY Region ASC ";
                $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                    $cdata = trim(utf8_encode($row['Region']));
                    if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                    }
                }
            }
        }

     $impreg = implode("','",$regs);

     if($regact=='ALL'){        
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }
        $tempdiv = $impdiv;
        if($divact=='ALL'){
            $tempdiv .="','ALL";
        }
        $tempreg = $impreg;
        $tempreg .="','ALL";
        $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') GROUP BY Territory ORDER BY Territory ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['Territory']));
                    if($cdata=='ALL'){
                        $terract ='ALL';
                        $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Territory']));
                            if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                    }
            }
     }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }
            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }
            $tempdiv = $impdiv;
            if($divact=='ALL'){
                $tempdiv .="','ALL";
            }

            foreach ($regs as $freg) {
                $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region='".$freg."' GROUP BY Territory ORDER BY Territory ASC ";
                 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                    while($row = sqlsrv_fetch_array($res)){
                        $cdata = trim(utf8_encode($row['Territory']));
                            if($cdata=='ALL'){
                                $terract ='ALL';
                                $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                                $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                                while($row1 = sqlsrv_fetch_array($res1)){ 
                                     $cdata = trim(utf8_encode($row1['Territory']));
                                    if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                                    }

                            }else{
                                if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                            }
                    }
            }
        
     }

       $imptrr = implode("','",  $terrs);
                   
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') AND Territory IN('".$imptrr."') GROUP BY CostElementGroup ORDER BY CostElementGroup ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementGroup']));
                //$cdata = str_replace(",","COMMAOPERATOR",$cdata,$i);
                    $cegs[] = $cdata;
            }

            /*$tempceg = array_map(function($value) { return str_replace(',', 'COMMAOPERATOR', $value); }, $cegs);*/
            $tempceg = $cegs;
            $imcegs = implode("','", $tempceg);
            //$imcegs = str_replace("COMMAOPERATOR",",",$imcegs,$i);
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }

    $ReturnVal['DepartmentName'] = $depts;
    $ReturnVal['Division'] = $divs;
    $ReturnVal['Region'] = $regs;
    $ReturnVal['Territory'] = $terrs;
    $ReturnVal['CostElementGroup'] = $cegs;
    $ReturnVal['CostElementName'] = $celem;
}else if($action=='getDivision'){

    $bdivs = $_POST['PDvsn'];
    $impbdiv = implode("','", $bdivs);
    $bdivact ='ALL';
    $depts = $_POST['Dept'];
    $impdept = implode("','", $depts);
    $deptact ='ALL';

    if($deptact=="ALL"){
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        

        $tempdept = $impdept;
        $tempdept .="','ALL";

        $sql ="SELECT Division FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') GROUP BY Division ORDER BY Division ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        while($row = sqlsrv_fetch_array($res)){ 
            $cdata = trim(utf8_encode($row['Division']));
            if($cdata=='ALL'){
                 $divact ='ALL';
                $sql1 ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."')  GROUP BY Division ORDER BY Division ASC ";
                 $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                while($row1 = sqlsrv_fetch_array($res1)){ 
                         $cdata = trim(utf8_encode($row1['Division']));
                        if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                        }
            }else{
                if(!in_array($cdata, $divs))
                 $divs[] = $cdata;
                }
            }
    }else{
        foreach($depts as $fdept){
            $divsql ="SELECT Division FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$impbdiv."') AND DepartmentName='".$fdept."' GROUP BY Division ORDER BY Division ASC ";
            $divres = sqlsrv_query($conn,$divsql,array(), array( "Scrollable" => 'static' ));
            while($divrow = sqlsrv_fetch_array($divres)){ 
                $cdata = trim(utf8_encode($divrow['Division']));
                if($cdata=='ALL'){
                    $divact ='ALL';
                    $divsql1 ="SELECT Division FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."')  GROUP BY Division ORDER BY Division ASC ";
                    $divres1 = sqlsrv_query($conn,$divsql1,array(), array( "Scrollable" => 'static' ));
                    while($divrow1 = sqlsrv_fetch_array($divres1)){ 
                         $cdata = trim(utf8_encode($divrow1['Division']));
                        if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                        }

                }else{
                    if(!in_array($cdata, $divs))
                         $divs[] = $cdata;
                }
            }
        }
    }

    $impdiv = implode("','", $divs);

    if($divact=='ALL') {
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }

        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }

        $tempdiv = $impdiv;
         $tempdiv .="','ALL";


          $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') GROUP BY Region ORDER BY Region ASC ";

            $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                     $cdata = trim(utf8_encode($row['Region']));
                     if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }
                     }else{
                       if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                     }
                     
                }
        }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }

            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }

            foreach ($divs as $fdiv) {
                $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division='".$fdiv."' GROUP BY Region ORDER BY Region ASC ";
                $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                    $cdata = trim(utf8_encode($row['Region']));
                    if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                    }
                }
            }
        }

     $impreg = implode("','",$regs);

     if($regact=='ALL'){        
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }
        $tempdiv = $impdiv;
        if($divact=='ALL'){
            $tempdiv .="','ALL";
        }
        $tempreg = $impreg;
        $tempreg .="','ALL";
        $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') GROUP BY Territory ORDER BY Territory ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['Territory']));
                    if($cdata=='ALL'){
                        $terract ='ALL';
                        $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Territory']));
                            if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                    }
            }
     }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }
            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }
            $tempdiv = $impdiv;
            if($divact=='ALL'){
                $tempdiv .="','ALL";
            }

            foreach ($regs as $freg) {
                $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region='".$freg."' GROUP BY Territory ORDER BY Territory ASC ";
                 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                    while($row = sqlsrv_fetch_array($res)){
                        $cdata = trim(utf8_encode($row['Territory']));
                            if($cdata=='ALL'){
                                $terract ='ALL';
                                $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                                $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                                while($row1 = sqlsrv_fetch_array($res1)){ 
                                     $cdata = trim(utf8_encode($row1['Territory']));
                                    if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                                    }

                            }else{
                                if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                            }
                    }
            }
        
     }

       $imptrr = implode("','",  $terrs);
                   
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') AND Territory IN('".$imptrr."') GROUP BY CostElementGroup ORDER BY CostElementGroup ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementGroup']));
                //$cdata = str_replace(",","COMMAOPERATOR",$cdata,$i);
                    $cegs[] = $cdata;
            }

            /*$tempceg = array_map(function($value) { return str_replace(',', 'COMMAOPERATOR', $value); }, $cegs);*/
            $tempceg = $cegs;
            $imcegs = implode("','", $tempceg);
            //$imcegs = str_replace("COMMAOPERATOR",",",$imcegs,$i);
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }

    $ReturnVal['Division'] = $divs;
    $ReturnVal['Region'] = $regs;
    $ReturnVal['Territory'] = $terrs;
    $ReturnVal['CostElementGroup'] = $cegs;
    $ReturnVal['CostElementName'] = $celem;
}else if($action=='getRegion'){

    $bdivs = $_POST['PDvsn'];
    $impbdiv = implode("','", $bdivs);
    $bdivact ='ALL';
    $depts = $_POST['Dept'];
    $impdept = implode("','", $depts);
    $deptact ='ALL';
    $divs = $_POST['Dvsn'];
    $impdiv = implode("','", $divs);
    $divact ='ALL';

    if($divact=='ALL') {
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }

        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }

        $tempdiv = $impdiv;
         $tempdiv .="','ALL";


          $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') GROUP BY Region ORDER BY Region ASC ";

            $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                     $cdata = trim(utf8_encode($row['Region']));
                     if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }
                     }else{
                       if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                     }
                     
                }
        }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }

            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }

            foreach ($divs as $fdiv) {
                $sql ="SELECT Region FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division='".$fdiv."' GROUP BY Region ORDER BY Region ASC ";
                $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                while($row = sqlsrv_fetch_array($res)){ 
                    $cdata = trim(utf8_encode($row['Region']));
                    if($cdata=='ALL'){
                        $regact ='ALL';
                        $sql1 ="SELECT Region FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."')  GROUP BY Region ORDER BY Region ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Region']));
                            if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $regs))
                             $regs[] = $cdata;
                    }
                }
            }
        }

     $impreg = implode("','",$regs);

     if($regact=='ALL'){        
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }
        $tempdiv = $impdiv;
        if($divact=='ALL'){
            $tempdiv .="','ALL";
        }
        $tempreg = $impreg;
        $tempreg .="','ALL";
        $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') GROUP BY Territory ORDER BY Territory ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['Territory']));
                    if($cdata=='ALL'){
                        $terract ='ALL';
                        $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Territory']));
                            if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                    }
            }
     }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }
            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }
            $tempdiv = $impdiv;
            if($divact=='ALL'){
                $tempdiv .="','ALL";
            }

            foreach ($regs as $freg) {
                $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region='".$freg."' GROUP BY Territory ORDER BY Territory ASC ";
                 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                    while($row = sqlsrv_fetch_array($res)){
                        $cdata = trim(utf8_encode($row['Territory']));
                            if($cdata=='ALL'){
                                $terract ='ALL';
                                $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                                $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                                while($row1 = sqlsrv_fetch_array($res1)){ 
                                     $cdata = trim(utf8_encode($row1['Territory']));
                                    if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                                    }

                            }else{
                                if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                            }
                    }
            }
        
     }

       $imptrr = implode("','",  $terrs);
                   
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') AND Territory IN('".$imptrr."') GROUP BY CostElementGroup ORDER BY CostElementGroup ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementGroup']));
                //$cdata = str_replace(",","COMMAOPERATOR",$cdata,$i);
                    $cegs[] = $cdata;
            }

            /*$tempceg = array_map(function($value) { return str_replace(',', 'COMMAOPERATOR', $value); }, $cegs);*/
            $tempceg = $cegs;
            $imcegs = implode("','", $tempceg);
            //$imcegs = str_replace("COMMAOPERATOR",",",$imcegs,$i);
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }

    $ReturnVal['Region'] = $regs;
    $ReturnVal['Territory'] = $terrs;
    $ReturnVal['CostElementGroup'] = $cegs;
    $ReturnVal['CostElementName'] = $celem;
}else if($action=='getTerritory'){
    $bdivs = $_POST['PDvsn'];
    $impbdiv = implode("','", $bdivs);
    $bdivact ='ALL';
    $depts = $_POST['Dept'];
    $impdept = implode("','", $depts);
    $deptact ='ALL';
    $divs = $_POST['Dvsn'];
    $impdiv = implode("','", $divs);
    $divact ='ALL';
    $regs = $_POST['Rgn'];
    $impreg = implode("','", $regs);
    $regact ='ALL';

     if($regact=='ALL'){        
        $tempbdiv = $impbdiv;
        if($bdivact=='ALL'){
            $tempbdiv .="','ALL";
        }
        $tempdept = $impdept;
        if($deptact=='ALL'){
            $tempdept .="','ALL";
        }
        $tempdiv = $impdiv;
        if($divact=='ALL'){
            $tempdiv .="','ALL";
        }
        $tempreg = $impreg;
        $tempreg .="','ALL";
        $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') GROUP BY Territory ORDER BY Territory ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['Territory']));
                    if($cdata=='ALL'){
                        $terract ='ALL';
                        $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                        $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($res1)){ 
                             $cdata = trim(utf8_encode($row1['Territory']));
                            if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                            }

                    }else{
                        if(!in_array($cdata, $terrs))
                             $terrs[] = $cdata;
                    }
            }
     }else{
            $tempbdiv = $impbdiv;
            if($bdivact=='ALL'){
                $tempbdiv .="','ALL";
            }
            $tempdept = $impdept;
            if($deptact=='ALL'){
                $tempdept .="','ALL";
            }
            $tempdiv = $impdiv;
            if($divact=='ALL'){
                $tempdiv .="','ALL";
            }

            foreach ($regs as $freg) {
                $sql ="SELECT Territory FROM  ".$BRoleMappingtbl." WHERE empcode='".$empid."' AND BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region='".$freg."' GROUP BY Territory ORDER BY Territory ASC ";
                 $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
                    while($row = sqlsrv_fetch_array($res)){
                        $cdata = trim(utf8_encode($row['Territory']));
                            if($cdata=='ALL'){
                                $terract ='ALL';
                                $sql1 ="SELECT Territory FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."')  GROUP BY Territory ORDER BY Territory ASC ";
                                $res1 = sqlsrv_query($conn,$sql1,array(), array( "Scrollable" => 'static' ));
                                while($row1 = sqlsrv_fetch_array($res1)){ 
                                     $cdata = trim(utf8_encode($row1['Territory']));
                                    if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                                    }

                            }else{
                                if(!in_array($cdata, $terrs))
                                     $terrs[] = $cdata;
                            }
                    }
            }
        
     }

       $imptrr = implode("','",  $terrs);
                   
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$tempbdiv."') AND DepartmentName IN('".$tempdept."') AND Division IN('".$tempdiv."') AND Region IN('".$tempreg."') AND Territory IN('".$imptrr."') GROUP BY CostElementGroup ORDER BY CostElementGroup ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementGroup']));
                //$cdata = str_replace(",","COMMAOPERATOR",$cdata,$i);
                    $cegs[] = $cdata;
            }

            /*$tempceg = array_map(function($value) { return str_replace(',', 'COMMAOPERATOR', $value); }, $cegs);*/
            $tempceg = $cegs;
            $imcegs = implode("','", $tempceg);
            //$imcegs = str_replace("COMMAOPERATOR",",",$imcegs,$i);
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }

    $ReturnVal['Territory'] = $terrs;
    $ReturnVal['CostElementGroup'] = $cegs;
    $ReturnVal['CostElementName'] = $celem;
}else if($action=='getCostElementgroup'){
    $bdivs = $_POST['PDvsn'];
    $impbdiv = implode("','", $bdivs);
   
    $depts = $_POST['Dept'];
    $impdept = implode("','", $depts);
   
    $divs = $_POST['Dvsn'];
    $impdiv = implode("','", $divs);
   
    $regs = $_POST['Rgn'];
    $impreg = implode("','", $regs);

    $terrs = $_POST['terr'];
    $imptrr = implode("','", $terrs);
   
                   
        $sql ="SELECT CostElementGroup FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') GROUP BY CostElementGroup ORDER BY CostElementGroup ASC ";
        $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
            while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementGroup']));
                //$cdata = str_replace(",","COMMAOPERATOR",$cdata,$i);
                    $cegs[] = $cdata;
            }

            /*$tempceg = array_map(function($value) { return str_replace(',', 'COMMAOPERATOR', $value); }, $cegs);*/
            $tempceg = $cegs;
            $imcegs = implode("','", $tempceg);
            //$imcegs = str_replace("COMMAOPERATOR",",",$imcegs,$i);
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }

    $ReturnVal['CostElementGroup'] = $cegs;
    $ReturnVal['CostElementName'] = $celem;
}else if($action=='getCostElement'){

    $bdivs = $_POST['PDvsn'];
    $impbdiv = implode("','", $bdivs);
   
    $depts = $_POST['Dept'];
    $impdept = implode("','", $depts);
   
    $divs = $_POST['Dvsn'];
    $impdiv = implode("','", $divs);
   
    $regs = $_POST['Rgn'];
    $impreg = implode("','", $regs);

    $terrs = $_POST['terr'];
    $imptrr = implode("','", $terrs);

    $terrs = $_POST['terr'];
    $imptrr = implode("','", $terrs);
   
    $tempceg = $_POST['ElemGroup'];
    $imcegs = implode("','", $tempceg);
  
         $sql ="SELECT CostElementName FROM  ".$costcentrelmtbl." WHERE BusinessDivision IN ('".$impbdiv."') AND DepartmentName IN('".$impdept."') AND Division IN('".$impdiv."') AND Region IN('".$impreg."') AND Territory IN('".$imptrr."') AND CostElementGroup IN('".$imcegs."') GROUP BY CostElementName ORDER BY CostElementName ASC ";
         
         $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
         while($row = sqlsrv_fetch_array($res)){
                $cdata = trim(utf8_encode($row['CostElementName']));
                $celem[] = $cdata;
        }
    $ReturnVal['CostElementName'] = $celem;
}
//p($ReturnVal);exit;
echo json_encode($ReturnVal);

/*echo "Business Division";
p($bdivs);
echo "DepartmentName";
p($depts);
echo "Division";
p($divs);
echo "Region";
p($regs);
echo "Territory";
p($terrs);
echo "Cost element group";
p($cegs);
echo "Cost element";
p($celem);
exit;*/
?>