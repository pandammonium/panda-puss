<?php
/** Shows log-in and log-out button, and a register button.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */
?>
<?php
  $user_is_logged_in = is_user_logged_in();
  $log_in_out_link = '';
  $log_in_out_text = '';
  // $log_in_out_class = 'pp-button-link pp-log_in_out';
  // $log_in_out_class_in_out = '';
  $sign_up_link = '';
  $sign_up_text = '';
  // $sign_up_class = '';
  $sign_up_anchor = '';
  if ($user_is_logged_in) {
    $log_in_out_link = wp_logout_url();
    $log_in_out_text = esc_html_x('Log out', 'log-out text', 'panda-puss');
    // $log_in_out_class_in_out = $log_in_out_class . ' pp-log_out';
  } else {
    $log_in_out_link = wp_login_url();
    $log_in_out_text = esc_html_x('Log in', 'log-in text', 'panda-puss');
    // $log_in_out_class_in_out = $log_in_out_class .' pp-log_in';
    $sign_up_link = wp_registration_url();
    $sign_up_text =esc_html_x('Sign up', 'sign-up text', 'panda-puss');
    // $sign_up_class = 'pp-button-link pp-sign_up';
    $sign_up_anchor = '<a class="wp-block-button__link" href="' . $sign_up_link . '">' . $sign_up_text . '</a>';
  }
  $log_in_out_anchor = '<a class="wp-block-button__link" href="' . $log_in_out_link . '">' . $log_in_out_text . '</a>';

  $content = '
<!-- wp:buttons {"className":"pp-buttons"} -->
<div class="wp-block-buttons">
';

  $content .= '
  <!-- wp:button {"className":"pp-button"} -->
  <div class="wp-block-button">' . $log_in_out_anchor . '</div>
  <!-- /wp:button -->
    ';
  if (!$user_is_logged_in) {
  $content .= '
  <!-- wp:button {"className":"pp-button"} -->
  <div class="wp-block-button">' . $sign_up_anchor . '</div>
  <!-- /wp:button -->
    ';
  }
  $content .= '
</div>
<!-- /wp:buttons -->
  ';

  return array(
    'title' => _x('User account buttons', 'Block pattern title', 'panda-puss'),
    'blockTypes' => array('core/template-part'),
    'categories' => array('panda-puss', 'panda-puss-button', 'panda-puss-ui'),
    'content' => $content,
    'description' => _x('If the user is logged in, a button to log out is displayed. If the user is logged out, a button to log in and a button to sign up are displayed. Will not work as expected if used on a page or post.', 'Block pattern description', 'panda-puss'),
    'keywords' => array( 'buttons', 'log in', 'log out', 'login', 'logout', 'register', 'sign up', 'signup' ),
  );
