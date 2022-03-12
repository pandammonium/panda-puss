<?php
/**
 * Panda-Puss: Blocks
 *
 * @since Panda-Puss 0.0.4
 */
if ( ! function_exists( 'panda_puss_register_blocks' ) ) :

  /**
   * Registers blocks.
   *
   * @since Panda-Puss 0.0.4
   *
   * @return void
   */
  function panda_puss_register_blocks() {
    $blocks = array(
      'code-lang',
    );

    foreach ( $blocks as $block ) {
      register_block_type_from_metadata(
        __DIR__ . '/blocks/' . $block,
        // array(
        //   'render_callback' => 'render_block_core_block',
        // );
      );
    }

  }
endif;

add_action( 'init', 'panda_puss_register_blocks', 9 );
