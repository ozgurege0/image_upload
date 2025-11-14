<?php 
require_once("admin/ayarlar/baglan.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$img = uploadImage('img');

if ($img) {
}else{
header("Location:$url/?job=ext");
           exit;
}

$token = md5(uniqid(rand(), true));
        $data = [
            'img'   => $img,
            'token' => $token, // benzersiz token
            'tarih' => date('Y-m-d H:i:s'),
            'ip'    => $_SERVER['REMOTE_ADDR']
        ];

        $insert = insertIntoTable('images', $data, $db);

        if ($insert) {
           header("Location:$url/image_upload?token=$token");
           exit;
        }
}

require_once("includes/header.php");
require_once("includes/navbar.php");
?>




<div class="container mt-5">
  <?php if(@$_GET["job"]=="ext"){ ?> 
    <div class="alert alert-danger">Dosya uzantısı geçerli değil, yalnızca şu uzantılara izin verilir: 'jpg', 'jpeg', 'png', 'gif', 'webp'</div>
    <?php } ?>
    <h3 class="text-center">Resim Yükle</h3>

<!-- ✅ Form -->
<form action="" method="post" enctype="multipart/form-data">
  <div>
    <input class="form-control form-control-lg" id="formFileLg" type="file" name="img" required>
    <div class="text-center">
        <button class="btn btn-primary btn-lg mt-3" type="submit">Yükle</button>
    </div>
  </div>
</form>

</div>

  <div class="container content mt-5 mb-5">
    <div class="card text-center shadow">
        <div class="card-body">
        <h3><?php echo $designcek["home_title"] ?></h3>
        <p><?php echo html_entity_decode($designcek["home_content"]) ?>
        </p>
        </div>
    </div>
  </div>


<?php
require_once("includes/footer.php");
?>