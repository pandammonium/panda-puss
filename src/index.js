/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

// Register the block

const blocks = array(
  'code-lang',
);

for ( blocks in block ) {
  registerBlockType(
    __dirname . '/blocks/' . $block, {
    edit: function () {
        console.log('registerBlockType: edit');
      return "<p> Hello world (from the editor)</p>";
    },
    save: function () {
        console.log('registerBlockType: save');
      return "<p> Hola mundo (from the frontend) </p>";
    },
  });
}
