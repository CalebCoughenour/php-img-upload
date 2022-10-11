<?php

session_start();
include_once 'dbh.php';
$id = $_SESSION['id'];

// this checks if the button named submit has been clicked
if (isset($_POST['submit'])) {
  // _FILES[] targets the submitted file from the form name file
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  // explode() separates file name from punctuation
  $fileExt = explode('.', $fileName);
  // end() gets the last piece of data from an array (our extension/file type)
  $fileActualExt = strtolower(end($fileExt));

  // Condition to check if file is not allowed
  $allowed = array('jpg', 'jpeg', 'png', 'gif');

  // in_array() checks if something is in the array
  if (in_array($fileActualExt, $allowed)) {

    // check if error message
    if ($fileError == 0) {
      
      // check if file is less than 1mb
      if ($fileSize < 1000000) {

        // start uploading file

        // names file something unique so names won't be overwritten also appends file type to end
        $fileNameNew = "profile".$id.".".$fileActualExt;
        // set path for uploading file
        $fileDestination = 'uploads/'.$fileNameNew;

        move_uploaded_file($fileTmpName, $fileDestination);
        $sql = "UPDATE profileimg SET status=0 WHERE userid='$id'";
        $result = mysqli_query($conn, $sql);
        header("Location: index.php?uploadsuccess");

      } else {
        echo "You file was too large! Please try again!";
      }
    } else {
      echo "There was an error uploading your file!";
    }

  } else {
    echo "You can not upload this file type!";
  }

}