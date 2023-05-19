<?php

require_once 'functions.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Readable</title>
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			darkMode: 'class',
			theme: {
				// colors: {
				// 'blue': '#1fb6ff',
				// 'purple': '#7e5bef',
				// 'pink': '#ff49db',
				// 'orange': '#ff7849',
				// 'green': '#13ce66',
				// 'yellow': '#ffc82c',
				// 'gray-dark': '#273444',
				// 'gray': '#8492a6',
				// 'gray-light': '#d3dce6',
				// },
				// fontFamily: {
				// sans: ['Graphik', 'sans-serif'],
				// serif: ['Merriweather', 'serif'],
				// },
				// extend: {
				// 	spacing: {
				// 		'8xl': '96rem',
				// 		'9xl': '128rem',
				// 	},
				// 	borderRadius: {
				// 		'4xl': '2rem',
				// 	}
				// }
			},
		}
	</script>
	<script>
		// On page load or when changing themes, best to add inline in `head` to avoid FOUC
		if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: light)').matches)) {
			document.documentElement.classList.add('dark');
		} else {
			document.documentElement.classList.remove('dark')
		}
	</script>
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="page-<?php echo get_url_basename(); ?> bg-white dark:bg-gray-800">
	<main>
		<div class="page-container overflow-hidden">

		<header class="sticky top-0 z-40 flex-none w-full mx-auto bg-white fixed border-b border-gray-200 dark:border-gray-600 dark:bg-gray-800">
			<?php if ( is_home_page() && empty( $_GET ) ) : ?>
			<div id="banner" tabindex="-1" class="z-50 flex justify-center w-full px-4 py-3 border border-b border-gray-200 bg-gray-50 dark:border-gray-600 lg:py-4 dark:bg-gray-700">
				<div class="items-center md:flex">
					<p class="text-sm font-medium text-gray-900 md:my-0 dark:text-white">
					<span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hidden md:inline">New</span>
					Explorez notre Roadmap et votez pour les fonctionnalités que vous souhaitez voir apparaître en premier !
						<a href="https://github.com/AlexThry/Proj631" class="inline-flex items-center ml-2 text-sm font-medium text-blue-600 md:ml-2 dark:text-blue-500 hover:underline">
						Découvrir
						<svg class="w-4 h-4 ml-1 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fillrule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" cliprule="evenodd"></path>
						</svg>
						</a>
					</p>
				</div>
			</div>
			<?php endif; ?>

			<nav class="flex items-center justify-between w-full px-3 py-3 mx-auto max-w-8xl lg:px-4">

				<div class="flex items-center">
					<div class="flex items-center justify-between">
						<a href="<?php echo get_home_url(); ?>" class="flex">
							<h1 class="logo-line text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">
								<img src="assets/images/logo.svg" alt="Readbable">
								<span class="hidden lg:block">
									Readable
								</span>
							</h1>
						</a>
					</div>
					
					<div class="ml-8 sm:block hidden">
						<?php require 'search-bar.php'; ?>
					</div>

				</div>

				<div class="flex items-center">

					<div class="flex-col hidden pt-6 lg:flex-row lg:self-center lg:py-0 lg:flex mr-2" id="mobile-menu-1">
						<ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
							<li>
								<a href="<?php echo get_home_url(); ?>" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Accueil</a>
							</li>
							<li>
								<a href="circles.php" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Cercles</a>
							</li>
						</ul>
					</div>
					
					<a href="https://github.com/AlexThry/Proj631" data-tooltip-target="tooltip-github-2" class="hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-1">
						<svg class="w-5 h-5" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
						<span class="sr-only">Voir sur Github</span>
					</a>
					<div id="tooltip-github-2" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(808.5px, -62px, 0px);">
						Voir sur Github
						<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(59.5px, 0px, 0px);"></div>
					</div>
					
					<a href="https://discord.gg/4eeurUVvTy" data-tooltip-target="tooltip-discord-2" class="hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-1">
						<svg class="w-6 h-6" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="discord" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M524.5 69.84a1.5 1.5 0 0 0 -.764-.7A485.1 485.1 0 0 0 404.1 32.03a1.816 1.816 0 0 0 -1.923 .91 337.5 337.5 0 0 0 -14.9 30.6 447.8 447.8 0 0 0 -134.4 0 309.5 309.5 0 0 0 -15.14-30.6 1.89 1.89 0 0 0 -1.924-.91A483.7 483.7 0 0 0 116.1 69.14a1.712 1.712 0 0 0 -.788 .676C39.07 183.7 18.19 294.7 28.43 404.4a2.016 2.016 0 0 0 .765 1.375A487.7 487.7 0 0 0 176 479.9a1.9 1.9 0 0 0 2.063-.676A348.2 348.2 0 0 0 208.1 430.4a1.86 1.86 0 0 0 -1.019-2.588 321.2 321.2 0 0 1 -45.87-21.85 1.885 1.885 0 0 1 -.185-3.126c3.082-2.309 6.166-4.711 9.109-7.137a1.819 1.819 0 0 1 1.9-.256c96.23 43.92 200.4 43.92 295.5 0a1.812 1.812 0 0 1 1.924 .233c2.944 2.426 6.027 4.851 9.132 7.16a1.884 1.884 0 0 1 -.162 3.126 301.4 301.4 0 0 1 -45.89 21.83 1.875 1.875 0 0 0 -1 2.611 391.1 391.1 0 0 0 30.01 48.81 1.864 1.864 0 0 0 2.063 .7A486 486 0 0 0 610.7 405.7a1.882 1.882 0 0 0 .765-1.352C623.7 277.6 590.9 167.5 524.5 69.84zM222.5 337.6c-28.97 0-52.84-26.59-52.84-59.24S193.1 219.1 222.5 219.1c29.67 0 53.31 26.82 52.84 59.24C275.3 310.1 251.9 337.6 222.5 337.6zm195.4 0c-28.97 0-52.84-26.59-52.84-59.24S388.4 219.1 417.9 219.1c29.67 0 53.31 26.82 52.84 59.24C470.7 310.1 447.5 337.6 417.9 337.6z"></path></svg>
						<span class="sr-only">Rejoindre notre communauté Discord</span>
					</a>
					<div id="tooltip-discord-2" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(815px, -64px, 0px);">
					Rejoindre notre communauté Discord
						<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(99px, 0px, 0px);"></div>
					</div>

					<a href="https://www.youtube.com/channel/UC_Ms4V2kYDsh7F_CSsHyQ6A" data-tooltip-target="tooltip-youtube" class="hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-1">
						<svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
						<span class="sr-only">Flowbite YouTube</span>
					</a>
					<div id="tooltip-youtube" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(852.5px, -64px, 0px);">
						Abonnez vous à chaîne YouTube
						<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(109.5px, 0px, 0px);"></div>
					</div>

					<button id="theme-toggle" data-tooltip-target="theme-tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
						<svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
						<svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
						<span class="sr-only">Toggle dark mode</span>
					</button>
					<div id="theme-tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(939.5px, -62px, 0px);">
						Changez de thème
						<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(68.5px, 0px, 0px);"></div>
					</div>

					<?php
						$current_user = get_user();
					if ( ! $current_user ) :
						?>

					<a href="connection.php" data-tooltip-target="tooltip-connection" class="py-2.5 px-5 ml-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
						Connexion
					</a>
					<div id="tooltip-connection" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(815px, -64px, 0px);">
						Se connecter
						<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(99px, 0px, 0px);"></div>
					</div>

					<a href="subscription.php" data-tooltip-target="tooltip-inscription" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
						Inscription
					</a>
					<div id="tooltip-inscription" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(815px, -64px, 0px);">
						S'inscrire
						<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(99px, 0px, 0px);"></div>
					</div>

					<?php
						else :
							$profile_url = $current_user['profile_url'];
							?>

					<!-- Profile dropdown -->
					<div class="relative ml-3">
						<button data-dropdown-toggle="dropdown-user" data-tooltip-target="tooltip-user" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
							<span class="sr-only">Mon compte</span>
							<img class="h-8 w-8 rounded-full" src="<?php echo ! empty( $profile_url ) ? $profile_url : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'; ?>" alt="Photo de profil">
						</button>
						<div id="tooltip-user" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(815px, -64px, 0px);">
							<?php echo $current_user['user_name']; ?>
							<div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(99px, 0px, 0px);"></div>
						</div>

						<div id="dropdown-user" class="z-10 hidden bg-white divide-y border divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:border-gray-600">
							<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
							<li>
								<a href="account.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mon compte</a>
							</li>
							<li>
								<a href="account.php?tab=user_books" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mes livres</a>
							</li>
							<li>
								<a href="account.php?tab=user_wishlist" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ma whishlist</a>
							</li>
							<li>
								<a href="account.php?tab=user_circles" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mes cercles</a>
							</li>
							<li>
								<a href="logout.php" class="flex items-center p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500">
									<svg class="w-5 h-5 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path></svg>
									Déconnexion
								</a>
							</li>
							</ul>
						</div>

					</div>

					<?php endif; ?>

					<button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
						<span class="sr-only">Ouvrir le menu</span>
						<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
						<svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
					</button>
				</div>
			</nav>

			<nav class="w-full flex-col lg:hidden lg:flex-row lg:self-center lg:py-0 lg:flex" id="mobile-menu-2">
				<ul class="flex flex-col font-medium lg:flex-row lg:space-x-8 lg:mt-0">
					<li>
						<a href="<?php echo get_home_url(); ?>" class="block py-2 pr-8 pl-8 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Accueil</a>
					</li>
					<li>
						<a href="circles.php" class="block py-2 pr-8 pl-8 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Cercles</a>
					</li>
				</ul>
			</nav>
		</header>
