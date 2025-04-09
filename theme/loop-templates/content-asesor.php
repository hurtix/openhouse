<?php

/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$pic_asesor =  get_the_post_thumbnail_url($post->ID);
$cargo = get_field('cargo');
$email = get_field('asesor-email');
$telefono = get_field('telefono');
$punto_venta = get_field('punto_venta');
$whatsapp = get_field('link_whatsapp');
?>

<article <?php post_class('relative'); ?> id="post-<?php the_ID(); ?>">
    <img class="w-full h-auto pointer-events-none" src="<?php echo $pic_asesor; ?>">
    <div class="shadow border border-gray-200 bg-white rounded-b">
        <h5 class="text-center text-xl font-bold pt-3 mb-0 uppercase"><?php the_title(); ?></h5>
        <?php if ($cargo) : ?>
            <p class="text-sm mb-0 text-center"><?php echo $cargo; ?></p>
            <hr class="w-3/4 mx-auto my-4 opacity-25">
        <?php endif; ?>

        <?php if ($email) : ?>
            <p class="hidden md:block text-xs mb-0 text-center px-2"><?php echo $email; ?></p>
        <?php endif; ?>

        <?php if ($telefono) : ?>
            <p class="text-sm text-center inline-flex justify-center items-center gap-2 w-full"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--red)" class="bi bi-phone-vibrate-fill me-1" viewBox="0 0 16 16">
  <path d="M4 4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm5 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0M1.807 4.734a.5.5 0 1 0-.884-.468A8 8 0 0 0 0 8c0 1.347.334 2.618.923 3.734a.5.5 0 1 0 .884-.468A7 7 0 0 1 1 8c0-1.18.292-2.292.807-3.266m13.27-.468a.5.5 0 0 0-.884.468C14.708 5.708 15 6.819 15 8c0 1.18-.292 2.292-.807 3.266a.5.5 0 0 0 .884.468A8 8 0 0 0 16 8a8 8 0 0 0-.923-3.734M3.34 6.182a.5.5 0 1 0-.93-.364A6 6 0 0 0 2 8c0 .769.145 1.505.41 2.182a.5.5 0 1 0 .93-.364A5 5 0 0 1 3 8c0-.642.12-1.255.34-1.818m10.25-.364a.5.5 0 0 0-.93.364c.22.563.34 1.176.34 1.818s-.12 1.255-.34 1.818a.5.5 0 0 0 .93.364C13.856 9.505 14 8.769 14 8s-.145-1.505-.41-2.182"/>
</svg><?php echo $telefono; ?></p>
        <?php endif; ?>

        <?php if ($punto_venta) : ?>
            <h6 class="text-center font-normal">Punto de venta</h6>
            <p class="text-xs leading-none text-center min-h-[25px]"><?php echo $punto_venta; ?></p>
        <?php endif; ?>

        <div class="h-4"></div>
        <?php if ($whatsapp) : ?>
            <a class="flex items-center justify-center gap-2 w-full py-2 px-4 border border-[#25D366] bg-[#25D366] text-white text-center hover:bg-[#128C7E] hover:border-[#128C7E] transition-colors duration-300 rounded-b leading-none md:leading-normal" href="<?php echo esc_url($whatsapp); ?>" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp scale-200 md:scale-150" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg><span class="block">Escribir un mensaje</span>
            </a>
        <?php endif; ?>
    </div>
</article>