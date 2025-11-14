<?php 
require_once("admin/ayarlar/baglan.php");

if(isset($_POST["submit"])){

   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$tableName = "messages";

$data = [
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'message' => $_POST['message'],
    'ip' => $ip
];

$success = insertIntoTable($tableName, $data, $db);

if ($success) {
  Header("Location:iletisim?job=success");
  exit;
} 
}

require_once("includes/header.php");
require_once("includes/navbar.php");
?>


<div class="container mt-5 mb-5">
  <?php if(@$_GET["job"]=="success"){ ?> 
    <div class="alert alert-success">Mesajınız alındı, en kısa süre içinde geri dönüş yapılacaktır.</div>
    <?php } ?>
    <h3 class="text-center">İletişim</h3>
    <div class="row">

        <div class="col-md-8 mt-3">
        <form action="" method="post">

            <div class="row">

            <div class="col-md-6 mt-3 banner">
                <input type="text" class="form-control" placeholder="Adınız.." name="name">
            </div>

             <div class="col-md-6 mt-3 banner">
                <input type="text" class="form-control" placeholder="Soyadınız.." name="surname">
            </div>

              <div class="col-md-6 mt-3 banner">
                <input type="email" class="form-control" placeholder="E-Mail Adresiniz.." name="email">
            </div>

             <div class="col-md-6 mt-3 banner">
                <input type="tel" class="form-control" placeholder="Telefon Numaranız.." name="phone">
            </div>

            <div class="col-md-12 mt-3">
                <textarea class="form-control" style="height: 100px;" name="message" placeholder="Mesajınız.."></textarea>
            </div>

            <div class="col-md-4 mt-3">
                <button class="btn btn-dark btn-lg mt-3" name="submit" type="submit">Gönder</button>
            </div>

            </div>

        </form>
        </div>

        <div class="col-md-4 mt-3">
            <?php foreach ($contacts as $get_contact) { ?>             
            <div class="card card-body text-center mx-auto shadow-sm mt-3">
                <div class="text-center mb-2"><i class="<?php echo $get_contact["icon"] ?>"></i></div>
                <h4><?php echo $get_contact["title"] ?></h4>
                <p><?php echo $get_contact["content"] ?></p>
            </div>
            <?php } ?>

     

        </div>

    </div>
</div>

<?php
require_once("includes/footer.php");
?>