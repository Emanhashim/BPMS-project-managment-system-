<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ref_num";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
$query = "SELECT Ref_num FROM reference ORDER BY Ref_num DESC";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$lastid = $row ['Ref_num'];

if ( empty ($lastid)){
$num = "B/0001";    
}
else {
$idd = str_replace ("B/", " ", $lastid);
$id = str_pad($idd + 1, 4, 0,   STR_PAD_LEFT);
$num = 'B/' .$id ;
}

 ?>   

<div class="form-group">
 <label>Enter refrenc number</label>
 <input type="text" name="Ref_num" id="Ref_num" value=" <?php echo $num; ?>" readonly class="form-control" />
</div>
<div class="form-group">
<label>Enter latter title</label>
 <input type="text" name="Letter_title" id="Letter_title" class="form-control" />
</div>
<div class="form-group">
 <label>Select files</label>
 <input type="file" name="images" id="images" />
</div>
<!-- <div class ="form-group">
<label> select date</label>
<input placeholder="Published Date" type="date" id="date-picker-example" class="form-control datepicker" name="date" required>
</div> -->

