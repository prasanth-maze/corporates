<?php
	
	//COST ELEMENT GROP WISE BUDGET
	function CGroupWise($getdata,$filter){
		//p($filter,'e');
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
		     $monthwisebudget_data = "";
		     $monthwisebudgetRowTot = "";
		     $Column_Hdngs = "";
		     $Column_Colspan = "";
		    // echo $cegroup."<br>";
		     	$bgnum = 2;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costelems."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$dept."') ";
					// echo $sql2;exit;
					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						$variance = $row2['Variance'];
						// For Monthwisecolor  background-color:#e6eeff

						 if ($bgnum % 2 == 0) {
						        $bgclrr="#e6eeff";
						 }else {
						         $bgclrr="";
						    }
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						if(!array_key_exists($my, $monthwisetotal)){
							$monthwisetotal[$my] = array('plan'=>$row2['BudgetPlan'],'act'=>$row2['BudgetActual'],'var'=>$row2['Variance'],'varp'=>$variancep);
						}else{
							$monthwisetotal[$my]['plan'] = $monthwisetotal[$my]['plan']+$row2['BudgetPlan'];
							$monthwisetotal[$my]['act'] = $monthwisetotal[$my]['act']+$row2['BudgetActual'];
							$monthwisetotal[$my]['var'] = $monthwisetotal[$my]['var']+$row2['Variance'];
							$monthwisetotal[$my]['varp'] = $monthwisetotal[$my]['varp']+$variancep;
						}
						$Column_Colspan .="<th class='MonthsColspan' colspan='4' style='font-weight:bold;color:#000066;background-color:".$bgclrr."'>".date("F Y",strtotime($my."-01"))."</th>";
						$Column_Hdngs .="<th class='plan' style='".$FontClrAndWt."background-color:".$bgclrr."'>Plan</th><th class='actual' style='".$FontClrAndWt."background-color:".$bgclrr."'>Actual</th><th class='var' style='".$FontClrAndWt."background-color:".$bgclrr."'>Variance</th><th class='varp' style='".$FontClrAndWt."background-color:".$bgclrr."'>Variance%</th>";
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						// RowWise Total
						$RowBudgetPlan[]=$row2['BudgetPlan'];
						
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td>";	
					
					}
					$bgnum++;
				}
				$bgnum=2;
				foreach ($month_range as $my) {
					if ($bgnum % 2 == 0) {
					        $bgclrr="#e6eeff";
					 }else{
					        $bgclrr="";
					    }
						$OverallBudgetPlan += $monthwisetotal[$my]['plan'];
						$OverallBudgetActual += $monthwisetotal[$my]['act'];
						$OverallBudgetVar += $monthwisetotal[$my]['var'];
						$OverallBudgetVarP += $monthwisetotal[$my]['varp'];
					$monthwisebudgetRowTot .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($monthwisetotal[$my]['plan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($monthwisetotal[$my]['act'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($monthwisetotal[$my]['var'])."</td><td class='varp' style='background-color:".$bgclrr."'>".$monthwisetotal[$my]['varp']."</td>";
					$bgnum++;
				}

				$SumPlan = moneyFormatIndia(array_sum($PlanTotal));
				$SumActual = moneyFormatIndia(array_sum($ActualTotal));
				$SumVar = moneyFormatIndia(array_sum($VarianceTotal));
				$SumVarP = moneyFormatIndia(array_sum($VariancePTotal));
				// $returndata[] = array("<tr class='TableTotal'>Total</tr>");
				if($lastelemlen == $rowno){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				if($SumPlan>0){
		     $returndata[] = array("<tr class='ElemGrouprow'><td  class='drilldown ElemGroup ElemGroup".$rowno."' data-class='ElemGroup' data-click='ce' data-colval='".$cegroup."' data-drilldown='CEwisebudget' data-lastelem='".$lastelem."' data-cellindex='".$rowno."'>".$cegroup."</td><td class='costElementCol'></td><td class='businessDivisionCol' ></td><td class='departmentCol'></td><td class='DivisionCol'></td><td class='RegionCol'></td><td class='TerritoryCol'></td>".$monthwisebudget_data."<td class='plan' style='font-weight:bold;color:#000066;background-color:lightgreen'>".$SumPlan."</td><td class='actual' style='font-weight:bold;color:#000066;background-color:lightgreen' >".$SumActual."</td><td class='var' style='font-weight:bold;color:#000066;background-color:lightgreen'>".$SumVar."</td><td class='varp' style='font-weight:bold;color:#000066;background-color:lightgreen'>".$SumVarP."</td></tr>");
		     $rowno++;
				}
		}
		//p($monthwisetotal,'e');
		// column wise Total
		$monthwisebudgetRowTot .="<td class='plan' style='".$FontClrAndWt."background-color:lightgreen'>".moneyFormatIndia($OverallBudgetPlan)."</td><td class='actual' style='".$FontClrAndWt."background-color:lightgreen'>".moneyFormatIndia($OverallBudgetActual)."</td><td class='var' style='".$FontClrAndWt."background-color:lightgreen'>".moneyFormatIndia($OverallBudgetVar)."</td><td class='varp' style='".$FontClrAndWt."background-color:lightgreen'>".$OverallBudgetVarP."</td>";
		//Row Wise Total 
		$returndata[] = array("<tr class='TableTotal' style='".$FontClrAndWt."'><td style='".$FontClrAndWt."background-color:lightgreen'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td>".$monthwisebudgetRowTot."</tr>");
		//table headers
		$returndata[] = array("<tr class='TableHeads'><th id='colspan' colspan='7'></th>".$Column_Colspan."<th id='colspan' colspan='4' style='".$FontClrAndWt."background-color:lightgreen'>Total</th></tr><tr class='TableHeads'><th class='ElemGroupCol' style='".$FontClrAndWt."' >Element Group</th><th class='costElementCol' style='".$FontClrAndWt."'>Cost Element</th><th class='businessDivisionCol' style='".$FontClrAndWt."' >Business Division</th><th style='".$FontClrAndWt."'>Department</th><th class='DivisionCol' style='".$FontClrAndWt."'>Division</th><th class='RegionCol' style='".$FontClrAndWt."'>Region</th><th class='TerritoryCol' style='".$FontClrAndWt."'>Territory</th>".$Column_Hdngs."<th class='plan' style='".$FontClrAndWt."background-color:lightgreen'>Plan</th><th class='actual' style='".$FontClrAndWt."background-color:lightgreen'>Actual</th><th class='var' style='".$FontClrAndWt."background-color:lightgreen'>Variance</th><th class='varp' style='".$FontClrAndWt."background-color:lightgreen'>Variance%</th></tr>");
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
        $lastelemlen = $row_count;
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
          		 $monthwisebudget_data = "";
		    // echo $cegroup."<br>";
          		 $bgnum = 2;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$dept."') ";
					// echo $sql2;exit;

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
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td>";	
					}
					$bgnum++;
				}
				if($lastelemlen == $rowno){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				//echo $row['CostElementName']." ".$pltot." ".$acttot." ".var_dump($pltot)." ".var_dump($acttot)."<br>";
					
				if($pltot!=0){
					//echo $row['CostElementName']." ".$pltot." ".$acttot." ".var_dump($pltot)." ".var_dump($acttot)."<br>";
				$returndata[] = array('<tr class="costElementrow"><td></td><td  class="drilldown costElementdd costElement'.$rowno.'" data-cecode="'.$costElement.'" data-click="bdiv" data-class="costElement" data-elgroup="'.$expgroup.'" data-colval="'.$row['CostElementName'].'" data-drilldown="BDwisebudget" data-lastelem="'.$lastelem.'" data-cellindex="'.$rowno.'" >'.$row['CostElementName'].'</td><td class="businessDivisionCol" ></td><td class="departmentCol"></td><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($PlanTotal)).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
				$rowno++;
			
				}
				
          }
		  
          return $returndata;
      }
	}

	//BUSINESS DIVISION WISE BUDGET
	function BussDivWise($getdata,$filter){
		//p($_GET,'e');
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
	 		  if(isset($_GET['division'])){
		        $division = implode("','",$_GET['division']);
		        $cond .= " ".$addand." Division IN('".$division."')";
		        $addand = " AND ";
		      }
		      if(isset($_GET['region'])){
		        $region = implode("','",$_GET['region']);
		        $cond .= " ".$addand." Region IN('".$region."')";
		        $addand = " AND ";
		      }

		      if(isset($_GET['territory'])){
		        $territory = implode("','",$_GET['territory']);
		        $cond .= " ".$addand." Territory IN('".$territory."')";
		        $addand = " AND ";
		      }
		      $sql .=" WHERE ".$cond." AND BusinessDivision='".$bdiv."'  ";
		      //echo  $sql;exit;
		      $res = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
		      $row_count = sqlsrv_num_rows($res);
		      $costcntrs = array();
		      while($row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)){ 
		      		//p($row,'e');
		      		$costcntrs[]= $row['CostCenterCode'];
		      }
		      $costcntrs = implode("','", $costcntrs);

		       $monthwisebudget_data = "";
		    // echo $cegroup."<br>";
		       $bgnum = 2;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$dept."') ";
					//echo $sql2;echo "<br>";

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
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
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td>";	
					}
					$bgnum++;
				}
			// $returndata[] = array("bussdiv"=>$bdiv,"budget_data"=>$monthwisebudget_data);
				if($lastelemlen == $rowno){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
					
				if($pltot!=0){
				$returndata[] = array('<tr class="BusinessDivrow"><td></td><td></td><td class="drilldown BusinessDiv BusinessDiv'.$rowno.'" data-cecode="'.$costElement.'" data-click="dept" data-lastelem="'.$lastelem.'"  data-elgroup="'.$expgroup.'"  data-class="BusinessDiv" data-colval="'.$bdiv.'" data-cellindex="'.$rowno.'" data-drilldown="Dwisebudget" >'.$bdiv.'</td><td class="departmentCol"><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
		$bussdiv = implode("",$getdata['pdivision']);
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		$costcntrs = $filter['costcntrs'];
		$lastelemlen = count($dept);
		$rowno=1;
		foreach ($dept as $key => $deptval) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$monthwisebudget_data='';
			$deptsql ="SELECT * FROM ".$budgetdeptbl." WHERE DepartmentCode='".$deptval."'  ";
		      //echo  $sql;exit;
		      $dres = sqlsrv_query($conn,$deptsql,array(), array( "Scrollable" => 'static' ));
		      while($deptrow = sqlsrv_fetch_array($dres,SQLSRV_FETCH_ASSOC)){ 
		      	$deptname = $deptrow['DepartmentName'];
		      }
		      $bgnum=2;
			foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$deptval."') ";
					

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

						if ($bgnum % 2 == 0) {
						        $bgclrr="#e6eeff";
						 }else {
						         $bgclrr="";
						    }

						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						//For  Monthwise Column Total
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."' >".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."' >".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."' >".$variancep."</td>";	
					}
					$bgnum++;
				}
				if($lastelemlen == $rowno){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
					
				if($pltot!=0){
				$returndata[] = array('<tr class="Departmentrow"><td></td><td></td><td></td><td class="drilldown departmentCol Department Department'.$rowno.'" data-cecode="'.$costElement.'" data-click="div" data-elgroup="'.$expgroup.'"  data-class="Department" data-lastelem="'.$lastelem.'" data-busdiv="'.$bussdiv.'" data-colval="'.$deptval.'" data-cellindex="'.$rowno.'" data-drilldown="Dwisebudget" >'.$deptname.'</td><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
		$division = $getdata['division'];
		$region = implode("','",$getdata['region']);
		$territory = implode("','",$getdata['terriotry']);
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		// $rowno=1;
		// $lastelemlen = count($territory);
		foreach ($division as $cdiv) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$costcntrs =array();
			$sql = "SELECT * FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND   Division='".$cdiv."' AND Region IN('".$region."') AND territory IN('".$territory."') ";
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
		  	  // $loopStatus=false;
		  	  $bgnum = 2;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."') AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$dept."') ";
					//echo $sql2;exit;

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					$rowno=1;
					$row_countlast = @sqlsrv_num_rows(@$res2);
					// echo $row_countlast;exit;
					$lastelemlen = $row_countlast;
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
						// if($row2['BudgetPlan'] !=0 || $row2['BudgetActual'] !=0){
						// 	$loopStatus = true;
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
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td>";	
					// }
					}
					$bgnum++;
				}
				if($lastelemlen == $row_countlast){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
					
				if($pltot!=0){
				// echo $lastelem;exit;
				$returndata[] = array('<tr class="Divisionrow"><td></td><td></td><td></td><td></td><td class="drilldown Division Division'.$rowno.'" data-cecode="'.$costElement.'" data-click="reg" data-elgroup="'.$expgroup.'"  data-busdiv="'.$bussdiv.'" data-dept="'.$dept.'" data-lastelem="'.$lastelem.'" data-class="Division" data-cellindex="'.$rowno.'" data-colval="'.$cdiv.'" data-drilldown="Regwisebudget" >'.$cdiv.'</td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen" >'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
			// }
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
		$division = implode("','",$getdata['division']);
		$region = $getdata['region'];
		$territory = implode("','",$getdata['terriotry']);
		$costElement = implode("','",$getdata['costElement']);
		$expgroup = implode("','",$getdata['expgroup']);
		// $rowno=1;
		 $lastelemlen = count($region);
		foreach ($region as $creg) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$costcntrs =array();
			$sql = "SELECT * FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND Division IN('".$division."') AND Region='".$creg."' AND territory IN('".$territory."') ";
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
		  	  $bgnum = 2;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."') AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$dept."') ";
					//echo $sql2;echo "<br>";

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					$rowno=1;
					$row_countlast = @sqlsrv_num_rows(@$res2);
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
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
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td>";	
					}
					$bgnum++;
				}
				if($lastelemlen == $rowno){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
					
				if($pltot!=0){
				$returndata[] = array('<tr class="Regionrow"><td></td><td></td><td></td><td></td><td></td><td class="drilldown Region Region'.$rowno.'" data-elgroup="'.$expgroup.'" data-busdiv="'.$bussdiv.'" data-dept="'.$dept.'" data-lastelem="'.$lastelem.'" data-div="'.$division.'" data-cecode="'.$costElement.'" data-click="terr" data-class="Region" data-cellindex="'.$rowno.'" data-colval="'.$creg.'" data-drilldown="Regwisebudget" >'.$creg.'</td><td class="RegionCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
		$division = implode("','",$getdata['division']);
		$region = implode("','",$getdata['region']);
		$territory = $getdata['terriotry'];
		$costElement = implode("','",$getdata['costElement']);
		// $rowno=1;
		 $lastelemlen = count($territory);
		foreach ($territory as $cterr) {
			$PlanTotal=array();
			$ActualTotal=array();
			$VarianceTotal=array();
			$VariancePTotal=array();
			$costcntrs =array();
			$sql = "SELECT * FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND Division IN('".$division."') AND Region IN('".$region."') AND territory='".$cterr."' ";
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
		  	  $bgnum = 2;
				foreach ($month_range as $my) {
					$myarr = explode("-",$my);
					$bm = $myarr[1];
					$by = $myarr[0];
					$sql2 = "SELECT SUM(CAST(BudgetPlan AS BIGINT)) AS BudgetPlan,SUM(CAST(BudgetActual AS BIGINT)) AS BudgetActual,SUM(CAST(Variance AS BIGINT)) AS Variance FROM ".$budgetexptbl." WHERE CostElementCode IN ('".$costElement."') AND CostCenterCode IN('".$costcntrs."')  AND MONTH='".$bm."' AND YEAR='".$by."' AND DepartmentCode IN('".$dept."') ";
					//echo $sql2;echo "<br>";

					$res2 = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
					$rowno=1;
					$row_countlast = @sqlsrv_num_rows(@$res2);
					while($row2= sqlsrv_fetch_array($res2)){ 
						if($row2['BudgetPlan']==NULL)
							$row2['BudgetPlan']=0;
						if($row2['BudgetActual']==NULL)
							$row2['BudgetActual'] =0;
						if($row2['Variance']==NULL)
							$row2['Variance'] =0;
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
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td>";	
					}
					$bgnum++;
				}
				if($lastelemlen == $rowno){
					$lastelem = true;
				}else{
					$lastelem = false;
				}
				
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
					
				if($pltot!=0){
				$returndata[] = array('<tr  class="Territoryrow"><td></td><td></td><td></td><td></td><td></td><td></td><td class="drilldown Territory'.$rowno.'" data-elgroup="'.$expgroup.'" data-busdiv="'.$bussdiv.'" data-div="'.$division.'" data-reg="'.$region.'" data-lastelem="'.$lastelem.'" data-cecode="'.$costElement.'"  data-class="Territory" data-colval="'.$cterr.'" >'.$cterr.'</td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
			$rowno++;
				}

		}
	}
	return $returndata;
	
}
// Indina Money Format
?>