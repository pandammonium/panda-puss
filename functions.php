<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package panda-puss
 * @since 0.0.1
 */

/**
 * Sets up the theme.
 *
 * @since 0.0.1
 */
if ( ! function_exists( 'panda_puss_theme_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which runs
   * before the init hook. The init hook is too late for some features, such as indicating
   * support for post thumbnails.
   */
  function panda_puss_theme_setup() {
  /**
   * Add default posts and comments RSS feed links to <head>.
   */
  add_theme_support( 'automatic-feed-links' );

  /**
   * Enable support for post thumbnails and featured images.
   */
  add_theme_support( 'post-thumbnails' );

  /**
   * Enable support for editor styles.
   */
  add_theme_support( 'editor-styles' );
  // add_editor_style( 'assets/css/editor.css' );

  /**
   * Enable support for block styles.
   */
  add_theme_support( 'wp-block-styles' );
  }
endif;
add_action( 'after_setup_theme', 'panda_puss_theme_setup' );

/**
 * Enqueue theme scripts and styles.
 *
 * @since 0.0.1
 */
function panda_puss_theme_scripts() {
  wp_enqueue_style( 'panda-puss-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'panda_puss_theme_scripts' );

/**
 * Disable Gutenberg block library in front end.
 *
 * @since 0.0.4
 */
function remove_wp_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-block-style' ); // Remove Woocommerce block css
  wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
  wp_dequeue_style( 'global-styles' ); // Remove theme.json
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
