/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(function($) {
    $(document).ready(function(){
            var $ = jQuery;
            if ($('.set_video').length > 0) {
                if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
                    $(document).on('click', '.set_video', function(e) {
                        e.preventDefault();
                        var button = $(this);
                        var id = button.prev();
                        wp.media.editor.send.attachment = function(props, attachment) {
                            id.val(attachment.url);
                        };
                        wp.media.editor.open(button);
                        return false;
                    });
                }
            }
            
            $(".page-title-action").click(function(e) {
                e.preventDefault();
                var tipo_boton = this.text;
                var url = this.href;
                if(tipo_boton == 'Añadir nueva'){
                    var id_curso = $('#cursoswob_id_curso').val();
                    var url_nueva = url+"&id_curso="+id_curso;
                    location.href = url_nueva;
                }else{
                    location.href = url;
                }
            });
 
        });
        
        

});

