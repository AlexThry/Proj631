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
						<a href="circle.php?id=<?php echo $circle['id']; ?>">
							<div class="flex gap-x-4">
								<img class="object-cover h-12 w-12 flex-none rounded-full bg-gray-50 dark:bg-gray-600" src="<?php echo key_exists( 'image_url', $circle ) ? $circle['image_url'] : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'; ?>" alt="">
								<div class="min-w-0 flex-auto">
									<p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100"><?php echo $circle['title']; ?></p>
									<p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400"><?php echo $circle['description']; ?></p>
								<p class="mt-1 text-xs leading-5 text-gray-500">Admin: <?php echo $circle['admin_first_name'] . ' ' . $circle['admin_last_name'] . ' (' . $circle['admin_user_name'] . ')'; ?></p>
								</div>
							</div>
						</a>

						<div class="sm:flex sm:flex-col sm:items-end">
							<?php
							$is_subscribed = Database::user_is_subscribed($user['id'], $circle['id']);
							$subscription_url = "change-circle-subscription?circle-id=".$circle['id']."&previous-url=$_SERVER[REQUEST_URI]";
							if ( $is_subscribed  ) :
							?>
								<a href="<?php echo $subscription_url ?>"  class="text-white bg-blue-700 inline-flex flex-align hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
									<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1"© viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
									</svg>
									Abonné
								</a>
							<?php else : ?>
								<a href="<?php echo $subscription_url ?>"  class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">S'abonner</a>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
