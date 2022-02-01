<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM gaz where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'gaz_new_file.php';
?>