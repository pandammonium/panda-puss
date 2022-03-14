<?php
/**
 * Functions to aid debugging.
 *
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
