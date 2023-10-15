<?php

namespace Devnet\FSL\Includes;

class Helper
{
    /**
     * Save free shipping instance.
     */
    static  $free_shipping_instance = array() ;
    /**
     * Check if string starts with string.
     *
     * @since    1.0.0
     * @return   boolean
     */
    static function starts_with( $string, $start_string )
    {
        if ( !$string ) {
            return;
        }
        $len = strlen( $start_string );
        return substr( $string, 0, $len ) === $start_string;
    }
    
    /**
     * Get information about shipping method.
     *
     * @since    2.6.8
     * @param    string    $shipping_id       The id of the method.
     * @return   number                                 
     */
    static function get_flexible_shipping_method_min_amount( $shipping_id )
    {
        $option_name = 'woocommerce_' . str_replace( ':', '_', $shipping_id ) . '_settings';
        $option = get_option( $option_name );
        $amount = ( isset( $option['method_free_shipping'] ) ? $option['method_free_shipping'] : null );
        return $amount;
    }
    
    /**
     * Get chosen shipping method.
     *
     * @since    2.1.0
     */
    static function chosen_shipping_method()
    {
        $wc_session = ( isset( WC()->session ) ? WC()->session : null );
        if ( !$wc_session ) {
            return;
        }
        $chosen_methods = $wc_session->get( 'chosen_shipping_methods' );
        if ( !$chosen_methods ) {
            return null;
        }
        $chosen_shipping_id = ( $chosen_methods ? $chosen_methods[0] : '' );
        return $chosen_shipping_id;
    }
    
    /**
     * Get minimal amount for free shipping.
     *
     * @since    1.0.0
     * @return   number  
     */
    static function get_free_shipping_min_amount()
    {
        $amount = null;
        $only_virtual_products_in_cart = self::only_virtual_products();
        $general_options = get_option( 'devnet_fsl_general' );
        $initial_zone = ( isset( $general_options['initial_zone'] ) ? $general_options['initial_zone'] : '1' );
        $enable_custom_threshold = ( isset( $general_options['enable_custom_threshold'] ) ? $general_options['enable_custom_threshold'] : false );
        $custom_threshold = ( isset( $general_options['custom_threshold'] ) ? $general_options['custom_threshold'] : false );
        
        if ( $enable_custom_threshold && !$only_virtual_products_in_cart ) {
            $amount = ( $custom_threshold ?: $amount );
            return apply_filters( 'fsl_min_amount', $amount );
        }
        
        $chosen_shipping_id = self::chosen_shipping_method();
        $is_flexible_shipping = self::starts_with( $chosen_shipping_id, 'flexible_shipping' );
        
        if ( $is_flexible_shipping ) {
            $amount = self::get_flexible_shipping_method_min_amount( $chosen_shipping_id );
            if ( self::only_virtual_products() ) {
                $amount = null;
            }
            return apply_filters( 'fsl_min_amount', $amount );
        }
        
        $amount = null;
        $cart = WC()->cart;
        
        if ( $cart ) {
            $packages = $cart->get_shipping_packages();
            $package = reset( $packages );
            $zone = wc_get_shipping_zone( $package );
            $known_customer = self::destination_info_exists( $package );
            
            if ( !$known_customer && $initial_zone || $initial_zone == 0 ) {
                $init_zone = \WC_Shipping_Zones::get_zone_by( 'zone_id', $initial_zone );
                // Check if initial zone still exists.
                $zone = ( $init_zone ? $init_zone : $zone );
            }
            
            foreach ( $zone->get_shipping_methods( true ) as $key => $method ) {
                
                if ( $method->id === 'free_shipping' ) {
                    $instance = ( isset( $method->instance_settings ) ? $method->instance_settings : null );
                    self::$free_shipping_instance = $instance;
                    $min_amount_key = apply_filters( 'fsl_free_shipping_instance_key', 'min_amount' );
                    $amount = ( isset( $instance[$min_amount_key] ) ? $instance[$min_amount_key] : null );
                    // If filter fails, go back to default 'min_amount' key.
                    if ( !$amount && isset( $instance['min_amount'] ) ) {
                        $amount = $instance['min_amount'];
                    }
                    break;
                }
                
                // TODO: check if really necessary.
                if ( self::starts_with( $method->id, 'flexible_shipping' ) ) {
                    $amount = self::get_flexible_shipping_method_min_amount( $method->id );
                }
            }
            if ( $only_virtual_products_in_cart ) {
                $amount = null;
            }
        }
        
        return apply_filters( 'fsl_min_amount', $amount );
    }
    
    /**
     * Check if only a virtual product is in the cart.
     * 
     * @since   2.6.0 
     * 
     */
    static function only_virtual_products()
    {
        $only_virtual = false;
        $cart = WC()->cart;
        if ( $cart ) {
            foreach ( $cart->get_cart() as $cart_item ) {
                $product = $cart_item['data'];
                
                if ( $product->is_virtual() || $product->is_downloadable() ) {
                    $only_virtual = true;
                } else {
                    $only_virtual = false;
                    break;
                }
            
            }
        }
        return $only_virtual;
    }
    
    /**
     * Check package to determine if is a returning customer.
     * 
     * TODO: better check on more parameters.
     */
    static function destination_info_exists( $package = array() )
    {
        $country = ( isset( $package['destination']['country'] ) ? $package['destination']['country'] : null );
        $state = ( isset( $package['destination']['state'] ) ? $package['destination']['state'] : null );
        $postcode = ( isset( $package['destination']['postcode'] ) ? $package['destination']['postcode'] : null );
        $city = ( isset( $package['destination']['city'] ) ? $package['destination']['city'] : null );
        // If country is set to AF - this is probably default selection for the first country on the list.
        // Just to be sure, we'll check if city is empty or not.
        if ( $country === 'AF' && !$city ) {
            $country = null;
        }
        $exists = true;
        // If there's no country, state and postcode, we are probably dealing with "first-timer" or
        // a customer that hasn't filled out checkout form recently.
        if ( !$country && !$state && !$postcode ) {
            $exists = false;
        }
        return $exists;
    }
    
    static function shipping_zones_option_list()
    {
        $zones = \WC_Shipping_Zones::get_zones();
        $options = [
            '' => esc_html__( '-- None --', 'free-shipping-label' ),
        ];
        foreach ( $zones as $key => $zone ) {
            $id = ( isset( $zone['zone_id'] ) ? $zone['zone_id'] : null );
            $name = ( isset( $zone['zone_name'] ) ? $zone['zone_name'] : null );
            if ( $id && $name ) {
                $options[$id] = $name;
            }
        }
        return $options;
    }
    
    /**
     * 
     * @since   2.4.0
     */
    static function is_free_shipping_coupon_applied()
    {
        $is_applied = false;
        $applied_coupons = WC()->cart->get_applied_coupons();
        foreach ( $applied_coupons as $coupon_code ) {
            $coupon = new \WC_Coupon( $coupon_code );
            if ( $coupon->get_free_shipping() ) {
                $is_applied = true;
            }
        }
        return $is_applied;
    }
    
    /**
     * Search products by title only.
     * 
     * @since    2.6.0
     */
    static function search_product_titles( $find = '' )
    {
        global  $wpdb ;
        $wild = '%';
        $like = $wild . $wpdb->esc_like( $find ) . $wild;
        $sql = $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'product' AND post_title LIKE %s", $like );
        $results = $wpdb->get_results( $sql );
        return $results;
    }
    
    /**
     * Search through products and product categories
     * 
     * @since    2.6.0
     */
    static function fsl_search()
    {
        $search_term = ( isset( $_GET['q'] ) ? sanitize_text_field( $_GET['q'] ) : '' );
        // we will pass post IDs and titles to this array
        $return = [];
        $categories = get_terms( [
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ] );
        // Prepare category array
        foreach ( $categories as $category ) {
            $name = $category->name;
            // Find category by slug or title
            
            if ( strpos( strtolower( $name ), strtolower( $search_term ) ) !== false ) {
                $name = ( mb_strlen( $name ) > 50 ? mb_substr( $name, 0, 49 ) . '...' : $name );
                $return[] = [ $category->term_id, $name, 'category' ];
                // array( Category ID, Category Title, Type )
            }
        
        }
        $found_products = self::search_product_titles( $search_term );
        if ( !empty($found_products) ) {
            foreach ( $found_products as $product ) {
                $title = $product->post_title;
                // shorten the title a little
                $title = ( mb_strlen( $title ) > 50 ? mb_substr( $title, 0, 49 ) . '...' : $title );
                $return[] = [ $product->ID, $title, 'product' ];
                // array( Post ID, Post Title, Type )
            }
        }
        echo  json_encode( $return ) ;
        wp_die();
    }
    
    static function label_excluded( $output )
    {
        $label_options = get_option( 'devnet_fsl_label' );
        $excluded = ( isset( $label_options['exclude'] ) ? $label_options['exclude'] : [] );
        $options = [];
        $excluded_on = [];
        foreach ( $excluded as $key ) {
            $parts = explode( '___', $key );
            $title = ( isset( $parts[1] ) ? $parts[1] : $key );
            $type_and_id = ( isset( $parts[0] ) ? $parts[0] : [] );
            $type_and_id_parts = explode( '---', $type_and_id );
            $type = ( isset( $type_and_id_parts[0] ) ? $type_and_id_parts[0] : '' );
            $id = ( isset( $type_and_id_parts[1] ) ? $type_and_id_parts[1] : '' );
            $options[$key] = $title;
            $excluded_on[$type][] = $id;
        }
        return ( $output === 'options' ? $options : $excluded_on );
    }

}