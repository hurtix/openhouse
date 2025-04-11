<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package openhouse
 */

?>

<header id="masthead" class="w-full fixed top-0 z-50 bg-transparent transition-all duration-700" style="[x-cloak]{display:none !important;}">
	<?php
	if (isCurrency()) :
	?>
		<div class="w-full text-[0.75rem] text-center text-white bg-[var(--red)] py-1"><span class="block w-3/4 mx-auto leading-none md:leading-normal">Los precios en moneda extranjera son un aproximado calculados según la TRM del día.</span></div>
	<?php
	endif;
	?>
	<div class="container mx-auto py-4">
		<div class="flex justify-between items-center px-4 md:px-0">
			<div class="z-2">
				<a href="/">
					<img class="w-[150px]" src="<?php echo get_template_directory_uri(); ?>/assets/img/imagotipo.svg" alt="">
				</a>
			</div>
			<div class="flex justify-between items-center gap-4">
			<nav id="site-navigation" x-data="{ isOpen: false }" class="flex items-center gap-6" x-init="$watch('isOpen', value => { if (value) document.body.style.overflow = 'hidden'; else document.body.style.overflow = 'auto'; })">
    <div class="lg:hidden fixed bottom-5 right-5 z-50">
        <button
            @click="isOpen = !isOpen"
            class="w-[50px] h-[50px] bg-[var(--red)] hover:bg-[var(--darkred)] rounded-full shadow-[0_0_0_4px_rgba(0,0,0,0.3)] hover:shadow-[0_0_0_8px_rgba(0,0,0,0.3)] flex items-center justify-center text-white transition-all duration-200 focus:outline-none cursor-pointer"
            :class="{ 'animate-[pulse_0.6s_linear_forwards]': isOpen }"
            aria-controls="primary-menu"
            :aria-expanded="isOpen">
                       <div class="w-5 h-5 flex flex-col justify-between transition-transform duration-300"
                :class="{'[transform:rotate(-45deg)]': isOpen}">
                <div class="w-1/2 h-0.5 bg-white rounded transition-transform duration-300 origin-right"
                    :class="{ '[transform:rotate(-90deg)_translateX(1px)]': isOpen }"></div>
                <div class="w-full h-0.5 bg-white rounded"></div>
                <div class="w-1/2 h-0.5 bg-white rounded self-end transition-transform duration-300 origin-left"
                    :class="{ '[transform:rotate(-90deg)_translateX(-1px)]': isOpen }"></div>
            </div>
            <span class="sr-only">Menu</span>
        </button>
    </div>

	<?php
    wp_nav_menu(
        array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
            'menu_class'     => 'fixed h-full lg:h-auto lg:relative top-0 left-0 w-full lg:w-auto bg-[var(--dark)] lg:bg-transparent p-4 lg:p-0 flex flex-col justify-center lg:flex-row items-center uppercase tracking-[5px] lg:tracking-normal lg:normal-case gap-6 transition-all duration-300 transform',
            'items_wrap'     => '<ul x-cloak x-show.important="isOpen || window.innerWidth >= 1024" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" id="%1$s" class="%2$s">%3$s</ul>',
            'walker'         => new class extends Walker_Nav_Menu {
                public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                {
                    $output .= '<li><a href="' . esc_url($item->url) . '" class="block py-2 lg:py-0 text-xl text-white hover:text-gray-200 transition-colors">' . $item->title . '</a></li>';
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
				<button type="button" class="hidden lg:block border border-white px-4 py-2 bg-[var(--red)] rounded-full text-white hover:bg-[var(--darkred)] cursor-pointer" onclick="abrirSplash();">
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