<?php

include('header.php');

/* 
TODO : 
Création d'un dossier au nom "idUser" si n'existe pas, idem dossier [numDuParcours][numDuChallenge]
//Ajout d'un fichier
Ajout de plusieurs fichiers
*/

/*

function getID($mail)
function UploadForm($id)

if(isset post upload){
  //upload file
  DB insert(idUser,GET['challenge'])
}

!isCo ?
  Y: -> Vous n'êtes pas connecté, veuillez vous inscrire ou vous connecter sur la page d'accueil
  N: id=getID($mail) + !exist dir ?
    Y: mkdir(id)
  UploadForm(id)

*/ 

$target_dir = "users/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
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
?>

<br>
<a href="index.php">Retour</a>