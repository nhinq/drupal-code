<?php

global $images, $i; 
$node = node_load($row->nid);
$field_large = $node->field_apps['und'];
$field_thumb = $node->field_thumb_aplication['und'];
$prev = $i-1;
$indx = $images[$prev]['thumb']['indx'];
$nid = $images[$prev]['thumb']['nid'];
if($nid != $row->nid){
 // $indx = 0;          
}
$i++; $indx++;
 $indx = $indx-1;
  if(!empty($field_thumb[$indx]['uri'])){            
            $images[$i]['thumb']['uri'] = $field_thumb[$indx]['uri'];
            $images[$i]['thumb']['nid'] = $row->nid;
            $images[$i]['thumb']['indx'] = $indx;
            if(!empty($field_large[$indx]['uri'])) {
              $images[$i]['large']['uri'] = $field_large[$indx]['uri']; 
            }
            
       
    }
 
return $images;

?>

<?php 
global $u; $u++; $thumb_url = null;
if(!empty($value[$u]['thumb']['uri'])){ $thumb_url =  file_create_url($value[$u]['thumb']['uri']);}
if(!empty($value[$u]['large']['uri'])) {
    $large_url = file_create_url($value[$u]['large']['uri']); 
}
else{
    $large_url = $thumb_url;
}
print_r($value);
?>
<a class="gallary" title="" href="<?php echo $large_url; ?>"><img src="<?php echo $thumb_url; ?>"/></a>
 
 