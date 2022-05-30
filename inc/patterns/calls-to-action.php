<?php
/** Front page content.
 *
 * @package Panda-Puss
 * @since 0.0.5
 */
$heading = '
<!-- wp:heading {"level":1} -->
  <h1>Check these out!</h1>
<!-- /wp:heading -->
';

$column_services = '
<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top">
  <!-- wp:heading {"level":2} -->
    <h2>Our services</h2>
  <!-- /wp:heading -->
  <!-- wp:paragraph -->
    <p>You can do wonderful things with our super service! For example:</p>
  <!-- /wp:paragraph -->
  <!-- wp:list -->
    <ul class="wp-block-list">
      <li>You can do this</li>
      <li>You can do that</li>
      <li>You can do the other</li>
    </ul>
  <!-- /wp:list -->
</div>
<!-- /wp:column -->
';
$column_blog = '
<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top">
  <!-- wp:heading {"level":2} -->
    <h2>Blog</h2>
  <!-- /wp:heading -->
  <!-- wp:buttons {"className":""} -->
  <div class="wp-block-buttons">
    <!-- wp:button {"url":"' . get_permalink( get_option( 'page_for_posts' ) ) . '"} -->
    <div class="wp-block-button">
      <a class="wp-block-button__link" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">View our blog</a>
    </div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div>
<!-- /wp:column -->
';
$column_calls_to_action = '
<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top">
  <!-- wp:heading {"level":2} -->
    <h2>Do these</h2>
  <!-- /wp:heading -->
  <!-- wp:paragraph -->
    <p>Press one of these buttons to do something amazing.</p>
  <!-- /wp:paragraph -->
  <!-- wp:buttons {"className":"pp-buttons"} -->
  <div class="wp-block-buttons pp-buttons">
    <!-- wp:button {"className":"pp-button"} -->
    <div class="wp-block-button pp-button">
      <a class="wp-block-button__link" href="#">Press me</a>
    </div>
    <!-- /wp:button -->
    <!-- wp:button {"className":"pp-button"} -->
    <div class="wp-block-button pp-button">
      <a class="wp-block-button__link" href="#">Press me</a>
    </div>
    <!-- /wp:button -->
    <!-- wp:button {"className":"pp-button"} -->
    <div class="wp-block-button pp-button">
      <a class="wp-block-button__link" href="#">Press me</a>
    </div>
    <!-- /wp:button -->
    <!-- wp:button {"className":"pp-button"} -->
    <div class="wp-block-button pp-button">
      <a class="wp-block-button__link" href="#">Press me</a>
    </div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div>
<!-- /wp:column -->';
$columns = '
<!-- wp:columns  -->
<div class="wp-block-columns">
  ' . $column_services . '
  ' . $column_calls_to_action . '
  ' . $column_blog . '
</div>
<!-- /wp:columns -->';
$content = $heading . $columns;

return array(
  'title'      => _x('Calls to Action', 'Block pattern title', 'Panda-Puss'),
  'categories' => array('panda-puss', 'panda-puss-general', 'panda-puss-columns'),
  'content'    => $content,
  'description' => _x('Displays four WP columns with a call to action in each.', 'Block pattern description', 'panda-puss'),
  'keywords'    => array('call to action', 'calls to action', 'columns', 'column', 'four', 'buttons', 'text'),
);
