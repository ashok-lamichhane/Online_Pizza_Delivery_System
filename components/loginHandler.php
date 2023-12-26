<?php error_reporting(0);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'connect.php';
    $username = $_POST["loginusername"];
    $password = $_POST["loginpassword"]; 
    
    $sql = "Select * FROM system_users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $customer_id = $row['id'];
        if (password_verify($password, $row['password'])){ 
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['customer_id'] = $customer_id;
            header("location: /pizza-delivery/index.php?loginsuccess=true");
            exit();
        } 
        else{
            header("location: /pizza-delivery/index.php?loginsuccess=false");
        }
    } 
    else{
        header("location: /pizza-delivery/index.php?loginsuccess=false");
    }
}    
?>