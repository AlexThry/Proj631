<?php
	require_once 'functions.php';
	// Test if user is connected
if ( ! get_user() ) {
	header( 'Location: ' . get_home_url() );
}

	require_once 'includes/header.php';
?>

<style><?php require_once 'assets/css/account.css'; ?></style>

<div class="content">
	<section class="infos">







		<!---------------------------------------------------- Choix de page ---------------------------------------------->

		<aside class="ligth-frame">
			<?php
				$buttons = array(
					'mes_livres'  => 'Mes livres',
					'ma_wishlist' => 'Ma wishlist',
					'mes_infos'   => 'Mes infos',
					'mon_cercle'  => 'Mon cercle',
				);

				$currentChoice = isset( $_GET['choix'] ) ? $_GET['choix'] : 'mes_livres';

				foreach ( $buttons as $choice => $text ) {
					// Affichage du séparateur
					if ( $choice != 'mes_livres' ) {
						echo "<div class='separator'></div>";
					}
					// Affichage du bouton
					$isSelected = $currentChoice == $choice;
					echo "<a href='?choix=$choice' class='not-default btn-secondary " . ( $isSelected ? '' : 'btn-disabled' ) . "'>$text</a>";
				}
				?>
		</aside>







		<article class="ligth-frame">

		<!------------------------------------ Premier choix: Mes livres --------------------------------------------------->

		<?php
		if ( $currentChoice == 'mes_livres' ) {
			$books = get_user()->books();
			Component::books_display( $books );
		}
		?>

		<!------------------------------------ Deuxième choix: Ma Whishlist (TODO) ----------------------------------------->

		<?php
		if ( $currentChoice == 'ma_wishlist' ) {
			$whishlist = get_user()->wishlist();
			Component::books_display( $whishlist );
		}
		?>

		<!------------------------------------ Troisième choix: Mon infos (TODO) ------------------------------------------>

		<?php if ( $currentChoice == 'mes_infos' ) : ?>
		<?php endif; ?>

		<!------------------------------------ Quatrième choix: Mon cercle (TODO) ----------------------------------------->

		<?php if ( $currentChoice == 'mon_cercle' ) : ?>
		<?php endif; ?>

		</article>









	</section>
</div>

<!-- <script src="assets/js/account.js" defer></script> -->

<?php
require_once 'includes/footer.php';
