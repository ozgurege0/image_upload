<?php
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if(isset($_GET["id"])){
    $sil=$db->prepare("DELETE FROM messages WHERE id=:id");
    $kontrol=$sil->execute(array(
      'id' => @$_GET['id']
    ));
    Header("Location:messages.php?job=sil");
    exit;
}

$messages=$db->prepare("SELECT * FROM messages");
$messages->execute();

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
  <h4 class="text-center" style="margin: 0 auto;">Mesaj Yönetimi</h4>
</div>




        <div class="table-responsive mt-3">
        <table id="example" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Ad Soyad</th>
            <th scope="col">Tarih</th>

      <th scope="col">Oku</th>
      <th scope="col">Sil</th>
    </tr>
  </thead>
  <tbody>

<?php $no=0; foreach ($messages as $messagescek) { $no++; 
    

    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><p > <?php echo $messagescek["name"]; ?> <?php echo $messagescek["surname"]; ?></p></td>
            <td><p > <?php echo $messagescek["tarih"]; ?></p></td>

      <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#messages_duzenle<?php echo $messagescek["id"] ?>">Oku</button></td>
      <td><a href="messages.php?id=<?php echo $messagescek["id"] ?>"><button type="button" class="btn btn-danger">Sil</button></a></td>
    </tr>

    <!-- Modal -->
<div class="modal fade" id="messages_duzenle<?php echo $messagescek["id"] ?>" tabindex="-1" aria-labelledby="messages_duzenle<?php echo $messagescek["id"] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mesaj Oku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
    
        <div class="row">
          <div class="col-md-6 mt-3">
            <label class="form-label">Ad Soyad</label>
            <input class="form-control" type="text" value="<?php echo $messagescek["name"]; ?> <?php echo $messagescek["surname"]; ?>" disabled>    
            </div>
            <div class="col-md-6 mt-3"> 
            <label class="form-label">E-Posta</label>
            <input class="form-control" type="text" value="<?php echo $messagescek["email"]; ?>" disabled>
            </div>

              <div class="col-md-6 mt-3"> 
            <label class="form-label">Telefon Numarası</label>
            <input class="form-control" type="text" value="<?php echo $messagescek["phone"]; ?>" disabled>
            </div>

              <div class="col-md-6 mt-3"> 
            <label class="form-label">Ip Adres</label>
            <input class="form-control" type="text" value="<?php echo $messagescek["ip"]; ?>" disabled>
            </div>

            <div class="col-md-12 mt-3">
            <label class="form-label">Mesaj</label>
            <textarea class="form-control" rows="6" disabled><?php echo $messagescek["message"]; ?></textarea>  
                </div>


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
<div class="modal fade" id="messages_ekle" tabindex="-1" aria-labelledby="messages_ekle" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kategori Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
    
      <div class="col-md-12 mt-3">
        <label class="form-label">Kategori İsmi</label>
        <input class="form-control" type="text" name="title">
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



<?php require_once("includes/footer.php"); ?>