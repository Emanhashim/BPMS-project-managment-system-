<?php
include('db_connect.php');

if(isset($_POST['save']))
//   $file_name = '';
//   $file_code = '';
//    $issue_Date = '';
//     $images = '';
{	 
	 $file_name = $_POST['file_name'];
	 $file_code = $_POST['file_code'];
	 $issue_date = $_POST['issue_Date'];
     

                $statusMsg = '';

            // File upload path
            $targetDir = "images/";
            $fileName = basename($_FILES["images"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(isset($_POST["submit"]) && !empty($_FILES["images"]["name"])){
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["images"]["tmp_name"], $targetFilePath)){
                        // Insert image file name into database
                        $insert = $conn->query("INSERT into filing (file_name, file_code, issue_Date, f_data) VALUES ('".$fileName."','"file_name"' NOW())"); '".$file_name,$file_code,$issue_date, $images."");
                        if($insert){
                            $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                        }else{
                            $statusMsg = "File upload failed, please try again.";
                        } 
                    }else{
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                }
            }else{
                $statusMsg = 'Please select a file to upload.';
            }

            // Display status message
            echo $statusMsg;
       

?>
