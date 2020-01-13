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
		     $monthwisebudget_data = "";
		     $monthwisebudgetRowTot = "";
		     $Column_Hdngs = "";
		     $Column_Colspan = "";
		    // echo $cegroup."<br>";
		     	$bgnum = 2;
		     	$CmntNUm = 1;
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
						// For Monthwisecolor  background-color:#e6eeff

						 if ($bgnum % 2 == 0) {
						        $bgclrr="#e6eeff";
						 }else {
						         $bgclrr="";
						    }
						    // =(new-original)/original
						$variancep = @round((($variance/$row2['BudgetPlan'])*100),2);
						if(!array_key_exists($my, $monthwisetotal)){
							$monthwisetotal[$my] = array('plan'=>$row2['BudgetPlan'],'act'=>$row2['BudgetActual'],'var'=>$row2['Variance'],'varp'=>$variancep);
						}else{
							$monthwisetotal[$my]['plan'] = $monthwisetotal[$my]['plan']+$row2['BudgetPlan'];
							$monthwisetotal[$my]['act'] = $monthwisetotal[$my]['act']+$row2['BudgetActual'];
							$monthwisetotal[$my]['var'] = $monthwisetotal[$my]['var']+$row2['Variance'];
							$monthwisetotal[$my]['varp'] = $monthwisetotal[$my]['varp']+$variancep;
						}
						$Column_Colspan .="<th class='MonthsColspan' colspan='5' style='font-weight:bold;color:#000066;background-color:".$bgclrr."'>".date("F Y",strtotime($my."-01"))."</th>";
						$Column_Hdngs .="<th class='plan' style='".$FontClrAndWt."background-color:".$bgclrr."'>Plan</th><th class='actual' style='".$FontClrAndWt."background-color:".$bgclrr."'>Actual</th><th class='var' style='".$FontClrAndWt."background-color:".$bgclrr."'>Variance</th><th class='varp' style='".$FontClrAndWt."background-color:".$bgclrr."'>Variance%</th><th class='class='ReviewRemark'' style='".$FontClrAndWt."background-color:".$bgclrr."'>Remark</th>";
						//For  Monthwise Column Total
						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						// RowWise Total
						$RowBudgetPlan[]=$row2['BudgetPlan'];
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentCG'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentCG'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					
					}
					$bgnum++;
					$CmntNUm++;
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
					$monthwisebudgetRowTot .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($monthwisetotal[$my]['plan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($monthwisetotal[$my]['act'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($monthwisetotal[$my]['var'])."</td><td class='varp' style='background-color:".$bgclrr."'>".$monthwisetotal[$my]['varp']."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'></td>";
					$bgnum++;
				}

				$SumPlan = moneyFormatIndia(array_sum($PlanTotal));
				$SumActual = moneyFormatIndia(array_sum($ActualTotal));
				$SumVar = moneyFormatIndia(array_sum($VarianceTotal));
				$SumVarP = array_sum($VariancePTotal);
				// $returndata[] = array("<tr class='TableTotal'>Total</tr>");
				
				if($SumVar!=0){
		     	$returndata[] = array("<tr class='ElemGrouprow'><td  class='drilldown ElemGroup ElemGroup".$rowno."' data-class='ElemGroup' data-click='ce' data-colval='".$cegroup."' data-drilldown='CEwisebudget' data-cellindex='".$rowno."'>".$cegroup."</td><td class='costElementCol'></td><td class='businessDivisionCol' ></td><td class='departmentCol'></td><td class='DivisionCol'></td><td class='RegionCol'></td><td class='TerritoryCol'></td>".$monthwisebudget_data."<td class='plan' style='font-weight:bold;color:#000066;background-color:lightgreen'>".$SumPlan."</td><td class='actual' style='font-weight:bold;color:#000066;background-color:lightgreen' >".$SumActual."</td><td class='var' style='font-weight:bold;color:#000066;background-color:lightgreen'>".$SumVar."</td><td class='varp' style='font-weight:bold;color:#000066;background-color:lightgreen'>".$SumVarP."</td></tr>");
		     	$rowno++;
			}
		}
		//p($monthwisetotal,'e');
		// column wise Total
		$monthwisebudgetRowTot .="<td class='plan' style='".$FontClrAndWt."background-color:lightgreen'>".moneyFormatIndia($OverallBudgetPlan)."</td><td class='actual' style='".$FontClrAndWt."background-color:lightgreen'>".moneyFormatIndia($OverallBudgetActual)."</td><td class='var' style='".$FontClrAndWt."background-color:lightgreen'>".moneyFormatIndia($OverallBudgetVar)."</td><td class='varp' style='".$FontClrAndWt."background-color:lightgreen'>".$OverallBudgetVarP."</td>";
		//Row Wise Total 
		$returndata[] = array("<tr class='TableTotal' style='".$FontClrAndWt."'><td style='".$FontClrAndWt."background-color:lightgreen'>Total</td><td class='costElementCol'></td><td class='businessDivisionCol'></td><td class='departmentCol'></td><td class='DivisionCol'></td><td class='RegionCol'></td><td class='TerritoryCol'></td>".$monthwisebudgetRowTot."</tr>");
		//table headers
		$returndata[] = array("<tr class='TableHeads'><th id='colspanhead' colspan='1'></th>".$Column_Colspan."<th id='colspan' colspan='4' style='".$FontClrAndWt."background-color:lightgreen'>Total</th></tr><tr class='TableHeads'><th class='ElemGroupCol' style='".$FontClrAndWt."' >Element Group</th><th class='costElementCol' style='".$FontClrAndWt."'>Cost Element</th><th class='businessDivisionCol' style='".$FontClrAndWt."' >Business Division</th><th class='departmentCol' style='".$FontClrAndWt."'>Department</th><th class='DivisionCol' style='".$FontClrAndWt."'>Division</th><th class='RegionCol' style='".$FontClrAndWt."'>Region</th><th class='TerritoryCol' style='".$FontClrAndWt."'>Territory</th>".$Column_Hdngs."<th class='plan' style='".$FontClrAndWt."background-color:lightgreen'>Plan</th><th class='actual' style='".$FontClrAndWt."background-color:lightgreen'>Actual</th><th class='var' style='".$FontClrAndWt."background-color:lightgreen'>Variance</th><th class='varp' style='".$FontClrAndWt."background-color:lightgreen'>Variance%</th></tr>");
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
          		 $monthwisebudget_data = "";
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
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentCE'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentCE'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					}
					$bgnum++;
					$CmntNUm++;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTot = array_sum($VarianceTotal);
				//echo $row['CostElementName']." ".$pltot." ".$acttot." ".var_dump($pltot)." ".var_dump($acttot)."<br>";
					
				if($VarTot!=0){
					//echo $row['CostElementName']." ".$pltot." ".$acttot." ".var_dump($pltot)." ".var_dump($acttot)."<br>";
				$returndata[] = array('<tr class="costElementrow"><td></td><td  class="drilldown costElementdd costElement'.$rowno.'" data-cecode="'.$costElement.'" data-click="bdiv" data-class="costElement" data-elgroup="'.$expgroup.'" data-colval="'.$row['CostElementName'].'" data-drilldown="BDwisebudget" data-cellindex="'.$rowno.'" >'.$row['CostElementName'].'</td><td class="businessDivisionCol" ></td><td class="departmentCol"></td><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($PlanTotal)).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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

		       $monthwisebudget_data = "";
		    // echo $cegroup."<br>";
		       $bgnum = 2;
		       $CmntNUm = 1;
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
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentBD'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentBD'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					}
					$bgnum++;
					$CmntNUm++;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$returndata[] = array('<tr class="BusinessDivrow"><td></td><td></td><td class="drilldown BusinessDiv BusinessDiv'.$rowno.'" data-cecode="'.$costElement.'" data-click="dept"  data-elgroup="'.$expgroup.'"  data-class="BusinessDiv" data-colval="'.$bdiv.'" data-cellindex="'.$rowno.'" data-drilldown="Dwisebudget" >'.$bdiv.'</td><td class="departmentCol"><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
			$monthwisebudget_data='';
			$ccsql = "SELECT CostCenterCode FROM ".$costcentrtbl." WHERE BusinessDivision IN('".$bussdiv."') AND DepartmentName ='".$deptname."' AND  Division IN('".$division."') AND Region IN('".$region."') AND territory IN('".$territory."') GROUP BY CostCenterCode ";
			$ccres = sqlsrv_query($conn,$ccsql,array(), array( "Scrollable" => 'static' ));
					while($ccrow= sqlsrv_fetch_array($ccres)){ 
						$CostCenters[]=$ccrow['CostCenterCode'];
			}
		 	$ccntrs = implode("','", $CostCenters);
		      $bgnum=2;
		      $CmntNUm = 1;
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

						if ($bgnum % 2 == 0) {
						        $bgclrr="#e6eeff";
						 }else {
						         $bgclrr="";
						    }

						$PlanTotal[]=$row2['BudgetPlan'];
						$ActualTotal[]=$row2['BudgetActual'];
						$VarianceTotal[]=$variance;
						$VariancePTotal[]=$variancep;
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentDep'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentDep'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						//For  Monthwise Column Total
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."' >".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."' >".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."' >".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					}
					$bgnum++;
					$CmntNUm++;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$returndata[] = array('<tr class="Departmentrow"><td></td><td></td><td></td><td class="drilldown departmentCol Department Department'.$rowno.'" data-cecode="'.$costElement.'" data-click="div" data-elgroup="'.$expgroup.'"  data-class="Department" data-busdiv="'.$bussdiv.'" data-colval="'.$deptval.'" data-cellindex="'.$rowno.'" data-drilldown="Dwisebudget" >'.$deptname.'</td><td class="DivisionCol"></td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
		  	  $monthwisebudget_data = "";
		    // echo $cegroup."<br>";
		  	  // $loopStatus=false;
		  	  $bgnum = 2;
		  	  $CmntNUm = 1;
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
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentDv'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentDv'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					// }
					}
					$bgnum++;
					$CmntNUm++;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				// echo $lastelem;exit;
				$returndata[] = array('<tr class="Divisionrow"><td></td><td></td><td></td><td></td><td class="drilldown Division Division'.$rowno.'" data-cecode="'.$costElement.'" data-click="reg" data-elgroup="'.$expgroup.'"  data-busdiv="'.$bussdiv.'" data-dept="'.$dept.'" data-class="Division" data-cellindex="'.$rowno.'" data-colval="'.$cdiv.'" data-drilldown="Regwisebudget" >'.$cdiv.'</td><td class="RegionCol"></td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen" >'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
		  	  $bgnum = 2;
		  	  $CmntNUm = 1;
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
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentRgn'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentRgn'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					}
					$bgnum++;
					$CmntNUm++;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$returndata[] = array('<tr class="Regionrow"><td></td><td></td><td></td><td></td><td></td><td class="drilldown Region Region'.$rowno.'" data-elgroup="'.$expgroup.'" data-busdiv="'.$bussdiv.'" data-dept="'.$dept.'" data-div="'.$division.'" data-cecode="'.$costElement.'" data-click="terr" data-class="Region" data-cellindex="'.$rowno.'" data-colval="'.$creg.'" data-drilldown="Regwisebudget" >'.$creg.'</td><td class="TerritoryCol"></td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
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
		$territory = $getdata['terriotry'];
		$costElement = implode("','",$getdata['costElement']);
		$rowno=1;
		$territory =array();
		$lsql = "SELECT Territory FROM ".$costcentrtbl." WHERE BusinessDivision IN ('".$bussdiv."') AND DepartmentName IN('".$department."') AND Division IN('".$division."')  AND Region IN('".$region."') GROUP BY Territory";
		
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
		  	  $bgnum = 2;
		  	  $CmntNUm = 1;
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
						$ReviewModal = '<div><button class="btn" style="color:white;background-color:#02cf92" data-toggle="modal" data-target="#ReviewCommentTer'.$rowno.''.$CmntNUm.'">Comment</button><div class="modal fade" id="ReviewCommentTer'.$rowno.''.$CmntNUm.'" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="background-color:#02cf92"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:white;background-color:#02cf92">Comment Section</h4></div><div class="modal-body"><p><b>Enter Your Comment In Below Input</b></p><textarea id="ReviewText'.$rowno.''.$CmntNUm.'" class="form-control" rows="5" name=""></textarea></div><div class="modal-footer" style="background-color:#02cf92"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></div>';
						$monthwisebudget_data .="<td class='plan' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetPlan'])."</td><td class='actual' style='background-color:".$bgclrr."'>".moneyFormatIndia($row2['BudgetActual'])."</td><td class='var' style='background-color:".$bgclrr."'>".moneyFormatIndia($variance)."</td><td class='varp' style='background-color:".$bgclrr."'>".$variancep."</td><td class='ReviewRemark' style='background-color:".$bgclrr."'>".$ReviewModal."</td>";	
					}
					$bgnum++;
					$CmntNUm++;
				}
				$pltot = array_sum($PlanTotal);
				$acttot = array_sum($ActualTotal);
				$VarTott = array_sum($VarianceTotal);
					
				if($VarTott!=0){
				$returndata[] = array('<tr class="Territoryrow"><td></td><td></td><td></td><td></td><td></td><td></td><td class="drilldown Territory'.$rowno.'" data-elgroup="'.$expgroup.'" data-busdiv="'.$bussdiv.'" data-div="'.$division.'" data-reg="'.$region.'" data-cecode="'.$costElement.'"  data-class="Territory" data-colval="'.$cterr.'" >'.$cterr.'</td>'.$monthwisebudget_data.'<td class="plan" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($pltot).'</td><td class="actual" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia($acttot).'</td><td class="var" style="font-weight:bold;color:#000066;background-color:lightgreen">'.moneyFormatIndia(array_sum($VarianceTotal)).'</td><td class="varp" style="font-weight:bold;color:#000066;background-color:lightgreen">'.array_sum($VariancePTotal).'</td></tr>');
			$rowno++;
				}

		}
	}
	return $returndata;
}
?>