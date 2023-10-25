<?php if ( ! is_page() ) : ?>
		<div class="sidebar columns large-3 small-12">
			<aside class="sidebar">
				<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
				<h4>Solicita Información</h4>
				<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
					<input type="hidden" name="action" value="procesar_formulario_contacto">
					Nombre: <input type="text" name="nombre" required><br>
					Email o Teléfono: <input type="text" name="email_telefono" required><br>
					Mensaje (opcional): <textarea name="mensaje"></textarea><br>
					<input type="submit" value="Enviar">
				</form>

			</aside>
		</div>
	<?php endif; ?>