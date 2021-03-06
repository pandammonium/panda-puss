<?php
/** Shows log-in and log-out links.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */
$log_in_out_link = '';
$log_in_out_text = '';
$log_in_out_class = 'pp-log_in_out';
$log_in_out_class_in_out = '';
if (is_user_logged_in()) {
  $log_in_out_link = wp_logout_url();
  $log_in_out_text = esc_html_x('Log out', 'log-out text', 'panda-puss' );
  $log_in_out_class_in_out = $log_in_out_class . ' pp-log_out';
} else {
  $log_in_out_link = wp_login_url();
  $log_in_out_text = esc_html_x( 'Log in', 'log-in text', 'panda-puss' );
  $log_in_out_class_in_out = $log_in_out_class .' pp-log_in';
}

$link = '<a class="' . $log_in_out_class_in_out . '" href="' . $log_in_out_link . '">' . $log_in_out_text . '</a>';

$content = '
  <!-- wp:group {"className":"pp-site-nav pp-header-nav ' . $log_in_out_class . '"} -->
  <div class="wp-block-group pp-site-nav pp-header-nav ' . $log_in_out_class . '">
    <!-- wp:paragraph {"className":"pp-site-nav-link pp-header-nav-link pp-block-navigation-item ' . $log_in_out_class_in_out . '"} -->
      <p class="pp-site-nav-link pp-header-nav-link pp-block-navigation-item ' . $log_in_out_class_in_out . '">' . $link . '</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->';

return array(
  'title'      => _x('Log in/out (header)', 'Block pattern title', 'panda-puss'),
  'inserter'   => false,
  'content'    => $content,
  'description' => _x('Displays a log-in/out link in the header.', 'Block pattern description', 'panda-puss'),
  'keywords' => array( 'buttons', 'log in', 'log out', 'login', 'logout', 'register' ),
);
