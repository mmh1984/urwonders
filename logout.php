<?php
session_start();
session_destroy();
unset($_SESSION["usertype"]);
unset($_SESSION["username"]);
unset($_SESSION["userid"]);
header("location:index.php");
?>