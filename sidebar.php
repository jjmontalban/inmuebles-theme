<?php if ( ! is_page() ) : ?>
		<div class="sidebar columns large-3 small-12">
			<aside class="sidebar">
				<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
				<?php if ( is_singular('inmueble') ) : ?>
					<h4>Solicita Información sobre este inmueble</h4>
					<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="formulario-contacto">
						<input type="hidden" name="action" value="procesar_formulario_contacto">
						<input type="hidden" name="inmueble_id" value="<?php echo get_the_ID(); ?>">
						Nombre: <input type="text" name="nombre" required><br>
						Email (opcional): <input type="email" name="email"><br>
						Teléfono (obligatorio): <input type="tel" name="telefono" required><br>
						Mensaje (opcional): <textarea name="mensaje"></textarea><br>
						<input type="submit" value="Enviar">
					</form>
					<div id="respuesta-formulario"></div>

					
					<script>
					jQuery(document).ready(function($) {
						$('#formulario-contacto').submit(function(e) {
							e.preventDefault();

							$.ajax({
								type: 'POST',
								url: $(this).attr('action'),
								data: $(this).serialize(),
								success: function() {
									$('#respuesta-formulario').html('<p style="color: green;">¡Consulta enviada con éxito!</p>');
									$('#formulario-contacto')[0].reset(); // Limpia los campos del formulario
								},
								error: function() {
									$('#respuesta-formulario').html('<p style="color: red;">Ha ocurrido un error al enviar la consulta.</p>');
								}
							});
						});
					});  
					</script>
				<?php endif; ?>

			</aside>
		</div>
	<?php endif; ?>  