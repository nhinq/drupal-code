<?php

/**
 * @author Nhi Nguyen
 * @copyright 2015
 */
$rows = array(
 array('label', 'title'),
 array('label 2', 'title 2')
); 
print theme('table', array(
  'header' => array(),
  'rows' => $rows,
  'attributes' => array('class' => array('table'))
));
 

?>