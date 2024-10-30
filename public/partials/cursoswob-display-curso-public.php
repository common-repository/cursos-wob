<?php 
    /*
     * VIDEO SUBIDO EN MP4
     */
    $videomp4 = get_post_meta(get_the_ID(), 'cursoswob_mp4_publico', true );
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
    $videovimeo = get_post_meta(get_the_ID(), 'cursoswob_vimeo_publico', true );
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
    $videoyoutube = get_post_meta(get_the_ID(), 'cursoswob_youtube_publico', true );
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

$detecta_usuario = new CursosWob_Woocommerce();
$encontrado = $detecta_usuario->detectar_si_el_usuario_tiene_acceso_al_curso(get_the_ID());

?>
<?php if($encontrado != 1){ ?>
    <?php $url_tienda = get_post_meta(get_the_ID(), 'cursoswob_url_producto', true); ?>
    <?php if($url_tienda){ ?>
    <div class="cursoswob-div-comprar"><a href="<?=$url_tienda?>" class="cursoswob-comprar-curso">Comprar Curso</a></div>
    <?php } ?>
<?php } ?>
    
    <br>
<?=$content?>


<?php 

    if($encontrado == 1){ 
        
        $user = wp_get_current_user();
        $id_usuario = $user->data->ID;
        
        ?>

    <div class="listado-de-clases">
        <h2 class="wob-title-clases"><?=_e('Clases del Curso', 'cursoswob')?></h2>
        <table class="">
            <tbody>
                <?php foreach ($query->posts as $clase): ?>
                <?php 
                $usuarios_que_han_visto_la_clase = get_post_meta($clase->ID, 'cursoswob_usuarios_que_han_visto_la_clase', true );
                $visto = 0;
                foreach ($usuarios_que_han_visto_la_clase as $user => $id_usuario_visto):
                    if($id_usuario_visto == $id_usuario){
                        $visto = 1;
                    }
                endforeach;                
                ?>
                <tr>
                    <td style=" text-align: center"><i class="fa fa-play"></i></td>
                    <td><?=$clase->post_title?></td>
                    <td style=" text-align: right">
                        <?php 
                        if($visto == 1){ 
                            $estilo =  "cursoswob-link-clases-activo";
                        }else{
                            $estilo =  "cursoswob-link-clases";
                        }
                        ?>
                        <a href="<?=$clase->guid?>" class="<?=$estilo?>"><?=_e('Ver clase', 'cursoswob')?></a>
                    </td>
                    <td>
                        <?php if($visto == 1){ ?>
                        <i class="fa fa-check" style="font-size: 16px; color: #6bbb1a"></i>
                        <?php }else{ ?>
                        <i class="fa fa-angle-double-right" style="font-size: 16px"></i>
                        <?php } ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>    
        </table>
    </div>

    <?php }else{ ?>

    <div class="listado-de-clases">
        <h2 class="wob-title-clases"><?=_e('Clases del Curso', 'cursoswob')?></h2>
        <table class="">
            <tbody>
                <?php foreach ($query->posts as $clase): ?>
                <tr>
                    <td></td>
                    <td><?=$clase->post_title?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>    
        </table>
    </div>

<?php } ?>
