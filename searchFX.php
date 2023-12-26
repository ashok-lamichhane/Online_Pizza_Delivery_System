<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Home</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
    <style>
    #cont {
        min-height : 515px;
    }
    </style>
</head>
<body>
    <?php error_reporting(0); include 'components/connect.php';?>
    <?php error_reporting(0); require 'components/pilot.php' ?>

    <div class="container my-3">
        <h2 class="py-2">Search Result for <em>"<?php error_reporting(0); echo $_GET['search']?>"</em> :</h2>
        <h3><span id="res" class="py-2"></span></h3>
        <div class="row">
        <?php error_reporting(0); 
            $noResult = true;
            $query = $_GET["search"];
            $sql = "SELECT * FROM `restaurants` WHERE MATCH(res_Name, res_Description) against('$query')";
 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                ?><script> document.getElementById("res").innerHTML = "Restaurant: ";</script> <?php error_reporting(0); 
                $noResult = false;
                $resId = $row['res_id'];
                $resname = $row['res_Name'];
                $resdesc = $row['res_Description'];
                
                echo '<div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/card-'.$resId. '.jpg" class="card-img-top" alt="image for this pizza" width="249px" height="270px">
                        <div class="card-body">
                            <h5 class="card-title"><a href="pizzaListDisp.php?resid=' . $resId . '">' . $resname . '</a></h5>
                            <p class="card-text">' . substr($resdesc, 0, 29). '...</p>
                            <a href="pizzaListDisp.php?resid=' . $resId . '" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                </div>';
            }
        ?>
        </div>
    </div>

    <div class="container my-3" id="cont">
        <h3><span id="iteam" class="py-2"></span></h3>
        <div class="row">
        <?php error_reporting(0); 
            $query = $_GET["search"];
            $sql = "SELECT * FROM `pizza_items` WHERE MATCH(pizza_Name, pizza_Description) against('$query')"; 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                ?><script> document.getElementById("iteam").innerHTML = "Items: ";</script> <?php error_reporting(0);
                $noResult = false;
                $pizza_id = $row['pizza_id'];
                $pizza_Name = $row['pizza_Name'];
                $pizza_Price = $row['pizza_Price'];
                $pizza_Description = $row['pizza_Description'];
                $pizza_res_id = $row['pizza_res_id'];
                
                echo '<div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/pizza-'.$pizza_id. '.jpg" class="card-img-top" alt="image for this pizza" width="249px" height="270px">
                        <div class="card-body">
                            <h5 class="card-title">' . substr($pizza_Name, 0, 20). '...</h5>
                            <h6 style="color: #ff0000">Tk. '.$pizza_Price. '/-</h6>
                            <p class="card-text">' . substr($pizza_Description, 0, 29). '...</p>
                            <div class="row justify-content-center">';
                                if($loggedin){
                                    $quaSql = "SELECT `quantity` FROM `cart` WHERE pizza_id = '$pizza_id' AND `customer_id`='$customer_id'";
                                    $quaresult = mysqli_query($conn, $quaSql);
                                    $quaExistRows = mysqli_num_rows($quaresult);
                                    if($quaExistRows == 0) {
                                        echo '<form action="components/cartEdit.php" method="POST">
                                              <input type="hidden" name="itemId" value="' .$pizza_id. '">
                                              <button type="submit" name="addToCart" class="btn btn-primary mx-2">Add to Cart</button>';
                                    }else {
                                        echo '<a href="cartDisp.php"><button class="btn btn-primary mx-2">Go to Cart</button></a>';
                                    }
                                }
                                else{
                                    echo '<button class="btn btn-primary mx-2" data-toggle="modal" data-target="#loginModal">Add to Cart</button>';
                                }
                                echo '</form>
                                <a href="pizzaDisp.php?pizzaid=' . $pizza_id . '"><button class="btn btn-primary">Quick View</button></a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            if($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1>Your search - <em>"' .$_GET['search']. '"</em> - No Result Found.</h1>
                        <p class="lead"> Suggestions: <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li></ul>
                        </p>
                    </div>
                </div> ';
            }
        ?>
        </div>
    </div>

    <?php error_reporting(0); require 'components/pageFooter.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>