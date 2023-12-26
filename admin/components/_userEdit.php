<?php error_reporting(0);
    include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['removeUser'])) {
        $Id = $_POST["Id"];
        $sql = "DELETE FROM `system_users` WHERE `id`='$Id'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
            window.location=document.referrer;
            </script>";
    }
    
    if(isset($_POST['createUser'])) {
        $username = $_POST["username"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $user_group = $_POST["user_group"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        
        // Check whether this username exists
        $existSql = "SELECT * FROM `system_users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Username Already Exists');
                    window.location=document.referrer;
                </script>";
        }
        else{
            if(($password == $cpassword)){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `system_users` ( `username`, `first_name`, `last_name`, `email`, `phone`, `user_group`, `password`, `reg_date`) VALUES ('$username', '$first_name', '$last_name', '$email', '$phone', '$user_group', '$hash', current_timestamp())";   
                $result = mysqli_query($conn, $sql);
                if ($result){
                    echo "<script>alert('Success');
                            window.location=document.referrer;
                        </script>";
                }else {
                    echo "<script>alert('Failed');
                            window.location=document.referrer;
                        </script>";
                }
            }
            else{
                echo "<script>alert('Passwords do not match');
                    window.location=document.referrer;
                </script>";
            }
        }
    }
    if(isset($_POST['editUser'])) {
        $id = $_POST["customer_id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $user_group = $_POST["user_group"];

        $sql = "UPDATE `system_users` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `phone`='$phone', `user_group`='$user_group' WHERE `id`='$id'";   
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
    
    if(isset($_POST['updateProfilePhoto'])) {
        $id = $_POST["customer_id"];
        $check = getimagesize($_FILES["userimage"]["tmp_name"]);
        if($check !== false) {
            $newfilename = "person-".$id.".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pizza-delivery/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('failed');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
    
    if(isset($_POST['removeProfilePhoto'])) {
        $id = $_POST["customer_id"];
        $filename = $_SERVER['DOCUMENT_ROOT']."/pizza-delivery/img/person-".$id.".jpg";
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
}
?>