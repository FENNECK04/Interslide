<?php
/**
 * Adding Custom Meta Boxes.
 *
 * @package Newsreader
 */

/**
 * ==================================
 * Category Options
 * ==================================
 */

/**
 * Add fields to Category
 *
 * @param string $taxonomy The taxonomy slug.
 */
function csco_mb_category_options_add( $taxonomy ) {
	wp_nonce_field( 'category_options', 'csco_mb_category_options' );
	?>
		<hr>

		<div class="form-field">
			<p><?php esc_html_e( 'Display Featured Posts', 'newsreader' ); ?></p>
			<label for="csco_category_header">
				<input type="radio" name="csco_category_header" id="csco_category_header_default" value="0" checked />
				<?php esc_html_e( 'Default', 'newsreader' ); ?>
			</label>
			<label for="csco_category_header">
				<input type="radio" name="csco_category_header" id="csco_category_header_enabled" value="1" />
				<?php esc_html_e( 'Enabled', 'newsreader' ); ?>
			</label>
			<label for="csco_category_header">
				<input type="radio" name="csco_category_header" id="csco_category_header_disabled" value="2" />
				<?php esc_html_e( 'Disabled', 'newsreader' ); ?>
			</label>
			<p class="description"><?php esc_html_e( 'Enabling or disabling this option will override the default Featured Posts configuration in the Appearance -> Customize -> Archive Settings.', 'newsreader' ); ?></p>
		</div>
		<br><br>
	<?php
}
add_action( 'category_add_form_fields', 'csco_mb_category_options_add', 10 );

/**
 * Edit fields from Category
 *
 * @param object $term     Current taxonomy term object.
 * @param string $taxonomy Current taxonomy slug.
 */
function csco_mb_category_options_edit( $term, $taxonomy ) {
	wp_nonce_field( 'category_options', 'csco_mb_category_options' );

	$featured_category = get_term_meta( $term->term_id, 'csco_category_header', true );
	$featured_category = ( ! empty( $featured_category ) ) ? $featured_category : '0';

	?>

	<tr class="form-field">
		<th scope="row" valign="top"><label for="csco_category_header"><?php esc_html_e( 'Display Featured Posts', 'newsreader' ); ?></label></th>
		<td>
			<p class="description">
				<input type="radio" name="csco_category_header" id="csco_category_header_default" value="0" <?php checked( $featured_category, '0' ); ?> />
				<label for="csco_category_header_default"><?php esc_html_e( 'Default', 'newsreader' ); ?></label><br>
				<input type="radio" name="csco_category_header" id="csco_category_header_enabled" value="1" <?php checked( $featured_category, '1' ); ?> />
				<label for="csco_category_header_enabled"><?php esc_html_e( 'Enabled', 'newsreader' ); ?></label><br>
				<input type="radio" name="csco_category_header" id="csco_category_header_disabled" value="2" <?php checked( $featured_category, '2' ); ?> />
				<label for="csco_category_header_disabled"><?php esc_html_e( 'Disabled', 'newsreader' ); ?></label>
			</p>
			<p class="description"><?php esc_html_e( 'Enabling or disabling this option will override the default Featured Posts configuration in the Appearance -> Customize -> Archive Settings.', 'newsreader' ); ?></p>
		</td>
	</tr>

	<?php
}
add_action( 'category_edit_form_fields', 'csco_mb_category_options_edit', 10, 2 );

/**
 * Save meta box
 *
 * @param int    $term_id  ID of the term about to be edited.
 * @param string $taxonomy Taxonomy slug of the related term.
 */
function csco_mb_category_options_save( $term_id, $taxonomy ) {

	// Bail if we're doing an auto save.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// if our nonce isn't there, or we can't verify it, bail.
	if ( ! isset( $_POST['csco_mb_category_options'] ) || ! wp_verify_nonce( $_POST['csco_mb_category_options'], 'category_options' ) ) { // Input var ok; sanitization ok.
		return;
	}

	if ( isset( $_POST['csco_category_header'] ) && ! empty( $_POST['csco_category_header'] ) ) { // Input var ok; sanitization ok.
		update_term_meta( $term_id, 'csco_category_header', intval( $_POST['csco_category_header'] ) ); // Input var ok; sanitization ok.

	} else {
		delete_term_meta( $term_id, 'csco_category_header' );
	}

}
add_action( 'created_category', 'csco_mb_category_options_save', 10, 2 );
add_action( 'edited_category', 'csco_mb_category_options_save', 10, 2 );
