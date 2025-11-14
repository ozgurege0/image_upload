<?php
require_once("ayarlar/baglan.php");
require_once("../session.php");

if($fetch_profile["user_type"]!="admin"){
    header("Location:$url/");
    exit;
}