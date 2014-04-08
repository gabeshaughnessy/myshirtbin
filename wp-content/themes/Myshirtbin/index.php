<?php
get_header();

if(have_posts()) : while(have_posts()) : the_post();
echo '<div class="order">';
	the_content();
echo '</div>';
endwhile;
endif;

get_footer();
?>