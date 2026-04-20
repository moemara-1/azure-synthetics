<?php
/**
 * Accordion component.
 *
 * @package AzureSynthetics
 */

if ( empty( $args['question'] ) || empty( $args['answer'] ) ) {
	return;
}
?>
<details class="azure-accordion">
	<summary><?php echo esc_html( $args['question'] ); ?></summary>
	<div class="azure-accordion__content">
		<p><?php echo esc_html( $args['answer'] ); ?></p>
	</div>
</details>
