<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>BCA: Bonsai Coach Academie</title>
	<meta name="description" content="Plateforme d'apprentissage de l'art du bonsaï">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link rel="stylesheet" href="bonsai.css">
	<link href="assets/css/all.css" rel="stylesheet">
	<link href="assets/css/fontawesome.css" rel="stylesheet">
	<link href="assets/css/brands.css" rel="stylesheet">
	<link href="assets/css/solid.css" rel="stylesheet">
	<script defer src="assets/js/all.js"></script>
	<script defer src="assets/js/brands.js"></script>
	<script defer src="assets/js/solid.js"></script>
	<script defer src="assets/js/fontawesome.js"></script>
</head>
<body>

	<div class="container">

        <header>

        <?php

        if(isset($_COOKIE['mail']) || isset($_SESSION['mail'])){
            $id = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];
            echo'
            <nav>
                <ul id="connection">
                    <li id="signup">
                        <i class="fas fa-user"></i> '.$id.'
                    </li>
                    <li id="signout">
                        <a href="deconnexion.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </nav>
            ';
        }
        else{
            echo'
            <nav>
                <ul id="connection">
                    <li id="signup">
                        <a href="inscription.php"><i class="fas fa-user-plus"></i> Inscription</a>
                    </li>
                    <li id="signin">
                        <a href="connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                    </li>
                </ul>
            </nav> 
            ';
        }
        ?>
		
            <div class="cleared"></div>
            <h1>Bonsai Coach Academie</h1>
            <p>Plateforme d'apprentissage de <em>l'art du bonsaï</em></p>
                
        </header>