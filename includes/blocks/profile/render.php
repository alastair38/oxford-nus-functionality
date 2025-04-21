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
$biographyChoice = null;
$biography = null;

if(!$simplified && $profile):
  
  $biographyChoice = get_field('biography_choice');
  
  if($biographyChoice === 'hope'):
    
    $biography = get_field('hope_biography', $profile->ID);
    
  else:
    
    $biography = get_field('biography', $profile->ID);
    
  endif;

endif;



?>

<div id="profile-<?php echo $profile->ID;?>" class="flex flex-col items-center justify-between p-3 md:p-6 mb-6 w-full h-full border rounded-md gap-6">
 
  <?php
  
  if( $profile ): 
  echo get_the_post_thumbnail($profile->ID, array( 80, 80), ['class' => ' rounded-full w-20 h-20 aspect-square object-cover'] );?>
  
  <div class="">
    
    <h3 class="font-black text-center"><?php echo esc_html( $profile->post_title ); ?></h3>
    <p class="text-sm text-center"><?php echo esc_html( get_field('work_title', $profile->ID) ); ?></p>
    
    <?php if(!$simplified):?>
     <div class="mt-6"><?php echo $biography;?></div> 
    <?php endif;?>
    
  </div>
 
  <?php endif; ?>

  <a class="gap-2 mx-auto w-fit no-underline items-center bg-contrast text-white text-sm px-3 py-1 rounded-full hover:ring-1 focus:ring-1 ring-offset-2 ring-transparent hover:ring-contrast focus:ring-contrast" href="<?php echo get_the_permalink( $profile->ID ); ?>">
    <?php esc_html_e( 'OCNS Profile', 'blockhaus' );?>
  </a>

</div>
  
  
  
