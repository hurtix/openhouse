<?php

/**
 * This is a part template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>


<!-- Modal -->
<div id="resultSplash" class="hidden backdrop">
    <div class="flex justify-center items-center h-screen">
        <div class="max-w-[500px] mx-auto w-full p-4">
            <div class="inline-block align-middle my-8 p-6 w-full max-w-md text-left transform bg-[var(--darkred)] text-white rounded-lg shadow-xl transition-all">
                <div class="flex justify-between items-center w-full">
                    <h3 class="text-2xl font-bold">Te llamamos</h3>
                    <button type="button" data-modal-close class="cursor-pointer" onclick="cerrarSplash()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle scale-150" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg></button>
                </div>
                <p class="mb-4">Déjanos tus datos y pronto estaremos en contacto.</p>
                <hr class="border-white/20 my-4">
                <?php echo do_shortcode('[contact-form-7 id="deec133" title="Proyecto"]'); ?>
                <div class="text-center flex justify-center items-center gap-2">
                    <p class="mb-0">- ó - contáctanos vía</p>
                    <?php get_template_part('part-templates/flotante'); ?>
                </div>
            </div>
        </div>
    </div>
</div>