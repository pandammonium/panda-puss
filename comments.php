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
  <?php comment_form(); ?>
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
