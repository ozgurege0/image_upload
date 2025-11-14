<?php
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if(isset($_GET["id"])){
    $sil=$db->prepare("DELETE FROM images WHERE id=:id");
    $kontrol=$sil->execute(array(
      'id' => @$_GET['id']
    ));
    Header("Location:images.php?job=sil");
    exit;
}

$images=$db->prepare("SELECT * FROM images ORDER BY id DESC");
$images->execute();

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
  <h4 class="text-center" style="margin: 0 auto;">Yüklenen Resimler</h4>
</div>




        <div class="table-responsive mt-3">
        <table id="example" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
        <th scope="col">Resim</th>
      <th scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody>

<?php $no=0; foreach ($images as $imagescek) { $no++; 
    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><img src="<?php echo $url; ?>/<?php echo $imagescek["img"]; ?>" width="150px"></td>
   
      <td>
    <a href="<?php echo $url; ?>/image_upload.php?token=<?php echo $imagescek["token"] ?>" target="_blank"><button type="button" class="btn btn-primary mt-2">Linke Git</button></a>

      <a href="images.php?id=<?php echo $imagescek["id"] ?>"><button type="button" class="btn btn-danger mt-2">Sil</button></a>
    
    </td>
    </tr>

<?php } ?>


  </tbody>
</table>
        </div>
    </div>




    </div>


<?php require_once("includes/footer.php"); ?>