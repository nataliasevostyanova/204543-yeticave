
<?php 

$start_price;

function formatPrice($start_price){
	$result;	 
		
	$result = number_format($start_price, 0, ' ', ' ');

	$price_in_rubl = '&nbsp'.$result.'&nbsp'.'&#8381';
	print($price_in_rubl);
}
	
?>
