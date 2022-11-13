<?php

include('header.php');

$connected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if($connected) {
	include('bcaCore.php');

	$accessCode = getAccessCodeFromDB();
	$accessCodeArrayed = stringToArrayAccessCode($accessCode);

	if(isset($_POST['course'])){
		setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
	}
}



?>
		<section>
			<h2 id="community">Mes parcours & badges</h2>
			<?php
			if($connected) {
				displayCoursesList($accessCodeArrayed);
			}
				
			?>
		</section>

		<section>
			<h2 id="courses">Badges disponibles</h2>
			<ul id="badges-list">
				<li><i class="fa fa-graduation-cap"></i> Apprenti</li>
				<li><i class="fa fa-handshake"></i> Compagnon</li>
				<li><i class="fa fa-hand-holding"></i> Passeur</li>
				<li><i class="fa fa-star"></i> Guide</li>
			</ul>
		</section>
	</div>


</body>
</html>