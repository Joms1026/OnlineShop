<?php
session_start();
$totalfull = $_POST["totals"];
$shippingtype = $_POST["shippingtype"];
$_SESSION["total"] = $totalfull;
$_SESSION["shipping"] = $shipping;
?>