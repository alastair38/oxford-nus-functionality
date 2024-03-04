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
$id = 'blockhaus-project-collaborators-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$profiles = get_field('collab_members_people', $post_id);
  
  if($profiles):?>
  
  <div class="space-y-6">
  <?php foreach( $profiles as $profile ): ?>
  
  <div class="flex flex-col p-6 mb-6 w-full h-full border rounded-md shadow-md gap-6">
 
    <div class="flex gap-6 items-center">
      <?php echo get_the_post_thumbnail($profile->ID, array( 75, 75), ['class' => 'rounded-full w-24 h-24'] );?>
      <div>
        <h3 class="font-black"><?php echo esc_html( $profile->post_title ); ?></h3>
        <p class="text-sm pt-2"><?php echo esc_html( get_field('work_title', $profile->ID) ); ?></p>
      
      </div>
    
    </div>
  
    <?php 
    
    $alt_biog = get_field('hope_biography', $profile->ID); 
    $biog = get_field('biography', $profile->ID);
    
      if($alt_biog):
      
        echo $alt_biog;
        
        elseif($biog):
          
        echo $biog;
        
        else:
      
      endif;?>

    <?php 
    
    $further_info = get_field('further_information', $profile->ID); 
    
    if($further_info):?>
      
      <a class="flex gap-2 w-fit items-center bg-contrast text-white text-sm px-3 py-1 rounded-full hover:ring-2 focus:ring-2 ring-offset-2 ring-transparent hover:ring-contrast focus:ring-contrast" href="<?php echo $further_info; ?>">Further information</a>
      
    <?php endif; ?>
    
  </div>
  
  <?php endforeach; ?>

</div>

<?php endif;?>


  
  
  
