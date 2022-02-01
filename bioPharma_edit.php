<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM pharma where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'bioPharma_new_file.php';
?>