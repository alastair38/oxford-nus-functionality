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
$id = 'blockhaus-profile-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blockhaus-profile';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$profile = get_field('profile');
$simplified = get_field('simplified'); 
?>


<div id="profile-<?php echo $profile->ID;?>" class="flex flex-col p-2 md:p-6 mb-6 w-full h-full border rounded-md gap-6 shadow-md">
 
  <div class="flex flex-col md:flex-row gap-6 items-center">
  <?php
  
  
  if( $profile ): 
  echo get_the_post_thumbnail($profile->ID, array( 80, 80), ['class' => 'rounded-full w-20 h-20 aspect-square object-cover'] );?>
  <div>
    <h3 class="font-black"><?php echo esc_html( $profile->post_title ); ?></h3>
    <p class="text-sm"><?php echo esc_html( get_field('work_title', $profile->ID) ); ?></p>
  </div>
  
  </div>
  
  <?php 
  
  $alt_biog = get_field('hope_biography', $profile->ID);
  $biog = get_field('biography', $profile->ID); 
  
  if($alt_biog && !$simplified):
    
    echo $alt_biog;
    
  elseif($biog && !$simplified):
  
    echo $biog;
  
  else:
  
  endif;?>

<?php endif; ?>

  
  <a class="flex gap-2 w-fit items-center bg-contrast text-white text-sm px-3 py-1 rounded-full hover:ring-2 focus:ring-2 ring-offset-2 ring-transparent hover:ring-contrast focus:ring-contrast" href="<?php echo get_the_permalink( $profile->ID ); ?>">Further information
  
  </a>




<?php $projects = get_field('projects', $profile->ID);
  if( $projects && !$simplified ): ?>
  <hr aria-hidden="true" class="border-neutral-light-900">
  <div class="flex flex-col gap-4">
    <span class="text-sm font-black">Projects</span>
      <div class="grid grid-cols-1 gap-2 flex-wrap">
      <?php foreach( $projects as $post ): ?>
        
        <a class="flex gap-2 text-sm underline flex-wrap items-center bg-contrasttext-whitetext-smpx-3py-1rounded-fullhover:ring-2 focus:ring-2ring-offset-2 ring-transparenthover:ring-contrastfocus:ring-contrast" href="<?php echo get_the_permalink($post->ID); ?>">
          <?php echo get_the_title($post->ID); ?>
        </a>
        
      <?php endforeach; ?>
      </div>
  </div>

<?php wp_reset_postdata(); endif; ?>

</div>
  
  
  
