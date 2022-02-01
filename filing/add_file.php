<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "minventory";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
$query = "SELECT invoiceid FROM sales ORDER BY invoiceid DESC";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$lastid = $row['invoiceid'];
if(empty($lastid))
{
    $number = "E/0000001";
}
else
{
    $idd = str_replace("E-", "", $lastid);
    $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
    $number = 'E-'.$id;
}
?>

<?php

if($_SERVER["REQUEST_METHOD"]== "POST")
{
    $invoiceid = $_POST['invoiceid'];
    $prodname = $_POST['prodname'];
    $price = $_POST['price'];

    if(!$conn)
    {
        die("connection failed " . mysqli_connect_error());
    }
    else
    {
        $sql = "insert into sales(invoiceid,prodname,price)VALUES('".$invoiceid."','".$prodname."','".$price."') ";
        if(mysqli_query($conn,$sql))
        {
            $query = "SELECT invoiceid FROM sales ORDER BY invoiceid DESC";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            $lastid = $row['invoiceid'];

            if(empty($lastid))
            {
                $number = "E-0000001";
            }
            else
            {
                $idd = str_replace("E-", "", $lastid);
                $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
                $number = 'E-'.$id;
            }

        }
        else
        {
            echo "Record Faileddd";
        }
    }
}
    ?>