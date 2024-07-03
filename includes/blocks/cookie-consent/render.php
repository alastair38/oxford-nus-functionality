<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 $btnText = 'Manage Cookie Preferences';
 $paraText = 'Embedded media content is disabled by default. Click "Manage Cookie Preferences" and enable "Media" cookies to view.';

if(!is_admin()):?>

<div class="wp-block-blockhaus-cookie-consent-wrapper">
  <p>Embedded media content is disabled by default. Click 'Manage Cookie Preferences' and enable "Media" cookies to view.</p>
<button class="wp-block-blockhaus-cookie-consent-btn" type="button" data-cc="show-preferencesModal"><?php echo $btnText;?></button>
</div>

<?php else:?>

<div class="wp-block-blockhaus-cookie-consent-admin">The cookie consent button will only show on the front-end. Make sure to add both this block and the embed block to a Group (Shadow) block for correct positioning. </div>

<?php endif;?>




