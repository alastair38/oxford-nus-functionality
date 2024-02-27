<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 
 $template = array(
	
    array(
        'core/image',
        array(
            'align'           => 'full',
            'sizeSlug'        => 'blog',
            'linkDestination' => 'none',
            'url'             => 'https://i.pravatar.cc/120',
        ),
        array(),
    ),
    array('core/heading', array(
		'level' => 2,
		'content' => 'Title Goes Here',
	))
);

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

<a id="<?php echo $id;?>" 

<?php if(!is_admin()):
echo 'href="' . $featuredLink . '"';
endif;?>
class="flex"
rel="bookmark" aria-label="Read <?php echo get_the_title($featuredLink);?>">

<InnerBlocks
        class="grid grid-cols-1 transition-all duration-250 md:grid-cols-2 hover:ring-2 ring-offset-2 hover:ring-contrast group items-center bg-neutral-light-100 rounded-md overflow-hidden"
        template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>"
        templateLock="all"
    />
    
</a>

<?php else:?>
    
<em>This theme does not support the 'Featured Link' block. Please check that you have not deactivated the 'Blockhaus Functionality' plugin, which makes additional blocks available. You can safely delete this block if you cannot install the plugin or do not wish to use it.</em>

<?php endif;?>