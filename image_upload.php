<?php 
require_once("admin/ayarlar/baglan.php");

if(!isset($_GET["token"])){
    header("Location:$url/");
    exit;
}else{

$token = htmlspecialchars($_GET["token"], ENT_QUOTES, 'UTF-8');

$images=$db->prepare("SELECT * FROM images where token=:token");
$images->execute(array(
  'token'=> $token
));
$get_image=$images->fetch(PDO::FETCH_ASSOC);
}
if(!isset($get_image["id"])){
    header("Location:$url/");
    exit;
}

require_once("includes/header.php");
require_once("includes/navbar.php");
?>


<div class="container content">
  <div class="card text-center shadow mt-3">
    <div class="card-body">
      <h3>Resim Yüklendi</h3>
      <img src="<?php echo $url; ?>/<?php echo $get_image["img"]; ?>" width="600" height="400" alt=""><br>

      <!-- 📥 İndir Butonu -->
      <a href="<?php echo $url; ?>/<?php echo $get_image["img"]; ?>" download class="btn btn-primary btn-lg mt-3">
        İndir
      </a>

      <!-- 🔗 Linki Kopyala Butonu -->
      <button type="button" class="btn btn-secondary btn-lg mt-3" id="copyLinkBtn">
        Linki Kopyala
      </button>

    </div>
  </div>
</div>

<!-- 🔧 JS Kısmı -->
<script>
document.getElementById('copyLinkBtn').addEventListener('click', function() {
  const link = "<?php echo $url; ?>/image_upload.php?token=<?php echo $get_image['token']; ?>";
  navigator.clipboard.writeText(link).then(() => {
    alert('✅ Link panoya kopyalandı:\n' + link);
  }).catch(err => {
    alert('❌ Kopyalama başarısız: ' + err);
  });
});
</script>



<?php
require_once("includes/footer.php");
?>