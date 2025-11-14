<?php 
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

$users=$db->prepare("SELECT * FROM users where id=:id");
$users->execute(array(
  'id'=> 1
));
$userscek=$users->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {

    if($userscek["password"] != $_POST['password']){
        $password = md5($_POST['password']);
    } else {
        $password = $userscek["password"];
    }

    $tableName = "users";
  
    $data = [
        'mail' => $_POST['mail'],
        'password' => $password
    ];



    $id = "1";
    $condition = ['id' => $id];
  
    $success = updateTable($tableName, $data, $condition, $db);
  
    if ($success) {
        Header("Location:users.php?job=duzenle");
        exit;
    } else {
        echo "Güncelleme başarısız.";
    }
  }


require_once("includes/header.php");
require_once("includes/navbar.php");
require_once("includes/sidebar.php"); 
?>
      


      
      <!-- Main wrapper -->
      
      <div class="body-wrapper">
        
        <div class="container-fluid">
        <div class="card card-body shadow">
        <h4 class="text-center">Admin Ayarlar</h4>

        <form action="" method="post" enctype="multipart/form-data">
        <div class="row">

      

        <div class="col-md-12 mt-3">
        <label>Email:</label>
        <input type="text" class="form-control" name="mail" value="<?php echo $userscek["mail"] ?>">
        </div>

        <div class="col-md-12 mt-3">
        <label>Şifre (Değiştirmek istemiyorsanız aynen bırakın):</label>
        <input type="text" class="form-control" name="password" value="<?php echo $userscek["password"] ?>">
        </div>

      

    <div class="col-md-4">
        <button class="btn btn-primary mt-3" name="submit" type="submit">Kaydet</button>
    </div>
    </div>
        </form>

        </div>
      </div>
    </div>
  </div>
<?php require_once("includes/footer.php"); ?>