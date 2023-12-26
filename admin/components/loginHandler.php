<?php error_reporting(0);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'connect.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    $sql = "Select * FROM system_users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $user_group = $row['user_group'];
        if($user_group == 1) {
            $customer_id = $row['id'];
            if (password_verify($password, $row['password'])){ 
                session_start();
                $_SESSION['adminloggedin'] = true;
                $_SESSION['adminusername'] = $username;
                $_SESSION['admincustomer_id'] = $customer_id;
                header("location: /pizza-delivery/admin/index.php?loginsuccess=true");
                exit();
            } 
            else{
                header("location: /pizza-delivery/admin/login.php?loginsuccess=false");
            }
        }
        else {
            header("location: /pizza-delivery/admin/login.php?loginsuccess=false");
        }
    } 
    else{
        header("location: /pizza-delivery/admin/login.php?loginsuccess=false");
    }
}    
?>