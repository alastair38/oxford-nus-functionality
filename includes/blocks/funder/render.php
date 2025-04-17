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
$id = 'blockhaus-funder-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blockhaus-funder';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


if(function_exists('get_field')):
  
  $funders = get_field('funder');

endif;

if( !empty($funders) ): ?>
  <div class="space-y-6">
  <?php foreach( $funders as $post ): 

      // Setup this post for WP functions (variable must be named $post).
      setup_postdata($post); 
      
      $description = get_field('funder_description', $post->ID);
      $funder_link = get_field('funder_link', $post->ID);
      $grants = get_field('funded_grants', $post->ID);
      
      ?>
      <div class="rounded-md border p-6 space-y-6">
        
        <div class="space-y-6">
          
          <?php if(has_post_thumbnail( )):
            
            echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'w-44 object-cover'));
            
            endif; ?>
            
          <h2 class="font-black"><?php echo get_the_title($post->ID); ?></h2>
          
          <?php if($description):?>
            
            <p><?php echo $description;?></p>
            
            <?php endif;?>
            
            <?php if($funder_link):?>
              
              <a rel="external" target="_blank" class="rounded-md text-sm inline-block w-fit bg-contrast text-white px-3 py-1 hover:ring-1 no-underline hover:text-white focus:ring-1 duration-100 ring-offset-2 ring-transparent hover:ring-contrast focus:ring-contrast" href="<?php echo $funder_link; ?>">
              Funder homepage
              </a>
              
            <?php endif;?>
         
        </div>
        
          <?php
          if(! empty($grants)):?>
          <hr aria-hidden="true" class="border-neutral-light-100">
          <details class="space-y-3 text-sm">
            <summary class="w-fit cursor-pointer flex items-center gap-1">
              Funded Grants
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
	              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m8.25 4.5l7.5 7.5l-7.5 7.5" />
              </svg>
            </summary>
            <div class="p-4 rounded-md space-y-3 bg-neutral-light-100">
            <?php foreach($grants as $grant):?>
              
              <p>
                <a href="<?php echo get_permalink($grant->ID); ?>">
                  <?php echo get_the_title($grant->ID); ?>
                </a>
            </p>
            
            <?php endforeach;?>
            </div>
            </details>
          <?php endif;?>
          
      </div>
  <?php endforeach; ?>
  </div>
  <?php 
  // Reset the global post object so that the rest of the page works correctly.
  wp_reset_postdata(); ?>
<?php endif; ?>
  
  
  
