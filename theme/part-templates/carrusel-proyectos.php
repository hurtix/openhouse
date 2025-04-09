<?php

/**
 * This is a part template
 *
 */

?>


<?php
    global $post;
    $args = [
        'post_type' => 'proyecto',
        'posts_per_page' => -1,
        'order' => 'DESC',
    ];
    $image_posts = get_posts($args);
?>
<?php if ($image_posts) { ?>

        <section class="bg-gray-100 flex flex-col justify-center items-center pointer-events-none select-none py-2">
        <div class="container max-w-[960px] relative before:content-[''] before:absolute before:top-0 before:left-0 before:w-[100px] before:h-full before:z-10 before:bg-gradient-to-r before:from-gray-100 before:to-transparent after:content-[''] after:absolute after:top-0 after:right-0 after:w-[100px] after:h-full after:z-10 after:bg-gradient-to-l after:from-gray-100 after:to-transparent">
            <div class="splide projects-splide">
            <div class="splide__track">
                    <div class="splide__list">
                        <?php foreach ($image_posts as $post):
                            setup_postdata($post); ?>
                            <div class="splide__slide">
                                <div class="w-[100px] h-[100px] mx-auto overflow-hidden flex justify-center items-center">
                                    <img class="grayscale w-[100px] h-auto object-cover" src="<?php the_field('proyecto-logo'); ?>" alt="<?php the_title(); ?>" />
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php wp_reset_postdata();  } ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Splide('.projects-splide', {
        type: 'loop',
        perPage: 6,
        pagination: false,
        arrows: false,
        autoplay: true,
        interval: 0,
        speed: 120000,
        gap: '2rem',
        drag: false,
        pauseOnHover: false,
        pauseOnFocus: false,
        breakpoints: {
            320: {
                perPage: 2
            },
            768: {
                perPage: 4
            },
            1024: {
                perPage: 6
            }
        }
    }).mount();
});
</script>
