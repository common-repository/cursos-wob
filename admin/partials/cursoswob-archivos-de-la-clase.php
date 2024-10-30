<?php 

if(key_exists('cursoswob_archivo_de_la_clase', $values)){
    $pdf = esc_attr($values["cursoswob_archivo_de_la_clase"][0]); 
}else{
    $pdf = '';
}
?>

<div class="cursoswob_video_form">
    <label><b><?=_e('Archivo PDF', 'cursoswob')?></b></label>
    <input type="text" value="<?=$pdf?>" class="large-text" id="archivo_de_la_clase" name="cursoswob_archivo_de_la_clase">
    <button id="cursoswob-insertar-video" class="set_video button"><?=_e('Añadir PDF', 'cursoswob')?></button>
</div>

<p><a href="post.php?post=<?=$values['cursoswob_id_curso'][0]?>&action=edit" class="button-primary" /><?php esc_attr_e( 'Volver al Curso', 'cursoswob' ); ?></a></p>
