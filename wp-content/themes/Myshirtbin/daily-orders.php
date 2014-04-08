<?php
/**
 * Template Name: Daily Orders
 *
 * @package WordPress
 * @subpackage msb
 * @since msb 1.0
 */

get_header();
$today = date('d.m.Y');
$yesterday = date('d.m.Y',strtotime("-1 days"));
error_log($today);
error_log($yesterday);
$args = array(
'cat' => '2',
'date_query' => array(
		array(
			'after'     => $yesterday,
			'before'    => $today,
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