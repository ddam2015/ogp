<?php
/**
 * Single variation cart button
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if (stripos($product->get_sku(), 'tix') !== false) { //grid layout for tickets ?>
<div class="woocommerce-variation-add-to-cart variations_button">
  <a class="button expanded alt variations_collector"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></a>
</div>
<?php } else {

?>
<div class="woocommerce-variation-add-to-cart variations_button">
  <div class="input-group max-button no-margin qty_edits">
    <span class="input-group-label">Qty:</span>
	<?php
		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_before_add_to_cart_quantity' );
  
		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
		) );
		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_after_add_to_cart_quantity' );
    $button_text = ( has_term('gear', 'product_cat') ) ? 'Buy Now' : esc_html( $product->single_add_to_cart_text() );
	?>
  </div>
  </div>
    <div class="input-group-button add_cart_reform">
      <button type="submit" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" class="single_add_to_cart_button button expanded alt" id="addCart_noreload"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
<!--       <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" /> -->
      <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
      <input type="hidden" name="variation_id" class="variation_id" value="0" />
    </div>
  <div class="checkout_reform">      
    <a class="button expanded alt" href="<?php echo get_site_url(); ?>/cart/">Checkout Now</a>
  </div>

    <script>
    
      let button = document.getElementById("addCart_noreload");
      button.addEventListener("click", function () {
        let text = document.getElementById("success_mssg");
        text.classList.remove("mssg_hidden");
        setTimeout(function () {
          text.classList.add("fade-in");
          setTimeout(function () {
            text.classList.remove("fade-in");
            setTimeout(function () {
              text.classList.add("mssg_hidden");
            }, 1000);
          }, 2000);
        });
      });
    
    </script>
    
    <label class="message_container mssg_hidden" id="success_mssg">
      <br><br>
      <div class="alert warning">
        <span class="alertText"> ✅ Products have been added to your cart, please proceed to checkout.
        <br class="clear"/></span>
      </div>
    </label>
    


<?php
}