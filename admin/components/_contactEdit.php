<?php error_reporting(0);
    include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['admin_reply'])) {
        $contact_id = $_POST['contact_id'];
        $message = $_POST['message'];
        $customer_id = $_POST['customer_id'];
        
        $sql = "INSERT INTO `admin_reply` (`contact_id`, `customer_id`, `message`, `date_time`) VALUES ('$contact_id', '$customer_id', '$message', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script>alert('success');
                    window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                    window.location=document.referrer;
                </script>";
        }
    }
}
?>