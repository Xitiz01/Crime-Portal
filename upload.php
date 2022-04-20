<?php
if(isset($_POST['submit']))
{
    $file=$_FILES['file'];
    // print_r($file);

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg', 'jpeg', 'png');
    
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'upload/'.$fileNameNew;
                if(move_uploaded_file($fileTmpName, $fileDestination)){
                    header("Location:complainer_page.php?uploadsuccess");
                }
                else{
                    echo "Error uploading file";
                }
                // move_uploaded_file($fileTmpName, $fileDestination);
                // // header("Location:complainer_page.php?uploadsuccess");
            }else{
                echo "Your file is too big! Try less than 1MB";
            }
        }else{
            echo "There was an error uploading your file!";
        }
    } 
    else {
        echo "You cannot upload files of this type!";
    }
}