<?php
/** Shows log-in and log-out links.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */
$log_in_out_link = '';
$log_in_out_text = '';
$log_in_out_class = ' pp-log-in_out';
$log_in_out_class_in_out = '';
if (is_user_logged_in()) {
  $log_in_out_link = wp_logout_url();
  $log_in_out_text = esc_html_x('Log out', 'log-out text', 'panda-puss' );
  $log_in_out_class_in_out = $log_in_out_class . ' pp-log-out';
} else {
  $log_in_out_link = wp_login_url();
  $log_in_out_text = esc_html_x( 'Log in', 'log-in text', 'panda-puss' );
  $log_in_out_class_in_out = $log_in_out_class .' pp-log-in';
}

$link = '<a class="' . $log_in_out_class_in_out . '" href="' . $log_in_out_link . '">' . $log_in_out_text . '</a>';

$content = '
  <!-- wp:group {"className":"' . $log_in_out_class . '"} -->
  <div class="wp-block-group' . $log_in_out_class . '">
    <!-- wp:paragraph {"className":"' . $log_in_out_class_in_out . '"} -->
      <p class="' . $log_in_out_class_in_out . '">' . $link . '</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->';

return array(
  'title'      => _x('Log in/out', 'Block pattern title', 'panda-puss'),
  'categories' => array('panda-puss', 'panda-puss-button', 'panda-puss-ui'),
  'content'    => $content,
  'description' => _x('A log-in/out link to be used in places other than the site header.', 'Block pattern description', 'panda-puss'),
  'keywords'    => array('log in', 'log out', 'login', 'logout', 'log-in', 'log-out', 'link', 'links'),
);
