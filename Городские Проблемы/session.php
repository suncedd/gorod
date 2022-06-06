<?php
session_start(); // старт сессии
$_SESSION["message_true"] = false;
$_SESSION["message_false"] = false;
$_SESSION["message_delete"] = false;
$_SESSION["message_accept"] = false;
$_SESSION["message_reject"] = false;
$_SESSION["message_accpet_cat"] = false;
$_SESSION["message_delete_cat"] = false;

$_SESSION["user_name"] = "0";
$_SESSION["user_id"] = "0";
$_SESSION["check_login"] = "0";
$_SESSION["check_status"] = "0";
$_SESSION["check_load"] = false;
?>