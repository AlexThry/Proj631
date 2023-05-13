<?php

require_once 'includes/header.php';
$book_id = $_GET['id'];

if ( ! $book_id ) {
	header( 'Location: ' . get_home_url() );
	exit();
}

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
						<p class="ml-2 text-sm font-bold text-gray-900 dark:text-white"><?php echo $book['score']; ?></p>
						<span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
						<a href="#reviews" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white"><?php echo $book['nb_reviews']; ?> avis</a>
					</div>

					<dl>
						<dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</dt>
						<dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo $book['description']; ?></dd>
					</dl>
					<dl class="flex items-center space-x-6">
						<div>
							<dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Catégories</dt>
							<dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo join(", ",$book['genres'])?></dd>
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
						<button type="button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
							Ajouter à ma liste
						</button>   
						<button type="button" class="opacity-50 inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
							<svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							Supprimer de ma liste
						</button> 
					</div>
				</div>
			</header>


			<section class="not-format mb-16" id="reviews">
				<div class="flex justify-between items-center mb-6">
					<h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Notes et Avis</h2>
				</div>
				<div class="flex items-center mb-3">
					<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					<svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					<p class="ml-2 text-sm font-medium text-gray-900 dark:text-white"><?php 
					$moyenne = Database::get_moyenne_by_book($book['id']);
					if ($moyenne) {
						echo "moyenne : " . $moyenne . "/5";
					} else {
						echo "aucune note";
					}
					
					?></p>
				</div>
				<p class="text-sm font-medium text-gray-500 dark:text-gray-400">
					<?php 
					$nb_reviews = count(Database::get_reviews_by_book($book['id']));
					if ($nb_reviews) {
						echo $nb_reviews . "notes";
					} 
					?>
				</p>
				<div class="flex items-center mt-4">
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">5 star</span>
					<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
						<div class="h-5 bg-yellow-400 rounded" style="width: 70%"></div>
					</div>
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">70%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">4 star</span>
					<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
						<div class="h-5 bg-yellow-400 rounded" style="width: 17%"></div>
					</div>
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">17%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">3 star</span>
					<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
						<div class="h-5 bg-yellow-400 rounded" style="width: 8%"></div>
					</div>
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">8%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">2 star</span>
					<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
						<div class="h-5 bg-yellow-400 rounded" style="width: 4%"></div>
					</div>
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">4%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">1 star</span>
					<div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700 flex-1">
						<div class="h-5 bg-yellow-400 rounded" style="width: 1%"></div>
					</div>
					<span class="text-sm font-medium text-blue-600 dark:text-blue-500">1%</span>
				</div>   
			</section>
			<?php

				// if (isset($_POST['comment']) && !empty($_POST['comment']) && key_exists('comment', $_POST)
				// 	&& isset($_POST['star-input1']) && !empty($_POST['star-input1']) && key_exists('star-input1', $_POST)
				// 	&& isset($_POST['star-input2']) && !empty($_POST['star-input2']) && key_exists('star-input2', $_POST)
				// 	&& isset($_POST['star-input3']) && !empty($_POST['star-input3']) && key_exists('star-input3', $_POST)
				// 	&& isset($_POST['star-input4']) && !empty($_POST['star-input4']) && key_exists('star-input4', $_POST)
				// 	&& isset($_POST['star-input5']) && !empty($_POST['star-input5']) && key_exists('star-input5', $_POST)) {
				// 		$comment = $_POST['comment'];
				// 		$user_id = get_user()['id'];
				// 		$date = date('Y-m-d', strtotime('today'));
				// 		$score = 0;
				// 		$star_inputs = array($_POST['star-input1'],$_POST['star-input2'],$_POST['star-input3'],$_POST['star-input4'],$_POST['star-input5']);


				// 		foreach ($star_inputs as $input) {
				// 			$score += 1;
				// 			if ($input == "on") {
				// 				break;
				// 			}
				// 		}

				// 		try {
				// 			Database::add_review($comment, $book_id, $user_id, $date, $score);
				// 			echo "<script>alert('Votre commentaire a bien été ajouté !')</script>";
				// 		} catch (Exception $e) {
				// 			echo $e->getMessage();
				// 		}
				// 	}
			?>



			<section class="not-format">
				<div class="flex justify-between items-center mb-6">
					<h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Commentaires (<?php echo count(Database::get_reviews_by_book($book['id'])); ?>)</h2>
				</div>

				<?php 
				if (get_user() !== false) {
					if (isset($_POST['comment']) && !empty($_POST['comment']) && key_exists('comment', $_POST)
					&& isset($_POST['star-input1']) && !empty($_POST['star-input1']) && key_exists('star-input1', $_POST)
					&& isset($_POST['star-input2']) && !empty($_POST['star-input2']) && key_exists('star-input2', $_POST)
					&& isset($_POST['star-input3']) && !empty($_POST['star-input3']) && key_exists('star-input3', $_POST)
					&& isset($_POST['star-input4']) && !empty($_POST['star-input4']) && key_exists('star-input4', $_POST)
					&& isset($_POST['star-input5']) && !empty($_POST['star-input5']) && key_exists('star-input5', $_POST)) {
						$comment = $_POST['comment'];
						$user_id = get_user()['id'];
						$date = date('Y-m-d', strtotime('today'));
						$score = 0;
						$star_inputs = array($_POST['star-input1'],$_POST['star-input2'],$_POST['star-input3'],$_POST['star-input4'],$_POST['star-input5']);


						foreach ($star_inputs as $input) {
							$score += 1;
							if ($input == "on") {
								break;
							}
						}

						try {
							Database::add_review($comment, $book_id, $user_id, $date, $score);
							echo "<script>alert('Votre commentaire a bien été ajouté !')</script>";
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
					echo "<form method='post' class='mb-6 comment-form' action='book.php?id=$book_id'?>
					<div class='ratin-section'>	
						<label for='rating'> Note : </label>
						<div class='comment-rating-stars'>
							<svg aria-hidden='true' class='rating-star w-5 h-5 text-yellow-400' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' data-index=1><title>First star</title><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'></path></svg>
							<svg aria-hidden='true' class='rating-star w-5 h-5 text-yellow-400' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' data-index=2><title>Second star</title><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'></path></svg>
							<svg aria-hidden='true' class='rating-star w-5 h-5 text-yellow-400' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' data-index=3><title>Third star</title><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'></path></svg>
							<svg aria-hidden='true' class='rating-star w-5 h-5 text-gray-300 dark:text-gray-500' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' data-index=4><title>Fourth star</title><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'></path></svg>
							<svg aria-hidden='true' class='rating-star w-5 h-5 text-gray-300 dark:text-gray-500' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' data-index=5><title>Fifth star</title><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'></path></svg>
							<input id='1star' type='hidden' name='star-input1' class='star-input' data-index=1 value='off'>
							<input id='2star' type='hidden' name='star-input2' class='star-input' data-index=2 value='off'>
							<input id='3star' type='hidden' name='star-input3' class='star-input' data-index=3 value='on'>
							<input id='4star' type='hidden' name='star-input4' class='star-input' data-index=4 value='off'>
							<input id='5star' type='hidden' name='star-input5' class='star-input' data-index=5 value='off'>
						</div>
					</div>
					<div class='py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700'>
						<label for='comment' class='sr-only'>Your comment</label>
						<textarea id='comment' rows='6'
							name='comment'
							class='px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800'
							placeholder='Write a comment...' required></textarea>
					</div>
					<button type='submit' 
						class='inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800'>
						Post comment
						</button>
					</form>";

				} else {
					echo "<h1>Veuillez vous connecter pour poster un commentaire</h1>";
				}
				?>



				<?php

				$infos = Database::get_reviews_by_book($book_id);
				foreach ($infos as $info) {
					$user_name = $info['user_name'];
					$comment = $info['content'];
					$rating = $info['score'];
					$date = $info['parution_date'];
					if ($info['profile_url'] == null) {
						$avatar = 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80';
					} else {
						$avatar = $info['profile_url'];
					}



					if ($rating == 1) {
						$stars = 
						'<div class="comment-stars">

						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=1><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=2><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=3><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=4><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=5><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					</div>';
					} elseif ($rating == 2) {
						$stars = 
						'<div class="comment-stars">

						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=1><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=2><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=3><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=4><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=5><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					</div>';
					} elseif ($rating == 3) {
						$stars = 
						'<div class="comment-stars">

						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=1><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=2><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=3><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=4><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=5><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					</div>';
					} elseif ($rating == 4) {
						$stars = 
						'<div class="comment-stars">

						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=1><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=2><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400 selected" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=3><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=4><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=5><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					</div>';
					} elseif ($rating == 5) {
						$stars = 
						'<div class="comment-stars">

						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=1><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=2><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400 selected" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=3><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=4><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
						<svg aria-hidden="true" class="comment-star w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-index=5><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
					</div>';
					}
				
				
			
					echo "<article class='p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900'>
						<footer class='flex justify-between items-center mb-2'>
							<div class='flex items-center'>
								<p class='inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white'><img
										class='mr-2 w-6 h-6 rounded-full'
										src='" . $avatar . "'
										alt=''>" . $user_name . "</p>
								<p class='text-sm text-gray-600 dark:text-gray-400'><time pubdate datetime=" . $date . "
										title=" . $date . ">" . $date . "</time></p>
							" . $stars . "
							</div>
							<div id='dropdownComment1'
							class='hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600'>
							<ul class='py-1 text-sm text-gray-700 dark:text-gray-200'
								aria-labelledby='dropdownMenuIconHorizontalButton'>
								<li>
									<a href=''
										class='block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Edit</a>
								</li>
								<li>
									<a href='#'
										class='block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Remove</a>
								</li>
								<li>
									<a href='#'
										class='block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Report</a>
								</li>
							</ul>
						</div>
					</footer>
					<p class='text-gray-700 dark:text-gray-300'>" . $comment . "</p>
					</article>";
				}

				?>
						
				
				

	<?php require_once 'includes/footer.php'; ?>
