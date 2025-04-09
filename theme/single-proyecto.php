<?php

/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
$post_id = get_the_ID();
$area = get_field('construida-desde', $post_id);
$precio = get_field('proyecto-precio', $post_id);
$pisos = get_field('pisos', $post_id);
$unidades = get_field('unidades', $post_id);
$parqueaderos = get_field('parqueaderos', $post_id);
$color = get_field('color-proyecto', $post_id);
$construida_desde = get_field('construida-desde', $post_id);
$construida_hasta = get_field('construida-hasta', $post_id);
$privada_desde = get_field('privada-desde', $post_id);
$privada_hasta = get_field('privada-hasta', $post_id);
$fachada = get_field('proyecto-fachada', $post_id);
$status_tax = wp_get_post_terms(get_the_ID(), 'status_proyecto');
$status = $status_tax[0];
$subsidio = get_field('subsidio', $post_id);
$link_gmaps = get_field('link_gmaps', $post_id);
$video = get_field('video', $post_id);
?>
<style>
  :root {
    --project-color: <?php echo $color; ?>;
  }
</style>




<section>
  <div class="flex flex-wrap">
    <div class="w-full relative after:absolute after:content-[''] after:bottom-0 after:left-0 after:w-full after:h-full after:bg-black/50 after:z-0">
      <?php if (have_rows('rep-avances-obra')) : ?>
        <div id="goTo--avances" class="absolute md:fixed top-[80%] md:top-[120px] flex justify-end items-center z-4 w-full">
          <a class="btn border border-white text-white hover:bg-[var(--red)] hover:text-white rounded-full mr-3 py-2 px-3 text-sm md:text-base" href="#avances">Avances de obra</a>
        </div>
      <?php endif; ?>
      <div class="splide main-slider" role="group" aria-label="Imágenes del proyecto">
        <div class="splide__track">
          <div class="splide__list">
            <?php if (have_rows('rep-slider')) : ?>
              <?php while (have_rows('rep-slider')) : the_row(); ?>
                <?php if (get_sub_field('proyecto-slider-imagen')) : ?>
                  <div class="splide__slide">
                    <img class="w-full h-[65vh] md:h-auto object-cover" src="<?php the_sub_field('proyecto-slider-imagen'); ?>" alt="Imagen del proyecto" />
                  </div>
                <?php endif ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          new Splide('.main-slider', {
            type: 'loop',
            rewind: true,
            autoplay: true,
            interval: 3000,
            arrows: false,
            pagination: false,
            pauseOnHover: false,
            pauseOnFocus: false,
          }).mount();
        });
      </script>
      <div class="container mx-auto relative z-10">
        <?php if (get_field('proyecto-logo')) : ?>
          <div class="absolute bottom-0 left-4 md:left-0 -translate-y-1/2">
            <?php if (!empty($status_tax) && !is_wp_error($status_tax)) { ?>
              <div class="relative">
                <span class="absolute text-nowrap top-2 left-[-10px] px-2 py-1 bg-red-600 text-white text-xs font-bold uppercase tracking-wider z-10 before:content-[''] before:absolute before:top-[24px] before:left-0 before:border-[5px] before:border-transparent before:border-t-red-800 before:border-r-red-800 before:-z-10"><?php echo esc_html($status->name) ?></span>
              </div>

            <?php } ?>
            <img src="<?php the_field('proyecto-logo'); ?>" class="bg-white object-contain w-[125px] md:w-[200px] h-[125px] md:h-[200px] p-2 md:p-4" alt="logo" />
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
  <?php if ($subsidio === 'si') { ?>
    <div class="flex flex-wrap">
      <div class="w-full">
        <div class="subsidio w-full py-2 flex justify-center items-center gap-2 text-white bg-yellow-500">
          <img class="invert brightness-0 w-[25px]" src="<?php echo get_template_directory_uri(); ?>/assets/img/subsidio.svg" alt="">
          <span class="pl-2">Aplican subsidios</span>
        </div>
      </div>
    </div>
  <?php } ?>
</section>

<section class="isLight">
  <div class="container mx-auto pt-16 px-4 md:px-0">
    <div class="flex flex-wrap md:flex-nowrap gap-8">
      <div class="w-full lg:w-2/3 mb-5 lg:mb-0">
        <h3 class="text-3xl font-bold text-[var(--project-color)]"><?php the_field('proyecto-titulo'); ?></h3>
        <h4 class="text-xl mb-16"><?php the_field('proyecto-subtitulo'); ?></h4>
        <?php //if (wp_is_mobile()) { ?>
          <!-- <a class="inline-block w-full font-bold bg-[var(--red)] text-white rounded" href="#loan--calculator">Simula el pago de tu lote</a> -->
        <?php //} ?>
        <?php $precio = get_field('proyecto-precio'); ?>
        <?php if (get_field('proyecto-precio')) : ?>
          <p class="text-gray-500 text-sm mb-1">Desde</p>
          <h4 class="text-2xl font-bold">
            <span class="simbolo">$</span>
            <span class="precio" data-precio="<?php echo $precio; ?>"><?php echo number_format($precio, 0, ".", "."); ?></span>
            <span class="moneda font-normal">COP</span>
          </h4>
        <?php endif ?>
        <p class="text-justify mb-16"><?php the_field('proyecto-descripcion'); ?></p>

        <div id="caracteristicas" class="w-full mb-16">
          <h3 class="text-3xl font-bold text-[var(--project-color)]">Características del proyecto</h3>
          <ul class="list-none grid grid-cols-2 gap-1 pt-4 items-start [&_li]:pb-2">
            <?php if (have_rows('rep-caracteristicas')) : ?>
              <?php while (have_rows('rep-caracteristicas')) : the_row(); ?>
                <li class="inline-flex items-start md:items-center leading-none md:leading-normal "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle text-[var(--project-color)] me-1 shrink-0" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                  </svg><?php the_sub_field('proyecto-item-carecteristica'); ?></li>
              <?php endwhile; ?>
            <?php endif; ?>
          </ul>
        </div>
        <hr class="my-4 opacity-25">

        <ul class="flex justify-around mb-4 [&>*>button]:cursor-pointer overflow-x-auto no-scrollbar">
          <li class="relative" role="presentation">
            <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-[var(--dark)] hover:border-gray-300 tab-button active"
              id="tab-general"
              data-target="panel-general"
              type="button"
              role="tab"
              aria-controls="panel-general"
              aria-selected="true">Vista general</button>
          </li>
          <li class="relative" role="presentation">
            <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300 tab-button"
              id="tab-areas"
              data-target="panel-areas"
              type="button"
              role="tab"
              aria-controls="panel-areas"
              aria-selected="false">Áreas y características</button>
          </li>
          <?php if ($video) : ?>
            <li class="relative" role="presentation">
              <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300 tab-button"
                id="tab-multimedia"
                data-target="panel-multimedia"
                type="button"
                role="tab"
                aria-controls="panel-multimedia"
                aria-selected="false">Video</button>
            </li>
          <?php endif; ?>
          <?php if (have_rows('proyecto-planos-rep')) : ?>
            <li class="relative" role="presentation">
              <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300 tab-button"
                id="tab-planos"
                data-target="panel-planos"
                type="button"
                role="tab"
                aria-controls="panel-planos"
                aria-selected="false">Planos</button>
            </li>
          <?php endif; ?>
          <?php if (have_rows('recorrido-virtual-rep')) : ?>
            <li class="relative" role="presentation">
              <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300 tab-button"
                id="tab-recorrido"
                data-target="panel-recorrido"
                type="button"
                role="tab"
                aria-controls="panel-recorrido"
                aria-selected="false">Recorrido virtual</button>
            </li>
          <?php endif; ?>
          <?php if (have_rows('rep-avances-obra')) : ?>
            <li class="relative" role="presentation">
              <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300"
                onclick="document.getElementById('avances').scrollIntoView({behavior: 'smooth'})">Avances de obra</button>
            </li>
          <?php endif; ?>
          <?php if ($link_gmaps) { ?>
            <li class="relative" role="presentation">
              <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300"
                onclick="window.open('<?php echo esc_url($link_gmaps); ?>', '_blank')">Ubicación</button>
            </li>
          <?php } ?>
          <li class="relative" role="presentation">
            <button class="px-4 py-2 text-nowrap text-gray-800 hover:text-gray-600 border-b-2 border-transparent hover:border-gray-300"
              onclick="document.getElementById('asesores').scrollIntoView({behavior: 'smooth'})">Asesores</button>
          </li>
        </ul>

        <div class="tab-content mt-4">
          <div class="block" id="panel-general" role="tabpanel" aria-labelledby="tab-general" tabindex="0">
            <?php if (get_field('proyecto-fachada')) : ?>
              <img class="w-full select-none pointer-events-none" src="<?php echo $fachada; ?>" />
            <?php endif ?>
          </div>

          <div class="hidden" id="panel-areas" role="tabpanel" aria-labelledby="tab-areas" tabindex="0">
            <table class="w-full border-collapse">
              <thead>
                <tr class="border-b-2">
                  <th class="text-left p-2">Área</th>
                  <th class="text-left p-2">Desde</th>
                  <th class="text-left p-2">Hasta</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-gray-200">
                  <th class="text-left p-2">Construída</th>
                  <td class="p-2"><?php echo $construida_desde; ?>m²</td>
                  <td class="p-2"><?php echo $construida_hasta ?>m²</td>
                </tr>
                <tr class="border-b border-gray-200">
                  <th class="text-left p-2">Privada</th>
                  <td class="p-2"><?php echo $privada_desde; ?>m²</td>
                  <td class="p-2"><?php echo $privada_hasta ?>m²</td>
                </tr>
              </tbody>
            </table>

            <table class="w-full border-collapse mt-4">
              <thead>
                <tr class="border-b-2">
                  <th class="text-left p-2">Item</th>
                  <th class="text-left p-2">Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-gray-200">
                  <th class="text-left p-2">Pisos</th>
                  <td class="p-2"><?php echo $pisos; ?></td>
                </tr>
                <tr class="border-b border-gray-200">
                  <th class="text-left p-2">Unidades</th>
                  <td class="p-2"><?php echo $unidades; ?></td>
                </tr>
                <tr class="border-b border-gray-200">
                  <th class="text-left p-2">Parqueaderos</th>
                  <td class="p-2"><?php echo $parqueaderos; ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <?php if ($video) : ?>
            <div class="hidden" id="panel-multimedia" role="tabpanel" aria-labelledby="tab-multimedia" tabindex="0">
              <div class="multimedia w-full [&_iframe]:aspect-video [&_iframe]:w-full [&_iframe]:h-full">
                <?php echo $video; ?>
              </div>
              <div class="h-10"></div>
            </div>
          <?php endif ?>

          <?php if (have_rows('proyecto-planos-rep')) : ?>
            <div class="hidden" id="panel-planos" role="tabpanel" aria-labelledby="tab-planos" tabindex="0">
              <div class="w-full">
                <div class="flex justify-end items-center w-full relative">
                  <select id="planos-selector" name="planos" class="w-full md:w-1/3  px-3 py-2 border rounded" onchange="cambiarPlano(this.value)">
                    <?php $x = 0; ?>
                    <option value="" selected disabled hidden>Por favor seleccione un plano</option>
                    <?php while (have_rows('proyecto-planos-rep')) : the_row(); ?>
                      <?php $x++; ?>
                      <option value="plano-<?php echo $x; ?>">
                        <?php the_sub_field('proyecto-titulo-pestana'); ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="mt-4">
                  <?php $y = 0; ?>
                  <?php while (have_rows('proyecto-planos-rep')) : the_row(); ?>
                    <?php $y++; ?>
                    <div class="transition-opacity duration-150 ease-linear hidden"
                      id="plano-<?php echo $y; ?>"
                      role="tabpanel"
                      aria-labelledby="plano-<?php echo $y; ?>-tab"
                      tabindex="0">
                      <?php if (get_sub_field('proyecto-imagen-plano')) : ?>
                        <img class="w-full select-none pointer-events-none mt-4" src="<?php the_sub_field('proyecto-imagen-plano'); ?>" />
                      <?php endif ?>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>

            <script>
              function cambiarPlano(planoId) {
                // Ocultar todos los planos
                document.querySelectorAll('[id^="plano-"]').forEach(plano => {
                  plano.classList.add('hidden');
                  plano.classList.remove('block');
                });

                // Mostrar el plano seleccionado
                document.getElementById(planoId).classList.remove('hidden');
                document.getElementById(planoId).classList.add('block');
              }

              // Asegurarse de que el plano inicial se muestre cuando se carga o muestra el panel de planos
              document.addEventListener('DOMContentLoaded', function() {
                // Cuando el panel principal se hace visible
                document.getElementById('tab-planos').addEventListener('click', function() {
                  // Obtener el value del primer option
                  const primerPlano = document.querySelector('#planos-selector option:first-child').value;
                  // Mostrar ese plano
                  cambiarPlano(primerPlano);
                });

                // También inicializar el primer plano si el panel planos está visible al cargar
                if (!document.getElementById('panel-planos').classList.contains('hidden')) {
                  const primerPlano = document.querySelector('#planos-selector option:first-child').value;
                  cambiarPlano(primerPlano);
                }
              });
            </script>
          <?php endif; ?>

          <?php if (have_rows('recorrido-virtual-rep')) : ?>
            <div class="hidden" id="panel-recorrido" role="tabpanel" aria-labelledby="tab-recorrido" tabindex="0">
              <div id="recorrido" class="w-full">
                <?php $w = 0; ?>
                <?php while (have_rows('recorrido-virtual-rep')) : the_row(); ?>
                  <?php $w++; ?>
                  <?php $enlace_recorrido = get_sub_field('enlace-recorrido'); ?>
                  <?php if ($enlace_recorrido) : ?>
                    <a id="open-window-<?php echo $w; ?>" class="p-5 shadow-lg bg-white inline-block rounded mx-1 <?php if (wp_is_mobile()) echo 'mb-5'; ?>" href="javascript:void(0)">
                      <p class="text-lg text-black"><i class="bi bi-badge-vr block text-lg text-[var(--project-color)]"></i> <?php the_sub_field('texto-recorrido'); ?></p>
                    </a>
                    <script>
                      document.getElementById('open-window-<?php echo $w; ?>').onclick = function() {
                        window.open('<?php echo esc_url($enlace_recorrido); ?>', '_blank', 'width=960,height=535,scrollbars=yes,left=70,top=150,location=no');
                      };
                    </script>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>


      <div class="w-full lg:w-1/3">
        <?php
        $simulador = get_field('show_simulador');
        if ($simulador === 'si') {
        ?>

          <div class="bg-white flex justify-around items-center text-center p-3 shadow-lg border border-gray-200 mb-3 rounded">
            <div><span class="block text-[0.65rem]">Área desde</span><span class="font-bold text-sm"><?php echo $area ? $area . 'm²' : '-'; ?></span></div>
            <?php if ($pisos) { ?>
              <div class="w-[1px] h-[30px] bg-black/25"></div>
              <div><span class="block text-[0.65rem]">Pisos</span><span class="font-bold text-sm"><?php echo $pisos ? $pisos : '-'; ?></span></div>
            <?php } ?>
            <div class="w-[1px] h-[30px] bg-black/25"></div>
            <div><span class="block text-[0.65rem]">Unidades</span><span class="font-bold text-sm"><?php echo $unidades ? $unidades : '-'; ?></span></div>
            <div class="w-[1px] h-[30px] bg-black/25"></div>
            <div><span class="block text-[0.65rem]">Parqueaderos</span><span class="font-bold text-sm"><?php echo $parqueaderos ? $parqueaderos : '-'; ?></span></div>
          </div>
          <div class="sticky top-[120px] p-0 rounded shadow-lg border border-gray-200 overflow-hidden">
            <?php get_template_part('part-templates/simulador'); ?>
          </div>
        <?php } else { ?>
          <div class="bg-white flex justify-around items-center text-center p-3 shadow-lg border border-gray-200 mb-3 rounded">
            <div><span class="block text-[0.65rem]">Área desde</span><span class="font-bold text-sm"><?php echo $area ? $area . 'm²' : '-'; ?></span></div>
            <?php if ($pisos) { ?>
              <div class="w-[1px] h-[30px] bg-black/25"></div>
              <div><span class="block text-[0.65rem]">Pisos</span><span class="font-bold text-sm"><?php echo $pisos ? $pisos : '-'; ?></span></div>
            <?php } ?>
            <div class="w-[1px] h-[30px] bg-black/25"></div>
            <div><span class="block text-[0.65rem]">Unidades</span><span class="font-bold text-sm"><?php echo $unidades ? $unidades : '-'; ?></span></div>
            <div class="w-[1px] h-[30px] bg-black/25"></div>
            <div><span class="block text-[0.65rem]">Parqueaderos</span><span class="font-bold text-sm"><?php echo $parqueaderos ? $parqueaderos : '-'; ?></span></div>
          </div>
          <div class="sticky top-[120px] rounded shadow-lg border border-gray-200 bg-gray-100">
            <div class="p-4 flex items-center justify-between border-b border-gray-200">
              <div class="flex items-center">
                <img class="grayscale-100 brightness-50 me-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png" width="50">

                <div>
                  <p class="text-center mb-0">Asesor Comercial Senior</p>
                  <p class="text-lg text-black mb-0 font-bold"><i class="bi bi-phone-vibrate"></i> <?php the_field('tel-proyectos', 'option'); ?></p>
                </div>
              </div>
              <div>
                <?php if (!get_field('brochure')) { ?>
                  <a class="flex justify-center items-center bg-white text-[var(--red)] py-2 px-3 rounded-full border border-[var(--red)] hover:bg-[var(--red)] hover:text-white transition-colors" href="<?php the_field('brochure'); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-richtext" viewBox="0 0 16 16">
                      <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                      <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
                    </svg>
                    <div class="pl-1 text-xs leading-none text-left">
                      <small class="block">Descargar</small>
                      <small class="block">Brochure</small>
                    </div>
                  </a>
                <?php } ?>
              </div>
            </div>

            <div class="w-full ">
              <?php if (get_field('proyecto-formulario')) {
                //the_field('proyecto-formulario');
                echo do_shortcode('[contact-form-7 id="deec133" title="Proyecto"]');
              } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>

<section class="isLight">
  <div id="zp" class="py-16 relative overflow-hidden">
    <div class="container mx-auto relative 
      before:absolute before:content-[''] before:left-0 before:top-0 before:w-[200px] before:h-full before:bg-gradient-to-r before:from-[#ffffff] before:to-transparent before:z-10
      after:absolute after:content-[''] after:right-0 after:top-0 after:w-[200px] after:h-full after:bg-gradient-to-l after:from-[#ffffff] after:to-transparent after:z-10">
      <?php if (have_rows('rep-amenities')) : ?>
        <!-- <div class="text-center">
          <h2 class="text-3xl text-gray-800 font-bold mb-5 text-center">
            Espacios de entretenimiento <br />
            para
            <div class="inline-block" style="color: <?php echo $color; ?>">su familia</div>
          </h2>
        </div> -->
      <?php endif; ?>
      <div class="flex flex-wrap">
        <div class="w-full">
          <div class="splide amenities-splide">
            <div class="splide__track">
              <div class="splide__list">
                <?php if (have_rows('rep-amenities')) : ?>
                  <?php while (have_rows('rep-amenities')) : the_row(); ?>
                    <div class="splide__slide text-center">
                      <div class="z-items flex items-center justify-center flex-col">
                        <?php if (get_sub_field('proyecto-icono-amenitie')) : ?>
                          <img class="w-[75x] h-[75px] object-cover" src="<?php the_sub_field('proyecto-icono-amenitie'); ?>" />
                        <?php endif ?>
                        <p class="text-sm leading-none"><?php the_sub_field('proyecto-nombre-amenitie'); ?></p>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              new Splide('.amenities-splide', {
                type: 'loop',
                perPage: 6,
                pagination: false,
                arrows: false,
                autoplay: true,
                interval: 0, // Set to 0 for continuous movement
                speed: <?php echo wp_is_mobile() ? '60000' : '240000';?>, // Very slow movement (15 seconds per transition)
                gap: '2rem',
                drag: false, // Disable dragging for smooth movement
                pauseOnHover: false, // Don't pause on hover
                pauseOnFocus: false, // Don't pause on focus
                breakpoints: {
                  320: {
                    perPage: 2
                  },
                  768: {
                    perPage: 3
                  },
                  1024: {
                    perPage: 6
                  }
                }
              }).mount();
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</section>


<section id="carac" class="isLight">
  <div class="container mx-auto px-4">
    <div class="splide caracteristicas-splide">
      <div class="splide__track">
        <div class="splide__list">
          <?php if (have_rows('rep-carrusel')) : ?>
            <?php $k = 1; ?>
            <?php while (have_rows('rep-carrusel')) : the_row(); ?>
              <?php if (get_sub_field('proyecto-carrusel-imagen')) : ?>
                <div class="splide__slide">
                  <img class="w-full h-auto border border-gray-200 rounded" src="<?php the_sub_field('proyecto-carrusel-imagen'); ?>" />
                </div>
              <?php endif ?>
              <?php $k++; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="mt-2">
      <span class="text-sm text-gray-500">Esta imagen es referencial sujeta a modificaciones por requerimientos técnicos y estructurales.</span>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new Splide('.caracteristicas-splide', {
        type: 'loop',
        perPage: 1,
        autoplay: true,
        interval: 3000,
        arrows: true,
        pagination: false,
        breakpoints: {
          640: {
            arrows: false
          }
        }
      }).mount();
    });
  </script>
</section>


<section id="avances">
  <div class="mt-5">
    <?php if (have_rows('rep-avances-obra')) : ?>
      <div id="avances-obra" class="user-select-none bg-[var(--project-color)]">
        <?php get_template_part('part-templates/avances'); ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section id="asesores" class="w-full bg-gray-100">
  <div class="container mx-auto py-16 isLight px-4 md:px-0">
    <div class="flex flex-wrap">
      <div class="w-full">
        <h2 class="font-bold text-center text-4xl">Contacta a nuestros asesores</h2>
        <div class="space-5"></div>
        <?php get_template_part('part-templates/asesores'); ?>
      </div>
    </div>
  </div>

  <?php get_template_part('part-templates/modal-simulador'); ?>
</section>





<?php //get_template_part('part-templates/compartir'); ?>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('#goTo--avances a.btn');
    const lightSections = document.querySelectorAll('.isLight');

    if (!button) return;

    // Asegurar que el botón tenga un estilo inicial
    button.classList.add('border-white');

    function checkOverlap() {
      const buttonRect = button.getBoundingClientRect();
      const buttonY = buttonRect.top + buttonRect.height / 2;
      let isOverLight = false;

      lightSections.forEach((section) => {
        const sectionRect = section.getBoundingClientRect();
        if (buttonY >= sectionRect.top && buttonY <= sectionRect.bottom) {
          isOverLight = true;
        }
      });

      if (isOverLight) {
        button.classList.replace('border-white', 'border-black');
        button.classList.replace('text-white', 'text-black');
      } else {
        button.classList.replace('border-black', 'border-white');
        button.classList.replace('text-black', 'text-white');
      }
    }

    // Ejecutar checkOverlap después de un pequeño retraso para asegurar que los elementos estén renderizados
    setTimeout(checkOverlap, 100);

    window.addEventListener('scroll', () => requestAnimationFrame(checkOverlap));
    window.addEventListener('resize', () => requestAnimationFrame(checkOverlap));
  });
</script>


<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const destination = document.querySelector(this.getAttribute('href'));
      const scrollPadding = parseInt(getComputedStyle(document.documentElement).scrollPaddingTop) || 0;
      const scrollPosition = destination.offsetTop - scrollPadding;

      window.scrollTo({
        top: scrollPosition,
        behavior: 'smooth'
      });
    });
  });
</script>



<script>
  // Código JavaScript para manejar el cambio de pestañas
  document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de pestaña que tienen la clase tab-button
    const tabButtons = document.querySelectorAll('.tab-button');

    tabButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Desactivar todas las pestañas
        tabButtons.forEach(btn => {
          btn.classList.remove('active', 'border-[var(--dark)]');
          btn.classList.add('border-transparent');
          btn.setAttribute('aria-selected', 'false');
        });

        // Ocultar todos los paneles
        document.querySelectorAll('[role="tabpanel"]').forEach(panel => {
          panel.classList.add('hidden');
          panel.classList.remove('block');
        });

        // Activar la pestaña actual
        this.classList.add('active', 'border-[var(--dark)]');
        this.classList.remove('border-transparent');
        this.setAttribute('aria-selected', 'true');

        // Mostrar el panel correspondiente
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
