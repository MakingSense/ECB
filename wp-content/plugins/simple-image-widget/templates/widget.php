<?php
/**
 * Default widget template.
 *
 * Copy this template to /simple-image-widget/widget.php in your theme or
 * child theme to make edits.
 *
 * @package   SimpleImageWidget
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   GPL-2.0+
 * @since     4.0.0
 */
?>
    <article class="media"> 
      <div class="wrapper">   
          <div class="text-before" style="background: url(<?php echo wp_get_attachment_url( $image_id); ?>);"></div>
          <div class="text">
          <?php if ( ! empty( $subtitle ) ) :?>
	      <h2><?=$subtitle?></h2>
		<?php endif; ?>
        <?php if ( ! empty( $title ) ) :?>
          <h3><?=$title?></h3>
		<?php endif; ?>  
		<?php if ( ! empty( $text ) ) :        ?>
          <h4><?=$text?></h4>
        <?php endif; ?> 
        <?php if ( ! empty( $link_text ) ) : ?>  
         <div class="button-container"><button onclick='window.location.href="<?=  explode('"', $text_link_open)[1];?>";' class="more-button"><?=$link_text?></button></div>
        <?php endif; ?> 
        </div>
      </div>
    </article>
