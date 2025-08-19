<?php
/**
 * Template part for displaying video posts.
 *
 * @package Newsreader
 */

?>

<div class="cs-entry__wrap">

        <?php
        /**
         * The csco_entry_wrap_start hook.
         *
         * @since 1.0.0
         */
        do_action( 'csco_entry_wrap_start' );
        ?>

        <div class="cs-entry__container">

                <?php
                /**
                 * The csco_entry_container_start hook.
                 *
                 * @since 1.0.0
                 */
                do_action( 'csco_entry_container_start' );
                ?>

                <?php
                $media = get_media_embedded_in_content(
                        apply_filters( 'the_content', get_the_content() ),
                        array( 'video', 'object', 'embed', 'iframe' )
                );

                if ( ! empty( $media ) ) {
                        echo '<div class="entry-video-wrapper">' . $media[0] . '</div>';
               if ( ! empty( $media ) ) {

                       $ratio = get_post_meta( get_the_ID(), 'csco_video_aspect_ratio', true );
                       if ( ! $ratio ) {
                               $ratio = get_theme_mod( 'misc_video_aspect_ratio', '16-9' );
                       }

                       $ratios = array(
                               '16-9' => '56.25%',
                               '9-16' => '177.77%',
                               '4-3'  => '75%',
                               '1-1'  => '100%',
                       );

                       $padding = isset( $ratios[ $ratio ] ) ? $ratios[ $ratio ] : '56.25%';

                       echo '<div class="entry-video-wrapper" style="--video-aspect-ratio: ' . esc_attr( $padding ) . ';">' . $media[0] . '</div>';

                       // Output JSON-LD markup for the embedded video.
                        if ( preg_match( '/src="([^"]+)"/i', $media[0], $matches ) ) {
                                $embed_url = $matches[1];
                                $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'full' );

                                $ld_json = array_filter(
                                        array(
                                                '@context'     => 'https://schema.org',
                                                '@type'        => 'VideoObject',
                                                'name'         => get_the_title(),
                                                'description'  => wp_strip_all_tags( get_the_excerpt() ),
                                                'thumbnailUrl' => $thumbnail,
                                                'embedUrl'     => esc_url( $embed_url ),
                                        )
                                );

                                echo '<script type="application/ld+json">' . wp_json_encode( $ld_json ) . '</script>';
                        }
                }

                // Remove first video from content to avoid duplication.
                $content = get_the_content();
                if ( ! empty( $media ) ) {
                        $content = str_replace( $media[0], '', $content );
                }
                ?>

                <div class="cs-entry__content-wrap">
                        <?php
                        /**
                         * The csco_entry_content_before hook.
                         *
                         * @since 1.0.0
                         */
                        do_action( 'csco_entry_content_before' );
                        ?>

                        <div class="entry-content">
                                <?php echo apply_filters( 'the_content', $content ); ?>
                        </div>

                        <?php
                        /**
                         * The csco_entry_content_after hook.
                         *
                         * @since 1.0.0
                         */
                        do_action( 'csco_entry_content_after' );
                        ?>
                </div>

                <?php
                /**
                 * The csco_entry_container_end hook.
                 *
                 * @since 1.0.0
                 */
                do_action( 'csco_entry_container_end' );
                ?>

        </div>

        <?php
        /**
         * The csco_entry_wrap_end hook.
         *
         * @since 1.0.0
         */
        do_action( 'csco_entry_wrap_end' );
        ?>
</div>

