<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
// echo '<pre class="">';
//   print_r($product);
// echo '</pre>';	

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product );

if ( $product->is_in_stock() || $product->backorders_allowed() || (!empty($_GET['hd_add']) && $_GET['hd_add'] === 'd9') ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart cell small-12" method="post" enctype='multipart/form-data'>
		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );

			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>

		<div class="input-group max-button no-margin qty_edits">
			<span class="input-group-label">Qty:</span>

			<?php
			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			) );
			?>

		</div>

			<div class="input-group-button add_cart_reform">
				<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button expanded alt" id="addCart_noreload"><?php echo esc_html( $product->single_add_to_cart_text() ); ?> </button>
			</div>
      <div class="checkout_reform">
        
<!--         <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button_checkout_button button expanded alt"> -->
        <a class="button expanded alt" href="<?php echo get_site_url(); ?>/cart/">Checkout Now</a>
<!--         </button> -->
        
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
    
		<?php
			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_quantity' );
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_button' );
		?>
	</form>

<!--     <p id="success_mssg">I am a text that fades</p> -->

    <label class="message_container mssg_hidden" id="success_mssg">
      <div class="alert warning">
        <span class="alertText"> ✅ Products have been added to your cart, please proceed to checkout.
        <br class="clear"/></span>
      </div>
    </label>




	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
