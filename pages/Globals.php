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
	
?>