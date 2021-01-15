<?php
require 'header.php';
?>

<div class="container col-lg-12 col-md-12">

	<div class="card-wrapper mb-4">
		<!-- Card -->
		<div class="card card-rotating mb-5" id="card-1" style="width: 22rem;">
			<!-- Card image -->

			<!-- Front Side -->
			<div class="face front">

				<div class="card-up">
					<img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/photo9.jpg" alt="Card image cap">
					<a>
						<div class="mask rgba-white-slight waves-effect waves-light"></div>
					</a>
				</div>

				<!-- Social buttons -->
				<div class="card-share">

					<div class="social-reveal">

						<!-- WhatsApp -->
						<a type="button" class="btn-floating btn-whatsapp mt-0 mx-0 waves-effect waves-light"><i class="fab fa-whatsapp"></i></a>
						<!-- Facebook -->
						<a type="button" class="btn-floating btn-fb mt-0 mx-0 waves-effect waves-light"><i class="fab fa-facebook-f"></i></a>
						<!-- Twitter -->
						<a type="button" class="btn-floating btn-tw mt-0 mx-0 waves-effect waves-light"><i class="fab fa-twitter"></i></a>
						<!-- Instagram -->
						<a type="button" class="btn-floating btn-git mt-0 mx-0 waves-effect waves-light"><i class="fab fa-instagram"></i></a>
						<!-- Tienda Online -->
						<a type="button" class="btn-floating btn-so mt-0 mx-0 waves-effect waves-light"><i class="fas fa-shopping-bag"></i></a>

					</div>

					<!-- Button action -->
					<a class="btn-floating btn-action share-toggle indigo ml-auto mr-4 float-right waves-effect waves-light"><i class="fas fa-share-alt"></i></a>

				</div>

				<!-- Card content -->
				<div class="card-body">

					<!-- Title -->
					<h4 class="card-title mb-0">Card title</h4>
					<label class="badge badge-success mb-0">Abierto</label>
					<hr>
					<!-- Text -->
					<p class="card-text mb-1">Miguel Gómez #5, Col. El Moral, CP 74125, San Matrín Texmelucan, Puebla</p>
					<p class="card-text text-muted">Frente a la iglesia de don poncho</p>
					<a class="rotate-btn" data-card="card-1"><i class="fas fa-redo-alt"></i> Lado trasero</a>
				</div>

			</div>

			<!-- Back Side -->
			<div class="face back">
				<div class="card-body">

					<!-- Content -->
					<h4 class="font-weight-bold mb-0">About me</h4>
					<hr>
					<!-- Triggering button -->
					<a class="rotate-btn" data-card="card-1"><i class="fas fa-undo"></i> Lado frontal</a>
				</div>
			</div>
			<!-- Back Side -->
		</div>

		<!-- Card -->
	</div>
</div>


<?php
require 'footer.php';
?>