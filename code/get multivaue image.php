<?php global $y; $y++; $thumb_url = null;
if(!empty($value['thumb'][$y])){ $thumb_url =  file_create_url($value['thumb'][$y]);}
if(!empty($value['large'][$y])) {
    $large_url = file_create_url($value['large'][$y]); 
}
else{
    $large_url = $thumb_url;
}

?>
<a class="gallary" title="" href="<?php echo $large_url ?>"><img src="<?php echo $thumb_url ?>"/></a>
 
 
 
<?php
 
$node = node_load($row->nid);
$images = array();
$field_large = $node->field_apps['und'];
$field_thumb = $node->field_thumb_aplication['und'];
$i = 1;
foreach($field_large as $k => $image){
 if(!empty($image['uri'])) $images['large'][$i] = $image['uri'];
 if(!empty($field_thumb[$k]['uri'])) $images['thumb'][$i] = $field_thumb[$k]['uri'];
  
$i ++;
} 
return $images;