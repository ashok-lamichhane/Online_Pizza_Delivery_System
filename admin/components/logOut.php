<?php error_reporting(0);

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["adminloggedin"]);
unset($_SESSION["adminusername"]);
unset($_SESSION["admincustomer_id"]);

// session_unset();
// session_destroy();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
