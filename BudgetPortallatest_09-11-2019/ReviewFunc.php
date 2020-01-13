<?php
	
	//COST ELEMENT GROP WISE BUDGET
	function CGroupWise($getdata,$filter){
		//p($getdata,'e');
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		$month_range = $filter['month_range'];
		$dept = $filter['dept'];
		$costcntrs = $filter['costcntrs'];
		$expgroup = $getdata['expgroup'];
    	$costElement = implode("','",$getdata['costElement']);
    	$rowno=1;
    	// Table Headers Font-Weight And Color
    	$FontClrAndWt = "font-weight:bold;color:#000066;";
    	$monthwisetotal = array();
    	$lastelemlen = count($expgroup);
		foreach ($expgroup as $cegroup) {
			// ColumnWise Total
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			
		    // OverAll Total
		    $OverallBudgetPlan = 0;
		    $OverallBudgetActual = 0;
		    $OverallBudgetVar = 0;
		    $OverallBudgetVarP = 0;
			$sqlce = "SELECT CostElement FROM ".$costelemtbl." WHERE CostElementGroup='".$cegroup."'  ";
	        //echo $sql1;exit;
	        $costelemarray=array();
	        $resce = sqlsrv_query($conn,$sqlce,array(), array( "Scrollable" => 'static' ));
          	while($rowce= sqlsrv_fetch_array($resce)){ 
            $costelemarray[] = $rowce['CostElement'];
          	}
          	//p($costelemarray,'e');
          	$costelems = implode("','", $costelemarray);
		    $monthwisebudget_data = array();
		    $monthwisebudgetRowTot = array();
		    $Column_Hdngs = "";
		    // $Column_Colspan = "";
		    $Column_Colspan = array();
		    // echo $cegroup."<br>";
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					// AND CostCenterCode IN('".$costcntrs."')  
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costelems."') AND CostCenterCode IN('".$costcntrs."') AND MONTH='".$bm."' AND YEAR='".$by."' ";
					// if($rowno ==1){
					// 	echo $sql2;exit;
					// }
					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						$variance = $row2['Variance'];
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						if(!array_key_exists($my, $monthwisetotal)){
							$monthwisetotal[$my] = array('plan'=>$row2['BudgetPlan'],'act'=>$row2['BudgetActual'],'var'=>$row2['Variance'],'varp'=>$variancep);
						}else{
							$monthwisetotal[$my]['plan'] = $monthwisetotal[$my]['plan']+$row2['BudgetPlan'];
							$monthwisetotal[$my]['act'] = $monthwisetotal[$my]['act']+$row2['BudgetActual'];
							$monthwisetotal[$my]['var'] = $monthwisetotal[$my]['var']+$row2['Variance'];
							$monthwisetotal[$my]['varp'] = $monthwisetotal[$my]['varp']+$variancep;
						}
						$Column_Colspan[] =date("F Y",strtotime($my."-01"));
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						// RowWise Total
						$RowBudgetPlan[]=$row2['BudgetPlan'];
						$monthwisebudget_data[] =array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
					}
				}
				foreach ($month_range as $my) {
					$OverallBudgetPlan += $monthwisetotal[$my]['plan'];
					$OverallBudgetActual += $monthwisetotal[$my]['act'];
					$OverallBudgetVar += $monthwisetotal[$my]['var'];
					$OverallBudgetVarP += $monthwisetotal[$my]['varp'];
					$monthwisebudgetRowTot[] =array("plan"=>moneyFormatIndia($monthwisetotal[$my]['plan']),"actual"=>moneyFormatIndia($monthwisetotal[$my]['act']),"var"=>moneyFormatIndia($monthwisetotal[$my]['var']),"varp"=>$monthwisetotal[$my]['varp']);
				}

				$SumPlan = moneyFormatIndia(array_sum($PlanTotal));
				$SumActual = moneyFormatIndia(array_sum($ActualTotal));
				$SumVar = moneyFormatIndia(array_sum($VarianceTotal));
				$SumVarP = array_sum($VariancePTotal);
				if($SumVar!=0){
				$monthwisebudget_data[] =array("plan"=>$SumPlan,"actual"=>$SumActual,"var"=>$SumVar,"varp"=>$SumVarP);
				if($rowno ==1){
					$returndata["BRE@Nmonths"] = $Column_Colspan;
				}
				$returndata[$cegroup] = $monthwisebudget_data;
		     	$rowno++;
			}
		}
		//p($monthwisetotal,'e');
		// column wise Total
		$monthwisebudgetRowTot[] =array("plan"=>moneyFormatIndia($OverallBudgetPlan),"actual"=>moneyFormatIndia($OverallBudgetActual),"var"=>moneyFormatIndia($OverallBudgetVar),"varp"=>$OverallBudgetVarP);
		//Row Wise Total 
		$returndata["BRE@RowTot"] = $monthwisebudgetRowTot;
		return $returndata;
	}

	//COST ELEMENT WISE BUDGET
	function CElemWise($getdata,$filter){
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		$month_range = $filter['month_range'];
		$dept = $filter['dept'];
		$expgroup = implode("','",$getdata['expgroup']);
		$costElement = implode("','",$getdata['costElement']);
		$costcntrs = $filter['costcntrs'];
		$sql = "SELECT ce.CostElementName,ce.CostElementGroup,STUFF((SELECT ',' +ce1.CostElement FROM ".$costelemtbl." as ce1 WHERE ce1.CostElementName=ce.CostElementName AND ce1.CostElementGroup=ce.CostElementGroup FOR XML PATH(''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 1, ''  ) AS CostElement  FROM ".$costelemtbl." as ce WHERE ce.CostElementGroup  IN('".$expgroup."')  AND ce.CostElement IN('".$costElement."') GROUP BY  ce.CostElementName,ce.CostElementGroup ";
		//echo $sql;exit;
		$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        $row_count = sqlsrv_num_rows($res);
        $result = array();
        $rowno=1;
         	if($row_count>0){
          	while($row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)){ 
	          	$PlanTotal=array();
				$ActualTotal=array();
				$VarianceTotal=array();
				$VariancePTotal=array();
	          	//p($row,'e');
	          	$costElement = explode(",",$row['CostElement']);
	          	$costElement = implode("','",$costElement);
	      		$monthwisebudget_data = array();
		    	// echo $cegroup."<br>";
	      		$bgnum = 2;
	      		$CmntNUm = 1;
					foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."'  ";
					// echo $sql2;exit;
					// if($rowno ==9){
					// 	echo $sql2;exit;
					// }
					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
						while($row2= sqlsrv_fetch_array($res2)){ 
							if($row2['BudgetPlan']==NULL)
								$row2['BudgetPlan']=0;
							if($row2['BudgetActual']==NULL)
								$row2['BudgetActual']=0;
							if($row2['Variance']==NULL)
								$row2['Variance']=0;
							if ($bgnum % 2 == 0) {
							        $bgclrr="#e6eeff";
							 }else {
							         $bgclrr="";
							    }	
							$variance = $row2['Variance'];
							$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
							//For  Monthwise Column Total
							$PlanTotal[]=$row2['BudgetPlan'];
							$ActualTotal[]=$row2['BudgetActual'];
							$VarianceTotal[]=$variance;
							$VariancePTotal[]=$variancep;
							$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
						}
						$bgnum++;
						$CmntNUm++;
					}
					$pltot = array_sum($PlanTotal);
					$acttot = array_sum($ActualTotal);
					$VarTot = array_sum($VarianceTotal);					
					if($VarTot!=0){
						$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($pltot),"actual"=>moneyFormatIndia($acttot),"var"=>moneyFormatIndia($VarTot),"varp"=>$variancep);
						$returndata[$expgroup] = $costElement;
						$returndata[$row['CostElementName']] = $monthwisebudget_data;
					$rowno++;
					}		
        		}
        	return $returndata;
     	}
	}

	//BUSINESS DIVISION WISE BUDGET
	function BussDivWise($getdata,$filter){
		//p($getdata,'e');
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		$month_range = $filter['month_range'];
		$dept = $filter['dept'];
		$bussdiv = $getdata['pdivision'];
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		//p($getdata,'e');
		$rowno=1;
		$lastelemlen = count($bussdiv);
		foreach ($bussdiv as $bdiv) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			 $sql = "SELECT * FROM ".$costcentrtbl." ";
			 $cond = '';
	 		 $addand = '';
	 		  if(isset($_POST['department'])){
		        $department = implode("','",$_POST['department']);
		        $cond .= " ".$addand." DepartmentName IN('".$department."')";
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

		      if(isset($_POST['territory'])){
		        $territory = implode("','",$_POST['territory']);
		        $cond .= " ".$addand." Territory IN('".$territory."')";
		        $addand = " AND ";
		      }
			  
		      $sql .=" WHERE ".$cond." ".$addand." BusinessDivision='".$bdiv."'  ";
		      //echo  $sql;exit;
		      $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		      $row_count = sqlsrv_num_rows($res);
		      $costcntrs = array();
		      while($row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)){ 
		      		//p($row,'e');
		      		$costcntrs[]= $row['CostCenterCode'];
		      }
		      $costcntrs = implode("','", $costcntrs);

		       $monthwisebudget_data = array();
		    // echo $cegroup."<br>";
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."' ";
					//echo $sql2;echo "<br>";

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						$variance = $row2['Variance'];
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
					}
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($pltot),"actual"=>moneyFormatIndia($acttot),"var"=>moneyFormatIndia($VarTott),"varp"=>$variancep);
				$returndata[$bdiv] = $monthwisebudget_data;;
			$rowno++;
				}
		}
		// echo $returndata;exit;
		return $returndata;
	}

	function DEPTwisebudget($getdata,$filter){
		//p($getdata);exit;
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		global $budgetdeptbl;
		$month_range = $filter['month_range'];
		$dept = $getdata['department'];
		$bussdiv = implode("','",$getdata['pdivision']);
		$division = implode("','",$getdata['division']);
		$region = implode("','",$getdata['region']);
		$territory = implode("','",$getdata['terriotry']);
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		$costcntrs = $filter['costcntrs'];
		$lastelemlen = count($dept);
		$rowno=1;
		$dept =array();
		$deptsql = "SELECT DepartmentName FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') GROUP BY DepartmentName ";
		$res1 = sqlsrv_query($conn,$deptsql,array(), array( "Scrollable" => 'static' ));
					while($row1= sqlsrv_fetch_array($res1)){ 
						$dept[]=$row1['DepartmentName'];
			}
		
		foreach ($dept as $key => $deptval) {
			$deptname = $deptval;
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$CostCenters=array();
			$monthwisebudget_data=array();
			$ccsql = "SELECT CostCenterCode FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND DepartmentName ='".$deptname."' AND  Division IN('".$division."') AND Region IN('".$region."') AND territory IN('".$territory."') GROUP BY CostCenterCode ";
			$ccres = sqlsrv_query($conn,$ccsql,array(), array( "Scrollable" => 'static' ));
					while($ccrow= sqlsrv_fetch_array($ccres)){ 
						$CostCenters[]=$ccrow['CostCenterCode'];
			}
		 	$ccntrs = implode("','", $CostCenters);
			foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$ccntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."'  ";
					

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						$variance = $row2['Variance'];
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						//For  Monthwise Column Total
						$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
					}
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
					$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($pltot),"actual"=>moneyFormatIndia($acttot),"var"=>moneyFormatIndia($VarTott),"varp"=>$variancep);
				$returndata[$deptname] = $monthwisebudget_data;
				$rowno++;
				}
		}

		return $returndata;
	}

	//DIVISION WISE BUDGET
	function DivisionWise($getdata,$filter){
		//p($getdata,'e');
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		$month_range = $filter['month_range'];
		$dept = $filter['dept'];
		$bussdiv = implode("",$getdata['pdivision']);
		$department = implode("",$getdata['department']);
		$division = $getdata['division'];
		$region = implode("','",$getdata['region']);
		$territory = implode("','",$getdata['terriotry']);
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		// $rowno=1;
		// $lastelemlen = count($territory);
		$division =array();
		$divsql = "SELECT Division FROM ".$costcentrtbl." WHERE BusinessDivision IN ('".$bussdiv."') AND DepartmentName IN('".$department."')  GROUP BY Division";

			$res1 = sqlsrv_query($conn,$divsql,array(), array( "Scrollable" => 'static' ));
		    while($row1 = sqlsrv_fetch_array($res1)){ 
		    	$division[] = $row1['Division'];
		    }
		$rowno=1;
		foreach ($division as $cdiv) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$costcntrs =array();
			$sql = "SELECT * FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND DepartmentName IN('".$department."') AND  Division='".$cdiv."' AND Region IN('".$region."') AND territory IN('".$territory."')  ";
			//echo $sql;exit;
			$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		    $row_count = @sqlsrv_num_rows(@$res);
         	if($row_count>0){
		    while($row = sqlsrv_fetch_array($res)){ 
		     	$costcntrs[]= $row['CostCenterCode'];
		      }
		 	  $costcntrs = implode("','", $costcntrs);
		  	  $monthwisebudget_data = array();
		    // echo $cegroup."<br>";
		  	  // $loopStatus=false;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."') AND MONTH='".$bm."' AND YEAR='".$by."'";
					//echo $sql2;exit;
					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					$row_countlast = @sqlsrv_num_rows(@$res2);
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						// if($row2['BudgetPlan'] !=0 || $row2['BudgetActual'] !=0){
						// 	$loopStatus = true;
						$variance = $row2['Variance'];
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						//For  Monthwise Column Total
						$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
					// }
					}
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($pltot),"actual"=>moneyFormatIndia($acttot),"var"=>moneyFormatIndia($VarTott),"varp"=>$variancep);
				$returndata[$cdiv] = $monthwisebudget_data;
			$rowno++;
			}
		}
	}
		return $returndata;
	}

	//REGION WISE BUDGET
	function RegionWise($getdata,$filter){
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		$month_range = $filter['month_range'];
		$dept = $filter['dept'];
		$bussdiv = implode("','",$getdata['pdivision']);
		$department = implode("','",$getdata['department']);
		$division = implode("','",$getdata['division']);
		$region = $getdata['region'];
		$territory = implode("','",$getdata['terriotry']);
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		$rowno=1;
		$region =array();
		$lsql = "SELECT Region FROM ".$costcentrtbl." WHERE BusinessDivision IN ('".$bussdiv."') AND DepartmentName IN('".$department."') AND Division IN('".$division."')  GROUP BY Region";
		
			$res1 = sqlsrv_query($conn,$lsql,array(), array( "Scrollable" => 'static' ));
		    while($row1 = sqlsrv_fetch_array($res1)){ 
		    	$region[] = $row1['Region'];
		    }

		 $lastelemlen = count($region);
		foreach ($region as $creg) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$costcntrs =array();
			$sql = "SELECT * FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND DepartmentName IN('".$department."') And Division IN('".$division."') AND Region='".$creg."' AND territory IN('".$territory."') ";
			//echo $sql;exit;
			$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		     $row_count = @sqlsrv_num_rows(@$res);
         	if($row_count>0){
		    while($row = sqlsrv_fetch_array($res)){ 
		     	$costcntrs[]= $row['CostCenterCode'];
		      }
		 	  $costcntrs = implode("','", $costcntrs);
		  	  $monthwisebudget_data = "";
		    // echo $cegroup."<br>";
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."') AND MONTH='".$bm."' AND YEAR='".$by."'  ";
					//echo $sql2;echo "<br>";

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					$row_countlast = @sqlsrv_num_rows(@$res2);
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						$variance = $row2['Variance'];
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
					}
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($pltot),"actual"=>moneyFormatIndia($acttot),"var"=>moneyFormatIndia($VarTott),"varp"=>$variancep);
				$returndata[$creg] = $monthwisebudget_data;
			$rowno++;
				}

		}
	}
		return $returndata;
	}

	//TERRITORY WISE BUDGET 
	// AND BusinessDivision IN('".$bussdiv."') AND Division IN('".$division."') AND Region IN('".$region."')
	function TerritoryWise($getdata,$filter){
		//p($getdata,'e');
		$returndata = array();
		global $conn;
		global $costelemtbl;
		global $costcentrtbl;
		global $budgetexptbl;
		$month_range = $filter['month_range'];
		$dept = $filter['dept'];
		$expgroup = implode("','",$getdata['expgroup']);
		$bussdiv = implode("','",$getdata['pdivision']);
		$department = implode("','",$getdata['department']);
		$division = implode("','",$getdata['division']);
		$region = implode("','",$getdata['region']);
		$gterritory = implode("','",$getdata['terriotry']);
		$costElement = implode("','",$getdata['costElement']);
		$rowno=1;
		$territory =array();
		$lsql = "SELECT Territory FROM ".$costcentrtbl." WHERE BusinessDivision IN ('".$bussdiv."') AND DepartmentName IN('".$department."') AND Division IN('".$division."')  AND Region IN('".$region."') AND territory IN ('".$gterritory."') GROUP BY Territory";
		
			$res1 = sqlsrv_query($conn,$lsql,array(), array( "Scrollable" => 'static' ));
		    while($row1 = sqlsrv_fetch_array($res1)){ 
		    	$territory[] = $row1['Territory'];
		    }
		 $lastelemlen = count($territory);
		foreach ($territory as $cterr) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$costcntrs =array();
			$sql = "SELECT * FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND DepartmentName IN('".$department."') AND  Division IN('".$division."') AND Region IN('".$region."') AND territory='".$cterr."' ";
			//echo $sql;exit;
			$res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		    $row_count = @sqlsrv_num_rows(@$res);
         	if($row_count>0){
		    while($row = sqlsrv_fetch_array($res)){ 
		     	$costcntrs[]= $row['CostCenterCode'];
		      }
		 	  $costcntrs = implode("','", $costcntrs);
		  	  $monthwisebudget_data = "";
		    // echo $cegroup."<br>";
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."'  ";
					//echo $sql2;echo "<br>";

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					$row_countlast = @sqlsrv_num_rows(@$res2);
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						$variance = $row2['Variance'];
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($row2['BudgetPlan']),"actual"=>moneyFormatIndia($row2['BudgetActual']),"var"=>moneyFormatIndia($variance),"varp"=>$variancep);	
					}
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);	
				if($VarTott!=0){
				$monthwisebudget_data[]=array("plan"=>moneyFormatIndia($pltot),"actual"=>moneyFormatIndia($acttot),"var"=>moneyFormatIndia($VarTott),"varp"=>$variancep);
				$returndata[$cterr] = $monthwisebudget_data;
			$rowno++;
				}

		}
	}
	return $returndata;
}
?>