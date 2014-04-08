<?php
/**
 * Template Name: Daily Orders
 *
 * @package WordPress
 * @subpackage msb
 * @since msb 1.0
 */

get_header();

$args = array(
'cat' => '2'
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