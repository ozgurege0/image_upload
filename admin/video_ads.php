<?php
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if(isset($_POST['ekle'])){

$video = uploadImage('video');

if ($video) {
echo "Dosya başarıyla yüklendi: " . $video;
}
   
$tableName = "video_ads";

$data = [
    'link' => $_POST['link'],
    'video' => $video
];

$success = insertIntoTable($tableName, $data, $db);

if ($success) {
  Header("Location:video_ads.php?job=ekle");
  exit;
} 
}

if (isset($_POST['duzenle'])) {
  $video = null;
  if (isset($_FILES['video']) && $_FILES['video']['size'] != 0) {
      $video = uploadImage('video');
  }


  $tableName = "video_ads";

 $data = [
    'link' => $_POST['link']
];

  if ($video) {
      $data['video'] = $video;
  }

  $id = $_POST["id"];
  $condition = ['id' => $id];

  $success = updateTable($tableName, $data, $condition, $db);

  if ($success) {
      Header("Location:video_ads.php?job=duzenle");
      exit;
  } else {
      echo "Güncelleme başarısız.";
  }
}

if(isset($_GET["id"])){
    $sil=$db->prepare("DELETE FROM video_ads WHERE id=:id");
    $kontrol=$sil->execute(array(
      'id' => @$_GET['id']
    ));
    Header("Location:video_ads.php?job=sil");
    exit;
}

$video_ads=$db->prepare("SELECT * FROM video_ads");
$video_ads->execute();

?>
<?php 
require_once("includes/header.php");
require_once("includes/navbar.php");
require_once("includes/sidebar.php"); 
?>

           <div class="body-wrapper">
        
        <div class="container-fluid">
        <div class="card card-body shadow">
        <div class="d-flex justify-content-between align-items-center">
  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#video_ads_ekle" style="float: left;">Video Reklam Ekle</button>
  <h4 class="text-center" style="margin: 0 auto;">Video Reklam Yönetimi</h4>
</div>




        <div class="table-responsive mt-3">
        <table id="example" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Link</th>
      <th scope="col">Düzenle</th>
      <th scope="col">Sil</th>
    </tr>
  </thead>
  <tbody>

<?php $no=0; foreach ($video_ads as $video_adscek) { $no++; 
    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><p class="mt-2"> <?php echo $video_adscek["link"]; ?></p></td>
      <td><button class="btn btn-primary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#video_ads_duzenle<?php echo $video_adscek["id"] ?>">Düzenle</button></td>
      <td><a href="video_ads.php?id=<?php echo $video_adscek["id"] ?>"><button type="button" class="btn btn-danger mt-2">Sil</button></a></td>
    </tr>

    <!-- Modal -->
<div class="modal fade" id="video_ads_duzenle<?php echo $video_adscek["id"] ?>" tabindex="-1" aria-labelledby="video_ads_duzenle<?php echo $video_adscek["id"] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video Reklam Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">

        <div class="col-md-6 mt-3">
        <label class="form-label">Video: <a href="<?php echo $url; ?>/<?php echo $video_adscek["video"] ?>" target="_blank"><?php echo $video_adscek["video"] ?></a></label>
        <input class="form-control" type="file" name="video">
        </div>

    <div class="col-md-6 mt-3">
        <label class="form-label">Link</label>
        <input class="form-control" type="text" name="link" value="<?php echo $video_adscek["link"] ?>">
        </div>

        <div class="col-md-3 mt-3">
        <button class="btn btn-primary" type="submit" name="duzenle">Düzenle</button>
        </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $video_adscek["id"]; ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>

<?php } ?>


  </tbody>
</table>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="video_ads_ekle" tabindex="-1" aria-labelledby="video_ads_ekle" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video Reklam Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="post" enctype="multipart/form-data">       
    <div class="row">


          <div class="col-md-6 mt-3">
        <label class="form-label">Video:</label>
        <input class="form-control" type="file" name="video">
        </div>

    <div class="col-md-6 mt-3">
        <label class="form-label">Link</label>
        <input class="form-control" type="text" name="link">
        </div>

        <div class="col-md-3 mt-3">
        <button class="btn btn-primary" type="submit" name="ekle">Ekle</button>
        </div>

        </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
    </div>


<?php require_once("includes/footer.php"); ?>