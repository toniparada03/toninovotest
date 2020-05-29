<div  class="elementskit-testimonial-slider ekit_testimonial_style_6" <?php echo \ElementsKit\Utils::render($wrapper_data); ?>>
	<?php foreach ($testimonials as $testimonial): ?>
    <div class="elementskit-single-testimonial-slider elementskit-testimonial-slider-block-style elementskit-testimonial-slider-block-style-three elementor-repeater-item-<?php echo esc_attr( $testimonial[ '_id' ] ); ?>">
        <?php if(isset($ekit_testimonial_wartermark_enable) && ($ekit_testimonial_wartermark_enable == 'yes')):?>
        <div class="elementskit-icon-content <?php if($ekit_testimonial_wartermark_mask_show_badge == 'yes') : ?> commentor-badge <?php endif; ?>">
            <i class="<?php esc_attr_e( isset($ekit_testimonial_wartermark) ? $ekit_testimonial_wartermark : 'icon icon-quote1');?>"></i>
        </div>
        <?php endif;?>
        <div class="elementskit-commentor-bio <?php echo esc_attr($ekit_testimonial_client_area_alignment); ?>">
			<div class="elementkit-commentor-details">
				<?php
					if (isset($testimonial['client_photo']) && sizeof($testimonial['client_photo']) > 0) {
					$clientLogo = isset($testimonial['client_photo']['url']) ? $testimonial['client_photo']['url'] : '';
				?>
					<div class="elementskit-commentor-image">
						<img src="<?php echo esc_url($clientLogo); ?>"  height="<?php echo esc_attr($ekit_testimonial_client_image_size['size']); ?>" width="<?php echo esc_attr($ekit_testimonial_client_image_size['size']); ?>" alt="<?php esc_attr_e("Client Logo", "agmycoo");?>">
					</div>
				<?php
					}
				?>
				<div class="elementskit-profile-info">
					<strong class="elementskit-author-name"><?php echo isset($testimonial['client_name']) ? esc_html($testimonial['client_name']) : ''; ?></strong>
					<span class="elementskit-author-des"><?php echo isset($testimonial['designation']) ? esc_html($testimonial['designation']) : ''; ?></span>
				</div>
			</div>
		</div>
		<?php if ( isset($testimonial['review']) && !empty($testimonial['review'])) : ?>
			<div class="elementskit-commentor-content">
				<?php if ($ekit_testimonial_rating_enable == 'yes') : ?>
				<ul class="elementskit-stars">
                    <?php
                    $reviewData = isset($testimonial['rating']) ? $testimonial['rating'] : 0;
                    for($m = 1; $m <= 5; $m++){
                        $iconStart = 'fa fa-star';
                        if($reviewData >= $m){
                            $iconStart = 'fa fa-star active';
                        }
                    ?>
                    <li><a href="#"><i class="<?php esc_attr_e( $iconStart );?>"></i></a></li>

                    <?php }?>
				</ul>
				<?php endif; ?>
                <p><?php echo isset($testimonial['review']) ? esc_html($testimonial['review']) : ''; ?></p>
            </div>
		<?php endif;  ?>
	</div>
	<?php endforeach; ?>
</div><!-- .testimonial-block-slider2 END -->