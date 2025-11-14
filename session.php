<?php

@session_start();
@ob_start();
$user_id = @$_SESSION['user_id'];

if(!isset($user_id)){
   if(isset($_COOKIE['remember'])){
       
      $users=$db->prepare("SELECT * FROM users where token=:token");
      $users->execute(array(
      'token'=>$_COOKIE['remember']
      ));
      $remembercek=$users->fetch(PDO::FETCH_ASSOC);
      
         $mail = @$remembercek['mail'];
         $pass = @$remembercek['password'];
      
         $select = $db->prepare("SELECT * FROM `users` WHERE mail = ? AND password = ?");
         $select->execute([$mail, $pass]);
         $row = $select->fetch(PDO::FETCH_ASSOC);
      
         if($select->rowCount() > 0){
      
            date_default_timezone_set('Europe/Istanbul');
            $date = date('d.m.Y H:i:s');
          
           $rememberid = $row['id'];
           

          if($row['user_type'] == 'admin'){
      
              $_SESSION['user_id'] = $row['id'];
              header("location:$url/admin/index.php"); exit;
      
           }elseif($row['user_type'] == 'user'){
      
              $_SESSION['user_id'] = $row['id'];
              header("location:$url/");
      
           }else{
               $message[] = 'no user found!';
            }
            
         }else{
            $message[] = 'incorrect mail or password!';
         }
   }
}


$select_profile = $db->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

if(@$fetch_profile['user_type']=="pending"){
   echo "Üyeliğiniz beklemededir.";
   exit;
}
if(@$fetch_profile['user_type']=="ban"){
   echo "Üyeliğiniz banlıdır.";
   exit;
}
?>