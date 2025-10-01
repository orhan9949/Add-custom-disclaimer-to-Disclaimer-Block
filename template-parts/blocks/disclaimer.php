<?php

/**
 * Disclaimer Block Template.
 *
 * @param	array $block The block settings and attributes.
 * @param	string $content The block inner HTML (empty).
 * @param	bool $is_preview True during AJAX preview.
 * @param	(int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-disclaimer-' . $block['id'];

if( !empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = [ 'block-disclaimer' ];

$type = get_field( 'type' ) ?? 'third-party';

$custom_type = get_field( 'disclaimer_text' ) ?? 'third-party';

$text = '';

$content = [
    'third-party' => __( 'Disclosure: This content is provided by a third party. crypto.news does not endorse any product mentioned on this page. Users must do their own research before taking any actions related to the company.', 'base' ),
    'investment'  => __( 'Disclosure: This article does not represent investment advice. The content and materials featured on this page are for educational purposes only.', 'base' ),
    'opinion'     => __( 'Disclosure: The views and opinions expressed here belong solely to the author and do not represent the views and opinions of crypto.news’ editorial.', 'base' ),
    'custom'      => ''
];

if($type == 'custom'):

    $text = $custom_type;

else:

    $text = $content[$type];

endif;
?>

<?php if ( is_feed() && ! wp_doing_ajax() ) : ?>

    <p>
        <?php echo $text; ?>
    </p>

<?php else : ?>

    <div class="<?php echo implode( ' ', $classes ); ?>">

        <div class="block-disclaimer__icon">
            <?php echo get_svg_icon( 'info' ); ?>
        </div>

        <p class="block-disclaimer__content">
            <?php echo $text; ?>
        </p>

    </div><!-- .block-disclaimer -->

<?php endif; ?>