<?php
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if(isset($_POST['ekle'])){
   
$tableName = "categories";

$data = [
    'title' => $_POST['title']
];

$success = insertIntoTable($tableName, $data, $db);

if ($success) {
  Header("Location:categories.php?job=ekle");
  exit;
} 
}

if(isset($_POST['duzenle'])){

  $id = $_POST["id"];
    
  $tableName = "categories";

  $data = [
      'title' => $_POST['title']
  ];

  $condition = ['id' => $id];
  $success = updateTable($tableName, $data, $condition, $db);
  if ($success) {
      Header("Location:categories.php?job=duzenle");
      exit;
  }
}

if(isset($_GET["id"])){
    $sil=$db->prepare("DELETE FROM categories WHERE id=:id");
    $kontrol=$sil->execute(array(
      'id' => @$_GET['id']
    ));
    Header("Location:categories.php?job=sil");
    exit;
}

$categories=$db->prepare("SELECT * FROM categories");
$categories->execute();

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
  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#categories_ekle" style="float: left;">Ana Kategori Ekle</button>
  <h4 class="text-center" style="margin: 0 auto;">Kategori Yönetimi</h4>
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

<?php $no=0; foreach ($categories as $categoriescek) { $no++; 
    
$main_categories=$db->prepare("SELECT * FROM categories");
$main_categories->execute();
    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><p class="mt-2"> <?php echo $categoriescek["title"]; ?></p></td>
      <td><button class="btn btn-primary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#categories_duzenle<?php echo $categoriescek["id"] ?>">Düzenle</button></td>
      <td><a href="categories.php?id=<?php echo $categoriescek["id"] ?>"><button type="button" class="btn btn-danger mt-2">Sil</button></a></td>
    </tr>

    <!-- Modal -->
<div class="modal fade" id="categories_duzenle<?php echo $categoriescek["id"] ?>" tabindex="-1" aria-labelledby="categories_duzenle<?php echo $categoriescek["id"] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kategori Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">

        <div class="col-md-12 mt-3">
        <label class="form-label">Kategori İsmi</label>
        <input class="form-control" type="text" name="title" value="<?php echo $categoriescek["title"] ?>">
        </div>
      

        <div class="col-md-3 mt-3">
        <button class="btn btn-primary" type="submit" name="duzenle">Düzenle</button>
        </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $categoriescek["id"]; ?>">
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
<div class="modal fade" id="categories_ekle" tabindex="-1" aria-labelledby="categories_ekle" aria-hidden="true">
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