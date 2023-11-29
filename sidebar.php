<?php if ( ! is_page() ) : ?>

		<div class="columns large-3 small-12">

			<aside class="sidebar">

				<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
				<h5>Solicita más Información</h5>
				<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="formulario-contacto">
					<input type="hidden" name="action" value="procesar_formulario_contacto">
					<?php if ( is_singular('inmueble') ): ?>
						<input type="hidden" name="inmueble_id" value="<?php echo get_the_ID(); ?>">
					<?php elseif ( is_post_type_archive('inmueble') ): ?>
						<input type="hidden" name="inmueble_id" value="archive">
					<?php endif; ?>
					Nombre: <input type="text" name="nombre" required><br>
					Email (opcional): <input type="email" name="email"><br>
					Teléfono (obligatorio): <input type="tel" name="telefono" required><br>
					Mensaje (opcional): <textarea name="mensaje"></textarea><br>
					<input type="submit" value="Enviar">
				</form>

				<div id="respuesta-formulario"></div>
			</aside>

		</div>
		
	<?php endif; ?>  