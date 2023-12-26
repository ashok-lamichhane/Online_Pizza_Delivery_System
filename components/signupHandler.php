<?php error_reporting(0);
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'connect.php';
    $username = $_POST["username"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // Check whether this username exists
    $existSql = "SELECT * FROM `system_users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError = "Username Already Exists";
        header("Location: /pizza-delivery/index.php?signupsuccess=false&error=$showError");
    }
    else{
      if(($password == $cpassword)){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `system_users` ( `username`, `first_name`, `last_name`, `email`, `phone`, `password`, `reg_date`) VALUES ('$username', '$first_name', '$last_name', '$email', '$phone', '$hash', current_timestamp())";   
          $result = mysqli_query($conn, $sql);
          if ($result){
              $showAlert = true;
              header("Location: /pizza-delivery/index.php?signupsuccess=true");
          }
      }
      else{
          $showError = "Passwords do not match";
          header("Location: /pizza-delivery/index.php?signupsuccess=false&error=$showError");
      }
    }
}
    
?>