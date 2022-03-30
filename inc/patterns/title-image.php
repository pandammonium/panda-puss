<?php
/** Provides a header with a cover image.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */
$image = get_stylesheet_directory_uri() . '/assets/images/pandas.jpg';
$content = '
<!-- wp:cover {"url":"' . $image . '","dimRatio":50,"className":"pp-cover"}  -->
<div class="wp-block-cover pp-cover">
  <span aria-hidden="true" class="wp-block-cover__gradient-background has-background-dim"></span>
  <img class="wp-block-cover__image-background" alt="" src="' . $image . '" data-object-fit="cover"/>
  <div class="wp-block-cover__inner-container">
    <!-- wp:site-title {"className":"pp-site-title pp-header-site-title"} /-->
    <!-- wp:site-tagline {"className":"pp-site-tagline pp-header-site-tagline"} /-->
  </div>
</div>
<!-- /wp:cover -->';

return array(
  'title'      => _x('Title Image', 'Block pattern title', 'panda-puss'),
  'categories' => array('panda-puss', 'image'),
  'content'    => $content,
);
