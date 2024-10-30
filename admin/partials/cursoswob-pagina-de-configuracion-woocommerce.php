<div class="wrap">
    <h1 class="cursoswob_titulo_bienvenidos"><img src="<?=plugins_url()?>/cursoswob/admin/img/cursoswob.png" style="vertical-align: middle;"><?php esc_attr_e( 'Bienvenido a Cursos Wob', 'cursoswob' ); ?></h1>
        
    <h2>¿Que és Cursos Wob?</h2>
            <p>Cursos Wob es un plugin creado para publicar tus cursos online de manera sencilla y poder venderlos facilmente desde Woocommerce</p>
    
    
    
    <h2 class="nav-tab-wrapper">
            <a href="edit.php?post_type=cursos&page=cursoswob-configuracion-woocommerce" class="nav-tab nav-tab-active">Paso 1 -  Instalación de Woocommerce</a>
            <a href="edit.php?post_type=cursos&page=cursoswob-configuracion-cursoswob" class="nav-tab">Paso 2 -  Configuración de Cursos Wob</a>
            <a href="edit.php?post_type=cursos&page=cursoswob-crear-un-curso" class="nav-tab">Crear un curso</a>
            <a href="edit.php?post_type=cursos&page=cursoswob-vincular-los-cursos-con-la-tienda" class="nav-tab">Vincular los cursos con la tienda</a>
    </h2>
    
    <div class="cursoswob-ayuda">
            <h2>Configuración de Woocommerce</h2>
            <div id="configuracion_woocommerce" class="metabox-holder">
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">
                            <h2 class="hndle"><span>Paso 1 -  Instalación de Woocommerce</span></h2>

                            <div class="inside">
                                <p>Para poder vender tus cursos <b>debes tener instalado el plugin <a href="https://woocommerce.com/" target="_blank">Woocommerce</a></b> para crear tu tienda online</p>
                                <p>Una vez instalado deberías <b>limitar Woocommerce para que no se puedan como invitado</b>.<br>
                                Para ello iremos a <a href="admin.php?page=wc-settings&tab=checkout">Woocommerce/Ajustes/Finalizar compra</a> y desmarcaremos la opción "Permitir finalizar compra como invitado"
                                <img style=" margin-top: 8px; margin-bottom: 8px; display: block" src="<?=plugins_url()?>/cursoswob/admin/img/paso-1-01.jpg">
                                En esta misma sección Finalizar compra deberemos configurar solamente Formas de pago inmediatas como Paypal y mediante TPV Virtual para asegurarnos el pago inmediato del mismo, ya que al finalizar el pago se le dará acceso al curso de manera automática al usuario.<br>
                                Otras opciones de pago como pago con Transferencia bancaria no son válidas para el plugin ya que se le daría acceso al curso antes de realizar el pago.
                                </p>
                                
                                <h2>Activación de la API REST de Woocommerce y creación de las claves</h2>
                                <p>
                                    Vamos a la página de configuración de la <a href="admin.php?page=wc-settings&tab=api">API de Woocommerce</a> y activamos la API REST
                                    <img style=" margin-top: 8px; margin-bottom: 8px; display: block" src="<?=plugins_url()?>/cursoswob/admin/img/paso-1-02.jpg">
                                </p>
                                <p>
                                    Seguidamente procederemos a crear las claves para el acceso a la API.<br>
                                    Para ello vamos a la pestaña <a href="admin.php?page=wc-settings&tab=api&section=keys">Claves/Aplicaciones</a>
                                    Y añadimos una nueva Clave 
                                    <img style=" margin-top: 8px; margin-bottom: 8px; display: block" src="<?=plugins_url()?>/cursoswob/admin/img/paso-1-03.jpg">
                                    Rellenamos el formulario seleccionando el usuario Administrador y dando permisos de Lectura/Escritura.
                                    <img style=" margin-top: 8px; margin-bottom: 8px; display: block" src="<?=plugins_url()?>/cursoswob/admin/img/paso-1-04.jpg">
                                    Una vez generada deberemos apuntarnos las 2 claves, Clave del cliente y Clave secreta de cliente, ya que después no podremos volver a visualizarlas y las necesitamos para configurar Cursos Wob.
                                    <img style=" margin-top: 8px; margin-bottom: 8px; display: block" src="<?=plugins_url()?>/cursoswob/admin/img/paso-1-05.jpg">
                                    
                                    <a href="edit.php?post_type=cursos&page=cursoswob-configuracion-cursoswob">Paso 2 - Configuración de Cursos Wob</a>
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
</div>