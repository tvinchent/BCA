<?php

/* TODO : change access Code (UC: when following a new course)
1: by refresh
2: with ajax (need dynamiquely refresh data when changed - with eventListener, promise ?)

onclick "Joindre" : ajax (set to 1)
onclick "Annuler" : confirmation : ajax (set to 0)
*/


// Access Code functions

// WIP function authorizedToJoin($NumberOfTheCourse){
// 	return $isAuthorized ? true : false;
// }

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
	if($numberFromArray == 0){ $rankNamed='Non suivi'; }
	if($numberFromArray == 1){ $rankNamed='Apprenti'; }
	if($numberFromArray == 2){ $rankNamed='Compagnon'; }
	if($numberFromArray == 3){ $rankNamed='Passeur'; }
	if($numberFromArray == 4){ $rankNamed='Guide'; }
	return $rankNamed;
}

$accessCode = getAccessCodeFromDB();
$accessCodeArrayed = stringToArrayAccessCode($accessCode);

if(isset($_POST['course'])){
	setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
}

echo '<br>Apprentissage et transmission: '.numberToRankNamed($accessCodeArrayed[0]).'<form method="POST" name="course0"><input type="hidden" name="course" value="0"><a href="#" onclick="javascript:document.course0.submit();">Joindre</a></form><br>';
echo '<br>Culture en pot: '.numberToRankNamed($accessCodeArrayed[1]).'<form method="POST" name="course1"><input type="hidden" name="course" value="1"><a href="#" onclick="javascript:document.course1.submit();">Joindre</a></form><br>';
echo '<br>Art de l\'ouvrage: '.numberToRankNamed($accessCodeArrayed[2]).'<form method="POST" name="course2"><input type="hidden" name="course" value="2"><a href="#" onclick="javascript:document.course2.submit();">Joindre</a></form><br>';
echo '<br>Arts Associés: '.numberToRankNamed($accessCodeArrayed[3]).'<form method="POST" name="course3"><input type="hidden" name="course" value="3"><a href="#" onclick="javascript:document.course3.submit();">Joindre</a></form><br>';