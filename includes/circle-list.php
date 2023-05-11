<?php

$user = get_user();

$circles = Database::get_circles();

?>

<section class="relative">
	<div class="pt-8 sm:pt-12 lg:pt-20 pb-40 sm:pb-20 lg:pb-24">
		<div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8 flex flex-col gap-4 align-center">
			<h2 class="mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Tous les cercles</h2>

			<ul role="list" class="divide-y divide-gray-100">
				<?php foreach ( $circles as $circle ) : ?>
					<li class="flex justify-between gap-x-6 py-5">
						<div class="flex gap-x-4">
						<img class="h-12 w-12 flex-none rounded-full bg-gray-50 dark:bg-gray-600" src="<?php echo key_exists( 'image_url', $circle ) ? $circle['image_url'] : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'; ?>" alt="">
						<div class="min-w-0 flex-auto">
							<p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100"><?php echo $circle['title']; ?></p>
							<p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400"><?php echo $circle['description']; ?></p>
						</div>
						</div>
						<div class="hidden sm:flex sm:flex-col sm:items-end">
						<p class="text-sm leading-6 text-gray-900 dark:text-gray-200"><?php echo $circle['admin_user_name']; ?></p>
						<p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z"><?php echo $circle['admin_first_name'] . ' ' . $circle['admin_last_name']; ?></time></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
