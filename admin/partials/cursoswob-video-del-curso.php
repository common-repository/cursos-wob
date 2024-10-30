<?php
if(key_exists('cursoswob_mp4_publico', $values)){
    $video = esc_attr($values["cursoswob_mp4_publico"][0]); 
}else{
    $video = '';
}
if(key_exists('cursoswob_vimeo_publico', $values)){
    $video_vimeo = esc_attr($values["cursoswob_vimeo_publico"][0]); 
}else{
    $video_vimeo = '';
}
if(key_exists('cursoswob_youtube_publico', $values)){
    $video_youtube = esc_attr($values["cursoswob_youtube_publico"][0]); 
}else{
    $video_youtube = '';
}
?> 

<div class="cursoswob_video_form">
    <label><b><?=_e('Video mp4', 'cursoswob')?></b></label>
    <input type="text" value="<?=$video?>" class="large-text" id="video_mp4_publico" name="cursoswob_mp4_publico">
    <button id="cursoswob-insertar-video" class="set_video button"><?=_e('Añadir mp4', 'cursoswob')?></button>
</div>
<div class="cursoswob_video_form">
    <label><b><?=_e('URL Video Vimeo', 'cursoswob')?></b></label>
    <input type="text" name="cursoswob_vimeo_publico" id="video_vimeo_publico" class="large-text" value="<?=$video_vimeo?>" placeholder="URL del video de Vimeo" />
</div>
<div class="cursoswob_video_form">
    <label><b><?=_e('URL Video Youtube', 'cursoswob')?></b></label>
    <input type="text" name="cursoswob_youtube_publico" id="video_youtube_publico" class="large-text" value="<?=$video_youtube?>" placeholder="URL del video de Youtube" />
</div>