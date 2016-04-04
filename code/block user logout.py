<div class="welcome">
<?php 
global $user;
if($user->uid <> 0){
 $account = user_load($user->uid);
  print "<span>Hello! </span>".l( ($account->field_first_name ? $account->field_first_name['und'][0]['value']: $account->name), 'user/'. $user->uid).", ".l( 'sign out', 'user/logout');
}
?>
</div>