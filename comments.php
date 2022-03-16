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
<?php
  $pp_comment_count = get_comments_number();
?>
<div id="pp-comments" class="pp-comments-area <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

<h2 class="pp-comments-title">Comments</h2>

<?php if (have_comments()) : ?>
  <p>There
    <?php printf(
      esc_html( /* translators: 1: number of comments */
        _nx('is %1$s response', 'are %1$s responses', $pp_comment_count,
          'Comments title', 'panda-puss')
      ),
      esc_html( number_format_i18n( get_comments_number() ) )
    );?> so far.
  </p>
  <?php comments_pagination(); ?>
  <ol class="pp-comment-list">
    <?php
    wp_list_comments(array(
        'walker' => new PP_Walker_Comment(),
        'style'  => 'ol',
      )
    );
    ?>
  </ol>
  <?php comments_pagination(); ?>
<?php else : ?>
  <p>There are no comments yet. Will you be the first to add one?</p>
<?php endif; ?>
<?php if ( ! comments_open() ) : ?>
  <p class="pp-no-comments"><?php esc_html_e( 'Comments are closed.', 'panda-puss' ); ?></p>
  </div>
<?php else : ?>
<?php
  $args = array(
    'fields'               => $fields,
    'comment_field'        => sprintf(
      '<p class="comment-form-comment">%s %s</p>',
      sprintf(
        '<label for="comment">%s%s</label>',
        _x( 'Comment', 'noun' ),
        $required_indicator
      ),
      '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525"' . $required_attribute . '></textarea>'
    ),
    'must_log_in'          => sprintf(
      '<p class="must-log-in">%s</p>',
      sprintf(
        /* translators: %s: Login URL. */
        __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
        /** This filter is documented in wp-includes/link-template.php */
        wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
      )
    ),
    'logged_in_as'         => sprintf(
      '<p class="logged-in-as">%s%s</p>',
      sprintf(
        /* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
        __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
        get_edit_user_link(),
        /* translators: %s: User name. */
        esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
        $user_identity,
        /** This filter is documented in wp-includes/link-template.php */
        wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
      ),
      $required_text
    ),
    'comment_notes_before' => sprintf(
      '<p class="comment-notes">%s%s</p>',
      sprintf(
        '<span id="email-notes">%s</span>',
        __( 'Your email address will not be published.' )
      ),
      $required_text
    ),
    'comment_notes_after'  => '',
    'action'               => site_url( '/wp-comments-post.php' ),
    'id_form'              => 'pp-commentform',
    'id_submit'            => 'pp-submit',
    'class_container'      => 'pp-comment-respond',
    'class_form'           => 'pp-comment-form',
    'class_submit'         => 'pp-submit',
    'name_submit'          => 'submit',
    'title_reply'          => __( 'What do you think?' ),
    /* translators: %s: Author of the comment being replied to. */
    'title_reply_to'       => __( 'Reply to %s' ),
    'title_reply_before'   => '<h3 id="pp-reply-title" class="pp-comment-reply-title">',
    'title_reply_after'    => '</h3>',
    'cancel_reply_before'  => ' ',
    'cancel_reply_after'   => '',
    'cancel_reply_link'    => __( 'Cancel reply' ),
    'label_submit'         => __( 'Post comment' ),
    'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    'submit_field'         => '<p class="pp-form-submit">%1$s %2$s</p>',
    'format'               => 'html',
  );

  comment_form($args); ?>
<?php endif; ?>
</div>

<?php
/**
 * Display the comment pagination.
 *
 * @since 0.0.4
 */
function comments_pagination() {
  ?>
  <section class="pp-comments-pagination">
    <div class="pp-comments-pagination-previous"><?php previous_comments_link('previous comments'); ?></div>
    <div class="pp-comments-pagination-next"><?php next_comments_link('next comments'); ?></div>
  </section>
  <?php
}
