
<?php

//fetch_single.php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ref_num";
// $connect = mysqli_connect($servername,$username,$password,$dbname);

include('dbcon.php');

if(isset($_GET["id"]))
{
 $query = "SELECT * FROM reference WHERE id = '".$_GET["id"]."'";

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<div class="row">';
 foreach($result as $row)
 {
  $images = '';
  if($row["Ref_path"] != '')
  {
   $images = '<img src="images/'.$row["Ref_path"].'" class="img-responsive img-thumbnail" />';
  }
  else
  {
   $images = '<img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g" class="img-responsive img-thumbnail" />';
  }
  $output .= '
  <div class="col-md-3">
   <br />
   '.$images.'
  </div>
  <div class="col-md-9">
   <br />
   <p><label>Ref_num :&nbsp;</label>'.$row["Ref_num"].'</p>
   <p><label>Letter_title :&nbsp;</label>'.$row["Letter_title"].'</p>
   
   <p><label>date :&nbsp;</label>'.$row["date"].'</p>
  </div>
  <p><label> click here  to download :&nbsp;</label>
  </div><br />
  ';
 }
 echo $output;
}

?>
