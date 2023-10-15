<?php

namespace Devnet\FSL\Includes;

class Activator
{
    /**
     * @since    1.0.0
     */
    public static function activate()
    {
        $fsl_options = get_option( 'devnet_fsl' );
        
        if ( !$fsl_options ) {
            update_option( 'devnet_fsl', true );
            update_option( 'devnet_fsl_general', Defaults::general() );
            update_option( 'devnet_fsl_bar', Defaults::bar() );
            update_option( 'devnet_fsl_label', Defaults::label() );
        }
    
    }
    
    /**
     * @since    2.0.0
     */
    public static function check_and_format_options()
    {
        $devnet_fsl_options = get_option( 'devnet_fsl_options' );
        
        if ( $devnet_fsl_options ) {
            $general_options = [
                'enable_custom_threshold' => get_option( 'devnet_fsl_enable_custom_threshold' ),
                'custom_threshold'        => get_option( 'devnet_fsl_custom_threshold' ),
                'disable_for_logged_out'  => get_option( 'devnet_fsl_disable_for_logged_out' ),
                'delete_options'          => get_option( 'devnet_fsl_delete_options' ),
            ];
            $bar_options = [
                'enable_bar'         => get_option( 'devnet_fsl_enable' ),
                'show_on_cart'       => get_option( 'devnet_fsl_show_on_cart' ),
                'show_on_checkout'   => get_option( 'devnet_fsl_show_on_checkout' ),
                'show_on_minicart'   => get_option( 'devnet_fsl_show_on_minicart' ),
                'title'              => get_option( 'devnet_fsl_title' ),
                'description'        => get_option( 'devnet_fsl_description' ),
                'bar_inner_color'    => get_option( 'devnet_fsl_bar_inner_color' ),
                'bar_bg_color'       => get_option( 'devnet_fsl_bar_bg_color' ),
                'bar_border_color'   => get_option( 'devnet_fsl_bar_border_color' ),
                'hide_border_shadow' => get_option( 'devnet_fsl_hide_border_shadow' ),
                'bar_height'         => get_option( 'devnet_fsl_bar_height' ),
                'disable_animation'  => get_option( 'devnet_fsl_disable_animation' ),
            ];
            // Convert previous "yes" and "no" to 1 and 0
            $general_options['enable_custom_threshold'] = ( $general_options['enable_custom_threshold'] === 'yes' ? 1 : 0 );
            $general_options['delete_options'] = ( $general_options['delete_options'] === 'yes' ? 1 : 0 );
            $bar_options['enable_bar'] = ( $bar_options['enable_bar'] === 'yes' ? 1 : 0 );
            $bar_options['ignore_cupon'] = ( $bar_options['ignore_cupon'] === 'yes' ? 1 : 0 );
            $bar_options['show_on_cart'] = ( $bar_options['show_on_cart'] === 'yes' ? 1 : 0 );
            $bar_options['show_on_checkout'] = ( $bar_options['show_on_checkout'] === 'yes' ? 1 : 0 );
            $bar_options['show_on_minicart'] = ( $bar_options['show_on_minicart'] === 'yes' ? 1 : 0 );
            $bar_options['hide_border_shadow'] = ( $bar_options['hide_border_shadow'] === 'yes' ? 1 : 0 );
            $bar_options['disable_animation'] = ( $bar_options['disable_animation'] === 'yes' ? 1 : 0 );
            $label_options = [
                'enable_label'                    => 0,
                'show_on_single_simple_product'   => 1,
                'show_on_single_variable_product' => 1,
                'show_on_single_variation'        => 1,
                'show_on_list_simple_products'    => 1,
                'show_on_list_variable_products'  => 1,
                'text'                            => esc_html__( 'Free shipping!', 'free-shipping-label' ),
                'text_color'                      => '#000000',
                'bg_color'                        => '#ffffff',
                'hide_border_shadow'              => 0,
            ];
            update_option( 'devnet_fsl', true );
            update_option( 'devnet_fsl_general', $general_options );
            update_option( 'devnet_fsl_bar', $bar_options );
            update_option( 'devnet_fsl_label', $label_options );
            self::delete_old_options();
        }
    
    }
    
    /**
     * Delete old options from previous (1.0.1) version.
     * 
     * @since    2.0.0
     */
    public static function delete_old_options()
    {
        // Delete old options from previous (1.0.1) version
        $old_options = [
            'devnet_fsl_enable',
            'devnet_fsl_enable_custom_threshold',
            'devnet_fsl_custom_threshold',
            'devnet_fsl_ignore_cupon',
            'devnet_fsl_bar_border_color',
            'devnet_fsl_bar_bg_color',
            'devnet_fsl_bar_inner_color',
            'devnet_fsl_hide_border_shadow',
            'devnet_fsl_bar_height',
            'devnet_fsl_disable_animation',
            'devnet_fsl_title',
            'devnet_fsl_description',
            'devnet_fsl_show_on_cart',
            'devnet_fsl_show_on_minicart',
            'devnet_fsl_show_on_checkout',
            'devnet_fsl_delete_options',
            'devnet_fsl_options'
        ];
        foreach ( $old_options as $option ) {
            delete_option( $option );
        }
    }

}