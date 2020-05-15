<?php
session_start();
$_SESSION["shipping"] = $_POST["shipping"];
$_SESSION["total"] = $_POST["finaltotal"];
echo "jalan";
?>