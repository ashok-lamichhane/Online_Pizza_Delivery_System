<?php error_reporting(0);
include 'connect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['customer_id'];
    
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $order_id = $_POST["order_id"];
    $message = $_POST["message"];
    $password = $_POST["password"];

    // Check user password is match or not
    $passSql = "SELECT * FROM system_users WHERE id='$customer_id'"; 
    $passResult = mysqli_query($conn, $passSql);
    $passRow=mysqli_fetch_assoc($passResult);
    
    if (password_verify($password, $passRow['password'])){
        $sql = "INSERT INTO `customer_message` (`customer_id`, `email`, `phone_num`, `order_id`, `message`, `time`) VALUES ('$customer_id', '$email', '$phone', '$order_id', '$message', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $contact_id = $conn->insert_id;
        echo '<script>alert("Thank you for contacting us. Your contact id is ' .$contact_id. '. We will contact you very soon.");
                    window.location.href="http://localhost/pizza-delivery/index.php";  
                    </script>';
                    exit();
    }
    else{
        echo "<script>alert('Password incorrect!!');
                window.history.back(1);
                </script>";
    }
    
}
?>