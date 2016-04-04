<?php

global $images;
$node = node_load($row->nid);
$field_large = $node->field_apps['und'];
$field_thumb = $node->field_thumb_aplication['und'];
$nid = variable_get('apps_nid');
$indx = variable_get('apps_indx');
$count = count($field_thumb);

if($nid != $row->nid){ }
if($indx == $count){
foreach($field_thumb as $k => $image){
 
     if(!empty($image['uri'])) {
        $images[$row->nid]['thumb'][] = $image['uri'];
     }
 }
 
 if(!empty($field_large[$k]['uri']) && $images['large'] != $field_large[$k]['uri']) {
    $images[$row->nid]['large'][$i] = $field_large[$k]['uri'];
 }
 
 variable_set('apps_nid', $row->nid);
 variable_set('apps_indx', $k+1);
 

}
return $images;

?>

<?php 
global $u; $u++; $thumb_url = null; if(empty($u)) $u = 0;
if(!empty($value[$row->nid]['thumb'][$u])){ $thumb_url =  file_create_url($value[$row->nid]['thumb'][$u]);}
if(!empty($value['large'][$u])) {
    $large_url = file_create_url($value['large'][$u]); 
}
else{
    $large_url = $thumb_url;
}
print_r($value);
?>
<a class="gallary" title="" href="<?php echo $large_url; ?>"><img src="<?php echo $thumb_url; ?>"/></a>
 
 