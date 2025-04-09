<?php

/**
 * Template Name: UI Homepage
 * Template for displaying a new homepage.
 */

get_header();
?>

<div class="relative">
    <div class="w-full">
        <div class="min-h-screen">
            <div class="relative w-full h-full overflow-hidden pointer-events-none">
                <?php
                $video_id = get_field('video_bg');
                if ($video_id):
                ?>
                    <div class="video-background">
                        <iframe
                            src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&playlist=<?php echo esc_attr($video_id); ?>"
                            class="absolute top-1/2 left-1/2 w-screen h-[56.25vw] min-h-screen min-w-[177.77vh] -translate-x-1/2 -translate-y-1/2 pointer-events-none"
                            frameborder="0"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                        </iframe>
                    </div>
                <?php endif; ?>

                <div class="relative flex items-center justify-center min-h-screen bg-gradient-to-b from-black/90 to-black/40">
                    <div class="container mx-auto px-4">
                        <div class="max-w-4xl">
                            <h1 class="font-bold leading-tight">
                                <span class="inline md:inline-block text-4xl  px-3 bg-[var(--red)] text-white"><?php the_field('titulo_s1'); ?></span>
                            </h1>
                            <h2 class="text-3xl md:text-4xl text-white font-bold mt-2"><?php the_field('subtitulo_s1'); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="-mt-[244px] relative z-10">
    <div class="container mx-auto bg-[var(--dark)] rounded-3xl rounded-bl-none  rounded-br-none md:rounded-3xl p-4 md:p-12">
        <div class="w-full">
            <div x-data="{ activeTab: 1 }">

                <ul class="flex overflow-x-auto border-b border-white no-scrollbar">
                    <?php
                    $status_seleccion = get_field('status_seleccion');

                    $contador = 0;
                    if ($status_seleccion) {
                        foreach ($status_seleccion as $term) {
                            $contador++;
                            $term_id_safe = sanitize_title($term->slug);
                    ?>
                            <li class="mr-2" role="presentation">
                                <button
                                    @click="activeTab = <?php echo $contador; ?>"
                                    :class="{ 'text-white border-white': activeTab === <?php echo $contador; ?>, 'text-white/50 border-transparent hover:text-white hover:border-gray-300': activeTab !== <?php echo $contador; ?> }"
                                    class="inline-block px-4 py-2 uppercase text-lg tracking-wider font-bold border-b-2 transition-all duration-200 cursor-pointer text-nowrap"
                                    type="button"
                                    role="tab">
                                    <?php echo esc_html($term->name); ?>
                                </button>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>


                <div class="mt-4">
                    <div class="mt-4">
                        <?php
                        $contador = 0;
                        if ($status_seleccion) {
                            foreach ($status_seleccion as $term) {
                                $contador++;
                        ?>
                                <div
                                    x-show="activeTab === <?php echo $contador; ?>"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <?php
                                    $args = array(
                                        'post_type' => 'proyecto',
                                        'posts_per_page' => wp_is_mobile() ? 1 : 4,
                                        'orderby' => 'rand',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'status_proyecto',
                                                'field' => 'term_id',
                                                'terms' => $term->term_id,
                                            ),
                                        ),
                                    );

                                    query_posts($args);
                                    if (have_posts()) :
                                        while (have_posts()) : the_post();
                                            get_template_part('loop-templates/content-proyecto');
                                        endwhile;
                                        wp_reset_query();
                                    else:
                                        echo '<p class="text-white">No hay proyectos disponibles en esta categoría.</p>';
                                    endif;
                                    ?>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-t border-white my-6">

        <div class="flex flex-col md:flex-row justify-between items-center gap-y-4 md:gap-y-0">
            <span class="text-lg text-white"><?php the_field('subtitulo_2'); ?></span>
            <a href="/proyecto" class="px-6 py-2 bg-[var(--red)] text-white text-nowrap rounded-full hover:bg-[var(--darkred)] transition-colors"><?php the_field('texto_boton_1'); ?></a>
        </div>
    </div>
</div>

<div class="py-20">
    <div class="container mx-auto px-4 md:px-0">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold"><?php the_field('titulo_s12'); ?></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if (have_rows('tarjetas')): ?>
                <?php while (have_rows('tarjetas')): the_row();
                    $link = get_sub_field('link');
                    $imagen_fondo = get_sub_field('imagen_fondo');
                    if ($imagen_fondo && $link):
                ?>
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>" class="block relative h-[65vh] rounded-3xl overflow-hidden shadow-lg border border-gray-200 group">
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url(<?php echo esc_url($imagen_fondo); ?>)"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-black/20">
                                <div class="absolute bottom-0 right-0 p-8 text-right">
                                    <h2 class="text-white font-bold text-2xl mb-4"><?php echo esc_html(get_sub_field('copy')); ?></h2>
                                    <span class="inline-block px-6 py-2 bg-[var(--red)] text-white rounded-full group-hover:bg-[var(--darkred)] transition-colors"><?php echo esc_html(get_sub_field('cta')); ?></span>
                                </div>
                            </div>
                        </a>
                <?php
                    endif;
                endwhile; ?>
            <?php else: ?>
                <p class="text-center">No cards found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="pb-20">
    <div class="container mx-auto px-4 md:px-0">
        <div class="splide" role="group" aria-label="Banner Slider">
            <div class="splide__track">
                <div class="splide__list">
                    <?php if (have_rows('slider')): ?>
                        <?php while (have_rows('slider')): the_row();
                            $slide_image = get_sub_field('item_slide');
                            $link = get_sub_field('link');
                            if ($slide_image):
                        ?>
                                <div class="splide__slide">
                                    <?php if ($link): ?>
                                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>">
                                        <?php endif; ?>

                                        <img class="w-full rounded-3xl border border-gray-200 aspect-square md:aspect-video object-cover md:object-none" src="<?php echo esc_url($slide_image); ?>" alt="<?php echo esc_attr($link['title'] ?? ''); ?>">

                                        <?php if ($link): ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                        <?php
                            endif;
                        endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="splide__arrows">
                <button class="splide__arrow splide__arrow--prev">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="splide__arrow splide__arrow--next">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="splide__pagination"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('.splide', {
            type: 'slide',
            rewind: true,
            autoplay: true,
            interval: 5000,
            arrows: false,
            pagination: true,
            // classes: {
            //     arrows: 'splide__arrows absolute z-10',
            //     arrow: 'splide__arrow absolute top-1/2 -translate-y-1/2 p-2 rounded-full bg-black/30 text-white hover:bg-black/50 transition-colors',
            //     pagination: 'splide__pagination absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2',
            //     page: 'splide__pagination__page w-2 h-2 rounded-full bg-white/50 transition-colors duration-200'
            // }
        }).mount();
    });
</script>

<?php get_footer(); ?>