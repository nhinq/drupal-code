<?php

$amount = 10000;
$rate = .12 / 12; // Monthly interest rate
$term = 3; // Term in months

$emi = $amount * $rate * (pow(1 + $rate, $term) / (pow(1 + $rate, $term) - 1));

print $emi;

?>