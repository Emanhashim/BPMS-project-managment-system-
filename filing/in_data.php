


<?php

//insert_data.php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ref_num";
// $conn = mysqli_connect($servername,$username,$password,$dbname);
include('dbcon.php');

if(isset($_POST["Ref_num"]))
{
 $error = '';
 $success = '';
 $Ref_num = '';
 $Letter_title = '';
// $designation = '';
 $date = '';
 $images = '';
// $gender = $_POST["gender"];
 if(empty($_POST["Ref_num"]))
 {
  $error .= '<p>Ref_num is Required</p>';
 }
 else
 {
  $Ref_num = $_POST["Ref_num"];
 }
 if(empty($_POST["Letter_title"]))
 {
  $error .= '<p>Letter_title is Required</p>';
 }
 else
 {
  $Letter_title = $_POST["Letter_title"];
 }
 if(empty($_POST["date"]))
 {
  $error .= '<p>date is Required</p>';
 }
 else
 {
  $date = $_POST["date"];
 }

 if(isset($_FILES["images"]["name"]) && $_FILES["images"]["name"] != '')
 {
  $image_name = $_FILES["images"]["name"];
  $array = explode(".", $image_name);
  $extension = end($array);
  $temporary_name = $_FILES["images"]["tmp_name"];
  $allowed_extension = array("jpg","png",'pdf', 'docx');
  if(!in_array($extension, $allowed_extension))
  {
   $error .= '<p>Invalid Image</p>';
  }
  else
  {
   $images = rand() . '.' . $extension;
   move_uploaded_file($temporary_name, 'images/' . $images);
  }
 }
 if($error == '')
 {
  $data = array(
   ':Ref_num'   => $Ref_num,
   ':Letter_title'  => $Letter_title,
   ':images'  => $images,
   //':date' => $date,
   ':date' => date("Y-m-d"),
   //':date' => date("d-m-y"),
     
  );
  
  $query = "
  INSERT INTO reference 
  (Ref_num, Ref_path, Letter_title, date) 
  VALUES (:Ref_num, :images, :Letter_title, :date)
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'Reference Data Inserted';
 }
 if(mysqli_query($connect,$query))
 {
     $query = "SELECT Ref_num FROM reference ORDER BY Ref_num DESC";
     $result = mysqli_query($connect,$query);
     $row = mysqli_fetch_array($result);
     $lastid = $row['Ref_num'];

     if(empty($lastid))
     {
         $number = "B/0001";
     }
     else
     {
         $idd = str_replace("B/", "", $lastid);
         $id = str_pad($idd + 1, 4, 0, STR_PAD_LEFT);
         $number = 'B/'.$id;
     }

 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
