<?php 
if(is_user_logged_in()){
    $user = wp_get_current_user();

    $id_clase = get_the_ID();
    $id_curso = get_post_meta($id_clase, 'cursoswob_id_curso', true );
    
    $detecta_usuario = new CursosWob_Woocommerce();
    $encontrado = $detecta_usuario->detectar_si_el_usuario_tiene_acceso_al_curso($id_curso);
    
    if($encontrado == 1){
    
    
    
    $post_curso = get_post($id_curso);
    $titulo_del_curso = $post_curso->post_title;
    
    ?>
    <div class="cursoswob-videos-i-clases-del-curso">
    <?php 
    /*
     * VIDEO SUBIDO EN MP4
     */
    $videomp4 = get_post_meta($id_clase, 'cursoswob_video_de_la_clase', true );
    ?>
    <?php if($videomp4 != ''){ ?>
    <video id="my-video" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls preload="auto" width="640" height="264"
      poster="MY_VIDEO_POSTER.jpg" data-setup='{"fluid": true}'>
        <source src="<?=$videomp4?>" type='video/mp4'>
        <p class="vjs-no-js">
          To view this video please enable JavaScript, and consider upgrading to a web browser that
          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>
    </video>
    <?php } ?>

    <?php 
    /*
     * VIDEO DE VIMEO
     */
    $videovimeo = get_post_meta($id_clase, 'cursoswob_video_de_la_clase_vimeo', true );
    ?>
    <?php if($videovimeo != ''){ ?>
    <?php $video_array = explode("/", $videovimeo); ?>
    <div class="container-vimeo">
        <iframe class="video-vimeo" src="https://player.vimeo.com/video/<?=$video_array[3]?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>
    <style>
        .container-vimeo {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }
        .video-vimeo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <?php } ?>

    <?php 
    /*
     * VIDEO DE YOUTUBE
     */
    $videoyoutube = get_post_meta($id_clase, 'cursoswob_video_de_la_clase_youtube', true );
    ?>
    <?php if($videoyoutube != ''){ ?>
    <?php $video_array = explode("/", $videoyoutube); ?>
    <div class="container-youtube">
    <iframe width="560" height="315" class="video-youtube" src="https://www.youtube.com/embed/<?=$video_array[3]?>?rel=0&showinfo=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
    </div>
    <style>
        .container-youtube {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }
        .video-youtube {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <?php } ?>

    <?php 
    $args = array (
        'orderby'       => 'ID',
        'order'         => 'ASC',
        'post_type'     => 'clases',
        'meta_key'      => 'cursoswob_id_curso',
        'meta_value'    => $id_curso,
        'meta_compare'  => '=='
    );
    $clases = new WP_Query( $args );

    

        ?>

        <div class="cursoswob-grupo-listado-de-clases">
            <div class="cursoswob-listado-clases">
            <?php foreach ($clases->posts as $clase): 
                if($clase->ID == $id_clase){
                    $estilo = 'cursoswob-link-clases-activo';
                }else{
                    $estilo = 'cursoswob-link-clases';
                }
                ?>
                <a href="<?=$clase->guid?>" class="<?=$estilo?>"><?=$clase->post_title?></a>
            <?php endforeach; ?>
                
            </div>
        </div>
    </div>
    
    <div class="cursoswob-opciones-de-la-clase">
        <a href="<?=$post_curso->guid?>" class="cursoswob-boton-volver-al-curso"><?=_e('Volver al curso', 'cursoswob')?>: <?=$titulo_del_curso?></a>
        <?php $archivo = get_post_meta($id_clase, 'cursoswob_archivo_de_la_clase', true ); ?>
        <?php if($archivo != ''){ ?>
        <a class="cursoswob-link-archivo" target="_blank" href="<?=$archivo?>"><?=_e('Descargar PDF', 'cursoswob')?></a>
        <?php } ?>
    </div>

    <div class="cursoswob-contenido-de-la-clase">
        <?=$content?>
    </div>
    
    <?php } ?>

<?php } ?>

