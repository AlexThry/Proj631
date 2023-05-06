<?php require_once 'includes/header.php'; ?>
<style><?php require_once 'assets/css/carousel.css'; ?></style>

<div class="content">
	<section class="hero">
		<img class="feature-image" src="assets/images/hero.jpg" alt="Une femme lisant un livre sur la plage.">

		<form action="search.php" method="POST" class="search-bar">
			<input type="text" name="search" placeholder="Rechercher un livre">
			<select>
				<option value="no">Theme</option>
				<option value="title">Roman</option>
				<option value="author">SF</option>
				<option value="category">Comics</option>
			</select>
			<button type="submit">
				<img src="assets/images/loop.png" class="loop">
			</button>
		</form>

		<div class="advantages">

			<div class="card">
				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit iusto a error venia ?
			</div>

			<div class="card">
				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit iusto a error venia ?
			</div>

			<div class="card">
				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit iusto a error venia ?
			</div>

		</div>
	</section>

	<section class="library">
		<div class="shelf">
			<h2>Le Top 10</h2>
			<div class="carousel">
				<button type="button" id="moveLeft" class="btn-nav">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
				</button>
				<div class="container-indicators">
				<div class="indicator active" data-index=0></div>
				<div class="indicator" data-index=1></div>
				<div class="indicator" data-index=2></div>
			</div>

			<div class="books">
				<?php
				for ( $i = 0; $i < 10; $i++ ) {
					echo '<div class="book" id="book' . strval( $i ) . '">
                        <img
						src="https://images.unsplash.com/photo-1585951237318-9ea5e175b891?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
						alt="" srcset="">
                        <div class="description">
                          <div class="book-buttons-container">
						  <div class="book-buttons">8</i></div>
						  <a class="book-buttons page-button" href="./single-book.php?id=1">
						  	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
						  </a>
                          </div>
                          <div class="description-text-container">
						  <span class="description-rating">Auteur</span>
						  <br><br>
						  <span class="book-theme">Explosive</span>
						  <span>&middot;</span>
						  <span class="book-theme">Exciting</span>
						  <span>&middot;</span>
						  <span class="book-theme">Family</span>
                          </div>
						  </div>
						  </div>';
				} ?>
			</div>
			<button type="button" id="moveRight" class="btn-nav"> ᐅ </button>
		</div>
		<button type="button" id="moveRight" class="btn-nav">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
		</button>
	</div>
</div>
</section>


</div>

<script src="assets/js/script.js" defer></script>

<?php
require_once 'includes/footer.php';
