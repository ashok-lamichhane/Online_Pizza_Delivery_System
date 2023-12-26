<?php error_reporting(0);
    include 'connect.php';
    session_start();
    $customer_id = $_SESSION['customer_id'];
    
    
    if(isset($_POST["updateProfilePic"])){
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $newfilename = "person-".$customer_id.".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pizza-delivery/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('image upload failed, please try again.');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
                window.history.back(1);
            </script>';
        }
    }

    if(isset($_POST["updateProfileDetail"])){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password =$_POST["password"];

        $passSql = "SELECT * FROM system_users WHERE id='$customer_id'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        if (password_verify($password, $passRow['password'])){ 
            $sql = "UPDATE `system_users` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone` = '$phone' WHERE `id` ='$customer_id'";   
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>alert("Updated successfully.");
                        window.history.back(1);
                    </script>';
            }else{
                echo '<script>alert("Update failed, please try again.");
                        window.history.back(1);
                    </script>';
            } 
        }
        else {
            echo '<script>alert("Password is incorrect.");
                        window.history.back(1);
                    </script>';
        }
    }
    
    if(isset($_POST["removeProfilePic"])){
        $filename = $_SERVER['DOCUMENT_ROOT']."/pizza-delivery/img/person-".$customer_id.".jpg";
        if (file_exists($filename)) {
            unlink($filename);
            echo "<script>alert('Removed');
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>alert('no photo available.');
                window.location=document.referrer;
            </script>";
        }
    }
    
?>