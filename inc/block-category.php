<?php 

/**
 * ibRegisterBlockCategory
 * @param  fetch $categories all categories and merge 
 * @return register WordPress Block Category
 */
function ibRegisterBlockCategory( $categories, $post  ){
    return array_merge(
		array(
            array(
                'slug'  => 'iblocks',
				'title' => 'Infinite Blocks'
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories', 'ibRegisterBlockCategory', 10, 2);