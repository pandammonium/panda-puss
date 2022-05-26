<?php
/** Shows log-in and log-out links.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */
$user_is_logged_in = is_user_logged_in();

$log_in_out_link = '';
$log_in_out_text = '';
$log_in_out_class = ' pp-log-in_out';
$log_in_out_class_in_out = '';

$register_link = '';
$register_text = '';
$register_class = '';
$register_anchor = '';

if ($user_is_logged_in) {
  $log_in_out_link = wp_logout_url();
  $log_in_out_text = esc_html_x('Log out', 'log-out text', 'panda-puss' );
  $log_in_out_class_in_out = $log_in_out_class . ' pp-log_out';
} else {
  $log_in_out_link = wp_login_url();
  $log_in_out_text = esc_html_x( 'Log in', 'log-in text', 'panda-puss' );
  $log_in_out_class_in_out = $log_in_out_class .' pp-log_in';
  $register_link = wp_registration_url();
  $register_text = esc_html_x( 'Register', 'register text', 'panda-puss' );
  $register_class = 'pp-register';
  $register_anchor = '<a class="wp-block-button__link ' . $register_class . '" href="' . $register_link . '">' . $register_text . '</a>';
}

$log_in_out_anchor = '<a class="wp-block-button__link ' . $log_in_out_class_in_out . '" href="' . $log_in_out_link . '">' . $log_in_out_text . '</a>';

$log_in_out_button = '
<!-- wp:button {"className":"' . $log_in_out_class . ' "url":' . $log_in_out_link . '} -->
<div class="wp-block-button' . $log_in_out_class . '">
  ' . $log_in_out_anchor . '
</div>
<!-- /wp:button -->
';
$register_button = '
<!-- wp:button {"className":"' . $register_class . ' "url":' . $register_link . '} -->
<div class="wp-block-button' . $register_class . '">
  ' . $register_anchor . '
</div>
<!-- /wp:button -->
';

$content = '';
if ($user_is_logged_in) {
  $content = $log_in_out_button;
} else {
  $content = '
<!-- wp:buttons -->
<div class="wp-block-buttons">
  ' . $log_in_out_button . $register_button . '
</div>
<!-- /wp:buttons -->
';
}

return array(
  'title'      => _x('User account', 'Block pattern title', 'panda-puss'),
  'categories' => array('panda-puss', 'ui', 'button'),
  'content'    => $content,
);
