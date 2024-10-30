<?php 
$key_client = $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client'];
$key_client_secret = $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client_secret'];
?>

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'Cursos Wob Opciones', 'cursoswob' ); ?></h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
                                <!--
                                Formulario para guardar las claves de la API de Woocommerce                                
                                -->
				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<h2 class="hndle"><span><?php esc_attr_e( 'Opciones de configuración', 'cursoswob' ); ?></span>
						</h2>

						<div class="inside">
                                                    <form name="cursoswob_woocommerce" action="" method="post">
                                                        <h3><?=_e('Configuración de la API de Woocommerce', 'cursoswob')?></h3>
                                                        <input type="hidden" value="Y" name="cursoswob_form_submitted"> 
                                                        <label><b><?=_e('Clave cliente', 'cursoswob')?></b></label>
                                                        <input type="text" name="client_key" class="large-text" value="<?=$key_client?>">
                                                        <label><b><?=_e('Clave secreta cliente', 'cursoswob')?></b></label>
                                                        <input type="text" name="client_secret_key" class="large-text" value="<?=$key_client_secret?>">
                                                        <br>
                                                        <input style=" margin-top: 20px;" type="submit" name="boton_submit" class="button-primary" value="<?=_e('Guardar Configuración', 'cursoswob')?>">
                                                    </form>
						</div>
					</div>
				</div>
                                <!--
                                Fin del formulario
                                -->
                                
                                <!--
                                Si estan guardadas las claves veremos las opciones de la extensión
                                -->
                                <div class="meta-box-sortables ui-sortable">

					<div class="postbox">
						<h2 class="hndle"><span><?php esc_attr_e( 'Creación de los porductos en Woocommerce', 'cursoswob' ); ?></span>
						</h2>

						<div class="inside">
                                                    <?php
                                                    if ( $query->have_posts() ) {
                                                        
                                                        $posts = $query->posts;
                                                        ?>
                                                        <table class="widefat">
                                                            <thead>
                                                                <tr>
                                                                    <th class="row-title">Curso</th>
                                                                    <th>Precio</th>
                                                                    <th></th>
                                                                   </tr>
                                                            </thead>
                                                            <tbody>
                                                        <?php 
                                                            
                                                            $post = $posts[0];
                                                            
                                                            $post_meta = get_post_meta( $post->ID );
                                                            $id_producto = $post_meta['cursoswob_id_producto'][0];
                                                            if($id_producto == ''){ ?>
                                                            <form name="cursoswob_woocommerce" action="" method="post">
                                                                <tr>
                                                                    <td>
                                                                        <input type="hidden" value="<?=$post->ID?>" name="cursoswob_id_curso"> 
                                                                        <label><b><?= $post->post_title ?></b></label>
                                                                    </td>
                                                                    <td>
                                                                    <input type="number" required="" placeholder="<?= _e('Precio', 'cursoswob') ?>" min="1" step="any" type="text" name="cursoswob_precio" value="">
                                                                    </td>
                                                                    <td>
                                                                        <input  type="submit" name="boton_submit" class="button-primary" value="<?= _e('Crear Producto', 'cursoswob') ?>">
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                            <?php }else{ ?>
                                                            
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" value="<?=$post->ID?>" name="cusoswob_id_curso"> 
                                                                    <label><b><?= $post->post_title ?></b></label>
                                                                </td>
                                                                <td>
                                                                
                                                                </td>
                                                                <td>
                                                                    <a href="post.php?post=<?=$id_producto?>&action=edit" class="button-primary"><?= _e('Modificar Producto en WooCommerce', 'cursoswob') ?></a>
                                                                </td>
                                                            </tr>
                                                            
                                                            <?php } ?>
                                                        
                                                        </table>
                                                        
                                                    <h2><?=_e('Solo tienes la opción de vender 1 curso con la version gratuita. Para vender más cursos deberás adquirir la versión Permium.', 'cursoswob')?></h2>
                                                        <a href="https://wpwob3.com" target="_blank" class="button-primary">CursosWob Premium</a>
                                                        <?php wp_reset_postdata(); ?>
                                                        <?php }else{ ?>
                                                        <div class="notice notice-error"><p><?= _e('No hay Cursos activos', 'cursoswob') ?></p></div>
                                                        
                                                            <?php } ?>
                                                    
						</div>
					</div>
				</div>
                                <!--
                                Fin de las opciones de la extensión
                                -->
			</div>

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox">
						<h2 class="hndle"><span><?php esc_attr_e('Ayuda', 'cursoswob'); ?></span></h2>

						<div class="inside">
							<p><?= _e('Instala el plugin Woocommerce y crea una clave API para poder utilizar esta extensión', 'cursoswob'); ?></p>
                                                        <a href="https://wpwob3.com" target="_blank" class="button-primary">CursosWob Premium</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>
</div>