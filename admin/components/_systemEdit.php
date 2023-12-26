<?php error_reporting(0);
    include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['updateDetail'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $sys_Contact01 = $_POST["sys_Contact01"];
        $contact2 = $_POST["contact2"];
        $addr = $_POST["address"];


        $sql = "UPDATE `system_info` SET sys_Name = '$name' WHERE interim_id = 1";   
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE `system_info` SET email = '$email' WHERE interim_id = 1";   
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE `system_info` SET sys_Contact01 = '$sys_Contact01' WHERE interim_id = 1";   
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE `system_info` SET contact2 = '$contact2' WHERE interim_id = 1";   
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE `system_info` SET `address` = '$addr' WHERE interim_id = 1";   
        $result = mysqli_query($conn, $sql);
        
        if($result){
            echo "<script>alert('success');
                window.location=document.referrer;
                </script>";
        }    
    }
    
}
?>