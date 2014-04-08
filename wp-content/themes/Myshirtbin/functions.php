<?php

remove_filter('the_content', 'wpautop');

/* Replace WordPress Logo on login screen */
function msb_login_logo() {
?> <style type="text/css">
#login h1 a {background: url(<?php bloginfo('stylesheet_directory'); ?>/images/logo.svg) no-repeat; background-size: 326px 90px; width: 326px !important; height: 90px !important;}
</style>
<?php }
add_action('login_enqueue_scripts','msb_login_logo');
?>