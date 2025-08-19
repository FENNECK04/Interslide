<?php
/**
 * The template for displaying search form.
 *
 * @package Newsreader
 */

?>

<form role="search" method="get" class="cs-search__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="cs-search__group" data-scheme="light">
		<input required class="cs-search__input" type="search" value="<?php the_search_query(); ?>" name="s" placeholder="<?php esc_attr_e( 'Search...', 'newsreader' ); ?>" role="searchbox">

		<button class="cs-search__submit" aria-label="Search" type="submit">
			<?php echo esc_attr( esc_html__( 'Search', 'newsreader' ) ); ?>
		</button>
	</div>
</form>
