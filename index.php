<?php require_once 'includes/header.php'; ?>

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

	...



</div>

<?php
require_once 'includes/footer.php';
