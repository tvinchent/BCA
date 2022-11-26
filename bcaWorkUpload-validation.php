<?php

include('header.php');

/* 
TODO : 
Ajout de plusieurs fichiers
*/


$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;
if ($isConnected) {
  $mail = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];
}
else{
  echo 'Vous n\'êtes pas connecté, veuillez vous inscrire ou vous connecter sur la page d\'accueil<br><a href="index.php">Retour</a>';
  exit();
}

function getIdUser(){
  require('env.php');
  global $mail;
  $select = $db->query('SELECT id FROM user WHERE mail="'.$mail.'"');
  $result = $select->fetch();
  $counttable = count((is_countable($result)?$result:[]));
  if($counttable!=0){
      return $result['id'];
  }
  else{
    return 'erreur req';
  }
}

$idUser = getIdUser();

if(!is_dir($idUser)){
  mkdir($idUser, 0777);
}

$nameOfDirForWork = $_GET['course'].' '.$_GET['challenge'];
$target_dir = $idUser.'/'.$nameOfDirForWork;

if(!is_dir($target_dir)){
  mkdir($target_dir, 0777);
}

// ici démare la boucle pour un multi upload

$target_file = $target_dir .'/'. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Désolé, le fichier existe déjà.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Désolé, votre fichier est trop gros";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "ppt" && $imageFileType != "pptx") {
    echo "Désolé, seul les JPG, JPEG, PNG, GIF, PDF, PPT & PPTX sont autorisés.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo " Votre fichier n'a pas été uploadé.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été uploadé.";
    } else {
      echo "Désolé, il y a eu une erreur durant l'upload.";
    }
  }
}

// ici se termine la boucle pour un multi upload

?>

<br>
<a href="index.php">Retour</a>