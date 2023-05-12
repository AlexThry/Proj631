<?php

require_once 'includes/header.php';

$book_id = $_GET['id'];

if ( ! $book_id ) {
	header( 'Location: ' . get_home_url() );
	exit();
}

$has_read = Database::user_has_read(get_user()['id'], $book_id);
$wants_to_read = Database::user_wants_to_read(get_user()['id'], $book_id);
$book = Database::get_single_book( $book_id );
?>

<main class="pt-4 pb-8 lg:pt-8 lg:pb-12 bg-white dark:bg-gray-900">
  <div class="flex justify-between px-4 mx-auto max-w-screen-2xl ">
	  <article class="mx-auto w-full max-w-5xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
		  <header class="relative gap-4 items-start py-8 px-4 mx-auto max-w-7xl sm:static xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
			  <img class="w-lg rounded" src="<?php echo $book['image_url']; ?>" alt="<?php echo $book['title']; ?>">
			<div class="mt-4 md:mt-0">
				<h2 class="mb-2 text-5xl font-bold leading-none text-gray-900 md:text-5xl dark:text-white"><?php echo $book['title']; ?></h2>

				<div class="flex items-center mt-4 mb-3">
					<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					<p class="ml-2 text-sm font-bold text-gray-900 dark:text-white"><?php echo $book['score'] === 0 ? 'Aucune note' : $book['score']; ?></p>
					<span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
					<a href="#reviews" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white"><?php echo $book['nb_reviews']; ?> avis</a>
				</div>

				<?php if($has_read) : ?>
				<div class="disabled text-white bg-green-700 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600">
					<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
					Lu
				</div>
				<?php endif; ?>

				<?php if($wants_to_read && !$has_read) : ?>
				<div class="disabled text-white bg-green-700 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600">
					<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
					</svg>
					En cours
				</div>
				<?php endif; ?>

				<dl>
					<dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</dt>
					<dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo $book['description']; ?></dd>
				</dl>
				<dl class="flex items-center space-x-6">
					<div>
						<dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Catégories</dt>
						<dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo join( ', ', $book['genres'] ); ?></dd>
					</div>
					<div>
						<dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Auteur</dt>
						<dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo $book['author']; ?></dd>
					</div>
					<div>
						<dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Date de parution</dt>
						<dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo $book['parution_date']; ?></dd>
					</div>
				</dl>
				<div class="flex items-center space-x-4">
					<?php if($has_read) : ?>
					<a href="<?php echo "change-my-books?book_id=$book_id&previous-url=$_SERVER[REQUEST_URI]&with-redirect=true" ?>"  class="opacity-50 inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
						<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
						</svg>
						Je n'ai pas terminé
					</a>
					<?php endif; ?>

					<?php if($wants_to_read && !$has_read) : ?>
					<a href="<?php echo "change-my-books?book_id=$book_id&previous-url=$_SERVER[REQUEST_URI]&with-redirect=true" ?>" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
						<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
						</svg>
						J'ai terminé
					</a>

					<a href="<?php echo "change-wishlist?book_id=$book_id&previous-url=$_SERVER[REQUEST_URI]&with-redirect=true" ?>"   class="opacity-50 inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
						<svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
						Supprimer de ma liste
					</a>
					<?php endif; ?>

					<?php if(!$wants_to_read && !$has_read) : ?>
					<a href="<?php echo "change-wishlist?book_id=$book_id&previous-url=$_SERVER[REQUEST_URI]&with-redirect=true" ?>"  class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
						<svg fill="none" stroke="currentColor" class="w-5 h-5 mr-2 -ml-1" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
						</svg>
						Ajouter à ma liste
					</a>
					<?php endif; ?>
				</div>
			</div>
		  </header>


		<section class="not-format mb-16" id="reviews">
			<div class="flex justify-between items-center mb-6">
				  <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Notes et Avis</h2>
			</div>
			<div class="flex items-center mb-3">
				<?php echo Component::display_user_score($book['score']); ?>
			</div>
			<p class="text-sm font-medium text-gray-500 dark:text-gray-400">
				<?php
				$reviews_count = count( Database::get_reviews_by_book( $book_id ) );
				echo ( $reviews_count === 1 ) ? $reviews_count . ' note' : $reviews_count . ' notes';
				?>
			</p>
			<?php
				$reviews = Database::get_reviews_by_book($book_id);
				$five_stars = 0;
				$four_stars = 0;
				$three_stars = 0;
				$two_stars = 0;
				$one_stars = 0;
				$pourcent_five = 0;
				$pourcent_four = 0;
				$pourcent_three = 0;
				$pourcent_two = 0;
				$pourcent_one = 0;

				foreach ($reviews as $review) {
					if ($review['score'] == 5) {
						$five_stars++;
					}
					if ($review['score'] == 4) {
						$four_stars++;
					}
					if ($review['score'] == 3) {
						$three_stars++;
					}
					if ($review['score'] == 2) {
						$two_stars++;
					}
					if ($review['score'] == 1) {
						$one_stars++;
					}
				}

				$sum = $five_stars + $four_stars + $three_stars + $two_stars + $one_stars;
				if ($sum !== 0){
					$pourcent_five = round(($five_stars / $sum) * 100,1);
					$pourcent_four = round(($four_stars / $sum) * 100,1);
					$pourcent_three = round(($three_stars / $sum) * 100,1);
					$pourcent_two = round(($two_stars / $sum) * 100,1);
					$pourcent_one = round(($one_stars / $sum) * 100,1);
				}

			?>
			<div class="flex items-center mt-4">
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500">5 star</span>
				<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
					<?php if ($pourcent_five > 0) { ?>
						<div class="h-5 bg-yellow-400 rounded" style="width: <?php echo $pourcent_five ?>%"></div>
					<?php } ?>
				</div>
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500"> <?php echo $pourcent_five?>% </span>
			</div>
			<div class="flex items-center mt-4">
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500">4 star</span>
				<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
					<?php if ($pourcent_four > 0) { ?>
						<div class="h-5 bg-yellow-400 rounded" style="width: <?php echo $pourcent_four?>%"></div>
					<?php } ?>
				</div>
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500"><?php echo $pourcent_four?> %</span>
			</div>
			<div class="flex items-center mt-4">
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500">3 star</span>
				<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
					<?php if ($pourcent_three > 0) { ?>
						<div class="h-5 bg-yellow-400 rounded" style="width: <?php echo $pourcent_three?>%"></div>
					<?php } ?>
				</div>
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500"><?php echo $pourcent_three?> %</span>
			</div>
			<div class="flex items-center mt-4">
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500">2 star</span>
				<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
					<?php if ($pourcent_two > 0) { ?>
						<div class="h-5 bg-yellow-400 rounded" style="width: <?php echo $pourcent_two?>%"></div>
					<?php } ?>
				</div>
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500"><?php echo $pourcent_two?> %</span>
			</div>
			<div class="flex items-center mt-4">
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500">1 star</span>
				<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
					<?php if ($pourcent_one > 0) { ?>
						<div class="h-5 bg-yellow-400 rounded" style="width: <?php echo $pourcent_one?>%"></div>
					<?php } ?>
				</div>
				<span class="text-sm font-medium text-blue-600 dark:text-blue-500"><?php echo $pourcent_one?>%</span>
			</div>
		  </section>


		  <?php
			if ( isset( $_POST['comment'] ) && ! empty( $_POST['comment'] ) && key_exists( 'comment', $_POST ) ) {
				echo '1';
			}
			?>





		  <section class="not-format">
			  <div class="flex justify-between items-center mb-6">
				  <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Commentaires (<?php echo count( Database::get_reviews_by_book( $book['id'] ) ); ?>)</h2>
			  </div>
			  <form class="mb-6">
				  <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
					  <label for="comment" class="sr-only">Your comment</label>
					  <textarea id="comment" rows="6"
						  name="comment"
						class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
						placeholder="Write a comment..." required></textarea>
				  </div>
				  <button type="submit"
					  class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
					  Post comment
				  </button>
			  </form>
			  <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
				  <footer class="flex justify-between items-center mb-2">
					  <div class="flex items-center">
						  <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
								  class="mr-2 w-6 h-6 rounded-full"
								  src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
								  alt="Michael Gough">Michael Gough</p>
						  <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
								  title="February 8th, 2022">Feb. 8, 2022</time></p>
					  </div>
					  <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
						  class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
						  type="button">
						  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
							  xmlns="http://www.w3.org/2000/svg">
							  <path
								  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
							  </path>
						  </svg>
						  <span class="sr-only">Comment settings</span>
					  </button>
					  <!-- Dropdown menu -->
					  <div id="dropdownComment1"
						  class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
						  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
							  aria-labelledby="dropdownMenuIconHorizontalButton">
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
							  </li>
						  </ul>
					  </div>
				  </footer>
				  <p class="text-gray-700 dark:text-gray-300">Very straight-to-point article. Really worth time reading. Thank you! But tools are just the
					  instruments for the UX designers. The knowledge of the design tools are as important as the
					  creation of the design strategy.</p>
				  <div class="flex items-center mt-4 space-x-4">
					  <button type="button"
						  class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
						  <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
						  Reply
					  </button>
				  </div>
			  </article>
			  <article class="p-6 mb-6 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">
				  <footer class="flex justify-between items-center mb-2">
					  <div class="flex items-center">
						  <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
								  class="mr-2 w-6 h-6 rounded-full"
								  src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
								  alt="Jese Leos">Jese Leos</p>
						  <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-12"
								  title="February 12th, 2022">Feb. 12, 2022</time></p>
					  </div>
					  <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
						  class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
						  type="button">
						  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
							  xmlns="http://www.w3.org/2000/svg">
							  <path
								  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
							  </path>
						  </svg>
						  <span class="sr-only">Comment settings</span>
					  </button>
					  <!-- Dropdown menu -->
					  <div id="dropdownComment2"
						  class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
						  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
							  aria-labelledby="dropdownMenuIconHorizontalButton">
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
							  </li>
						  </ul>
					  </div>
				  </footer>
				  <p class="text-gray-700 dark:text-gray-300">Much appreciated! Glad you liked it ☺️</p>
				  <div class="flex items-center mt-4 space-x-4">
					  <button type="button"
						  class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
						  <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
						  Reply
					  </button>
				  </div>
			  </article>
			  <article class="p-6 mb-6 text-base bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
				  <footer class="flex justify-between items-center mb-2">
					  <div class="flex items-center">
						  <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
								  class="mr-2 w-6 h-6 rounded-full"
								  src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
								  alt="Bonnie Green">Bonnie Green</p>
						  <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-03-12"
								  title="March 12th, 2022">Mar. 12, 2022</time></p>
					  </div>
					  <button id="dropdownComment3Button" data-dropdown-toggle="dropdownComment3"
						  class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
						  type="button">
						  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
							  xmlns="http://www.w3.org/2000/svg">
							  <path
								  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
							  </path>
						  </svg>
						  <span class="sr-only">Comment settings</span>
					  </button>
					  <!-- Dropdown menu -->
					  <div id="dropdownComment3"
						  class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
						  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
							  aria-labelledby="dropdownMenuIconHorizontalButton">
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
							  </li>
						  </ul>
					  </div>
				  </footer>
				  <p class="text-gray-700 dark:text-gray-300">The article covers the essentials, challenges, myths and stages the UX designer should consider while creating the design strategy.</p>
				  <div class="flex items-center mt-4 space-x-4">
					  <button type="button"
						  class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
						  <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
						  Reply
					  </button>
				  </div>
			  </article>
			  <article class="p-6 text-base bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
				  <footer class="flex justify-between items-center mb-2">
					  <div class="flex items-center">
						  <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
								  class="mr-2 w-6 h-6 rounded-full"
								  src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
								  alt="Helene Engels">Helene Engels</p>
						  <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-06-23"
								  title="June 23rd, 2022">Jun. 23, 2022</time></p>
					  </div>
					  <button id="dropdownComment4Button" data-dropdown-toggle="dropdownComment4"
						  class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
						  type="button">
						  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
							  xmlns="http://www.w3.org/2000/svg">
							  <path
								  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
							  </path>
						  </svg>
					  </button>
					  <!-- Dropdown menu -->
					  <div id="dropdownComment4"
						  class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
						  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
							  aria-labelledby="dropdownMenuIconHorizontalButton">
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
							  </li>
							  <li>
								  <a href="#"
									  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
							  </li>
						  </ul>
					  </div>
				  </footer>
				  <p class="text-gray-700 dark:text-gray-300">Thanks for sharing this. I do came from the Backend development and explored some of the tools to design my Side Projects.</p>
				  <div class="flex items-center mt-4 space-x-4">
					  <button type="button"
						  class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
						  <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
						  Reply
					  </button>
				  </div>
			  </article>
		  </section>
	  </article>
  </div>
</main>

<aside aria-label="Vous aimerez peut-être aussi" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
  <div class="px-4 mx-auto max-w-screen-xl">
	  <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Vous aimerez peut-être aussi</h2>
		<?php
			$limite_books     = 8;
			$number_books     = 0;
			$genres           = $book['genres'];
			$associated_books = array();

			foreach ($genres as $genre) {
				$books = Database::get_sorted_books(['genre' => $genre]);

				foreach ($books as $book) {
					if ($book['id'] !== $book_id && $number_books < $limite_books) {
						$associated_books[] = $book;
						$number_books ++;
					}
					if (count($associated_books) >= $limite_books) {
						break;
					}
				}
			}

			if (count($associated_books) === 0) {
				$associated_books = Database::get_sorted_books(['limit' => 4]);
			}

			Component::display_books( $associated_books );
		?>
  </div>
</aside>


<?php require_once 'includes/footer.php'; ?>
