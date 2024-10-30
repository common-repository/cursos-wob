<div class="wrap">
    <h1 class="cursoswob_titulo_bienvenidos"><img src="<?=plugins_url()?>/cursoswob/admin/img/cursoswob.png" style="vertical-align: middle;"><?php esc_attr_e( 'Bienvenido a Cursos Wob', 'cursoswob' ); ?></h1>
        
    <h2>¿Que és Cursos Wob?</h2>
            <p>Cursos Wob es un plugin creado para publicar tus cursos online de manera sencilla y poder venderlos facilmente desde Woocommerce</p>
    
    
    
    <h2 class="nav-tab-wrapper">
            <a href="edit.php?post_type=cursos&page=cursoswob-configuracion-woocommerce" class="nav-tab">Paso 1 -  Instalación de Woocommerce</a>
            <a href="edit.php?post_type=cursos&page=cursoswob-configuracion-cursoswob" class="nav-tab">Paso 2 -  Configuración de Cursos Wob</a>
            <a href="edit.php?post_type=cursos&page=cursoswob-crear-un-curso" class="nav-tab">Crear un curso</a>
            <a href="edit.php?post_type=cursos&page=cursoswob-vincular-los-cursos-con-la-tienda" class="nav-tab nav-tab-active">Vincular los cursos con la tienda</a>
    </h2>
    
    <div class="cursoswob-ayuda">
            <h2>¿Cómo vincular los cursos con nuestra tienda?</h2>
            <div id="post-body" class="metabox-holder">
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">
                            <h2 class="hndle"><span>Vinculando los cursos con nuestra tienda</span></h2>

                            <div class="inside">
                                <p>
                                    Para vincular nuestro curso con la tienda de Woocommerce iremos al <a href="edit.php?post_type=cursos&page=cursoswob-opciones-woocommerce">apartado de configuración de cursos Wob</a><br>
                                    Y veremos el apartado de <b>"Creación de los productos en Woocommerce"</b>.<br>
                                    En este apartado veremos que se listan todos los cursos que hemos creado.<br>
                                    Para vincular y crear el producto del curso en la tienda de Woocommerce simplemente pondremos el precio del curso y haremos click en Crear Producto.<br>
                                    Si todo ha funcionado correctamente veremos que nos muestra un boton de <b>"Modificar Producto en WooCommerce"</b> si hacemos click iremos ha modificar la información que se mostrará en nuestra tienda de WooCommerce.<br>
                                    Al crear el producto automáticamente se le añadirá el titulo del curso como titulo de producto, la descripción del producto que hemos puesto en la descripción del curso i la imagen destacada se le asignara como imagen de producto.
                                    <img style=" margin-top: 8px; margin-bottom: 8px; display: block" src="<?=plugins_url()?>/cursoswob/admin/img/vincular-01.jpg">
                                    Una vez tenemos el producto como nosotros queremos ya esta listo para venderse.
                                </p>
                                <p>
                                    Cuando un usuario compra un curso automáticamente se le dará acceso al mismo después de realizar el pago.<br>
                                    Podrá acceder a el mediante el menú <b>"Mis cursos"</b> dentro del menú <b>"Mi Cuenta"</b> propio de Woocommerce.
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
</div>