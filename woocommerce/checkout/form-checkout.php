<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
} ?>

<div class="flex relative checkout-general-container">

<!-- <div class="w-40-ns pa4 checkout-details-container sticky top-0 flex">
	<div class="m-auto pa5 ph4 pt0  bg-white w-90-ns center">
		<div class="discount-code">
			<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
		</div>

		<div class="checkout-details">
			<h2 class="mb4">Detalle de tu compra:</h2>
			<p class="mt2">Nombre:<br><span id="detail-name"></span> <span id="detail-last"></span></p>

			<p class="mt2">Dirección:<br>
				<span id="detail-street"></span>
				<span id="detail-ap"></span>
				<span id="detail-city"></span>
				<span id="detail-province"></span>
				<span id="detail-pc"></span>
			</p>

			<p class="mt2">Teléfono:<br><span id="detail-phone"></span></p>
			<p class="mt2">Mail:<br><span id="detail-mail"></span></p>

		</div>
	</div>
	

</div>
-->

	<form name="checkout" method="post" class="checkout woocommerce-checkout w-100-ns ml-auto mr-0 ph5 pv3 b5" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<!-- <div class="sd-header flex justify-between mv5">
			<h2 class="f2">Checkout</h2> -->
			<!-- <a href="/shop" class="close-sd bg-black flex anchor pa2" cursor-color="red">
					<img class="pa1" src="/wp-content/uploads/2020/01/close-icon.svg">
			</a>
			
	</div> -->

	<div class="row">
		<div class="col-6">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<div class="flex mb4">
				<p class="has-after mr2">NØDDENHUS </p>
				<p class="has-after mr2">></p>
				<a href="/shop-grid" class="has-after mr2">SHOP </a>
				<p class="has-after mr2">></p>
				<p class="has-after mr2">CHECKOUT </p>
				<!-- <p class="has-after mr3">ENVÍO ></p>
				<p class="has-after mr3">PAGO</p> -->
			</div>
			<div class="shipping-methods">
				<div class="calculate-postcode mb4">
					<h4 class="main-font f2 mb2 pr5-ns">Ingrese su código postal para calcular el precio envío</h4>
					<input type="text" class="input-text black w-100 pa3 bg-main-light" name="temporary_postcode" id="temporary_postcode" placeholder="Ingrese su código postal aquí..." value="" autocomplete="postal-code" maxlength="4">
				</div>
				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
			</div>
			<?php endif; ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>
		</div>
		<div class="col-6 order-review-col">
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
		<h3 class="main-font" id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

			</div>
		</div>
	</form>
</div>

<style>

	.row .col-6 {
		max-width: calc(50% - 15px);
		flex: 0 0 calc(50% - 15px);
	}

	.row {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	.col-6.order-review-col {
		background: #f8f8f8;
		padding: 20px 40px;
		box-sizing: border-box;
	}

	.shop_table.woocommerce-checkout-review-order-table {
		padding: 25px;
		background: white;
		margin: 20px 0;
		flex-direction: column;
	}

	.shop_table.woocommerce-checkout-review-order-table .cart_item img {
		max-width: 80px;
		padding: 5px;
		border: 1px solid #ddd;
		margin-right: 15px;
	}

	.shop_table.woocommerce-checkout-review-order-table .cart_item {
		flex-direction: row;
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 20px;
		border-bottom: 1px solid #ddd;
		padding-bottom: 20px;
		font-size: 14px;
	}

	.shop_table.woocommerce-checkout-review-order-table .cart_item .product-name {
		display: flex;
		align-items: center;
	}

	.shop_table.woocommerce-checkout-review-order-table div:nth-child(2) div {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
	}

	.shop_table.woocommerce-checkout-review-order-table div:nth-child(2) .order-total {
		border-top: 1px solid #ddd;
		padding-top: 10px;
		font-size: 18px;
		font-family: var(--mainFont)
	}

	.shop_table.woocommerce-checkout-review-order-table div:nth-child(2) .cart-subtotal, .shop_table.woocommerce-checkout-review-order-table div:nth-child(2) div{
    	padding-bottom: 10px;
    	font-size: 14px;
			font-family: var(--mainFont)
	}

	ul.wc_payment_methods.payment_methods.methods {
		list-style: none;
		font-size: 14px;
		margin: 20px 0;
	}

	ul.wc_payment_methods.payment_methods.methods .woocommerce-info{
		background: transparent;
	}

	button#place_order {
		background: black;
		color: white;
		width: 100%;
		line-height: 1;
		padding: 15px 20px;
	}

	#shipping_method {
		border: 1px solid #ddd;
		border-radius: 10px;
		margin-top: 10px;
		margin-bottom: 30px;
		list-style: none;
	}

	#shipping_method li:nth-of-type(2) {
		border-top: 1px solid #ddd;
	}

	#shipping_method li label {
		padding-left: 10px;
		font-size: 14px;
	}

	#shipping_method li {
		padding: 12px;
		display: flex;
		align-items: center;
	}

	.woocommerce-billing-fields h3, .woocommerce-shipping-fields h3 {
    	margin-bottom: 10px;
    	font-weight: normal;
	}

	.woocommerce-billing-fields__field-wrapper, .woocommerce-shipping-fields__field-wrapper {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	.woocommerce-billing-fields__field-wrapper .form-row-first, .woocommerce-shipping-fields__field-wrapper .form-row-first {
		flex: 0 0 calc(50% - 10px);
		max-width: calc(50% - 10px);
		margin: 0;
	}

	.woocommerce-billing-fields__field-wrapper .form-row-last, .woocommerce-shipping-fields__field-wrapper .form-row-last {
		flex: 0 0 calc(50% - 10px);
		max-width: calc(50% - 10px);
	}

	.woocommerce-billing-fields__field-wrapper .form-row label, .woocommerce-shipping-fields__field-wrapper .form-row label {
		display: block;
		font-size: 13px;
		margin-bottom: 3px;
	}

	.woocommerce-billing-fields__field-wrapper input, .woocommerce-shipping-fields__field-wrapper input {
		border: 1px solid #ddd;
		padding: 9px 12px;
		width: 100%;
		border-radius: 5px;
		margin-bottom: 15px;
		font-size: 13px;
	}

	.woocommerce-billing-fields__field-wrapper .form-row-wide, .woocommerce-shipping-fields__field-wrapper .form-row-wide {
		flex: 0 0 100%;
		max-width: 100%;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 20px;
		padding: 8px 12px;
		height: 36px;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 26px;
		position: absolute;
		top: 6px;
		right: 1px;
		width: 20px;
	}

	span.woocommerce-input-wrapper .select2-container {
		margin-bottom: 15px;
	}

	span.select2-selection.select2-selection--single {
		border-radius: 5px;
		height: 36px;
		border-color: #ddd;
		font-size: 13px;
	}

	input#temporary_postcode {
		border: 1px solid #ddd;
		/* padding: 9px 12px; */
		/* width: 192px; */
		border-radius: 5px;
		margin-bottom: 15px;
		font-size: 13px;
	}

	.form-row select {
		font-size: 13px;
		width: 100%;
		border-radius: 5px;
		padding: 9px 12px;
		border-color: #ddd;
		margin-bottom: 15px;
	}

	p#billing_address_1_field, p#billing_address_2_field, p#billing_city_field, p#billing_state_field, p#billing_postcode_field, p#billing_phone_field, p#shipping_address_1_field, p#shipping_address_2_field, p#shipping_city_field, p#shipping_state_field, p#shipping_postcode_field, p#shipping_phone_field, #billing_email_field
	{
    	flex: 0 0 calc(50% - 10px) !important;
    	max-width: 50% !important;
	}

	p#billing_postcode_field{
		display: none !important;
	}

	p#billing_address_2_field input, p#shipping_address_2_field input {
		margin-bottom: 0px;
		margin-top: 18px;
	}

	textarea#order_comments {
		width: 100%;
		font-size: 13px;
		padding: 10px;
		margin-top: 10px;
	}

	h3#ship-to-different-address {
    	margin-bottom: 20px;
    	margin-top: 10px;
	}

</style>


<?php // do_action( 'woocommerce_after_checkout_form', $checkout ); 


 ?>

