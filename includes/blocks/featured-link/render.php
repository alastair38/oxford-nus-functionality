<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blockhaus-featured-link-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blockhaus-featured-link';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

if(function_exists('get_field')):
    $featuredLink = get_field('link');?>

<a id="<?php echo $id;?>" class="grid grid-cols-1 md:grid-cols-2 hover:ring-4 hover:ring-accent-tertiary group items-center bg-neutral-light-100 rounded-md overflow-hidden" 

<?php if(!is_admin()):
echo 'href="' . get_the_permalink($featuredLink) . '"';
endif;?>

rel="bookmark" aria-label="Read <?php echo get_the_title($featuredLink);?>">
    
    <?php echo get_the_post_thumbnail($featuredLink, 'landscape', ['class' => 'flex1']);?>
    <h2 class="text-center font-bold md:text-lg"><?php echo get_the_title($featuredLink);?></h2>
    
</a>

<?php else:?>
    
<em>This theme does not support the 'Featured Link' block. Please check that you have not deactivated the 'Blockhaus Functionality' plugin, which makes additional blocks available. You can safely delete this block if you cannot or do not wish to use it.</em>

<?php endif;?>