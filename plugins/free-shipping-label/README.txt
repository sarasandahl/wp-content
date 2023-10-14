=== Free Shipping Label and Progress Bar for WooCommerce ===
Contributors: devnethr, MarinMatosevic
Donate link: https://www.paypal.com/paypalme/marinmatosevic/
Tags: woocommerce, free shipping, amount left, progress bar, shipping, free, woo, flexible shipping, order revenue, order value, shipping costs, notification
Requires PHP: 7.2
Requires at least: 5.5
Stable tag: trunk
Tested up to: 6.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Increase order revenue by showing your customers just how close they are to your free shipping threshold.

== Description ==

With our progress bar notification, you can give your customers a clear picture of just how close they are to qualifying for free shipping. This not only stops shoppers from leaving, but also encourages them to add more items to their cart and increase their order value - boosting your revenue in the process. 

Not only that, but our progress bar notification also provides a sense of urgency for your customers to reach the free shipping threshold. This can drive impulse purchases and increase the likelihood of your customers completing their purchase. By keeping the progress bar front and center, your customers will always be aware of how close they are to qualifying for free shipping, making them more likely to add that one extra item to reach the threshold.

Additionally, our progress bar notification is fully customizable to fit the look and feel of your brand. You can choose from a range of colors and styles to match your website's aesthetic, ensuring a seamless integration with your existing design.

Give your customers a smooth shopping journey and increase your average order value with our progress bar notification.

### [DOCUMENTATION](https://devnet.hr/docs/free-shipping-label/) | [FREE SHIPPING LABEL PRO](https://devnet.hr/plugins/free-shipping-label/)

## Who is plugin for?

* eCommerce Store Owners
* Agencies building shops for clients
* Anyone trying to create a better user experience
* Anyone trying to increase shop performance
* Anyone trying to add more dynamism to the shop

### Features

* Animated progress bar
* Customize progress bar
* Display on the cart page and checkout pages
* Hide shipping rates when free shipping is available
* Message after free shipping threshold is reached
* Show to all users or only for logged ones
* Product Label for simple and variable products
* Customize Product Label
* Translation ready
* Easy to use, no coding required
* Compatible with Flexible Shipping

### Get More Options in Free Shipping Label Pro

With [Free Shipping Label Pro](https://devnet.hr/plugins/free-shipping-label/), you get a lot more features, including:

- __NEW__ Animated Circular progress bar
- __NEW__ Customizable Circular progress bar
- __NEW__ Image label
- __NEW__ Label position
- __NEW__ Exclude label on selected categories or products
- __NEW__ FOX (former name is WOOCS) - currency switcher compatibility 
- __NEW__ CURCY - Multi Currency for WooCommerce  - compatibility 
- [Animated notice bar](https://devnet.hr/docs/free-shipping-label/notice-bar/)
- Advanced customization of notice bar
- Advanced progress bar customization	
- Progress bar cart positions
- Progress bar checkout positions
- Progress bar shortcode
- Progress bar gutenberg block
- Progress bar widget
- Progress bar compatible with [WooCommerce Cart and Checkout blocks](https://woocommerce.com/checkout-blocks/)
- and more!

### Support

We're here to help. Feel free to open a new thread on the [Support Forum](https://wordpress.org/support/plugin/free-shipping-label/).

### Documentation

You can check Free Shipping Label documentation [here](https://devnet.hr/docs/free-shipping-label/).

### Reviews

It's funny how much joy all those 5-star reviews bring to our team. It really keeps us going and motivates us to bring more cool features.
If you like this plugin, feel free to leave a [review](https://wordpress.org/support/plugin/free-shipping-label/reviews/#new-post).


== Installation ==

This plugin can be easily installed like any other WordPress integration by following the steps below:

1. Upload the plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the settings page: WooCommerce > Settings > Shipping > Free Shipping Label
4. Set up the plugin and when you're ready, enable it.

== Frequently Asked Questions ==

= What do I need to do for the Free Shipping Label plugin to work properly? =

In order for the Free Shipping Label plugin to work properly, you will need to set up WooCommerce zones and shipping methods. Additionally, the progress bar will only be displayed on the cart and checkout pages for zones that have defined free shipping methods. You can find more information about this in the [official documentation](https://devnet.hr/docs/free-shipping-label/woocommerce-settings/).

= Mini cart not showing progress bar =

Some themes and plugins may have their own minicart templates that override or exclude the default WooCommerce hook where the progress bar should be displayed. In this case, our pro version offers a shortcode that can be placed anywhere on the site, including the minicart. Alternatively, a more advanced option is to modify the minicart template and add the `woocommerce_widget_shopping_cart_before_buttons` hook to ensure the progress bar is displayed correctly.

= What should I do if the Progress Bar is not showing? =

First, check if you have enabled the Progress Bar switch in the settings. If it's already enabled, go through the [WooCommerce setup guide](https://devnet.hr/docs/free-shipping-label/woocommerce-settings/) and ensure everything is configured correctly. If you are still experiencing problems, contact the support team.

= What if I'm using other shipping-related plugins? =

If you are using any other plugins for shipping or free shipping functionalities, it may be the case that the plugin you have installed is not compatible with the Free Shipping Label plugin. You can enable the Custom threshold option in the General settings and manually set your Free Shipping minimum amount. If this doesn't work, contact the support team.

= What if I suspect a template issue? =

If you have followed all steps above and still progress bar won’t show, then this might be a template issue. If the progress bar is showing for example on the checkout page but not on the cart page, or vice versa, then it's probably a template issue. In this case, our pro version offers a shortcode that can be placed anywhere on the site, or you can edit the WooCommerce templates, but this requires a little bit of PHP, HTML and CSS knowledge. Be careful as you'll have to figure out on your own what to do.

= What are the WooCommerce hooks that are used for displaying the Progress Bar? =

The WooCommerce hooks that are used for displaying the Progress Bar are as follows:

Cart page hook: `woocommerce_proceed_to_checkout`
Mini-cart widget hook: `woocommerce_widget_shopping_cart_before_buttons`
Checkout hook: `woocommerce_review_order_before_submit`

== Screenshots ==

1. Progress Bar
2. Animated progress bar
3. Circular progress bar in notice bar
4. Circular progress bar on cart page
5. Product label
6. Settings panel 1
7. Settings panel 2

== Changelog ==

= 2.6.13 =
* Fix - error on settings page
* Performance – WC tested up to: 7.9
* Performance – WP tested up to: 6.3

= 2.6.12 =
* Fix - broken select2 dropdown in admin settings

= 2.6.11 =
* Update - Freemius SDK update to 2.5.10

= 2.6.10 =
* Fix - Progress bar not loading if local pickup selected first

* Update - readme.txt
* Update - Freemius WordPress SDK to 2.5.9
* Performance – WC tested up to: 7.8
* Dev - Added new `fsl_progress_bar_placeholder_html` filter hook

= 2.6.9 =
* Fix - custom threshold and only virtual products showing the progress bar
* Fix - free shipping requires - both, coupon
* Fix - when allowed zero shipping and selected local pickup showing qualified message
* Update - Freemius WordPress SDK to 2.5.8
* Performance – WC tested up to: 7.7

= 2.6.8 =
* Fix - flexible shipping min. amount calculation

= 2.6.7 =
* Fix - css classes typo
* Fix - svg icons in settings section
* Update - settings API
* Update - freemius sdk
* Performance – WC tested up to: 7.6

= 2.6.6 =

* Update - color pickers with alpha/transparent option
* Update - freemius sdk
* Security - additional security layer in settings API
* Performance – WC tested up to: 7.5
* Performance – WP tested up to: 6.2

= 2.6.5 =
* Security - enhanced security measures taken including input sanitization, attribute escaping, and replacement of remote select2 with woocommerce select2

= 2.6.4 =

* Update – minor style changes in the settings panel
* Update - readme.txt

= 2.6.3 =
* Fix - Error related to contributors when viewing details of a plugin
* Update - readme.txt
* Performance – WC tested up to: 7.4

= 2.6.2 =
* Update - zero shipping cost - free shipping is indicated by a shipping cost of zero
* Update - plugin name
* Update - language .pot file

= 2.6.1 =
* Fix - WooCommerce check on multisite
* Add - option to allow zero shipping cost
* Update - plugin name
* Update - language .pot file
* Update - css for settings options

= 2.6.0 =
* Fix - don't show progress bar if shipping cost is 0
* Fix - division by zero error when threshold is 0
* Fix - flexible shipping with local pickup enabled
* Fix - Deactivate free version when PRO activated
* Update - language .pot file
* Update - Freemius sdk

* Performance – WC tested up to: 7.3

= 2.5.1 =
* Fix - error when trying to delete plugin
* Fix - array to string conversion	

= 2.5.0 =
* Performance – WC tested up to: 7.1
* Performance – WP tested up to: 6.1
* Enhancement - Freemius integration
* Update - HPOS compatibility
* Update - product label filter priority
* Update - language .pot file

= 2.4.3 =
* Fix - E_PARSE

= 2.4.2 =
* Fix - Don't show Progress Bar if only virtual products are in the cart
* Performance – WC tested up to: 7.0
* Update - Ignore coupon option deprecated
* Update - language .pot file

= 2.4.1 =
* Fix - Product label styles

= 2.4.0 =
* Fix - Showing progress bar when free shipping coupon applied
* Fix - typos
* Update - language .pot file
* Enhancement - Security
* Performance – WC tested up to: 6.5
* Performance – WP tested up to: 6.0
* Performance - Code optimization
* Dev - Added new `fsl_settings_sections` filter hook
* Dev - Added new `fsl_settings_fields` filter hook
* Dev - Added new `fsl_settings_general` filter hook
* Dev - Added new `fsl_settings_progress_bar` filter hook
* Dev - Added new `fsl_settings_product_label` filter hook
* Dev - Added new `fsl_cart_progress_bar_position` filter hook
* Dev - Added new `fsl_minicart_progress_bar_position` filter hook
* Dev - Added new `fsl_product_label_html` filter hook

= 2.3.1 =
* Fix - Error when deleted initial shipping zone
* Fix - Fatal Error related to shipping packages
* Performance – WC tested up to: 6.3

= 2.3.0 =
* Enhancement - Initial shipping zone
* Fix - issues with showing labels before shipping method are chosen
* Fix - single product page: labels on variable products not showing up
* Fix - typos
* Performance – WP tested up to: 5.9
* Performance – WC tested up to: 6.1

= 2.2.3 =
* Dev - Added new `fsl_progress_bar_html` filter hook
* Dev - Added new `fsl_checkout_progress_bar_position` filter hook
* Performance – WC tested up to: 6.0
* Performance - Code optimization

= 2.2.2 =
* Fix - PHP Warning related to `fsl_shipping_method_min_amount` hook

= 2.2.1 =
* Fix - PHP Warning related to `fsl_flexible_shipping_min_amount` hook
* Dev - Added new `fsl_product_price` filter hook
* Performance – WC tested up to: 5.7

= 2.2.0 =
* Tweak - Added additional classes to progress bar
* Fix - Gutenberg error
* Enhancement - Hide shipping rates when free shipping is available
* Performance – WC tested up to: 5.6
* Dev - Added new `fsl_min_amount` filter hook
* Dev - Added new `fsl_free_shipping_instance_key` filter hook
* Dev - Added new `fsl_shipping_method_min_amount` filter hook
* Dev - Added new `fsl_flexible_shipping_min_amount` filter hook

= 2.1.1 =
* Fix - Animated progress bar

= 2.1.0 =
* Fix - Minor bug fixes
* Fix – minor style issues
* Enhancement - Disable for logged out users
* Enhancement - Message after free shipping threshold is reached
* Performance – WC tested up to: 5.2
* Update - pot file

= 2.0.3 =
* Fix – minor style issues
* Performance – WC tested up to: 4.9

= 2.0.2 =
* Fix – Syntax error
* Performance – WC tested up to: 4.8

= 2.0.1 =
* Enhancement - Multilingual support
* Update - pot file
* Fix - Minor bug fixes
* Performance - Code optimization
* Performance - Tested with latest WooCommerce version (4.6.1)

= 2.0.0 =
* Enhancement - Added product label
* Enhancement - New plugin menu page and tab pages
* Performance - Refactored code, queries, and options

= 1.0.1 =
* Fix - loading translations
* Update - textdomain

= 1.0. =
* First Launch

== Upgrade Notice ==
