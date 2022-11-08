<?php

/* TODO : change access Code (UC: when following a new course)
1: by refresh
2: with ajax (need dynamiquely refresh data when changed - with eventListener, promise ?)

onclick "Joindre" : ajax (set to 1)
onclick "Annuler" : confirmation : ajax (set to 0)
*/


// Access Code functions

function authorizedToJoin($NumberOfTheCourse, $accessCodeArrayed){
	if($NumberOfTheCourse == 0){
		if($accessCodeArrayed[0]==0){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}
	if($NumberOfTheCourse == 1){
		if($accessCodeArrayed[0]>=2){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}	
	if($NumberOfTheCourse == 2){
		if($accessCodeArrayed[0]>=2){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}

	if($NumberOfTheCourse == 3){
		if($accessCodeArrayed[3]==0){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}
	return $isAuthorized;//isset($isAuthorized) ? $isAuthorized : false;
}

function displayJoinLink($NumberOfTheCourse, $accessCodeArrayed){
	if(authorizedToJoin($NumberOfTheCourse, $accessCodeArrayed)){
		return '- <form method="POST" name="course'.$NumberOfTheCourse.'"><input type="hidden" name="course" value="'.$NumberOfTheCourse.'"><a href="#" onclick="javascript:document.course'.$NumberOfTheCourse.'.submit();">Joindre</a></form><br>';
	}
}

function setToOneNewJoinedCourse($NumberOfJoinedCourse, $accessCodeArrayed){
	$accessCodeArrayed[$NumberOfJoinedCourse] = 1;
	$accessCodeForDB = arrayToStringAccessCode($accessCodeArrayed);
	// insertion en base $accessCodeForDB
	require('env.php');
	$mail = $_COOKIE["mail"];
	$update = $db->prepare('UPDATE user SET accessCode=:accessCode WHERE mail=:mail');
	$update->execute(array('accessCode' => $accessCodeForDB, 'mail' => $mail));
	header("Refresh:0");
}

function getAccessCodeFromDB(){
	require('env.php');
	$mail = $_COOKIE["mail"];
	$select = $db->query('SELECT accessCode FROM user WHERE mail="'.$mail.'"');
	$result = $select->fetch();
	$counttable = count((is_countable($result)?$result:[]));
	if($counttable!=0){
	    return $result['accessCode'];
	}
	else{
		return 'erreur: no accessCode';
	}
}

function stringToArrayAccessCode($accessCodeFromDB){
	return explode(' ', $accessCodeFromDB);
}

function arrayToStringAccessCode($accessCodeForDB){
	return implode(' ', $accessCodeForDB);
}

function numberToRankNamed($numberFromArray){
	if($numberFromArray == 0){ $rankNamed='<span class="disabled">Parcours non suivi</span> <i class="fas fa-info-circle" title="Vous devez compléter d\'autres parcours avant de commencer celui-ci"></i>'; }
	if($numberFromArray == 1){ $rankNamed='<span class="enabled">Parcours suivi</span>'; }
	if($numberFromArray == 2){ $rankNamed='<span class="enabled">Apprenti</span>'; }
	if($numberFromArray == 3){ $rankNamed='<span class="enabled">Compagnon</span>'; }
	if($numberFromArray == 4){ $rankNamed='<span class="enabled">Passeur</span>'; }
	if($numberFromArray == 5){ $rankNamed='<span class="enabled">Guide</span>'; }
	return $rankNamed;
}

$accessCode = getAccessCodeFromDB();
$accessCodeArrayed = stringToArrayAccessCode($accessCode);

if(isset($_POST['course'])){
	setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
}

echo '<br>Apprentissage et transmission: '.numberToRankNamed($accessCodeArrayed[0]).displayJoinLink(0,$accessCodeArrayed);
echo '<br>Culture en pot: '.numberToRankNamed($accessCodeArrayed[1]).displayJoinLink(1,$accessCodeArrayed);
echo '<br>Art de l\'ouvrage: '.numberToRankNamed($accessCodeArrayed[2]).displayJoinLink(2,$accessCodeArrayed);
echo '<br>Arts Associés: '.numberToRankNamed($accessCodeArrayed[3]).displayJoinLink(3,$accessCodeArrayed);