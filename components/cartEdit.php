<?php error_reporting(0);
include 'connect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['customer_id'];
    if(isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];
        // Check whether this item exists
        $existSql = "SELECT * FROM `cart` WHERE pizza_id = '$itemId' AND `customer_id`='$customer_id'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Item Already Added.');
                    window.history.back(1);
                    </script>";
        }
        else{
            $sql = "INSERT INTO `cart` (`pizza_id`, `quantity`, `customer_id`, `add_date`) VALUES ('$itemId', '1', '$customer_id', current_timestamp())";   
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>
                    window.history.back(1);
                    </script>";
            }
        }
    }
    if(isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `cart` WHERE `pizza_id`='$itemId' AND `customer_id`='$customer_id'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
                window.history.back(1);
            </script>";
    }
    if(isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `cart` WHERE `customer_id`='$customer_id'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed All');
                window.history.back(1);
            </script>";
    }
    if(isset($_POST['checkout'])) {
        $order_amount = $_POST["order_amount"];
        $address1 = $_POST["address"];
        $address2 = $_POST["address1"];
        $phone = $_POST["phone"];
        $zipcode = $_POST["zipcode"];
        $password = $_POST["password"];
        $address = $address1.", ".$address2;
        
        $passSql = "SELECT * FROM system_users WHERE id='$customer_id'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        $userName = $passRow['username'];
        if (password_verify($password, $passRow['password'])){ 
            $sql = "INSERT INTO `orders` (`customer_id`, `address`, `zip_code`, `phone_num`, `order_amount`, `payment_Method`, `order_Status`, `order_Date`) VALUES ('$customer_id', '$address', '$zipcode', '$phone', '$order_amount', '0', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $order_id = $conn->insert_id;
            if ($result){
                $addSql = "SELECT * FROM `cart` WHERE customer_id='$customer_id'"; 
                $addResult = mysqli_query($conn, $addSql);
                while($addrow = mysqli_fetch_assoc($addResult)){
                    $pizza_id = $addrow['pizza_id'];
                    $quantity = $addrow['quantity'];
                    $itemSql = "INSERT INTO `ordered_items` (`order_id`, `pizza_id`, `quantity`) VALUES ('$order_id', '$pizza_id', '$quantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                }
                $deletesql = "DELETE FROM `cart` WHERE `customer_id`='$customer_id'";   
                $deleteresult = mysqli_query($conn, $deletesql);
                echo '<script>alert("Thank you for ordering from us. Your order id is ' .$order_id. '.");
                    window.location.href="http://localhost/pizza-delivery/index.php";  
                    </script>';
                    exit();
            }
        } 
        else{
            echo '<script>alert("Incorrect Password! Please enter correct Password.");
                    window.history.back(1);
                    </script>';
                    exit();
        }    
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $pizza_id = $_POST['pizza_id'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `cart` SET `quantity`='$qty' WHERE `pizza_id`='$pizza_id' AND `customer_id`='$customer_id'";
        $updateresult = mysqli_query($conn, $updatesql);
    }
    
}
?>