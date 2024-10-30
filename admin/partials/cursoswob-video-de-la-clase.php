<?php 

echo '<input type="hidden" name="cursoswob_id_curso" value="'.$_GET['id_curso'].'">';

if(key_exists('cursoswob_video_de_la_clase', $values)){
    $video = esc_attr($values["cursoswob_video_de_la_clase"][0]); 
}else{
    $video = '';
}
if(key_exists('cursoswob_video_de_la_clase_vimeo', $values)){
    $video_vimeo = esc_attr($values["cursoswob_video_de_la_clase_vimeo"][0]); 
}else{
    $video_vimeo = '';
}
if(key_exists('cursoswob_video_de_la_clase_youtube', $values)){
    $video_youtube = esc_attr($values["cursoswob_video_de_la_clase_youtube"][0]); 
}else{
    $video_youtube = '';
}
?>

<div class="cursoswob_video_form">
    <label><b><?=_e('Video mp4', 'cursoswob')?></b></label>
    <input type="text" value="<?=$video?>" class="large-text" id="video_de_la_clase" name="cursoswob_video_de_la_clase">
    <button id="cursoswob-insertar-video" class="set_video button"><?=_e('Añadir mp4', 'cursoswob')?></button>
</div>
<div class="cursoswob_video_form">
    <label><b><?=_e('URL Video Vimeo', 'cursoswob')?></b></label>
    <input type="text" name="cursoswob_video_de_la_clase_vimeo" id="video_de_la_clase_vimeo" class="large-text" value="<?=$video_vimeo?>" placeholder="URL del video de Vimeo" />
</div>
<div class="cursoswob_video_form">
    <label><b><?=_e('URL Video Youtube', 'cursoswob')?></b></label>
    <input type="text" name="cursoswob_video_de_la_clase_youtube" id="video_de_la_clase_youtube" class="large-text" value="<?=$video_youtube?>" placeholder="URL del video de Youtube" />
</div>