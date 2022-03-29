<?php
/**
 * PP_Walker_Comment class
 *
 * @package Panda-Puss
 * @subpackage Comments
 * @since 0.0.4
 */

/**
 * Extension of core walker class used to create an HTML list of comments.
 *
 * @since 0.0.4
 *
 * @see Walker
 */
class PP_Walker_Comment extends Walker_Comment {
/**
   * Outputs a comment in the HTML5 format.
   *
   * @since 0.0.4
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment Comment to display.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function html5_comment( $comment, $depth, $args ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

    $commenter          = wp_get_current_commenter();
    $show_pending_links = ! empty( $commenter['comment_author'] );

    if ( $commenter['comment_author_email'] ) {
      $moderation_note = __( 'Your comment is awaiting moderation.' );
    } else {
      $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
    }
    ?>
    <<?php echo $tag; ?> id="pp-comment-<?php comment_ID(); ?>" <?php comment_class(($this->has_children ? 'parent' : 'childfree') . ' pp-comment-item', $comment ); ?>>
      <div id="div-comment-<?php comment_ID(); ?>" class="pp-comment-individual">
        <header class="pp-comment-header pp-comment-metadata">
          <div class="pp-comment-author vcard">
            <?php
            if ( 0 != $args['avatar_size'] ) {
              echo '<div class="pp-comment-author-avatar">' . get_avatar(
                $comment,
                $args['avatar_size'],
                $args['avatar_default'],
                '',
                array(
                  'class' => 'pp-comment-author-avatar',
                )
              ) . '</div>';
            }
            ?>
            <?php
            $comment_author = get_comment_author_link( $comment );

            if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
              $comment_author = get_comment_author( $comment );
            }
            printf(
              /* translators: %s: Comment author link. */
              __( '<div class="pp-comment-author-content">%s</div>' ),
              sprintf( '<p class="pp-comment-author-name">%s</p>', $comment_author )
            );
            ?>
          </div>

          <div class="pp-comment-date">
            <?php
            printf(
              '<a href="%s"><time datetime="%s">%s</time></a>',
              esc_url( get_comment_link( $comment, $args ) ),
              get_comment_time( 'c' ),
              sprintf(
                /* translators: 1: Comment date, 2: Comment time. */
                __( '%1$s at %2$s' ),
                get_comment_date( '', $comment ),
                get_comment_time()
              )
            );
            edit_comment_link( __( 'Edit' ), ' <span class="pp-edit-link">', '</span>' );
            ?>
          </div>

          <?php if ( '0' == $comment->comment_approved ) : ?>
          <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
          <?php endif; ?>
        </header>

        <div class="pp-comment-body">
          <?php comment_text(); ?>
        </div>

        <footer class="pp-comment-footer">
          <?php
          if ( '1' == $comment->comment_approved || $show_pending_links ) {
            comment_reply_link(
              array_merge(
                $args,
                array(
                  'add_below' => 'div-comment',
                  'depth'     => $depth,
                  'max_depth' => $args['max_depth'],
                  'before'    => '<div class="pp-comment-reply">',
                  'after'     => '</div>',
                )
              )
            );
          }
          ?>
        </footer>
      </div>
    <?php
  }

  /**
   * Ends the element output, if needed.
   *
   * @since 0.0.4
   *
   * @see Walker::end_el()
   * @see wp_list_comments()
   *
   * @param string     $output      Used to append additional content. Passed by reference.
   * @param WP_Comment $data_object Comment data object.
   * @param int        $depth       Optional. Depth of the current comment. Default 0.
   * @param array      $args        Optional. An array of arguments. Default empty array.
   */
  public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
    if ( ! empty( $args['end-callback'] ) ) {
      ob_start();
      call_user_func(
        $args['end-callback'],
        $data_object, // The current comment object.
        $args,
        $depth
      );
      $output .= ob_get_clean();
      return;
    }
    if ( 'div' === $args['style'] ) {
      $output .= "</div>\n";
    } else {
      $output .= "</li>\n";
    }
  }
}
