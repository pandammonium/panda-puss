<?php
/**
 * Panda-Puss: Patterns
 *
 * @package Panda-Puss
 * @since 0.0.4
 */

if ( ! function_exists( 'panda_puss_register_patterns' ) ) :

  /**
   * Registers patterns and categories.
   *
   * @since Panda-Puss 0.0.4
   *
   * @return void
   */
  function panda_puss_register_patterns() {
    /**
     * Filters the theme pattern categories.
     *
     * @since Panda-Puss 0.0.4
     *
     * @param array[] $pattern_categories {
     *     An associative array of pattern categories, keyed by category name.
     *
     *     @type array[] $properties {
     *         An array of block category properties.
     *
     *         @type string $label A human-readable label for the pattern category.
     *     }
     * }
     */
    $pattern_categories = array(
      'panda-puss' => array( 'label' => __( 'Panda-Puss', 'panda-puss' ) ),
      'article'  => array( 'label' => __( 'Articles', 'panda-puss' ) ),
      'button'  => array( 'label' => __( 'Buttons', 'panda-puss' ) ),
      'featured' => array( 'label' => __( 'Featured', 'panda-puss' ) ),
      'footer' => array( 'label' => __( 'Footers', 'panda-puss' ) ),
      'general'  => array( 'label' => __( 'General', 'panda-puss' ) ),
      'header' => array( 'label' => __( 'Headers', 'panda-puss' ) ),
      'image'  => array( 'label' => __( 'Images', 'panda-puss' ) ),
      'page'  => array( 'label' => __( 'Pages', 'panda-puss' ) ),
      'query'  => array( 'label' => __( 'Queries', 'panda-puss' ) ),
    );
    $pattern_categories = apply_filters( 'panda_puss_pattern_categories', $pattern_categories );

    foreach ( $pattern_categories as $name => $properties ) {

      if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
        register_block_pattern_category( $name, $properties );
      }
    }

    /**
     * Filters the theme patterns.
     *
     * @since Panda-Puss 0.0.4
     *
     * @param array $patterns List of patterns by name.
     */
    $patterns = array(
      'general-login',
      'hidden-404',
      'hidden-login-header',
    );
    $patterns = apply_filters( 'panda_puss_patterns', $patterns );

    foreach ( $patterns as $pattern ) {
      $pattern_file = get_theme_file_path( '/inc/patterns/' . $pattern . '.php' );

      register_block_pattern(
        'panda-puss/' . $pattern,
        require $pattern_file
      );

    }

  }

endif;

add_action( 'init', 'panda_puss_register_patterns', 9 );
