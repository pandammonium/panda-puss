<?php
/**
 * Comments template.
 * Apparently, blocks aren't required here.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>
<div id="pp-comments" class="pp-comments-area <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

<h3 class="pp-comments-title">Comments</h3>

<?php
  $pp_comment_count = get_comments_number();
  $post_id = get_the_ID();
?>


<?php if (have_comments()) : ?>

  <p class="pp-comments-notice-count">
    There <?php printf(esc_html( /* translators: 1: number of comments */
        _nx('is %1$s comment', 'are %1$s comments', $pp_comment_count,
          'Comments count', 'panda-puss')
      ), esc_html( number_format_i18n( get_comments_number())));?> so far.
  </p>

  <?php comments_pagination('above'); ?>
  <ol class="pp-comment-list"><?php
    wp_list_comments(array(
        'walker' => new PP_Walker_Comment(),
        'style'  => 'ol',
      )
    ); ?>
  </ol>
  <?php comments_pagination('below'); ?>

<?php else : ?>
  <p class="pp-comments-notice-none"><?php esc_html_e( 'There are no comments – yet.', 'panda-puss' ); ?></p>

<?php endif; ?>

<?php if ( ! comments_open() ) : ?>
  <p class="pp-comments-notice-closed"><?php esc_html_e( 'Comments are closed.', 'panda-puss' ); ?></p>
<?php else : ?>
<?php
  $req   = get_option( 'require_name_email' );
  $html5 = true;
  // Define attributes in HTML5 or XHTML syntax.
  $required_attribute = ( $html5 ? ' required' : ' required="required"' );
  $checked_attribute  = ( $html5 ? ' checked' : ' checked="checked"' );
  $consent = empty( $commenter['comment_author_email'] ) ? '' : $checked_attribute;

  // Identify required fields visually.
  $required_indicator = ' <span class="required" aria-hidden="true">*</span>';


  $fields = array(
    'author' => sprintf(
      '<p class="pp-comment-form-author">%s %s</p>',
      sprintf(
        '<label for="author">%s%s</label>',
        __( 'Name' ),
        ( $req ? $required_indicator : '' )
      ),
      sprintf(
        '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245"%s />',
        esc_attr( $commenter['comment_author'] ),
        ( $req ? $required_attribute : '' )
      )
    ),
    'email'  => sprintf(
      '<p class="pp-comment-form-email">%s %s</p>',
      sprintf(
        '<label for="email">%s%s</label>',
        __( 'Email' ),
        '' //( $req ? $required_indicator : '' )
      ),
      sprintf(
        '<input id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
        // ( $html5 ? 'type="email"' : 'type="text"' ),
        'type="email"',
        esc_attr( $commenter['comment_author_email'] ),
        ' required' //( $req ? $required_attribute : '' )
      )
    ),
    'url'    => sprintf(
      '<p class="pp-comment-form-url">%s %s</p>',
      sprintf(
        '<label for="url">%s</label>',
        __( 'Website' )
      ),
      sprintf(
        '<input id="url" name="url" %s value="%s" size="30" maxlength="200" />',
        // ( $html5 ? 'type="url"' : 'type="text"' ),
        'type="email"',
        esc_attr( $commenter['comment_author_url'] )
      )
    ),
    'cookies' => sprintf(
      '<p class="pp-comment-form-cookies_consent">%s %s</p>',
      sprintf(
        '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
        $consent
      ),
      sprintf(
        '<label for="wp-comment-cookies-consent">%s</label>',
        __( 'Save my name, email, and website in this browser for the next time I comment.' )
      )
    ),
  );

  $args = array(
    'fields'               => $fields,
    'comment_field'        => sprintf(
      '<p class="pp-comment-form-comment">%s %s</p>',
      sprintf(
        '<label for="comment">%s%s</label>',
        _x( 'Add your comment:', 'noun' ),
        '' //$required_indicator
      ),
      '<textarea id="comment" name="comment" class="pp-comment-form-textarea" rows="8" maxlength="65525"' . ' required' . '></textarea>'
    ),
    'must_log_in'          => sprintf(
      '<p class="pp-comment-must-log-in">%s</p>',
      sprintf(
        /* translators: %s: Login URL. */
        __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
        /** This filter is documented in wp-includes/link-template.php */
        wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
      )
    ),
    'logged_in_as'         => sprintf(
      '<p class="pp-comment-form-logged-in-as">%s%s</p>',
      sprintf(
        /* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
        __( 'Logged in as <a href="%1$s" aria-label="%2$s">%3$s</a>. <a href="%4$s">Log out?</a>' ),
        get_edit_user_link(),
        /* translators: %s: User name. */
        esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
        $user_identity,
        /** This filter is documented in wp-includes/link-template.php */
        wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
      ),
      '' //$required_text
    ),
    'comment_notes_before' => sprintf(
      '<p class="pp-comment-form-notice-notes">%s%s</p>',
      sprintf(
        '<span id="email-notes">%s</span>',
        __( 'Your email address will not be published.' )
      ),
      '' //$required_text
    ),
    'comment_notes_after'  => '',
    'action'               => site_url( '/wp-comments-post.php' ),
    'id_form'              => 'pp-comment-form',
    'id_submit'            => 'pp-comment-form-submit',
    'class_container'      => 'pp-comment-respond',
    'class_form'           => 'pp-comment-form ' . (is_user_logged_in() ? 'pp-user_is_logged_in' : 'pp-user_is_not_logged_in'),
    'class_submit'         => 'pp-comment-form-submit',
    'name_submit'          => 'submit',
    'title_reply'          => __( 'What do you think?' ),
    /* translators: %s: Author of the comment being replied to. */
    'title_reply_to'       => __( 'Replying to %s' ),
    'title_reply_before'   => '<h4 id="pp-comment-reply-title" class="pp-comment-reply-title">',
    'title_reply_after'    => '</h4>',
    'cancel_reply_before'  => ' ',
    'cancel_reply_after'   => '',
    'cancel_reply_link'    => __( 'Cancel reply' ),
    'label_submit'         => __( 'Post comment' ),
    'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    'submit_field'         => '<p class="pp-comment-form-submit">%1$s %2$s</p>',
    'format'               => $html5 ? 'html5' : 'xhtml',
  );

  comment_form($args, $post_id); ?>
<?php endif; ?>
</div>

<?php
/**
 * Display the comment pagination.
 *
 * @since 0.0.4
 */
function comments_pagination($position = '') {
  $nav_class = 'pp-pagination';
  if ($position !== '') {
    $nav_class .= ' pp-comments-navigation-' . $position;
  }
  ?>
  <nav class="<?php echo $nav_class; ?>">
    <div class="pp-pagination-previous"><?php previous_comments_link('previous comments'); ?></div>
    <div class="pp-pagination-next"><?php next_comments_link('next comments'); ?></div>
  </nav>
  <?php
}
