<?php
include '../auto_load.php';
$sno = 1;

$data = parse_str($_POST['filterData'], $postdata);
//p($postdata,'E');
$postdata['zmLocation']='All';
$dataarr = array();
$pdiv = $postdata['pdivision'];
	if(isset($_POST['Action'])){
		$action = $_POST['Action'];
		if($action=='ZONEDET'){
				$sql = "SELECT * FROM ".$zmtbl." ";
				$addand = $cond = "";
				if($pdiv!='All'){
					$cond .= " DATAAREAID='".$pdiv."' ";
					$addand = ' AND ';
				}
				if($postdata['zmLocation']!='All'){
						$cond .= $addand." ZONEID='".$postdata['zmLocation']."' ";
						$addand = ' AND ';
				}
				if($cond!="")
					$sql .= " WHERE  ".$cond;
				
				$q = sqlsrv_query($conn,$sql);
				
				while ($zres=sqlsrv_fetch_array($q,SQLSRV_FETCH_ASSOC)) {
					$dataarr[] = array($sno++,$zres['DBMID'],$zres['DBMNAME'],$zres['ZONEID'],$zres['ZONENAME'],$zres['EMAIL']);
				}
		}

		if($action=='REGIONDET'){
					$cond = "";
					$sql = "SELECT ZONEID,ZONENAME FROM ".$zmtbl." ";
					
					if($pdiv!='All'){
						$cond .= " DATAAREAID='".$pdiv."' ";
						$addand = ' AND ';
					}

					if(@$postdata['zmLocation']!='All' && @$postdata['zmLocation']!=''){
							$cond .= $addand." ZONEID='".$postdata['zmLocation']."' ";
							$addand = ' AND ';
					}
					if($cond!="")
						$sql .= " WHERE  ".$cond." ";
					$sql .=" GROUP BY ZONEID,ZONENAME";
					
					$q = sqlsrv_query($conn,$sql);					
					while ($zres=sqlsrv_fetch_array($q,SQLSRV_FETCH_ASSOC)) {
						$zoneid = $zres['ZONEID'];
						$zonename = $zres['ZONENAME'];
						$sql1 = "SELECT M.REGIONID FROM ".$TRZMapping." AS M WHERE ZONEID='".$zoneid."' GROUP BY M.REGIONID  ";
						//echo $sql1;exit;
						$q1 = sqlsrv_query($conn,$sql1);	
						while($mreg=sqlsrv_fetch_array($q1,SQLSRV_FETCH_ASSOC)){
							
							$sql2 = "SELECT REG.* FROM  ".$regtbl." AS REG WHERE REG.REGIONID='".$mreg['REGIONID']."'  ";
							$q2 = sqlsrv_query($conn,$sql2);	
							while($regres = sqlsrv_fetch_array($q2,SQLSRV_FETCH_ASSOC)){
								$dataarr[] = array($sno++,$regres['RBMID'],$regres['EMPLNAME'],$regres['REGIONID'],$regres['REGIONNAME'],$regres['STATEID'],$zoneid,$zonename);
							}
						}
					}
		}

		if($action=='TMDET'){
			$cond = "";
			$sql = "SELECT M.TMID,M.TMNAME,M.REGIONID,M.ZONEID,(SELECT TOP 1  REG.REGIONNAME FROM ".$regtbl." AS REG WHERE REG.REGIONID=M.REGIONID ) AS REGIONNAME,(SELECT TOP 1  Z.ZONENAME FROM ".$zmtbl." AS Z WHERE Z.ZONEID=M.ZONEID ) AS ZONENAME FROM ".$TRZMapping." AS M  ";
			if($pdiv!='All'){
				$cond .= " M.DATAAREAID='".$pdiv."' ";
				$addand = ' AND ';
			}

			if(@$postdata['zmLocation']!='All' && @$postdata['zmLocation']!=''){
					$cond .= $addand." M.ZONEID='".$postdata['zmLocation']."' ";
					$addand = ' AND ';
			}

			if(@$postdata['rbmLocation']!='All' && @$postdata['rbmLocation']!=''){
					$cond .= $addand." M.REGIONID='".$postdata['rbmLocation']."' ";
					$addand = ' AND ';
			}
			if($cond!="")
			$sql .= " WHERE  ".$cond." ";
		$sql .=" GROUP BY M.TMID,M.TMNAME,M.ZONEID,M.REGIONID ORDER BY M.TMNAME";
			
			$q = sqlsrv_query($conn,$sql);					
			while ($mres=sqlsrv_fetch_array($q,SQLSRV_FETCH_ASSOC)) {
					$sql2 = "SELECT * FROM ".$tmtbl." WHERE TMID='".$mres['TMID']."' ";
					$q2 = sqlsrv_query($conn,$sql2);					
					while ($tmres=sqlsrv_fetch_array($q2,SQLSRV_FETCH_ASSOC)) {
						//$sql3 = "SELECT REGIONNAME FROM ".$regtbl." WHERE REGIONID='".."' ";
						$dataarr[] = array($sno++,$tmres['TMID'],$tmres['TMNAME'],$tmres['EMPLID'],$tmres['EMPLNAME'],$tmres['EMAIL'],$tmres['STATEID'],$mres['REGIONID'],$mres['REGIONNAME'],$mres['ZONEID'],$mres['ZONENAME']);
					}
			}

			
		}

		if($action=='POHQDET'){
			$cond ="";
			$sql ="SELECT POHQ.* FROM  ".$pohqtbl."  AS POHQ ";
			if($pdiv!='All'){
				$cond .= " POHQ.DATAAREAID='".$pdiv."' ";
			}
			if($cond!="")
			$sql .= " WHERE  ".$cond." ";

			$q = sqlsrv_query($conn,$sql);
			while ($pohqes=sqlsrv_fetch_array($q,SQLSRV_FETCH_ASSOC)) {
				$sql1 = "SELECT TOP 1 M.TMID,M.TMNAME,M.REGIONID,M.ZONEID,(SELECT TOP 1  REG.REGIONNAME FROM ".$regtbl." AS REG WHERE REG.REGIONID=M.REGIONID ) AS REGIONNAME,(SELECT TOP 1  Z.ZONENAME FROM ".$zmtbl." AS Z WHERE Z.ZONEID=M.ZONEID ) AS ZONENAME FROM ".$TRZMapping." AS M WHERE M.TMID='".$pohqes['TMID']."' ";
				
				$q1 = sqlsrv_query($conn,$sql1);
				while ($mres=sqlsrv_fetch_array($q1,SQLSRV_FETCH_ASSOC)) {

					$dataarr[] = array($sno++,utf8_encode($pohqes['STATEID']),utf8_encode($pohqes['POHQCODE']),utf8_encode($pohqes['POHQNAME']),utf8_encode($pohqes['POCODE']),utf8_encode($pohqes['PONAME']),utf8_encode($pohqes['PASSWORD']),utf8_encode($pohqes['VACANT']),$pohqes['TMID'],$pohqes['TMNAME'],$mres['REGIONID'],$mres['REGIONNAME'],$mres['ZONEID'],$mres['ZONENAME']);

				}
			}
		}

		if($action=='VILLAGEDET'){
			$cond ="";
			$sql ="SELECT TOP 100000 V.POHQCODE,V.TMCODE,V.VILLAGENAME,POHQ.TMID,POHQ.TMNAME,M.ZONEID,(SELECT TOP 1 Z.ZONENAME FROM ".$zmtbl." AS Z WHERE M.ZONEID=Z.ZONEID) AS ZONENAME,M.REGIONID,(SELECT TOP 1 R.REGIONNAME FROM ".$regtbl." AS R WHERE R.REGIONID=M.REGIONID) AS REGIONNAME FROM  ".$villagetbl."  AS  V JOIN ".$pohqtbl." AS POHQ ON POHQ.POHQCODE=V.POHQCODE JOIN ".$TRZMapping."  AS M ON M.TMID=POHQ.TMID ";

			
			$cond .= " V.DATAAREAID='".$pdiv."' ";

			$sql .= " WHERE  ".$cond." ";
			
			//echo $sql;exit;
			$q = sqlsrv_query($conn,$sql);
			while ($vres=sqlsrv_fetch_array($q,SQLSRV_FETCH_ASSOC)) {
				//p($vres,'e');
				$dataarr[] = array($sno++,utf8_encode($vres['POHQCODE']),utf8_encode($vres['TMCODE']),utf8_encode($vres['VILLAGENAME']),utf8_encode($vres['TMID']),utf8_encode($vres['TMNAME']),utf8_encode($vres['REGIONID']),utf8_encode($vres['REGIONNAME']),utf8_encode($vres['ZONEID']),utf8_encode($vres['ZONENAME']));
			}
			//p($dataarr,'e');
		}

		if($action=='USERINFO'){
			$cond ="";
			$sql ="SELECT * FROM  ".$emptbl."  ";
			if($pdiv!='All'){
				//$cond .= " DATAAREAID='".$pdiv."' ";
			}
			//$sql .= " WHERE  ".$cond." ";
			
			$q = sqlsrv_query($conn,$sql);
			while ($ures=sqlsrv_fetch_array($q,SQLSRV_FETCH_ASSOC)) {
				$dataarr[] = array($sno++,utf8_encode($ures['EMPLID']),utf8_encode($ures['PASSWORD']),utf8_encode($ures['USERSTATUS']),utf8_encode($ures['APDESIGN']),utf8_encode($ures['DIVISION']));
			}
		}

	}

		$found = count($dataarr);
		$data1['draw'] = $found;
        $data1['recordsTotal'] = $found;
        $data1['recordsFiltered'] = $found;
        $res['data'] = $dataarr;
echo json_encode($res);
?>