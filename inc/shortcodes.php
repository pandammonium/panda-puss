<?php

add_shortcode( 'login_logout', 'login_logout' );
/**
 * Add a log in/out shortcode button.
 *
 * @link https://wpbeaches.com/create-loginlogout-link-wordpress/
 * @since 0.0.4
 */
function login_logout() {
  ob_start();
  if (is_user_logged_in()) :
    // Set the logout URL - below it is set to the root URL
    ?>
    <div class="pp-block-navigation-item pp-site-nav-link pp-header-nav-link pp-block-navigation-link"><a class="pp-log-in_out pp-log-out" href="<?php echo wp_logout_url('/'); ?>">Log out</a></div>
    <?php
  else :
  // Set the login URL - below it is set to get_permalink() - you can set that to whatever URL eg '/whatever'
    ?>
    <div class="pp-block-navigation-item pp-site-nav-link pp-header-nav-link pp-block-navigation-link"><a class="pp-log-in_out pp-log-in" href="<?php echo wp_login_url(get_permalink()); ?>">Log in</span></a></div>
<?php
  endif;

return ob_get_clean();
}
