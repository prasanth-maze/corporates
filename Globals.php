<?php
	
	$emptbl = 'EmplTable';
	$pohqtbl = 'RASI_POHQTABLE';
	$tmtbl = 'Rasi_TMTable';
	$regtbl = 'Rasi_RegionTable';
	$zmtbl = 'Rasi_ZoneTable';
	$TRZMapping = 'RASI_TRZMAPPINGTABLE';
	$producttbl = 'APPRODUCTMASTER';
	$atypemaster = 'APACTIVITYTYPEMASTER';
	$subatypemaster = 'APSUBACTIVITYMASTER';
	$eventtbl = 'RASI_APEVENTTABLE';
	$eventlogtbl = 'RASI_APEVENTRECORDERLOGTABLE';
	$partytbl = "DIRPARTYTABLE";
	$villagetbl = "APVILLAGEMASTER";
	$hybridtbl = "HYBRIDTABLE";
	$costelemtbl = "Budget_CostElement_19_20_SAP";
	$costcentrtbl = "Budget_CostCenter_19_20_SAP";
	$budgetexptbl = "Budget_Expense_19_20_SAP";
	$costcentrelmtbl = "Budget_CostCenter_CostElement_19_20_SAP";
	$BRoleMappingtbl = 'Budget_Role_Mapping';
	$budgetCmntTable = "Budget_Expense_Comments";

	// ANP Advance Request And Expenses
	$advreques = "ANP_Advance";



	function sortbyval($arr,$bykey=''){
		foreach ($arr as $key => $row)
		{
		    $retarr[$key] = $row[$bykey];
		}

		return $retarr;
	}

	function calcAttendance($tot,$lin,$nlin){
		if($tot==0){
				$tot=1;
		}
	/*$NAbsent = $tot - $lin;
	$PR	=	($lin/$tot)*100;
	$AB = 100 - $PR;*/

	$PR = round((($lin/$tot)*10),1,2);
	$AB = round((($nlin/$tot)*10),1,2);
		return(array('PR'=>$PR,"AB"=>$AB));
	}
	
	function moneyFormatIndia($number) {
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return $result;
    }
    // Gdet Months
    function getMonths($from,$to){
    	$marr = array();
    	$start    = (new DateTime($from))->modify('first day of this month');
		$end      = (new DateTime($to))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);

		foreach ($period as $dt) {
			$marr[] = $dt->format("Y-m");
		    //echo $dt->format("Y-m") . "<br>\n";
		}
		return $marr;

    }
	
?>