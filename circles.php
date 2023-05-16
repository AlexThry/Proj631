<?php require_once 'includes/header.php'; ?>

<div class="content">
	<section class="bg-white dark:bg-gray-900">
		<div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
			<a href="https://github.com/AlexThry/Proj631" class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700" role="alert">
				<span class="text-xs bg-blue-600 rounded-full text-white px-4 py-1.5 mr-3">Nouveau</span> <span class="text-sm font-medium">N'hésitez pas à venir nous noter</span>
				<svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
			</a>
			<h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Les cercles d'amis</h1>
			<p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Les cercles d'amis vous permettent de partager des avis avec des groupes pour lesquels vous partagez des centres d'intérêts.</p>
		</div>
	</section>

	<?php require_once 'includes/circle-list.php'; ?>

</div>

<?php
require_once 'includes/footer.php';
