<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      <i class="fa fa-shopping-cart"></i> Cart <span class="caret"></span>
    </a>
    <div class="dropdown-menu" role="menu" style="width: 340px; left: -140px;padding: 5px">
  <?php
$block = module_invoke('commerce_cart', 'block_view', 'cart');
print $block['content'];
?>
    </div>
