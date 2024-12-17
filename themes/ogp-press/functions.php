<?php

function custom_rewrite_rule() {
	add_rewrite_rule('^ownership-registration/?','wp-admin/admin-ajax.php?action=g365_data_receiver','top');
	add_rewrite_rule('^send-claim/?','wp-admin/admin-ajax.php?action=g365_send_claim_notice','top');
	add_rewrite_rule('^register/([^/]*)/?([^/]*)?/?','index.php?page_id=22736&rg_tp=$matches[1]&rg_ps=$matches[2]','top');
  add_rewrite_rule('^calendar/([^/]*)/?([^/]*)?/?','index.php?page_id=1205&cl_id=$matches[1]&cl_tp=$matches[2]','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);

//custom page url rewrites
function custom_rewrite_tag() {}
// add_action('init', 'custom_rewrite_tag', 10, 0);

// new checkout no reload

function woocommerce_ajax_add_to_cart_js() {
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('woocommerce-ajax-add-to-cart', '/wp-content/themes/ogp-press/js/app.js', array('jquery'), '', true);
//         wp_enqueue_script('woocommerce_ajax_add_to_cart_checkout_button', '/wp-content/themes/ogp-press/js/app.js', array('jquery'), '', true);
    }
}
// add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');        

function woocommerce_ajax_add_to_cart() {

            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
            $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
            $variation_id = absint($_POST['variation_id']);
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);
            $upsells = $_POST['upsell'];
          
  
            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
              
            foreach($upsells as $values){
              echo $values;
              WC()->cart->add_to_cart( $values, 1 );
              
            }

                do_action('woocommerce_ajax_added_to_cart', $product_id);

                if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);
                }

                WC_AJAX :: get_refreshed_fragments();
            } else {

                $data = array(
                    'error' => true,
                    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

                echo wp_send_json($data);
            }

            wp_die();
}

// function woocommerce_ajax_add_to_cart_checkout_button_js() {
//     if (function_exists('is_product') && is_product()) {
// //         wp_enqueue_script('woocommerce-ajax-add-to-cart', '/wp-content/themes/ogp-press/js/app.js', array('jquery'), '', true);
//         wp_enqueue_script('woocommerce_ajax_add_to_cart_checkout_button', '/wp-content/themes/ogp-press/js/app.js', array('jquery'), '', true);
//     }
// }
// add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart_checkout_button');
// add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart_checkout_button');

// function woocommerce_ajax_add_to_cart_checkout_button() {

//             $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
//             $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
//             $variation_id = absint($_POST['variation_id']);
//             $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
//             $product_status = get_post_status($product_id);
//             $upsells = $_POST['upsell'];

            
//                 if ( $passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

//                 foreach($upsells as $values){
//                   echo $values;
//                   WC()->cart->add_to_cart( $values, 1 );

//                 }

//                     do_action('woocommerce_ajax_added_to_cart', $product_id);

//                     if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
//                         wc_add_to_cart_message(array($product_id => $quantity), true);
//                     }

//                     WC_AJAX :: get_refreshed_fragments();
//                 } else {

//                     $data = array(
//                         'error' => true,
//                         'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

//                     echo wp_send_json($data);
//                 }

//             wp_die();
// }


// display cart total

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

/*
 * load required files
 */
get_template_part( 'inc/cleanup' );
get_template_part( 'inc/menu-cache' );
get_template_part( 'inc/menu-walkers' );
get_template_part( 'inc/gallery' );
get_template_part( 'inc/g365_conn' );
get_template_part( 'inc/general' );
get_template_part( 'inc/woocomm' );
get_template_part( 'inc/woocomm-gatekeep' );

add_role( 'gate_controller', 'Gatekeeper', array( 'read' => true ) );
?>