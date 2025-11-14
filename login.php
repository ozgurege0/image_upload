<?php 
require_once("admin/ayarlar/baglan.php");
require_once("session.php");

if(isset($fetch_profile["id"])){
    header("Location:$url/");
    exit;
}

if(isset($_POST['login'])){

  $mail = htmlspecialchars($_POST['mail']);
    $pass = md5($_POST['pass']);
  
    $select = $db->prepare("SELECT * FROM `users` WHERE mail = ? AND password = ?");
    $select->execute([$mail, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);
  
    if($select->rowCount() > 0){
  
     $harf = 'IRT7ODCH5LFSGPM45BKEUV1NZAYJ';
  $harf_sayisi = mb_strlen($harf);
  for ($i = 0; $i < 10; $i++){
   $secilen_harf_konumu = mt_rand(0,$harf_sayisi - 1);
   @$kod .= mb_substr($harf, $secilen_harf_konumu, 1).rand(0,9);
  }
    $token = mb_substr($kod, 0, 64); 
    $browser = $_SERVER['HTTP_USER_AGENT'];
  
    date_default_timezone_set('Europe/Istanbul');
    $date = date('d.m.Y H:i:s');
  
  
  
  
   $rememberid = $row['id'];
  
   $duzenle=$db->prepare("UPDATE users SET
     token=:token
   WHERE id=$rememberid");
   $update=$duzenle->execute(array(
     'token' => $token
   ));
  
     setcookie("remember", $token, time()+60*60*24*365);
  
     if($row['user_type'] == 'admin'){
  
         $_SESSION['user_id'] = $row['id'];
         header("location:$url/admin/index.php");
         exit;
      }elseif($row['user_type'] == 'user'){
  
         $_SESSION['user_id'] = $row['id'];
         header("location:$url/");
         exit;
      }elseif($row['user_type'] == 'pending' or 'ban'){
        
   header('location:login?job=pendingorban');
                 exit;
      }else{
         header('location:login?user=noutfound');
                 exit;
       }
       
    }else{
       header('location:login?job=failed');
                 exit;
    }
  
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body style="background-color:#0583F2">
    <div class="container">

    <div class="row justify-content-center w-100 mt-5">
          <div class="col-md-8 col-lg-6 col-xxl-4 auth-card">
            <div class="card mb-0">
              <div class="card-body">
               
                <form method="post" action="">

                  <div class="mb-3">
                    <label class="form-label">E-Mail Adresi</label>
                    <input type="email" name="mail" class="form-control">
                  </div>

                  <div class="mb-4">
                    <label class="form-label">Şifre</label>
                    <input type="password" name="pass" class="form-control">
                  </div>

                  <button class="btn btn-primary w-100 py-8 mb-4 rounded-2" type="submit" name="login">Giriş Yap</button>
    
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>