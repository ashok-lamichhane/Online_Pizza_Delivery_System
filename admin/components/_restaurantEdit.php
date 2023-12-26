<?php error_reporting(0);
    include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['regRestaurant'])) {
        $name = $_POST["name"];
        $desc = $_POST["desc"];

        $sql = "INSERT INTO `restaurants` (`res_Name`, `res_Description`, `res_RegDate`) VALUES ('$name', '$desc', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $resId = $conn->insert_id;
        if($result) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newfilename = "card-".$resId.".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pizza-delivery/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('success');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('failed to upload image');
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>alert("Please select an image file to upload.");
                    </script>';
            }
        }
    }
    if(isset($_POST['removeRestaurant'])) {
        $resId = $_POST["resId"];
        $filename = $_SERVER['DOCUMENT_ROOT']."/pizza-delivery/img/card-".$resId.".jpg";
        $sql = "DELETE FROM `restaurants` WHERE `res_id`='$resId'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>alert('Removed');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateRestaurant'])) {
        $resId = $_POST["resId"];
        $resName = $_POST["name"];
        $resDesc = $_POST["desc"];

        $sql = "UPDATE `restaurants` SET `res_Name`='$resName', `res_Description`='$resDesc' WHERE `res_id`='$resId'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('update');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateResPhoto'])) {
        $resId = $_POST["resId"];
        $check = getimagesize($_FILES["resimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'card-'.$resId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pizza-delivery/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['resimage']['tmp_name'], $uploadfile)) {
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
}
?>