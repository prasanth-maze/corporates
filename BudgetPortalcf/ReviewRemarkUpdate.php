<?php
include '../auto_load.php';
global $conn;
global $budgetCmntTable;
if(isset($_POST['Action'])){

	$tsql = "INSERT INTO ".$budgetCmntTable." (comments) VALUES ('".$_POST['Action']."')";    
	$stmt = sqlsrv_query( $conn, $tsql);    
	if ( $stmt )    
	{    
	    echo "Submission successful.";
	}     
	else     
	{    
	    echo "Submission unsuccessful.";
	    die( print_r( sqlsrv_errors(), true));    
	}
	/* Free statement and connection resources. */  
	// sqlsrv_free_stmt($stmt);  
	// sqlsrv_close($conn);  
	}

?>