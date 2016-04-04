<?php
global $apps;
$node = node_load($row->nid);
$images = array();
$field_large = $node->field_apps['und'];
$field_thumb = $node->field_thumb_aplication['und'];
$i = 1;
foreach($field_thumb as $k => $image){
 if(!empty($image['uri'])) $images['thumb'][$i] = $image['uri'];
 if(!empty($field_large[$k]['uri'])) $images['large'][$i] = $field_large[$k]['uri'];
  
$i ++;
} 
$apps[$row->nid] = $images;


return $apps;

?>

<?php global $u; $u++; $thumb_url = null;
$nid = variable_get('apps_nid');
if($nid != $row->nid) $u=1;
if(!empty($value[$row->nid]['thumb'][$u])){ $thumb_url =  file_create_url($value[$row->nid]['thumb'][$u]);}
if(!empty($value[$row->nid]['large'][$u])) {
    $large_url = file_create_url($value[$row->nid]['large'][$u]); 
}
else{
    $large_url = $thumb_url;
}
variable_set('apps_nid', $row->nid);
//print_r($value);
?>
<a class="gallary" title="" href="<?php echo $large_url; ?>"><img src="<?php echo $thumb_url; ?>"/></a>
 
 