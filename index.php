<?php

include('bcaCore.php');

include('header.php');

?>
		<section>
			<h2 id="community">Mes parcours</h2>
			<?php
				displayCoursesList($accessCodeArrayed);
			?>
		</section>

		<section>
			<h2 id="courses">Mes badges</h2>
			<ul id="badges-list" class="disabled">	
				<li><i class="fa fa-graduation-cap"></i> Apprenti</li>
				<li><i class="fa fa-handshake"></i> Compagnon</li>
				<li><i class="fa fa-hand-holding"></i> Passeur</li>
				<li><i class="fa fa-star"></i> Guide</li>
			</ul>
		</section>
	</div>


</body>
</html>