<?php
/**
 * Template Name: Daily Orders
 *
 * @package WordPress
 * @subpackage msb
 * @since msb 1.0
 */

get_header();
if(!empty($_GET) && isset($_GET["end"]) && isset($_GET["start"])){
	$end = htmlspecialchars($_GET["end"]);
	$start = htmlspecialchars($_GET["start"]);
}
elseif(!empty($_GET)&& isset($_GET["days"])){
    $days = htmlspecialchars($_GET["days"]);
    $end = date('d.m.Y');
	$start = date('d.m.Y',strtotime("- ".$days." days"));
}
else{
	$days = 1;
	$end = date('d.m.Y');
	$start = date('d.m.Y',strtotime("- ".$days." days"));
}
$args = array(
'cat' => '2',
'date_query' => array(
		array(
			'before'    => $end,
			'after'     => $start,
			'inclusive' => true,
		),
	),
	);

$orders = new WP_Query($args);
if($orders->have_posts()) : while($orders->have_posts()) : $orders->the_post();
echo '<div class="order">';
	the_content();
echo '</div>';
endwhile;
endif;


get_footer();
?>