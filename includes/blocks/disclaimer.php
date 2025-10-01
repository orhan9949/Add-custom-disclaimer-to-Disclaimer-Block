<?php

/**
 * Disclaimer Block.
 */

namespace Base\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Disclaimer {
    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'acf/init', [ $this, 'register_block' ] );
        add_action( 'acf/init', [ $this, 'register_custom_fields' ] );
    }

    /**
     * Register block.
     */
    public function register_block() {
        if( ! function_exists( 'acf_register_block_type' ) ) {
            return;
        }

        acf_register_block_type([
            'name'              => 'disclaimer',
            'title'             => __( 'CN Disclaimer', 'base' ),
            'description'       => __( 'A Disclaimer block.', 'base' ),
            'render_template'   => 'template-parts/blocks/disclaimer.php',
            'post_types'        => [ 'page', 'post' ],
            'category'          => 'blocks',
            'icon'              => 'info',
            'keywords'          => [ 'disclaimer', 'sponsored', 'advert' ],
            'mode'              => 'preview',
            'supports'          => [
                'align'    => false,
                'multiple' => true,
            ]
        ]);
    }

    /**
     * Register block custom fields.
     */
    public function register_custom_fields() {
        acf_add_local_field_group( [
            'key'                    => 'group_disclaimer_options',
            'title'                  => __( 'Disclaimer Options', 'base' ),
            'fields'                 => [
                [
                    'key'            => 'field_disclaimer_type',
                    'label'          => __( 'Type', 'base' ),
                    'name'           => 'type',
                    'type'           => 'select',
                    'choices'        => [
                        'third-party' => __( 'Third party content', 'base' ),
                        'investment'  => __( 'Not investment advice', 'base' ),
                        'opinion'     => __( 'Personal opinion', 'base' ),
                        'custom'     => __( 'Custom', 'base' ),
                    ]
                ],
                [
                'key'               => 'field_disclaimer_text',
                'label'             => __( 'Custom text', 'base' ),
                'name'              => 'disclaimer_text',
                'type'              => 'textarea',
                'required'          => 1,
                'conditional_logic' => [
                    [
                        [
                            'field'    => 'field_disclaimer_type',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                    ],
                ],
            ],
            ],

            'label_placement'       => 'top',
            'instruction_placement' => 'field',
            'location'              => [
                [
                    [
                        'param'     => 'block',
                        'operator'  => '==',
                        'value'     => 'acf/disclaimer',
                    ]
                ],
            ],
        ] );
    }
}

new Disclaimer;