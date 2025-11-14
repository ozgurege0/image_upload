<?php
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if(isset($_POST['ekle'])){
   
$tableName = "contacts";

$data = [
    'title' => $_POST['title'],
     'icon' => $_POST['icon'],
      'content' => $_POST['content']
];

$success = insertIntoTable($tableName, $data, $db);

if ($success) {
  Header("Location:contacts.php?job=ekle");
  exit;
} 
}

if(isset($_POST['duzenle'])){

  $id = $_POST["id"];
    
  $tableName = "contacts";

  $data = [
       'title' => $_POST['title'],
     'icon' => $_POST['icon'],
      'content' => $_POST['content']
  ];

  $condition = ['id' => $id];
  $success = updateTable($tableName, $data, $condition, $db);
  if ($success) {
      Header("Location:contacts.php?job=duzenle");
      exit;
  }
}

if(isset($_GET["id"])){
    $sil=$db->prepare("DELETE FROM contacts WHERE id=:id");
    $kontrol=$sil->execute(array(
      'id' => @$_GET['id']
    ));
    Header("Location:contacts.php?job=sil");
    exit;
}

$contacts=$db->prepare("SELECT * FROM contacts");
$contacts->execute();

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
  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#contacts_ekle" style="float: left;">Kanal Ekle</button>
  <h4 class="text-center" style="margin: 0 auto;">İletişim Kanalları</h4>
</div>




        <div class="table-responsive mt-3">
        <table id="example" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Başlık</th>
      <th scope="col">Düzenle</th>
      <th scope="col">Sil</th>
    </tr>
  </thead>
  <tbody>

<?php $no=0; foreach ($contacts as $contactscek) { $no++; 
    
$main_contacts=$db->prepare("SELECT * FROM contacts");
$main_contacts->execute();
    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><p class="mt-2"> <?php echo $contactscek["title"]; ?></p></td>
      <td><button class="btn btn-primary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#contacts_duzenle<?php echo $contactscek["id"] ?>">Düzenle</button></td>
      <td><a href="contacts.php?id=<?php echo $contactscek["id"] ?>"><button type="button" class="btn btn-danger mt-2">Sil</button></a></td>
    </tr>

    <!-- Modal -->
<div class="modal fade" id="contacts_duzenle<?php echo $contactscek["id"] ?>" tabindex="-1" aria-labelledby="contacts_duzenle<?php echo $contactscek["id"] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kanal Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">

           <div class="col-md-12 mt-3">
        <label class="form-label">Fontawesome İkon Class'ı (Örn: fa-solid fa-envelope)</label>
        <input class="form-control" type="text" name="icon" value="<?php echo $contactscek["icon"] ?>">
        </div>

        <div class="col-md-12 mt-3">
        <label class="form-label">İsim</label>
        <input class="form-control" type="text" name="title" value="<?php echo $contactscek["title"] ?>">
        </div>

          <div class="col-md-12 mt-3">
        <label class="form-label">İçerik</label>
        <input class="form-control" type="text" name="content" value="<?php echo $contactscek["content"] ?>">
        </div>
      

        <div class="col-md-3 mt-3">
        <button class="btn btn-primary" type="submit" name="duzenle">Düzenle</button>
        </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $contactscek["id"]; ?>">
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
<div class="modal fade" id="contacts_ekle" tabindex="-1" aria-labelledby="contacts_ekle" aria-hidden="true">
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
        <label class="form-label">Fontawesome İkon Class'ı (Örn: fa-solid fa-envelope)</label>
        <input class="form-control" type="text" name="icon">
        </div>

        <div class="col-md-12 mt-3">
        <label class="form-label">İsim</label>
        <input class="form-control" type="text" name="title">
        </div>

          <div class="col-md-12 mt-3">
        <label class="form-label">İçerik</label>
        <input class="form-control" type="text" name="content">
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