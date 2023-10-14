<?php

namespace Devnet\FSL\Includes;

class Defaults
{
    /**
     * @since    2.0.1
     */
    public static function general()
    {
        $general_options = [
            'initial_zone'            => '1',
            'enable_custom_threshold' => 0,
            'custom_threshold'        => '',
            'only_logged_users'       => 0,
            'hide_shipping_rates'     => 0,
            'delete_options'          => 0,
        ];
        return $general_options;
    }
    
    /**
     * @since    2.0.1
     */
    public static function bar()
    {
        $bar_options = [
            'enable_bar'             => 0,
            'local_pickup'           => 0,
            'zero_shipping'          => 0,
            'show_on_cart'           => 1,
            'show_on_checkout'       => 1,
            'show_on_minicart'       => 0,
            'multilingual'           => 0,
            'title'                  => esc_html__( 'Free delivery on orders over {free_shipping_amount}', 'free-shipping-label' ),
            'description'            => esc_html__( 'Add at least {remaining} more to get free shipping!', 'free-shipping-label' ),
            'show_qualified_message' => 0,
            'qualified_message'      => esc_html__( 'You have free shipping!', 'free-shipping-label' ),
            'bar_inner_color'        => '#95578a',
            'bar_bg_color'           => '#ecd4e5',
            'bar_border_color'       => '#333333',
            'hide_border_shadow'     => 0,
            'bar_height'             => 16,
            'disable_animation'      => 0,
        ];
        return $bar_options;
    }
    
    /**
     * @since    2.0.1
     */
    public static function label()
    {
        $label_options = [
            'enable_label'                    => 0,
            'show_on_single_simple_product'   => 1,
            'show_on_single_variable_product' => 1,
            'show_on_single_variation'        => 1,
            'show_on_list_simple_products'    => 1,
            'show_on_list_variable_products'  => 1,
            'multilingual'                    => 0,
            'text'                            => esc_html__( 'Free shipping!', 'free-shipping-label' ),
            'text_color'                      => '#000000',
            'bg_color'                        => '#ffffff',
            'hide_border_shadow'              => 0,
        ];
        return $label_options;
    }

}