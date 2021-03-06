<?php
/** 404 content.
 *
 * @package Panda-Puss
 * @since 0.0.1
 * Moved to patterns in 0.0.4
 */
return array (
  'title'      => _x('404 content', 'Block pattern title', 'panda-puss'),
  'inserter'   => false,
  'content'    => '
    <!-- wp:heading {"level":1} -->
      <h1>' . esc_html_x('Page not found', 'page title', 'panda-puss') . '</h1>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>' . esc_html__('We\'ve looked in every cupboard and every room, but we can\'t seem to find that page anywhere.', 'panda-puss') . '</p>
    <!-- /wp:paragraph -->
    <!-- wp:search {"label":"' . esc_html_x('Try searching for it?', 'label', 'panda-puss') . '","buttonText":"Ok","showLabel":true,"className":"pp-search-404"} /-->',
  'description' => _x('Displays the 404 page contents.', 'Block pattern description', 'panda-puss'),
  'keywords'    => array('404', 'error'. 'not found'),
);
