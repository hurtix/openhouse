<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 */


$post_id = get_the_ID();
$titulo = get_the_title();
$permalink = get_permalink();
$logo = get_field('proyecto-logo', $post_id);
$color = get_field('color-proyecto', $post_id);
$subtitulo = get_field('proyecto-subtitulo', $post_id);
$area = get_field('construida-desde', $post_id);
$precio = get_field('proyecto-precio', $post_id);
$subsidio = get_field('subsidio', $post_id);
$pisos = get_field('pisos', $post_id);
$unidades = get_field('unidades', $post_id);
$parqueaderos = get_field('parqueaderos', $post_id);
$status_tax = wp_get_post_terms(get_the_ID(), 'status_proyecto');
$status = $status_tax[0];
$ubicacion_tax = get_field('proyecto-municipio-tax');
$zona_tax = get_field('proyecto-zona-tax');
?>

<div class="proyecto relative border border-gray-200 bg-white" data-status="<?php echo esc_html($status->slug) ?>" data-ubicacion="<?php echo get_ubicacion_terms($ubicacion_tax,'slug'); ?>" data-zona="<?php echo get_zona_terms($zona_tax,'slug'); ?>">
    <a href="<?php echo $permalink; ?>" class="block text-inherit">
        <?php if (!empty($status_tax) && !is_wp_error($status_tax)) { ?>
            <span class="absolute top-2.5 left-[-12px] px-2 py-1 bg-red-600 text-white text-xs font-bold uppercase tracking-wider z-10 before:content-[''] before:absolute before:top-[24px] before:left-0 before:border-[5px] before:border-transparent before:border-t-red-800 before:border-r-red-800 before:-z-10"><?php echo esc_html($status->name) ?></span>
        <?php } ?>

        <div class="proyecto-header relative w-full h-[200px] after:absolute after:content-[''] after:bottom-0 after:left-0 after:w-full after:h-[40%] after:bg-gradient-to-t after:from-black/90 after:via-transparent after:to-transparent after:z-10">
            <?php if (have_rows('rep-slider')) : ?>
                <div id="carrusel-<?php echo $post_id; ?>" class="relative h-full" x-data="{ activeSlide: 1 }">
                    <div class="h-full">
                        <?php
                        $contador_slides = 0;
                        while (have_rows('rep-slider')) : the_row();
                            $contador_slides++;
                        ?>
                            <?php if (get_sub_field('proyecto-slider-imagen')) : ?>
                                <div class="absolute inset-0 transition-opacity duration-300" x-show="activeSlide === <?php echo $contador_slides; ?>">
                                    <img class="h-full w-full object-cover" src="<?php the_sub_field('proyecto-slider-imagen'); ?>" />
                                </div>
                            <?php endif ?>
                        <?php endwhile; ?>
                    </div>

                    <?php if ($total_imagenes > 1) : ?>
                        <button class="absolute left-0 top-1/2 -translate-y-1/2 p-2 text-white hover:bg-black/20 transition-colors" @click="activeSlide = activeSlide === 1 ? <?php echo $total_imagenes; ?> : activeSlide - 1">
                            <span class="sr-only">Previous</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button class="absolute right-0 top-1/2 -translate-y-1/2 p-2 text-white hover:bg-black/20 transition-colors" @click="activeSlide = activeSlide === <?php echo $total_imagenes; ?> ? 1 : activeSlide + 1">
                            <span class="sr-only">Next</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="absolute bottom-0 left-0 w-full text-white z-20">
                <span class="text-sm ml-3">Desde: </span>
                <span class="font-bold">
                    <span class="simbolo">$</span>
                    <span class="precio"                     <span class="precio" data-precio="<?php echo esc_attr($precio); ?>"><?php echo $precio ? number_format((float)$precio, 0, ".", ".") : '-'; ?></span></span>
                </span>
                <?php if ($subsidio === 'si') { ?>
                    <div class="w-full py-1 flex items-center justify-center bg-yellow-500 text-white">
                        <img class="w-6 h-6 invert brightness-0" src="<?php echo get_template_directory_uri(); ?>/assets/img/subsidio.svg" alt="">
                        <span class="text-sm pl-2">Aplican subsidios</span>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="flex items-center gap-2 px-3 mt-3 h-[75px]">
            <div class="flex items-center justify-center w-[75px] h-[75px]" style="background-color: <?php echo $color; ?>;">
                <img class="invert brightness-0 w-[75px] h-[75px] object-cover" src="<?php echo $logo; ?>" alt="">
            </div>
            <div>
                <span class="text-sm"><?php echo get_ubicacion_terms($ubicacion_tax); ?></span>        
                <h5 class="font-bold text-lg leading-none"><?php echo $titulo; ?></h5>
            </div>
        </div>

        <div class="px-3">
            <p class="my-3 text-sm h-[50px]"><?php echo $subtitulo; ?></p>
        </div>

        <div class="bg-gray-100 flex justify-center items-center gap-2 text-center py-3">
            <div>
                <span class="block text-xs">Área desde</span>
                <span class="font-bold text-sm"><?php echo $area ? $area . 'm²' : '-'; ?></span>
            </div>
            <?php if($pisos) { ?>
                <div class="w-px h-4 bg-gray-300"></div>
                <div>
                    <span class="block text-xs">Pisos</span>
                    <span class="font-bold text-sm"><?php echo $pisos ? $pisos : '-'; ?></span>
                </div>
            <?php } ?>
            <div class="w-px h-4 bg-gray-300"></div>
            <div>
                <span class="block text-xs">Unidades</span>
                <span class="font-bold text-sm"><?php echo $unidades ? $unidades : '-'; ?></span>
            </div>
            <div class="w-px h-4 bg-gray-300"></div>
            <div>
                <span class="block text-xs">Parqueaderos</span>
                <span class="font-bold text-sm"><?php echo $parqueaderos ? $parqueaderos : '-'; ?></span>
            </div>
        </div>
    </a>
</div>