<?php
if(empty($value)){
    return;
}
?>
<tr>
    <td><?php echo ($value->title)?? ''; ?></td>
    <td><?php echo ($value->content)?? ''; ?></td>
    <td><?php echo ($value->seo_title_value)?? ''; ?></td>
    <td><?php echo ($value->seo_metadesc_value)?? ''; ?></td>
</tr>