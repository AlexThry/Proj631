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

	<section class="library">
		<div class="shelf">
			<h2>Le Top 10</h2>
			<div class="carousel">

				<button type="button" id="moveLeft" class="btn-nav">
					ᐊ
				</button>
				<div class="container-indicators">
				<div class="indicator active" data-index=0></div>
				<div class="indicator" data-index=1></div>
				<div class="indicator" data-index=2></div>
				</div>
				
				<div class="books">
					
					<?php

					for ( $i = 0; $i < 10; $i++ ) {
						echo '<div class="book" id="book0">
                        <img
                            src="https://images.unsplash.com/photo-1585951237318-9ea5e175b891?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                          alt="" srcset="">
                        <div class="description">
                          <div class="description__buttons-container">
                            <div class="description__button"><i class="fas fa-play"></i></div>
                            <div class="description__button"><i class="fas fa-plus"></i></div>
                            <div class="description__button"><i class="fas fa-thumbs-up"></i></div>
                            <div class="description__button"><i class="fas fa-thumbs-down"></i></div>
                            <div class="description__button"><i class="fas fa-chevron-down"></i></div>
                          </div>
                          <div class="description__text-container">
                            <span class="description__match">97% Match</span>
                            <span class="description__rating">TV-14</span>
                            <span class="description__length">2h 11m</span>
                            <br><br>
                            <span>Explosive</span>
                            <span>&middot;</span>
                            <span>Exciting</span>
                            <span>&middot;</span>
                            <span>Family</span>
                          </div>
                        </div>
                      </div>';
					}
					?>

				</div>
				<button type="button" id="moveRight" class="btn-nav">
				ᐅ
				</button>
				
			</div>
		</div>
	</section>


</div>

<?php
require_once 'includes/footer.php';
