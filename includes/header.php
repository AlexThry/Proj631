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
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
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
	<link rel="stylesheet" href="assets/css/tailwind-style.css">
</head>

<body class="page-<?php echo get_url_basename(); ?>">
	<main>
		<div class="page-container">
		<header class="bg-gray-800">
			<nav class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
				<div class="relative flex h-16 items-center justify-between">
				<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
					<!-- Mobile menu button-->
					<button type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
					<span class="sr-only">Open main menu</span>
					<!--
						Icon when menu is closed.

						Menu open: "hidden", Menu closed: "block"
					-->
					<svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
					</svg>
					<!--
						Icon when menu is open.

						Menu open: "block", Menu closed: "hidden"
					-->
					<svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
					</button>
				</div>
				<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
					<a href="<?php echo get_home_url(); ?>" class="flex flex-shrink-0 items-center">

					<img class="block h-8 w-auto lg:hidden logo" src="assets/images/logo-light.svg" alt="Readable">
					<img class="hidden h-8 w-auto lg:block logo" src="assets/images/logo-light.svg" alt="Readable">
					</a>
					<div class="hidden sm:ml-6 sm:block">
					<div class="flex space-x-4">
						<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
						<a href="<?php echo get_home_url(); ?>" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
						<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Cercles</a>
					</div>
					</div>
				</div>
				<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
					<button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
					<span class="sr-only">View notifications</span>
					<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
					</svg>
					</button>

					<?php 
					$current_user = get_user();
					if ( ! $current_user ) : ?>

					<!-- DISCONNECTED USER -->
					<div class="header-menu right-part">
						<div class="btn signup">
							<a href="subscription.php">Inscription</a>
						</div>

						<div class="btn login">
							<a href="connection.php">Connexion</a>
						</div>
					</div>

					<?php else : ?>

					<!-- CONNECTED USER -->
					<div class="header-menu right-part">
						<h1><?php echo $current_user->getName(); ?></h1>
						<a href="account.php">
							<img src="assets/images/account.svg" alt="Mon compte">
						</a>
						<a href="logout.php">
							<img src="assets/images/logout.svg" alt="Se déconnecter">
						</a>
					</div>

					<?php endif; ?>

					<!-- Profile dropdown -->
					<div class="relative ml-3">
					<div>
						<button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
							<span class="sr-only">Open user menu</span>
							<?php // user image link ?>
							<img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
						</button>
					</div>

					<!--
						Dropdown menu, show/hide based on menu state.

						Entering: "transition ease-out duration-100"
						From: "transform opacity-0 scale-95"
						To: "transform opacity-100 scale-100"
						Leaving: "transition ease-in duration-75"
						From: "transform opacity-100 scale-100"
						To: "transform opacity-0 scale-95"
					-->
					<div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
						<!-- Active: "bg-gray-100", Not Active: "" -->
						<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
						<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
						<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
					</div>
					</div>
				</div>
				</div>
			</nav>

			<!-- Mobile menu, show/hide based on menu state. -->
			<nav class="sm:hidden" id="mobile-menu">
				<div class="space-y-1 px-2 pb-3 pt-2">
				<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
				<a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
				<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Team</a>
				<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
				<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
				</div>
			</nav>
		</header>
