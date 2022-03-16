<?php
/**
 * Functions to aid debugging.
 *
 * Include in PHP files like this:
 * if ( WP_DEBUG ) {
 *   include '/Users/Caity/Sites/wordpress/wp-content/themes/panda-puss/inc/debugging.php';
 * }
 * otherwise a 'critical error' will occur.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */

if ( WP_DEBUG && ! function_exists( 'debug_to_console' ) ) :
  /**
   * Debug: allows data to be written to the console.
   *
   * Uses JavaScript.
   *
   * @since 0.0.4
   */
  function debug_to_console($data) {
    $output = $data;
    if (is_array($output)) {
      $output = implode(',', $output);
    }
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }
endif;
