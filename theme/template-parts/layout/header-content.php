<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package openhouse
 */

?>

<header id="masthead" class="w-full fixed top-0 z-50 bg-transparent transition-all duration-700">
	<?php
	if (isCurrency()) :
	?>
		<div class="w-full text-[0.75rem] text-center text-white bg-[var(--red)] py-1">Los precios en moneda extranjera son un aproximado calculados según la TRM del día.</div>
	<?php
	endif;
	?>
	<div class="container mx-auto py-4">
		<div class="flex justify-between items-center px-4 md:px-0">
			<div>
				<a href="/">
					<img class="w-[150px]" src="https://open-house.com.co/wp-content/uploads/imagotipo.svg" alt="">
				</a>
			</div>
			<div class="flex justify-between items-center gap-4">
				<nav id="site-navigation" class="flex items-center gap-6" aria-label="<?php esc_attr_e('Main Navigation', 'openhouse'); ?>">
					<!-- <button class="lg:hidden text-white" aria-controls="primary-menu" aria-expanded="false">
						<?php esc_html_e('Primary Menu', 'openhouse'); ?>
					</button> -->

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'hidden lg:flex items-center gap-6',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker'         => new class extends Walker_Nav_Menu {
								public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
								{
									$output .= '<li><a href="' . esc_url($item->url) . '" class="text-xl text-white hover:text-gray-200 transition-colors">' . $item->title . '</a></li>';
								}
							}
						)
					);
					?>
				</nav>

				<div x-data="{ 
    open: false,
    currentCurrency: '<?php echo isset($_GET['currency']) ? esc_attr($_GET['currency']) : 'COP'; ?>',
    labels: {
        'COP': '$ COP',
        'USD': '$ USD',
        'EUR': '€ EUR'
    }
}" class="relative">
					<button
						@click="open = !open"
						@click.away="open = false"
						class="px-4 py-2 text-white border border-white rounded-full hover:bg-white/10 transition-colors flex items-center gap-2 text-nowrap">
						<span x-text="labels[currentCurrency] || 'Divisa'"></span>
						<svg class="w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
						</svg>
					</button>

					<ul
						x-show="open"
						x-transition:enter="transition ease-out duration-200"
						x-transition:enter-start="opacity-0 translate-y-1"
						x-transition:enter-end="opacity-100 translate-y-0"
						x-transition:leave="transition ease-in duration-150"
						x-transition:leave-start="opacity-100 translate-y-0"
						x-transition:leave-end="opacity-0 translate-y-1"
						class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg py-2 z-50">
						<template x-for="(label, currency) in labels" :key="currency">
							<li>
								<a :href="`<?php echo esc_url(remove_query_arg('currency', $_SERVER['REQUEST_URI'])); ?>${currency ? '?currency=' + currency : ''}`"
									:class="{'font-bold text-red-600': currentCurrency === currency}"
									class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
									x-text="label"></a>
							</li>
						</template>
					</ul>
				</div>
				<button type="button" class="hidden md:block border border-white px-4 py-2 bg-[var(--red)] rounded-full text-white hover:bg-[var(--darkred)] cursor-pointer" onclick="abrirSplash();">
					Te llamamos
				</button>
				<div class="w-[1px] bg-white/50 h-[30px]"></div>
				<?php get_template_part('part-templates/flotante'); ?>
			</div>
		</div>
	</div>
</header>
<?php get_template_part('part-templates/splash-screen'); ?>
<script>
	const header = document.getElementById('masthead');

	const onScroll = () => {
		if (window.pageYOffset > 50) {
			header.classList.add('bg-[var(--dark)]');
			header.classList.remove('bg-transparent');
		} else {
			header.classList.remove('bg-[var(--dark)]');
			header.classList.add('bg-transparent');
		}
	}

	window.addEventListener('scroll', onScroll);
</script>

<script>
	// Funciones para abrir y cerrar el modal
	function abrirSplash() {
		document.getElementById('resultSplash').classList.remove('hidden');
		document.body.classList.add('overflow-hidden'); // Evita scroll en el fondo
	}

	function cerrarSplash() {
		document.getElementById('resultSplash').classList.add('hidden');
		document.body.classList.remove('overflow-hidden');
	}

	// Cerrar el modal con la tecla Escape
	//   document.addEventListener('keydown', function(event) {
	//     if (event.key === 'Escape') {
	//       cerrarModal();
	//     }
	//   });

	// Cerrar el modal al hacer clic fuera de él
	// document.getElementById('resultModal').addEventListener('click', function(event) {
	//     if (event.target === this) {
	//         cerrarModal();
	//     }
	// });
</script>