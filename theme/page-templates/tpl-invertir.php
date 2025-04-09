<?php

/**
 * Template Name: UI Invertir
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 */


get_header();
?>
<script type="module" src="https://cdn.jsdelivr.net/npm/@justinribeiro/lite-youtube@1/lite-youtube.min.js"></script>



<div class="bg-[var(--dark)] h-[35vh]">
    <div class="container mx-auto flex justify-center items-start h-full flex-col pt-20 text-white px-4 md:px-0">
        <h2 class="font-bold text-4xl"><?php the_title(); ?></h2>
        <p>Explora nuestra selección de proyectos destacados y encuentra el lugar ideal para vivir, trabajar o invertir.</p>
    </div>
</div>

<div class="w-full bg-gray-100 py-20">
    <div class="container mx-auto px-4 md:px-0">
        <div class="flex flex-wrap mb-16 items-center">
            <div class="w-full md:w-1/3">
                <h2 class="font-bold text-4xl"><?php the_field('titulo_1'); ?></h2>
            </div>
            <div class="w-full md:w-2/3">
                <?php get_template_part('part-templates/carrusel-proyectos'); ?>
            </div>
        </div>

        <div class="w-full">
            <div class="w-full">
                <ul class="w-full flex justify-center items-center gap-0 flex-nowrap mb-16 investment-tabs" id="investmentTabs" role="tablist">
                    <li class="relative w-full md:w-1/4 tab-item transition-all duration-300 ease-in-out" role="presentation">
                        <button class="tab-button active w-full p-0 cursor-pointer" id="exterior-tab" data-target="exterior" type="button" role="tab" aria-controls="exterior" aria-selected="true">
                            <div class="big-hyperlink overflow-hidden relative rounded-[20px] rounded-tr-none rounded-br-none shadow-sm border border-gray-200 bg-cover bg-center h-[50vh] md:h-[65vh] bg-[url('https://storage.googleapis.com/bucket-jm-web/wp-content/uploads/2023/07/colombiana.webp')]">
                                <div class="absolute inset-0 bg-black/50">
                                    <div class="text-center p-2 md:p-8 h-full flex justify-end items-center md:items-end flex-col">
                                        <?php if (have_rows('encabezado-1')) : ?>
                                            <?php while (have_rows('encabezado-1')) : the_row(); ?>
                                                <h2 class="text-white font-bold mb-4 text-3xl"><?php the_sub_field('titulo'); ?></h2>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                        <span class="inline-block px-6 py-2 bg-[var(--red)] text-white rounded-full hover:bg-[var(--darkred)] transition-colors text-sm md:text-base">Ver detalles</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </li>
                    <li class="relative w-full md:w-1/4 tab-item transition-all duration-300 ease-in-out" role="presentation">
                        <button class="tab-button w-full p-0 cursor-pointer" id="local-tab" data-target="local" type="button" role="tab" aria-controls="local" aria-selected="false">
                            <div class="big-hyperlink overflow-hidden relative rounded-[20px] rounded-tl-none rounded-bl-none shadow-sm border border-gray-200 bg-cover bg-center h-[50vh] md:h-[65vh] bg-[url('https://storage.googleapis.com/bucket-jm-web/wp-content/uploads/2023/07/colombiano.webp')]">
                                <div class="absolute inset-0 bg-black/50">
                                    <div class="text-center p-2 md:p-8 h-full flex justify-end items-center md:items-end flex-col">
                                        <?php if (have_rows('encabezado-2')) : ?>
                                            <?php while (have_rows('encabezado-2')) : the_row(); ?>
                                                <h2 class="text-white font-bold mb-4 text-3xl"><?php the_sub_field('titulo'); ?></h2>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                        <span class="inline-block px-6 py-2 bg-[var(--red)] text-white rounded-full hover:bg-[var(--darkred)] transition-colors text-sm md:text-base">Ver detalles</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="investmentTabsContent">
                    <div class="tab-pane block" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                        <div class="mb-20">
                            <div class="w-full">
                                <?php if (have_rows('encabezado-1')) : ?>
                                    <?php while (have_rows('encabezado-1')) : the_row(); ?>
                                        <div class="flex items-center justify-around gap-2 md:gap-16">
                                            <h1 class="text-4xl font-bold whitespace-nowrap"><?php the_sub_field('titulo'); ?></h1>
                                            <hr class="w-full">
                                        </div>
                                        <p class="text-xl"><?php the_sub_field('sutitulo'); ?></p>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (have_rows('fila-1')) : ?>
                            <?php while (have_rows('fila-1')) : the_row(); ?>
                                <?php if (have_rows('contenido')) : ?>
                                    <?php while (have_rows('contenido')) : the_row(); ?>

                                        <?php if (get_row_layout() == 'tarjetas') : ?>
                                            <div class="w-full">
                                                <?php
                                                $tarjetas = get_sub_field('tarjetas');
                                                $j = is_array($tarjetas) ? count($tarjetas) : 0;
                                                ?>

                                                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-<?php echo $j; ?> gap-4">
                                                    <?php if (have_rows('tarjetas')) : ?>
                                                        <?php while (have_rows('tarjetas')) : the_row(); ?>
                                                            <?php if (have_rows('contenido')) : ?>
                                                                <?php while (have_rows('contenido')) : the_row(); ?>
                                                                    <div class="w-full">
                                                                        <div class="h-full bg-white border border-gray-200 rounded-[10px] rounded-tl-[40px] p-4">
                                                                            <div class="text-center">
                                                                                <div>
                                                                                    <?php $icono = get_sub_field('icono'); ?>
                                                                                    <?php if ($icono) : ?>
                                                                                        <img class="object-contain mx-auto" src="<?php echo esc_url($icono['url']); ?>" alt="<?php echo esc_attr($icono['alt']); ?>" width="100">
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <h5 class="font-bold mb-4 text-xl"><?php the_sub_field('titulo'); ?></h5>
                                                                                <p><?php the_sub_field('descripcion'); ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endwhile; ?>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        <?php elseif (get_row_layout() == 'video') : ?>
                                            <div class="h-20"></div>
                                            <div class="w-full">
                                                <div class="w-full">
                                                    <?php $link_video = get_sub_field('link_youtube'); ?>
                                                    <lite-youtube class="rounded rounded-tr-0 rounded-br-0" videoid="<?php echo $link_video; ?>"></lite-youtube>
                                                </div>
                                            </div>

                                        <?php elseif (get_row_layout() == 'carrusel') : ?>
                                            <div class="h-20"></div>
                                            <div class="w-full">
                                                <div class="w-full">
                                                    <div class="splide banner-splide">
                                                        <div class="splide__track">
                                                            <div class="splide__list">
                                                                <?php if (have_rows('items_carrusel')) : ?>
                                                                    <?php while (have_rows('items_carrusel')) : the_row(); ?>
                                                                        <div class="splide__slide">
                                                                            <?php $link_imagen = get_sub_field('link_imagen'); ?>
                                                                            <?php if ($link_imagen) : ?>
                                                                                <a href="<?php echo esc_url($link_imagen); ?>">
                                                                                <?php endif; ?>
                                                                                <?php if (get_sub_field('imagen')) : ?>
                                                                                    <img class="w-full rounded-[20px] border border-gray-200 aspect-square md:aspect-video object-cover md:object-none" src="<?php the_sub_field('imagen'); ?>" alt="">
                                                                                <?php endif; ?>
                                                                                <?php if ($link_imagen) : ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endwhile; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane hidden" id="local" role="tabpanel" aria-labelledby="local-tab">
                        <div class="mb-20">
                            <div class="w-full">
                                <?php if (have_rows('encabezado-2')) : ?>
                                    <?php while (have_rows('encabezado-2')) : the_row(); ?>
                                        <div class="flex items-center justify-around gap-16">
                                            <h1 class="text-4xl font-bold whitespace-nowrap"><?php the_sub_field('titulo'); ?></h1>
                                            <hr class="w-full">
                                        </div>
                                        <p class="text-xl"><?php the_sub_field('sutitulo'); ?></p>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (have_rows('fila-2')) : ?>
                            <?php while (have_rows('fila-2')) : the_row(); ?>
                                <?php if (have_rows('contenido')) : ?>
                                    <?php while (have_rows('contenido')) : the_row(); ?>

                                        <?php if (get_row_layout() == 'tarjetas') : ?>
                                            <div class="w-full">
                                                <?php
                                                $tarjetas = get_sub_field('tarjetas');
                                                $k = is_array($tarjetas) ? count($tarjetas) : 0;
                                                ?>

                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-<?php echo $k; ?> gap-4">
                                                    <?php if (have_rows('tarjetas')) : ?>
                                                        <?php while (have_rows('tarjetas')) : the_row(); ?>
                                                            <?php if (have_rows('contenido')) : ?>
                                                                <?php while (have_rows('contenido')) : the_row(); ?>
                                                                    <div class="w-full">
                                                                        <div class="h-full bg-white border border-gray-200 rounded-[10px] rounded-tl-[40px] p-4">
                                                                            <div class="text-center">
                                                                                <div>
                                                                                    <?php $icono = get_sub_field('icono'); ?>
                                                                                    <?php if ($icono) : ?>
                                                                                        <img class="object-contain mx-auto" src="<?php echo esc_url($icono['url']); ?>" alt="<?php echo esc_attr($icono['alt']); ?>" width="100">
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <h5 class="font-bold mb-4 text-xl"><?php the_sub_field('titulo'); ?></h5>
                                                                                <p><?php the_sub_field('descripcion'); ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endwhile; ?>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        <?php elseif (get_row_layout() == 'video') : ?>
                                            <div class="h-20"></div>
                                            <div class="w-full">
                                                <div class="w-full">
                                                    <?php $link_video = get_sub_field('link_youtube'); ?>
                                                    <lite-youtube class="rounded-[20px]" videoid="<?php echo $link_video; ?>"></lite-youtube>
                                                </div>
                                            </div>

                                        <?php elseif (get_row_layout() == 'carrusel') : ?>
                                            <div class="h-20"></div>
                                            <div class="w-full">
                                                <div class="w-full">
                                                    <div class="splide banner-splide">
                                                        <div class="splide__track">
                                                            <div class="splide__list">
                                                                <?php if (have_rows('items_carrusel')) : ?>
                                                                    <?php while (have_rows('items_carrusel')) : the_row(); ?>
                                                                        <div class="splide__slide">
                                                                            <?php $link_imagen = get_sub_field('link_imagen'); ?>
                                                                            <?php if ($link_imagen) : ?>
                                                                                <a href="<?php echo esc_url($link_imagen); ?>">
                                                                                <?php endif; ?>
                                                                                <?php if (get_sub_field('imagen')) : ?>
                                                                                    <img class="w-full rounded-[20px] border border-gray-200 aspect-square md:aspect-video object-cover md:object-none" src="<?php the_sub_field('imagen'); ?>" alt="">
                                                                                <?php endif; ?>
                                                                                <?php if ($link_imagen) : ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endwhile; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-selected', 'false');
                });

                tabPanes.forEach(panel => {
                    panel.classList.add('hidden');
                    panel.classList.remove('block');
                });

                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');

                const panelId = this.getAttribute('data-target');
                const panel = document.getElementById(panelId);
                if (panel) {
                    panel.classList.remove('hidden');
                    panel.classList.add('block');
                }
            });
        });

        // Initialize Splide sliders
        if (document.querySelector('.banner-splide')) {
            new Splide('.banner-splide', {
                type: 'loop',
                perPage: 1,
                autoplay: true,
                interval: 3000,
                arrows: true,
                pagination: false,
            }).mount();
        }
    });
</script>



<?php
get_footer();
