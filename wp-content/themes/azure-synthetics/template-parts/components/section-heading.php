<?php
/**
 * Section heading component.
 *
 * @package AzureSynthetics
 */

if ( empty( $args ) ) {
	return;
}
?>
<div class="azure-section-heading">
	<?php if ( ! empty( $args['eyebrow'] ) ) : ?>
		<p class="azure-kicker"><?php echo esc_html( $args['eyebrow'] ); ?></p>
	<?php endif; ?>
	<?php if ( ! empty( $args['title'] ) ) : ?>
		<h1><?php echo esc_html( $args['title'] ); ?></h1>
	<?php endif; ?>
	<?php if ( ! empty( $args['description'] ) ) : ?>
		<p class="azure-section-heading__description"><?php echo esc_html( $args['description'] ); ?></p>
	<?php endif; ?>
</div>
