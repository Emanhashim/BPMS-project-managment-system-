
<?php

include('dbcon.php');

$query = '';
$output = array();
$query = "SELECT * FROM reference ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE Ref_num LIKE "%'.$_POST["search"]["value"].'%" OR Letter_title LIKE "%'.$_POST["search"]["value"].'%" OR date LIKE "%'.$_POST["search"]["value"].'%"';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row["Ref_num"];
 $sub_array[] = $row["Letter_title"];
 $sub_array[] = $row["date"];
 $sub_array[] = '<button type="button" name="view" id="'.$row["ID"].'" class="btn btn-primary btn-xs view">View</button>';
 $data[] = $sub_array;
}

function get_total_all_records($connect)
{
 $statement = $connect->prepare("SELECT * FROM reference");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records($connect),
 "data"    => $data
);
echo json_encode($output);
?>