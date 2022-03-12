<?php
/**
 * Panda-Puss: Block Patterns
 *
 * @since Panda-Puss 0.0.4
 */

if ( ! function_exists( 'panda_puss_register_block_patterns' ) ) :

  /**
   * Registers block patterns and categories.
   *
   * @since Panda-Puss 0.0.4
   *
   * @return void
   */
  function panda_puss_register_block_patterns() {
    $block_pattern_categories = array(
      'panda-puss' => array( 'label' => __( 'Panda-Puss', 'panda-puss' ) ),
      'featured' => array( 'label' => __( 'Featured', 'panda-puss' ) ),
      'footer' => array( 'label' => __( 'Footers', 'panda-puss' ) ),
      'header' => array( 'label' => __( 'Headers', 'panda-puss' ) ),
      'query'  => array( 'label' => __( 'Query', 'panda-puss' ) ),
      'pages'  => array( 'label' => __( 'Pages', 'panda-puss' ) ),
    );

    /**
     * Filters the theme block pattern categories.
     *
     * @since Panda-Puss 0.0.4
     *
     * @param array[] $block_pattern_categories {
     *     An associative array of block pattern categories, keyed by category name.
     *
     *     @type array[] $properties {
     *         An array of block category properties.
     *
     *         @type string $label A human-readable label for the pattern category.
     *     }
     * }
     */
    $block_pattern_categories = apply_filters( 'panda_puss_block_pattern_categories', $block_pattern_categories );

    foreach ( $block_pattern_categories as $name => $properties ) {

      if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
        register_block_pattern_category( $name, $properties );
      }
    }

    $block_patterns = array(
      'hidden-404',
    );

    /**
     * Filters the theme block patterns.
     *
     * @since Panda-Puss 0.0.4
     *
     * @param array $block_patterns List of block patterns by name.
     */
    $block_patterns = apply_filters( 'panda_puss_block_patterns', $block_patterns );

    foreach ( $block_patterns as $block_pattern ) {
      $pattern_file = get_theme_file_path( '/inc/patterns/' . $block_pattern . '.php' );

      register_block_pattern(
        'panda-puss/' . $block_pattern,
        require $pattern_file
      );

    }

  }

endif;

add_action( 'init', 'panda_puss_register_block_patterns', 9 );