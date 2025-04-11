<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
?>
<div class="bg-[var(--dark)] h-auto lg:h-[25vh]">
    <div class="text-white container mx-auto px-4 lg:px-0 pt-30 lg:pt-0 flex justify-end items-start h-full flex-col">
        <h2 class="font-bold text-4xl">Proyectos que inspiran progreso</h2>
        <p>Explora nuestra selección de proyectos destacados y encuentra el lugar ideal para vivir, trabajar o invertir.</p>
    </div>
</div>

<div class="wrapper pt-10" id="archive-wrapper" style="background: linear-gradient(-180deg, rgb(33, 37, 41) 25vh, var(--color-gray-100) 25vh);">
    <div class="container mx-auto px-4 lg:px-0" id="content" tabindex="-1">
        <div class="flex flex-wrap">
            <div class="flex justify-between items-center mb-4 w-full">
                <span class="sr-only z-100"></span>
                <div class="sr-only top-[11%] right-[4%] z-100"></div>
                <div class="sr-only top-[16%]"></div>
                <button id="btn-filtro" type="button" class="btn text-sm lg:text-base inline-flex cursor-pointer text-white py-3 px-4 leading-none rounded-full border border-gray-200 hover:bg-white hover:text-[var(--dark)]" data-bs-toggle="button" data-filter-value="<?php echo esc_attr($term->slug); ?>"></button>
                <span id="resultados" class="text-white"></span>
            </div>
            <div class="flex items-start gap-8">
                <div id="wrapper-filtro" class="hidden mb-20 shadow-lg bg-white border border-gray-200 rounded-none lg:rounded p-4">
                    <a class="btn text-sm inline-flex  py-2 px-3 border border-[var(--red)] text-[var(--red)] hover:bg-[var(--red)] hover:text-white rounded-full" href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3 me-1" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                        </svg> Borrar filtros</a>
                    <hr class="my-4 opacity-25">
                    <h5 class="text-lg font-bold text-[var(--red)] mb-4">Status</h5>
                    <ul class="list-none m-0 p-0 flex justify-start items-center gap-2 flex-wrap" id="filter-status">
                        <?php
                        // Obtener todos los términos de la taxonomía status_proyecto
                        $status_terms = get_terms(array(
                            'taxonomy' => 'status_proyecto',
                            'hide_empty' => true
                        ));

                        // Comprobar si hay términos y no hay error
                        if (!empty($status_terms) && !is_wp_error($status_terms)) {
                            foreach ($status_terms as $term) {
                                // Crear un ID seguro para el HTML basado en el slug del término
                                $term_id_safe = sanitize_title($term->slug);
                        ?>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="filter-btn text-xs border py-1 px-2 rounded-full cursor-pointer" data-bs-toggle="button" data-filter-value="<?php echo esc_attr($term->slug); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </button>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    <hr class="my-4 opacity-25">
                    <h5 class="text-lg font-bold text-[var(--red)] mb-4">Ubicación</h5>
                    <ul class="list-none m-0 p-0 flex justify-start items-center gap-2 flex-wrap" id="filter-ubicacion">
                        <?php
                        // Obtener todos los términos de la taxonomía status_proyecto
                        $status_terms = get_terms(array(
                            'taxonomy' => 'municipio',
                            'hide_empty' => true
                        ));


                        // Comprobar si hay términos y no hay error
                        if (!empty($status_terms) && !is_wp_error($status_terms)) {
                            foreach ($status_terms as $term) {

                                // Crear un ID seguro para el HTML basado en el slug del término
                                $term_id_safe = sanitize_title($term->slug);
                        ?>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="filter-btn text-xs border py-1 px-2 rounded-full cursor-pointer" data-bs-toggle="button" data-filter-value="<?php echo esc_attr($term->slug); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </button>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    <hr class="my-4 opacity-25">
                    <h5 class="text-lg font-bold text-[var(--red)] mb-4">Zona</h5>
                    <ul class="list-none m-0 p-0 flex justify-start items-center gap-2 flex-wrap" id="filter-zona">
                        <?php
                        // Obtener todos los términos de la taxonomía status_proyecto
                        $status_terms = get_terms(array(
                            'taxonomy' => 'zona',
                            'hide_empty' => true
                        ));

                        // Comprobar si hay términos y no hay error
                        if (!empty($status_terms) && !is_wp_error($status_terms)) {
                            foreach ($status_terms as $term) {

                                // Crear un ID seguro para el HTML basado en el slug del término
                                $term_id_safe = sanitize_title($term->slug);
                        ?>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="filter-btn text-xs border py-1 px-2 rounded-full cursor-pointer" data-bs-toggle="button" data-filter-value="<?php echo esc_attr($term->slug); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </button>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <main id="main" class="site-main grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4 w-full pb-20">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('loop-templates/content-proyecto');
                        }
                    }
                    ?>
                </main>
            </div>
            <!-- <img src="/wp-content/themes/understrap-child-main/assets/img/decoracion-left.png" class="decoracion_left_dos" alt="" /> -->
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing button toggle code
        const btnFiltro = document.getElementById('btn-filtro');
        const wrapperFiltro = document.getElementById('wrapper-filtro');
        const resultados = document.getElementById('resultados');
        const main = document.getElementById('main');
        btnFiltro.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter me-1" viewBox="0 0 16 16"><path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/></svg> Filtrar';
        function updateButtonContent() {
            const isOpen = wrapperFiltro.classList.contains('isOpen');
            btnFiltro.innerHTML = isOpen ? 
                `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg lg:me-1" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg> <?php echo wp_is_mobile() ? '' : 'Cerrar filtro'; ?>` : 
                `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter me-1" viewBox="0 0 16 16"><path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/></svg> Filtrar`;
        }

        
<?php if(wp_is_mobile()) { ?>
    btnFiltro.addEventListener('click', function() {
                wrapperFiltro.classList.toggle('isOpen');
                updateButtonContent();
                wrapperFiltro.classList.toggle('mt-[11vh]');
                wrapperFiltro.classList.toggle('z-99');
                wrapperFiltro.classList.toggle('hidden');
                wrapperFiltro.classList.toggle('absolute');
                wrapperFiltro.classList.toggle('top-0');
                wrapperFiltro.classList.toggle('left-0');
                wrapperFiltro.classList.toggle('w-full');
                wrapperFiltro.classList.toggle('h-screen');
                btnFiltro.classList.toggle('absolute');
                btnFiltro.classList.toggle('z-100');
                btnFiltro.classList.toggle('top-[11%]');
                btnFiltro.classList.toggle('right-[4%]');
                btnFiltro.classList.toggle('bg-[var(--dark)]');
                btnFiltro.classList.toggle('aspect-square');
                btnFiltro.classList.toggle('items-center');
                resultados.classList.toggle('absolute');
                resultados.classList.toggle('z-100');
                resultados.classList.toggle('top-[16%]');
                resultados.classList.toggle('right-[4%]');
                resultados.classList.toggle('text-white');
                document.body.classList.toggle('overflow-hidden');
        });
<?php } else { ?>
    btnFiltro.addEventListener('click', function() {
            wrapperFiltro.classList.toggle('isOpen');
            updateButtonContent();
            wrapperFiltro.classList.toggle('hidden');
            wrapperFiltro.classList.toggle('w-[25%]');
            main.classList.toggle('w-[100%]');
            main.classList.toggle('w-75%]');
            main.classList.toggle('lg:grid-cols-4');
            main.classList.toggle('lg:grid-cols-3');
        });
<?php } ?>
        

        // New filtering code

        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('bg-[var(--dark)]');
                this.classList.toggle('text-white');
                this.classList.toggle('active'); // Add this line to toggle the 'active' class
            });
        });


        function filterProjects() {
            const activeStatus = [...document.querySelectorAll('#filter-status .filter-btn.active')].map(btn => btn.getAttribute('data-filter-value'));
            const activeUbicacion = [...document.querySelectorAll('#filter-ubicacion .filter-btn.active')].map(btn => btn.getAttribute('data-filter-value'));
            const activeZona = [...document.querySelectorAll('#filter-zona .filter-btn.active')].map(btn => btn.getAttribute('data-filter-value'));

            let visibleCount = 0;

            document.querySelectorAll('.proyecto').forEach(project => {
                let show = true;

                if (activeStatus.length > 0) {
                    show = show && activeStatus.includes(project.dataset.status);
                }

                if (activeUbicacion.length > 0) {
                    show = show && activeUbicacion.includes(project.dataset.ubicacion);
                }

                if (activeZona.length > 0) {
                    show = show && activeZona.includes(project.dataset.zona);
                }

                project.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
            document.getElementById('resultados').textContent = `${visibleCount} ${visibleCount === 1 ? 'resultado' : 'resultados'}`;
        }


        // Add click event listeners to all filter buttons
        ['status', 'ubicacion', 'zona'].forEach(filterType => {
            const buttons = document.querySelectorAll(`#filter-${filterType} button`);
            buttons.forEach(button => {
                button.addEventListener('click', filterProjects);
            });
        });

        // Reset filters when clicking the reset button
        document.querySelector('a[href=""]').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('#wrapper-filtro .filter-btn.active').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('bg-[var(--dark)]');
                btn.classList.remove('text-white');
            });
            document.querySelectorAll('.proyecto').forEach(project => {
                project.style.display = 'block';
            });
            document.getElementById('resultados').textContent = `${document.querySelectorAll('.proyecto').length} ${document.querySelectorAll('.proyecto').length === 1 ? 'resultado' : 'resultados'}`;
        });
    });
</script>


<?php
get_footer();
