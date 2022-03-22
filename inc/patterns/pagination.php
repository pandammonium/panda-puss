<?php
/** Displays the pagination links.
 *
 * @package Panda-Puss
 * @since 0.0.4
 */

$content = '  <!-- wp:query-pagination {"className":"pp-pagination"} -->
    <!-- wp:query-pagination-previous {"className":"pp-pagination-previous","label":"previous results"} /-->
    <!-- wp:query-pagination-numbers {"className":"pp-pagination-numbers"} /-->
    <!-- wp:query-pagination-next {"className":"pp-pagination-next","label":"next results"} /-->
  <!-- /wp:query-pagination -->';

return array(
  'title'      => _x('Pagination', 'pattern-title', 'panda-puss'),
  'categories' => array('panda-puss', 'button'),
  'content'    => $content,
);
