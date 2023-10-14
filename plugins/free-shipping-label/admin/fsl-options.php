<?php

namespace Devnet\FSL\Admin;

use  Devnet\FSL\Includes\Helper ;
use  Devnet\FSL\Includes\Icons ;
/**
 * Options for settings panel
 *
 */
class Options
{
    /**
     * @since    1.0.0
     */
    public static function general()
    {
        $general = [
            [
            'type'    => 'select',
            'name'    => 'initial_zone',
            'label'   => esc_html__( 'Initial shipping zone', 'free-shipping-label' ),
            'desc'    => esc_html__( "This zone's free shipping threshold will be used only if customer didn't already enter address.", 'free-shipping-label' ),
            'options' => Helper::shipping_zones_option_list(),
            'default' => '1',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'enable_custom_threshold',
            'label' => esc_html__( 'Enable Custom threshold', 'free-shipping-label' ),
            'desc'  => esc_html__( 'This will ignore free shipping threshold in WooCommerce settings.', 'free-shipping-label' ),
        ],
            [
            'type'              => 'number',
            'name'              => 'custom_threshold',
            'label'             => esc_html__( 'Custom threshold', 'free-shipping-label' ),
            'desc'              => esc_html__( 'This will be used only to determine if we should show the bar / label.', 'free-shipping-label' ),
            'placeholder'       => esc_html__( 'Custom threshold', 'free-shipping-label' ),
            'min'               => 0,
            'step'              => '1',
            'sanitize_callback' => 'absint',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'only_logged_users',
            'label' => esc_html__( 'Visibility', 'free-shipping-label' ),
            'desc'  => esc_html__( 'Show only for logged in users.', 'free-shipping-label' ),
        ],
            [
            'type'    => 'select',
            'name'    => 'hide_shipping_rates',
            'label'   => esc_html__( 'Hide shipping rates when free shipping is available?', 'free-shipping-label' ),
            'desc'    => esc_html__( '', 'free-shipping-label' ),
            'options' => [
            ''                  => esc_html__( 'No', 'free-shipping-label' ),
            'hide_all'          => esc_html__( 'Hide all other shipping methods and only show "Free Shipping"', 'free-shipping-label' ),
            'hide_except_local' => esc_html__( 'Hide all other shipping methods and only show "Free Shipping" and "Local Pickup"', 'free-shipping-label' ),
        ],
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'delete_options',
            'label' => esc_html__( 'Delete plugin data on deactivation', 'free-shipping-label' ),
        ]
        ];
        return apply_filters( 'fsl_settings_general', $general );
    }
    
    /**
     * @since    1.0.0
     */
    public static function progress_bar()
    {
        $progress_bar = [
            [
            'type'  => 'checkbox',
            'name'  => 'enable_bar',
            'label' => esc_html__( 'Enable Progress Bar', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'local_pickup',
            'label' => esc_html__( 'Enable on Local Pickup', 'free-shipping-label' ),
            'desc'  => esc_html__( 'Show bar if Local Pickup is selected.', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'zero_shipping',
            'label' => esc_html__( 'Allow zero shipping cost', 'free-shipping-label' ),
            'desc'  => sprintf(
            '%s <br> %s <a href="https://devnet.hr/docs/free-shipping-label/progress-bar/#zero-shipping" target="_blank">%s</a> %s',
            esc_html__( 'Free shipping is indicated by a shipping cost of zero.', 'free-shipping-label' ),
            esc_html__( 'Refer to the ', 'free-shipping-label' ),
            esc_html__( 'documentation', 'free-shipping-label' ),
            esc_html__( 'for more information.', 'free-shipping-label' )
        ),
        ],
            [
            'type'  => 'info',
            'name'  => 'info-bar-positions',
            'label' => esc_html__( 'Positions', 'free-shipping-label' ),
            'class' => 'info',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_checkout',
            'label' => esc_html__( 'Display on the checkout page', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_cart',
            'label' => esc_html__( 'Display on the cart page', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_minicart',
            'label' => esc_html__( 'Display in the mini cart widget', 'free-shipping-label' ),
            'desc'  => esc_html__( 'On some themes, this option does not work properly.', 'free-shipping-label' ),
        ],
            [
            'type'  => 'info',
            'name'  => 'info-bar-text',
            'label' => esc_html__( 'Text', 'free-shipping-label' ),
            'class' => 'info',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'multilingual',
            'label' => esc_html__( 'Multilingual', 'free-shipping-label' ),
            'desc'  => esc_html__( 'Use your own translated strings.', 'free-shipping-label' ),
        ],
            [
            'type'  => 'info',
            'name'  => 'info-bar-placeholders',
            'label' => esc_html__( '', 'free-shipping-label' ),
            'desc'  => sprintf(
            '%s<br><br><input type="text" readonly="readonly" value="{free_shipping_amount}" />%s<br><br><input type="text" readonly="readonly" value="{remaining}" />%s',
            esc_html__( 'Placeholders: ', 'free-shipping-label' ),
            esc_html__( ' Amount for free shipping.', 'free-shipping-label' ),
            esc_html__( ' Remaining amount.', 'free-shipping-label' )
        ),
            'class' => 'info subinfo',
        ],
            [
            'type'              => 'text',
            'name'              => 'title',
            'label'             => esc_html__( 'Title', 'free-shipping-label' ),
            'desc'              => esc_html__( '', 'free-shipping-label' ),
            'placeholder'       => esc_html__( '', 'free-shipping-label' ),
            'sanitize_callback' => 'wp_filter_post_kses',
        ],
            [
            'type'              => 'text',
            'name'              => 'description',
            'label'             => esc_html__( 'Description', 'free-shipping-label' ),
            'desc'              => esc_html__( '', 'free-shipping-label' ),
            'placeholder'       => esc_html__( '', 'free-shipping-label' ),
            'sanitize_callback' => 'wp_filter_post_kses',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_qualified_message',
            'label' => esc_html__( 'Show message after free shipping threshold is reached', 'free-shipping-label' ),
        ],
            [
            'type'              => 'text',
            'name'              => 'qualified_message',
            'label'             => esc_html__( 'Qualified for free shipping message', 'free-shipping-label' ),
            'desc'              => esc_html__( '', 'free-shipping-label' ),
            'placeholder'       => esc_html__( '', 'free-shipping-label' ),
            'sanitize_callback' => 'sanitize_text_field',
            'max'               => 100,
        ],
            [
            'type'  => 'info',
            'name'  => 'info-bar-design',
            'label' => esc_html__( 'Design', 'free-shipping-label' ),
            'class' => 'info',
        ],
            [
            'type'  => 'color',
            'name'  => 'bar_inner_color',
            'label' => esc_html__( 'Progress bar inner color', 'free-shipping-label' ),
        ],
            [
            'type'  => 'color',
            'name'  => 'bar_bg_color',
            'label' => esc_html__( 'Progress bar background color', 'free-shipping-label' ),
        ],
            [
            'type'  => 'color',
            'name'  => 'bar_border_color',
            'label' => esc_html__( 'Progress bar border color', 'free-shipping-label' ),
        ],
            [
            'type'              => 'number',
            'name'              => 'bar_height',
            'label'             => esc_html__( 'Progress bar height', 'free-shipping-label' ),
            'desc'              => esc_html__( 'Height in pixels (px)', 'free-shipping-label' ),
            'placeholder'       => esc_html__( 'height in px', 'free-shipping-label' ),
            'unit'              => 'px',
            'min'               => 0,
            'step'              => '1',
            'sanitize_callback' => 'absint',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'disable_animation',
            'label' => esc_html__( 'Disable animation', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'hide_border_shadow',
            'label' => esc_html__( 'Hide border shadow', 'free-shipping-label' ),
        ]
        ];
        return apply_filters( 'fsl_settings_progress_bar', $progress_bar );
    }
    
    /**
     * @since    1.0.0
     */
    public static function product_label()
    {
        $product_label = [
            [
            'type'  => 'checkbox',
            'name'  => 'enable_label',
            'label' => esc_html__( 'Enable Product Label', 'free-shipping-label' ),
        ],
            [
            'type'  => 'info',
            'name'  => 'info-label-single-product',
            'label' => esc_html__( 'Single product page', 'free-shipping-label' ),
            'class' => 'info',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_single_simple_product',
            'label' => esc_html__( 'Enable for simple products', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_single_variable_product',
            'label' => esc_html__( 'Enable for variable products', 'free-shipping-label' ),
            'desc'  => esc_html__( 'The label will only be displayed if the lowest variation price meets the requirements for free shipping.', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_single_variation',
            'label' => esc_html__( 'Enable for single variation', 'free-shipping-label' ),
            'desc'  => esc_html__( 'Customer needs to select a variation first.', 'free-shipping-label' ),
        ],
            [
            'type'  => 'info',
            'name'  => 'info-label-listed-products',
            'label' => esc_html__( 'Listed products', 'free-shipping-label' ),
            'desc'  => esc_html__( 'Main shop page, category pages, archive pages, etc.', 'free-shipping-label' ),
            'class' => 'info',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_list_simple_products',
            'label' => esc_html__( 'Enable for simple products', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'show_on_list_variable_products',
            'label' => esc_html__( 'Enable for variable products', 'free-shipping-label' ),
            'desc'  => esc_html__( 'The label will only be displayed if the lowest variation price meets the requirements for free shipping.', 'free-shipping-label' ),
        ],
            [
            'type'  => 'info',
            'name'  => 'info-label-text',
            'label' => esc_html__( 'Text Label', 'free-shipping-label' ),
            'class' => 'info',
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'multilingual',
            'label' => esc_html__( 'Multilingual', 'free-shipping-label' ),
            'desc'  => esc_html__( 'Use your own translated strings.', 'free-shipping-label' ),
        ],
            [
            'type'              => 'text',
            'name'              => 'text',
            'label'             => esc_html__( 'Label Text', 'free-shipping-label' ),
            'desc'              => esc_html__( '', 'free-shipping-label' ),
            'placeholder'       => esc_html__( '', 'free-shipping-label' ),
            'max'               => 25,
            'sanitize_callback' => 'sanitize_text_field',
        ],
            [
            'type'  => 'color',
            'name'  => 'text_color',
            'label' => esc_html__( 'Text color', 'free-shipping-label' ),
        ],
            [
            'type'  => 'color',
            'name'  => 'bg_color',
            'label' => esc_html__( 'Background color', 'free-shipping-label' ),
        ],
            [
            'type'  => 'checkbox',
            'name'  => 'hide_border_shadow',
            'label' => esc_html__( 'Hide border shadow', 'free-shipping-label' ),
        ]
        ];
        return apply_filters( 'fsl_settings_product_label', $product_label );
    }

}