<?php
/**
 * The template for displaying all single inmueble
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package chipicasa
 */
get_header();

// Definir un array asociativo para mapear valores de los tipos de inmueble
global $tipos_inmueble_map;
global $zonas_inmueble_map;
$tipo_inmueble = get_post_meta(get_the_ID(), 'tipo_inmueble', true);
$zona_inmueble = get_post_meta(get_the_ID(), 'zona_inmueble', true);
$campos = obtener_campos_inmueble($post->ID);
//mapa
$coordenadas = get_post_meta(get_the_ID(), 'campo_mapa', true);
if ($coordenadas) {
	$coordenadas = explode(',', $coordenadas);
	$lat = $coordenadas[0];
	$lng = $coordenadas[1];
} else {
	// Proporciona un valor predeterminado si las coordenadas no están disponibles
	$lat = 0;
	$lng = 0;
}
$visibilidad_direccion = get_post_meta(get_the_ID(), 'visibilidad_direccion', true);
// Pasa las coordenadas y la forma de mostrar el mapa de PHP a JavaScript
wp_enqueue_script('scripts', get_template_directory_uri() . '/js/maps.js', array('jquery'), false, true);
$datos_mapa = array(
	'lat' => $lat, 	
	'lng' => $lng,
	'visibilidad_direccion' => $visibilidad_direccion
);
wp_localize_script('scripts', 'datos_mapa', $datos_mapa);

// Encolar el script de Google Maps
$api_key = get_option('inmuebles_google_maps_api_key', '');
wp_enqueue_script('google-maps', "https://maps.googleapis.com/maps/api/js?key={$api_key}&callback=initMap", array('scripts'), null, true);
?>

<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post() ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<!--/ Intro Single star /-->
		<section class="intro-single">
			<div class="container">
				<div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single"><?php echo esc_html($tipos_inmueble_map[$tipo_inmueble]) . esc_html(' en ', 'chipicasa') . esc_html($campos['nombre_calle']) ?></h1>
                            <span class="color-text-a"><?php echo esc_html($campos['localidad']); ?></span>
                        </div>
                    </div>
                </div>
			</div>
		</section>
		<!--/ Intro Single End /-->
		<!--/ Property Single Star /-->
		<section class="property-single nav-arrow-b">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<!-- Galería de imágenes -->
						<div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
							<?php foreach ($campos['galeria_imagenes'] ?? '' as $imagen) : ?>
								<div class="carousel-item-b">
									<img src="<?php echo esc_url($imagen); ?>" alt="Imagen">
								</div>
							<?php endforeach; ?>
						</div>
						<div class="row justify-content-between">
							<div class="col-md-5 col-lg-4">
							
							
								<div class="property-price d-flex justify-content-center foo">
									<div class="card-header-c d-flex">
										
										<div class="card-title-c align-self-center">
											<h5 class="title-c">
                                                <?php echo isset($campos['precio_venta']) ? esc_html($campos['precio_venta']) : 
                                                    (isset($campos['precio_alquiler']) ? esc_html($campos['precio_alquiler']) : ''); ?>    
                                            </h5>
										</div>
										<div class="card-box-ico">
											<span class="ion-money">
                                                <?php 
                                                echo isset($campos['precio_venta']) ? '€' : esc_html__('€/mes', 'chipicasa');
                                                ?>  
                                            </span>
										</div>
									</div>
								</div>


								<div class="property-summary">
									<div class="row">
										<div class="col-sm-12">
                                            <div class="title-box-d section-t4">
                                                <h3 class="title-d"><?php echo esc_html__('Quick Summary', 'chipicasa'); ?></h3>
                                            </div>
                                        </div>
									</div>
									<div class="summary-list">
										<ul class="list">
											<?php if ($zonas_inmueble_map[$zona_inmueble] ?? '') : ?>
											<li class="d-flex justify-content-between">
												<strong><?php esc_html_e('Zona:', 'chipicasa'); ?></strong>
												<span><?php echo esc_html($zonas_inmueble_map[$zona_inmueble]); ?></span>
											</li>
											<?php endif; ?>

											<?php if ($campos['m_construidos'] ?? '') : ?>
											<li class="d-flex justify-content-between">
												<strong><?php esc_html_e('Área:', 'chipicasa'); ?></strong>
												<span><?php echo esc_html($campos['m_construidos']); ?>m<sup>2</sup></span>
											</li>
											<?php endif; ?>

											<?php if ($campos['superf_terreno'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Parcela de:', 'chipicasa'); ?></strong>
													<span><?php echo esc_html($campos['superf_terreno']); ?>m<sup>2</sup></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['m_utiles'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('M útiles:', 'chipicasa'); ?></strong>
													<span><?php echo esc_html($campos['m_utiles']); ?>m<sup>2</sup></span>
												</li>
											<?php endif; ?>

											<?php if ($campos['num_dormitorios'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Dormitorios:', 'chipicasa'); ?></strong>
													<span><?php echo esc_html($campos['num_dormitorios']); ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['num_banos'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Baños:', 'chipicasa'); ?></strong>
													<span><?php echo esc_html($campos['num_banos']); ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['calif_consumo'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Consumo:', 'chipicasa'); ?></strong>
													<span><?php echo esc_html($campos['calif_consumo']); ?></span>
													<span><?php echo esc_html($campos['consumo']); ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['calif_emis'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Emisiones:', 'chipicasa'); ?></strong>
													<span><?php echo esc_html($campos['calif_emis']); ?></span>
													<span><?php echo esc_html($campos['emisiones']); ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['orientacion'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Orientación:', 'chipicasa'); ?></strong>
													<?php foreach ($campos['orientacion'] as $tipo) { ?>
														<span><?php echo esc_html($tipo); } ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['calificacion_terreno'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Calificación del terreno:', 'chipicasa'); ?></strong>
													<?php foreach ($campos['calificacion_terreno'] as $tipo) { ?>
														<span><?php echo esc_html($tipo); } ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['caract_local'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Equipamiento del local:', 'chipicasa'); ?></strong>
													<?php foreach ($campos['caract_local'] as $tipo) { ?>
														<span><?php echo esc_html($tipo); } ?></span>
												</li>
											<?php endif; ?>
											
											<?php if ($campos['caract_garaje'] ?? '') : ?>
												<li class="d-flex justify-content-between">
													<strong><?php esc_html_e('Características del garaje:', 'chipicasa'); ?></strong>
													<?php foreach ($campos['caract_garaje'] as $tipo) { ?>
														<span><?php echo esc_html($tipo); } ?></span>
												</li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-7 col-lg-7 section-md-t3">
								<div class="row">
									<div class="col-sm-12">
										<div class="title-box-d">
											<h3 class="title-d"><?php esc_html_e('Descripción de la propiedad', 'chipicasa'); ?></h3>
										</div>
									</div>
								</div>
								<div class="property-description">
									<p class="description color-text-a">
										<?php echo esc_html($campos['descripcion'] ?? ''); ?>
									</p>
								</div>
								<div class="row section-t3">
									<div class="col-sm-12">
										<div class="title-box-d">
											<h3 class="title-d"><?php esc_html_e('Características', 'chipicasa'); ?></h3>
										</div>
									</div>
								</div>
								<div class="amenities-list color-text-a">
									<ul class="list-a no-margin">
										<?php
										if (!empty($campos['planta'])) {
											echo '<li>' . esc_html__('Planta: ', 'chipicasa') . esc_html($campos['planta']) . '</li>';
										}
										if (!empty($campos['bloque'])) {
											echo '<li>' . esc_html__('Bloque: ', 'chipicasa') . esc_html($campos['bloque']) . '</li>';
										}
										if (!empty($campos['escalera'])) {
											echo '<li>' . esc_html__('Escalera: ', 'chipicasa') . esc_html($campos['escalera']) . '</li>';
										}
										if (!empty($campos['urbanizacion'])) {
											echo '<li>' . esc_html__('Urbanización: ', 'chipicasa') . esc_html($campos['urbanizacion']) . '</li>';
										}
										if (!empty($campos['interior_ext'])) {
											echo '<li>' . esc_html__('Ubicación: ', 'chipicasa') . esc_html($campos['interior_ext']) . '</li>';
										}
										echo (!empty($campos['ascensor'] && $campos['ascensor'] === 'si')) ? '<li>Tiene ascensor</li>' : '<li>No tiene ascensor</li>';
										if (!empty($campos['ac'])) {
											echo '<li>' . esc_html__('Aire Acondicionado: ', 'chipicasa');
											switch ($campos['ac']) {
												case 'no':
													echo esc_html__('No tiene', 'chipicasa');
													break;
												case 'frio':
													echo esc_html__('Frío', 'chipicasa');
													break;
												case 'frio_calor':
													echo esc_html__('Frío & Calor', 'chipicasa');
													break;
												case 'preinst':
													echo esc_html__('Preinstalado', 'chipicasa');
													break;
											}
											echo '</li>';
										}
										
										if (!empty($campos['tipologia_c'])) {
											echo '<li>' . esc_html__('Planta: ', 'chipicasa') . esc_html($campos['planta']) . '</li>';
										}
										if (!empty($campos['tipologia_chalet'])) {
											echo '<li>' . esc_html__('Tipo de Chalet: ', 'chipicasa');
											switch ($campos['tipologia_chalet']) {
												case 'atico':
													echo esc_html__('Ático', 'chipicasa');
													break;
												case 'estudio':
													echo esc_html__('Estudio', 'chipicasa');
													break;
												case 'duplex':
													echo esc_html__('Dúplex', 'chipicasa');
													break;
												default:
													echo $campos['tipologia_chalet'];
													break;
											}
											echo '</li>';
										}	
										if (!empty($campos['tipo_local'])) {
											echo '<li>' . esc_html__('Tipo de local: ', 'chipicasa');
											switch ($campos['tipo_local']) {
												case 'finca':
													echo esc_html__('Finca', 'chipicasa');
													break;
												case 'castillo':
													echo esc_html__('Castillo', 'chipicasa');
													break;
												case 'casa_rural':
													echo esc_html__('Casa Rural', 'chipicasa');
													break;
												case 'casa_pueblo':
													echo esc_html__('Casa de Pueblo', 'chipicasa');
													break;
												case 'cortijo':
													echo esc_html__('Cortijo', 'chipicasa');
													break;
												default:
													echo $campos['tipo_local'];
													break;
											}
											echo '</li>';
										}
										if (!empty($campos['tipo_rustica'])) {
											echo '<li>' . esc_html__('Tipo de casa rústica: ', 'chipicasa');
											switch ($campos['tipo_rustica']) {
												case 'finca':
													echo esc_html__('Finca', 'chipicasa');
													break;
												case 'castillo':
													echo esc_html__('Castillo', 'chipicasa');
													break;
												case 'casa_rural':
													echo esc_html__('Casa Rural', 'chipicasa');
													break;
												case 'casa_pueblo':
													echo esc_html__('Casa de Pueblo', 'chipicasa');
													break;
												case 'cortijo':
													echo esc_html__('Cortijo', 'chipicasa');
													break;
												default:
													echo $campos['tipo_rustica'];
													break;
											}
											echo '</li>';
										}
										if (!empty($campos['tipo_terreno'])) {
											echo '<li>' . esc_html__('Tipo de terreno: ', 'chipicasa');
											switch ($campos['tipo_terreno']) {
												case 'no_urbanizable':
													echo esc_html__('No urbanizable', 'chipicasa');
													break;
												case 'urbanizable':
													echo esc_html__('Urbanizable', 'chipicasa');
													break;
												case 'urbano':
													echo esc_html__('Urbano (solar)', 'chipicasa');
													break;
												default:
													echo $campos['tipo_terreno'];
													break;
											}
											echo '</li>';
										}
										if (!empty($campos['tipo_plaza'])) {
											echo '<li>' . esc_html__('Tipo de plaza: ', 'chipicasa');
											switch ($campos['tipo_plaza']) {
												case 'coche_peq':
													echo esc_html__('Coche pequeño', 'chipicasa');
													break;
												case 'coche_grande':
													echo esc_html__('Coche grande', 'chipicasa');
													break;
												case 'moto':
													echo esc_html__('Coche + Moto', 'chipicasa');
													break;
												case 'coche_moto':
													echo esc_html__('Coche + Moto', 'chipicasa');
													break;
												case 'mas_coches':
													echo esc_html__('2 coches o más', 'chipicasa');
													break;
												default:
													echo $campos['tipo_plaza'];
													break;
											}
											echo '</li>';
										}
										if (!empty($campos['m_plaza'])) {
											echo '<li>' . esc_html__('Superficie de la plaza: ', 'chipicasa') . esc_html($campos['m_plaza']) . '</li>';
										}
										if (!empty($campos['m_parcela'])) {
											echo '<li>' . esc_html__('Metros de parcela: ', 'chipicasa') . esc_html($campos['m_parcela']) . '</li>';
										}
										if (!empty($campos['m_fachada'])) {
											echo '<li>' . esc_html__('Metros de fachada: ', 'chipicasa') . esc_html($campos['m_fachada']) . '</li>';
										}
										if (!empty($campos['m_lineales'])) {
											echo '<li>' . esc_html__('Metros lineales: ', 'chipicasa') . esc_html($campos['m_lineales']) . '</li>';
										}
										if (!empty($campos['superf_terreno'])) {
											echo '<li>' . esc_html__('Superficie del terreno: ', 'chipicasa') . esc_html($campos['superf_terreno']) . '</li>';
										}
										if (!empty($campos['num_estancias'])) {
											echo '<li>' . esc_html__('Nº de estancias: ', 'chipicasa') . esc_html($campos['num_estancias']) . '</li>';
										}
										if (!empty($campos['num_plantas'])) {
											echo '<li>' . esc_html__('Nº de plantas: ', 'chipicasa') . esc_html($campos['num_plantas']) . '</li>';
										}
										if (!empty($campos['num_escap'])) {
											echo '<li>' . esc_html__('Nº de escaparates: ', 'chipicasa') . esc_html($campos['num_escap']) . '</li>';
										}
										if (!empty($campos['num_ascensores'])) {
											echo '<li>' . esc_html__('Nº de ascensores: ', 'chipicasa') . esc_html($campos['num_ascensores']) . '</li>';
										}
										if (!empty($campos['num_plazas'])) {
											echo '<li>' . esc_html__('Nº de plazas de garaje: ', 'chipicasa') . esc_html($campos['num_plazas']) . '</li>';
										}
										if (!empty($campos['acceso_rodado']) && $campos['acceso_rodado'] === 'si') {
											echo '<li>' . esc_html__('Acceso rodado: ', 'Chipicasa') . esc_html__('Sí', 'Chipicasa') . '</li>';
										} else {
											echo '<li>' . esc_html__('Acceso rodado: ', 'Chipicasa') . esc_html__('No disponible', 'chipicasa') . '</li>';
										}
										
										if (!empty($campos['si_rodado'])) {
											echo '<li>' . esc_html__('Tipo de acceso: ', 'chipicasa');
											switch ($campos['si_rodado']) {
												case 'no':
													echo esc_html__('Sin definir', 'chipicasa');
													break;
												case 'urbana':
													echo esc_html__('Vía urbana', 'chipicasa');
													break;
												case 'carretera':
													echo esc_html__('Por carretera', 'chipicasa');
													break;
												case 'tierra':
													echo esc_html__('Camino de tierra', 'chipicasa');
													break;
												case 'autovia':
													echo esc_html__('Por autovía', 'chipicasa');
													break;
												default:
													echo $campos['si_rodado'];
													break;
											}
											echo '</li>';
										}
									
										$mensaje = (!empty($campos['uso_excl'] && $campos['uso_excl'] === 'si')) 
										? esc_html__('Uso exclusivo: Sí', 'chipicasa') 
										: esc_html__('Uso exclusivo: No', 'chipicasa');
									
										echo '<li>' . $mensaje . '</li>';
												
										if (!empty($campos['ubicacion_local'])) {
											$ubicacion = '';
											switch ($campos['ubicacion_local']) {
												case 'pie_calle':
													$ubicacion = esc_html__('A pie de calle', 'chipicasa');
													break;
												case 'centro_com':
													$ubicacion = esc_html__('Centro comercial', 'chipicasa');
													break;
												case 'entreplanta':
													$ubicacion = esc_html__('Entreplanta', 'chipicasa');
													break;
												case 'subterraneo':
													$ubicacion = esc_html__('Subterráneo', 'chipicasa');
													break;
												default:
													$ubicacion = $campos['ubicacion_local'];
													break;
											}
											echo '<li>' . esc_html__('Ubicación del local: ', 'chipicasa') . $ubicacion . '</li>';
										}
										
										if (!empty($campos['distribucion_oficina'])) {
											$distribucion = '';
											switch ($campos['distribucion_oficina']) {
												case 'diafana':
													$distribucion = esc_html__('Diáfana', 'chipicasa');
													break;
												case 'mamparas':
													$distribucion = esc_html__('Dividida con mamparas', 'chipicasa');
													break;
												case 'tabiques':
													$distribucion = esc_html__('Dividida con tabiques', 'chipicasa');
													break;
												default:
													$distribucion = $campos['distribucion_oficina'];
													break;
											}
											echo '<li>' . esc_html__('Distribución de la oficina: ', 'chipicasa') . $distribucion . '</li>';
										}
										
										if (!empty($campos['aire_acond'])) {
											$aire_acondicionado = '';
											switch ($campos['aire_acond']) {
												case 'no_disponible':
													$aire_acondicionado = esc_html__('No disponible', 'chipicasa');
													break;
												case 'frio':
													$aire_acondicionado = esc_html__('Frío', 'chipicasa');
													break;
												case 'frio_calor':
													$aire_acondicionado = esc_html__('Frío/calor', 'chipicasa');
													break;
												case 'preinstalado':
													$aire_acondicionado = esc_html__('Preinstalación', 'chipicasa');
													break;
												default:
													$aire_acondicionado = $campos['aire_acond'];
													break;
											}
											echo '<li>' . esc_html__('Aire acondicionado: ', 'chipicasa') . $aire_acondicionado . '</li>';
										}
										
										if (!empty($campos['calefaccion'])) {
											$tipo_calefaccion = '';
											switch ($campos['calefaccion']) {
												case 'individual':
													$tipo_calefaccion = esc_html__('Individual', 'chipicasa');
													break;
												case 'centralizada':
													$tipo_calefaccion = esc_html__('Centralizada', 'chipicasa');
													break;
												case 'no_dispone':
													$tipo_calefaccion = esc_html__('No dispone', 'chipicasa');
													break;
												default:
													$tipo_calefaccion = $campos['calefaccion'];
													break;
											}
											echo '<li>' . esc_html__('Tipo de calefacción: ', 'chipicasa') . $tipo_calefaccion . '</li>';
										}
										
										if (!empty( $campos['otra_caract_inm'] )){
											foreach ($campos['otra_caract_inm'] as $caracteristica) {
												echo '<li>' . esc_html($caracteristica) . '</li>';
											}
											if (!empty($campos['gastos_comunidad'])) {
												echo '<li>' . esc_html__('Gastos de comunidad: ', 'chipicasa');
												echo '<li>' . esc_html($campos['gastos_comunidad']) . '</li>';
												echo '</li>';
											}
											if (!empty($campos['fianza'])) {
												echo '<li>' . esc_html__('Fianza: ', 'chipicasa');
												echo '<li>' . esc_html($campos['fianza']) . '</li>';
												echo '</li>';
											}
											if (!empty($campos['ano_edificio'])) {
												echo '<li>' . esc_html__('Año del edificio: ', 'chipicasa') . esc_html($campos['ano_edificio']) . '</li>';
											}
											foreach ($campos['caract_inm'] as $caracteristica) {
												echo (!empty($caracteristica)) ? '<li>' . esc_html($caracteristica) . '</li>' : '';
											}
										}

										$estado_conservation_text = empty($campos['estado_cons'] || $campos['estado_cons'] !== 'buen_estado') 
										? esc_html__('A reformar', 'chipicasa') 
										: esc_html__('En buen estado', 'chipicasa');
									
										echo '<li>' . esc_html__('Estado de Conservación: ', 'chipicasa') . $estado_conservation_text . '</li>';
										?> 
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-10 offset-md-1">
						<ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-plans-tab" data-toggle="pill" href="#pills-plans" role="tab" aria-controls="pills-plans"
									aria-selected="true"><?php esc_html_e('Floor Plans', 'chipicasa'); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map"
									aria-selected="false"><?php esc_html_e('Ubication', 'chipicasa'); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="false"><?php esc_html_e('Video', 'chipicasa'); ?></a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
								<?php
								// Obtener la URL del vídeo del campo personalizado
								$video_url = get_post_meta(get_the_ID(), 'video_embed', true);
								// Verificar si hay una URL de vídeo disponible
								if (!empty($video_url)) :
									?>								
									<video controls style="width: 100%;">
										<source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
										<?php esc_html_e('Tu navegador no soporta la reproducción de vídeos.', 'chipicasa'); ?>
									</video>
								<?php endif; ?>
							</div>
							<div class="tab-pane fade show active" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
								<?php 
								$planos = array(
									get_post_meta(get_the_ID(), 'plano1', true),
									get_post_meta(get_the_ID(), 'plano2', true),
									get_post_meta(get_the_ID(), 'plano3', true),
									get_post_meta(get_the_ID(), 'plano4', true)
								); 
								if (!empty($planos)) : ?>
									<?php
									// Filtrar el array para eliminar valores vacíos o nulos
									$planos = array_filter($planos);
								
									foreach ($planos as $plano) : ?>
										<img src="<?php echo esc_url($plano); ?>" alt="<?php esc_html_e('Plano del inmueble', 'chipicasa'); ?>" style="width: 100%;">
									<?php endforeach; ?>
								<?php endif; ?> 
							</div>
							<div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
								<div id="map" style="height: 400px; width: 100%; margin-bottom: 5%;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php endwhile; ?>
<?php else: ?>
	<?php get_template_part( 'template-parts/no-content' ); ?>
<?php endif; ?>

<?php get_footer(); ?>