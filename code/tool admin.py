<?php
global $user;
if($user->uid>0){ 
    $name = $user->name; 
print '<div id="welcome-user-block">Xin chào,' . $name . '</div>';


if ($user->uid) {
      $content = userpoints_get_points_list();
      print $content['total']['#markup'];
      print l('Xem các giao d?ch', 'myuserpoints');
    }

$order = commerce_cart_order_load($user->uid);
if(!empty($order )){
$wrapper = entity_metadata_wrapper('commerce_order', $order);
$order_total = $wrapper->commerce_order_total->value();
//Retrieve total number of items in cart.
$quantity = 0;
foreach ($wrapper->commerce_line_items as $delta => $line_item_wrapper) {
  $quantity += $line_item_wrapper->quantity->value();
}
print '<p>
<a href="cart">Gi? hàng</a>['. $quantity . ']. <br>T?ng:'. commerce_currency_format($order_total['amount'], $order_total['currency_code']). '<a href="checkout">Thanh toán</a>.</p>';
}

?>

<?php
if($user->uid>0){ 
    $logout = l(t('Logout'), 'user/logout');
    print '<div id="logout-user-block">' .$logout. '</div>';
   } 
?>
