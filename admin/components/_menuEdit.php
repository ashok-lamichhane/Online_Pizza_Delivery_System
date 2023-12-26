<?php error_reporting(0);
    include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createItem'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $restaurantId = $_POST["restaurantId"];
        $price = $_POST["price"];

        $sql = "INSERT INTO `pizza_items` (`pizza_Name`, `pizza_Price`, `pizza_Description`, `pizza_res_id`, `pizza_AddDate`) VALUES ('$name', '$price', '$description', '$restaurantId', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $pizza_id = $conn->insert_id;
        if ($result){
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newName = 'pizza-'.$pizza_id;
                $newfilename=$newName .".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pizza-delivery/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
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
        else {
            echo "<script>alert('failed');
                    window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['removeItem'])) {
        $pizza_id = $_POST["pizza_id"];
        $sql = "DELETE FROM `pizza_items` WHERE `pizza_id`='$pizza_id'";   
        $result = mysqli_query($conn, $sql);
        $filename = $_SERVER['DOCUMENT_ROOT']."/pizza-delivery/img/pizza-".$pizza_id.".jpg";
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
    if(isset($_POST['updateItem'])) {
        $pizza_id = $_POST["pizza_id"];
        $pizza_Name = $_POST["name"];
        $pizza_Description = $_POST["desc"];
        $pizza_Price = $_POST["price"];
        $pizza_res_id = $_POST["resId"];

        $sql = "UPDATE `pizza_items` SET `pizza_Name`='$pizza_Name', `pizza_Price`='$pizza_Price', `pizza_Description`='$pizza_Description', `pizza_res_id`='$pizza_res_id' WHERE `pizza_id`='$pizza_id'";   
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
    if(isset($_POST['updateItemPhoto'])) {
        $pizza_id = $_POST["pizza_id"];
        $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'pizza-'.$pizza_id;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pizza-delivery/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
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