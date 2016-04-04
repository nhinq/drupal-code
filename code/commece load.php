<?php
$wrapper = entity_metadata_wrapper('commerce_order', $commerce_order);
$line_items =  $wrapper->commerce_line_items->value();
foreach($line_items as $line_item){        
  $product = commerce_product_load($line_item->commerce_product['und'][0]['product_id']);
  if($product->type == 'ebook'){
    return TRUE;
  }       
   
}
?>
 
