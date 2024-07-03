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
  
  $funder = get_field('funder');

  $grants = get_posts( array(
    'orderby'        => 'title',
    'post_type'      => 'grant',
    'grant-funder'   => $funder->name,
  ));

endif;

  
  if( $funder ): 
  // echo get_the_post_thumbnail($funder->ID, array( 80, 80), ['class' => 'rounded-full w-20 h-20 aspect-square object-cover'] );
  ?>
  <div id="funder-<?php echo $funder->ID;?>" class="space-y-6">
    <h2 class="font-black"><?php echo $funder->name; ?></h2>
    <?php if($grants):?>
     <div class="flex flex-col gap-6">
      <?php foreach($grants as $grant):
        $projects = get_field('projects', $grant->ID);?>
        
        <div class="shadow-md rounded-md p-6 space-y-6">
          <div class="space-y-3">
          <h3 class="font-black"><?php echo $grant->post_title;?></h3>
          <p><?php echo get_the_excerpt( $grant->ID );?></p>
       </div>
          <hr aria-hidden="true" class="border-neutral-light-900">
        
        <?php 
        if($projects):?>
        <div class="space-y-3 ">
            <p>Funded Projects</p>
        <?php foreach($projects as $project):?>
          
          
            <a class="flex text-sm" href="<?php the_permalink( $project->ID );?>"><?php echo $project->post_title;?></a>
    
        <?php endforeach;?>
            </div>
        <?php endif; ?>
          
         </div>
      <?php endforeach;?>
   </div>
    <?php endif;?>
    
  </div>
  

<?php wp_reset_postdata(); endif; ?>

  
  
  
