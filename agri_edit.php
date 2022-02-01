<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM agriculture where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'agri_new_file.php';
?>