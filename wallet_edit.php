<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM wallet where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'wallet_new_file.php';
?>