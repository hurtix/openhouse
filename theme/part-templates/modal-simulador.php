<?php
/**
 * This is a part template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>


<!-- Modal -->
<div id="resultModal" class="hidden backdrop">
    <div class="flex justify-center items-center h-screen">
    <div class="max-w-[380px] md:max-w-[500px] mx-auto w-full p-2 md:p-4">
        <div class="bg-gray-100 rounded-lg shadow-xl">
            <div class="flex justify-end p-4">
                <button type="button" data-modal-close class="text-[var(--red)] hover:text-[var(--dark)] cursor-pointer" onclick="cerrarModal()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle scale-150" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></button>
            </div>
            <div class="px-2 md:px-6 pb-2 md:pb-6 flex flex-col w-full gap-2 md:gap-4">
                <?php 
                $tipo = get_field('tipo_simulador');
                if($tipo=='tipo1') { ?>
                    <p class="text-center w-full bg-[var(--dark)] text-white p-2">Separando el apartaestudio con <span class="font-bold"><span class="simbolo">$</span><span id="modal-sep"></span></span><span id="si-cuota">, te quedaría un pago a <span class="font-bold" id="qty-cuotas"></span> con un valor de <span class="font-bold"><span class="simbolo">$</span><span id="cuota-mensual"></span></span></span> y <span class="font-bold"><span class="simbolo">$</span><span id="saldo"></span></span> a la entrega del proyecto.</p>
                <?php } elseif($tipo=='tipo2') { ?>
                    <p class="text-center w-full bg-[var(--dark)] text-white p-2">Separando el lote con <span class="font-bold"><span class="simbolo">$</span><span id="modal-sep"></span></span><span id="si-cuota">, te quedaría un saldo a <span class="font-bold" id="qty-cuotas"></span> con un valor de <span class="font-bold"><span class="simbolo">$</span><span id="cuota-mensual"></span></span></span>.</p>
                <?php } ?>
                
                <p class="text-sm text-gray-500 text-center leading-tight">Los valores presentados son aproximados y están sujetos a modificaciones sin previo aviso.</p>
                <hr class="opacity-25">
                
                <div class="flex justify-center items-center w-full">
                    <img class="pointer-events-none w-[100px]" src="<?php echo get_template_directory_uri(); ?>/assets/img/hands-2.png" alt="">
                    <div>
                        <p class="leading-tight mb-0">¿Quieres conocer los <span class="font-bold">beneficios</span> y <span class="font-bold">descuentos</span> que tenemos para ti? Déjanos tus datos para brindarte información exclusiva.</p>
                    </div>
                </div>
                <?php echo do_shortcode('[contact-form-7 id="6271970"]'); ?>
            </div>
        </div>
    </div>
</div>
</div>