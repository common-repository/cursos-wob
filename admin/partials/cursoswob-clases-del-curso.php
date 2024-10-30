<p><a href="post-new.php?post_type=clases&id_curso=<?=$post->ID?>" class="button-primary" /><?php esc_attr_e( 'Añadir nueva Clase', 'cursoswob' ); ?></a></p>
<?php if(count($query->posts) > 0){ ?>
<table class="widefat" id="taula2">
	<thead>
            <tr>
                <th class="row-title">ID</th>
                <th><?=_e('Clase', 'cursoswob')?></th>
                <th></th>
            </tr>
	</thead>
	<tbody>
            <?php foreach ($query->posts as $clase): ?>
            <tr valign="top">
                <td><?=$clase->ID?><input type="hidden" value="<?=$clase->ID?>" name="id_clase"></td>
                <td><?=$clase->post_title?></td>
                <td><a href="post.php?post=<?=$clase->ID?>&action=edit&id_curso=<?=$post->ID?>" class="button-primary" /><?php esc_attr_e( 'Modificar Clase', 'cursoswob'); ?></a></td>
            </tr>
            <?php endforeach; ?>
	</tbody>
	<tfoot>
            <tr>
                <th class="row-title">ID</th>
                <th><?=_e('Clase', 'cursoswob')?></th>
                <th></th>
            </tr>
	</tfoot>
</table>
<?php } ?>