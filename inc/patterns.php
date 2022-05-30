<?php
/**
 * Panda-Puss: Patterns
 *
 * @package Panda-Puss
 * @since 0.0.4
 */

if ( ! function_exists( 'panda_puss_register_patterns' ) ) :
  /**
   * Registers patterns and their categories.
   *
   * @since Panda-Puss 0.0.4
   *
   * @return void
   */
  function panda_puss_register_patterns() {
    // /**
    //  * Register new Panda-Puss pattern category types.
    //  *
    //  * @since Panda-Puss 0.0.5
    //  *
    //  */
    // if ( function_exists( 'register_block_pattern_category_type' ) ) {
    //   register_block_pattern_category_type(
    //     'panda-puss',
    //     array( 'label' => __( 'Panda-Puss', 'panda-puss' ) )
    //   );
    // }
    /**
     * Register Panda-Puss pattern categories.
     *
     * @since Panda-Puss 0.0.4
     *
     */
    $pattern_categories = array(
      'panda-puss' => array(
        'label' => __( 'Panda-Puss',        'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-article'    => array(
        'label' => __( 'Panda-Puss Articles',       'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-button'     => array(
        'label' => __( 'Panda-Puss Buttons',        'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-columns'    => array(
        'label' => __( 'Panda-Puss Columns',        'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-featured'   => array(
        'label' => __( 'Panda-Puss Featured',       'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-footer'     => array(
        'label' => __( 'Panda-Puss Footers',        'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-general'    => array(
        'label' => __( 'Panda-Puss General',        'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-header'     => array(
        'label' => __( 'Panda-Puss Headers',        'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-image'      => array(
        'label' => __( 'Panda-Puss Images',         'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-page'       => array(
        'label' => __( 'Panda-Puss Pages',          'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-query'      => array(
        'label' => __( 'Panda-Puss Query',          'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
      'panda-puss-ui'         => array(
        'label' => __( 'Panda-Puss User Interface', 'panda-puss' ),
        'categoryTypes' => array( 'panda-puss' ), ),
    );
    $pattern_categories = apply_filters( 'panda_puss_pattern_categories', $pattern_categories );
    foreach ( $pattern_categories as $name => $properties ) {
      if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
        register_block_pattern_category( $name, $properties );
      }
    }

    /**
     * Register Panda-Puss patterns.
     *
     * @since Panda-Puss 0.0.4
     *
     */
    $patterns = array(
      'button-user-account',
      'calls-to-action',
      'general-login',
      'title-image',
      'hidden-404',
      'hidden-login-header',
    );
    $pattern_categories = apply_filters( 'panda_puss_patterns', $patterns );
    foreach ( $patterns as $pattern ) {
      $pattern_file = get_theme_file_path( '/inc/patterns/' . $pattern . '.php' );
      register_block_pattern(
        'panda-puss/' . $pattern,
        require($pattern_file)
      );
    }

  }

endif;
add_action( 'init', 'panda_puss_register_patterns', 9 );
