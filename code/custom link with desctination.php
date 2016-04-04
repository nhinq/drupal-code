<?php 
 
if(in_array(4, array_keys($value->roles))){
$op = 'deactivate';
}else{
$op = 'activate';
}

$resend = false;
if( isset($value->field_invite_time['und'][0]['value'] ) && $op == 'activate'){
  $resend = 'Resend';
}else{
   $resend = 'Send'; 
}

?>
<div class="quick_link" id="at_link<?php echo $row->uid?>"><a class="activation" href="<?php print url('/account/activation/'.$row->uid.'/'.$op, array('query'=> drupal_get_destination()))?>"><span class="text"><?php echo $op?></span></a></div>

<?php if($resend ):?>
<div class="quick_link" ><a class="resend" href="<?php print url('/resend/activation/'.$row->uid, array('query'=> drupal_get_destination()))?>"><span class="text"><?php echo $resend?></span></a></div>
<?php endif;?>


<p><a href="<?php print url('/node/add/vbooth-style', array('query'=> drupal_get_destination()))?>" target="_blank">Create V-Booth Style</a></p>
