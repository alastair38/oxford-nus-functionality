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
$id = 'blockhaus-projects-list-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$additionalPosts = get_field('additional_projects');

$args = array(
  'post_parent' => $post_id,
  'posts_per_page' => -1,//you can use also 'any'
  'post_type' => 'project',
  'order' => 'ASC',
  'orderby' => 'title'
  );
  $children = get_posts( $args );
  
  if(! empty($children || $additionalPosts) ):?>
    <div class="grid grid-cols-fit gap-6">
   <?php foreach($children as $child) {?>
      <a href="<?php echo get_the_permalink($child->ID);?>" class="shadow-md hover:outline outline-primary focus-visible:outline rounded-md overflow-hidden no-underline"> 
      <?php echo get_the_post_thumbnail($child->ID, 'blog', ['class' => 'w-full', 'aria-hidden' => 'true']);?>
      <div class="p-6">
       <h3 class="font-bold"><?php echo get_the_title($child->ID);?></h3>
   
      
      </div></a>
    <?php }
  endif;?>
  
  <?php if(! empty($additionalPosts)):
  
  foreach($additionalPosts as $additionalPost) {?>
    <a href="<?php echo get_the_permalink($additionalPost->ID);?>" class="shadow-md rounded-md overflow-hidden"> 
    <?php echo get_the_post_thumbnail($additionalPost->ID, 'blog', ['class' => 'w-full', 'aria-hidden' => 'true']);?>
    <div class="p-6">
     <h3 class="font-bold"><?php echo get_the_title($additionalPost->ID);?></h3>
 
    
    </div></a>
  <?php }
  
  endif;?>
  </div>


  
  
  
