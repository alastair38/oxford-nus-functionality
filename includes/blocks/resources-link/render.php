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
    array('core/image')
);


?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"backgroundColor":"neutral-light-100","className":"blockhaus-archive-link flex items-center relative","layout":{"type":"default"}} -->
<div class="wp-block-group blockhaus-archive-link flex items-center relative has-neutral-light-100-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"id":639,"sizeSlug":"large","linkDestination":"none","className":"flex-1"} -->


<InnerBlocks class="flex-1 innerblocks" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" templateLock="all"/>
<!-- wp:buttons {"className":"flex-1 text-center","layout":{"type":"flex","justifyContent":"left","flexWrap":"wrap"}} -->
<div class="wp-block-buttons flex-1 text-center"><!-- wp:button {"className":"flex items-center justify-center w-full h-full "} -->
<div class="wp-block-button flex items-center justify-center w-full h-full"><a class="wp-block-button__link wp-element-button" href="http://caduff.local/resources/"><strong>Resources</strong></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>

<!-- /wp:group -->
