<div class="elementskit-testimonial-slider" <?php echo esc_attr($wrapper_data); ?>>
	<?php foreach ($testimonials as $testimonial): ?>
		<div class="elementskit-tootltip-testimonial text-center">
			<div class="elementskit-commentor-content">
				<?php if ( isset($testimonial['review']) && !empty($testimonial['review'])) : ?>
					<p><?php echo isset($testimonial['review']) ? esc_html($testimonial['review']) : ''; ?></p>
				<?php endif;  ?>

				<?php if(isset($ekit_testimonial_wartermark_enable) && $ekit_testimonial_wartermark_enable == 'yes'):?>
				<div class="elementskit-watermark-icon">
					<i class="<?php esc_attr_e( isset($ekit_testimonial_wartermark) ? $ekit_testimonial_wartermark : 'icon icon-quote');?>"></i>
				</div>
				<?php endif;?>
			</div><!-- .elementskit-commentor-content END -->
			<div class="elementskit-commentor-bio">

				<?php
					if (isset($testimonial['client_logo']) && sizeof($testimonial['client_logo']) > 0) {
					$clientLogo = isset($testimonial['client_logo']['url']) ? $testimonial['client_logo']['url'] : '';
				?>
					<div class="elementskit-commentor-image">
						<img src="<?php echo esc_url($clientLogo); ?>" alt="<?php esc_attr_e("Client Logo", "agmycoo");?>">
					</div>
				<?php
					}
				?>
				<span class="elementskit-profile-info">
					<strong class="elementskit-author-name"><?php echo isset($testimonial['client_name']) ? esc_html($testimonial['client_name']) : ''; ?></strong>
					<span class="elementskit-author-des"><?php echo isset($testimonial['designation']) ? esc_html($testimonial['designation']) : ''; ?></span>
				</span>
			</div>
		</div><!-- .elementskit-tootltip-testimonial END -->
	<?php endforeach; ?>
</div><!-- .elementskit-testimonial-slider END -->