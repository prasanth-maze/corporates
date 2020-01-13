<?php 
    include '../auto_load.php';

 echo '<script type="text/javascript">
    window.location.replace("../pages/logout.php");
</script>';
exit;
if(isset($_REQUEST['submit'])){
    $name  = $_REQUEST['name'];
    $pno   = $_REQUEST['pno'];
    $addr  = $_REQUEST['addr'];
    
    
    $sqlss ="SELECT Count(*) As count FROM tbl_test";
    $sql_insertss = sqlsrv_query($conn,$sqlss);
    echo $row = sqlsrv_num_rows($sql_insertss);
    // echo $row['count'];
    // echo $sql_insert = sqlsrv_num_rows($sql_insertss);
    exit;


    $insert = "INSERT INTO tbl_test ( name, address) VALUES ('$name', '$addr')";
    // $insert = "CALL test_insert('$name', '$addr')";
    $sql_insert = sqlsrv_query($conn,$insert);
    if($sql_insert){
        Echo "T";
    }else{
        echo "F";
    }
}
$sql ="SELECT * FROM $emptbl";
$sql1 = sqlsrv_query($conn,$sql);

$test ="SELECT * FROM tbl_test";
$sql_test = sqlsrv_query($conn,$test);
?>
<select class="form-control form-control"  style="">
<option value=""> Select Employee </option>
<?php 
    while($row = sqlsrv_fetch_array($sql1)){
?>
    <option value="<?php echo $row['EMPLID']; ?>"> <?php echo $row['EMPLID']; ?> </option>
<?php } ?>
</select>
<table border="0">
    <form method="POST">
    <tr><td>
        <div class="form-group">
            <lable>Name : </lable>
    </td> <td><input type="text" name="name" value="" Placeholder="Name">
        </div>
    </td></tr>
    <tr><td>
        <div class="form-group">
            <lable>Phone No : </lable>
            </td> <td> <input type="text" name="pno" value="" Placeholder="Phone No">
        </div>
    </td></tr>
    <tr><td>
        <div class="form-group">
            <lable>Address : </lable>
            </td> <td><input type="text" name="addr" value="" Placeholder="Address">
        </div>
    </td></tr>
    <tr><td colspan="2">
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </td></tr>
    </form>
</table>
<table border='1'>
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Address</th>
</tr>
<?php
    $i = 1; 
    while($rows = sqlsrv_fetch_array($sql_test)){
?>
<tr>
    <td><?php echo $i;?></td>
    <td><?php echo $rows['name'];?></td>
    <td><?php echo $rows['address'];?></td>
</tr>
<?php $i++; } ?>
</table>
