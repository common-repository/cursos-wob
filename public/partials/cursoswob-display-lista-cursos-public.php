<?php $cursoswob_listado = $lista_de_cursos->posts ?>
   
<?php if(count($cursoswob_listado) > 0){ ?>

<div class="listado-de-cursos">
    <?php foreach ($cursoswob_listado as $curso): 
        //unset($curso->post_content);
        $thumbID = get_post_thumbnail_id( $curso->ID );
        $imgDestacada = wp_get_attachment_image_src( $thumbID, 'thumbnail' ); // Sustituir por thumbnail, medium, large o full
            
        ?>
    <div class="cursoswob-curso">
        <a href="<?=get_permalink( $curso->ID )?>"><img src="<?=$imgDestacada[0]?>" class="imagen-del-curso">
        <h2 class="titulo_del_curso"><?=$curso->post_title?></h2></a>
        <!--<p><?php
        if($curso->post_excerpt){
            echo $curso->post_excerpt;
        }else{
            echo $curso->post_content;
        }
        
        //$curso->post_excerpt?></p>-->
    </div>
    
    <?php endforeach; ?>
    
</div>
<?php }else{ ?>
<div class="listado-de-cursos">
    <h2>><?=_e('No hay cursos disponibles', 'cursoswob')?></h2>
</div>

<?php } ?>

