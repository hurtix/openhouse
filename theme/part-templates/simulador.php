<?php
/**
 * This is a part template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php 
    $titulo = get_the_title();
    $tipo = get_field( 'tipo_simulador' );
    $valor = get_field('proyecto-precio') ?: 0;
    $separacion = get_field('porcentaje_separacion'); 
    $inicial = get_field('porcentaje_inicial');
    $min_mes = get_field('min_month');
    $max_mes = get_field('max_month');
    $valor_separacion = ceil(($valor * $separacion) / 100);
    $valor_inicial = ceil(($valor * $inicial) / 100);
    
    $contraentrega = 100 - $inicial;
    $valor_contraentrega = ceil(($valor * $contraentrega) / 100);
    
    if($tipo=='tipo1') { 
        $financiar = ($inicial - $separacion) / 100;
        $valor_financiar = ceil(($valor * $financiar));
    } elseif($tipo=='tipo2') { 
        $financiar = (100 - $separacion) / 100;
        $valor_financiar = ceil(($valor * $financiar));
    } 
?>
<div id="loan--calculator" class="w-full">
    <div class="select-none shadow-md">
        <div class="bg-[var(--dark)] text-white p-4">
            <div class="flex justify-between items-center">
                <h4 class="text-2xl font-bold mb-0">Simulador</h4>
                <a class="w-1/4 flex justify-center items-center bg-white text-[var(--red)] py-2 px-3 rounded-full border border-white hover:bg-[var(--red)] hover:text-white transition-colors" href="<?php the_field('brochure'); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-richtext" viewBox="0 0 16 16">
                        <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
                    </svg>
                    <div class="pl-1 text-xs leading-none text-left">
                        <small class="block">Descargar</small>
                        <small class="block">Brochure</small>
                    </div>
                </a>
            </div>
        </div>
        <div class="p-4 [&_input]:border-gray-200 [&_span]:border-gray-200 [&_select]:border-gray-200">
            <div class="mb-2">
                <?php if($tipo=='tipo1') { ?>
                    <label class="block text-sm mb-1">Valor del inmueble:</label>
                <?php } elseif($tipo=='tipo2') { ?>
                    <label class="block text-sm mb-1">Valor del lote:</label>
                <?php } ?>
                <div class="flex">
                    <span class="px-2 py-1 bg-gray-100 border border-r-0 rounded-l simbolo">$</span>
                    <input type="text" class="precio flex-1 px-3 py-1 border focus:outline-none focus:ring-1 focus:ring-gray-400" value="<?php echo $valor; ?>" id="valor-inmueble" oninput="updateCalculations()" data-precio="<?php echo $valor; ?>">
                    <span class="px-2 py-1 bg-gray-100 border border-l-0 rounded-r moneda">COP</span>
                </div>
            </div>
            <div class="mb-2">
                <label class="block text-sm mb-1">Separación:</label>
                <div class="flex">
                    <select class="px-3 py-1 border rounded-l focus:outline-none focus:ring-1 focus:ring-gray-400" id="seleccionado" onchange="updateValorSeparacion()">
                        <?php
                        for ($i = $separacion; $i < $inicial; $i += 10) {
                            echo '<option value="' . $i . '">' . $i . '%</option>';
                        }
                        ?>
                        <option value="<?php echo $inicial; ?>"><?php echo $inicial; ?>%</option>
                    </select>
                    <span class="px-2 py-1 bg-gray-100 border-t border-b simbolo">$</span>
                    <input type="text" class="precio flex-1 w-1/2 px-3 py-1 border cursor-not-allowed bg-gray-50" value="" readonly id="valor-separacion">
                    <span class="px-2 py-1 bg-gray-100 border rounded-r moneda">COP</span>
                </div>
            </div>
            <div class="mb-2 hidden">
                <label class="block text-sm mb-1">Cuota inicial (<?php echo $inicial; ?>%):</label>
                <div class="flex">
                    <span class="px-2 py-1 bg-gray-100 border border-r-0 rounded-l simbolo">$</span>
                    <input type="text" class="precio flex-1 px-3 py-1 border cursor-not-allowed bg-gray-50" value="<?php echo $valor_inicial; ?>" readonly id="valor-cuota-inicial">
                    <span class="px-2 py-1 bg-gray-100 border border-l-0 rounded-r moneda">COP</span>
                </div>
            </div>
            <div class="mb-2">
                <?php if($tipo=='tipo1') { ?>
                    <label class="block text-sm mb-1">A financiar (<span id="a-financiar"></span>%) de la cuota inicial:</label>
                <?php } elseif($tipo=='tipo2') { ?>
                    <label class="block text-sm mb-1">Saldo restante (<span id="a-financiar"></span>%) financiado sin intereses:</label>
                <?php } ?>
                <div class="flex">
                    <span class="px-2 py-1 bg-gray-100 border border-r-0 rounded-l simbolo">$</span>
                    <input type="text" class="precio flex-1 px-3 py-1 border cursor-not-allowed bg-gray-50" value="" readonly id="valor-financiar">
                    <span class="px-2 py-1 bg-gray-100 border border-l-0 rounded-r moneda">COP</span>
                </div>
            </div>
            <div id="rango" class="mb-2 relative">
                <label class="block text-sm mb-1">¿A cuánto tiempo?:</label>
                <span class="pl-1 text-[var(--red)] font-bold" id="meses-display">
                    <?php if ($min_mes == 1) {
                        echo $min_mes . ' mes';
                    } else {
                        echo $min_mes . ' meses';
                    } ?>
                </span>
                <input type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer mb-2" min="<?php echo $min_mes; ?>" max="<?php echo $max_mes; ?>" value="<?php echo $min_mes; ?>" id="cantidad-meses">
                <span class="text-sm leading-none absolute bottom-0 left-0 select-none"><?php echo $min_mes; ?></span>
                <span class="block text-center w-full text-xs leading-none absolute bottom-0 select-none">Desliza para ajustar la cantidad de tiempo</span>
                <span class="text-sm leading-none absolute bottom-0 right-0 select-none"><?php echo $max_mes; ?></span>
            </div>
            <?php if($tipo=='tipo1') { ?>
                <hr class="my-4">
                <div class="mb-2">
                    <label class="block text-sm mb-1">Saldo restante (<?php echo $contraentrega; ?>%) a la entrega del proyecto:</label>
                    <div class="flex">
                        <span class="px-2 py-1 bg-gray-100 border border-r-0 rounded-l simbolo">$</span>
                        <input type="text" class="precio flex-1 px-3 py-1 border cursor-not-allowed bg-gray-50" value="<?php echo $valor_contraentrega; ?>" data-precio="<?php echo $valor_contraentrega; ?>" readonly id="valor-contraentrega">
                        <span class="px-2 py-1 bg-gray-100 border border-l-0 rounded-r moneda">COP</span>
                    </div>
                </div>
            <?php } ?>
            <div class="text-center">
                <button type="button"
                    class="px-6 py-2 bg-[var(--red)] text-white font-bold rounded-full hover:bg-[var(--darkred)] transition-colors cursor-pointer"
                    onclick="abrirModal(); calcularCuota();">
                    Calcular cuota
                </button>
            </div>
        </div>
    </div>
</div>



<script>
function passToForm() {
    const proyecto = document.getElementById('proyecto');
    proyecto.value = '<?php echo $titulo;?>';
    const ValInmueble = document.getElementById('val-inmueble');
    ValInmueble.value = document.getElementById('valor-inmueble').value;
    const ValSepracion = document.getElementById('val-separacion');
    ValSepracion.value = document.getElementById('valor-separacion').value;
    const ValFinanciar = document.getElementById('val-financiar');
    ValFinanciar.value = document.getElementById('valor-financiar').value;
    const CantCuotas = document.getElementById('cant-cuotas');
    CantCuotas.value = document.getElementById('cantidad-meses').value;
    const ValCuota = document.getElementById('val-cuota');
    const valorFinanciar = parseFloat(document.getElementById('valor-financiar').value.replace(/\D/g, ''));
    const cantidadMeses = parseInt(document.getElementById('cantidad-meses').value);
    const cuotaMensual = Math.ceil(valorFinanciar / cantidadMeses);
    ValCuota.value = cuotaMensual.toLocaleString('es-CO');
    const ValSaldo = document.getElementById('val-saldo');
    ValSaldo.value = document.getElementById('valor-contraentrega').value;
}

function roundUpAndFormat() {
    const valorInmuebleInput = document.getElementById('valor-inmueble');
    const valorSeparacionInput = document.getElementById('valor-separacion');
    const valorCuotaInicialInput = document.getElementById('valor-cuota-inicial');
    const valorFinanciarInput = document.getElementById('valor-financiar');
    const valorContraentregaInput = document.getElementById('valor-contraentrega');

    const roundUp = (value) => Math.ceil(parseFloat(value));
    const formatNumber = (value) => {
        const number = parseFloat(value);
        return number.toLocaleString('es-CO', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    };

    valorInmuebleInput.value = formatNumber(roundUp(valorInmuebleInput.value.replace(/\D/g, '')));
    valorSeparacionInput.value = formatNumber(roundUp(valorSeparacionInput.value.replace(/\D/g, '')));
    valorCuotaInicialInput.value = formatNumber(roundUp(valorCuotaInicialInput.value.replace(/\D/g, '')));
    valorFinanciarInput.value = formatNumber(roundUp(valorFinanciarInput.value.replace(/\D/g, '')));
    if (valorContraentregaInput) {
        valorContraentregaInput.value = formatNumber(roundUp(valorContraentregaInput.value.replace(/\D/g, '')));
    }
}

function updateCalculations() {
    const valorInmuebleInput = document.getElementById('valor-inmueble');
    let valorInmueble = parseFloat(valorInmuebleInput.value.replace(/\D/g, ''));
    
    if (isNaN(valorInmueble)) {
        valorInmueble = 0;
    }
    
    valorInmuebleInput.value = valorInmueble.toLocaleString('es-CO');
    
    const porcentajeSeparacion = parseFloat(document.getElementById('seleccionado').value);
    const valorSeparacion = Math.ceil((valorInmueble * porcentajeSeparacion) / 100);
    
    <?php if($tipo=='tipo1') { ?>
        const financiarPorcentaje = (<?php echo $inicial; ?> - porcentajeSeparacion) / 100;
    <?php } elseif($tipo=='tipo2') { ?>
        const financiarPorcentaje = (100 - porcentajeSeparacion) / 100;
    <?php } ?>
    
    const valorAFinanciar = Math.ceil(valorInmueble * financiarPorcentaje);
    
    document.getElementById('valor-separacion').value = valorSeparacion.toLocaleString('es-CO');
    document.getElementById('valor-financiar').value = valorAFinanciar.toLocaleString('es-CO');
    
    <?php if($tipo=='tipo1') { ?>
        const contraentrega = <?php echo $contraentrega; ?> / 100;
        const valorContraentrega = Math.ceil(valorInmueble * contraentrega);
        document.getElementById('valor-contraentrega').value = valorContraentrega.toLocaleString('es-CO');
    <?php } ?>
    
    document.getElementById('a-financiar').textContent = (financiarPorcentaje * 100).toFixed(0);
    
    const siCuota = document.getElementById('si-cuota');
    const rango = document.getElementById('rango');
    <?php if($tipo=='tipo1') { ?>
        if (valorAFinanciar === 0) {
            rango.classList.add('d-none');
            siCuota.classList.add('d-none');
        } else {
            rango.classList.remove('d-none');
            siCuota.classList.remove('d-none');
        }   
    <?php } ?>
}

function updateValorSeparacion() {
    updateCalculations();
}

window.addEventListener('load', function() {
    updateCalculations();
    roundUpAndFormat();
});

document.getElementById('seleccionado').addEventListener('change', updateValorSeparacion);

document.getElementById('cantidad-meses').addEventListener('input', function(e) {
    const display = document.getElementById('meses-display');
    const value = e.target.value;
    display.textContent = value + (value === '1' ? ' mes' : ' meses');
});

    // Funciones para abrir y cerrar el modal
    function abrirModal() {
        document.getElementById('resultModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Evita scroll en el fondo
    }

    function cerrarModal() {
        document.getElementById('resultModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Cerrar el modal con la tecla Escape
    //   document.addEventListener('keydown', function(event) {
    //     if (event.key === 'Escape') {
    //       cerrarModal();
    //     }
    //   });

    // Cerrar el modal al hacer clic fuera de él
    // document.getElementById('resultModal').addEventListener('click', function(event) {
    //     if (event.target === this) {
    //         cerrarModal();
    //     }
    // });

<?php if($tipo=='tipo1') { ?>
function calcularCuota() {
    const valorFinanciar = parseFloat(document.getElementById('valor-financiar').value.replace(/\D/g, ''));
    const cantidadMeses = parseInt(document.getElementById('cantidad-meses').value);
    const cuotaMensual = Math.ceil(valorFinanciar / cantidadMeses);
    const saldo = document.getElementById('valor-contraentrega').value;
    const modalSep = document.getElementById('valor-separacion').value;
    document.getElementById('cuota-mensual').textContent = cuotaMensual.toLocaleString('es-CO');
    document.getElementById('saldo').textContent = saldo;
    document.getElementById('modal-sep').textContent = modalSep;
    const qtyCuotas = document.getElementById('cantidad-meses').value;
    document.getElementById('qty-cuotas').textContent = qtyCuotas + (qtyCuotas === '1' ? ' cuota' : ' cuotas');
    passToForm();
}
<?php } elseif($tipo=='tipo2') { ?>
function calcularCuota() {
    const valorFinanciar = parseFloat(document.getElementById('valor-financiar').value.replace(/\D/g, ''));
    const cantidadMeses = parseInt(document.getElementById('cantidad-meses').value);
    const cuotaMensual = Math.ceil(valorFinanciar / cantidadMeses);
    const modalSep = document.getElementById('valor-separacion').value;
    
    document.getElementById('cuota-mensual').textContent = cuotaMensual.toLocaleString('es-CO');
    document.getElementById('modal-sep').textContent = modalSep;
    const qtyCuotas = document.getElementById('cantidad-meses').value;
    document.getElementById('qty-cuotas').textContent = qtyCuotas + (qtyCuotas === '1' ? ' cuota' : ' cuotas');
    passToForm();
}
<?php } ?>
</script>



