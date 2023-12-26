<?php error_reporting(0);

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["loggedin"]);
unset($_SESSION["username"]);
unset($_SESSION["customer_id"]);

// session_unset();
// session_destroy();

header("location: /pizza-delivery/index.php");
?>