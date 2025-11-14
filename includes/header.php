<?php
$design=$db->prepare("SELECT * FROM design where id=:id");
$design->execute(array(
  'id'=> 1
));
$designcek=$design->fetch(PDO::FETCH_ASSOC);

$banner_ads=$db->prepare("SELECT * FROM banner_ads where id=:id");
$banner_ads->execute(array(
  'id'=> 1
));
$banner_adscek=$banner_ads->fetch(PDO::FETCH_ASSOC);

$contacts=$db->prepare("SELECT * FROM contacts");
$contacts->execute();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $designcek["title"] ?></title>
    <meta name="description" content="<?php echo $designcek["metadesc"] ?>">
  <meta name="keywords" content="<?php echo $designcek["metakeyword"] ?>">
  <meta name="author" content="Dori Bilişim">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" crossorigin="anonymous">

  </head>