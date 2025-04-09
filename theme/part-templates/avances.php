<?php

/**
 * This is a part template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$color = get_field('color-proyecto');
?>





<div class="container mx-auto px-4 md:px-0 py-40 relative before:absolute before:content-[''] before:left-0 before:top-0 before:w-[0px] md:before:w-[200px] before:h-full before:bg-gradient-to-r before:from-[var(--project-color)] before:to-transparent before:z-1
      after:absolute after:content-[''] after:right-0 after:top-0 after:w-[0px]  md:after:w-[200px] after:h-full after:bg-gradient-to-l after:from-[var(--project-color)] after:to-transparent after:z-0">
    <h2 class="font-bold text-4xl mb-4 relative z-2 pl-8">Avances de obra</h2>
    <?php $y = 0; ?>
    <div class="splide avances-slider" role="group" aria-label="Avances de obra">
        <div class="splide__track">
            <div class="splide__list">
                <div class="splide__slide flex flex-col items-center">
                    <img class="w-[100px] mt-[5vh] grayscale-100 bg-white rounded-full shadow-lg" 
                         src="<?php the_field('proyecto-logo'); ?>" 
                         alt="Logo inicio obra" />
                    <span class="font-bold">Inicio de Obra</span>
                    <span><?php the_field('inicio-obra-mes'); ?> <?php the_field('inicio-obra-anho'); ?></span>
                </div>

                                <?php while (have_rows('rep-avances-obra')) : the_row(); ?>
                    <?php $avances_galeria_images = get_sub_field('avances-galeria'); ?>
                    <?php if ($avances_galeria_images) :  ?>
                        <?php 
                            $mes = get_sub_field('avances-mes'); 
                            $anho = get_sub_field('avances-mes-anho'); 
                            $first_image = reset($avances_galeria_images); // Get first image
                        ?>
                        <div class="splide__slide flex flex-col items-center bg-[rgba(0,0,0,.35)] text-white p-4 rounded-md">
                            <div class="relative group">
                                <a data-lightbox="album-<?php echo $y; ?>" 
                                   data-title="Avance de Obra - <?php echo $mes.' '.$anho; ?>" 
                                   href="<?php echo esc_url($first_image['url']); ?>"
                                   class="block">
                                    <img class="rounded-md aspect-video object-cover w-[280px] h-full" 
                                         src="<?php echo esc_url($first_image['sizes']['medium']); ?>" 
                                         alt="<?php echo esc_attr($first_image['alt']); ?>" />
                                    <?php if (count($avances_galeria_images) > 1): ?>
                                        <div class="absolute bottom-2 right-2 bg-black/50 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                            +<?php echo count($avances_galeria_images) - 1; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                                <?php 
                                // Hidden links for lightbox
                                $skip_first = true;
                                foreach ($avances_galeria_images as $image): 
                                    if ($skip_first) {
                                        $skip_first = false;
                                        continue;
                                    }
                                ?>
                                    <a class="hidden" 
                                       data-lightbox="album-<?php echo $y; ?>" 
                                       data-title="Avance de Obra - <?php echo $mes.' '.$anho; ?>" 
                                       href="<?php echo esc_url($image['url']); ?>"></a>
                                <?php endforeach; ?>
                            </div>
                            <span class="mt-2"><?php echo $mes.' '.$anho; ?></span>
                        </div>
                    <?php endif; ?>
                    <?php $y++; ?>
                <?php endwhile; ?>

                <div class="splide__slide flex flex-col items-center <?php echo (!get_field('fin-obra-anho') && !get_field('fin-obra-mes')) ? 'invisible' : ''; ?>">
                    <img class="w-[100px] mt-[5vh] bg-white rounded-full shadow-lg" 
                         src="<?php the_field('proyecto-logo'); ?>" 
                         alt="Logo fin obra" />
                    <span class="font-bold">Fin de Obra</span>
                    <span><?php the_field('fin-obra-mes'); ?> <?php the_field('fin-obra-anho'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Splide('.avances-slider', {
        perPage: 4,
        gap: '1rem',
        breakpoints: {
            768: {
                perPage: 2,
            },
            480: {
                perPage: 1,
            },
        },
        arrows: true,
        pagination: false,
        type: 'slide',
    }).mount();
});
</script>