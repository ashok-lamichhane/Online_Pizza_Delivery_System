<?php error_reporting(0);
    include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['updateStatus'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        $sql = "UPDATE `orders` SET `order_Status`='$status' WHERE `order_id`='$order_id'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('update successfully');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    
    if(isset($_POST['updateDeliveryDetails'])) {
        $trackId = $_POST['trackId'];
        $order_id = $_POST['order_id'];
        $name = $_POST['name'];
        $time = $_POST['time'];
        $phone = $_POST['phone'];
        if($trackId == NULL) {
            $sql = "INSERT INTO `delivery_info` (`order_id`, `deliveryMan_Name`, `deliveryMan_phone_num`, `time_mins`, `date_time`) VALUES ('$order_id', '$name', '$phone', '$time', current_timestamp())";   
            $result = mysqli_query($conn, $sql);
            $trackId = $conn->insert_id;
            if ($result){
                echo "<script>alert('update successfully');
                    window.location=document.referrer;
                    </script>";
            }
            else {
                echo "<script>alert('failed');
                    window.location=document.referrer;
                    </script>";
            }
        }
        else {
            $sql = "UPDATE `delivery_info` SET `deliveryMan_Name`='$name', `deliveryMan_phone_num`='$phone', `time_mins`='$time',`date_time`=current_timestamp() WHERE `id`='$trackId'";   
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>alert('update successfully');
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
}

?>