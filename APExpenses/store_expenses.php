<?php
include '../auto_load.php';
if(isset($_REQUEST['name'])){
    $name       = $_REQUEST['name'];
    $pno        = $_REQUEST['pno'];
    $address    = $_REQUEST['addr']; 

    // $insert = "INSERT INTO tbl_test ( name, address) VALUES ('$name','$addr')";
    $insert = "EXEC spINSB @name = '$name', @address = '$address'";
    $sql_insert = sqlsrv_query($conn,$insert);
    if($sql_insert){
        Echo "T";
    }else{
        echo "F";
    }
    exit;
/* 
    $sql = "EXEC spINSB @name = '$name', @address = '$address'";
    $stmt = sqlsrv_prepare($conn, $sql);



    $procedure_params = array(
        array(&$name, SQLSRV_PARAM_OUT),
        array(&$address, SQLSRV_PARAM_OUT)
        array(&$result, SQLSRV_PARAM_IN)
        );
        $sql = "EXEC spINSB @name = ?, @address = ?";
        $stmt = sqlsrv_prepare($conn, $sql, $procedure_params); */





    
    if (!sqlsrv_execute($stmt)) {
        echo "Your code is fail!";
        die;
    }else{
        echo "Your code is Sucess!";
        // $outseq = sqlsrv_free_stmt($stmt);
        // $outseq = sqlsrv_fetch_array($stmt);
        // echo $outseq['result'];


        // echo $stmt->sqlsrv_fetch_array()["result"] . "\n";
        // var_dump($stmt);
        // echo sqlsrv_next_result($stmt);  
        // $tst = sqlsrv_next_result($stmt);  
        // echo $tst['result'];
    }

}
?>