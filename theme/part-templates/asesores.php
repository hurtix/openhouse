<?php
/**
 * This is a part template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div>
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4 select-none">
        <?php
        $args = array(
            'post_type'      => 'asesor',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish'
        );
        
        $asesores_query = new WP_Query($args);
        
        if ($asesores_query->have_posts()) :
            while ($asesores_query->have_posts()) : $asesores_query->the_post();
                get_template_part('loop-templates/content', 'asesor');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No hay asesores disponibles.</p>';
        endif;
        ?>
    </div>
</div>