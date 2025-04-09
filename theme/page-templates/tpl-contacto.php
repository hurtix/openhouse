<?php

/**
 * Template Name: UI Contacto
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 */

get_header();
$imagen = get_field('imagen');
?>

<div class="bg-[var(--dark)] h-[35vh]">
    <div class="container mx-auto flex justify-center items-start h-full flex-col pt-20 text-white px-4 md:px-0">
        <h2 class="font-bold text-4xl"><?php the_title(); ?></h2>
        <p>Explora nuestra selección de proyectos destacados y encuentra el lugar ideal para vivir, trabajar o invertir.</p>
    </div>
</div>

<div class="relative py-0">
            <div class="w-full">
                <ul id="tab--canales" class="w-full flex justify-center items-center gap-0 bg-gray-100 border-b border-gray-200" role="tablist">
                    <li class="relative" role="presentation">
                        <button class="tab-button active px-4 py-2 text-gray-800 hover:text-gray-600 border-b-2 border-[var(--red)] hover:border-gray-300 cursor-pointer" id="sac-tab" data-target="sac" type="button" role="tab" aria-controls="sac" aria-selected="true">
                            <div class="flex flex-col items-center">
                                <span class="block border border-gray-800 rounded-full leading-none p-2 aspect-square"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg></span>
                                <span><?php the_field('t1-titulo'); ?></span>
                            </div>
                        </button>
                    </li>
                    <li class="relative" role="presentation">
                        <button class="tab-button px-4 py-2 text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300 cursor-pointer" id="proyectos-tab" data-target="proyectos" type="button" role="tab" aria-controls="proyectos" aria-selected="false">
                            <div class="flex flex-col items-center">
                                <span class="block border border-gray-800 rounded-full leading-none p-2 aspect-square"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg></span>
                                <span><?php the_field('t2-titulo'); ?></span>
                            </div>
                        </button>
                    </li>
                    <li class="relative" role="presentation">
                        <button class="tab-button px-4 py-2 text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300 cursor-pointer" id="pqr-tab" data-target="pqr" type="button" role="tab" aria-controls="pqr" aria-selected="false">
                            <div class="flex flex-col items-center">
                                <span class="block border border-gray-800 rounded-full leading-none p-2 aspect-square"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                                    </svg></span>
                                <span><?php the_field('t3-titulo'); ?></span>
                            </div>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto">
                <div class="w-full">
                    <div class="tab-content pt-10 pb-15">
                        <div class="tab-pane active" id="sac" role="tabpanel" aria-labelledby="sac-tab" tabindex="0">
                            <p class="text-center w-full md:w-1/2 px-4 md:px-0 mx-auto"><?php the_field('t1-descripcion'); ?></p>
                            <?php //echo get_field('t1-formulario'); ?>
                            <div class="w-full md:max-w-1/2 mx-auto pt-10 px-4 md:px-0">
                                <?php echo do_shortcode('[contact-form-7 id="a5a394b" title="Servicio al cliente"]');?>
                            </div>
                        </div>
                        <div class="tab-pane" id="proyectos" role="tabpanel" aria-labelledby="proyectos-tab" tabindex="0">
                            <p class="text-center w-full md:w-1/2 px-4 md:px-0 mx-auto"><?php the_field('t2-descripcion'); ?></p>
                            <div class="flex justify-center items-center">
                                <a class="px-4 py-2 mt-10 bg-[var(--red)] text-white rounded-full hover:bg-[var(--darkred)] transition-colors" href="/proyecto"><?php the_field('t2-texto-boton'); ?></a>
                            </div>
                            <div class="px-4 md:px-0">
                                <?php get_template_part('part-templates/asesores'); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="pqr" role="tabpanel" aria-labelledby="pqr-tab" tabindex="0">
                            <p class="text-center w-full md:w-1/2 px-4 md:px-0 mx-auto"><?php the_field('t3-descripcion'); ?></p>
                            <?php //echo get_field('t3-formulario'); ?>
                            <div class="w-full md:max-w-1/2 mx-auto pt-10 px-4 md:px-0">
                                <?php echo do_shortcode('[contact-form-7 id="9267d93" title="PQRS"]');?>
                            </div>
                        </div>
                    </div>
                </div>
</div>
<hr class="opacity-15">

<?php get_template_part('part-templates/carrusel-proyectos'); ?>



<!-- Add the script before closing body tag -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');

        // Hide all panels except the first one on load
        tabPanes.forEach((panel, index) => {
            if (index !== 0) {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            } else {
                panel.classList.remove('hidden');
                panel.classList.add('block');
            }
        });

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active state from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'border-[var(--red)]');
                    btn.classList.add('border-transparent');
                    btn.setAttribute('aria-selected', 'false');
                });

                // Hide all panels
                tabPanes.forEach(panel => {
                    panel.classList.add('hidden');
                    panel.classList.remove('block');
                });

                // Activate current tab
                this.classList.add('active', 'border-[var(--red)]');
                this.classList.remove('border-transparent');
                this.setAttribute('aria-selected', 'true');

                // Show corresponding panel
                const panelId = this.getAttribute('data-target');
                const panel = document.getElementById(panelId);
                if (panel) {
                    panel.classList.remove('hidden');
                    panel.classList.add('block');
                }
            });
        });
    });
</script>



<?php
get_footer();
