<?php

/**
 * Template Name: UI Nosotros
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *

 */

get_header();
?>

<div class="bg-[var(--dark)]  md:h-auto lg:h-[35vh]">
    <div class="text-white container mx-auto px-4 lg:px-0 flex justify-center items-start h-full flex-col pt-30 pb-10">
        <h2 class="font-bold text-4xl"><?php the_title(); ?></h2>
        <p>Explora nuestra selección de proyectos destacados y encuentra el lugar ideal para vivir, trabajar o invertir.</p>
    </div>
</div>

<div class="container mx-auto py-10 lg:py-20 my-10 lg:my-20 px-4 lg:px-0">
    <div class="flex flex-wrap">
        <div class="w-full">
            <?php if (have_rows('filas')) : ?>
                <?php $row_index = 0; ?>
                <?php while (have_rows('filas')) : the_row(); ?>
                    <?php if (have_rows('contenido')) : ?>
                        <div class="flex flex-wrap pb-10 lg:pb-20">
                            <?php
                            while (have_rows('contenido')) : the_row();
                                $titulo = get_sub_field('titulo');
                                $descripcion = get_sub_field('descripcion');
                                $foto = get_sub_field('foto');
                                $is_even = $row_index % 2 == 0;
                            ?>

                                <?php if ($is_even) : ?>
                                    <div class="w-full lg:w-1/2">
                                        <div class="flex justify-center items-start flex-col h-full pl-0 lg:pl-20">
                                            <h2 class="font-bold text-4xl mb-4"><?php echo $titulo; ?></h2>
                                            <?php echo $descripcion; ?>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 mt-16 lg:mt-0 mb-8 lg:mb-0">
                                        <div class="relative flex justify-center items-center after:content-[''] after:w-[300px] md:after:w-[400px] after:h-full after:absolute after:left-0 after:top-0 after:border-4 after:border-white after:-z-10 after:rounded after:shadow-xl after:bg-[url('https://open-house.com.co/wp-content/uploads/pz-6.jpg')] after:bg-cover after:bg-center after:grayscale after:rotate-[-5deg] after:translate-x-[20%]">
                                            <img class="pic_content max-w-[300px] md:max-w-[400px] rotate-[3deg] translate-x-[-10%] md:translate-x-[10%] border-4 border-white shadow-xl object-cover rounded" src="<?php echo $foto; ?>" alt="">
                                        </div>
                                    </div>

                                <?php else : ?>
                                    <div class="w-full lg:w-1/2 mt-8 lg:mt-0 mb-16 lg:mb-0">
                                        <div class="relative flex justify-center items-center after:content-[''] after:w-[300px] md:after:w-[400px] after:h-full after:absolute after:left-0 after:top-0 after:border-4 after:border-white after:-z-10 after:rounded after:shadow-xl after:bg-[url('https://open-house.com.co/wp-content/uploads/pz-6.jpg')] after:bg-cover after:bg-center after:grayscale after:rotate-[5deg] after:translate-x-[20%]">
                                            <img class="pic_content max-w-[300px] md:max-w-[400px] rotate-[-3deg] translate-x-[-10%] md:translate-x-[10%] border-4 border-white shadow-xl object-cover rounded" src="<?php echo $foto; ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2">
                                        <div class="flex justify-center items-start flex-col h-full pr-0 lg:pr-20">
                                            <h2 class="font-bold text-4xl mb-4"><?php echo $titulo; ?></h2>
                                            <?php echo $descripcion; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php $row_index++; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="w-full bg-gray-100">
    <div class="flex flex-wrap">
        <div class="w-full">
            <div class="container mx-auto py-20 mb-20 px-4 lg:px-0">
                <div class="flex flex-wrap">
                    <?php if (have_rows('encabezado')) : ?>
                        <?php while (have_rows('encabezado')) : the_row(); ?>
                            <div class="w-full">
                                <h2 class="font-bold text-center mb-0 text-4xl"><?php the_sub_field('titulo'); ?></h2>
                                <p class="text-xl mb-20 font-normal text-center w-full lg:w-3/4 mx-auto"><?php the_sub_field('subtitulo'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <div class="w-full">
                        <div class="flex flex-wrap lg:flex-nowrap gap-4">
                            <?php if (have_rows('tarjetas')) : ?>
                                <?php while (have_rows('tarjetas')) : the_row(); ?>
                                    <?php if (have_rows('contenido')) : ?>
                                        <?php while (have_rows('contenido')) : the_row(); ?>
                                            <div class="w-full lg:w-1/3 flex flex-col md:flex-row lg:flex-col items-center justify-center md:gap-10 lg:gap-0 h-auto">
                                                <h4 class="text-2xl leading-none mb-4 font-bold text-[var(--red)] text-center md:text-left lg:text-center"><?php the_sub_field('titulo'); ?></h4>
                                                <div class="flex border border-gray-200 rounded-[10px] rounded-tl-[40px] py-9 ps-0 pe-2 gap-3 bg-white h-auto lg:h-full items-center">
                                                    <?php $icono = get_sub_field('icono'); ?>
                                                    <?php if ($icono) : ?>
                                                        <img class="object-contain" src="<?php echo esc_url($icono['url']); ?>" alt="<?php echo esc_attr($icono['alt']); ?>" width="100">
                                                    <?php endif; ?>
                                                    <p class="mb-0"><?php the_sub_field('descripcion'); ?></p>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <hr class="invisible">
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto pt-20 pb-10">

    <?php if (have_rows('encabezado-2')) : ?>
        <?php while (have_rows('encabezado-2')) : the_row(); ?>
            <div class="w-full px-4 lg:px-0">
                <h2 class="font-bold text-center mb-0 text-4xl"><?php the_sub_field('titulo'); ?></h2>
                <p class="lead pb-5 mb-5 fw-normal text-center w-full lg:w-2/3 mx-auto"><?php the_sub_field('subtitulo'); ?></p>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>


    <div class="w-full">
        <div id="reconocimientos" class="splide cursor-grab">
            <div class="splide__track py-20">
                <div class="splide__list">
                    <?php if (have_rows('reconocimientos')) : ?>
                        <?php $i = 0; ?>
                        <?php while (have_rows('reconocimientos')) : the_row(); ?>
                            <div class="splide__slide">
                                <div class="certificate-container max-w-[380px] md:max-w-[700px] lg:max-w-full">
                                    <div class="zigzag-left"></div>
                                    <div class="zigzag-right"></div>
                                    <div class="pattern"></div>
                                    <div class="certificate h-auto lg:h-[600px] pt-32 pb-16 lg:p-[25px]">
                                        <div class="water-mark-overlay"></div>
                                        <div class="certificate-header">
                                            <img src="/wp-content/themes/openhouse/theme/assets/img/ribbon.png" class="logo w-[200px] left-[-55px]  lg:left-[-115px] top-[-80px] lg:w-[300px]" alt="ribbon">
                                        </div>
                                        <div class="certificate-body">
                                            <p class="certificate-title text-sm lg:text-base uppercase tracking-[1px] lg:tracking-[4px]"><?php the_sub_field('pre'); ?></p>
                                            <h1 class="text-4xl lg:text-[48px]"><?php the_sub_field('categoria'); ?></h1>
                                            <p class="text-xl font-bold"><?php the_sub_field('proyecto'); ?></p>
                                            <div class="certificate-content">
                                                <div class="about-certificate">
                                                    <p><?php the_sub_field('lugar_fecha'); ?></p>
                                                </div>
                                            </div>
                                            <div class="text-center text-xs">
                                                <p class="topic-description"><?php the_sub_field('pos'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#reconocimientos', {
            type: 'loop',
            rewind: true,
            arrows: false,
            pagination: false,
            gap: '1rem'
        }).mount();
    });
</script>

<?php
get_footer();
