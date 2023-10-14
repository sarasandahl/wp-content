<?php

namespace Devnet\FSL\Frontend;

use  Devnet\FSL\Includes\Defaults ;
use  Devnet\FSL\Includes\Helper ;
use  Devnet\FSL\Includes\Icons ;
class FSL_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Free Shipping minimum amount/threshold.
     *
     * @since    2.6.0
     */
    private  $free_shipping_min_amount ;
    /**
     * Product Label options.
     * 
     */
    private  $fsl_label_options ;
    /**
     * Excluded categories.
     * 
     */
    private  $excluded_categories ;
    /**
     * Excluded products.
     * 
     */
    private  $excluded_products ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            'free-shipping-label-public',
            plugin_dir_url( __DIR__ ) . 'assets/build/fsl-public.css',
            [],
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        $script_asset_path = plugin_dir_url( __DIR__ ) . 'assets/build/fsl-public.asset.php';
        $script_info = ( file_exists( $script_asset_path ) ? include $script_asset_path : [
            'dependencies' => [ 'jquery' ],
            'version'      => $this->version,
        ] );
        wp_enqueue_script(
            'fsl-public',
            plugin_dir_url( __DIR__ ) . 'assets/build/fsl-public.js',
            $script_info['dependencies'],
            $script_info['version'],
            true
        );
        wp_localize_script( 'fsl-public', 'devnet_fsl_ajax', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ] );
    }
    
    /**
     * Get all reusable public data in one call.
     * 
     * currently used only for Product Labels.
     * 
     * @since	2.6.0
     */
    public function public_data()
    {
        $this->fsl_label_options = get_option( 'devnet_fsl_label' );
        $this->free_shipping_min_amount = Helper::get_free_shipping_min_amount();
        $excluded = Helper::label_excluded( 'ids' );
        if ( isset( $excluded['category'] ) ) {
            $this->excluded_categories = array_flip( $excluded['category'] );
        }
        if ( isset( $excluded['product'] ) ) {
            $this->excluded_products = array_flip( $excluded['product'] );
        }
    }
    
    /**
     * Output Progress Bar on the checkout page.
     *
     * @since    2.4.0
     */
    public function free_shipping_bar_checkout()
    {
        $this->free_shipping_bar();
    }
    
    /**
     * Output Progress Bar on the cart page.
     *
     * @since    2.4.0
     */
    public function free_shipping_bar_cart()
    {
        $this->free_shipping_bar();
    }
    
    /**
     * Output Progress Bar on the mini-cart widget.
     *
     * @since    2.4.0
     */
    public function free_shipping_bar_minicart()
    {
        $this->free_shipping_bar();
    }
    
    private function progress_bar_options( $options = array() )
    {
        $fsl_bar = ( isset( $options['fsl_bar'] ) ? $options['fsl_bar'] : [] );
        $defaults = ( isset( $options['defaults'] ) ? $options['defaults'] : [] );
        $args = ( isset( $options['args'] ) ? $options['args'] : [] );
        $opt = [];
        $opt['name'] = 'progress_bar';
        $opt['enable_bar'] = ( isset( $fsl_bar['enable_bar'] ) && $fsl_bar['enable_bar'] ? $fsl_bar['enable_bar'] : false );
        $opt['local_pickup'] = ( isset( $fsl_bar['local_pickup'] ) ? $fsl_bar['local_pickup'] : $defaults['local_pickup'] );
        $opt['zero_shipping'] = ( isset( $fsl_bar['zero_shipping'] ) && $fsl_bar['zero_shipping'] ? $fsl_bar['zero_shipping'] : false );
        $opt['multilingual'] = ( isset( $fsl_bar['multilingual'] ) ? $fsl_bar['multilingual'] : $defaults['multilingual'] );
        $opt['hide_border_shadow'] = ( isset( $fsl_bar['hide_border_shadow'] ) ? $fsl_bar['hide_border_shadow'] : $defaults['hide_border_shadow'] );
        $opt['disable_animation'] = ( isset( $fsl_bar['disable_animation'] ) ? $fsl_bar['disable_animation'] : $defaults['disable_animation'] );
        $opt['bar_border_color'] = ( isset( $fsl_bar['bar_border_color'] ) ? $fsl_bar['bar_border_color'] : $defaults['bar_border_color'] );
        $opt['bar_bg_color'] = ( isset( $fsl_bar['bar_bg_color'] ) ? $fsl_bar['bar_bg_color'] : $defaults['bar_bg_color'] );
        $opt['bar_inner_color'] = ( isset( $fsl_bar['bar_inner_color'] ) ? $fsl_bar['bar_inner_color'] : $defaults['bar_inner_color'] );
        $opt['bar_height'] = ( isset( $fsl_bar['bar_height'] ) ? $fsl_bar['bar_height'] : $defaults['bar_height'] );
        $opt['title'] = ( isset( $fsl_bar['title'] ) ? $fsl_bar['title'] : $defaults['title'] );
        $opt['description'] = ( isset( $fsl_bar['description'] ) ? $fsl_bar['description'] : $defaults['description'] );
        $opt['show_qualified_msg'] = ( isset( $fsl_bar['show_qualified_message'] ) ? $fsl_bar['show_qualified_message'] : $defaults['show_qualified_message'] );
        $opt['qualified_message'] = ( isset( $fsl_bar['qualified_message'] ) && $fsl_bar['qualified_message'] ? $fsl_bar['qualified_message'] : $defaults['qualified_message'] );
        $opt['bar_type'] = ( isset( $fsl_bar['bar_type'] ) && $fsl_bar['bar_type'] ? $fsl_bar['bar_type'] : 'linear' );
        $opt['show_fsl_title'] = true;
        $opt['show_fsl_description'] = true;
        
        if ( $opt['multilingual'] ) {
            $opt['title'] = $defaults['title'];
            $opt['description'] = $defaults['description'];
            $opt['qualified_message'] = $defaults['qualified_message'];
        }
        
        return $opt;
    }
    
    private function fsl_wrapper( $opt = array(), $wrapper = '', $for = '' )
    {
        $wrapper_class = [ 'devnet_fsl-free-shipping' ];
        $wrapper_styles = [];
        if ( $opt['hide_border_shadow'] ) {
            $wrapper_class[] = 'devnet_fsl-no-shadow';
        }
        // Add in for progress bar.
        
        if ( $for === 'progress_bar' ) {
            if ( $opt['disable_animation'] ) {
                $wrapper_class[] = 'devnet_fsl-no-animation';
            }
            $wrapper_class[] = 'bar-type-' . $opt['bar_type'];
        }
        
        // Add in for qualified message.
        
        if ( $for === 'qualified_message' ) {
            $wrapper_class[] = 'qualified-message';
            if ( $opt['hide_border_shadow'] ) {
                $wrapper_class[] = 'devnet_fsl-no-shadow';
            }
        }
        
        $output = [
            'class'  => implode( ' ', $wrapper_class ),
            'styles' => implode( ' ', $wrapper_styles ),
        ];
        return ( isset( $output[$wrapper] ) ? $output[$wrapper] : $output );
    }
    
    /**
     * Build Free shipping bar and set styles.
     *
     * @since    1.0.0
     */
    public function free_shipping_bar( $args = array() )
    {
        $amount_for_free_shipping = Helper::get_free_shipping_min_amount();
        if ( !$amount_for_free_shipping || !is_numeric( $amount_for_free_shipping ) ) {
            return;
        }
        $amount_for_free_shipping = (double) $amount_for_free_shipping;
        // show_shipping_before_address
        if ( !WC()->cart->show_shipping() ) {
            return;
        }
        $cart_subtotal = WC()->cart->get_displayed_subtotal();
        $discount = WC()->cart->get_discount_total();
        $discount_tax = WC()->cart->get_discount_tax();
        $price_including_tax = WC()->cart->display_prices_including_tax();
        $price_decimal = wc_get_price_decimals();
        $is_local_pickup = Helper::starts_with( Helper::chosen_shipping_method(), 'local_pickup' );
        $fs_instance = Helper::$free_shipping_instance;
        $fs_requires = ( isset( $fs_instance['requires'] ) ? $fs_instance['requires'] : '' );
        $fs_ignore_discounts = ( isset( $fs_instance['ignore_discounts'] ) ? $fs_instance['ignore_discounts'] : '' );
        // Are coupon discounts ignored?
        
        if ( $fs_ignore_discounts === 'yes' ) {
            $discount = 0;
            $discount_tax = 0;
        }
        
        $opt = $this->progress_bar_options( [
            'fsl_bar'  => get_option( 'devnet_fsl_bar' ),
            'defaults' => Defaults::bar(),
            'args'     => $args,
        ] );
        
        if ( $is_local_pickup && !$opt['local_pickup'] ) {
            $this->free_shipping_bar_placeholder( true );
            return;
        }
        
        if ( !$opt['enable_bar'] ) {
            return;
        }
        
        if ( $price_including_tax ) {
            $cart_subtotal = round( $cart_subtotal - ($discount + $discount_tax), $price_decimal );
        } else {
            $cart_subtotal = round( $cart_subtotal - $discount, $price_decimal );
        }
        
        $cart_reached_threshold = $cart_subtotal >= $amount_for_free_shipping;
        $free_shipping_pass = false;
        
        if ( $cart_reached_threshold ) {
            $free_shipping_pass = true;
            $percent = 100;
            $remaining = '0,00';
        } else {
            $remaining = $amount_for_free_shipping - $cart_subtotal;
            if ( $amount_for_free_shipping != 0 ) {
                $percent = 100 - $remaining / $amount_for_free_shipping * 100;
            }
        }
        
        /**
         * Check shipping cost only if Zero Shipping Cost is allowed.
         * In most cases we don't care about shipping cost, 
         * but some shipping classes use 0,00 shipping value for free shipping.
         * Skip if currently chosen local pickup as shipping method.
         */
        if ( $opt['zero_shipping'] && WC()->cart->get_shipping_total() == 0 && !$is_local_pickup ) {
            $free_shipping_pass = true;
        }
        
        if ( Helper::is_free_shipping_coupon_applied() ) {
            $free_shipping_pass = true;
            if ( $fs_requires === 'coupon' ) {
                $free_shipping_pass = true;
            }
            if ( $fs_requires === 'both' && $cart_reached_threshold ) {
                $free_shipping_pass = true;
            }
        } else {
            if ( $fs_requires === 'coupon' ) {
                return;
            }
            
            if ( $fs_requires === 'both' ) {
                $free_shipping_pass = false;
                
                if ( $cart_reached_threshold ) {
                    $percent = 100;
                    //$opt['title'] .= esc_html__(' + Free Shipping coupon', 'free-shipping-label');
                    $opt['description'] = esc_html__( 'Waiting for Free Shipping coupon', 'free-shipping-label' );
                }
            
            }
        
        }
        
        $title = $this->convert_placeholders( $opt['title'], $remaining, $amount_for_free_shipping );
        $description = $this->convert_placeholders( $opt['description'], $remaining, $amount_for_free_shipping );
        $qualified_message = $this->convert_placeholders( $opt['qualified_message'], $remaining, $amount_for_free_shipping );
        $output = '';
        
        if ( $free_shipping_pass ) {
            
            if ( $opt['show_qualified_msg'] ) {
                $output = $this->qualified_message_html( $qualified_message, $opt );
            } else {
                $output = $this->free_shipping_bar_placeholder();
            }
        
        } else {
            $wrapper = $this->fsl_wrapper( $opt, '', 'progress_bar' );
            $wrapper_class = $wrapper['class'];
            $wrapper_styles = $wrapper['styles'];
            $progress_bar = '<div class="' . esc_attr( $wrapper_class ) . '" style="' . esc_attr( $wrapper_styles ) . '">';
            if ( $title && $opt['show_fsl_title'] ) {
                $progress_bar .= '<h4 class="fsl-title title">' . wp_kses_post( $title ) . '</h4>';
            }
            if ( 'linear' === $opt['bar_type'] ) {
                $progress_bar .= $this->linear_bar_html( $percent, $opt );
            }
            if ( 'circular' === $opt['bar_type'] ) {
            }
            if ( $description && $opt['show_fsl_description'] ) {
                $progress_bar .= '<span class="fsl-notice notice">' . wp_kses_post( $description ) . '</span>';
            }
            $progress_bar .= '</div>';
            $output = $progress_bar;
        }
        
        echo  apply_filters( 'fsl_progress_bar_html', $output ) ;
    }
    
    /**
     * Output empty placeholder.
     *
     * @since    2.6.10
     */
    public function free_shipping_bar_placeholder( $should_echo = false )
    {
        $placeholder = '<div class="devnet_fsl-free-shipping fsl-flat"></div>';
        $output = apply_filters( 'fsl_progress_bar_placeholder_html', $placeholder );
        
        if ( $should_echo ) {
            echo  $output ;
        } else {
            return $output;
        }
    
    }
    
    /**
     * Build linear progress bar html.
     * 
     * @since	2.6.0
     */
    public function linear_bar_html( $progress, $opt = array() )
    {
        if ( !$opt['bar_height'] ) {
            return;
        }
        $style_pb = [];
        $style_pb[] = '--fsl-percent:' . $progress . ';';
        if ( $opt['bar_bg_color'] ) {
            $style_pb[] = 'background-color:' . $opt['bar_bg_color'] . ';';
        }
        if ( $opt['bar_border_color'] ) {
            $style_pb[] = 'border-color:' . $opt['bar_border_color'] . ';';
        }
        $style_pb = implode( ' ', $style_pb );
        $html = '<div class="fsl-progress-bar progress-bar shine stripes" style="' . esc_attr( $style_pb ) . '">';
        $html .= '<span class="fsl-progress-amount progress-amount" style="width:' . esc_attr( $progress ) . '%; height:' . esc_attr( $opt['bar_height'] ) . 'px; background-color:' . esc_attr( $opt['bar_inner_color'] ) . ';""></span>';
        $html .= '</div>';
        return $html;
    }
    
    /**
     * Build qualified message html.
     * 
     * @since	2.6.0
     */
    public function qualified_message_html( $text = '', $opt = array() )
    {
        $wrapper = $this->fsl_wrapper( $opt, '', 'qualified_message' );
        $wrapper_class = $wrapper['class'];
        $wrapper_styles = $wrapper['styles'];
        // escape HTML
        $safe_qualified_message = esc_html( $text );
        $html = '';
        $html .= '<div class="' . esc_attr( $wrapper_class ) . '" style="' . esc_attr( $wrapper_styles ) . '">';
        $html .= '<h4 class="title">' . $safe_qualified_message . '</h4>';
        $html .= '</div>';
        return $html;
    }
    
    /**
     * Convert placeholders to strings.
     *
     * @since    2.1.0
     */
    public function convert_placeholders( $input_string = '', $remaining = null, $amount_for_free_shipping = null )
    {
        if ( $remaining ) {
            $input_string = str_replace( '{remaining}', wc_price( $remaining ), $input_string );
        }
        if ( $amount_for_free_shipping ) {
            $input_string = str_replace( '{free_shipping_amount}', wc_price( $amount_for_free_shipping ), $input_string );
        }
        return $input_string;
    }
    
    /**
     * Check conditions for displaying the product label.
     * 
     * @since	2.6.0
     */
    public function product_label_output( $product = null )
    {
        if ( !$product ) {
            global  $product ;
        }
        if ( $product->is_virtual() || $product->is_downloadable() ) {
            return null;
        }
        $fsl_label = $this->fsl_label_options;
        $show_on_single_simple_product = ( isset( $fsl_label['show_on_single_simple_product'] ) ? $fsl_label['show_on_single_simple_product'] : false );
        $show_on_single_variable_product = ( isset( $fsl_label['show_on_single_variable_product'] ) ? $fsl_label['show_on_single_variable_product'] : false );
        $show_on_single_variation = ( isset( $fsl_label['show_on_single_variation'] ) ? $fsl_label['show_on_single_variation'] : false );
        $show_on_list_variable_products = ( isset( $fsl_label['show_on_list_variable_products'] ) ? $fsl_label['show_on_list_variable_products'] : false );
        $show_on_list_simple_products = ( isset( $fsl_label['show_on_list_simple_products'] ) ? $fsl_label['show_on_list_simple_products'] : false );
        $type = $product->get_type();
        
        if ( 'variable' === $type ) {
            $min_var_reg_price = $product->get_variation_regular_price( 'min', true );
            $min_var_sale_price = $product->get_variation_sale_price( 'min', true );
            $price = ( $min_var_sale_price ? $min_var_sale_price : $min_var_reg_price );
        } else {
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
            $price = ( $sale_price ? $sale_price : $regular_price );
        }
        
        $price = apply_filters( 'fsl_product_price', $price );
        $label_html = '';
        
        if ( is_product() ) {
            if ( 'simple' === $type && $show_on_single_simple_product || 'variable' === $type && $show_on_single_variable_product || 'variation' === $type && $show_on_single_variation ) {
                $label_html = $this->product_label_html( $price );
            }
        } else {
            if ( 'simple' === $type && $show_on_list_simple_products || 'variable' === $type && $show_on_list_variable_products ) {
                $label_html = $this->product_label_html( $price );
            }
        }
        
        return $label_html;
    }
    
    /**
     * Product label html and styles.
     *
     * @since    2.0.0
     */
    public function product_label_html( $price = 0 )
    {
        $amount_for_free_shipping = $this->free_shipping_min_amount;
        $fsl = '';
        
        if ( $price && $amount_for_free_shipping && $price >= $amount_for_free_shipping ) {
            $defaults = Defaults::label();
            $fsl_label = $this->fsl_label_options;
            $text_color = ( isset( $fsl_label['text_color'] ) ? $fsl_label['text_color'] : $defaults['text_color'] );
            $bg_color = ( isset( $fsl_label['bg_color'] ) ? $fsl_label['bg_color'] : $defaults['bg_color'] );
            $hide_border_shadow = ( isset( $fsl_label['hide_border_shadow'] ) ? $fsl_label['hide_border_shadow'] : $defaults['hide_border_shadow'] );
            $multilingual = ( isset( $fsl_label['multilingual'] ) ? $fsl_label['multilingual'] : $defaults['multilingual'] );
            $text = ( isset( $fsl_label['text'] ) ? $fsl_label['text'] : $defaults['text'] );
            if ( $multilingual ) {
                $text = $defaults['text'];
            }
            $styles = '';
            if ( $text_color ) {
                $styles .= 'color:' . $text_color . ';';
            }
            if ( $bg_color ) {
                $styles .= 'background-color:' . $bg_color . ';';
            }
            if ( $hide_border_shadow ) {
                $styles .= 'box-shadow:none;';
            }
            $fsl .= '<span class="devnet_fsl-label" style="' . esc_attr( $styles ) . '">';
            $fsl .= esc_html( $text );
            $fsl .= '</span>';
        }
        
        return apply_filters( 'fsl_product_label_html', $fsl );
    }
    
    /**
     * Add sufix (free shipping label) to product after the price.
     *
     * @since    2.0.0
     */
    public function get_price_html( $price_html, $product )
    {
        if ( is_admin() && !wp_doing_ajax() ) {
            return $price_html;
        }
        $fsl_label = $this->fsl_label_options;
        $label_over_image = ( isset( $fsl_label['label_over_image'] ) ? $fsl_label['label_over_image'] : false );
        // Show label as price sufix if not enabled label over image,
        // if it is enabled, show it only on the single product page,
        // but avoid any other products on the page (sliders, sidebars, etc.).
        // on single product page - page_id/queried_object_id must match with the product_id.
        if ( !$label_over_image || $label_over_image && is_product() && $product->get_id() === get_queried_object_id() ) {
            $price_html = $price_html . $this->product_label_output( $product );
        }
        return $price_html;
    }
    
    /**
     * Hide shipping rates when free shipping is available.
     *
     * @param array $rates Array of rates found for the package.
     * @return array
     */
    public function hide_shipping_when_free_is_available( $rates )
    {
        $fsl_general = get_option( 'devnet_fsl_general' );
        $hide_shipping_rates = ( isset( $fsl_general['hide_shipping_rates'] ) ? $fsl_general['hide_shipping_rates'] : false );
        if ( !$hide_shipping_rates ) {
            return $rates;
        }
        $free = [];
        
        if ( 'hide_all' === $hide_shipping_rates ) {
            foreach ( $rates as $rate_id => $rate ) {
                
                if ( 'free_shipping' === $rate->method_id ) {
                    $free[$rate_id] = $rate;
                    break;
                }
            
            }
            return ( !empty($free) ? $free : $rates );
        }
        
        
        if ( 'hide_except_local' === $hide_shipping_rates ) {
            foreach ( $rates as $rate_id => $rate ) {
                // Only modify rates if free_shipping is present.
                
                if ( 'free_shipping' === $rate->method_id ) {
                    $new_rates[$rate_id] = $rate;
                    break;
                }
            
            }
            
            if ( !empty($new_rates) ) {
                //Save local pickup if it's present.
                foreach ( $rates as $rate_id => $rate ) {
                    
                    if ( 'local_pickup' === $rate->method_id ) {
                        $new_rates[$rate_id] = $rate;
                        break;
                    }
                
                }
                return $new_rates;
            }
        
        }
        
        return $rates;
    }

}